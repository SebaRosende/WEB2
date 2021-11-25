"use strict"
const API_URL = "api/comentario/impresora";
const API_URL1 = "api/comentario";
const API_ALL = "api/impresoras";

let app = new Vue({  //VUE
    el: "#app",
    data: {
        titulo: "Comentarios de usuarios",
        calificacion: "Calificación:",
        comentarios: [],
    },
    methods: {
        remove: function (id) {   //Elimina Comentario 
            borrarComentario(id)
        },
        ascendente: function (id_impresora_fk) {  //Orden ascentente de comentarios por puntaje
            ordenar(id_impresora_fk, 'ascendente')
        },
        descendente: function (id_impresora_fk) { //Orden descendente de comentarios por puntaje
            ordenar(id_impresora_fk, 'descendente')
        }
    }
})

let form = document.querySelector("#form");
form.addEventListener('submit', AddComentarios);

let id = document.querySelector("#id-coment");

async function MostrarComentarios() {  //Busca comentarios por un ID de impresora.
    try {
        let response = await fetch(API_URL + `/${id.value}`);
        let nComentarios = await response.json();
        app.comentarios = nComentarios;
    }
    catch (error) {
        console.log(error);
    }
}

MostrarComentarios();

async function AddComentarios(e) {  //Agrega comentario.
    e.preventDefault();
    let data = new FormData(form);
    let comentario = {
        id_impresora: data.get('id_impresora'),
        detalle: data.get('detalle'),
        puntaje: data.get('puntaje'),
    }
    try {
        let response = await fetch(API_URL + `/${id.value}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(comentario),
        });
        if (response.ok) {
            let dato = await response.json();
            app.comentarios.push(dato);  //Pushea e imprime.
        }
    } catch (e) {
        console.log(e)
    }
}

async function borrarComentario(id) {  //Elimina comentario por ID.
    try {
        let response = await fetch(API_URL1 + `/${id}`, {
            "method": "DELETE",
        });
        if (response.status == 201) {
            console.log("BORRADO");
        }
    }
    catch (error) {
        console.log(error);
    }
    MostrarComentarios();
}



async function ordenar(id_printer, order) {
    if (order == 'ascendente') {
        try {
            let response = await fetch(API_URL + `/${id_printer}` + `/orderasc`);
            let comAsc = await response.json();
            console.log(comAsc);
            app.comentarios = comAsc;
        }
        catch (error) {
            console.log(error);
        }
    }
    else if (order == 'descendente') {
        try {
            let response = await fetch(API_URL + `/${id_printer}` + `/orderdesc`);
            let comDesc = await response.json();
            console.log(comDesc);
            app.comentarios = comDesc;
        }
        catch (error) {
            console.log(error);
        }
    }
    else {
        console.log('ERROR');
    }
}



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
        remove: function (id) {
            borrarComentario(id)
        }
    }
})

let form = document.querySelector("#form");
form.addEventListener('submit', AddComentarios);

let id = document.querySelector("#id-coment");

async function MostrarComentarios() {
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

async function AddComentarios(e) {
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
            console.log(response);
            let dato = await response.json();
            app.comentarios.push(dato);
        }
    } catch (e) {
        console.log(e)
    }
}


async function borrarComentario(id) {
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
/*

Siguiente = document.querySelector("#btn_anterior");
Siguiente.addEventListener("click", proximaImpresora);

function proximaImpresora() {
    e.preventDefault();
    let data = new FormData(form);
    console.log(data.get('id_impresora'));
}

let btn_nav = new Vue({  //VUE
    el: "#btn_nav",
    data: {
        impresora: [],
    },
    methods: {
        remove: function (id) {
            borrarComentario(id)
        }
    }
})


let btn_next = document.querySelector("#btn_next");
btn_next.addEventListener('click', Execute);

async function Execute() {
    console.log("Boton");
    getAllPrinters();
}

async function getAllPrinters(){
    try {
        let response = await fetch(API_ALL);
        let impresoras = await response.json();
        console.log(impresoras)
    }
    catch (error) {
        console.log(error);
    }
}  */

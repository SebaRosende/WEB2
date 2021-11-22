let select = document.querySelector("#selectMetodo");
select.addEventListener("change", seleccionarMetodo);


async function seleccionarMetodo() {
    
    let metodo = select.value
    try {
        let respuesta = await fetch(`http://localhost/proyectos/WEB-2/PHP/TPE_SEBA/tpweb2/filtrado/${metodo}`);
        if (respuesta.ok) {
            let html = await respuesta.text();
            document.querySelector("#ajax-contenedor").innerHTML = html;
        } else {
            document.querySelector("#ajax-contenedor").innerHTML = "Fallo URL";
        }

    }
    catch (error) {
        console.log(error);
        document.querySelector("#ajax-contenedor").innerHTML = "Error al solicitar";
    }
}


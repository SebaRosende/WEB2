{literal}
    <div id="app">
        <h1>{{ titulo }} </h1>

        <ul class="list-group">
            <li v-for="dato in comentarios" class="list-group-item d-flex">

                {{dato.detalle}}       
                <div>{{ calificacion }} {{dato.puntaje}}</div>
{/literal}

            {if isset($smarty.session.USER_ID)}
                {if ($smarty.session.USER_ROL)==1}
                    {literal}
                        <div class="acciones ms-auto">
                            <button class="btn btn-sm btn-danger" v-on:click="remove(dato.id_comentario)">Borrar</button>
                        </div>
                    {/literal}
                {/if}
            {/if}

            {literal}
             </li>
             </ul>
              </div>
             {/literal}
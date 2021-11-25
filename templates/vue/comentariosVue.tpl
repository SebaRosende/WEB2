{literal}
    <div id="app">
        <h2>{{ titulo }} </h2>  
         {/literal} {if isset($smarty.session.USER_ID)} {literal}
            <button  v-on:click="ascendente(comentarios[0].id_impresora_fk)">menor a mayor</button>
            <button  v-on:click="descendente(comentarios[0].id_impresora_fk)">mayor a menor</button>  
        {/literal} {/if} {literal}    
        <ul class="list-group">                
            <li v-for="dato in comentarios" class="list-group-item d-flex">
                {{dato.detalle}}       
                <div>
                    {{ calificacion }} {{dato.puntaje}}
                </div>             
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
            
        </div>
        </ul>  
{/literal}
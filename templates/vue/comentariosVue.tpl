{literal}
    <div id="app">
        <h4>{{ titulo }} </h4>  
         {/literal} {literal}    
        <ul class="list-group">                
            <li v-for="dato in comentarios" class="list-group-item d-flex">
               {{dato.detalle}} - &nbsp
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
 {/literal}
   
        {if isset($smarty.session.USER_ID)} {literal}
            <div>  <button  v-on:click="ascendente(comentarios[0].id_impresora_fk)" class="btn btn-info btn-sm">Orden Ascendente</button>
            <button  v-on:click="descendente(comentarios[0].id_impresora_fk)" class="btn btn-info btn-sm">Orden Descendente</button>  
            </div>
        {/literal} 
        {/if}
    {literal}  
       </div>
        </ul>  

{/literal}




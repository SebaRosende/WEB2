{include file = 'header.tpl'}

<table class="list">
    <tbody>
        <form id="form" class="form-coment" method="POST">
            <div class="detalles_info">
               
                    
                <tr>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Descripción</th>
                </tr>
                {foreach from=$impresora item=$info}
                    <tr>
                        <td>{$info->modelo}</td>
                        <td>{$info->marca}</td>
                        <td>{$info->descripcion}</td>
                        {if isset($info->imagen)}
                        <img src="{$info->imagen}" width="350" height="350"> 
                        {/if}
                        
                    </tr>

                

                {/foreach}
            </div>
            <div class="detalles_comentario_sesion">
                <tr>
                    {if isset($smarty.session.USER_ID)}
                        <td> <label>Opiniones</label></td>                
                        <td><textarea class="form-control" type="text" required="required" name="detalle" cols="30" rows="1" placeholder="Comentarios..."></textarea> </td>
                        <td><label>Calificar</label>            
                        <select name="puntaje" id="id_puntaje">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select></td>
                        <td><button id="btn-coment" class="btn btn-success" type="submit">Comentar</button></td>
                    {/if} <td><input type="hidden" id="id-coment" name="id_impresora" value={$info->id_impresora}></td>
                
                </tr>
            </div>
        </form>
    </tbody>
    
</table>






{include file='vue/comentariosVue.tpl'}
    <div class="comentario_vue">
        <script src="js/jscomentarios.js"></script>
    </div>
{include file = 'footer.tpl'} 

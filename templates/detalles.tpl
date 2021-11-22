{include file = 'header.tpl'}

<table class="list">
    <tbody>
        <form id="form" class="form-coment" method="POST">
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
                </tr>
            {/foreach}
          
           
              
            <tr>
            {if isset($smarty.session.USER_ID)}
                  <td> <label>Opiniones</label></td>
                
                <td><textarea required="required" name="detalle" cols="30" rows="1" placeholder="Comentar"></textarea> </td>
                <td><label>Calificar</label>
            
                <select name="puntaje" id="id_puntaje">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select></td>
                    <td><button id="btn-coment" class="btn_comentar" type="submit">Comentar</button></td>
                {/if} <td><input type="hidden" id="id-coment" name="id_impresora" value={$info->id_impresora}></td>
               
            </tr>
       
        </form>
    </tbody>
</table>



{include file='vue/comentariosVue.tpl'}



<script src="js/jscomentarios.js"></script>


{include file = 'footer.tpl'}
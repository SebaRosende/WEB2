{include file = 'header.tpl'}



 <div class="formulario">
    <div><h5>Crear nuevo método</h5>
        <form class="formulario" method="POST" action="agregar_metodo">        
            <input required="required" type="text" name="input_metodo">
            <button class="btn btn-success btn-sm" type="submit">Agregar</button>   
        </form>
        <br>
            
            <table  class="list">
                        <tbody>
                        <h5>Editar métodos</h5>
                            {foreach from=$metodo item=$info}
                                <form method="POST" action='editar_metodo'>
                                    <tr>                            
                                        <td><input id="id_oculto" type="text" name="id_metodo"  style="width : 50px"  value={$info->id_metodo} readonly></td>
                                        <td><input type="text" name="input_metodo"  style="width : 300px"  value="{$info->metodo}"></td>
                                        <td><a class="btn btn-danger btn-sm" href="eliminar_metodo/{$info->id_metodo}">Eliminar</a></td>
                                        <td> <button class="btn btn-success btn-sm" type="submit">EDITAR</button> </td>                             
                                    </tr>
                                </form>
                            {/foreach}
                        </tbody> 
            </table>       
    </div>
</div>

<br>


<br>
<div class="formulario">
<h5>Crear nueva impresora</h5>
<form class="formulario" method="POST" action='agregar_impresora' enctype="multipart/form-data">
    <input required="required" type="text" name="marca" placeholder="Marca">
    <input required="required" type="text" name="modelo" placeholder="Modelo Ej TX135"> 
    <input required="required" type="text" name="descripcion" placeholder="Descripción">
    <select  name="select_metodo" id="selectMetodo" >
        {foreach from=$metodo item=$info}                      
        <option value="{$info->id_metodo}">{$info->metodo}</option>
        {/foreach}
    </select>
    <input  type="file" name="input_name"></td>
    <button class="btn btn-success" type="submit">Dar alta</button>
 </form>

<br>

<table  class="list">
<tbody>
<h5>Editar impresoras</h5>
</form>
      
                    <tbody>
                    <tr>
                        <th></th>
                        <th >Marca</th>
                        <th >Modelo</th>
                        <th >Descripción</th>
                        <th> Imagen </th>
                        <th>Eliminar imagen</th>
                        <th >Método</th>
                    </tr>
                        {foreach from=$impresora item=$info} 
                            <form method="POST" action='editar_impresora' enctype="multipart/form-data">  
                                <tr>                            
                                    <td><input id="id_oculto" type="text" name="id_impresora"  style="width : 50px"  value={$info->id_impresora} readonly></td>
                                    <td><input required="required" type="text" name="marca" value="{$info->marca}"></td>
                                    <td><input required="required" type="text" name="modelo" value="{$info->modelo}"></td>
                                    <td><input required="required" type="text" name="descripcion" style="width : 300px" value="{$info->descripcion}"></td>
                                    <td><input  type="text" name="ruta_imagen" value="{$info->imagen}">
                                    <input  type="file"  name="input_name"></td>
                                    <td><input type="checkbox" value="false" name="eliminar_foto"></th>
                                    <td><select name="select_metodo" id="selectMetodo">
                                        <option value="{$info->id_metodo_fk}" disable>{$info->metodo}</option>
                                        {foreach from=$metodo item=$info}               
                                        <option value="{$info->id_metodo}" >{$info->metodo}</option>
                                        {/foreach}
                                    </select></td>
                                    <td><a class="btn btn-danger btn-sm" href="eliminar_impresora/{$info->id_impresora}">Eliminar</a></td>
                                    <td> <button class="btn btn-success btn-sm" type="submit">EDITAR</button> </td>                             
                                </tr>
                            </form>
                        {/foreach}
                    
    
    </tbody> 
     </table> 
</div>




{include file = 'footer.tpl'}
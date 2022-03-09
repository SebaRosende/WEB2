{include file = 'header.tpl'}

<table  class="list">

<tbody>
    <thead>
        <tr>
            <th >Modelo</th>
            <th >Marca</th>
            <th >Descripción</th>
            <th >Método</th>
            <th >Más información</th>
        </tr>
    <thead>

    {foreach from=$impresora item=$info} 
    <form method="POST" action="detalle">
        <tr>
            <td>{$info->modelo}</td>
            <td>{$info->marca}</td>
            <td>{$info->descripcion}</td>
            <td>{$info->metodo}</td>
            <td><button type="submit" class="btn btn-primary btn-sm">Detalles</button></td>
            <td><input id="id_oculto" type="number" name="id" value={$info->id_impresora}></td> 
        </tr>
    </form>
    {/foreach}

    </tbody>   
 </table>

{include file = 'footer.tpl'}

{include file = 'header.tpl'}

<table class="list">

    <tbody>
        <thead>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Rol</th>
            </tr>
            <thead>
                {foreach from=$usuarios item=$info}
                    <form method="POST" action="cambiarRol">
                        <tr>
                            <td><input type="text" name="id_user" style="width : 50px" value={$info->id} readonly></td>
                            <td>{$info->email}</td>

                            <td>
                                <select name="select_rol" id="selectRol">
                                    <option value="{$info->id_rol_fk}" disable>{$info->rol}</option>
                                    {foreach from=$roles item=$info}
                                        <option value="{$info->id_rol}">{$info->rol}</option>
                                    {/foreach}
                                </select>
                            </td>
                            {if $info->id_rol_fk >1}
                                <td> <button class="btn btn-success" type="submit">EDITAR</button> </td>
                                <td><a class="btn btn-danger" href="eliminarUser/{$info->id}">Eliminar</a></td>
                            {else}
                                <td> <button class="btn btn-success" type="submit">EDITAR</button> </td>
                            {/if}

                        </tr>
                    </form>
                {/foreach}
    </tbody>
</table>

{include file = 'footer.tpl'}
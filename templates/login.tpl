{include file='header.tpl'}



<h2>Login</h2>

<div class="formulario">
<form  method="POST" class="row g-3" action="verify">
    <div class="col-auto">
        <input required="required" type="text" name="email" class="form-control" id="" placeholder="Ingrese su email...">
    </div>
    <div class="col-auto">
        <input required="required" type="password" name="password" class="form-control" id="" placeholder="Ingrese su password...">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-outline-primary">Login</button>
    </div>
</form>
</div>

{if $error}
    <div class="alert alert-danger mt-3">
        {$error}
    </div>
{/if}

{include file='footer.tpl'}

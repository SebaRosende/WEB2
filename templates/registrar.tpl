{include file = 'header.tpl'}

 <h2>Registrarse</h2>
 <br>
 <div class="formulario">
 <form method="POST" class="row g-3">
 <div class="col-auto"> 
   <input required="required" type="email" name="email" class="form-control" id="" placeholder="Ingrese su email...">
 </div>
 <div class="col-auto">
    <input required="required" type="password" name="password" class="form-control" id="" placeholder="Ingrese su password...">
 </div>
 <div class="col-auto">
   <button type="submit" class="btn btn-outline-primary">Crear cuenta</button>
 </div>
</form>
</div>

{include file = 'footer.tpl'}
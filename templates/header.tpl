<!DOCTYPE html>
<html lang="en">
<head>
    <base href="BASE_URL">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  <!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <title>Mundo Impresoras LTDA</title>
</head>
<body>
  <nav>
      <a href='home'>Home</a>
      <a href='filtrar'>Categorias</a>

     {if isset($smarty.session.USER_ID)}
          {if ($smarty.session.USER_ROL)==1}
          <a href='administrar'>Administrar</a>
          <a href='usuarios'>Usuarios</a>

        {/if}
        <a href='logout'>Logout({$smarty.session.USER_EMAIL})</a>
     
      {else}
      <a href='registrar'>Registrarse</a>
      <a href='login'>LogIn</a>
      {/if}
  
  </nav>
<br>
  <h2> MUNDO IMPRESORAS </h2><br>

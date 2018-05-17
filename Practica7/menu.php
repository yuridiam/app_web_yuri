<?php
  //comprueba que la sesion no este cerrada
    if(isset($_COOKIE["cerrar"])){
      if($_COOKIE["cerrar"]=="1"){
        header("Location: index.php");
      }
    }
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Ventas</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>

    <div class="large-10 columns" style="margin-left: 50px">
        <ul class="right button-group">
          <li><a href="./cerrar_sesion.php" class="button radius tiny" style="background-color: #1A191A">Cerrar Sesión</a></li>
        </ul>
      </div>
    <br><br>
    <div class="row">
      <div class="large-12 columns" align="center">
        <h2 style="font-weight: bold">Sistema de Ventas</h2>
        <h4 style="font-weight: bold; margin-top: -10px">Seleccione un módulo</h4><br>
        <hr style="margin-top: -20px">
        <a href="usuarios.php" class="button radius" style="background-color: #1A191A; width: 100%">Usuarios</a><br>
        <a href="menu_ventas.php" class="button radius" style="background-color: #1A191A; width: 100%">Ventas</a>
      </div>
    </div>
  <?php require_once('footer.php'); ?>
</body>
</html>
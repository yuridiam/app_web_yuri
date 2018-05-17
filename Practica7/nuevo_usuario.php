<?php 
  //se manda a llamar el archivo que contiene todas las funciones necesarias
  require_once("db/funciones.php");
  if(isset($_POST["agregar"])){
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $pass = $_POST["pass"];
    //ejecuta la funcion que agrega un futbolista a la bd
    $r = agregar_usuario($nombre, $usuario, $pass);
    if($r){
      //genera un mensaje de exito
      echo "<script type='text/javascript'>
        alert('Usuario almacenado');
      </script>";
    }
  }
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nuevo Usuario</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
     
    <!--<?php require_once("header.php"); ?>-->
    <div class="large-10 columns">
        <ul class="right button-group">
          <li><a href="./usuarios.php" class="button radius tiny" style="background-color: #1A191A">Regresar</a></li>&nbsp;
          <li><a href="./cerrar_sesion.php" class="button radius tiny" style="background-color: #1A191A">Cerrar Sesión</a></li>
        </ul>
      </div>

    <div class="row">
 
      <div class="large-8 columns">
        <h2 style="font-weight: bold">Nuevo Usuario</h2>
        <hr>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form method="post">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="pass" placeholder="Contraseña" required>
                <input type="submit" class="button radius tiny" style="background-color: green; color: white; margin-left: 560px" name="agregar" value="Agregar">
              </form>
          </div>
      </section>
  </div>
</div>
</div>
<?php require_once("footer2.php"); ?>
</body>
</html>
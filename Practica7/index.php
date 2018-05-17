<?php
  //carga las funciones necesarias
  require_once("db/funciones.php");
  //verifica que la sesion este abierta
  if(isset($_COOKIE["cerrar"])){
    $_COOKIE["cerrar"]="1";
  }
  //checa si el usuario presiono el boton de enviar
  if(isset($_POST["aceptar"])){
    //carga las variables de usuario y contra
    $usuario = $_POST["usuario"];
    $pass = $_POST["contra"];
    //comprueba que el usuario exista
    $r = buscar_usuario($usuario);
    $b=0;
    //compara todos los usuarios iguales y que la contraseña ingresada sea la correcta
    foreach ($r as $fila) {
      if($fila["usuario"]==$usuario){
          $r2=buscar_contra($pass);
          if($r2==1){
            $b=1;
          }else{
            $b=0;
          }
      }
    }
    if($b==1){
      //accede a la pagina de iniciar sesion para activar la cookie de usuario
      header("Location: iniciar_sesion.php?usuario=".$usuario);
    }else{
      //manda una alerta que no encontro la cuenta regisstrada en la bd
      echo "<script type='text/javascript'>
                      alert('Usuario o contraseña incorrectos');
                  </script>";
    }
  }

?>
<?php
  require_once("db/funciones.php");
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ventas</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
     <br><br>
    <div class="row" align="center">
      <div class="large-12 columns" align="center">
        <h1 style="font-weight: bold">Sistema de Ventas</h1>
        <hr><br>
        <form method="post">
          <h3 style="font-weight: bold; margin-top: -15px">Iniciar Sesión</h3><br>
          <input type="text" name="usuario" style="width: 300px; margin-top: -17px" placeholder="Usuario" required>
          <input type="password" name="contra" style="width: 300px" placeholder="Contraseña">
          <input type="submit" class="button radius tiny" style="background-color: black" name="aceptar" value="Aceptar" required>
        </form>
      </div>
    </div>
  <?php require_once('footer.php'); ?>
</body>
</html>
<?php 
  //se manda a llamar el archivo que contiene todas las funciones necesarias
  require_once("funciones.php");
  if(isset($_POST["agregar"])){
    $dorso = $_POST["dorso"];
    //funcion que comprueba si ya existe un basquetbolista con el mismo numero de dorso
    $d = dorso_exists($dorso,2);
    //si existe un basquetbolista con el mismo numero de dorso genera un mensaje
    if($d==1){
      echo "<script type='text/javascript'>
            alert('Ya existe un basquetbolista con el mismo número de dorso');
          </script>";
    }else{
      //toma los valores de las cajas
      $nombre = $_POST["nombre"];
      $pos = $_POST["pos"];
      $carrera = $_POST["carrera"];
      $correo = $_POST["correo"];
      //ejecuta la funcion que agrega un basquetbolista a la bd
      $r = add(2, $dorso, $nombre, $pos, $carrera, $correo);
      if($r){
        //genera un mensaje de exito
        echo "<script type='text/javascript'>
            alert('Basquetbolista almacenado');
          </script>";
      }
    }
  }
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agregar Basquetbolista</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
     
    <?php require_once("header4.php"); ?>

    <div class="row">
 
      <div class="large-9 columns">
        <h2 style="font-weight: bold">Agregar Basquetbolista</h2>
        <hr>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <form method="post">
                <input type="text" name="dorso" placeholder="Número de dorso" required>
                <input type="text" name="nombre" placeholder="Nombre completo" required>
                <input type="text" name="pos" placeholder="Posición" required>
                <select name="carrera">
                  <option value="1">Ingeniería en Tecnologías de la Información</option>
                  <option value="2">Ingeniería en Mecatrónica</option>
                  <option value="3">Ingeniería en Tecnologías de Manufactura</option>
                  <option value="4">Ingeniería en Sistemas Automotrices</option>
                  <option value="5">Licenciatura en Pequeñas y Medianas Empresas</option>
                </select>
                <input type="email" name="correo" placeholder="Correo electrónico" required>
                <input type="submit" class="button radius tiny" style="background-color: green; color: white; margin-left: 642px" name="agregar" value="Agregar">
              </form>
          </div>
      </section>
  </div>
</div>
</div>
<?php require_once("footer.php"); ?>
</body>
</html>
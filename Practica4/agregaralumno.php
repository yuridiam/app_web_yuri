<?php 
  //registro de los datos ingresados al .txt
  if(isset($_POST["agregar"])){

    $matricula = $_POST["matricula"];
    $nombre = $_POST["nombre"];
    $carrera = $_POST["carrera"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    //se abre el archivo o se crea si no existe
    $file=fopen("registros.txt", "a+");
    //ingresa los datos al archivo
    fputs($file, "alumno" . "," . $matricula . "," . $nombre . "," . $carrera . "," . $email . "," . $tel . "\r\n");
    //cierra el archivo
    fclose($file);
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Alumnos y Maestros</title>
  <link rel="stylesheet" href="./css/foundation.css" />
  <script src="./js/vendor/modernizr.js"></script>
</head>
<body>
<?php require_once('header.php'); ?>
<div class="row">
<div class="large-9 columns">
  <h3>Módulo de Alumnos</h3>
  <p>Agregar alumno al sistema</p>
  <a href="alumnos.php" style="margin-left: 650px">Ver tabla</a>
  <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
            </div>
              <form method="post" action="">
                <input type="text" name="matricula" placeholder="Matrícula" required>
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="carrera" placeholder="Carrera" required>
                <input type="email" name="email" placeholder="Correo electrónico" required>
                <input type="text" name="tel" placeholder="Teléfono" required>
                <input type="submit" class="button" style="margin-left: 600px" name="agregar" value="Agregar">
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
    </div>
<?php require_once('footer.php'); ?>
</body>
</html>
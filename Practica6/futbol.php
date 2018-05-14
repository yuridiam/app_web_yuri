<?php 
	//se manda a llamar el archivo que contiene todas las funciones necesarias
	require_once("funciones.php");
  //corre la funcion que carga todos los futbolistas existentes
	$alumnos = run_app(1);
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fútbol</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
     
    <?php require_once("header2.php"); ?>

    <div class="row">
 
      <div class="large-12 columns">
        <h2 style="font-weight: bold">Fútbol</h2>
        <hr>
        <a href="agregar_futbol.php" class="button radius tiny secondary" style="background-color: green; margin-left: 890px; color:white">Agregar</a>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <table>
                <thead>
                  <tr>
                    <th width="50">Id</th>
                    <th width="200">Nombre</th>
                    <th width="100">Posicion</th>
                    <th width="100">Carrera</th>
                    <th width="100">Deporte</th>
                    <th width="200">Correo</th>
                    <th width="200"></th>
                  </tr>
                </thead>
                <tbody>
                	<?php
                		foreach ($alumnos as $fila) {
                	?>
                  <tr>
                    <td><?php echo $fila["num_dorso"]; ?></td>
                    <td><?php echo $fila["nombre"]; ?></td>
                    <td><?php echo $fila["posicion"]; ?></td>
                    <td><?php

                      switch ($fila["id_carrera"]) {
                         case 1:
                           echo 'ITI';
                           break;
                        case 2:
                            echo 'IM';
                          break;
                        case 3:
                            echo 'ITM';
                          break;
                        case 4:
                            echo 'ISA';
                          break;
                        case 5:
                            echo 'PYMES';
                          break;
                         default:
                           break;
                       } 

                    ?></td>
                    <td><?php 
                        switch ($fila["id_deporte"]) {
                          case 1:
                            echo "Fútbol";
                            break;
                          case 2:
                            echo "Básquetbol";
                            break;
                          default:
                            break;
                        }
                    ?></td>
                    <td><?php echo $fila["email"]; ?></td>
                    <td><a href="modificar_futbol.php?id=<?php echo $fila['id']; ?>" class="button radius tiny secondary" style="background-color: blue; color:white">Modificar</a>&nbsp;<a href="eliminar_futbol.php?id=<?php echo $fila['id']; ?>" class="button radius tiny secondary" style="background-color: red; color:white" >Eliminar</a></td>
                  </tr>
                  <?php
                		}
                	?>
                </tbody>
              </table>
          </div>
      </section>
  </div>
</div>
</div>
<?php require_once("footer.php"); ?>
</body>
</html>
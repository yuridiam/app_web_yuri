<?php 
	//se manda a llamar el archivo que contiene todas las funciones necesarias
	require_once("db/funciones.php");
  //corre la funcion que carga todos los futbolistas existentes
	$usuarios = run_app(1);
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Usuarios</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>

    <div class="large-10 columns" style="margin-left: 50px">
        <ul class="right button-group">
          <li><a href="./menu.php" class="button radius tiny" style="background-color: #1A191A">Regresar</a></li>&nbsp;
          <li><a href="./cerrar_sesion.php" class="button radius tiny" style="background-color: #1A191A">Cerrar Sesión</a></li>
        </ul>
      </div>

    <div class="row">
 
      <div class="large-12 columns">
        <h2 style="font-weight: bold">Usuarios</h2>
        <hr>
        <a href="nuevo_usuario.php" class="button radius tiny secondary" style="background-color: green; margin-left: 890px; color:white">Agregar</a>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <table>
                <thead>
                  <tr>
                    <th width="300">Id</th>
                    <th width="300">Nombre</th>
                    <th width="300">Usuario</th>
                    <th width="300"></th>
                  </tr>
                </thead>
                <tbody>
                	<?php
                  //recoje cada atributo de cada fila
                		foreach ($usuarios as $fila) {
                	?>
                  <tr>
                    <td><?php echo $fila["id"]; ?></td>
                    <td><?php echo $fila["nombre"]; ?></td>
                    <td><?php echo $fila["usuario"]; ?></td>
                    <td><a href="modificar_usuario.php?id=<?php echo $fila['id']; ?>" class="button radius tiny secondary" style="background-color: blue; color:white">Modificar</a>&nbsp;<a href="eliminar_usuario.php?id=<?php echo $fila['id']; ?>" class="button radius tiny secondary" style="background-color: red; color:white" >Eliminar</a></td>
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
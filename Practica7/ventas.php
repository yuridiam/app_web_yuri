<?php 
	//se manda a llamar el archivo que contiene todas las funciones necesarias
	require_once("db/funciones.php");
  //corre la funcion que carga todos los futbolistas existentes
	$ventas = run_app(3);

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

    <div class="large-10 columns" style="margin-left: 50px">
        <ul class="right button-group">
          <li><a href="./menu_ventas.php" class="button radius tiny" style="background-color: #1A191A">Regresar</a></li>&nbsp;
          <li><a href="./cerrar_sesion.php" class="button radius tiny" style="background-color: #1A191A">Cerrar Sesión</a></li>
        </ul>
      </div>

    <div class="row">
 
      <div class="large-12 columns">
        <h2 style="font-weight: bold">Ventas</h2>
        <?php
          //obtiene la fecha para mostrar el total de las ventas del día
           $fecha = getdate();
            if($fecha["mon"]==1 || $fecha["mon"]==2 || $fecha["mon"]==3 || $fecha["mon"]==4 || $fecha["mon"]==5 || $fecha["mon"]==6 || $fecha["mon"]==7 || $fecha["mon"]==8 || $fecha["mon"]==9){
              $mon = "0"."$fecha[mon]";
            }
          $f = $fecha["mday"]."-". $mon."-". $fecha["year"];
          //busca la fecha de hoy en los registros
          $r = buscar_fecha($f);
          $total=0;
          //por cada resultado se va sumando el total
          if($r){
            foreach ($r as $fila) {
              $total = $total + $fila["total"];
            }
            echo "<p style='margin-left:750px; font-weight: bold; color: red'>Total en ventas del dia: ". $total."</p>";
          }   

        ?>
        <hr>
        <a href="nueva_venta.php" class="button radius tiny secondary" style="background-color: green; margin-left: 885px; color:white">Agregar</a>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <table>
                <thead>
                  <tr>
                    <th width="300">Id</th>
                    <th width="300">Total</th>
                    <th width="355"></th>
                  </tr>
                </thead>
                <tbody>
                	<?php
                  //recoje cada atributo de cada fila
                		foreach ($ventas as $fila) {
                	?>
                  <tr>
                    <td><?php echo $fila["id"]; ?></td>
                    <td><?php echo $fila["total"]; ?></td>
                    <td><a href="detalles_venta.php?id=<?php echo $fila['id']; ?>" class="button radius tiny secondary" style="background-color: blue; color:white">Ver Detalles</a>
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
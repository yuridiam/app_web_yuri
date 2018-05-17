<?php 
	//se manda a llamar el archivo que contiene todas las funciones necesarias
	require_once("db/funciones.php");
  //recoje el id desde la url
  $id = isset( $_GET['id'] ) ? $_GET['id'] : '';

  //corre la funcion que carga todos los detalles de cada venta
	$ventas = buscar_detalle($id);
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalles de venta</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>

    <div class="large-10 columns" style="margin-left: 50px">
        <ul class="right button-group">
          <li><a href="./ventas.php" class="button radius tiny" style="background-color: #1A191A">Regresar</a></li>&nbsp;
          <li><a href="./cerrar_sesion.php" class="button radius tiny" style="background-color: #1A191A">Cerrar Sesión</a></li>
        </ul>
      </div>

    <div class="row">
 
      <div class="large-12 columns">
        <h2 style="font-weight: bold">Detalles de la venta</h2>
        <hr>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <table>
                <thead>
                  <tr>
                    <th width="300">Producto</th>
                    <th width="300">Cantidad</th>
                    <th width="355">Total</th>
                    <th width="355">Promedio por producto</th>
                  </tr>
                </thead>
                <tbody>
                	<?php
                    //se corre el array que contiene cada venta para msotrarlo
                		foreach ($ventas as $fila) {
                	?>
                  <tr>
                    <td><?php 
                    //busca el nombre del producto por su id
                      $r = buscar(2,$fila["idproducto"]);
                      echo $r["nombre"]; 

                    ?></td>
                    <td><?php echo $fila["cantidad"]; ?></td>
                    <td><?php echo $fila["total"]; ?></td>
                    <td><?php echo $fila["promedio"]; ?></td>
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
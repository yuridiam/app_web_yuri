<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
<div class="card card-success card-outline" style="width: 50%; margin-left: 300px">
            <div class="card-header">
              <h3 class="card-title">Nueva Venta</h3>
              <div class="card-tools">
                  <div class="btn-group">
                    <?php echo "<a href='index.php?action=ventas&id_tienda=".$_GET["id_tienda"]."'><button type='button' class='btn btn-tool'><i class='fa fa-times'></i></button></a>";?>
                  </div>
            </div>
            </div>
            <div class="card-body">
            	<form method="post">
              <h5>Seleccione los productos que desee</h5>                	
                	<select class="form-control select2" name="productos" id="productos">
                		  <?php
                          //Creacion del objeto y llamado de sus objetos
                          $traerPro = new MvcController();
                          $traerPro->traerProductosTiendaController();

                      ?>
                	</select><br><br>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-cube"></i></span>
                      </div>
                        <input type="number" class="form-control" name="cant" id="cant" placeholder="Cantidad">
                  </div><br>
                  <button type="button" class="btn btn-block btn-success" name="apro" id="apro" onclick="agP();">Agregar Producto</button><br>
                  <label id="tit" style="font-size: 1.5em">Lista de productos</label><hr style="margin-top: -10px">
                  <table id="t" name="t" style="width: 100%">
                    <thead>
                      <th>Nombre</th>
                      <th>Unidades</th>
                      <th>Total</th>
                    </thead>
                    <tbody id="b">
                    </tbody>
                  </table>
                  <label id="tit" style="font-size: 1.5em">Total de venta</label>
                  <input type="text" name="precio" id="precio" readonly>
                  <input type="hidden" name="p" id="p">
                  <?php echo "<input type='hidden' class='form-control' id='c_contra' value='". $_SESSION["contra"] ."'>";?>
                	<button type="submit" class="btn btn-block btn-outline-success"  name="agregar" id="agregar" onclick="regiP();">Registrar</button>
            	</form>
            </div>
        </div>
    </div>
</div>

<?php
  //Creacion del objeto y llamado de sus objetos
  $registrarVenta = new MvcController();
  $registrarVenta->registrarVentaController();

?>
<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
<div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Nuevo Producto</h3>
              <div class="card-tools">
                  <div class="btn-group">
                    <?php echo "<a href='index.php?action=inventario&id_tienda=".$_GET["id_tienda"]."'><button type='button' class='btn btn-tool'><i class='fa fa-times'></i></button></a>";?>
                  </div>
            </div>
            </div>
            <div class="card-body">
            	<form method="post">
            		<div class="input-group">
                  		<div class="input-group-prepend">
                    		<span class="input-group-text"><i class="fa fa-barcode"></i></span>
                    	</div>
            			<input type="text" class="form-control" name="codigo" id="codigo" placeholder="Codigo del producto" style="width: 30%">
            		</div><br>
            		<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del producto">
            		<div class="input-group">
                  		<div class="input-group-prepend">
                    		<span class="input-group-text"><i class="fa fa-usd"></i></span>
                  		</div>
                  			<input type="text" class="form-control" name="precio" id="precio" placeholder="Precio del producto">
                	</div><br>
                	<div class="input-group">
                  		<div class="input-group-prepend">
                    		<span class="input-group-text"><i class="fa fa-cube"></i></span>
                  		</div>
                  			<input type="number" class="form-control" name="stock" id="stock" placeholder="Stock inicial">
                	</div><br>
                	<select class="form-control select2" style="width: 100%" name="categoria">
                		  <?php
                          //Creacion del objeto y llamado de sus objetos
                          $traerCat = new MvcController();
                          $traerCat->traerCategoriasController();

                      ?>
                	</select><br><br>
                	<button type="submit" class="btn btn-block btn-outline-success" name="agregar" onclick="regiP();">Registrar</button>
            	</form>
            </div>
        </div>
    </div>
</div>

<?php
  //Creacion del objeto y llamado de sus objetos
  $registrarPro = new MvcController();
  $registrarPro->registrarProductoController();

?>
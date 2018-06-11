<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
      	<section class="content">
      	<div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title"> Detalles de Venta </h3>
                <div class="card-tools">
                  <div class="btn-group">
                    <?php 
                        echo '<a href="index.php?action=ventas&id_tienda='.$_GET["id_tienda"].'"><button type="button" class="btn btn-tool">';
                    ?>
                    <i class="fa fa-times"></i></button></a>
                  </div>
            </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
				<?php
          //Creacion del objeto y llamado de sus objetos
					$mostrarInfo = new MvcController();
					$mostrarInfo->ventaController();
				?>
				<div class="col-12">
				<br><h3><b>Productos</b></h3><hr style="width: 95%">
        <div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Producto</th>
                  <th>Unidades</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                      //Creacion del objeto y llamado de sus objetos
                      $visualizarH = new MvcController();
                      $visualizarH->vistaVentaController();
                    ?>
                </tbody>
              </table>
            </div>
              </div>
          </div>
      </section>
      </div>
  </div>
  
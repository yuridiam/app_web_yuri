<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
      	<section class="content">
      	<div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title"> Actualizar Stock </h3>
                <div class="card-tools">
                  <div class="btn-group">
                    <a href="index.php?action=inventario"><button type="button" class="btn btn-tool">
                    <i class="fa fa-times"></i></button></a>
                  </div>
            </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
				<?php
          //Creacion del objeto y llamado de sus objetos
					$mostrarInfo = new MvcController();
					$mostrarInfo->stockController();
				?>
				<div class="col-12">
				<br><h3><b>Movimientos</b></h3><hr style="width: 95%">
				<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Usuario</th>
                  <th>Cantidad</th>
                  <th>Movimiento</th>
                  <th>Referencia</th>
                  <th>Nota</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                      //Creacion del objeto y llamado de sus objetos
                      $visualizarH = new MvcController();
                      $visualizarH->vistaHistorialController();
                    ?>
                </tbody>
              </table>
              </div>
          </div>
      </section>
      </div>
  </div>
  
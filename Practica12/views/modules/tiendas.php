<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
<div class="card">
            <div class="card-header">
              <h3 class="card-title">Tiendas</h3>
            </div>
            <!-- /.card-header -->
            <br>
            <a href="index.php?action=registrartienda"><input type="button" name="agregar" class="btn btn-block btn-success" style="width: 15%; margin-left: 845px" value="Agregar Tienda"></a>
            <div class="card-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Dirección</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  <?php
                      //Creacion del objeto y llamado de sus objetos
                      $vistaU = new MvcController();
                      $vistaU->vistaTiendaController();
                  ?>
                </tbody>
              </table>
            </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

<?php
      //Creacion del objeto y llamado de sus objetos
      $desActTienda = new MvcController();
      $desActTienda->desActTiendaController();
  ?>
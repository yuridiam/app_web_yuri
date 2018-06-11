<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
<div class="card">
            <div class="card-header">
              <h3 class="card-title">Ventas</h3>
            </div>
            <br>
           <?php echo " <a href='index.php?action=registrarventa&id_tienda=".$_GET["id_tienda"]."'><input type='button' name='agregar' class='btn btn-block btn-success' style='width: 15%; margin-left: 845px' value='Registrar Venta'></a>"; ?> 
            <div class="card-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Fecha</th>
                  <th>Usuario</th>
                  <th>Total</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      //Creacion del objeto y llamado a sus metodos
                      $vistaVentas = new MvcController();
                      $vistaVentas->vistaVentasController();
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
  //Creacion del objeto y llamado a sus metodos
  $eliminarVentas = new MvcController();
  //$eliminarVentas->eliminarVentasController();

?>
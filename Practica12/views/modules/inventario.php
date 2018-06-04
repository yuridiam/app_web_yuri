<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
<div class="card">
            <div class="card-header">
              <h3 class="card-title">Inventario</h3>
            </div>
            <!-- /.card-header -->
            <br>
            <a href="index.php?action=registrarproducto"><input type="button" name="agregar" class="btn btn-block btn-success" style="width: 15%; margin-left: 845px" value="Agregar Producto"></a>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Stock actual</th>
                  <th>Categoria</th>
                  <th>Fecha de Registro</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                      //Creacion del objeto y llamado de sus objetos
                      $visualizarPro = new MvcController();
                      $visualizarPro->vistaInventarioController();
                    ?>
                </tbody>
              </table>
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
  $eliminarPro = new MvcController();
  $eliminarPro->eliminarProductoController();

?>
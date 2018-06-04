<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
<div class="card">
            <div class="card-header">
              <h3 class="card-title">Categorías</h3>
            </div>
            <br>
           <a href="index.php?action=registrarcategoria"><input type="button" name="agregar" class="btn btn-block btn-success" style="width: 15%; margin-left: 845px" value="Agregar Categoría"></a>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Fecha de Registro</th>
                  <th></th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      //Creacion del objeto y llamado a sus metodos
                      $vistaCategorias = new MvcController();
                      $vistaCategorias->vistaCategoriasController();
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
  //Creacion del objeto y llamado a sus metodos
  $eliminarCat = new MvcController();
  $eliminarCat->eliminarCategoriaController();

?>
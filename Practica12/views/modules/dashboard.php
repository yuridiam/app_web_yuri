<div class="content-wrapper" style="background-color: white"> 
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php
                    //Creacion del objeto y llamado a sus metodos
                    $p = new MvcController();
                    $p->contarProductosController();
                ?></h3>
                <p>Total de productos</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
                <h3><?php
                    //Creacion del objeto y llamado a sus metodos
                    $c = new MvcController();
                    $c->contarCategoriasController();
                ?><sup style="font-size: 20px"></sup></h3>

                <p>Total de Categorías</p>
              </div>
              <div class="icon">
                <i class="ion ion-pricetags"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php
                  //Creacion del objeto y llamado a sus metodos
                    $u = new MvcController();
                    $u->contarUsuariosController();
                ?></h3>
                <p>Total de Usuarios</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php
                    //Creacion del objeto y llamado a sus metodos
                    $m = new MvcController();
                    $m->contarMovimientosController();
                ?></h3>

                <p>Total de Movimientos</p>
              </div>
              <div class="icon">
                <i class="ion ion-refresh"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="col-11">
      <div class="card card-success">
              <div class="card-header border-transparent">
                <h3 class="card-title">Últimos movimientos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>Producto</th>
                      <th>Usuario</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Nota</th>
                      <th>Referencia</th>
                      <th>Cantidad</th>
                      <th>Movimiento</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                          //Creacion del objeto y llamado a sus metodos
                          $uM = new MvcController();
                          $uM->ultimosMovimientosController();
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
            <div class="card card-danger">
              <div class="card-header no-border">

                <h3 class="card-title">
                  <i class="fa fa-calendar"></i>
                  Calendario
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <button type="button" class="btn btn-danger btn-sm" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="calendar" style="width: 100%;"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          </div>
          
      
          <!-- /.col -->
  </section>

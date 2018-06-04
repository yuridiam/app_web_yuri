<?php 
  //Se inicia la sesion
  session_start();
  //Se valida la sesion
  if(!$_SESSION["validar"]){
    header("location:index.php");
    exit();
  }else{
    $usuario = $_SESSION["usuario"];
  }
?>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-success navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?action=salir" class="nav-link" style="color: white; margin-left: 850px">Cerrar Sesión</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-warning elevation-4">
    <!-- Brand Logo -->
    <a href="index.php?action=dashboard" class="brand-link bg-success">
      <span class="brand-text font-weight-light" style="color: white"><i class="nav-icon fa fa-cubes"></i> SISTEMA DE <b>INVENTARIO</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #1B1B1B">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a class="d-block"><i class="nav-icon fa fa-user"></i>&ensp; <?php echo $usuario; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php?action=dashboard" class="nav-link">
              <i class="nav-icon fa fa-line-chart"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?action=inventario" class="nav-link">
              <i class="nav-icon fa fa-barcode"></i>
              <p>Inventario</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?action=categorias" class="nav-link">
              <i class="nav-icon fa fa-tags"></i>
              <p>Categorías</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?action=usuarios" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>Usuarios</p>
            </a>
          </li>
        </ul>
      </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</div>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-warning navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-warning elevation-4">
    <!-- Brand Logo -->
    <a href="index.php?action=dashboard" class="brand-link">
      <span class="brand-text font-weight-light" style="font-weight: bold"><i class="nav-icon fa fa-cubes"></i> SISTEMA DE INVENTARIO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><i class="nav-icon fa fa-user"></i> Nombre de usuario</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php?action=dashboard" class="nav-link active">
              <i class="nav-icon fa fa-dashboard"></i>
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
          <li class="nav-item">
            <a href="index.php?action=salir" class="nav-link">
              <i class="nav-icon fa fa-arrow-left"></i>
              <p>Salir</p>
            </a>
          </li>
        </ul>
      </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</div>
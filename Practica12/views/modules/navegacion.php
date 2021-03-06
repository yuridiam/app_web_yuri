<?php 
  //Se inicia la sesion
  session_start();
  //Se valida la sesion
  if(!$_SESSION["validar"]){
    header("location:index.php");
    exit();
  }else{
    $usuario = $_SESSION["usuario"];
    $tienda = $_SESSION["nom_tienda"];
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
    <a href="#" class="brand-link bg-success">
      <span class="brand-text font-weight-light" style="color: white"><i class="nav-icon fa fa-cubes"></i> SISTEMA DE <b>INVENTARIO</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #1B1B1B">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a class="d-block"><i class="nav-icon fa fa-user"></i>&ensp; <?php echo $usuario; ?></a>
          <?php if ($tienda=="Superadmin"){ ?>
            <a class="d-block"><i class="nav-icon fa fa-check"></i>&ensp; <?php echo $tienda; ?></a>
          <?php }else{ ?>
              <a class="d-block"><i class="nav-icon fa fa-home"></i>&ensp; <?php echo $tienda; ?></a>

          <?php } ?>
          <?php if(isset($_GET["id_tienda"]) && $tienda=="Superadmin"){ 
              $tienda = new MvcController();
              $tienda->tiendaController();

          } ?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if($tienda=="Superadmin"){?>
          <li class="nav-item">
            <a href="index.php?action=dashboard" class="nav-link">
              <i class="nav-icon fa fa-line-chart"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php }else{ ?>
            <li class="nav-item">
            <?php echo "<a href='index.php?action=dashboardtienda&id_tienda=".$_GET["id_tienda"]."'' class='nav-link'>"; ?>
              <i class="nav-icon fa fa-line-chart"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php } ?>
          <?php if($tienda!="Superadmin"){?>
          <li class="nav-item">
            <?php echo "<a href='index.php?action=inventario&id_tienda=".$_GET["id_tienda"]."'' class='nav-link'>"; ?>
              <i class="nav-icon fa fa-barcode"></i>
              <p>Inventario</p>
            </a>
          </li>
          <?php }
            ?>
          <?php if($tienda!="Superadmin"){?>
          <li class="nav-item">
            <?php echo "<a href='index.php?action=ventas&id_tienda=".$_GET["id_tienda"]."'' class='nav-link'>"; ?>
              <i class="nav-icon fa fa-money"></i>
              <p>Ventas</p>
            </a>
          </li>
          <?php }
            ?>
          <?php if($tienda!="Superadmin"){?>
          <li class="nav-item">
            <?php echo "<a href='index.php?action=categorias&id_tienda=".$_GET["id_tienda"]."'' class='nav-link'>"; ?>
              <i class="nav-icon fa fa-tags"></i>
              <p>Categorías</p>
            </a>
          </li>
          <?php }
            ?>
          <?php
          if($tienda=="Superadmin"){?>
          <li class="nav-item">
            <a href="index.php?action=usuarios" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <?php }else{
            ?>
            <li class="nav-item">
            <?php echo "<a href='index.php?action=usuariostienda&id_tienda=".$_GET["id_tienda"]."'' class='nav-link'>"; ?>
              <i class="nav-icon fa fa-users"></i>
              <p>Usuarios</p>
            </a>
          </li>
            <?php }?>
          <?php
            if($tienda=="Superadmin"){?>
                <li class="nav-item">
                  <a href="index.php?action=tiendas" class="nav-link">
                  <i class="nav-icon fa fa-gears"></i>
                  <p>Tiendas</p>
                </a>
                </li>
          <?php }
           ?>
           <?php if($_SESSION["nom_tienda"]=="Superadmin" && isset($_GET["id_tienda"])){ ?>

                    <li class="nav-item">
                      <a href="index.php?action=dashboard" class="nav-link">
                      <i class="nav-icon fa fa-arrow-left"></i>
                      <p>Salir de tienda</p>
                    </a>
                    </li>

            <?php } ?>
        </ul>
      </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</div>
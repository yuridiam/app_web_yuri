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
<div style="background-color: #E8ECEF; width: 100%; min-height: 100%; position: absolute;">
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0087FF">
  <a class="navbar-brand" href="index.php?action=inicioadmin" style="color:white">CENTRO DE <b>APRENDIZAJE DE INGLÉS</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-left: 800px">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bienvenido, 
          <?php echo $usuario; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?action=salir">Cerrar Sesión</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
</div>


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
  <a class="navbar-brand" href="index.php?action=iniciousuario" style="color:white">CENTRO DE <b>APRENDIZAJE DE INGLÉS</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown" style="">
    <ul class="navbar-nav">
        <li class="nav-item active" style="margin-left: 70px">
            <a class="nav-link" href="index.php?action=iniciousuario">Inicio <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="index.php?action=sesiones2">Sesiones <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown" style="margin-left: 550px">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bienvenido, 
            <?php echo $usuario; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" onclick="confirmarSesion();">Cerrar Sesión</a>
          </div>
        </li>
    </ul>
  </div>
</nav>
</div>


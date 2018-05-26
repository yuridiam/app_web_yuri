<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="views/css/foundation.css" />
    <script src="views/js/vendor/modernizr.js"></script>
    <script src="views/js/vendor/jquery.js"></script>
    <link rel="stylesheet" href="views/css/select2.min.css" />
    <script src="views/js/select2.min.js"></script>
    <script src="views/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="views/css/jquery.dataTables.min.css" />


    <style>

    nav{
      position:relative;
      margin:auto;
      width:95%;
      height:auto;
      background:black;
      font-family: Arial;
    }

    nav ul{
      position:relative;
      margin:auto;
      width:100%;
      text-align: center;
    }

    nav ul li{
      display:inline-block;
      width:15%;
      line-height: 50px;
      list-style: none;
    }

    nav ul li a{
      color:white;
      text-decoration: none;
    }

    nav ul li a:hover{
      color:gray;
    }
  </style>
  </head>
  <body>
    <br>

      <?php
        //se validan los tipos de action que hay ya que existen dos menus de navegacion diferentes
        if(isset($_GET["action"])){
          if($_GET["action"]=="maestros" || $_GET["action"]=="alumnos" || $_GET["action"]=="carreras" || $_GET["action"]=="registraralumno" || $_GET["action"]=="registrarcarrera" || $_GET["action"]=="registrarmaestro" || $_GET["action"]=="editaralumno" || $_GET["action"]=="editarcarrera" || $_GET["action"]=="editarmaestro" || $_GET["action"]=="reportes"){
              include("modules/navegacion.php");
          }elseif ($_GET["action"]=="tutorias" || $_GET["action"]=="registrartutoria" || $_GET["action"]=="detallestutoria") {
              include("modules/navegacion2.php");
          }
        }
      ?>
      <br>
      <?php
        //Se crea una instancia del controlador
        $mvc = new MvcController();
        //Se manda a llamar el controlador de las paginas
        $mvc->enlacesPaginasController();
      ?> 
      <br>
      <hr style="width: 90%; margin-left: 100px">
      <label style="margin-left: 1080px; margin-top: -10px">Yuridia Guadalupe Monteongo Padilla</label><br>

  </body>
</html>
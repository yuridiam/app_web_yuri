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

        if(isset($_GET["action"])){
          if($_GET["action"]=="maestros" || $_GET["action"]=="alumnos" || $_GET["action"]=="carreras" || $_GET["action"]=="registraralumno" || $_GET["action"]=="registrarcarrera" || $_GET["action"]=="registrarmaestro" || $_GET["action"]=="editaralumno" || $_GET["action"]=="editarcarrera" || $_GET["action"]=="editarmaestro"){
              include("modules/navegacion.php");
          }elseif ($_GET["action"]=="tutorias" || $_GET["action"]=="registrartutoria" || $_GET["action"]=="editartutoria") {
              include("modules/navegacion2.php");
          }
        }
      ?>
      <br>
      <?php
        $mvc = new MvcController();
        $mvc->enlacesPaginasController();
      ?> 
      <script type="text/javascript">
          $(document).ready(function() {
              $(".js-example-basic-single").select2();
              $('#example').DataTable();
          });
      </script> 

  </body>
</html>
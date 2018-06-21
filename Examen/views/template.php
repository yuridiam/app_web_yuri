<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="views/css/foundation.css"/>
    <link rel="stylesheet" href="views/css/nav.css"/>
    <script src="views/js/vendor/modernizr.js"></script>
    <script src="views/js/vendor/jquery.js"></script>
    <link rel="stylesheet" href="views/css/select2.min.css" />
    <script src="views/js/select2.min.js"></script>
    <script src="views/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="views/css/jquery.dataTables.min.css" />
  </head>
  <body>
      <?php
        //se validan los tipos de action que hay ya que existen dos menus de navegacion diferentes
        if(isset($_GET["action"]) && $_GET["action"]!="salir" && $_GET["action"]!="error"){
              if($_GET["action"]=="inicio" || $_GET["action"]=="lugares"){
                  include("modules/navegacion.php");
              }else{
                if($_GET["action"]!="ingresar" && $_GET["action"]!="fallo"){
                  include("modules/navegacion2.php");
                }
              }
        }else{
          include("modules/navegacion.php");
        }
      ?>
      <br>
      <?php

          //Se crea una instancia del controlador
          $mvc = new MvcController();
          //Se manda a llamar el controlador de las paginas
          $mvc->enlacesPaginasController();
        
      ?> 
  </body>
</html>
<script type="text/javascript">
  //Codigo javascript necesario para los select2, datatables y tutorias
          //Se agrega la funcionalidad de datatable y select2
          $(document).ready(function() {
              $(".js-example-basic-single").select2();
              $('#example').DataTable();
              $('#example2').DataTable();
              $('#example3').DataTable();
              $('#example4').DataTable();
          });
</script>
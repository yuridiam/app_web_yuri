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
    <link rel="stylesheet" href="views/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/adminlte.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="views/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="views/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="views/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="views/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="views/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="views/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="views/plugins/datatables/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="views/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="views/dist/sweetalert.css">
    <link rel="stylesheet" href="views/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="views/plugins/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="views/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
  $('#myModal').modal()                      // initialized with defaults
  $('#myModal').modal({ keyboard: false })   // initialized with no keyboard
  $('#myModal').modal('show')    
</script>
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
<script src="views/dist/sweetalert.js"></script>
<script src="views/dist/sweetalert.min.js"></script>
<script src="views/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="views/plugins/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">

  //funcion que obtiene las variables de la url
  function getUrlVars() {
      var vars = {};
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
          vars[key] = value;
      });
      return vars;
    }
    //funcion para eliminar un grupo
    function eliminar(){
      //Se obtienen las variables
      var c = document.getElementById("contra").value;
      if(c!='' && c!=null){
        if(c==='123'){
          var id = getUrlVars();
          var borrar = ""+id["idBorrar"];
          document.location.href="index.php?action=grupos"+"&id="+borrar+"&contra="+c;
        }else{
          swal("Error", "Contraseña incorrecta", "error");
        }
      }else{
        swal("Error", "Ingrese una contraseña", "error");
      }
    }

    //funcion para eliminar una alumna
    function eliminarA(){
      //Se obtienen las variables
      var c = document.getElementById("contra").value;
      if(c!='' && c!=null){
        if(c==='123'){
          var id = getUrlVars();
          var borrar = ""+id["idBorrar"];
          document.location.href="index.php?action=alumnas"+"&id="+borrar+"&contra="+c;
        }else{
          swal("Error", "Contraseña incorrecta", "error");
        }
      }else{
        swal("Error", "Ingrese una contraseña", "error");
      }
    }

    //funcion para eliminar un pago
    function eliminarP(){
      //Se obtienen las variables
      var c = document.getElementById("contra").value;
      if(c!='' && c!=null){
        if(c==='123'){
          var id = getUrlVars();
          var borrar = ""+id["idBorrar"];
          document.location.href="index.php?action=pagos"+"&id="+borrar+"&contra="+c;
        }else{
          swal("Error", "Contraseña incorrecta", "error");
        }
      }else{
        swal("Error", "Ingrese una contraseña", "error");
      }
    }
  
  //funcion para modificar un grupo
  function mod(){

      event.preventDefault();
      swal({
        title: "<h5 style='color: black'>¿Seguro que quiere modificar este grupo?</h5>",
        text: "<input type='button' class='btn btn-block button' style='background-color: #853BBE' value='Aceptar' id='aceptar' onclick='conf();'>",
        html: true,
        showConfirmButton: false,
      });

    }
  //funcion para modificar una alumna
  function modA(){

      event.preventDefault();
      swal({
        title: "<h5 style='color: black'>¿Seguro que quiere modificar esta alumna?</h5>",
        text: "<input type='button' class='btn btn-block button' style='background-color: #853BBE' value='Aceptar' id='aceptar' onclick='conf();'>",
        html: true,
        showConfirmButton: false,
      });

    }
    //funcion para modificar un pago
    function modP(){

      event.preventDefault();
      swal({
        title: "<h5 style='color: black'>¿Seguro que quiere modificar este pago?</h5>",
        text: "<input type='button' class='btn btn-block button' style='background-color: #853BBE' value='Aceptar' id='aceptar' onclick='conf();'>",
        html: true,
        showConfirmButton: false,
      });

    }
    //funcion que hace submit a los datos
    function conf(){
      $("#modificar").click();
      swal("Listo", "Operación exitosa", "success");
    }
    var alumnasA = document.getElementById("alu").value+"";

    function act(){
      $('#alumna').empty().trigger("change");
      var g = document.getElementById("grupo").value+"";
      var v1 = alumnasA.split("$");
      for (var i = 0; i < v1.length-1; i++) {
        var f = v1[i].split(",");
        if(f[2]===g){
          document.getElementById("alumna").options[document.getElementById("alumna").options.length] = new Option(f[1], f[0]);
        }
        
      }

    }

</script>
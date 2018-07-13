<!doctype html>
<html lang="en" >
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="views/css/foundation.css" />
    <link rel="stylesheet" href="views/css/nav.css" />
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
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body style="background-color: #E8ECEF">
      <?php
        //se validan los tipos de action que hay ya que existen dos menus de navegacion diferentes
        if(isset($_GET["action"]) && $_GET["action"]!="salir" && $_GET["action"]!="error" && $_GET["action"]!="iniciousuario"){
            
            include("modules/navegacion.php");
              
        }else{
          if(isset($_GET["action"]) && $_GET["action"]=="iniciousuario"){
            include("modules/navegacion2.php");
          }
        }


      ?>
      <?php
        //Se crea una instancia del controlador
        $mvc = new MvcController();
        //Se manda a llamar el controlador de las paginas
        $mvc->enlacesPaginasController();
      ?> 
  </body>
</html>
<script src="views/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="views/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="views/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="views/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="views/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="views/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="views/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="views/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="views/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="views/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="views/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="views/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="views/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="views/dist/js/demo.js"></script>
<script src="views/plugins/datatables/jquery.dataTables.js"></script>
<script src="views/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="views/plugins/select2/select2.full.min.js"></script>
<script src="views/dist/buttons.flash.min.js"></script>
<script src="views/dist/buttons.html5.min.js"></script>
<script src="views/dist/buttons.print.min.js"></script>
<script src="views/dist/dataTables.buttons.min.js"></script>
<script src="views/dist/jszip.min.js"></script>
<script src="views/dist/pdfmake.min.js"></script>
<script src="views/dist/vfs_fonts.js"></script>
<script>
  $(document).ready(function() {
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
<script type="text/javascript">
  $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
  })
</script>
<script src="views/dist/sweetalert.js"></script>
<script src="views/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  //Funcion que trae las variables de la url
  function getUrlVars() {
      var vars = {};
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
          vars[key] = value;
      });
      return vars;
    }

    function verificar(id){
      event.preventDefault();
      swal({
              title: "<h5>¿Está seguro de eliminar este alumno?</h5>"+id,
              text: "<input type='button' class='btn btn-block btn-outline-primary' value='Aceptar' id='aceptar' onclick='conf("+id+");'>",
              html: true,
              showCancelButton: false,
              showConfirmButton: false,
      });
    }

    function verificarP(id){
      event.preventDefault();
      swal({
              title: "<h5>¿Está seguro de eliminar este profesor?</h5>",
              text: "<input type='button' class='btn btn-block btn-outline-primary' value='Aceptar' id='aceptar' onclick='confP("+id+");'>",
              html: true,
              showCancelButton: false,
              showConfirmButton: false,
      });
    }

    function verificarA(id){
      event.preventDefault();
      swal({
              title: "<h5>¿Está seguro de eliminar esta actividad?</h5>",
              text: "<input type='button' class='btn btn-block btn-outline-primary' value='Aceptar' id='aceptar' onclick='confA("+id+");'>",
              html: true,
              showCancelButton: false,
              showConfirmButton: false,
      });
    }

    function verificarG(id){
      event.preventDefault();
      swal({
              title: "<h5>¿Está seguro de eliminar esta grupo?</h5>",
              text: "<input type='button' class='btn btn-block btn-outline-primary' value='Aceptar' id='aceptar' onclick='confG("+id+");'>",
              html: true,
              showCancelButton: false,
              showConfirmButton: false,
      });
    }

    function confG(id){
        window.location='index.php?action=grupos&borrar='+id;
        swal("Listo", "Grupo Eliminado", "success");
    }

    function confA(id){
        window.location='index.php?action=actividades&borrar='+id;
        swal("Listo", "Actividad Eliminada", "success");
    }

    function confP(id){
        window.location='index.php?action=profesores&borrar='+id;
        swal("Listo", "Profesor Eliminado", "success");
    }


    function conf(id){
        window.location='index.php?action=alumnos&borrar='+id;
        swal("Listo", "Alumno Eliminado", "success");
    }

</script>
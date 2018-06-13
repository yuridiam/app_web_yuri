<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="views/css/foundation.css" />
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
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="hold-transition sidebar-mini">
      <?php
        //se validan los tipos de action que hay ya que existen dos menus de navegacion diferentes
        if(isset($_GET["action"]) && $_GET["action"]!="salir" && $_GET["action"]!="nodisponible" && $_GET["action"]!="error"){
          /*if($_GET["action"]=="dashboard" || $_GET["action"]=="inventario" || $_GET["action"]=="usuarios" || $_GET["action"]=="categorias" || $_GET["action"]=="registrarproducto" || $_GET["action"]=="registrarcategoria" || $_GET["action"]=="registrarusuario" || $_GET["action"]=="editarproducto" || $_GET["action"]=="stock" || $_GET["action"]=="agregarstock" || $_GET["action"]=="quitarstock" || $_GET["action"]=="editarcategoria" || $_GET["action"]=="editarusuario"){*/
              include("modules/navegacion.php");
          /*}*/
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
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
<script type="text/javascript">
  $('#myModal').modal()                      // initialized with defaults
  $('#myModal').modal({ keyboard: false })   // initialized with no keyboard
  $('#myModal').modal('show')    
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

    function eliminar(){
      //Se obtienen las variables
      var c = document.getElementById("contra").value;
      var id = getUrlVars();
      var borrar = ""+id["idBorrar"];
      document.location.href="index.php?action=usuarios"+"&id="+borrar+"&contra="+c;
    }

    function eliminarPro(){
      //Se obtienen las variables
      var c = document.getElementById("contra").value;
      var id = getUrlVars();
      var borrar = ""+id["idBorrar"];
      var id_tienda = ""+id["id_tienda"];
      document.location.href="index.php?action=inventario"+"&id="+borrar+"&contra="+c+"&id_tienda="+id_tienda;
    }

    function eliminarUTienda(){
      //Se obtienen las variables
      var c = document.getElementById("contra").value;
      var id = getUrlVars();
      var borrar = ""+id["idBorrar"];
      var id_tienda = ""+id["id_tienda"];
      document.location.href="index.php?action=usuariostienda"+"&id="+borrar+"&contra="+c+"&id_tienda="+id_tienda;
    }

    function eliminarCat(){
      //Se obtienen las variables
      var c = document.getElementById("contra").value;
      var id = getUrlVars();
      var borrar = ""+id["idBorrar"];
      var id_tienda = ""+id["id_tienda"];
      document.location.href="index.php?action=categorias"+"&id="+borrar+"&contra="+c+"&id_tienda="+id_tienda;
    }

    function modi(){

      var n = document.getElementById("nombre").value;
      var u = document.getElementById("usuario").value;
      var c = document.getElementById("contra").value;

      event.preventDefault();
     
      if(n==='' || u==='' || c===''){
          swal("Error", "Llene todos los campos", "error");
      }else{
          swal({
          title: "<h5 style='color: gray'>¿Seguro que quiere modificar este usuario?</h5>",
          text: "<input type='password' class='form-control' id='contra_conf' placeholder='Contraseña' autofocus><input type='button' class='btn btn-block btn-outline-primary' value='Aceptar' id='aceptar' onclick='verificar();'>",
          html: true,
          showCancelButton: false,
          showConfirmButton: false,
        });
      }
    }
    function verificar(){
      var contra = document.getElementById("contra_conf").value;

      if(contra=="mario123" || contra=="123"){
        $("#agregar").click();
        swal("Listo", "Registro modificado", "success");
      }else{
        swal({
          title: "<h6 style='color: gray'>Contraseña incorrecta</h6>",
          html: true,

        });
      }

    }
    function aUsuario(){
      var n = document.getElementById("nombre").value;
      var u = document.getElementById("usuario").value;
      var c = document.getElementById("contra").value;
     
      if(n==='' || u==='' || c===''){
        swal("Error", "Llene todos los campos", "error");
        event.preventDefault();
      }else{
        swal("Listo", "Usuario registrado", "success");
        $("#agregar").click();
      }
    }

    function regUT(){
      var n = document.getElementById("nombre").value;
      var u = document.getElementById("usuario").value;
      var c = document.getElementById("contra").value;
     
      if(n==='' || u==='' || c===''){
        swal("Error", "Llene todos los campos", "error");
        event.preventDefault();
      }else{
        swal("Listo", "Usuario registrado", "success");
        $("#agregar").click();
      }
    }

    function aTienda(){
      var n = document.getElementById("nombre").value;
      var d = document.getElementById("dir").value;
      if(n==='' || d===''){
        swal("Error", "Llene todos los campos", "error");
        event.preventDefault();
      }else{
        swal("Listo", "Usuario registrado", "success");
        $("#agregar").click();
      }
    }

    function regiP(){
      var cod = document.getElementById("codigo").value;
      var n = document.getElementById("nombre").value;
      var p = document.getElementById("precio").value;
      var s = document.getElementById("stock").value;
      if(cod==='' || n==='' || p==='' || s===''){
        swal("Error", "Llene todos los campos", "error");
        event.preventDefault();
      }else{
        swal("Listo", "Producto registrado", "success");
        $("#agregar").click();
      }
    }

    function modificarTienda(){
      var n = document.getElementById("nombre").value;
      var d = document.getElementById("dir").value;

      event.preventDefault();

      if(n==='' || d===''){
        swal("Error", "Llene todos los campos", "error");
      }else{
          swal({
          title: "<h5 style='color: gray'>¿Seguro que quiere modificar esta tienda?</h5>",
          text: "<input type='password' class='form-control' id='contra_conf' placeholder='Contraseña' autofocus><input type='button' class='btn btn-block btn-outline-primary' value='Aceptar' id='aceptar' onclick='verificar();'>",
          html: true,
          showCancelButton: false,
          showConfirmButton: false,
        });
      }
    }

    function cambiar(){

      var c = document.getElementById("contra_conf").value;
      var id = getUrlVars();
      var id2 = ""+id["id"];
      if(c=="mario123" || c=="123"){
          document.location.href="index.php?action=tiendas&id="+id2;
      }else{
        swal("Error", "Contraseña incorrecta", "error");
        event.preventDefault();
      }
      
    }

    function verificarPro(){
      var contra = document.getElementById("contra_conf").value;
      var contra_real = document.getElementById("c_contra").value;
      if(contra==contra_real){
        $("#agregar").click();
        swal("Listo", "Registro modificado", "success");
      }else{
        swal({
          title: "<h6 style='color: gray'>Contraseña incorrecta</h6>",
          html: true,
        });
      }
    }

    function verificarU(){
      var contra = document.getElementById("contra_conf").value;
      var contra_real = document.getElementById("c_contra").value;
      if(contra==contra_real){
        $("#agregar").click();
        swal("Listo", "Registro modificado", "success");
      }else{
        swal({
          title: "<h6 style='color: gray'>Contraseña incorrecta</h6>",
          html: true,
        });
      }
    }

    function modiProd(){

      var cod = document.getElementById("codigo").value;
      var n = document.getElementById("nombre").value;
      var p = document.getElementById("precio").value;
      var s = document.getElementById("stock").value;

      event.preventDefault();

      if(cod==='' || n==='' || p==='' || s===''){
        swal("Error", "Llene todos los campos", "error");
      }else{
        swal({
          title: "<h5 style='color: gray'>¿Seguro que quiere modificar este producto?</h5>",
          text: "<input type='password' class='form-control' id='contra_conf' placeholder='Contraseña' autofocus><input type='button' class='btn btn-block btn-outline-primary' value='Aceptar' id='aceptar' onclick='verificarPro();'>",
          html: true,
          showCancelButton: false,
          showConfirmButton: false,
        });
      }

    }

    function verificarS(){
      var contra = document.getElementById("contra_conf").value;
      var contra_real = document.getElementById("c_contra").value;
      if(contra==contra_real){
        $("#agregar").click();
        swal("Listo", "Operación exitosa", "success");
      }else{
        swal({
          title: "<h6 style='color: gray'>Contraseña incorrecta</h6>",
          html: true,
        });
      }
    }

    function verificarV(){
      var contra = document.getElementById("contra_conf").value;
      var contra_real = document.getElementById("c_contra").value;
      if(contra==contra_real){
        $("#agregar").click();
        swal("Listo", "Operación exitosa", "success");
      }else{
        swal({
          title: "<h6 style='color: gray'>Contraseña incorrecta</h6>",
          html: true,
        });
      }
    }

    function agregarS(){

      var ca = document.getElementById("cantidad").value;
      var ref = document.getElementById("ref").value;

      event.preventDefault();

      if(ca==='' || ref===''){
        swal("Error", "Llene todos los campos", "error");
      }else{
        swal({
          title: "<h5 style='color: gray'>Confirme su contraseña</h5>",
          text: "<input type='password' class='form-control' id='contra_conf' placeholder='Contraseña' autofocus><input type='button' class='btn btn-block btn-outline-primary' value='Aceptar' id='aceptar' onclick='verificarS();'>",
          html: true,
          showCancelButton: false,
          showConfirmButton: false,
        });
      }

    }

    function quitarS(){

      var ca = document.getElementById("cantidad").value;
      var ref = document.getElementById("ref").value;

      event.preventDefault();

      if(ca==='' || ref===''){
        swal("Error", "Llene todos los campos", "error");
      }else{
        swal({
          title: "<h5 style='color: gray'>Confirme su contraseña</h5>",
          text: "<input type='password' class='form-control' id='contra_conf' placeholder='Contraseña' autofocus><input type='button' class='btn btn-block btn-outline-primary' value='Aceptar' id='aceptar' onclick='verificarS();'>",
          html: true,
          showCancelButton: false,
          showConfirmButton: false,
        });
      }

    }

    function regCat(){
      var n = document.getElementById("nombre").value;
      var des = document.getElementById("desc").value;
      if(n==='' || des===''){
        swal("Error", "Llene todos los campos", "error");
        event.preventDefault();
      }else{
        swal("Listo", "Categoria registrada", "success");
        $("#agregar").click();
      }
    }

    function modiCat(){

      var n = document.getElementById("nombre").value;
      var des = document.getElementById("desc").value;

      event.preventDefault();
     
      if(n==='' || des===''){
          swal("Error", "Llene todos los campos", "error");
      }else{
          swal({
          title: "<h5 style='color: gray'>¿Seguro que quiere modificar esta categoría?</h5>",
          text: "<input type='password' class='form-control' id='contra_conf' placeholder='Contraseña' autofocus><input type='button' class='btn btn-block btn-outline-primary' value='Aceptar' id='aceptar' onclick='verificarS();'>",
          html: true,
          showCancelButton: false,
          showConfirmButton: false,
        });
      }
    }

    function modiUsuarioT(){

      var n = document.getElementById("nombre").value;
      var u = document.getElementById("usuario").value;
      var c = document.getElementById("contra").value;

      event.preventDefault();
     
      if(n==='' || u==='' || c===''){
          swal("Error", "Llene todos los campos", "error");
      }else{
          swal({
          title: "<h5 style='color: gray'>¿Seguro que quiere modificar este usuario?</h5>",
          text: "<input type='password' class='form-control' id='contra_conf' placeholder='Contraseña' autofocus><input type='button' class='btn btn-block btn-outline-primary' value='Aceptar' id='aceptar' onclick='verificarU();'>",
          html: true,
          showCancelButton: false,
          showConfirmButton: false,
        });
      }
    }
    var cont = 0;
    var lista="";
    var lista2="";
    var precio_total=0;

    function agP(){
      var can = document.getElementById("cant").value;
      var pr = document.getElementById("p");
      var ppp = document.getElementById("precio");
      if(cont==0){
        if(can != ''){
           var id = $("#productos").val();
           var nombre = $("#productos option:selected").html();
           var stock = nombre.split(",");
           if(parseInt(stock[2])<parseInt(can)){
              swal("Error", "Stock Insuficiente", "error");
              event.preventDefault();
           }else{
               lista2 = lista2 + id + " , " + nombre + " , " + can + "$";
               pr.value=lista2;
               cont++;
               var precio = nombre.split(",");
               var mult = parseFloat(precio[1]) * parseInt(can);
               precio_total = precio_total + mult;
               ppp.value=precio_total;
               fila="<tr><td>"+precio[0]+"</td><td>"+can+"</td><td>"+mult+"</td></tr>";
               document.getElementById("t").insertRow(-1).innerHTML=fila;
           }

        }else{
          swal("Error", "Ingrese una cantidad", "error");
          event.preventDefault();
        }

      }else{
        if(can != ''){
          var id = $("#productos").val();
          var nombre = $("#productos option:selected").html();
          var stock = nombre.split(",");
          if(parseInt(stock[2])<parseInt(can)){
              swal("Error", "Stock Insuficiente", "error");
              event.preventDefault();
          }else{
              lista2 = lista2 + id + " , " + nombre + " , " + can;
              pr.value=lista2;
              cont++;
              var precio = nombre.split(",");
              var mult = parseFloat(precio[1]) * parseInt(can);
              precio_total = precio_total + mult;
              ppp.value=precio_total;
              fila="<tr><td>"+precio[0]+"</td><td>"+can+"</td><td>"+mult+"</td></tr>";
              document.getElementById("t").insertRow(-1).innerHTML=fila;
          }
        }else{
          swal("Error", "Ingrese una cantidad", "error");
          event.preventDefault();
        }
      }
    }

    function regiP(){
      event.preventDefault();

      if(lista2===''){
        swal("Error", "Ingrese al menos un producto", "error");
      }else{
           swal({
              title: "<h5 style='color: gray'>Confirme la venta</h5>",
              text: "<input type='password' class='form-control' id='contra_conf' placeholder='Contraseña' autofocus><input type='button' class='btn btn-block btn-outline-success' value='Aceptar' id='aceptar' onclick='verificarV();'>",
              html: true,
              showCancelButton: false,
              showConfirmButton: false,
            });
      }
      
    }

</script>
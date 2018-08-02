<!doctype html>
<html lang="en" >
  <head>
    <script src="views/dist/sweetalert.js"></script>
    <script src="views/dist/sweetalert.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
    <link rel="stylesheet" href="views/css/buttons.dataTables.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body style="background-color: #E8ECEF">
      <?php
        //se validan los tipos de action que hay ya que existen dos menus de navegacion diferentes
        if(isset($_GET["action"]) && $_GET["action"]!="salir" && $_GET["action"]!="error" && $_GET["action"]!="iniciousuario" && $_GET["action"]!="sesiones2" && $_GET["action"]!="nuevasesion2"){
            include("modules/navegacion.php");
        }else{
          if(isset($_GET["action"])){

            if($_GET["action"]=="iniciousuario" || $_GET["action"]=="sesiones2" || $_GET["action"]=="nuevasesion2"){
              include("modules/navegacion2.php");
            }
          }
        }
      ?>
      <?php
        session_start();
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
<script type="text/javascript">
  //Funcion que trae las variables de la url
  function getUrlVars() {
      var vars = {};
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
          vars[key] = value;
      });
      return vars;
    }

  //funcion de confirmacion de cierre de sesion, muestra un sweet alert para saber si estamos completamente seguros
  //de cerrar la sesiobn
  function confirmarSesion()
  {
    event.preventDefault();
    swal({
      title: "Cerrar sesión",
      text: "¿Seguro que deseas cerrar la sesión?",
      type: "warning",
      showCancelButton: true,
      cancelButtonText: "Cancelar",
      confirmButtonClass: "btn-info",
      confirmButtonText: "Si, estoy seguro",
      closeOnConfirm: false
    },
    function(){
      window.location = 'index.php?action=salir';
    });
  }

  function versp()
  {
    event.preventDefault();
    swal({
      title: "Soporte",
      text: "Llama al 1740336 para cualquier duda.",
      type: "info",
      showCancelButton: true,
      cancelButtonText: "Cerrar",
      showConfirmButton: false
    });
  }

  function verob()
  {
    event.preventDefault();
    swal({
      title: "Objetivo",
      text: "El principal objetivo de este sistema es centralizar las sesiones de estudio que realizan los alumnos de la Universidad Politécnica de Victoria con el fin de administrar y contabilizar las horas que estos realizan en cada unidad.",
      type: "info",
      showCancelButton: true,
      cancelButtonText: "Cerrar",
      showConfirmButton: false
    });
  }

  function verCAI()
  {
    event.preventDefault();
    swal({
      title: "¿Qué es CAI?",
      text: "Centro de Aprendizaje de Inglés de la Universidad Politécnica de Victoria es el departamento que permite a los alumnos desarrollarse en la lenguaje de inglés, esto con la finalidad de generar el hábito de aprender nuevos idiomas que serán de mucha ayuda en su futuro como profesionistas.",
      type: "info",
      showCancelButton: true,
      cancelButtonText: "Cerrar",
      showConfirmButton: false
    });
  }

  //Funcion de jscript que se encarga de mandar un mensaje para saber si estamos seguros de actualizar algun registro, posteriormente pide
  //la contrasena del usuario para validar que este es el que desea hacer la actualizacion
  function confirmarUpdate(){
    var dbPassword = "<?php echo $_SESSION['password'] ?>";
    event.preventDefault();
    swal({
      title: "Confirmar acción",
      text: "<p>Ingresa tu contraseña para guardar los cambios</p><br><input type='password' class='form-control' id='pass' placeholder='Contraseña' autofocus><label id='err_sa' style='color:red'></label><br>",
      html: true,
            
      type: "warning",
      showCancelButton: true,
      cancelButtonText: "Cancelar",
      confirmButtonText: "Confirmar",
      closeOnConfirm: false,
      inputPlaceholder: "Contraseña",
      inputValidator: (value) => {
        return !value && 'No puedes dejar el campo vacio!'
      }
    },function () {
        var inputValue = document.getElementById("pass").value;
        if (inputValue === false) return false;
        if (inputValue != dbPassword) {
          document.getElementById("err_sa").innerHTML = "Contraseña incorrecta";
          return false
        }
        $( "#btn" ).click();
          swal("Exito!", "Registro modificado", "success");
        });
    }
 
  //Funcion de jscript que manda un mensaje para saber si estamos seguros de reiniciar todas las sesiones del cuatrimestre, posteriormente
  //pide la password del superadmin
  function confirmarReset(){
    var dbPassword = "<?php echo $_SESSION['password'] ?>";
    event.preventDefault();
    swal({
      title: "ALTO!",
      text: "<p>Estas a punto de <strong>REINICIAR TODOS</strong> los registros de sesiones de CAI. Ingresa tu contraseña para continuar</p><br><input type='password' class='form-control' id='pass' placeholder='Contraseña' autofocus><label id='err_sa' style='color:red'></label><br>",
      html: true,
            
      type: "error",
      showCancelButton: true,
      cancelButtonText: "Cancelar",
      confirmButtonText: "Confirmar",
      closeOnConfirm: false,
      inputPlaceholder: "Contraseña",
      inputValidator: (value) => {
        return !value && 'No puedes dejar el campo vacio!'
      }
    },function () {
        var inputValue = document.getElementById("pass").value;
        if (inputValue === false) return false;
        if (inputValue != dbPassword) {
          document.getElementById("err_sa").innerHTML = "Contraseña incorrecta";
          return false
        }
          var url = document.getElementById("btn1").href;
          window.location = url;
          swal("Exito!", "Sistema reiniciado", "success");
      
        });
    }
    //Funcion de JSCRIPT para confirmar si queremos borrar un registro y nos pida la contrasena
    //para hacerlo
    function confirmarDelete(id){
      var dbPassword = "<?php echo $_SESSION['password'] ?>";
      event.preventDefault();
      swal({
        title: "Confirmar acción",
        text: "<p>Ingresa tu contraseña para borrar el registro</p><br><input type='password' class='form-control' id='pass' placeholder='Contraseña' autofocus><label id='err_sa' style='color:red'></label><br>",
        html: true,
            
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonText: "Confirmar",
        closeOnConfirm: false,
        inputPlaceholder: "Contraseña",
        inputValidator: (value) => {
          return !value && 'No puedes dejar el campo vacio!'
        }
      },function () {
          var inputValue = document.getElementById("pass").value;
          if (inputValue === false) return false;
          if (inputValue != dbPassword) {
            document.getElementById("err_sa").innerHTML = "Contraseña incorrecta";
            return false
          }
          var url = document.getElementById("btn"+id).href;
          window.location = url;
          swal("Exito!", "Registro eliminado", "error");
        });

    }
    //Funcion de JSCRIPT que nos muestra un mensaje para saber si estamos seguro de liberar al alumno, donde nos dice si la sesion ha terminado
    //o le falta tiempo para terminar, tambien nos dice cuantas horas hemos hecho o si nos pasamos del limite, o en el caso de que
    //la sesion no haya terminado entonces nos dice que no se contara la hora de la sesion no terminada
    function confirmarSalida(id){
      event.preventDefault();
      
      //Operaciones que se hace para saber cuantas horas se han hecho en base a los minutos que han pasado desde la hora de entrada
      //y la hora en la que estamos (LO MISMO QUE EN PHP)
      var now = new Date();
      var mins = now.getMinutes();
      var hours = now.getHours();
      var e = document.getElementById("hora").innerText;
      var studentHours = e.split(":");
      var h = studentHours[0]+"00"
      var start_time = studentHours[0]+"00";
      var end_time =hours+""+mins;
      var start_hour = start_time.slice(0, -2);
      var start_minutes = start_time.slice(-2);

      var end_hour = end_time.slice(0, -2);
      var end_minutes = end_time.slice(-2);

      var startDate = new Date(0,0,0,start_hour, start_minutes);
      var endDate = new Date(0,0,0,end_hour, end_minutes);

      var millis = endDate - startDate;
      var minutes = millis/1000/60;

      var valMax = 10000;
      //Arreglo para saber los minutos de las horas que hay en cada hora y saber cuales minutos se acercan mas, asi conociendo
      //la hora a la que esta mas cerca el alumno (MISMO QUE EN PHP)
      var max = [60,120,180,240,300,360,420];
      var hora = 0;
      for(i = 0; i<max.length;i++){
        var op = max[i] - minutes;
        if(op < valMax && op>-1){
          valMax = max[i] - minutes;
          hora = i+1;
        }
      }
      
      //Si se desea salir antes de que termine la sesion, (tolerancia: 10 mins) y no han pasado 4 horas entonces nos indica el mensaje
      //que la sesion no ha terminado y no se contara dicha hora
      if(max[hora-1] - minutes > 10 && hora<4){
        hora--;
        event.preventDefault();
        swal({
          title: "Confirmar acción",
          text: "<p>La sesion aun no ha terminado, si se libera ahora solamente habra hecho <strong>"+hora +" horas</strong></p>",
          html: true,   
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          confirmButtonText: "Confirmar",
          closeOnConfirm: false,
        },function () {
              var url = document.getElementById("btn"+id).href;
              window.location = url;
              swal("Exito!", "Alumno liberado", "success");
            }
        );

        //Si ya pasaron 4 horas entonces solo noes muestra el mensaje que la sesion ya no se tomara en cuenta
      }else if(hora >= 4){
         swal({
          title: "Vaya!",
          text: "El tiempo limite ha pasado (4 horas), las horas no se tomaran en cuenta",
          html: true,   
          type: "warning",
          confirmButtonText: "Ok",
          closeOnConfirm: false,
        },function () {
              var url = document.getElementById("btn"+id).href;
               window.location = url;
            }
        );
        
      }
      //De lo contrario se registrara la sesion
      else{
        var url = document.getElementById("btn"+id).href;
        window.location = url;
      }

 
  }

   
    //Funcion de javascript que permite saber si un alumno ya esta en el grupo para no registrarlo 2 veces
    function verifyStudentInGroup(id_g){
      var e = document.getElementById("alumno");
      var id = e.options[e.selectedIndex].value;
      var id_grupo = id_g;
      //Funcion AJAX que hace la consulta a la base de datos para saber si el alumno se eneucntra en el grupo que se desea registrar
      $.ajax({
        url:'models/check.php',
        method:"POST",
        data:{check_id : id, check_id2 : id_grupo},
        success: function(data){
          //Dicha funcion regresa un valor booleano, si regresa un verdadero entonces solo se muestra una sweet alert para advertir que el alumno
          //se encuentra en este grupo
          if(data == 1){
            swal("Error", "Ya existe el alumno en este grupo", "warning");
          }
          else{
            //De lo contrario se manda llamar otro metodo de jscript para registrar al alumno
            insertGroupTable(id_grupo);
          }
        },
        error: function(){
        }
      })
    }
  //Funcion de JSCRIPT para insertar al alumno en el grupo deseado
    function insertGroupTable(id){
      var e = document.getElementById("alumno");
      var id_alumno = e.options[e.selectedIndex].value;
      var id_grupo = id;

      //Funcion en AJAX para insertar al alumno en el grupo
      $.ajax({
        url:'models/check.php',
        method:"POST",
        data:{insert_alumno : id_alumno, insert_grupo : id_grupo},
        success: function(data){
          if(data){
            swal("Listo", "Alumno agregado!", "success");
            location.reload();
          }
          else{
          }
        },
        error: function(){
        }
      })
    }
    
  //Funcion de JSCRIPT para mostrar los profesores de cada alumno al cambiar los alumnos del select2 en la interfaz para registrar una sesion
    function showTeacherPerStudent(){
      var e = document.getElementById("alumno");
      var maestroSelect = document.getElementById("maestro");
      //Cada que cambie la opcion en el select2 entonces se limpiara el select2 de los profesores
      for (i = 0; i < maestroSelect.options.length; i++){
        maestroSelect.options[i] = null;
      }
      $('#maestro').empty().trigger("change")
      var id_alumno = e.options[e.selectedIndex].value;
      //Funcion en ajax para hacer la consulta de los profesores y ponerlos en un select2, donde se obtendran los resultados en un 
      //objeto tipo JSON ya que pueden ser varios profesores
      $.ajax({
        url:'models/check.php',
        method:"POST",
        data:{id_alumno2 : id_alumno},
        success: function(data){
          if(data){
            //Se crea una opcion para el select2
            var opt = document.createElement('option');
            opt.value = "";
            opt.innerHTML = "Maestro...";
            maestroSelect.appendChild(opt);
            for(i = 0; i<data.length;i++){
              
              //Se insertan los profeores en el select2
              var opt = document.createElement('option');
              opt.value = data[i][1];
              opt.innerHTML = data[i][0];
              maestroSelect.appendChild(opt);
            }
            maestroSelect.options[0].selected=true;
          }
          else{
          }
        },
        error: function(){
        },
        dataType:"json"
      })
      //Funcion en ajax para cada que cambie el alumno, cambie la foto que esta registrada en la base de datos, y se muestre en la parte inferior
      //de la interfaz para registrar una sesion nueva
      $.ajax({
        url:'models/check.php',
        method:"POST",
        data:{checkImage : id_alumno},
        success: function(data){
          if(data){
            document.getElementById("myImg").src="uploads/"+data[0];

          }
          else{
          }
        },
        error: function(){
        },
        dataType:"json"
      })

    }

    //Funcion de jscript que nos permite conocer si un alumno ha llegado tarde a la sesion, teniendo como tolerancia solo 10 minutos, si se ha 
    //excedido este limite de tolerancia entonces no se hace ni una insercion en la tabla temporal sesion
    function detectStudentLate(){
      var now = new Date();
      var mins = now.getMinutes();
      if(mins>10){
        swal("Error", "Los minutos de tolerancia se han agotado", "warning");
        event.preventDefault();
      }
      //Si no ha excedido el limite de los 10 minutos entonces se hace una consulta para saber si el alumno ya esta en una sesion
      else{
        var id_alumno_sesion = document.getElementById("alumno").value;
        $.ajax({
          url:'models/check.php',
          method:"POST",
          data:{id_alumno_sesion : id_alumno_sesion},
          success: function(data){
            if(data){
              //Si la consulta regreso un verdadero entonces solo nos muestra un sweet alert diciendo que este alumno ya esta en sesion
              if(data == 1){
                swal("Error!", "El alumno ya se encuentra en sesion", "error");
              }
              //De lo contrario se procede a consultar si la actividad que desea se encuentra disponible
              else{
                checkAvailability();
              }
            }
            else{
            }
          },
          error: function(){
          },
          //dataType:"json"
      })

      }

    }

  //Funcion de JSCRIPT para conocer si la actividad a la que desea entrar el usuario esta disponible
    function checkAvailability(){
      var actSelect = document.getElementById("act");
      var id_actividad = actSelect.options[actSelect.selectedIndex].value;
      //Funcion AJAX para conocer cuantos lugares hay de dicha actividad
      $.ajax({
        url:'models/check.php',
        method:"POST",
        data:{id_actividad : id_actividad},
        success: function(data){
          if(data){
            //Si los lugares es mayor a 0 entonces se registra la sesion
            if(data>0){
              registrarSesion(data);
            //De lo contrario solo nos muestra un sweet alert que la actividad ya no se encuentra disponible
            }else{
              swal("Error!", "Esta actividad ya no esta disponible", "error");
            }
          }
        },
        error: function(){
        },
          //dataType:"json"
      })
    }

  //Funcion de JSCRIPT para registrar la sesion en su respectiva tabla temporal teniendo como parametros todos lo datos de la sesion
    function registrarSesion(lugarNuevo){
      var alumnoSelect = document.getElementById("alumno");
      var id_alumno = alumnoSelect.options[alumnoSelect.selectedIndex].value;
      var maestroSelect = document.getElementById("maestro");
      var id_maestro = maestroSelect.options[maestroSelect.selectedIndex].value;
      var actSelect = document.getElementById("act");
      var id_actividad = actSelect.options[actSelect.selectedIndex].value;
      var fecha = document.getElementById("fecha").value
      var hora_entrada = document.getElementById("entrada").value;
      var unidad = document.getElementById("unidad").value;
      var lugares = lugarNuevo;

      if(!(id_alumno=="" && id_maestro=="")){
        //Funcion AJAX para registrar la sesion, donde se restara la actividad que se eligio de la columna lugares
        $.ajax({
        url:'models/check.php',
        method:"POST",
        data:{id_alumno_sesion2 : id_alumno, id_maestro_sesion : id_maestro, id_actividad_sesion : id_actividad, fecha_sesion : fecha, hora_entrada_sesion : hora_entrada, unidad_sesion : unidad, lugares: lugares},
        success: function(data){
          swal("Listo", "Sesion registrada!", "success");
          //window.location='index.php?action=sesiones';
          
        },
        error: function(){
        },
      })
      }
      else{
        swal("Error!", "Elige un Alumno y Profesor", "error");
      }
    }


    

</script>
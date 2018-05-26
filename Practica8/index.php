<?php
	//Se carga el modelo enlaces para la navegacion del sitio
	require_once "models/enlaces.php";
  //Se carga el crud que contiene todos los modelos que utilizan los controllers
	require_once "models/crud.php";
  //Se carga el controller principal que hace posible la funcionalidad del sito
	require_once "controllers/controller.php";

  //Se crea una instancia del controler
	$mvc = new MvcController();
  //Se manda a llamar el metodo que carga el template del sitio
	$mvc->pagina();
?>

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
          //Se inicializan variables globales
          var alumnos="";
          var nombres="";
          var cont=0;
          //Este metodo se ejecuta cada que el usuario agrega un alumno a una tutoria
         function agregar(){
         	cont++;
          //Se cargan los elementos
         	var s = document.getElementById("alumnos");
         	var h = document.getElementById("sc");
         	var al = document.getElementById("a");
          //Se obtiene valores de select2
         	var v = $('#alumnos').val();
         	var t = $('#alumnos :selected').text();
          //Se acumulan los alumnos agregados y se almacenan en un imput
         	if(cont>1){
         		var t = document.createElement("h3");
         		alumnos = alumnos + "," + v;
         		al.innerHTML="Alumnos añadidos: "+cont;
         	}else{
         		alumnos = alumnos + v;
         		al.innerHTML="Alumnos añadidos: "+cont;
         	}
            h.value=alumnos;
         }
</script>
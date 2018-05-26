<?php
	//se inicia sesion
	session_start();
	//se valida la sesion
	if(!$_SESSION["validar"]){
		//Si no esta loggeado manda al login
		header("location:index.php?action=ingresar");
		exit();
	}
?>
<form style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Reportes</h1>
	<hr>
	<br>
	<h3>Alumnos</h3>
	<hr>
	<table id="example" class="display" width="100%">
		<thead>
			<th>Matricula</th>
			<th>Nombre</th>
			<th>Carrera</th>
			<th>Tutor</th>
		</thead>
		<tbody>
			<?php
			//Se instancea el controlador
			$vistaAlumno = new MvcController();
			//Se manda a llamar el controlador de la vista
			$vistaAlumno -> vistaAController();
			?>

		</tbody>
	</table>
	<br>
	<h3>Maestros</h3>
	<hr>
	<table id="example2" class="display" width="100%">
		<thead>
			<th>Id</th>
			<th>Nombre</th>
			<th>Carrera</th>
			<th>Correo</th>
			<th>Contraseña</th>
		</thead>
		<tbody>
			<?php
			//Se instancea el controlador
			$vistaMaestro = new MvcController();
			//Se manda a llamar el controlador de la vista
			$vistaMaestro -> vistaMController();
			?>

		</tbody>
	</table>
	<br>
	<h3>Carreras</h3>
	<hr>
	<table id="example3" class="display" width="100%">
		<thead>
			<th>Id</th>
			<th>Nombre</th>
			<th>Siglas</th>
		</thead>
		<tbody>
			<?php
			//Se instancea el controlador
			$vistaCarrera = new MvcController();
			//Se manda a llamar el controlador de la vista
			$vistaCarrera -> vistaCController();
			?>

		</tbody>
	</table>
	<br>
	<h3>Tutorias</h3>
	<hr>
	<table id="example4" class="display" width="100%">
		<thead>
			<th>Tutor</th>
			<th>Hora</th>
			<th>Fecha</th>
			<th>Tutoria</th>
		</thead>
		<tbody>
			<?php
			//Se instancea el controlador
			$vistaTutoria = new MvcController();
			//Se manda a llamar el controlador de la vista
			$vistaTutoria -> vistaTController();
			?>

		</tbody>
	</table>
</form>



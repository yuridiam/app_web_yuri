<?php
	//Se inicia la sesion
	session_start();
	//Se valida la sesion y si no esta loggeado no lo deja entrar
	if(!$_SESSION["validar"]){
		//se dirige al login
		header("location:index.php?action=ingresar");
		exit();
	}

?>
<form style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Alumnos</h1>
	<hr>
	<br>
	<a href="index.php?action=registraralumno"><input type="button" name="agregarAlumno" class="button tiny" style="background-color: black" value="Agregar"></a>
	<br>
	<br>
	<table id="example" class="display" width="100%">
		<thead>
			<th>Matricula</th>
			<th>Nombre</th>
			<th>Carrera</th>
			<th>Tutor</th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			<?php
			//se crea una instancia del controlador
			$vistaAlumno = new MvcController();
			//se manda a llamar el controlador de la vista
			$vistaAlumno -> vistaAlumnosController();
			//se manda a llamar el controlador de borrar
			$vistaAlumno -> borrarAlumnoController();

			?>

		</tbody>
	</table>
</form>



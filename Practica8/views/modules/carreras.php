<?php
	//Se inicia sesion
	session_start();
	//Se valida la sesion
	if(!$_SESSION["validar"]){
		//Si no esta loggeado manda al login
		header("location:index.php?action=ingresar");
		exit();
	}

?>
<form style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Carreras</h1>
	<hr>
	<br>
	<a href="index.php?action=registrarcarrera"><input type="button" name="agregarCarrera" class="button tiny" style="background-color: black" value="Agregar"></a>
	<br>
	<br>
	<table id="example" class="display" width="100%">
		<thead>
			<th>Id</th>
			<th>Nombre</th>
			<th>Siglas</th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			<?php
			//Se crea una nueva instancia del controlador
			$vistaCarrera = new MvcController();
			//Se manda a llamar el controlador de la vista
			$vistaCarrera -> vistaCarrerasController();
			//Se manda a llamar el controlador de borrar
			$vistaCarrera -> borrarCarreraController();

			?>

		</tbody>
	</table>
</form>



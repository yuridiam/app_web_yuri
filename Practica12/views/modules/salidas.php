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
	<h1 style="font-weight: bold">Salidas</h1>
	<hr>
	<br>
	<a href="index.php?action=registrarsalida"><input type="button" name="agregarSalida" class="button tiny" style="background-color: #00715F" value="Agregar Salida"></a>
	<br>
	<br>
	<table id="example" class="display" width="100%">
		<thead>
			<th>Id</th>
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Ubicación</th>
			<th>Fecha</th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			<?php
			//Se crea una nueva instancia del controlador
			
			//Se manda a llamar el controlador de la vista
			
			//Se manda a llamar el controlador de borrar

			?>

		</tbody>
	</table>
</form>
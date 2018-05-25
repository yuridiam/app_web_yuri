<?php
	//se inicia sesion
	session_start();
	//se valida la sesion
	if(!$_SESSION["validar"]){
		//Si no esta loggeado manda al login
		header("location:index.php?action=ingresar");
		exit();
	}
	//Se almacenan las variables del url
	if(isset($_GET["id"])){
		$id = $_GET["id"];
	}
	if(isset($_GET["iddos"])){
		$id2 = $_GET["iddos"];
	}

?>
<label style="margin-left: 850px">Bienvenido, <?php echo $id?></label>
<form style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Tutorías</h1>
	<hr>
	<br>
	<a href="index.php?action=registrartutoria&id=<?php echo $id;?>&iddos=<?php echo $id2;?>"><input type="button" name="agregarAlumno" class="button tiny" style="background-color: black" value="Agregar"></a>
	<br>
	<br>
	<table id="example" class="display" width="100%">
		<thead>
			<th>Hora</th>
			<th>Fecha</th>
			<th>Tutoria</th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			<?php
			//Se instancea el controlador
			$vistaTutoria = new MvcController();
			//Se llama el controlador de vista
			$vistaTutoria -> vistaTutoriasController();
			//Se llama el controlador de borrar
			$vistaTutoria -> borrarTutoriaController();

			?>

		</tbody>
	</table>
</form>



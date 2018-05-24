<?php

	session_start();

	if(!$_SESSION["validar"]){

		header("location:index.php?action=ingresar");

		exit();

	}
	$id = $_GET["id"];
	$id2 = $_GET["iddos"];

?>
<form style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Tutorías</h1>
	<hr>
	<br>
	<a href="index.php?action=registrartutoria&id=<?php echo $id;?>&iddos=<?php echo $id2;?>"><input type="button" name="agregarAlumno" class="button tiny" style="background-color: black" value="Agregar"></a>
	<br>
	<br>
	<table id="example" class="display" width="100%">
		<thead>
			<th>Maestro</th>
			<th>Hora</th>
			<th>Fecha</th>
			<th>Tutoria</th>
			<th>Tipo</th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			<?php

			//$vistaTutoria = new MvcController();
			//$vistaTutoria -> vistaAlumnosController();
			//$vistaTutoria -> borrarAlumnoController();

			?>

		</tbody>
	</table>
</form>



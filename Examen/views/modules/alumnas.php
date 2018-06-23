<?php
//Se inicia la sesion
session_start();
//Se valida que la sesion este iniciada
if(!$_SESSION["validar"]){
	//Si no se inicia la sesion se dirige al login
	header("location:index.php?action=ingresar");

	exit();

}

?>

<div style="width: 80%; margin-left: 130px">
<h3 align="center">Alumnas <b>Registradas</b></h3>
<br>
<a href="index.php?action=agregaralumna"><input type="button" name="agregarA" id="agregarA" class="button tiny" style="background-color: #853BBE; margin-left: 1040px; width: 5%; font-size: 1.5em; font-weight: bold" value="+"></a>
<table id="example">
	<thead>
		<th>Id</th>
		<th>Nombre</th>
		<th>Apellidos</th>
		<th>Grupo</th>
		<th>Fecha de Nacimiento</th>
		<th></th>
		<th></th>
	</thead>
	<tbody>
		<?php
			//Ejecucion de controladores
			$vistaAlumnas = new MvcController();
			$vistaAlumnas->vistaAlumnasController();

		?>
	</tbody>
</table>
</div>

<?php
	//Ejecucion de controladores
	$eliminarA = new MvcController();
	$eliminarA->eliminarAlumnaController();

?>
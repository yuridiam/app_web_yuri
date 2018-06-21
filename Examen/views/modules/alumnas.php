<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<div style="width: 80%; margin-left: 130px">
<h3 align="center">Alumnas <b>Registradas</b></h3>
<br>
<a href="index.php?action=agregaralumna"><input type="button" name="agregarA" id="agregarA" class="button tiny" style="background-color: #853BBE; margin-left: 905px; width: 18%" value="Agregar"></a>
<table id="example">
	<thead>
		<th>Id</th>
		<th>Nombre</th>
		<th>Grupo</th>
		<th>Apellidos</th>
		<th>Fecha de Nacimiento</th>
		<th></th>
		<th></th>
	</thead>
	<tbody>
		
	</tbody>
</table>
</div>
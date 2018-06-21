<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>
<div style="margin-left: 300px">
<form method="post" class="form-control" style="width: 70%">
	<h3 align="center">Registro de <b> Alumna</h3>
	<br><br>
	<input type="text" name="n" id="n" placeholder="Nombre(s)">
	<input type="text" name="a" id="a" placeholder="Apellidos">
	<select class="js-example-basic-single" name="grupo" id="grupo" style="width: 100%">

	</select>
	<br><br>
	<label>Fecha de Nacimiento</label>
	<input type="date" name="fechaNac" id="fechaNac" placeholder="Fecha de nacimiento">
	<input type="submit" class="button tiny" name="aceptar" id="aceptar" value="Aceptar" style="width: 100%; background-color: #853BBE">
</form>
</div>
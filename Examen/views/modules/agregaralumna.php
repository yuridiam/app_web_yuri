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
<div style="margin-left: 300px">
<form method="post" class="form-control" style="width: 70%">
	<h3 align="center">Registro de <b> Alumna</h3>
	<br><br>
	<input type="text" name="n" id="n" placeholder="Nombre(s)">
	<input type="text" name="a" id="a" placeholder="Apellidos">
	<select class="js-example-basic-single" name="grupo" id="grupo" style="width: 100%">
		<?php 
			//Ejecucion de controladores
			$grupos = new MvcController();
			$grupos->verGruposController();
		?>
	</select>
	<br><br>
	<label>Fecha de Nacimiento</label>
	<input type="date" name="fechaNac" id="fechaNac" placeholder="Fecha de nacimiento">
	<input type="submit" class="button tiny" name="aceptar" id="aceptar" value="Aceptar" style="width: 100%; background-color: #853BBE">
</form>
</div>

<?php
	//Ejecucion de controladores
	$registrarA = new MvcController();
	$registrarA->registrarAlumnaController();
?>
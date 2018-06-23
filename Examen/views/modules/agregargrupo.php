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
	<h3 align="center">Registro de <b> Grupo</h3>
	<br><br>
	<input type="text" name="nombreG" id="nombreG" placeholder="Nombre del grupo">
	<input type="submit" class="button tiny" name="aceptar" id="aceptar" value="Aceptar" style="width: 100%; background-color: #853BBE" required>
</form>
</div>

<?php
	//Ejecucion de controladores
	$registrarG = new MvcController();
	$registrarG->registrarGrupoController();
?>
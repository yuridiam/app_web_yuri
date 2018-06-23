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
	<h3 align="center">Modificar <b> Grupo</h3>
	<br><br>
	<?php
		//Ejecucion de controladores
		$editarG = new MvcController();
		$editarG->editarGrupoController();
	?>
</form>
</div>

<?php
		//Ejecucion de controladores
		$modificarG = new MvcController();
		$modificarG->modificarGrupoController();
?>
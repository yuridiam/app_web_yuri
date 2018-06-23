<?php
//Se inicia la sesion
session_start();
//Se valida que la sesion este iniciada
if(!$_SESSION["validar"]){
	//Si no se inicia la sesion se dirige al login
	header("location:index.php?action=ingresar");
	exit();
}

//Ejecucion de controladores
$cargarA = new MvcController();
$alumnas = $cargarA->cargarAluController();

?>

<div style="margin-left: 300px">
<form method="post" class="form-control" style="width: 70%">
	<h3 align="center">Modificar <b> Pago</h3>
	<br><br>
	<?php
		//Ejecucion de controladores
		$editarP = new MvcController();
		$editarP->editarPagoController();
	?>
</form>
<input type="hidden" name="alu" id="alu" value="<?php echo $alumnas ?>">
</div>

<?php
		//Ejecucion de controladores
		$modificarP = new MvcController();
		$modificarP->modificarPagoController();
?>
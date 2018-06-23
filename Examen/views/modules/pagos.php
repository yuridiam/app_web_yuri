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
<h3 align="center">Pagos <b>Realizados</b></h3>
<br>
<table id="example">
	<thead>
		<th>Id</th>
		<th>Alumna</th>
		<th>Grupo</th>
		<th>Mamá</th>
		<th>Fecha de pago</th>
		<th>Fecha de envío</th>
		<th>Imágen</th>
		<th>Folio</th>
		<th></th>
		<th></th>
	</thead>
	<tbody>
		<?php
			$vistaPagos = new MvcController();
			$vistaPagos->vistaPagosController();
		?>
	</tbody>
</table>
</div>

<?php
	$eliminarP = new MvcController();
	$eliminarP->eliminarPagoController();

?>
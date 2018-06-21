<?php

session_start();

if(!$_SESSION["validar"]){

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
		
	</tbody>
</table>
</div>
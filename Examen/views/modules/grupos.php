<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<div style="width: 80%; margin-left: 130px">
<h3 align="center">Grupos <b>Registrados</b></h3>
<br>
<a href="index.php?action=agregargrupo"><input type="button" name="agregarG" id="agregarG" class="button tiny" style="background-color: #853BBE; margin-left: 905px; width: 18%" value="Agregar">
<table id="example"></a>
	<thead>
		<th>Id</th>
		<th>Nombre</th>
		<th></th>
		<th></th>
	</thead>
	<tbody>
		
	</tbody>
</table>
</div>
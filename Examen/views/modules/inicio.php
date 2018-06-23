<?php
	//Ejecucion de controladores
	$cargarA = new MvcController();
	$alumnas=$cargarA->cargarAluController();
	
?>
<div style="margin-left: 300px">
<form method="post" class="form-control" style="width: 70%" enctype="multipart/form-data">
	<h3 align="center">Formulario de envío de Comprobantes <br> Festival Verano 2018</h3>
	<br>
	<label>Grupo</label>
	<select class="js-example-basic-single" name="grupo" id="grupo" style="width: 100%" onchange="act();">
		<?php
			//Ejecucion de controladores
			$grupos = new MvcController();
			$grupos->verGruposAController();
		?>
	</select>
	<label>Alumna</label>
	<select class="js-example-basic-single" name="alumna" id="alumna" style="width: 100%" hidden="true">
	</select>
	<br><br>
	<label>Nombre de la madre</label>
	<div id="contenido">
		<div id="izquierda" class="izquierda">
			<input type="text" name="nombreM" id="nombreM" required placeholder="Nombre" style="width: 350px">
		</div>
		<div id="derecha" class="derecha">
			<input type="text" name="apellidoM" id="apellidoM" required placeholder="Apellidos" style="width: 350px; margin-left: -150px">
		</div>
	</div><br><br><br>
	<label>Fecha de pago</label>
	<input type="date" name="fechaPago" id="fechaPago" placeholder="Fecha de pago">
	<label>Comprobante de folio</label>
	<input type="file" name="fileToUpload" id="fileToUpload" placeholder="Imágen de comprobante">
	<label>Folio de autorización</label>
	<input type="text" name="folio" id="folio" required placeholder="Folio de autorización">
	<input type="submit" class="button tiny" name="aceptar" id="aceptar" value="Aceptar" style="width: 100%; background-color: #853BBE">
</form>
<input type="hidden" name="alu" id="alu" value="<?php echo $alumnas ?>">
</div>

<?php
	//Ejecucion de controladores
	$regPago = new MvcController();
	$regPago->registrarPagoController();
?>
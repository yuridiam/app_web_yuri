<div style="width: 80%; margin-left: 130px">
<h3 align="center">Orden de envios de Comprobantes <br> Festival Verano 2018</h3>
<table id="example">
	<thead>
		<th>Lugar</th>
		<th>Folio</th>
		<th>Nombre Alumna</th>
		<th>Grupo</th>
		<th>Nombre Mama</th>
		<th>Fecha de Pago</th>
		<th>Fecha de Envío</th>
	</thead>
	<tbody>
		<?php
			//Ejecucion de controladores
			$lugares = new MvcController();
			$lugares->vistaLugaresController();
		?>
	</tbody>
</table>
</div>

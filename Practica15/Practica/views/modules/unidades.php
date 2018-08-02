<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <div class="row">
        <div class="col-xs-12 col-sm-4">
			      <h1><a style="font-weight: bold; font-size: 1.3em">UNIDADES</a></h1>
        </div>
      </div>
			<hr>
      <form id="formu" method="post" name="formu" enctype="multipart/form-data">
        <button type="submit" id="btn" onclick="confirmarUpdate();" name="guardar" style="width: 20%; margin-left: 850px" class="btn btn-primary">Guardar</button>
        <br><br>
        <h2 style="font-weight: bold">PRIMER CUATRIMESTRE DEL AÑO</h2>
        <hr>
          <div class="form-row">
            <div class="form-group col-md-2">
              <label></label>
              <h2 style="font-weight: bold; color:#0087FF">Unidad 1</h2>
            </div>
            <div class="form-group col-md-3">
              <label for="fechainicio">Fecha Inicio</label>
              <?php
                $mvc = new MvcController();
                $mvc->vistaUnidadesController();
              ?>
            </div>
          </div>
      </form>
		</div>
	</div>
</div>
<?php
 $mvc->actualizarUnidadesController();
?>


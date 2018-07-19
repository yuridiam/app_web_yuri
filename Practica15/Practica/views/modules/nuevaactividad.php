<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <a href="index.php?action=actividades" class="badge badge-primary">Regresar</a>
      <br>
			<h1><a style="font-weight: bold; font-size: 1.3em">REGISTRAR ACTIVIDAD</a></h1>
			<hr>
      <?php
        if(isset($_SESSION["registrado"])){
          if($_SESSION["registrado"]==1){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Actividad Registrada Exitósamente
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
              $_SESSION["registrado"]=0;
          }
        }
        $_SESSION["registrado"]=0;

      ?>
			<br>
        <form id="formu" method="post" name="formu">
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="nombre">Nombre de la actividad</label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la actividad" required>
            </div>
            <div class="form-group col-md-6">
              <label for="desc">Descripción</label>
              <input type="text" class="form-control" id="desc" name="desc" placeholder="Descripción de la actividad" required>
            </div>
            <div class="form-group col-md-3">
              <label for="nombre">Lugares</label>
              <input type="number" max="30" min="1" class="form-control" id="lugares" name="lugares" required>
            </div>
          </div>
          <button type="submit" id="registrar" name="registrar" style="width: 100%" class="btn btn-primary">Registrar</button>
        </form>
			<br><br><br><br><br><br><br>
		</div>
	</div>
</div>

<?php

    $regAct = new MvcController();
    $regAct->registrarActividadController();

?>
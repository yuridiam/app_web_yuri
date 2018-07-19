<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <a href="index.php?action=actividades" class="badge badge-primary">Regresar</a>
      <br>
			<h1><a style="font-weight: bold; font-size: 1.3em">MODIFICAR ACTIVIDAD</a></h1>
			<hr>
      <?php
        if(isset($_SESSION["modificado"])){
          if($_SESSION["modificado"]==1){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Actividad Modificada Exitósamente
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
              $_SESSION["modificado"]=0;
          }
        }
        $_SESSION["modificado"]=0;

      ?>
			<br>
        <form id="formu" method="post" name="formu" enctype="multipart/form-data">
          <?php 

            $editarAct = new MvcController();
            $editarAct->editarActividadController();

          ?>
          <button type="submit" onclick="confirmarUpdate();" id="btn" name="modificar" style="width: 100%" class="btn btn-primary">Modificar</button>
        </form>
			<br><br><br><br><br><br><br>
		</div>
	</div>
</div>
<?php 

  $modificarAct= new MvcController();
  $modificarAct->modificarActividadController();

?>
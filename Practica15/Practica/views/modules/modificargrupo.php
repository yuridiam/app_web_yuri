<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <a href="index.php?action=grupos" class="badge badge-primary">Regresar</a>
      <br>
			<h1><a style="font-weight: bold; font-size: 1.3em">MODIFICAR GRUPO</a></h1>
			<hr>
      <?php
        if(isset($_SESSION["modificado"])){
          if($_SESSION["modificado"]==1){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Grupo Modificado Exitósamente. <a href='index.php?action=agregar_alumno&id=".$_GET['id']."' style='font-size: 1.1em'>¿Desea agregar alumnos a este grupo? De click aquí.</a>
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

            $editarGrupo = new MvcController();
            $editarGrupo->editarGrupoController();

          ?>
          <button type="submit" onclick="confirmarUpdate();" id="btn" name="modificar" style="width: 100%" class="btn btn-primary">Modificar</button>
        </form>
			<br><br><br><br><br><br><br>
		</div>
	</div>
</div>
<?php 

  $modificarGrupo = new MvcController();
  $modificarGrupo->modificarGrupoController();

?>
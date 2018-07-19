<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <a href="index.php?action=grupos" class="badge badge-primary">Regresar</a>
      <br>
			<h1><a style="font-weight: bold; font-size: 1.3em">REGISTRAR GRUPO</a></h1>
			<hr>
      <?php
        if(isset($_SESSION["registrado"])){
          if($_SESSION["registrado"]==1){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Grupo Registrado Exitósamente.
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
              <label for="codigo">Código del grupo</label>
              <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del grupo" required>
            </div>
           <div class="form-group col-md-7">
              <label for="maestro">Maestro</label>
              <select id="maestro" name="maestro" class="form-control select2">
                <?php
                    $verProfes = new MvcController();
                    $verProfes->mostrarProfesoresController();
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="nivel">Nivel</label>
              <select id="nivel" name="nivel" class="form-control select2">
                 <option value="1">1</option>
                 <option value="2">2</option>
                 <option value="3">3</option>
                 <option value="4">4</option>
                 <option value="5">5</option>
                 <option value="6">6</option>
                 <option value="7">7</option>
                 <option value="8">8</option>
                 <option value="9">9</option>
              </select>
            </div>
          </div><br>
          <button type="submit" id="registrar" name="registrar" style="width: 100%" class="btn btn-primary">Registrar</button>
        </form>
			<br><br><br><br><br><br><br>
		</div>
	</div>
</div>
<?php
    $regGrupo = new MvcController();
    $regGrupo->registrarGrupoController();
?>
<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
  <div class="jumbotron" >
    <div class="col-sm-10 mx-auto">
      <div class="row">
        <div class="col-xs-12 col-sm-10">
            <h1><a style="font-weight: bold; font-size: 1.3em">ALUMNOS EN GRUPO</a></h1>
        </div>

      </div>
      <hr>
      <?php
        if(isset($_SESSION["eliminado"])){
          if($_SESSION["eliminado"]==1){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Alumno Eliminado Exitósamente
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
              $_SESSION["eliminado"]=0;
          }
        }
        $_SESSION["eliminado"]=0;

      ?>
      <form id="formu" method="post" name="formu">
          <div class="form-row">
           <div class="form-group col-md-10">
              <label for="maestro">Alumno</label>
              <select  id="alumno" name="alumno" class="form-control select2">
                <?php
                    $verProfes = new MvcController();
                    $verProfes->mostrarAlumnoController();
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <input type="button" id="registrar" name="registrar" style="width: 100%; margin-top: 30px" onclick="verifyStudentInGroup(<?php echo $_GET['id']?>);" class="btn btn-primary" value="Registrar">
            </div>
          </div><br>
          
        </form>
      <br>
        <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Matricula</th>
                  <th>Alumno</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  <?php
                      //Creacion del objeto y llamado de sus objetos
                      $vistaGrupo = new MvcController();
                      $vistaGrupo->mostrarAlumnosGrupoController();
                  ?>
                </tbody>
              </table>
          </div>
      <br><br><br><br><br><br>
    </div>
  </div>
</div>
<?php
  $eliminarGrupo = new MvcController();
  $eliminarGrupo->eliminarAlumnoGrupoController();
?>
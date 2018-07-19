<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {}

#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
<br style="background-color: #E8ECEF ">
<div style="background-color: #E8ECEF ">
	<div class="jumbotron" >
		<div class="col-sm-10 mx-auto">
      <a href="index.php?action=sesiones2" class="badge badge-primary">Regresar</a>
      <br>
			<h1><a style="font-weight: bold; font-size: 1.3em">REGISTRAR SESIÓN</a></h1>
			<hr>
      <?php
        if(isset($_SESSION["registrado"])){
          if($_SESSION["registrado"]==1){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Sesión Registrado Exitósamente
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
            <div class="form-group col-md-5">
              <label for="alumno">Alumno</label>
              <select onchange="showTeacherPerStudent();" id="alumno" name="alumno" class="form-control select2">
              <option value="">Seleccione un alumno</option>
                <?php
                    $mostrarAlumno = new MvcController();
                    $mostrarAlumno->mostrarAlumnoController();
                ?>
              </select>
            </div>
            <div class="form-group col-md-5">
              <label for="act">Maestro</label>
              <select id="maestro" name="maestro" class="form-control select2">
              <option value="">Seleccione un maestro</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="act">Actividad</label>
              <select id="act" name="act" class="form-control select2">
                 <?php
                    $mostrarActividad = new MvcController();
                    $mostrarActividad->mostrarActividadController();

                 ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="fecha">Fecha</label>
              <input type="text" class="form-control" id="fecha" name="fecha" value = "<?php echo date("Y-m-d");?>" required readonly="">
            </div>
            <div class="form-group col-md-4">
              <label for="entrada">Hora de entrada</label>
              <input type="time" class="form-control" id="entrada" name="entrada" value="<?php echo date('H:i', strtotime('-7 hour'));?>" required readonly="">
            </div>
            <div class="form-group col-md-4">
              <label for="unidad">Unidad</label>
              <?php $mostrarActividad->getUnitByDateController();?>
            </div>
            <br>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="myImg">Fotografía del alumno</label><br>
                <img id="myImg" name="myImg" src="uploads/tumblr_p6z1zqAH5T1s13wj2o2_1280.jpg" alt="Fotografia de Alumno" style="width: 100px; height: 100px;">
              </div>
            </div>
            <!-- The Modal -->
            <div id="myModal" class="modal">
              <span class="close">&times;</span>
              <img class="modal-content" id="img01">
              <div id="caption"></div>
            </div>

          </div>
          <br>
          <button onclick="detectStudentLate();" type="button" id="registrar" name="registrar" style="width: 100%" class="btn btn-primary">Registrar</button>
        </form>
			<br><br><br><br><br><br><br>
		</div>
	</div>
</div>
<?php
  //$mostrarActividad->registrarSesionController();
?>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>

<?php
//Clase general que controla la comunicación entre la vista y el modelo
Class MvcController{

	//funcion que carga el template en primera instancia
	public function pagina(){	
		include "views/template.php";
	}

	//funcion que obtiene la action de la pagina para poder dirigirse a la pagina adecuada con la ayuda
	//del model en el crud de enlaces
	public function enlacesPaginasController(){
		//comprueba que el action este en la url de la pagina
		if(isset( $_GET['action'])){
			//almacena el action en una variable
			$enlaces = $_GET['action'];
		
		}else{
			//si no hay action se ingresa index
			$enlaces = "index";
		}
		//se manda a llamar el modelo de enlaces para obtener la url completa a la que se va a dirigir
		$respuesta = Paginas::enlacesPaginasModel($enlaces);
		//carga la url
		include $respuesta;
	}

	#IDENTIFICACION DE USUARIOS

	//Funcion controlador que autentica a un usuario
	public function ingresoUsuarioController(){
		//se comprueba que el boton se haya presionado
		if(isset($_POST["ingresar"])){
			//Se almacena el usuario y la contrasena ingresada por el usuario en un array
			$datosController = array ("usuario" => $_POST["usuario"],
										"contra" => $_POST["contra"]);
			//Se manda a llamar el modelo que identifica si los datos que ingreso el usuario estan almacenados en la base de datos
			$respuesta = Datos::ingresoUsuarioModel($datosController, "maestro");
			//Si los datos son encontrados en el modelo se inicia la sesion
			if($respuesta!="error"){
				//se inicia la sesion
				session_start();
				$_SESSION["validar"] = true;
				$_SESSION["usuario"] = $datosController["usuario"];
				//superadmin
				if($respuesta==1){
					header("location:index.php?action=inicioadmin");
				}
				//usuario
				if($respuesta==2){
					header("location:index.php?action=iniciousuario");	
				}

			}else{
				//Si los datos no son correctos se dirige al login de nuevo
				header("location:index.php?action=fallo");
				echo "<script type='text/javascript'>
        					alert('Datos incorrectos');
      				  </script>";
			}

		}
	}

	//Este metodo toma los valores escritos en el formulario mediante el metodo de post para manadar a llamar al modelo que hace la insercion en la base de datos
	public function registrarAlumnoController(){
		if(isset($_POST["registrar"])){

			if(isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"]!=""){
				$b = $this->cargarImagen();
			}
			//Si la imagen se cargo se almacenan los datos que se ingresaron
			if($b!="0"){

				$datosController = array ("matricula"=>$_POST["matricula"], "nombre"=>$_POST["nombre"], "grupo"=>$_POST["grupo"], "carrera"=>$_POST["carrera"], "foto"=>$b);

				$respuesta = Datos::registrarAlumnoModel($datosController, "alumno");
				if($respuesta){
					$_SESSION["registrado"]=1;
					echo"<script language='javascript'>window.location='index.php?action=nuevoalumno';</script>";
				}


			}
		}
	}

	//Este metodo hace una llamada a un modelo que obtiene todos los grupos de la base de datos existentes de manera lógica
	public function mostrarGruposController(){
		$respuesta = Datos::consultarGruposModel();
		if($respuesta){
			foreach ($respuesta as $fila) {
				$resp2 = Datos::buscarProfesorModel($fila["id_maestro"]);
				echo '<option value="'.$fila["id_grupo"].'">'.$fila["codigo_grupo"] . " - ". $resp2["nombre_maestro"] . " (Nivel " . $fila["nivel"]. ")" . '</option>';
			}
		}
	}

	//Este metodo hace una llamada a un modelo que obtiene todos los alumnos de la base de datos existentes de manera lógica
	public function mostrarAlumnoController(){
		$respuesta = Datos::consultarAlumnoModel();
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<option value="'.$fila["id_alumno"].'">'. $fila["nombre_alumno"] . '</option>';
			}
		}
	}

	//Este metodo hace una llamada a un modelo que obtiene todos las actividades de la base de datos existentes de manera lógica
	public function mostrarActividadController(){
		$respuesta = Datos::consultarActividadesModel();
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<option value="'.$fila["id_actividad"].'">'. $fila["nombre_actividad"] . '</option>';
			}
		}
	}

	//Este metodo hace una llamada a un modelo que obtiene todos las carreras de la base de datos existentes de manera lógica
	public function mostrarCarrerasController(){
		$respuesta = Datos::consultarCarrerasModel();
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<option value="'.$fila["id_carrera"].'">'.$fila["nombre"] . " (" . $fila["siglas"]. ")" . '</option>';
			}
		}

	}

	//Metodo que obtiene todos los registros de la base de datos y los imprime en una tabla
	public function vistaAlumnosController(){
		$respuesta = Datos::consultarAlumnosModel();
		if($respuesta){
			foreach ($respuesta as $fila) {
				$grupo = Datos::buscarGrupoModel($fila["id_grupo"]);
				$grupo2 = $grupo["codigo_grupo"];
				$carrera = Datos::buscarCarreraModel($fila["id_carrera"]);
				$carrera2 = $carrera["siglas"];
				
				echo '<tr>
						<td>'.$fila["matricula_alumno"].'</td>
						<td>'.$fila["nombre_alumno"] . '</td>
						<td>'.$grupo2.'</td>
						<td>'.$carrera2.'</td>';

						if($fila["img_alumno"]!=""){
							echo '<td><a href="uploads/'.$fila["img_alumno"].'"class="btn btn-secondary"><i class="fa fa-photo"></i></a></td>';
						}else{
							echo '<td>Sin imágen</td>';
						}

						echo '<td><a href="index.php?action=modificaralumno&id='.$fila["id_alumno"].'"class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
						<td><button class="btn btn-danger"><a href="index.php?action=alumnos&idBorrar='.$fila["id_alumno"]. '" style="color: white" onclick="verificar('.$fila["id_alumno"].');"><i class="fa fa-times"></i></a></button></td>
					</tr>';
			}
		}
	}

	//Metodo que toma la informacion de un registro y la devuelve en un formulario
	public function editarAlumnoController(){

		if(isset($_GET["id"])){
			$id = $_GET["id"];

			$respuesta = Datos::buscarAlumnoModel($id);

			if($respuesta){
				echo "<div class='form-row'>
		            <div class='form-group col-md-3'>
		              <label for='matricula'>Matrícula</label>
		              <input type='text' class='form-control' id='matricula' name='matricula' placeholder='Matrícula' value='".$respuesta["matricula_alumno"]. "' required>
		            </div>
		            <div class='form-group col-md-9'>
		              <label for='nombre'>Nombre</label>
		              <input type='text' class='form-control' id='nombre' name='nombre' placeholder='Nombre completo' value='".$respuesta["nombre_alumno"]."' required>
		            </div>
		          </div>
		          <div class='form-row'>
		            <div class='form-group col-md-6'>
		              <label for='grupo'>Grupo</label>
		              <select id='grupo' name='grupo' class='form-control select2'>";

		              $g = Datos::consultarGruposModel();
						if($g){
							foreach ($g as $fila) {
								$resp2 = Datos::buscarProfesorModel($fila["id_maestro"]);
								if($respuesta["id_grupo"]==$fila["id_grupo"]){
									echo '<option value="'.$fila["id_grupo"].'" selected>'.$fila["codigo_grupo"] . " - ". $resp2["nombre_maestro"] . " (Nivel " . $fila["nivel"]. ")" . '</option>';
								}else{
									echo '<option value="'.$fila["id_grupo"].'">'.$fila["codigo_grupo"] . " - ". $resp2["nombre_maestro"] . " (Nivel " . $fila["nivel"]. ")" . '</option>';
								}
							}
						}
		                
		             echo "</select>
		            </div>
		            <div class='form-group col-md-6'>
		              <label for='carrera'>Carrera</label>
		              <select id='carrera' name='carrera' class='form-control select2'>";
		                 $c = Datos::consultarCarrerasModel();
							if($c){
								foreach ($c as $fila) {
									if($respuesta["id_carrera"]==$fila["id_carrera"]){
										echo '<option value="'.$fila["id_carrera"].'" selected>'.$fila["nombre"] . " (" . $fila["siglas"]. ")" . '</option>';
									}else{
										echo '<option value="'.$fila["id_carrera"].'">'.$fila["nombre"] . " (" . $fila["siglas"]. ")" . '</option>';
									}
								}
							}
		             echo "</select>
		            </div>
		          </div>
		          <div class='form-row'>
			          <div class='form-group col-md-6'>
			            <label for='fileToUpload'>Foto</label><br>
			            <input type='hidden' name='iman' id='iman' value='".$respuesta["img_alumno"]."'>
			          	<a href='uploads/".$respuesta["img_alumno"]."' class='btn btn-primary'><i class='fa fa-photo'></i> Ver Imágen</a>
			          	<br><br>
			          	<input type='file' class='form-control-file' name='fileToUpload' id='fileToUpload'>
			          </div>
		          </div><br>";
			}
		}

	}

	//Metood que almacena la informacion de un formulario y actualiza el registro en la base de datos
	public function modificarAlumnoController(){

		$id = $_GET["id"];

		if(isset($_POST["modificar"])){

			if(isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"]!=""){
				$b = $this->cargarImagen();
			}else{
				$b = $_POST["iman"];
			}

			if(isset($b)){

				$datosController = array ("id"=>$id,"matricula"=>$_POST["matricula"], "nombre"=>$_POST["nombre"], "grupo"=>$_POST["grupo"], "carrera"=>$_POST["carrera"], "foto"=>$b);

				$respuesta = Datos::modificarAlumnoModel($datosController, "alumno");
				if($respuesta){
					$_SESSION["modificado"]=1;
					echo"<script language='javascript'>window.location='index.php?action=modificaralumno&id=".$id."';</script>";
				}

			}

		}

	}

	//Metodo que cambia el estado de un registro para eliminarlo logicamente de la base de datos
	public function eliminarAlumnoController(){
		if(isset($_GET["borrar"])){
			$id = $_GET["borrar"];
			$respuesta = Datos::eliminarAlumnoModel($id);

			if($respuesta){
				$_SESSION["eliminado"]=1;
				echo"<script language='javascript'>window.location='index.php?action=alumnos';</script>";
			}
		}
	}

	//Este metodo toma los valores escritos en el formulario mediante el metodo de post para manadar a llamar al modelo que hace la insercion en la base de datos
	public function registrarProfesorController(){
		if(isset($_POST["registrar"])){
			$b = $this->cargarImagen();
			//Si la imagen se cargo se almacenan los datos que se ingresaron
			if($b!="0"){
				$datosController = array ("emp"=>$_POST["noempleado"], "nombre"=>$_POST["nombre"], "fechaNa"=>$_POST["fechaN"], "telefono"=>$_POST["tel"], "direcc"=>$_POST["dir"], "usuario"=>$_POST["usuario"], "contra"=>$_POST["contra"], "foto"=>$b);

				$respuesta = Datos::registrarProfesorModel($datosController, "maestro");
				if($respuesta){
					$_SESSION["registrado"]=1;
					echo"<script language='javascript'>window.location='index.php?action=nuevoprofe';</script>";
				}


			}
		}
	}

	//Metodo que obtiene todos los registros de la base de datos y los imprime en una tabla
	public function vistaProfesoresController(){
		$respuesta = Datos::consultarProfesorModel();
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<tr>
						<td>'.$fila["numero_empleado"].'</td>
						<td>'.$fila["nombre_maestro"] . '</td>
						<td>'.$fila["telefono_maestro"].'</td>
						<td>'.$fila["direccion_maestro"].'</td>
						<td>'.$fila["fecha_nac"].'</td>';

						if($fila["img_maestro"]!=""){
							echo '<td><a href="uploads/'.$fila["img_maestro"].'"class="btn btn-secondary"><i class="fa fa-photo"></i></a></td>';
						}else{
							echo '<td>Sin imágen</td>';
						}

						echo '<td>'.$fila["usuario"].'</td>
						<td>'.$fila["pass"].'</td>
						<td><a href="index.php?action=modificarprofe&id='.$fila["id_maestro"].'"class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
						<td><button class="btn btn-danger"><a href="index.php?action=profesores&idBorrar='.$fila["id_maestro"].'" style="color: white" onclick="verificarP('.$fila["id_maestro"].');"><i class="fa fa-times"></i></a></button></td>
					</tr>';
			}
		}
	}

	//Metodo que toma la informacion de un registro y la devuelve en un formulario
	public function editarProfesorController(){

		if(isset($_GET["id"])){
			$id = $_GET["id"];

			$respuesta = Datos::buscarProfesorModel($id);

			if($respuesta){
				echo "<div class='form-row'>
			            <div class='form-group col-md-3'>
			              <label for='noempleado'>Número de Empleado</label>
			              <input type='text' class='form-control' id='noempleado' name='noempleado' value='".$respuesta["numero_empleado"]."' placeholder='Número de empleado' required>
			            </div>
			            <div class='form-group col-md-9'>
			              <label for='nombre'>Nombre</label>
			              <input type='text' class='form-control' id='nombre' name='nombre' value='".$respuesta["nombre_maestro"]."' placeholder='Nombre completo' required>
			            </div>
			          </div>
			          <div class='form-row'>
			            <div class='form-group col-md-3'>
			              <label for='fechaN'>Fecha de Nacimiento</label>
			              <input type='date' class='form-control' id='fechaN' name='fechaN' value='".$respuesta["fecha_nac"]."' placeholder='Fecha de Nacimiento' required>
			            </div>
			            <div class='form-group col-md-3'>
			              <label for='tel'>Teléfono</label>
			              <input type='text' class='form-control' id='tel' name='tel' value='".$respuesta["telefono_maestro"]."' placeholder='Teléfono de Celular' required>
			            </div>
			            <div class='form-group col-md-6'>
			              <label for='tel'>Dirección</label>
			              <input type='text' class='form-control' id='dir' name='dir' value='".$respuesta["direccion_maestro"]."' placeholder='Dirección' required>
			            </div>
			          </div>
			          <div class='row'>
			             <div class='form-group col-md-3'>
			              	<label for='usuario'>Usuario</label>
			              	<input type='text' class='form-control' id='usuario' name='usuario' value='".$respuesta["usuario"]."' placeholder='Usuario' required>
			             </div>
			             <div class='form-group col-md-3'>
			              	<label for='contra'>Contraseña</label>
			              	<input type='text' class='form-control' id='contra' name='contra' value='".$respuesta["pass"]."' placeholder='Contraseña' required>
			             </div>
			          	<div class='form-group col-md-2'>
			            	<label for='fileToUpload'>Foto</label><br>
			            	<input type='hidden' name='iman' id='iman' value='".$respuesta["img_maestro"]."'>
			          		<a href='uploads/".$respuesta["img_maestro"]."' class='btn btn-primary'><i class='fa fa-photo'></i> Ver Imágen</a>
			          	</div>
			          	<div class='form-group col-md-4'>
			          		<input type='file' style='margin-top: 35px' class='form-control-file' name='fileToUpload' id='fileToUpload'>
			          	</div>
		          </div><br>";
			}
		}

	}

	//Metood que almacena la informacion de un formulario y actualiza el registro en la base de datos
	public function modificarProfesorController(){

		$id = $_GET["id"];

		if(isset($_POST["modificar"])){

			if(isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"]!=""){
				$b = $this->cargarImagen();
			}else{
				$b = $_POST["iman"];
			}

			if(isset($b)){

				$datosController = array ("id"=>$id,"emp"=>$_POST["noempleado"], "nombre"=>$_POST["nombre"], "fechaNa"=>$_POST["fechaN"], "tel"=>$_POST["tel"], "dir"=>$_POST["dir"], "usuario"=>$_POST["usuario"], "contra"=>$_POST["contra"], "foto"=>$b);

				$respuesta = Datos::modificarProfesorModel($datosController, "maestro");
				if($respuesta){
					$_SESSION["modificado"]=1;
					echo"<script language='javascript'>window.location='index.php?action=modificarprofe&id=".$id."';</script>";
				}

			}

		}

	}

	//Metodo que cambia el estado de un registro para eliminarlo logicamente de la base de datos
	public function eliminarProfesorController(){
		if(isset($_GET["borrar"])){
			$id = $_GET["borrar"];
			$respuesta = Datos::eliminarProfesorModel($id);
			if($respuesta){
				$_SESSION["eliminado"]=1;
				echo"<script language='javascript'>window.location='index.php?action=profesores';</script>";
			}
		}
	}

	//Este metodo toma los valores escritos en el formulario mediante el metodo de post para manadar a llamar al modelo que hace la insercion 	en la base de datos
	public function registrarActividadController(){
		if(isset($_POST["registrar"])){
			
			$datosController = array ("nombre"=>$_POST["nombre"], "desc"=>$_POST["desc"]);

			$respuesta = Datos::registrarActividadModel($datosController, "actividad");
			if($respuesta){
				$_SESSION["registrado"]=1;
				echo"<script language='javascript'>window.location='index.php?action=nuevaactividad';</script>";
			}

		}
	}

	//Metodo que obtiene todos los registros de la base de datos y los imprime en una tabla
	public function vistaActividadController(){
		$respuesta = Datos::consultarActividadModel();
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<tr>
						<td>'.$fila["nombre_actividad"].'</td>
						<td>'.$fila["desc_actividad"] . '</td>
						<td><a href="index.php?action=modificaractividad&id='.$fila["id_actividad"].'"class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
						<td><button class="btn btn-danger"><a href="index.php?action=actividades&idBorrar='.$fila["id_actividad"].'" style="color: white" onclick="verificarA('.$fila["id_actividad"].');"><i class="fa fa-times"></i></a></button></td>
					</tr>';
			}
		}
	}

	//Metodo que toma la informacion de un registro y la devuelve en un formulario
	public function editarActividadController(){

		if(isset($_GET["id"])){
			$id = $_GET["id"];

			$respuesta = Datos::buscarActividadModel($id);

			if($respuesta){
				echo '<div class="form-row">
			            <div class="form-group col-md-3">
			              <label for="nombre">Nombre de la actividad</label>
			              <input type="text" class="form-control" id="nombre" name="nombre" value="'.$respuesta["nombre_actividad"].'" placeholder="Nombre de la actividad" required>
			            </div>
			            <div class="form-group col-md-9">
			              <label for="desc">Descripción</label>
			              <input type="text" class="form-control" id="desc" name="desc" value="'.$respuesta["desc_actividad"].'" placeholder="Descripción de la actividad" required>
			            </div>
			          </div>';
			}
		}
	}

	//Metood que almacena la informacion de un formulario y actualiza el registro en la base de datos
	public function modificarActividadController(){
		$id = $_GET["id"];
		if(isset($_POST["modificar"])){
			$datosController = array ("id"=>$id,"nombre"=>$_POST["nombre"], "desc"=>$_POST["desc"]);

			$respuesta = Datos::modificarActividadModel($datosController, "actividad");
			if($respuesta){
				$_SESSION["modificado"]=1;
				echo"<script language='javascript'>window.location='index.php?action=modificaractividad&id=".$id."';</script>";
			}
		}
	}

	//Metodo que cambia el estado de un registro para eliminarlo logicamente de la base de datos
	public function eliminarActividadController(){
		if(isset($_GET["borrar"])){
			$id = $_GET["borrar"];
			$respuesta = Datos::eliminarActividadModel($id);
			if($respuesta){
				$_SESSION["eliminado"]=1;
				echo"<script language='javascript'>window.location='index.php?action=actividades';</script>";
			}
		}
	}

	//Metodo que muestra los profesores de la base de datos
	public function mostrarProfesoresController(){
		$respuesta = Datos::consultarProfesoresModel();
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<option value="'.$fila["id_maestro"].'">'.$fila["nombre_maestro"] . '</option>';
			}
		}
	}

	//Metodo que registra un grupo en la base de datos con la llmada a un modelo que realiza la insercion en la base de datos
	public function registrarGrupoController(){
		if(isset($_POST["registrar"])){
			
			$datosController = array ("codigo"=>$_POST["codigo"], "maestro"=>$_POST["maestro"], "nivel"=>$_POST["nivel"]);

			$respuesta = Datos::registrarGrupoModel($datosController, "grupo");
			if($respuesta){
				$_SESSION["registrado"]=1;
				echo"<script language='javascript'>window.location='index.php?action=nuevogrupo';</script>";
			}

		}
	}

	//Metodo que obtiene todos los registros de la base de datos y los imprime en una tabla
	public function vistaGrupoController(){
		$respuesta = Datos::consultarGruposModel();
		if($respuesta){
			foreach ($respuesta as $fila) {
				$resp2 = Datos::buscarProfesorModel($fila["id_maestro"]);
				echo '<tr>
						<td>'.$fila["codigo_grupo"].'</td>
						<td>'.$resp2["nombre_maestro"] . '</td>
						<td>'.$fila["nivel"] . '</td>
						<td><a href="index.php?action=modificargrupo&id='.$fila["id_grupo"].'"class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
						<td><button class="btn btn-danger"><a href="index.php?action=grupos&idBorrar='.$fila["id_grupo"].'" style="color: white" onclick="verificarG('.$fila["id_grupo"].');"><i class="fa fa-times"></i></a></button></td>
					</tr>';
			}
		}
	}


	//Metodo que carga una imagen a una carpeta
	public function cargarImagen(){
		$ruta="";
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["aceptar"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000000000000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		    	return $ruta = basename($_FILES["fileToUpload"]["name"]);
		        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		        return "0";
		    }
		}
	}

	//Metodo que toma la informacion de un registro y la devuelve en un formulario
	public function editarGrupoController(){

		if(isset($_GET["id"])){
			$id = $_GET["id"];

			$respuesta = Datos::buscarGrupoModel($id);
			$profes = Datos::consultarProfesoresModel();

			if($respuesta){
				echo '<div class="form-row">
			            <div class="form-group col-md-3">
			              <label for="codigo">Código del grupo</label>
			              <input type="text" class="form-control" id="codigo" name="codigo" value="'.$respuesta["codigo_grupo"].'" placeholder="Código del grupo" required>
			            </div>
			          </div>
			          <div class="form-row">
			           <div class="form-group col-md-5">
			              <label for="maestro">Maestro</label>
			              <select id="maestro" name="maestro" class="form-control select2">';
			                foreach ($profes as $fila) {

			                	if($fila["id_maestro"]==$respuesta["id_maestro"]){
			                		echo '<option value="'.$fila["id_maestro"].'" selected>'.$fila["nombre_maestro"].'</option>';
			                	}else{
			                		echo '<option value="'.$fila["id_maestro"].'">'.$fila["nombre_maestro"].'</option>';
			                	}

			                }
			      		echo '</select>
			            </div>
			            <div class="form-group col-md-2">
			              <label for="nivel">Nivel</label>
			              <select id="nivel" name="nivel" class="form-control select2">';
			                 for ($i=1; $i <=9 ; $i++) { 
			                 	if($i==$respuesta["nivel"]){
			                 		echo '<option value="'.$i.'" selected>'.$i.'</option>';
			                 	}else{
			                 		echo '<option value="'.$i.'">'.$i.'</option>';
			                 	}
			                 }
			              echo '</select>
			            </div>
			          </div><br>';
			}
		}
	}

	//Metood que almacena la informacion de un formulario y actualiza el registro en la base de datos
	public function modificarGrupoController(){
		$id = $_GET["id"];
		if(isset($_POST["modificar"])){
			
			$datosController = array ("id"=>$id,"codigo"=>$_POST["codigo"], "maestro"=>$_POST["maestro"], "nivel"=>$_POST["nivel"]);

			$respuesta = Datos::modificarGrupoModel($datosController, "grupo");
			if($respuesta){
				$_SESSION["modificado"]=1;
				echo"<script language='javascript'>window.location='index.php?action=modificargrupo&id=".$id."';</script>";
			}

		}
	}

	//Metodo que cambia el estado de un registro para eliminarlo logicamente de la base de datos
	public function eliminarGrupoController(){
		if(isset($_GET["borrar"])){
			$id = $_GET["borrar"];
			$respuesta = Datos::eliminarGrupoModel($id);
			if($respuesta){
				$_SESSION["eliminado"]=1;
				echo"<script language='javascript'>window.location='index.php?action=grupos';</script>";
			}
		}
	}

	//Cuenta el total de alumnos registrados
	public function numeroAlumnos(){
		$num = Datos::totalesModel("alumno");
		return $num;
	}
	//Cuenta el total de profesores registrados
	public function numeroProfesores(){
		$num = Datos::totalesModel("maestro");
		return $num;
	}

	//Cuenta el total de grupos registrados
	public function numeroGrupos(){
		$num = Datos::totalesModel("grupo");
		return $num;
	}


}

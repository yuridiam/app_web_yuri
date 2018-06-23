<?php
//Clase general que controla la comunicación entre la vista y el modelo
Class MvcController{

	//Funcion que carga el template en primera instancia
	public function pagina(){	
		include "views/template.php";
	}

	//Funcion que obtiene la action de la pagina para poder dirigirse a la pagina adecuada con la ayuda del model en el crud de enlaces
	public function enlacesPaginasController(){
		//Comprueba que el action este en la url de la pagina
		if(isset( $_GET['action'])){	
			//Almacena el action en una variable
			$enlaces = $_GET['action'];
		}else{
			
    		//Si no hay action se asigna la palabra index al enlace
			$enlaces = "index";
        	
		}
		//Se manda a llamar el modelo de enlaces para obtener la url completa a la que se va a dirigir
		$respuesta = Paginas::enlacesPaginasModel($enlaces);
		//Carga la url
		include $respuesta;
	}

	#IDENTIFICACION DE USUARIOS (LOGIN)

	//Funcion controlador que autentica a un usuario
	public function ingresoUsuarioController(){
		//Se comprueba que el boton se haya presionado
		if(isset($_POST["ingresar"])){
			//Se almacena el usuario y la contrasena ingresada por el usuario en un array
			$datosController = array ("usuario" => $_POST["usuario"],
										"contra" => $_POST["contra"]);
			//Se manda a llamar el modelo que identifica si los datos que ingreso el usuario estan almacenados en la base de datos
			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
			//Si los datos son encontrados en el modelo se inicia la sesion
			if($respuesta){
				//Se inicia la sesion
				session_start();
				//Se crean las variables de sesion necesarias
				$_SESSION["validar"] = true;
				//Se dirige a la pagina de alumnas
				header("location:index.php?action=alumnas");
			}else{
				//Si los datos no son correctos se dirige al login de nuevo
				header("location:index.php?action=fallo");
			}

		}
	}

	#GRUPOS

	//Funcion que ejecuta el modelo que registra un grupo a la base de datos
	public function registrarGrupoController(){
		//Se comprueba que se haya seleccionado el boton de aceptar
		if(isset($_POST["aceptar"])){
			//Se asigna lo ingresado en una variable
			$nombreG = $_POST["nombreG"];
			//Se manda a llamar un modelo que registra el grupo a la base de datos
			$respuesta = Datos::registroGrupoModel($nombreG);
			//Si se ejecuta el modelo se dirige a la pagina de principal de grupos
			if($respuesta){
				//Se dirige a la pagina de grupos
				header("location:index.php?action=grupos");
			}
		}
	}


	//Funcion que muestra todos los grupos existentes en una tabla
	public function vistaGrupoController(){
		//Se manda a llamar el modelo que trae los resultados de la consulta de la tabla grupos
		$respuesta = Datos::vistaGrupoModel();
		//Si el modelo se ejecuta correctamente se imprimen todos los grupos en una tabla
		if($respuesta){
			//Ciclo que recorre el resultado del modelo
			foreach ($respuesta as $fila) {
				//Fila por cada grupo
				echo '<tr>
						<td>'.$fila["id_grupo"].'</td>
						<td>'.$fila["nombre_grupo"].'</td>
						<td><a href="index.php?action=modificargrupo&id='.$fila["id_grupo"].'"class="btn btn-info"><i class="fa fa-edit"></i></a></td>
						<td><a href="index.php?action=eliminargrupo&idBorrar='.$fila["id_grupo"]. '"class="btn btn-danger"><i class="fa fa-times"></i></a></td>
				</tr>';
			}
		}
	}

	//Funcion que muestra los datos a editar de un grupo
	public function editarGrupoController(){
		//Se verifica que el id del grupo este en la url
		if(isset($_GET["id"])){
			//Se asigna el id en una variable
			$id = $_GET["id"];
			//Se ejecuta el modelo que busca el registro en la tabla grupos con ese id
			$respuesta = Datos::buscarGrupoModel($id);
			//Si se ejecuta el modelo correctamente se imprime el formulario
			if($respuesta){
				echo '<input type="text" name="nombreG" id="nombreG" placeholder="Nombre del grupo" value="'.$respuesta["nombre_grupo"].'" required>
					<input type="submit" class="button tiny" name="modificar" id="modificar" value="Modificar" style="width: 100%; background-color: #853BBE" onclick="mod();">';
			}
		}
	}

	//Funcion que modifica los datos de un grupo
	public function modificarGrupoController(){
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["modificar"])){
			//Se asigna el id de la url y los datos a modificar en variables
			$id = $_GET["id"];
			$nombre = $_POST["nombreG"];
			//Se ejecuta el modelo que hace el update de los datos
			$respuesta = Datos::modificarGrupoModel($id, $nombre);
			//Si se ejecuta el modelo se dirige a la pagina principal de grupos
			if($respuesta){
				header("location:index.php?action=grupos");
			}
		}

	}

	//Funcion que elimina un grupo logicamente de la base de datos
	public function eliminarGrupoController(){
		//Se comprueba que las variables id y contra esten en la url
		if(isset($_GET["id"]) && isset($_GET["contra"])){
			//Se asigna la variable id a una variable
			$id = $_GET["id"];
			//Se ejecuta el modelo que actualiza el estado de eliminado 1 para que se elimine logicamente el registro
			$respuesta = Datos::eliminarGrupoModel($id);
			//Si se ejecuta el modelo se dirige a la pagina principal de grupos
			if($respuesta){
				header("location:index.php?action=grupos");
			}

		}
	}

	//Funcion que imprime los grupos en un select2
	public function verGruposController(){
		$respuesta = Datos::vistaGrupoModel();
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<option value="'.$fila["id_grupo"].'">'.$fila["nombre_grupo"].'</option>';
			}
		}
	}


	//Funcion que registra un alumna a la base de datos
	public function registrarAlumnaController(){
		//Se comprueba que el boton se haya seleccionado
		if(isset($_POST["aceptar"])){
			//Se asigna los valores ingresados a variables
			$nombre = $_POST["n"];
			$apellido = $_POST["a"];
			$grupo = $_POST["grupo"];
			$fechaN = $_POST["fechaNac"];
			//Se ejecuta el modelo que agrega la alumna a la base de datos
			$respuesta=Datos::registrarAlumnaModel($nombre,$apellido,$grupo,$fechaN);
			//Si se ejecuta el modelo se dirige a la pagina principal de alumnas
			if($respuesta){
				header("location:index.php?action=alumnas");
			}

		}
	}

	//Funcion que muestra todas las alumnas registradas en la base datos
	public function vistaAlumnasController(){
		//Se ejecuta el modelo que carga todos los registros existentes de alumnas de la base de datos
		$respuesta = Datos::vistaAlumnasModel();
		//Si el modelo se ejecuta correctamente se imprimen los registros en una tabla
		if($respuesta){
			//Ciclo que imprime cada registro como una fila en una tabla
			foreach ($respuesta as $fila) {
				//Se ejecuta el modelo que busca los datos de un grupo en especifico
				$grupo = Datos::buscarGrupoModel($fila["grupo_alumna"]);
				//Se imprimen las alumnas como filas
				echo '<tr>
						<td>'.$fila["id_alumna"].'</td>
						<td>'.$fila["nombre_alumna"].'</td>
						<td>'.$fila["apellidos_alumna"].'</td>
						<td>'.$grupo["nombre_grupo"].'</td>
						<td>'.$fila["fecha_nac"].'</td>
						<td><a href="index.php?action=modificaralumna&id='.$fila["id_alumna"].'"class="btn btn-info"><i class="fa fa-edit"></i></a></td>
						<td><a href="index.php?action=eliminaralumna&idBorrar='.$fila["id_alumna"]. '"class="btn btn-danger"><i class="fa fa-times"></i></a></td>
				</tr>';
			}
		}
	}

	//Funcion que muestra los datos a editar de una alumna
	public function editarAlumnaController(){
		//Se comprueba que el id de la alumna este en el url
		if(isset($_GET["id"])){
			//Se asigna el id a una variable
			$id = $_GET["id"];
			//Se ejecuta la consulta que busca una alumna en especifico
			$respuesta = Datos::buscarAlumnaModel($id);
			//Si la consulta se ejecuta se imprime el formulario de una alumna
			if($respuesta){
				//Se ejecuta la consultan los grupos existentes
				$grupos = Datos::vistaGrupoModel();
				//Se imprimen los campos con su valor
				echo '<input type="text" name="n" id="n" placeholder="Nombre(s)" value="'.$respuesta["nombre_alumna"].'">
						<input type="text" name="a" id="a" placeholder="Apellidos" value="'.$respuesta["apellidos_alumna"].'">
						<select class="js-example-basic-single" name="grupo" id="grupo" style="width: 100%">';
								foreach ($grupos as $fila) {
									if($fila["id_grupo"]==$respuesta["grupo_alumna"]){
										echo '<option value="'.$fila["id_grupo"].'"selected>'.$fila["nombre_grupo"].'</option>';
									}else{
										echo '<option value="'.$fila["id_grupo"].'">'.$fila["nombre_grupo"].'</option>';
									}
								}
							
				echo	'</select>
					<br><br>
					<label>Fecha de Nacimiento</label>
					<input type="date" name="fechaNac" id="fechaNac" placeholder="Fecha de nacimiento" value="'.$respuesta["fecha_nac"].'">
					<input type="submit" class="button tiny" name="modificar" id="modificar" value="Modificar" style="width: 100%; background-color: #853BBE" onclick="modA();">';
			}
		}
	}

	//Funcion que modifica los datos de una alumna en la base de datos
	public function modificarAlumnaController(){
		//Se comprubea que el boton se haya seleccionado
		if(isset($_POST["modificar"])){
			$id = $_GET["id"];
			$nombre = $_POST["n"];
			$apellido = $_POST["a"];
			$grupo = $_POST["grupo"];
			$fechaN = $_POST["fechaNac"];
			//Se ejecuta el modelo que modifica los datos de una alumna
			$respuesta=Datos::modificarAlumnaModel($id,$nombre,$apellido,$grupo,$fechaN);
			//Si el modelo se ejecuta correctamente se dirige a la pagina principal de alumnos
			if($respuesta){
				header("location:index.php?action=alumnas");
			}

		}
	}

	//Funcion que elimina una alumna logicamente
	public function eliminarAlumnaController(){
		//Se comrpueba que las variables id y contra esten en la url
		if(isset($_GET["id"]) && isset($_GET["contra"])){
			//Se almacena el id en una variable
			$id = $_GET["id"];
			//Se ejecuta el modelo que elimina una alumna de la base de datos
			$respuesta = Datos::eliminarAlumnaModel($id);
			//Si el modelo se ejecuta correctamente se dirige a l pagina principal de alumnas
			if($respuesta){
				echo"<script language='javascript'>window.location='index.php?action=alumnas';</script>";
			}

		}
	}


	//Funcion que muestra todos los pagos existentes
	public function vistaPagosController(){
		//Se ejecuta el modelo que trae todos los registros existentes logicamente de pagos en la base de datos
		$respuesta = Datos::vistaPagosModel();
		//Si la consulta se ejecuta se agregan los registros en una tabla
		if($respuesta){
			//Ciclo que agrega los pagos como filas de una tabla
			foreach ($respuesta as $fila) {
				//Se ejecuta el modelo que obtiene los datos de un grupo en particular
				$grupo = Datos::buscarGrupoModel($fila["id_grupo"]);
				//Se ejecuta el modelo que obtiene los datos de una alumna en particular
				$alumna = Datos::buscarAlumnaModel($fila["id_alumna"]);
				//Se imprime la fila con los datos de la alumna
				echo '<tr>
						<td>'.$fila["id_pago"].'</td>
						<td>'.$alumna["nombre_alumna"].' ' . $alumna["apellidos_alumna"].'</td>
						<td>'.$grupo["nombre_grupo"].'</td>
						<td>'.$fila["nom_mama"]. ' ' . $fila["ape_mama"].'</td>
						<td>'.$fila["fecha_pago"].'</td>
						<td>'.$fila["fecha_envio"].'</td>
						<td><a href="uploads/'.$fila["url"].'"class="btn btn-warning"><i class="fa fa-photo"></a></td>
						<td>'.$fila["folio"].'</td>
						<td><a href="index.php?action=modificarpago&id='.$fila["id_pago"].'"class="btn btn-info"><i class="fa fa-edit"></i></a></td>
						<td><a href="index.php?action=eliminarpago&idBorrar='.$fila["id_pago"]. '"class="btn btn-danger"><i class="fa fa-times"></i></a></td>
				</tr>';
			}
		}
	}

	//Funcion que muestra los datos del pago a modificar
	public function editarPagoController(){
		//Se comprueba que la variable id se encuentre en la url
		if(isset($_GET["id"])){
			//Se almacena el id en una variable
			$id = $_GET["id"];
			//Se ejecuta el modelo que busca los datos de un pago en base al id
			$respuesta = Datos::buscarPagoModel($id);
			//Se comprueba que la consulta se haya realizado correctamente
			if($respuesta){
				//Se ejecuta el modelo que obtiene los datos de todos los grupos
				$grupos = Datos::vistaGrupoModel();
				//Se ejecuta el modelo que obtiene los datos de todos las alumnas
				$alumnas  = Datos::vistaAlumnasModel();
				//Se imprimen todos los grupos existentes en un select 2
				echo '<label>Grupo</label>
					<select class="js-example-basic-single" name="grupo" id="grupo" style="width: 100%" onchange="act();">';
					//Ciclo que recorre el modelo con todas las filas para agregarlo al select2
					foreach ($grupos as $fila) {
									//Si la fila en la que esta es a la que pertenece la alumna se imprime seleccionado
									if($fila["id_grupo"]==$respuesta["id_grupo"]){
										echo '<option value="'.$fila["id_grupo"].'"selected>'.$fila["nombre_grupo"].'</option>';
									}else{
										echo '<option value="'.$fila["id_grupo"].'">'.$fila["nombre_grupo"].'</option>';
									}
								}
				echo '</select><br><br>';
				//Se imprimen todos los grupos existentes en un select 2
				echo '<label>Alumna</label>
					<select class="js-example-basic-single" name="alumna" id="alumna" style="width: 100%">';
					//Ciclo que recorre el modelo con todas las filas para agregarlo al select2
					foreach ($alumnas as $fila) {
									//Si la fila en la que esta corresponde a la alumna que se quiere editar se imprime seleccionado
									if($fila["id_alumna"]==$respuesta["id_alumna"]){
										echo '<option value="'.$fila["id_alumna"].'"selected>'.$fila["nombre_alumna"].' '.$fila["apellidos_alumna"].'</option>';
									}else{
										echo '<option value="'.$fila["id_alumna"].'">'.$fila["nombre_alumna"].'</option>';
									}
								}
				echo '</select>';
				//Se imprimen todos los campos del formulario con los datos actuales de la alumna
				echo'<br><br>
				<label>Nombre de la madre</label>
				<div id="contenido">
					<div id="izquierda" class="izquierda">
						<input type="text" name="nombreM" id="nombreM" required placeholder="Nombre" style="width: 340px" value="'.$respuesta["nom_mama"].'">
					</div>
					<div id="derecha" class="derecha">
						<input type="text" name="apellidoM" id="apellidoM" required placeholder="Apellidos" style="width: 340px; margin-left: -143px" value="'.$respuesta["ape_mama"].'">
					</div>
				</div><br><br><br>
				<label>Fecha de pago</label>
				<input type="date" name="fechaPago" id="fechaPago" placeholder="Fecha de pago" value="'.$respuesta["fecha_pago"].'">
				<label>Folio de autorización</label>
				<input type="text" name="folio" id="folio" required placeholder="Folio de autorización" value="'.$respuesta["folio"].'">
				<input type="submit" class="button tiny" name="modificar" id="modificar" value="Modificar" style="width: 100%; background-color: #853BBE" onclick="modP();">';
			}
		}
	}

	//Funcion que modifica un pago de la base de datos
	public function modificarPagoController(){
		//Se confirma que se haya seleccionado el boton
		if(isset($_POST["modificar"])){
			//Se alamacenan los datos en variables
			$id = $_GET["id"];
			$grupo = $_POST["grupo"];
			$alumna = $_POST["alumna"];
			$mNom = $_POST["nombreM"];
			$mApe = $_POST["apellidoM"];
			$fecha_pago = $_POST["fechaPago"];
			$folio = $_POST["folio"];
			//Se ejecuta el modelo que actualiza los datos actuales con los que se acaban de ingresar en la base de datos
			$respuesta = Datos::modificarPagoModel($id,$grupo,$alumna,$mNom,$mApe,$fecha_pago,$folio);
			//Si la consulta se realiza correctamente se dirige a la pagina principal de pagos
			if($respuesta){
				echo"<script language='javascript'>window.location='index.php?action=pagos';</script>";
			}
		}
	}

	//Funcion que elimina un pago de la base de datos
	public function eliminarPagoController(){
		//Se comprueba que la variable id y contra esten el url
		if(isset($_GET["id"]) && isset($_GET["contra"])){
			//Se asigna el id a una variable
			$id = $_GET["id"];
			//Se ejecuta el modelo que elimina logicamente un pago
			$respuesta = Datos::eliminarPagoModel($id);
			//Si se ejecuta el modelo se direcciona a la pagina principal de pagos
			if($respuesta){
				echo"<script language='javascript'>window.location='index.php?action=pagos';</script>";
			}

		}
	}

	//Funcion que registra un pago a la base de datos
	public function registrarPagoController(){
		//Se comprueba que el boton acepta se haya seleccionado
		if(isset($_POST["aceptar"])){
			//Se ejecuta las condiciones que comprueban la imagen que se cargo
			$b=0;
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
			if ($_FILES["fileToUpload"]["size"] > 500000) {
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
			    	$b=1;
			    	$ruta = basename($_FILES["fileToUpload"]["name"]);
			        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
			//Si la imagen se cargo se almacenan los datos que se ingresaron
			if($b==1){
				$grupo = $_POST["grupo"];
				$alumna = $_POST["alumna"];
				$nMa = $_POST["nombreM"];
				$aMa = $_POST["apellidoM"];
				$fecha_pago = $_POST["fechaPago"];
				$img = $ruta;
				$folio = $_POST["folio"];
				$fecha_envio = date("d-m-Y H:i:s");
				//Se ejecuta el modelo que registra el pago a la base de datos
				$respuesta = Datos::registrarPagoModel($grupo,$alumna,$nMa,$aMa,$fecha_pago,$img,$folio,$fecha_envio);
				//Si se registra el modelo se dirige a la pagina principal de lugares
				if($respuesta){
					echo"<script language='javascript'>window.location='index.php?action=lugares';</script>";
				}
			}

		}

	}

	//Funcion que muestra las filas de la tabla de todos los pagos realizados
	public function vistaLugaresController(){
		//Se ejecuta un modelo que obtiene todos los pagos almacenados en la base de datos
		$respuesta = Datos::vistaPagosModel();
		//Si el modelo se ejecuta correctamente se imprime cada registro en forma de fila de una tabla
		if($respuesta){
			//Ciclo que recorre cada registro e imprime su informacion
			foreach ($respuesta as $fila) {
				//Modelo que busca la informacion de un grupo en particular
				$grupo = Datos::buscarGrupoModel($fila["id_grupo"]);
				//Modelo que busca la informacion de una alumna en particular
				$alumna = Datos::buscarAlumnaModel($fila["id_alumna"]);
				//Se imprimen los datos en forma de fila
				echo '<tr>
						<td>'.$fila["id_pago"].'</td>
						<td>'.$fila["folio"].'</td>
						<td>'.$alumna["nombre_alumna"].' ' . $alumna["apellidos_alumna"].'</td>
						<td>'.$grupo["nombre_grupo"].'</td>
						<td>'.$fila["nom_mama"]. ' ' . $fila["ape_mama"].'</td>
						<td>'.$fila["fecha_pago"].'</td>
						<td>'.$fila["fecha_envio"].'</td>
					</tr>';
			}
		}
	}

	//Funcion que imprime los grupos en un select2
	public function verGruposAController(){
		$respuesta = Datos::vistaGrupoModel();
		if($respuesta){
			echo '<option value="" selected>Seleccione un grupo</option>';
			foreach ($respuesta as $fila) {
				echo '<option value="'.$fila["id_grupo"].'">'.$fila["nombre_grupo"].'</option>';
			}
		}
	}

	//Funcion que carga todas las alumnas 
	//**ESTA FUNCION SOLO SE REQUIERE PARA PRECARGAR LOS DATOS DE LAS ALUMNAS PARA QUE SEAN AGREGADOS DINAMICANTE EN EL SELECT2**//
	public function cargarAluController(){
		//Modelo que carga los registros de alumnas existentes logicamente
		$a = Datos::vistaAlumnasModel();
			//Variable que almacena la informacion de cada alumna en cadena
			$al ="";
			foreach ($a as $fila) {
				$al = $al . $fila["id_alumna"] . "," . $fila["nombre_alumna"] . " " . $fila["apellidos_alumna"] .','. $fila["grupo_alumna"] . "$";
			}
			return $al;
	}

}

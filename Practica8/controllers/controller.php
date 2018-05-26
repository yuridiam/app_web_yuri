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
	//Aqui se describen todas las funciones necesarias para que las acciones de cada vista se realicen

	//funcion controlador que autentica a un usuario
	public function ingresoUsuarioController(){
		//se comprueba que el boton se haya presionado
		if(isset($_POST["ingresar"])){
			//se revisa los datos ingresados son el superadmin o de un maestro solamente para poder
			//mostrarle la vista correcta
			if($_POST["correo"]=="superadmin@gmail.com" && $_POST["contra"]=="admin123"){
				//se inicia la sesion
				session_start();
				//se valida como verdadera
				$_SESSION["validar"] = true;
				//se dirige a la vista de un superadmin
				header("location:index.php?action=alumnos");

			}else{
				//si no se ingresaron datos de superadmin se comprueba que los datos ingresados hayan sido de
				//un maestro
				//se crea un array que contiene los dos datos
				$datosController = array( "correo"=>$_POST["correo"], 
									      "contra"=>$_POST["contra"]);
				//se convoca el modelo que busca los datos ingresados en la base de datos
				$respuesta = Datos::ingresoUsuarioModel($datosController, "maestro");
				//se comprueba que lo ingresado sea igual a lo tomado de la base de datos
				if($respuesta["email"] == $_POST["correo"] && $respuesta["pass"] == $_POST["contra"]){
					//se inicia la sesion
					session_start();
					//se valida como verdadera
					$_SESSION["validar"] = true;
					//se dirige a la vista de un maestro en donde se pasan variables por url para poder ser utilizadas al agregar una tutoria, ya que ese maestro solamente puede ver a sus tutorias
					//y registrar tutorias con su nombre
					header("location:index.php?action=tutorias&id=".$respuesta['nombre']."&iddos=".$respuesta["idempleado"]);
				}else{
					//si los datos son incorrectos se agrega un action de error y se dirige al login
					header("location:index.php?action=fallo");

				}
			}

		}
	}

	#ALUMNOS
	//Funciones necesarias para que el modulo de alumnos funcione correctamente

	//Funcion controlador que registra un alumno a una base de datos
	public function registrarAlumnoController(){
		if(isset($_POST["agregarA"])){
			//Para evitar duplicados se busca la matricula ingresada con una ya existente
			$r = Datos::buscarMatriculaModel("alumno",$_POST["matricula"]);
			//si la consulta marca que se encontro una coincidencia se imprime un mensaje y no se almacena
			if($r>0){
				//alerta de duplicacion
				echo "<script type='text/javascript'>
        					alert('Ya existe un alumno con la misma matricula');
      				  </script>";
			}else{
				//si a consulta no encuentra duplicados los datos ingresados se almacenan en un array
				$datosController = array( "matricula"=>$_POST["matricula"], 
									      "nombre"=>$_POST["nombre"],
									      "carrera"=>$_POST["carrera"],
									      "tutor"=>$_POST["tutor"]);
				//se manda a llamar el modelo que registra el alumno en la base de datos
				//mandando como parametro la tabla afectada y el array con los datos a registrar
				$respuesta=Datos::agregarAlumnoModel("alumno",$datosController);
				//si la insercion se lleva a cabo se imprime una alerta de exito
				if($respuesta){
					echo "<script type='text/javascript'>
        					alert('Alumno registrado');
      				  </script>";
				}else{
					//si no se registra el alumno tambien muestra un alerta de error
					echo "<script type='text/javascript'>
        					alert('Ocurrió un problema');
      				  </script>";
				}
			}
		}
	}
	//Funcion controlador que muestra los datos existentes en la vista de alumnos
	public function vistaAlumnosController(){
		//Se manda a llamar el modelo que genera la consulta select para mostrar los alumnos existentes en la bd
		$respuesta = Datos::consultarModel("alumno");
		//si la consulta en el modelo se ejecuta exitosamente se recorre el array devuelto para imprimir los alumnos
		if($respuesta){
			foreach ($respuesta as $fila) {
				//para poder cambiar el id de la carrera para que se muestre solo el nombre se ejecuta otro modelo que busca el nombre de la carrera por su id
				$carrera = Datos::buscarCarreraModel($fila["id_carrera"]);
				//para el tutor se ejecuta otro modelo que busca sus datos y muestra su nombre en la tabla
				$tutor = Datos::buscarTutorModel($fila["id_tutor"]);
				//se imprimen las filas de las tablas
				echo'<tr>
				<td>'.$fila["matricula"].'</td>
				<td>'.$fila["nombre"].'</td>
				<td>'.$carrera["siglas"].'</td>
				<td>'.$tutor["nombre"].'</td>
				<td><a href="index.php?action=editaralumno&id='.$fila["matricula"].'">Modificar</a></td>
				<td><a href="index.php?action=alumnos&idBorrar='.$fila["matricula"].'">Borrar</a></td>
				</tr>';
			}
		}
			
	}

	//Funcion controlador que obtiene todas las carreras existentes en la base de datos
	public function traerCarrerasController(){
		//se ejecuta el modelo que consulta las carreras existentes
		$respuesta = Datos::consultarModel("carrera");
		//se comprueba que la consulta se haya llevado a cabo y se imprimen en el select2
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<option value="'.$fila["id"].'">'.$fila["nombre"].'</option>';
			}
		}
	}
	//Funcion controlador que obtiene todas los maestros existentes en la base de datos
	public function traerMaestrosController(){
		//se ejecuta el modelo que consulta las maestros existentes
		$respuesta = Datos::consultarModel("maestro");
		//se comprueba que la consulta se haya llevado a cabo y se imprimen en el select2
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<option value="' . $fila["idempleado"] . '">'. $fila["nombre"] . '</option>';
			}
		}
	}
	public function traerAlumnosController(){
		//se obtiene el id del tutor mediante la url para solo mostrar los alumnos que son sus tutorados
		$id = $_GET["iddos"];
		//se ejecuta el modelo que consulta los alumnos existentes
		$respuesta = Datos::consultarAlumnosModel("alumno",$id);
		//se comprueba que la consulta se haya llevado a cabo y se imprimen en el select2
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo '<option value="'.$fila['matricula'] .'">'.$fila["nombre"] . '</option>';	
			}
		}
	}
	//Funcion que trae los datos de un alumno a la vista para poder modificarlos
	public function editarAlumnoController(){
		//Se obtiene el id del alumno mediante la url
		$datosController = $_GET["id"];
		//Se ejecuta el modelo que contiene la consulta en donde se busca el alumno en la base de datos
		$respuesta = Datos::editarAlumnosModel($datosController);
		//se obtienen todas las carreras en el select2
		$carreras = Datos::consultarModel("carrera");
		//se obtiene la carrera ala que pertenece el alumno
		$c = Datos::buscarCarreraModel($respuesta["id_carrera"]);
		//se obtienen todos los tutores en el select2
		$tutores = Datos::consultarModel("maestro");
		//se obtiene el tutor del alumno
		$t = Datos::buscarTutorModel($respuesta["id_tutor"]);
		//se imprimen todos los inputs con la informacion del alumno con los select2 en donde en cada uno se compara que no se agregue dos veces la opcion de la carrera a la que pertenece actualmente el alumno
		echo'<input type="text" value="'.$respuesta["matricula"].'" name="mat" readonly required>
			<input type="text" value="'.$respuesta["nombre"].'" name="nom" required>
			<select class="js-example-basic-single" name="carreras" id="carreras">';
				echo '<option value=' . $c['id'] . '>'. $c["nombre"] . '</option>';
				foreach ($carreras as $fila) {
					if($fila["id"] != $c["id"]){
						echo '<option value=' . $fila['id'] . '>'. $fila["nombre"] . '</option>';
					}
				}
			echo'</select>';
			echo "<br><br>";
			echo '<select class="js-example-basic-single" name="tutores" id="tutores">';
				echo '<option value=' . $t['idempleado'] . '>'. $t["nombre"] . '</option>';
				foreach ($tutores as $fila) {
					if($fila["idempleado"] != $t["idempleado"]){
						echo '<option value=' . $fila['idempleado'] . '>'. $fila["nombre"] . '</option>';
					}
				}
		
			echo'</select>';
			echo '<br><br><input type="submit" name="modificarA" class="button tiny" value="Modificar" style="background-color: black; margin-left: 600px">';
	}

	//Function controler que ejecuta la modificacion de datos del alumno
	public function modificarAlumnoController(){
		//Se compruba que el boton de modificar haya sido presionado
		if(isset($_POST["modificarA"])){
			//se almacenan los datos en un array
			$datosController = array( "matricula"=>$_POST["mat"], 
									      "nombre"=>$_POST["nom"],
									      "carrera"=>$_POST["carreras"],
									      "tutor"=>$_POST["tutores"]);
			//se ejecuta el modelo que tiene la actualizacion de los datos en la base de datos
			$respuesta = Datos::modificarAlumnosModel($datosController);
			if($respuesta){
				//si la consulta se lleva a cabo se redirige a la pagina principal de alumnos para visualizar los cambios
				header("Location: index.php?action=alumnos");
			}
		}
	}

	//Funcion que borra un alumno de la base de datos
	//Nota: La eliminacion de los registros es logica, es decir, solo se borran superficialmente pero no de la base de datos para evitar conflictos con llaves foraneas
	public function borrarAlumnoController(){
		//Se comprueba que el id del registro se haya pasado por url
		if(isset($_GET["idBorrar"])){
			//Se almacena el id
			$datosController=$_GET["idBorrar"];
			//Se ejecuta el modelo que contiene el update que se le hace al registro cambiando el campo de eliminado a 1, es decir que ya se elimino logicamente
			$respuesta = Datos::borrarAlumnosModel($datosController,"alumno");
			if($respuesta=="success"){
				//si la ejecucion arroja el success se dirige a la misma pagina de alumnos para ver los cambios
				header("Location: index.php?action=alumnos");
			}
		}
	}

	#MAESTROS
	//A continuacion se describen todos los controllers para el modulo de maestros

	//Funcion controler que registra un maestro 
	public function registrarMaestroController(){
		//Se comprueba que el boton se haya presionado
		if(isset($_POST["agregarM"])){
			//Para evitar duplicados se busca el id ingresado con uno ya existente
			$r = Datos::buscarIdModel("maestro",$_POST["id"]);
			//si la consulta marca que se encontro una coincidencia se imprime un mensaje y no se almacena
			if($r>0){
				//alerta de duplicacion
				echo "<script type='text/javascript'>
        					alert('Ya existe un maestro con el mismo identificador');
      				  </script>";
			}else{
				//si a consulta no encuentra duplicados los datos ingresados se almacenan en un array
				$datosController = array( "id"=>$_POST["id"], 
									      "nombre"=>$_POST["nombre"],
									      "carrera"=>$_POST["carrera"],
									      "email"=>$_POST["correo"],
									      "pass"=>$_POST["contra"]);
				//se manda a llamar el modelo que registra el maestro en la base de datos
				//mandando como parametro la tabla afectada y el array con los datos a registrar
				$respuesta=Datos::agregarMaestroModel($datosController);
				if($respuesta){
					//si la insercion se lleva a cabo se imprime una alerta de exito
					echo "<script type='text/javascript'>
        					alert('Maestro registrado');
      				  </script>";
				}else{
					//si la insercion no se lleva a cabo se imprime una alerta de error
					echo "<script type='text/javascript'>
        					alert('Ocurrió un problema');
      				  </script>";
				}
			}
		}
	}

	//Funcion controlador que muestra los datos existentes en la vista de maestros
	public function vistaMaestrosController(){
		//Se manda a llamar el modelo que genera la consulta select para mostrar los maestros existentes en la bd
		$respuesta = Datos::consultarModel("maestro");
		//si la consulta en el modelo se ejecuta exitosamente se recorre el array devuelto para imprimir los maestros
		if($respuesta){
			foreach ($respuesta as $fila) {
				//para poder cambiar el id de la carrera para que se muestre solo el nombre se ejecuta otro modelo que busca el nombre de la carrera por su id
				$carrera = Datos::buscarCarreraModel($fila["id_carrera"]);
				//se imprimen las filas de las tablas
				echo'<tr>
				<td>'.$fila["idempleado"].'</td>
				<td>'.$fila["nombre"].'</td>
				<td>'.$carrera["siglas"].'</td>
				<td>'.$fila["email"].'</td>
				<td>'.$fila["pass"].'</td>
				<td><a href="index.php?action=editarmaestro&id='.$fila["idempleado"].'">Modificar</a></td>
				<td><a href="index.php?action=maestros&idBorrar='.$fila["idempleado"].'">Borrar</a></td>
				</tr>';
			}
		}
	}
	//Funcion que trae los datos de un maestro con su id de la base de datos a la vista
	public function editarMaestroController(){
		//Se obtiene el id del maestro por url
		$datosController = $_GET["id"];
		//Se ejecuta el modelo que busca los datos de ese maestro
		$respuesta = Datos::editarMaestrosModel($datosController);
		//Se obtienen todas las carreras existentes con un modelo
		$carreras = Datos::consultarModel("carrera");
		//Se obtiene los datos de la carrera en la que es maestro
		$c = Datos::buscarCarreraModel($respuesta["id_carrera"]);
		//Se imprimen los datos que se encontraron en sus respectivos inputs
		//Para el select2 se compara que la carrera en la que se encuentra el maestro no se muestre dos veces
		echo'<input type="text" value="'.$respuesta["idempleado"].'" name="id" readonly required>
			<input type="text" value="'.$respuesta["nombre"].'" name="nom" required>
			<select class="js-example-basic-single" name="carreras2" id="carreras2">';
				echo '<option value=' . $c['id'] . '>'. $c["nombre"] . '</option>';
				foreach ($carreras as $fila) {
					if($fila["id"] != $c["id"]){
						echo '<option value=' . $fila['id'] . '>'. $fila["nombre"] . '</option>';
					}
				}
			echo'</select>';
			echo "<br><br>";
			echo '<input type="email" value="'.$respuesta["email"].'" name="correo" required>';
			echo '<input type="text" value="'.$respuesta["pass"].'" name="contra" required>';
			echo '<br><br><input type="submit" name="modificarM" class="button tiny" value="Modificar" style="background-color: black; margin-left: 600px">';
	}

	//Funcion que modifica los datos de un maestro en la base de datos
	public function modificarMaestroController(){
		//Se comprueba que el boton haya sido presionado
		if(isset($_POST["modificarM"])){
			//Se almacenan los datos en un array
			$datosController = array( "id"=>$_POST["id"], 
									      "nombre"=>$_POST["nom"],
									      "carrera"=>$_POST["carreras2"],
									      "email"=>$_POST["correo"],
									      "pass"=>$_POST["contra"]);
			//Se ejecuta el modelo que contiene la consulta update que cambiara los datos del maestro
			$respuesta = Datos::modificarMaestrosModel($datosController);
			if($respuesta){
				//Si se lleva a cabo se muestra la vista de maestros de nuevo para visualizar los cambios
				header("Location: index.php?action=maestros");
			}
		}
	}
	//Funcion que borra logicamente a un maestro de la base de datos
	public function borrarMaestroController(){
		//Se comprueba que exista la variable del maestro en la url
		if(isset($_GET["idBorrar"])){
			//Se almacena el id
			$datosController=$_GET["idBorrar"];
			//Se ejecuta el modelo que contiene el update que cambia el campo de eliminado de 0 a 1 para que no se muestre en la vista
			$respuesta = Datos::borrarMaestrosModel($datosController,"maestro");
			if($respuesta=="success"){
				//Si el update se ejecuta exitosamente se dirige a la pagina de maestros para visualizar cambios
				header("Location: index.php?action=maestros");
			}
		}
	}

	#CARRERAS

	//Funcion controlador que registra una carrera en la base de datos
	public function registrarCarreraController(){
		//Se comprueba que el boton haya sido presionado
		if(isset($_POST["agregarC"])){
			//Se almacenan los datos ingresados en un array
			$datosController = array( "nombre"=>$_POST["nombre"],
								      "siglas"=>$_POST["siglas"]);
			//Se ejecuta el modelo que inserta los datos a la base de datos
			$respuesta=Datos::agregarCarreraModel($datosController);
			//Si la insercion se lleva a cabo se muestra una alerta de exito, si no, se muestra una alerta de error
			if($respuesta){
				echo "<script type='text/javascript'>
    					alert('Carrera registrada');
  				  </script>";
			}else{
				echo "<script type='text/javascript'>
    					alert('Ocurrió un problema');
  				  </script>";
			}
			
		}
	}

	//Funcion controlador que muestra las carreras existentes en la base de datos
	public function vistaCarrerasController(){
		//Se ejecuta el modelo que tiene la consulta de todas las carreras
		$respuesta = Datos::consultarModel("carrera");
		//Si la consulta se ejecuta se imprimen todas los resultados en la vista
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo'<tr>
				<td>'.$fila["id"].'</td>
				<td>'.$fila["nombre"].'</td>
				<td>'.$fila["siglas"].'</td>
				<td><a href="index.php?action=editarcarrera&id='.$fila["id"].'">Modificar</a></td>
				<td><a href="index.php?action=carreras&idBorrar='.$fila["id"].'">Borrar</a></td>
				</tr>';
			}
		}	
	}

	//Funcion controlador que trae los datos de una carrera a la vista
	public function editarCarreraController(){
		//Se obtiene el id de la carrera por url
		$datosController = $_GET["id"];
		//Se ejecuta el modelo que trae los datos de esa carrera en especifico
		$respuesta = Datos::editarCarrerasModel($datosController);
		//Se imprimen los datos en sus respectivos inputs
		echo'<input type="text" value="'.$respuesta["nombre"].'" name="nom" required>
			<input type="hidden" value="'.$respuesta["id"].'" name="id" required>
			<input type="text" value="'.$respuesta["siglas"].'" name="sig" required>
			<br><br><input type="submit" name="modificarC" class="button tiny" value="Modificar" style="background-color: black; margin-left: 600px">';
	}

	//Funcion controlador que modifica los datos de una carrera
	public function modificarCarreraController(){
		//Se comprueba que el boton se haya presionado
		if(isset($_POST["modificarC"])){
			//Se almacenan los datos nuevos en un array
			$datosController = array( "id"=>$_POST["id"], 
									      "nombre"=>$_POST["nom"],
									      "siglas"=>$_POST["sig"]);
			//Se ejecuta el modelo que actualiza los datos
			$respuesta = Datos::modificarCarrerasModel($datosController);
			if($respuesta){
				//Si se actualiza se dirige a la pagina de carreras para visualizar los cambios
				header("Location: index.php?action=carreras");
			}
		}
	}

	//Funcion controlador que borra logicamente una carrera
	public function borrarCarreraController(){
		//Se comprueba que la variable con el id de la carrera este en el url
		if(isset($_GET["idBorrar"])){
			//Se almacena el id
			$datosController=$_GET["idBorrar"];
			//Se ejecuta el modelo que actualiza el campo eliminado de carrera de 0 a 1 para que no se visualice en la vista
			$respuesta = Datos::borrarCarrerasModel($datosController,"carrera");
			if($respuesta=="success"){
				//si se devuelve el success se dirige a la pagina de carreras para ver los cambios
				header("Location: index.php?action=carreras");
			}
		}
	}

	#TUTORIAS

	//Funcion controlador que registra una tutoria a la base de datos
	public function registrarTutoriaController(){
		//Se comrprueba que el boton se haya seleccionado
		if(isset($_POST["regTutoria"])){
			//Si una caja que se agrego invisible que va almacenando los alumnos agregados a la tutoria se devuelve un error en donde se imprime una alerta la que dice que se agregue al menos un alumno
			if(!empty($_POST["sc"])){
				//Se almacenan los datos ingresados en un array
				$datosController = array( "tutor"=>$_GET["iddos"], 
									      "hora"=>$_POST["hora"],
									      "fecha"=>$_POST["fecha"],
									      "desc"=>$_POST["desc"]);
				//Se obtienen los alumnos que se agregaron
				$alu = $_POST["sc"];
				//Se separa la cadena en matriculas
				$alu2 = explode(",", $alu);
				//Se obtiene el id del tutor
				$t = $_GET["iddos"];
				//Se ejecuta el modelo que registra los datos de la tutoria
				$respuesta = Datos::registrarTutoriaModel($datosController);
				if($respuesta){
					//Si la insercion se llevo a cabo se obtiene el id de la tutoria que se acaba de insertar
					$tutoria = Datos::traerUltimaTutoriaModel();
					//Se almacena el id
					$idtutoria = $tutoria["id"];
					//En este ciclo se va insertando cada alumno en la tabla de detalles
					for ($i=0; $i<sizeof($alu2); $i++) {
						//Se almacena la matricula
						$matricula = $alu2[$i];
						//Se ejecuta el modelo que registra dependiendo el numero de alumnos agregados a la tutoria
						$resp = Datos::insertarDetalleModel($idtutoria,$t,$matricula);
					}
					//Mensaje de exito
					echo "<script type='text/javascript'>
        							alert('Tutoria registrada');
      				  			</script>";
				}

			}else{
				//Mensaje de error
				echo "<script type='text/javascript'>
        					alert('No puede registrar una tutoria sin alumnos');
      				  </script>";
			}
		}
	}

	//Funcion controlador que muestra todas las tutorias del tutor que haya ingresado
	public function vistaTutoriasController(){
		//se obtienen las variables de la url
		$id = $_GET["id"];
		$id2 = $_GET["iddos"];
		//Se ejecuta el modelo que trae los datos de las tutorias
		$respuesta = Datos::consultarTModel($id2);
		if($respuesta){
			//Si se ejecuta se imprime por cada registro una fila en la tabla
			foreach ($respuesta as $fila) {
				echo'<tr>
				<td>'.$fila["hora"].'</td>
				<td>'.$fila["fecha"].'</td>
				<td>'.$fila["tutoria"].'</td>
				<td><a href="index.php?action=detallestutoria&id='. $id . '&iddos='. $id2 . '&idDet='.$fila["id"].'">Ver detalles</a></td>
				<td><a href="index.php?action=tutorias&id='. $id . '&iddos=' . $id2 . '&idBorrar='.$fila["id"].'">Borrar</a></td>
			</tr>';
			}
		}
	}

	//Funcion controlador que elimina una tutoria logicamente de la base de datos
	public function borrarTutoriaController(){
		//Se comprueba que el id de la tutoria este en el url
		if(isset($_GET["idBorrar"])){
			//Se almacena el id
			$id = $_GET["idBorrar"];
			//Se ejecuta el modelo que actualiza el campo eliminado de la tabla de tutoria a 1 para que ya no se muestre
			$respuesta = Datos::borrarTutoriaModel($id);
			if($respuesta=="success"){
				//Si devuelve success se dirige a la pagina de tutorias para ver los cambios
				header("Location: index.php?action=tutorias&id=".$_GET["id"]."&iddos=".$_GET["iddos"]);
			}
		}
	}

	//Funcion controlador que muestra los detalles de la tutoria
	public function detallesController(){
		//Se obtiene el id de la tutoria en la url
		$det = $_GET["idDet"];
		//Se ejecuta la consulta que busca los datos de esa tutoria
		$respuesta=Datos::consultarTutoriaModel($det);
		if($respuesta){
			//Se imprimen los datos de la consulta
			echo '<label style="font-size: 1.3em">Hora: '. $respuesta["hora"] .'</label>';
			echo '<label style="font-size: 1.3em">Fecha: '. $respuesta["fecha"] .'</label>';
			echo '<label style="font-size: 1.3em">Descripción: '. $respuesta["tutoria"] .'</label>';
			echo '<br><h4 style="font-weight:bold">Alumnos en la tutoria</h4><hr>';
			//Se buscan los detalles de esa tutoria en el modelo
			$respuesta2 = Datos::alumnosTutoriasModel($respuesta["id"]);
			if($respuesta2){
				//Si se ejecuta se imprimen los detalles obtieniendo los datos del alumno con el id de la tutoria
				foreach ($respuesta2 as $fila) {
					$alum = Datos::buscarAlumnoModel($fila["id_alumno"]);
					if($alum){
						echo '<label style="font-size: 1.3em">Matricula: '. $alum["matricula"] .'</label>';
						echo '<label style="font-size: 1.3em">Nombre: '. $alum["nombre"] .'</label>';
						echo '<hr>';
					}
					
				}
			}
		}
	}

	//Funcion controlador que muestra los datos existentes en la vista de alumnos
	public function vistaAController(){
		//Se manda a llamar el modelo que genera la consulta select para mostrar los alumnos existentes en la bd
		$respuesta = Datos::consultarModel("alumno");
		//si la consulta en el modelo se ejecuta exitosamente se recorre el array devuelto para imprimir los alumnos
		if($respuesta){
			foreach ($respuesta as $fila) {
				//para poder cambiar el id de la carrera para que se muestre solo el nombre se ejecuta otro modelo que busca el nombre de la carrera por su id
				$carrera = Datos::buscarCarreraModel($fila["id_carrera"]);
				//para el tutor se ejecuta otro modelo que busca sus datos y muestra su nombre en la tabla
				$tutor = Datos::buscarTutorModel($fila["id_tutor"]);
				//se imprimen las filas de las tablas
				echo'<tr>
				<td>'.$fila["matricula"].'</td>
				<td>'.$fila["nombre"].'</td>
				<td>'.$carrera["siglas"].'</td>
				<td>'.$tutor["nombre"].'</td>
				</tr>';
			}
		}
			
	}

	//Funcion controlador que muestra los datos existentes en la vista de maestros
	public function vistaMController(){
		//Se manda a llamar el modelo que genera la consulta select para mostrar los maestros existentes en la bd
		$respuesta = Datos::consultarModel("maestro");
		//si la consulta en el modelo se ejecuta exitosamente se recorre el array devuelto para imprimir los maestros
		if($respuesta){
			foreach ($respuesta as $fila) {
				//para poder cambiar el id de la carrera para que se muestre solo el nombre se ejecuta otro modelo que busca el nombre de la carrera por su id
				$carrera = Datos::buscarCarreraModel($fila["id_carrera"]);
				//se imprimen las filas de las tablas
				echo'<tr>
				<td>'.$fila["idempleado"].'</td>
				<td>'.$fila["nombre"].'</td>
				<td>'.$carrera["siglas"].'</td>
				<td>'.$fila["email"].'</td>
					<td>'.$fila["pass"].'</td>
				</tr>';
			}
		}
	}

	//Funcion controlador que muestra las carreras existentes en la base de datos
	public function vistaCController(){
		//Se ejecuta el modelo que tiene la consulta de todas las carreras
		$respuesta = Datos::consultarModel("carrera");
		//Si la consulta se ejecuta se imprimen todas los resultados en la vista
		if($respuesta){
			foreach ($respuesta as $fila) {
				echo'<tr>
				<td>'.$fila["id"].'</td>
				<td>'.$fila["nombre"].'</td>
				<td>'.$fila["siglas"].'</td>
				</tr>';
			}
		}	
	}

	//Funcion controlador que muestra todas las tutorias del tutor que haya ingresado
	public function vistaTController(){
		$respuesta = Datos::buscarTutModel();
		if($respuesta){
			//Si se ejecuta se imprime por cada registro una fila en la tabla
			foreach ($respuesta as $fila) {
				$i = $fila["id_maestro"];
				$nombre = Datos::buscarNombreTutorModel($i);
				echo'<tr>
				<td>'.$nombre["nombre"].'</td>
				<td>'.$fila["hora"].'</td>
				<td>'.$fila["fecha"].'</td>
				<td>'.$fila["tutoria"].'</td>
			</tr>';
			}
		}
	}

}

?>

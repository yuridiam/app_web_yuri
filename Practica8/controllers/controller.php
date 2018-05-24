<?php

Class MvcController{


	public function pagina(){	
		
		//include "views/modules/ingresar.php";
		include "views/template.php";
	
	}

	public function enlacesPaginasController(){

		if(isset( $_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}

		else{

			$enlaces = "index";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}

	#IDENTIFICACION DE USUARIOS

	public function ingresoUsuarioController(){

		if(isset($_POST["ingresar"])){

			if($_POST["correo"]=="superadmin@gmail.com" && $_POST["contra"]=="admin123"){

				session_start();
				$_SESSION["validar"] = true;
				header("location:index.php?action=alumnos");

			}else{

				$datosController = array( "correo"=>$_POST["correo"], 
									      "contra"=>$_POST["contra"]);

				$respuesta = Datos::ingresoUsuarioModel($datosController, "maestro");

				if($respuesta["email"] == $_POST["correo"] && $respuesta["pass"] == $_POST["contra"]){

					session_start();

					$_SESSION["validar"] = true;

					header("location:index.php?action=tutorias&id=".$respuesta['nombre']."&iddos=".$respuesta["idempleado"]);

				}

				else{

					header("location:index.php?action=fallo");

				}
			}

		}
	}

	#ALUMNOS

	public function registrarAlumnoController(){
		if(isset($_POST["agregarA"])){

			$r = Datos::buscarMatriculaModel("alumno",$_POST["matricula"]);
			if($r>0){
				echo "<script type='text/javascript'>
        					alert('Ya existe un alumno con la misma matricula');
      				  </script>";
			}else{
				$datosController = array( "matricula"=>$_POST["matricula"], 
									      "nombre"=>$_POST["nombre"],
									      "carrera"=>$_POST["carrera"],
									      "tutor"=>$_POST["tutor"]);
				$respuesta=Datos::agregarAlumnoModel("alumno",$datosController);
				if($respuesta){
					echo "<script type='text/javascript'>
        					alert('Alumno registrado');
      				  </script>";
				}else{
					echo "<script type='text/javascript'>
        					alert('Ocurrió un problema');
      				  </script>";
				}
			}
		}
	}

	public function vistaAlumnosController(){
		$respuesta = Datos::consultarModel("alumno");

		foreach ($respuesta as $fila) {
			$carrera = Datos::buscarCarreraModel($fila["id_carrera"]);
			$tutor = Datos::buscarTutorModel($fila["id_tutor"]);
		
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

	public function traerCarrerasController(){
		return $respuesta = Datos::consultarModel("carrera");
	}
	public function traerMaestrosController(){
		return $respuesta = Datos::consultarModel("maestro");
	}

	public function editarAlumnoController(){
		$datosController = $_GET["id"];
		$respuesta = Datos::editarAlumnosModel($datosController);
		$carreras = Datos::consultarModel("carrera");
		$c = Datos::buscarCarreraModel($respuesta["id_carrera"]);
		$tutores = Datos::consultarModel("maestro");
		$t = Datos::buscarTutorModel($respuesta["id_tutor"]);
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


	public function modificarAlumnoController(){
		if(isset($_POST["modificarA"])){
			$datosController = array( "matricula"=>$_POST["mat"], 
									      "nombre"=>$_POST["nom"],
									      "carrera"=>$_POST["carreras"],
									      "tutor"=>$_POST["tutores"]);
			$respuesta = Datos::modificarAlumnosModel($datosController);
			if($respuesta){
				header("Location: index.php?action=alumnos");
			}
		}
	}

	public function borrarAlumnoController(){
		if(isset($_GET["idBorrar"])){
			$datosController=$_GET["idBorrar"];
			$respuesta = Datos::borrarAlumnosModel($datosController,"alumno");
			if($respuesta=="success"){
				header("Location: index.php?action=alumnos");
			}
		}
	}

	#MAESTROS

	public function registrarMaestroController(){
		if(isset($_POST["agregarM"])){
			$r = Datos::buscarIdModel("maestro",$_POST["id"]);
			if($r>0){
				echo "<script type='text/javascript'>
        					alert('Ya existe un maestro con el mismo identificador');
      				  </script>";
			}else{
				$datosController = array( "id"=>$_POST["id"], 
									      "nombre"=>$_POST["nombre"],
									      "carrera"=>$_POST["carrera"],
									      "email"=>$_POST["correo"],
									      "pass"=>$_POST["contra"]);
				$respuesta=Datos::agregarMaestroModel($datosController);
				if($respuesta){
					echo "<script type='text/javascript'>
        					alert('Maestro registrado');
      				  </script>";
				}else{
					echo "<script type='text/javascript'>
        					alert('Ocurrió un problema');
      				  </script>";
				}
			}
		}
	}

	public function vistaMaestrosController(){
		$respuesta = Datos::consultarModel("maestro");

		foreach ($respuesta as $fila) {
			$carrera = Datos::buscarCarreraModel($fila["id_carrera"]);
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

	public function editarMaestroController(){
		$datosController = $_GET["id"];
		$respuesta = Datos::editarMaestrosModel($datosController);
		$carreras = Datos::consultarModel("carrera");
		$c = Datos::buscarCarreraModel($respuesta["id_carrera"]);
		
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


	public function modificarMaestroController(){
		if(isset($_POST["modificarM"])){
			$datosController = array( "id"=>$_POST["id"], 
									      "nombre"=>$_POST["nom"],
									      "carrera"=>$_POST["carreras2"],
									      "email"=>$_POST["correo"],
									      "pass"=>$_POST["contra"]);
			$respuesta = Datos::modificarMaestrosModel($datosController);
			if($respuesta){
				header("Location: index.php?action=maestros");
			}
		}
	}

	public function borrarMaestroController(){
		if(isset($_GET["idBorrar"])){
			$datosController=$_GET["idBorrar"];
			$respuesta = Datos::borrarMaestrosModel($datosController,"maestro");
			if($respuesta=="success"){
				header("Location: index.php?action=maestros");
			}
		}
	}

	public function registrarCarreraController(){
		if(isset($_POST["agregarC"])){
			
			$datosController = array( "nombre"=>$_POST["nombre"],
								      "siglas"=>$_POST["siglas"]);
			$respuesta=Datos::agregarCarreraModel($datosController);
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

	public function vistaCarrerasController(){
		$respuesta = Datos::consultarModel("carrera");

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

	public function editarCarreraController(){
		$datosController = $_GET["id"];
		$respuesta = Datos::editarCarrerasModel($datosController);
		echo'<input type="text" value="'.$respuesta["nombre"].'" name="nom" required>
			<input type="hidden" value="'.$respuesta["id"].'" name="id" required>
			<input type="text" value="'.$respuesta["siglas"].'" name="sig" required>
			<br><br><input type="submit" name="modificarC" class="button tiny" value="Modificar" style="background-color: black; margin-left: 600px">';
	}

	public function modificarCarreraController(){
		if(isset($_POST["modificarC"])){
			$datosController = array( "id"=>$_POST["id"], 
									      "nombre"=>$_POST["nom"],
									      "siglas"=>$_POST["sig"]);
			$respuesta = Datos::modificarCarrerasModel($datosController);
			if($respuesta){
				header("Location: index.php?action=carreras");
			}
		}
	}

	public function borrarCarreraController(){
		if(isset($_GET["idBorrar"])){
			$datosController=$_GET["idBorrar"];
			$respuesta = Datos::borrarCarrerasModel($datosController,"carrera");
			if($respuesta=="success"){
				header("Location: index.php?action=carreras");
			}
		}
	}

}

?>

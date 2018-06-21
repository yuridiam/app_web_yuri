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
			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
			//Si los datos son encontrados en el modelo se inicia la sesion
			if($respuesta){
				//se inicia la sesion
				session_start();
				//Se crean las variables de sesion necesarias
				$_SESSION["validar"] = true;
				//$_SESSION["usuario"] = $respuesta["nombre"];
				//$_SESSION["id"] = $respuesta["id_usuario"];
				//$_SESSION["tienda"] = $respuesta["id_tienda"];
				//$_SESSION["contra"]=$respuesta["pass"];

				header("location:index.php?action=alumnas");

			}else{
				//Si los datos no son correctos se dirige al login de nuevo
				//header("location:index.php?action=error");
				header("location:index.php?action=fallo");
			}

		}
	}

}

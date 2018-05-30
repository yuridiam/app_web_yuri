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
			if($_POST["usuario"]=="admin" && $_POST["contra"]=="admin"){
				//se inicia la sesion
				session_start();
				//se valida como verdadera
				$_SESSION["validar"] = true;
				//se dirige a la vista de un superadmin
				header("location:index.php?action=productos");

			}

		}
	}

}

?>

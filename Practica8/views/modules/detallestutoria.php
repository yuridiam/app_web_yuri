<?php
	//Se inicia sesion
	session_start();
	//Se valida la sesion
	if(!$_SESSION["validar"]){
		//Si no esta loggeado manda al login
		header("location:index.php?action=ingresar");
		exit();
	}
	//Se obtiene las variables de la url
	if(isset($_GET["id"])){
		$id = $_GET["id"];
	}
	if(isset($_GET["iddos"])){
		$id2 = $_GET["iddos"];
	}
?>

<a href="index.php?action=tutorias&id=<?php echo $id;?>&iddos=<?php echo $id2;?>"><button class="button tiny" style="background-color: black; margin-left: 950px">Regresar</button></a>
<form style="font-family: Arial; width: 50%; margin-left: 350px">
	<h1>Detalles de tutoria</h1>
	<hr>
	<?php
		//Se crea una nueva instancia del controlador
		$vistaDetalles = new MvcController();
		//Se manda a llamar el controlador de la vista
		$vistaDetalles->detallesController();
	?>

</form>
<?php
	//Se carga el modelo enlaces para la navegacion del sitio
	require_once "models/enlaces.php";
  //Se carga el crud que contiene todos los modelos que utilizan los controllers
	require_once "models/crud.php";
  //Se carga el controller principal que hace posible la funcionalidad del sito
	require_once "controllers/controller.php";

  //Se crea una instancia del controler
	$mvc = new MvcController();
  //Se manda a llamar el metodo que carga el template del sitio
	$mvc->pagina();
?>

<?php 
	function saludos($nombre,$apellido){
		$var = "Hello" . $nombre . " " . $apellido . "!" . "<br>" . "Hello" . $nombre . " " . $apellido . "!" . "<br>" . "Greetings" . $nombre . " " . $apellido . "!!!" . "<br>" . "Greetings" . $nombre . " " . $apellido;
		return $var;
	}

	$imprimir = saludos("Yuridia", "Montelongo");
	echo $imprimir;
?>
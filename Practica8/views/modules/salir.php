<?php
//se inicia sesion
session_start();
//se destruye sesion
session_destroy();
//se dirige al index
header("location: index.php");

?>
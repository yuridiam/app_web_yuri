<!--Es la plantilla que vera el usuario al ejecutar la aplicación -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Template</title>
    <link rel="stylesheet" href="views/css/foundation.css" />
    <script src="views/js/vendor/modernizr.js"></script>

	<style>

		nav{
			position:relative;
			margin:auto;
			width:100%;
			height:auto;
			background:darkblue;
		}

		nav ul{
			position:relative;
			margin:auto;
			width:70%;
			text-align: center;
		}

		nav ul li{
			display:inline-block;
			width:15%;
			line-height: 40px;
			list-style: none;
		}

		nav ul li a{
			color:white;
			text-decoration: none;
		}
		nav ul li a:hover{
			color: yellow;
		}

		section{
			position: relative;
			margin: auto;
			width:400px;
		}

		section h1{
			position: relative;
			margin: auto;
			padding:10px;
			text-align: center;
		}

		section form{
			position:relative;
			margin:auto;
			width:400px;
		}

		section form input{
			display:inline-block;
			padding:10px;
			width:95%;
			margin:5px;
		}

		section form input[type="submit"]{
			position:relative;
			margin:20px auto;
			left:4.5%;

		}

		table{
			position:relative;
			margin:auto;
			width:100%;
			left:-10%;
		}

		table thead tr th{
			padding:10px;
		}

		table tbody tr td{
			padding:10px;
		}
	</style>

</head>

<body>

<?php include "modules/navegacion.php"; ?>


<section>

<?php 

$mvc = new MvcController();
$mvc -> enlacesPaginasController();

 ?>

</section>
	
</body>

</html>
<?php
	//se valida la sesion
	session_start();

	if(!$_SESSION["validar"]){

		header("location:index.php?action=ingresar");

		exit();

	}

?>

<h1 style="font-weight: bold">REGISTRO DE PRODUCTOS by MR</h1>

<form method="post">
	<input type="text" placeholder="Product" name="productName" required>
	<input type="text" placeholder="Description" name="ProductDescription" required>
	<input type="text" placeholder="Buy price" name="ProductBuyPrice" required>
	<input type="text" placeholder="Sale price" name="ProductSalePrice" required>
	<input type="text" placeholder="Price" name="ProductPrice" required>
	<input type="submit" value="Enviar" class="button tiny" style="width: 100%; margin-left: -20px; background-color: yellow; color: black" name="productoRegistro">
</form>

<?php
//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
$registro = new MvcControllerProducto();
//se invoca la función registroProductosController de la clase MvcController:
$registro -> registroProductoController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>

<?php
	//se manda a llamar el archivo que contiene la clase
	require("source.php");
	//se valida el submit
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//se crea la instancia de la clase con los valores de sus propiedades
		$g="";
		$in = new Validacion();
		$in -> name = $_POST["name"];
		$in -> email = $_POST["email"];
		if(!empty($_POST["gender"])){
			$g=$_POST["gender"];
		}
		$in -> gender = $g;
		$in -> comment = $_POST["comment"];
		$in -> website = $_POST["website"];
		$in -> validarNombre();
		$in -> validarEmail();
		$in -> validarWebsite();
		$in -> validarComment();
		$in -> validarGender();
		
	}

?>
<html>
<head>
    <title>Formulario en PHP7</title>
</head>

<body>
	<h2>PHP Form Validation Example</h2>
	<p><span class="error">* required field.</span></p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	    Name: <input type="text" name="name" value="<?php if(isset($in->name)){ echo $in -> name; }?>">
	    <span class="error">* <?php if(isset($in->nameErr)){echo $in -> nameErr;}?></span>
	    <br><br>
	    E-mail: <input type="text" name="email" value="<?php if(isset($in->email)){echo $in -> email;}?>">
	    <span class="error">* <?php if(isset($in->emailErr)){echo $in -> emailErr;}?></span>
	    <br><br>
	    Website: <input type="text" name="website" value="<?php if(isset($in->website)){echo $in -> website;}?>">
	    <span class="error"><?php if(isset($in->websiteErr)){echo $in -> websiteErr;}?></span>
	    <br><br>
	    Comment: <textarea name="comment" rows="5" cols="40"><?php if(isset($in->comment)){echo $in -> comment;}?></textarea>
	    <br><br>
	    Gender:
	    <input type="radio" name="gender" <?php if (isset($in -> gender)){ $g = $in->gender; if($g=="female"){echo "checked";}}?> value="female">Female
	    <input type="radio" name="gender" <?php if (isset($in -> gender)){ $g = $in->gender; if($g=="male"){echo "checked";}}?> value="male">Male
	    <span class="error">* <?php if(isset($in->genderErr)){echo $in -> genderErr;}?></span>
	    <br><br>
	    <input type="submit" name="submit" value="Submit">
	</form>
	<?php 
		//se imprime los datos que se escribieron en el formulario
		if(isset($in)){
			$in -> print();
		}

	?>
<ul>
    <li><a href="#">Volver al Inicio</a></li>
</ul>
</body>
</html>
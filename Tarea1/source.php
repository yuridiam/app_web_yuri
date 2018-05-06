<?php 
	//funcion que trabaja con el texto ingresado
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	//clase que contiene los metodos de validacion para cada campo
	class Validacion{
		//propiedades 
		public $nameErr;
		public $emailErr;
		public $genderErr;
		public $websiteErr;
		public $name;
		public $email;
		public $gender;
		public $comment;
		public $website;

		//metodo que imprime los datos
		public function print(){
			echo "<h2>Your Input:</h2>";
			echo $this->name;
			echo "<br>";
			echo $this->email;
			echo "<br>";
			echo $this->website;
			echo "<br>";
			echo $this->comment;
			echo "<br>";
			echo $this->gender;
		}

		//metodo de validacion del nombre
		public function validarNombre(){
			//revisa si la cadena contiene algo
			if (empty($this->name)) {
		        $this->nameErr = "Name is required";
		    } else {
		    	//comprueba el texto
		        $name = test_input($this->name);
		        // verifica si el nombre solo contiene letras y espacios
		        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		            $this->nameErr = "Only letters and white space allowed";
		        }
		    }
		}

		//metodo para validar el correo
		public function validarEmail(){
			//verifica si el campo esta vacio
			if (empty($this->email)) {
        		$this->emailErr = "Email is required";
    		} else {
    			//comprueba el texto
        		$email = test_input($this->email);
        		//verifica si el correo esta bien formado
        		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            		$this->emailErr = "Invalid email format";
        		}
    		}
		}

		//metodo que valida el sitio web
		public function validarWebsite(){
			//verficia si esta vacio
			if (empty($this->website)) {
        		$this->website = "";
    		} else {
    			//compruba el texto
        		$website = test_input($this->website);
        		//verifica si la direccion url es valida
        		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
            		$this->websiteErr = "Invalid URL";
        		}
    		}
		}

		//metodo que valida el comentario
		public function validarComment(){
			//si el campo esta vacio
			if (empty($this->comment)) {
        		$this->comment = "";
    		} else {
        		$comment = test_input($this->comment);
    		}
		}
		//metodo que valida que se haya seleccionado un genero
		public function validarGender(){
			//si el campo esta vacio
			if (empty($this->gender)) {
        		$this->genderErr = "Gender is required";
    		} else {
        		$gender = test_input($this->gender);
    		}
		}

	}


?>
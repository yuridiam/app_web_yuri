<?php
//Clase ue controla la navegacion del sitio
	class Paginas{
		//unico metodo que verifica que action se ejecuto
		public function enlacesPaginasModel($enlaces){

			if($enlaces=="index" || $enlaces=="fallo"){
				$module =  "views/modules/ingresar.php";
			}else{
				$module =  "views/modules/".$enlaces.".php";
			}

			//se retorna la pagina a la que se dirige
			return $module;

		}
	}


?>
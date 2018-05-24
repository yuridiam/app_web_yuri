<?php

	class Paginas{
		
		public function enlacesPaginasModel($enlaces){

			if($enlaces=="index" || $enlaces=="fallo"){
				$module =  "views/modules/ingresar.php";
			}else{
				$module =  "views/modules/".$enlaces.".php";
			}
			return $module;

		}
	}


?>
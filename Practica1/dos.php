<?php 
	
	$arraynum = array("1", "2", "3", "4", "5", "6");

	for ($i=0; $i < sizeof($arraynum); $i++) { 
		if($i=="4"){
			echo $arraynum[$i];
		}
	}

?>
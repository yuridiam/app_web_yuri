<?php 

	//Array ascendente y descendente

	$array = array(1, 5, 7, 2, 9, 11, 23, 3);
	echo "Array original: ";
	print_r($array);
	echo "<br>";
	sort($array);
	echo "Array ordenado ascendentemente: ";
	print_r($array);
	echo "<br>";
	rsort($array);
	echo "Array ordendado descendentemente: ";
	print_r($array);

?>
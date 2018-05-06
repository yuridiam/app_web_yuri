<?php 
	//Yuridia Gpe Montelongo Padilla
	//Clase que contiene el método que realiza los cálculos sobre un arreglo y lo convierte a otro en una serie fibonacci
	class Fibonacci{
		//propiedad de la clase que representa un arreglo que sera el que contendra la serie de numeros
		public $arreglo;
		//metodo que realiza la suma y crea el nuevo arreglo que contendra la serie fibonacci
		public function ex(){
			//nuevo arreglo
			$arr = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
			//se toma las primeras posiciones del arreglo que contiene los numeros y se agregan al nuevo arreglo
			$arr[0] = $this->arreglo[0];
			$arr[1] = $this->arreglo[1];
			//ciclo for que realiza la sumatoria para crear la serie de fibonacci
			for ($i=2; $i < 25 ; $i++) { 
				$arr[$i] = $arr[$i-1] + $arr[$i-2];
			}
			//impresion de los dos arreglos
			echo "Arreglo anterior: ";
			print_r($this->arreglo);
			echo "<br><br>";
			echo "Arreglo generado: ";
			print_r($arr);

		}
	}
	//instancia de la clase 
	$a = new Fibonacci();
	$a -> arreglo = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25");

	$a -> ex();



?>
<?php
	//carga de datos existentes en el .txt
    if(file_exists("registros.txt")){
    	//se intenta abrir el archivo
        $file = fopen("registros.txt", "r");
        //ciclo que carga los registros dependiendo de su tipo
        while (!feof($file)){
            $r = fgets($file);
            $array = explode(",", $r);
            if($array[0] != ""){
            	//array para alumno
                if($array[0] == "alumno"){
                    $user_access1[] = [
                        'id' => $array[1],
                        'nombre' => $array[2],
                        'carrera' => $array[3],
                        'correo' => $array[4],
                        'telefono' => $array[5]
                    ];
                }else{
                	//array para maestro
                   $user_access2[] = [
                        'id' => $array[1],
                        'nombre' => $array[2],
                        'carrera' => $array[3],
                        'correo' => $array[4],
                        'telefono' => $array[5]
                    ]; 
                }
            }else{
                break;
            }
        }
        fclose($file);
    }
?>

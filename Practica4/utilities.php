<?php
    if(file_exists("registros.txt")){
        $file = fopen("registros.txt", "r");
        while (!feof($file)){
            $r = fgets($file);
            $array = explode(",", $r);
            if($array[0] != ""){
                if($array[0] == "alumno"){
                    $user_access1[] = [
                        'id' => $array[1],
                        'nombre' => $array[2],
                        'carrera' => $array[3],
                        'correo' => $array[4],
                        'telefono' => $array[5]
                    ];
                }else{
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

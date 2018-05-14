<?php
	require_once("funciones.php");
	//obtiene el id del usuario que se desea eliminar
	$id = isset( $_GET['id'] ) ? $_GET['id'] : '';
	//variable que funciona como bandera para saber si el usuario confirmo que quiere eliminar un registro
	$b = isset( $_GET['b'] ) ? $_GET['b'] : '';
	if($b==1){
		//aplica la funcion para eliminar al usuario por su id
		$res=delete($id);
		if($res){
			//redireccione a la pagina principal para ver que el registro ya no se ve en la tabla
			header("Location: basquetbol.php");
		}
	}
?>

<script type="text/javascript">
	//funcion de javascript que obtiene las variables en la url
	function getUrlVars() {
	    var vars = {};
	    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	        vars[key] = value;
	    });
	    return vars;
	}
	//se convoca a la funcion para obtener las variables de la url
	var id = getUrlVars();
	var id2 = ""+id["id"];
	//se almacena la respuesta del usuario con el confirm
	var c = confirm("¿Está seguro que desea eliminar este basquetbolista?");
	if(c){
		//se redireciona con la respuesta del usuario y el mismo id del registro
		location.href="eliminar_basquetbol.php?id="+id2+"&b=1";
	}else{
		location.href="basquetbol.php";
	}
</script>
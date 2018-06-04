<script type="text/javascript">
  //Funcion que trae las variables de la url
	function getUrlVars() {
      var vars = {};
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
          vars[key] = value;
      });
      return vars;
    }
    //Se obtienen las variables
    var id = getUrlVars();
    var borrar = ""+id["idBorrar"];
    var pass = prompt("Ingrese su contraseña");
    var contra = ""+pass;
    //Se comprueba loq ue se ingreso en el prompt
    if(contra!="" && contra!=undefined && contra!="null"){
      //Se dirige a la pagina con las nuevas variables
    	document.location.href="index.php?action=inventario"+"&id="+borrar+"&contra="+contra;
    }else{
      //Se dirige a la vista con un alert de error
    	document.location.href="index.php?action=inventario";
    	alert("No ingreso ninguna contraseña");
    }
</script>
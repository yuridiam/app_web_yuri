<?php 
  //se manda a llamar el archivo que contiene todas las funciones necesarias
  require_once("db/funciones.php");
  $productos = run_app(2);
  $cont=0;
  //se comprueba que se asignado el total que lleva de la venta
  if(isset($_POST["tot"])){
    $cont++;

    if($cont==1){
      //obtiene la fecha actual
        $fecha = getdate();
        //transforma la fecha
        if($fecha["mon"]==1 || $fecha["mon"]==2 || $fecha["mon"]==3 || $fecha["mon"]==4 || $fecha["mon"]==5 || $fecha["mon"]==6 || $fecha["mon"]==7 || $fecha["mon"]==8 || $fecha["mon"]==9){
          $mon = "0"."$fecha[mon]";
        }
        $f = $fecha["mday"]."-". $mon."-". $fecha["year"];
        //registra la venta con su fecha
        $r = registrar_venta($_POST["tot"],$f);
        $cont++;
        global $pdo;
        //selecciona la ultima insercion a la tabla para ingresar los productos de esa venta
        $sql="SELECT MAX(id) AS id FROM venta";
        $stm = $pdo->prepare($sql);
        $stm->execute();
        $res = $stm->fetch();
        $idventa=$res["id"];
    }
    if($cont>1){
      //crea una consulta por cada seccion de caja que cree 
      if(isset($_POST["cajas"])){
        $num = $_POST["cajas"];
        for ($i=1; $i <=$num ; $i++) { 
          $id = "idp".$i;
          $nombre = "nombre".$i;
          $precio = "precio".$i;
          $cantidad = "cant".$i; 
          $id2=$_POST[$id];
          $nombre2=$_POST[$nombre];
          $precio2=$_POST[$precio];
          $cantidad2=$_POST[$cantidad];
          $t = $precio2*$cantidad2;
          //registra los detalles de la venta
          $res = registrar_detalle($idventa, $id2, $cantidad2,$t,$precio2);
        }
      }
      //muestra un mensaje de confirmacion
      echo "<script type='text/javascript'>
            alert('Venta realizada');
          </script>";
    }
  }
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nueva Venta</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
     
    <div class="large-10 columns">
        <ul class="right button-group">
          <li><a href="./ventas.php" class="button radius tiny" style="background-color: #1A191A">Regresar</a></li>&nbsp;
          <li><a href="./cerrar_sesion.php" class="button radius tiny" style="background-color: #1A191A">Cerrar Sesión</a></li>
        </ul>
      </div>

    <div class="row">
 
      <div class="large-11 columns">
        <h2 style="font-weight: bold">Nueva Venta</h2>
        <hr>
        <div class="section-container tabs" data-section>
          <section class="section">
            <h4 id="total" style="font-weight: bold; margin-left: 750px; color: red"></h4>
              <form method="post" action="nueva_venta.php" id="formu" name="formu">
                <div class="large-4 columns">
                <label for="produ">Producto </label>
                <select name="produ" id="produ">
                  <?php
                    foreach ($productos as $fila) {
                  ?>
                    <option value="<?php echo $fila['id'];?>"><?php echo $fila["nombre"] . " $".$fila["preciounitario"];?></option>
                  <?php
                    }
                  ?>
                </select>
                </div>
                <div class="large-2 columns">
                <label>Cantidad </label>
                <input type="text" name="cantidad" id="cantidad" required>
                </div>
                <div class="large-6 columns">
                <input type="button" class="button radius tiny" style="background-color: blue; color: white; margin-top: 20px; height: 37px" name="agregar" value="Agregar" onclick="ag();">&nbsp;<input type="button" class="button radius tiny" style="background-color: green; color: white; margin-top: 20px; height: 37px" name="realizar" value="Realizar Venta" onclick="re();"><br><br>
                <input type="text" name="tot" id="tot" style="visibility: hidden">
                <input type="text" name="cajas" id="cajas" style="visibility: hidden">
                </div>
              </form>
      </section>
  </div>
</div>
</div>
<script type="text/javascript">
  var cont=0;
  var total=0;
  //obtiene los elementos necesarios
    var t = document.getElementById("total");
    var f = document.getElementById("formu");
    var tin = document.getElementById("tot");
    var caj = document.getElementById("cajas");
    var h2 = document.createElement("h3");
    var tx = document.createTextNode("Productos Agregados");
    h2.setAttribute("style","font-weight: bold");
    h2.appendChild(tx);
    //esta funcion crea los inputs necesarios para cada atributo de cada producto dinamicamente
    function ag(){
      cont++;
      if(cont==1){
        f.appendChild(h2);
        //obtener valores de las cajas de texto de venta y agregar los productos dinamicamente
        var lab = document.createElement("label");
        lab.innerHTML="Identificador ";
        //id
        var temp = document.createElement("input");
        var lab2 = document.createElement("label");
        lab2.innerHTML="Producto ";
        //nombre
        var temp2 = document.createElement("input");
        var lab3 = document.createElement("label");
        lab3.innerHTML="Precio Unitario ";
        //precio
        var temp3 = document.createElement("input");
        var lab4 = document.createElement("label");
        lab4.innerHTML="Cantidad ";
        //cantidad
        var temp4 = document.createElement("input");
        var cant = document.getElementById("cantidad").value;
        var id = document.getElementById("produ").value;
        var combo = document.getElementById("produ");
        var selected = combo.options[combo.selectedIndex].text;
        var res = selected.split("$");
        temp.value=id;
        temp2.value=res[0];
        temp3.value=res[1];
        temp4.value=cant;
        temp.setAttribute("readonly","readonly");
        temp.setAttribute("name","idp"+cont);
        temp2.setAttribute("readonly","readonly");
        temp2.setAttribute("name","nombre"+cont);
        temp3.setAttribute("readonly","readonly");
        temp3.setAttribute("name","precio"+cont);
        temp4.setAttribute("readonly","readonly");
        temp4.setAttribute("name","cant"+cont);

        f.appendChild(lab);
        f.appendChild(temp);
        f.appendChild(lab2);
        f.appendChild(temp2);
        f.appendChild(lab3);
        f.appendChild(temp3);
        f.appendChild(lab4);
        f.appendChild(temp4);
        //transforma lo ingresado a completamente string
        var cc = cant.toString();
        var pp = res[1].toString();
        //parsea esas cantidades
        var c1 = parseInt(cc);
        var p1 = parseFloat(pp);
        //multiplica la cantidad del producto por precio
        var s = c1*p1;
        //incrementa el total conforme se agreguen productos
        total = total + s;
        t.innerHTML="Total: $"+total;
        tin.value=total;
        caj.value=""+cont;
      }else{
        var hr = document.createElement("hr");
        var lab = document.createElement("label");
        lab.innerHTML="Identificador ";
        //id
        var temp = document.createElement("input");
        var lab2 = document.createElement("label");
        lab2.innerHTML="Producto ";
        //nombre
        var temp2 = document.createElement("input");
        var lab3 = document.createElement("label");
        lab3.innerHTML="Precio Unitario ";
        //precio
        var temp3 = document.createElement("input");
        var lab4 = document.createElement("label");
        lab4.innerHTML="Cantidad ";
        //cantidad
        var temp4 = document.createElement("input");
        var cant = document.getElementById("cantidad").value;
        var id = document.getElementById("produ").value;
        var combo = document.getElementById("produ");
        var selected = combo.options[combo.selectedIndex].text;
        var res = selected.split("$");
        temp.value=id;
        temp2.value=res[0];
        temp3.value=res[1];
        temp4.value=cant;
        //añade los atributos necesarios para cada caja
        temp.setAttribute("readonly","readonly");
        temp.setAttribute("name","idp"+cont);
        temp2.setAttribute("readonly","readonly");
        temp2.setAttribute("name","nombre"+cont);
        temp3.setAttribute("readonly","readonly");
        temp3.setAttribute("name","precio"+cont);
        temp4.setAttribute("readonly","readonly");
        temp4.setAttribute("name","cant"+cont);
        //añade los elementos al form
        f.appendChild(hr);
        f.appendChild(lab);
        f.appendChild(temp);
        f.appendChild(lab2);
        f.appendChild(temp2);
        f.appendChild(lab3);
        f.appendChild(temp3);
        f.appendChild(lab4);
        f.appendChild(temp4);
        //parsea las cantidades a string
        var cc = cant.toString();
        var pp = res[1].toString();
        //parsea las cantidades 
        var c1 = parseInt(cc);
        var p1 = parseFloat(pp);
        var s = c1*p1;
        total = total + s;
        //agregar el total a un label
        t.innerHTML="Total: $"+total;
        tin.value=total;
        caj.value=""+cont;
      }
    }
    //funcion para darle submit al form
    function re(){
      if(cont>0){
        cont=0;
        f.submit();
      }else{
        alert("Necesita agregar productos para realizar una venta");
      }
    }
</script>
<?php require_once("footer2.php"); ?>
</body>
</html>
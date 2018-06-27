<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
ob_start();
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = 'farma';
include ('seguridad.php');  
mysql_query("SET NAMES 'utf8'");
mysql_select_db($dbname);
$cont = 0;
if (isset($_GET['no_code'])){
$no_code = $_GET['no_code'];
} else {
$no_code = 0;
}



function generaGrupos()
{
	//include 'conexion.php';
	//conectar();
	$consulta=mysql_query("SELECT codigo_grupo, descripcion FROM grupo_de_medicamentos where tipo=2");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='grupo_medicamento' id='grupo_medicamento' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
}


?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Apdosis</title>


<!-- Start css3menu.com HEAD section -->
<link rel="stylesheet" href="default.htm_files/css3menu1/style.css" type="text/css" />
<!-- End css3menu.com HEAD section -->
<script language="javascript" type="text/javascript" src="jquery-1.3.2.min.js"></script>
        <script language="javascript" type="text/javascript" src="jquery.validate.1.5.2.js"></script>
        	<script type="text/javascript" src="js/jquery.validate.min"></script>
        <script language="javascript" type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="select_dependientes_sub.js"></script>
           	<script type='text/javascript' src='lib/jquery.bgiframe.min.js'></script>
		<script type='text/javascript' src='lib/jquery.ajaxQueue.js'></script>
		<script type='text/javascript' src='lib/thickbox-compressed.js'></script>
		<script type='text/javascript' src='jquery.autocomplete.js'></script>
		<script type='text/javascript' src='localdata.js'></script>
		<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
		<link rel="stylesheet" type="text/css" href="lib/thickbox.css" />
		
		   <script type="text/javascript">
$().ready(function() {

  $("#agregar_med").validate();

	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	

	$("#fabricante").autocomplete("get_fabricantes.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		selectFirst: true
	});

	$("#fabricante").result(function(event, data, formatted) {
		$("#fabricante_id").val(data[1]);
	});

	$("#nombre_enlace").autocomplete("get_medicamento_ins.php", {
		width: 500,
		matchContains: true,
		mustMatch: false,
		selectFirst: false
	});

	$("#nombre_enlace").result(function(event, data, formatted) {
		$("#codigo_enlace").val(data[1]);
	});


	
	$("#clear").click(function() {
		$(":input").unautocomplete();
	});
	
	
	});


	
</script>
		
		
      
	  <script language="javascript">
<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=200');");
}
// End -->
</script>


	  <script language="javascript">
<!-- Begin
function enable()
{
  // content  
 //alert("check");
 
 window.location='agregar_insumos.php?no_code=1';
 
}

function disable()
{
  // content
  //alert("uncheck");
 window.location='agregar_insumos.php?no_code=0'
}
// End -->
</script>



</head>



<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginheight="0" marginwidth="0" bgcolor="#FFFFFF">


<table width="100%" height="85" border="0" cellpadding="0" cellspacing="0" background="img/topbkg.jpg">
  <tr>
    <td width="50%" height="85"><img src="img/apdosis_farm.png" alt="apdosis" width="386" height="85" longdesc="apdosis"></td>
    <td width="50%">
    <p align="right"><img src="img/topright.jpg" alt="img" width="33" longdesc="img"></td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0" background="img/blackline.gif">
  <tr>
    <td width="100%"><font color="#B8C0F0" face="Arial" size="2">

<!-- Start css3menu.com BODY section id=1 -->
<?php include('menu.php'); ?>
<p style="display:none"><a href="http://css3menu.com/">My CSS Menu Css3Menu.com</a></p>
<!-- End css3menu.com BODY section -->

</font></td>
  </tr>
</table>
<p style="margin-left: 20"><b><font color="#B8C0F0" face="Arial" size="1">&nbsp;</font></b>

<font face="Arial" size="-1" color="#000000">

         <center>    <h1>Agregar Productos</h1></center>
            <div class="content_box_inner">
            			<form action="<? $_SERVER['PHP_SELF']; ?>" method="post" name="agregar_med" id="agregar_med">
			<table width="1000" border="0">
  <tr><td><input type="checkbox" name="no_code" id="no_code" value="1" onclick="if (this.checked) { enable(); } else { disable(); }" <?php if ($no_code == '1') { echo " checked"; } ?>/></td><td>Este producto NO tiene codigo de barra</td></tr>
  <tr>
    <td width="100">Código de Barra </td>
    <td width="608">
      <input type="text" name="codigo_de_barra" size="50"  <?php if ($no_code != '1') { echo "class=\"required\""; } else { echo "disabled"; } ?> />   </td>
  </tr>
  <tr>
    <td width="100">Descripción </td>
    <td><input type="text" name="nombre_comercial" size="100" class="required" /></td>
  </tr>
   <tr>
    <td width="100">Marca</td>
    <td><input type="text" name="nombre_generico" size="100" class="required" /></td>
  </tr>
     
    <tr>
    <td width="100">Codigo Proveedor</td>
    <td><input type="text" name="codigo_proveedor" size="100"  /></td>
  </tr>
     <tr>
    <td width="100">Proveedor Principal </td>
    <td><select name="proveedor_principal" ><?php $n = "select id_proveedor, nombre from proveedor";
	          $resulx = mysql_query($n, $conn) or die(mysql_error());
			  while($colsx = mysql_fetch_array($resulx)){	  
			  ?>
			  <option value="<? echo $colsx["id_proveedor"] ?>"><? echo $colsx["nombre"] ?></option>
			    <?php } ?> </select></td>
  </tr>
  <tr>
    <td width="100">Cantidad M&iacute;nima para Proveedor Principal </td>
    <td><input type="text" name="cant_max_prov" size="25"  /></td>
  </tr>
  
    
   <!-- <tr>
      <td>Costo Unitario</td>
      <td><label>Bl/.<input type="text" name="costo_unitario" size="20" align="right" /></label></td>
    </tr> -->
       <tr>
      <td width="100">Cantidad Inicial </td>
      <td><input type="text" name="cantidad_inicial" size="20" align="right" readonly /></td>
    </tr>
	<tr>
	  <td width="100">Tipo de Impuesto </td>
    <td><label><select name="tipo_impuesto"> <?php $n = "select tipo_impuesto, factor from impuesto";
	          $resulx = mysql_query($n, $conn) or die(mysql_error());
			  while($colsx = mysql_fetch_array($resulx)){	  
			  ?>
			  <option value="<? echo $colsx["tipo_impuesto"] ?>"><? echo $colsx["factor"] ?></option>
			    <?php } ?> </select></label></td> </tr>
	
	
    <tr><td width="100">Aplica Decto. Jubilado</td>
    <td><label><input name='jubilado' size='50' type='checkbox'  value='S' /></label></td>
  </tr>

     <tr><td width="100">Aplica Decto. Tipo de Cliente</td>
    <td><label><input name='descuento_total' size='50' type='checkbox'  value='S' /></label></td>
  </tr>
  
  <tr><td width="100">Grupo de Productos</td>
    <td><label><?php generaGrupos(); ?></label></td>
  </tr>
  <tr><td width="100">Subgrupo de Productos</td>
    <td><label><select disabled="disabled" name="sub_grupo" id="sub_grupo">
						<option value="0">Selecciona opci&oacute;n...</option>
					</select></label></td>
  </tr>
     <tr>
	<tr><td>¿Mostrar Producto en Hospital?</td>
    <td><label><input name='prod_hosp' size='50' type='checkbox'  value='S' /></label></td>
  </tr>
    <tr>
	<tr><td>¿Mostrar Producto en P&uacute;blico?</td>
    <td><label><input name='prod_pub' size='50' type='checkbox'  value='S' checked /></label></td>
  </tr>

  <tr>
    <td colspan="2" align="center"><input type="submit" name="submit" value="Guardar Producto"/></td>
    </tr>
  <tr>
    <td colspan="2" align="center">
	<?  
		if(isset($_POST['submit'])){
		if(isset($_POST['codigo_de_barra'])){
			$codigo_de_barra = $_POST['codigo_de_barra'];
			} else {		
			$r = "select consecutivo_barra + 1 as consec from consecutivo_sin_barra";
			
			$rres = mysql_query($r, $conn) or die(mysql_error());
			
			while ($rrow = mysql_fetch_array($rres)){
			$codigo_de_barra = $rrow['consec'];
			}
			
			}
			
			
			if(isset($_POST['nombre_generico'])){
			$nombre_generico= $_POST['nombre_generico'];
			}
			
			if(isset($_POST['codigo_enlace'])){
			$codigo_enlace = $_POST['codigo_enlace'];
			}
			
			if(isset($_POST['nombre_comercial'])){
			$nombre_comercial= $_POST['nombre_comercial'];
			}
			
			
			if(isset($_POST['proveedor_principal'])){
			$proveedor_principal= $_POST['proveedor_principal'];
			}
			
			
			
			if(isset($_POST['sub_grupo'])){
			$sub_grupo= $_POST['sub_grupo'];
			} else {
				$sub_grupo = 1;
			}
			
			if(isset($_POST['cantidad_inicial'])){
			$cantidad_inicial = $_POST['cantidad_inicial'];
			} else {
			$cantidad_inicial = 0;
			}
			if(isset($_POST['costo_unitario'])){
			$costo_unitario = $_POST['costo_unitario'];
			} else {
			$costo_unitario = 0;
			}
			
			if(isset($_POST['codigo_proveedor'])){
			$codigo_prov = $_POST['codigo_proveedor'];
			} else {
			$codigo_prov = ' ';
			}
			
			if(isset($_POST['tipo_impuesto'])){
			$tipo_impuesto = $_POST['tipo_impuesto'];
			} else
			{
			$tipo_impuesto = 0;
			}
			
			if(isset($_POST['grupo_medicamento']) || $_POST['grupo_medicamento'] == 0 ){
			$grupo_medicamento = $_POST['grupo_medicamento'];
			} else {
			$grupo_medicamento = 12;
			}	
			
			
				if(isset($_POST['jubilado'])){
			$jubilado = $_POST['jubilado'];
			} else {
			$jubilado = 'N';
			}	
			
			
				if(isset($_POST['descuento_total'])){
			$descuento_total = $_POST['descuento_total'];
			} else {
			$descuento_total = 'N';
			}	
			
				if(isset($_POST['cant_max_prov'])){
			$cant_max_prov = $_POST['cant_max_prov'];
			} else {
			$cant_max_prov = '0';
			}
			
			
					if(isset($_POST['prod_hosp'])){
			$prod_hosp = $_POST['prod_hosp'];
			} else {
			$prod_hosp = 'N';
			}
			
				if(isset($_POST['prod_pub'])){
			$prod_pub = $_POST['prod_pub'];
			} else {
			$prod_pub = 'N';
			}
			
			
			$g = "select porcentaje_ganancia from sub_grupo where codigo_grupo = '$grupo_medicamento' and codigo_sub = '$sub_grupo'";
			
			$gres = mysql_query($g, $conn) or die(mysql_error());
			
			while($grow = mysql_fetch_array($gres)){
				$porcentaje_ganancia = $grow['porcentaje_ganancia'];
			}
			
			
			
			$resu = "insert into medicamentos (codigo_de_barra, nombre_generico, nombre_comercial, tipo_posologia, forma_farmaceutica, presentacion, usuario_creacion,  cantidad_inicial, codigo_proveedor, costo_unitario, tipo_mercancia,fabricante,tipo_de_dosis,tipo_impuesto, grupo_medicamento, sub_grupo, jubilado, estado_med, descuento_total,cant_max_prov, porc_ganancia, prod_hosp, prod_pub, posologia, tipo_volumen) 
			values ('$codigo_de_barra', '$nombre_generico',  '$nombre_comercial', '8', '192' ,'23','".$_SESSION['MM_user']."', '$cantidad_inicial', '$codigo_prov', '$costo_unitario', '2', '1', 'N', '$tipo_impuesto', '$grupo_medicamento', '$sub_grupo', '$jubilado', 'A', '$descuento_total','$cant_max_prov','$porcentaje_ganancia','$prod_hosp', '$prod_pub', '1', '8')";
			$ins = mysql_query($resu, $conn) or die(mysql_error());
			
			$id = mysql_insert_id();
			
			$l= "insert into medicamentos_x_bodega (medicamento_id, fecha_inicial, cantidad_inicial, estado, inventario_ideal, inventario_maximo, inventario_critico, bodega) values ('$id', '".date("Y-m-d H:i",time())."', 0, 'A', 0,0,0,'1' )";
			$ins2 = mysql_query($l, $conn) or die(mysql_error());
			
			$li= "insert into medicamentos_x_bodega (medicamento_id, fecha_inicial, cantidad_inicial, estado, inventario_ideal, inventario_maximo, inventario_critico, bodega) values ('$id', '".date("Y-m-d H:i",time())."', 0, 'A', 0,0,0,2)";
			$ins2i = mysql_query($li, $conn) or die(mysql_error());
			
			$m= "insert into medicamento_x_proveedor (medicamento_id, id_proveedor, fecha_creacion) values ('$id', '$proveedor_principal', '".date("Y-m-d",time())."')";
			$ins2 = mysql_query($m, $conn) or die(mysql_error());
				
	
			 $Hora = Time(); // Hora actual
 			 $hora_actual =  date('Y-m-d H:i',$Hora); 
			
						
						
			$l = "update consecutivo_sin_barra set consecutivo_barra = consecutivo_barra + 1";
			
			$lres = mysql_query ($l, $conn) or die(mysql_error());
			
			
			echo "<font color='blue'><b>Se ha insertado el producto ".$nombre_generico." ".$nombre_comercial." con éxito</b></font>";
               
		} ?></td>
  </tr>
</table>

</form>

</div>
</font>
                
                
                <div class="cleaner"></div>
            </div>
            
        </div>
<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp; </font></p>
<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
<p style="margin-left: 20" align="center"><font face="Arial" color="#000000" size="1">MASPC</font></p>
<table border="0" width="100%" cellspacing="0" cellpadding="0" background="img/botline.gif">
  <tr>
    <td width="100%"><img border="0" src="img/botline.gif" width="41" height="12"></td>
  </tr>
</table>
<div style="text-align:center;font-family:Arial,Helvetica,Sans-Serif;font-size:11px;color:#777;"></div>
</body>

</html>

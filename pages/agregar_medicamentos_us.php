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
 
 window.location='agregar_medicamentos_us.php?no_code=1';
 
}

function disable()
{
  // content
  //alert("uncheck");
 window.location='agregar_medicamentos_us.php?no_code=0'
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

         <center>    <h1>Agregar Medicamentos</h1></center>
            <div class="content_box_inner">
            			<form action="<? $_SERVER['PHP_SELF']; ?>" method="post" name="agregar_med" id="agregar_med">
			<table width="500" border="0">
  <tr><td><input type="checkbox" name="no_code" id="no_code" value="1" onclick="if (this.checked) { enable(); } else { disable(); }" <?php if ($no_code == '1') { echo " checked"; } ?>/></td><td>Este medicamento NO tiene codigo de barra</td></tr>
  <tr>
    <td width="162">Código de Barra </td>
    <td width="608">
      <input type="text" name="codigo_de_barra" size="50"  <?php if ($no_code != '1') { echo "class=\"required\""; } else { echo "disabled"; } ?> />   </td>
  </tr>
  <tr>
    <td>Nombre Genérico </td>
    <td><input type="text" name="nombre_generico" size="100" class="required" /></td>
  </tr>
  <tr>
    <td>Nombre Comercial </td>
    <td><input type="text" name="nombre_comercial" size="100" class="required"  /></td>
  </tr>
   <tr>
    <td>Codigo Proveedor </td>
    <td><input type="text" name="codigo_proveedor" size="100"  /></td>
  </tr>
  <tr>
    <td>Forma Farmacéutica </td>
    <td><select name="forma_farma">
		<?php $n = "select codigo_forma, descripcion from formas_farmaceuticas order by descripcion";
	          $resul = mysql_query($n, $conn) or die(mysql_error());
			  while($cols = mysql_fetch_array($resul)){	  
			  ?>
			  <option value="<? echo $cols["codigo_forma"] ?>"><? echo $cols["descripcion"] ?></option>
			    <?php } ?> </select></td>
  </tr>
  <tr>
    <td>Concentraci&oacute;n</td>
    <td><input type="text" name="posologia" size="10" /> <select name="tipo_posologia">
		<?php $g = "select codigo_posologia, descripcion from tipos_posologias order by descripcion";
	          $resul1 = mysql_query($g, $conn) or die(mysql_error());
			  while($cols1 = mysql_fetch_array($resul1)){	  
			  ?>
			  <option value="<? echo $cols1["codigo_posologia"] ?>"><? echo $cols1["descripcion"] ?></option>
			    <?php } ?> </select></td>
  </tr>
  <tr>
    <td>Presentación</td>
    <td><select name="presentacion"><?php $h = "select codigo_presentacion, descripcion from presentacion order by descripcion";
	          $resul2 = mysql_query($h, $conn) or die(mysql_error());
			  while($cols2 = mysql_fetch_array($resul2)){	  
			  ?>
			  <option value="<? echo $cols2["codigo_presentacion"] ?>"><? echo $cols2["descripcion"] ?></option>
			    <?php } ?> </select></td>
  </tr>
  <tr>
  
    <td>Fabricante</td>
    <td><input type="text" name="fabricante" id="fabricante" size="50" class="required"><input name="fabricantes" type="button" value="Crear Nuevo Fabricante" onClick="javascript:popUp('anadir_fabricante.php')"/> 
				
				<input name="fabricante_id" type="hidden" id="fabricante_id" size="50" />				</td>
  </tr>
 
   <tr>
    <td>Volumen </td>
    <td><input type="text" name="volumen" size="20"  /><select name="tipo_volumen"><?php $g = "select codigo_posologia, descripcion from tipos_posologias order by descripcion";
	          $resul1 = mysql_query($g, $conn) or die(mysql_error());
			  while($cols1 = mysql_fetch_array($resul1)){	  
			  ?>
			  <option value="<? echo $cols1["codigo_posologia"] ?>"><? echo $cols1["descripcion"] ?></option>
			    <?php } ?> </select></td>
  </tr>
  
  <tr><td>Aplica Decto. Jubilado</td>
    <td><label><input name='jubilado' size='50' type='checkbox'   value='S'  /></label></td>
  </tr>
  
  <tr><td>Aplica Decto. Tipo de Cliente</td>
    <td><label><input name='descuento_total' size='50' type='checkbox'   value='S'  /></label></td>
  </tr>
  
  <tr><td>Grupo de Medicamentos</td>
    <td><label><select name="grupo_medicamento"> <?php $v = "select codigo_grupo, descripcion from grupo_de_medicamentos where tipo=1 order by descripcion";
	          $resulv = mysql_query($v, $conn) or die(mysql_error());
			  while($colsv = mysql_fetch_array($resulv)){	  
			  ?>
			  <option value="<? echo $colsv["codigo_grupo"] ?>"><? echo $colsv["descripcion"] ?></option>
			    <?php } ?> </select></label></td>
  </tr>
  
  
  <!--  <tr>
      <td>Costo</td>
      <td><label>Bl/.<input type="text" name="costo" size="20" align="right" readonly /></label></td>
    </tr> -->
    <tr>
      <td>Precio de Venta </td>
      <td><label>Bl/.<input type="text" name="precio_venta" size="20" align="right" readonly  /></label></td>
    </tr>
	    <tr>
      <td>Cantidad Inicial </td>
      <td><input type="text" name="cantidad_inicial" size="20" align="right" readonly/></td>
    </tr>
	<tr><td>Antibiotico</td>
    <td><label><input name='antibiotico' size='50' type='checkbox'   value='S'  /></label></td>
  </tr>
 <tr><td>Narcotico</td>
    <td><label><input name='narcotico' size='50' type='checkbox'  value='S' /></label></td>
  </tr>
   <tr><td>Importación</td>
    <td><label><input name='importacion' size='50' type='checkbox'  value='S' /></label></td>
  </tr>
      <tr><td>&iquest;No se puede devolver?</td>
    <td><label><input name='devolver' size='50' type='checkbox'  value='S' /></label></td>
  </tr>
	 <tr><td>Multiple Principio Activo</td>
    <td><label><input name='multiple_principio' size='50' type='checkbox'  value='S'  /></label></td>
  </tr>
    <tr>
	<tr><td>¿Mostrar Producto en Hospital?</td>
    <td><label><input name='prod_hosp' size='50' type='checkbox'  value='S' checked /></label></td>
  </tr>
    <tr>
	<tr><td>¿Mostrar Producto en P&uacute;blico?</td>
    <td><label><input name='prod_pub' size='50' type='checkbox'  value='S' checked /></label></td>
  </tr>
    <tr>
  
    <td>Contraindicaciones</td>
    <td>
	<?php $k = "select codigo_contraindicacion, descripcion from contraindicaciones";
	          $resul3 = mysql_query($k, $conn) or die(mysql_error());
			  while($cols3 = mysql_fetch_array($resul3)){	  
			  ?>
	<label><input name="contraindicacion[]" type="checkbox" value="<? echo $cols3['codigo_contraindicacion'] ?>"> <? echo $cols3['descripcion'] ?> </label> <br />	 <?php } ?> 		</td>
  </tr>
    <tr>
    <td>Otras Contraindicaciones (separar con comas)</td>
    <td><textarea name="otras" cols="50" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>Tipo de Impuesto </td>
    <td><label><select name="tipo_impuesto"> <?php $n = "select tipo_impuesto, factor from impuesto";
	          $resulx = mysql_query($n, $conn) or die(mysql_error());
			  while($colsx = mysql_fetch_array($resulx)){	  
			  ?>
			  <option value="<? echo $colsx["tipo_impuesto"] ?>"><? echo $colsx["factor"] ?></option>
			    <?php } ?> </select></label></td>
  </tr> 
    <tr>
    <td>Anaquel </td>
    <td><label><select name="anaquel"> <?php for ($i=0;$i<=25;$i++) {	  
			  ?>
			  <option value="<? echo $i ?>"><? echo $i ?></option>
			    <?php } ?> </select></label></td>
  </tr> 
   <tr>
    <td>Proveedor Principal </td>
    <td><select name="proveedor_principal" ><?php $n = "select id_proveedor, nombre from proveedor";
	          $resulx = mysql_query($n, $conn) or die(mysql_error());
			  while($colsx = mysql_fetch_array($resulx)){	  
			  ?>
			  <option value="<? echo $colsx["id_proveedor"] ?>"><? echo $colsx["nombre"] ?></option>
			    <?php } ?> </select></td>
  </tr>
  <tr>
    <td>Cantidad M&iacute;nima para Proveedor Principal </td>
    <td><input type="text" name="cant_max_prov" size="25"  /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center"><input type="submit" name="submit" value="Guardar Medicamento"/></td>
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
			$nombre_generico = $_POST['nombre_generico'];
			}
			if(isset($_POST['nombre_comercial'])){
			$nombre_comercial = $_POST['nombre_comercial'];
			}
			if(isset($_POST['forma_farma'])){
			$forma_farmaceutica = $_POST['forma_farma'];
			}
			if(isset($_POST['posologia'])){
			$posologia = $_POST['posologia'];
			}
			if(isset($_POST['tipo_posologia'])){
			$tipo_posologia = $_POST['tipo_posologia'];
			}
			if(isset($_POST['presentacion'])){
			$presentacion = $_POST['presentacion'];
			}
			if(isset($_POST['fabricante_id'])){
			$fabricante = $_POST['fabricante_id'];
			}
			
			if(isset($_POST['precio_venta'])){
			$precio_venta = $_POST['precio_venta'];
			} else {
			$precio_venta = 0;
			}
			if(isset($_POST['cantidad_inicial'])){
			$cantidad_inicial = $_POST['cantidad_inicial'];
			} else {
			$cantidad_inicial = 0;
			}
			if(isset($_POST['tipo_dosis'])){
			$tipo_dosis = $_POST['tipo_dosis'];
			} else {
			$tipo_dosis = 'E';
			}
			if(isset($_POST['antibiotico'])){
			$antibiotico = $_POST['antibiotico'];
			} else {
			$antibiotico = 'N';
			}
			if(isset($_POST['narcotico'])){
			$narcotico = $_POST['narcotico'];
			} else {
			$narcotico = 'N';
			}
			if(isset($_POST['preparacion'])){
			$preparacion = $_POST['preparacion'];
			} else {
			$preparacion = 'N';
			}
			if(isset($_POST['multiple_principio'])){
			$multiple_principio = $_POST['multiple_principio'];
			} else {
			$multiple_principio  = 'N';
			}
			if(isset($_POST['devolver'])){
			$permite_devol = $_POST['devolver'];
			} else {
			$permite_devol = 'N' ;
			}
			if(isset($_POST['otras'])){
			$otras_contra = $_POST['otras'];
			}
			if(isset($_POST['codigo_proveedor'])){
			$codigo_prov = $_POST['codigo_proveedor'];
			} else {
			$codigo_prov = ' ';
			}
			if(isset($_POST['volumen'])){
			$volumen = $_POST['volumen'];
			} else
			{
			$volumen = ' ';
			}
			if(isset($_POST['tipo_volumen'])){
			$tipo_volumen = $_POST['tipo_volumen'];
			} 
			if(isset($_POST['grupo_medicamento'])){
			$grupo_medicamento = $_POST['grupo_medicamento'];
			} else {
			$grupo_medicamento = 8;
			}		
			if(isset($_POST['tipo_impuesto'])){
			$tipo_impuesto = $_POST['tipo_impuesto'];
			} else
			{
			$tipo_impuesto = 0;
			}
			
				if(isset($_POST['anaquel'])){
			$anaquel = $_POST['anaquel'];
			} else
			{
			$anaquel = 0;
			}
			
				if(isset($_POST['proveedor_principal'])){
			$proveedor_principal = $_POST['proveedor_principal'];
			} else
			{
			$proveedor_principal = 0;
			}
			
			if(isset($_POST['cant_max_prov'])){
			$cant_max_prov = $_POST['cant_max_prov'];
			} else
			{
			$cant_max_prov = 0;
			}
			
			if(isset($_POST['importacion'])){
			$importacion = $_POST['importacion'];
			} else {
			$importacion = 'N';
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
			
			
			$g = "select porcentaje_ganancia from sub_grupo where codigo_grupo = '$grupo_medicamento' and codigo_sub = '1'";
			
			$gres = mysql_query($g, $conn) or die(mysql_error());
			
			while($grow = mysql_fetch_array($gres)){
				$porcentaje_ganancia = $grow['porcentaje_ganancia'];
			}
			
			
			$resu = "insert into medicamentos (codigo_de_barra, nombre_generico, nombre_comercial, forma_farmaceutica, posologia, tipo_posologia, presentacion, fabricante, usuario_creacion,  cantidad_inicial, tipo_de_dosis, antibiotico, narcotico, preparacion, permite_devol, otras_contra, codigo_proveedor, volumen, tipo_volumen, grupo_medicamento, tipo_mercancia, multiple_principio, tipo_impuesto, porc_ganancia, ubicacion, importacion, jubilado, sub_grupo, estado_med, descuento_total, cant_max_prov, prod_hosp, prod_pub) 
			values ('$codigo_de_barra', '$nombre_generico', '$nombre_comercial', '$forma_farmaceutica', '$posologia', '$tipo_posologia', '$presentacion', '$fabricante', '".$_SESSION['MM_user']."', '$cantidad_inicial', 'N', '$antibiotico', '$narcotico', '$preparacion', '$permite_devol', '$otras_contra', '$codigo_prov', '$volumen', '$tipo_volumen', '$grupo_medicamento', '1', '$multiple_principio', '$tipo_impuesto', '$porcentaje_ganancia', '$anaquel', '$importacion', '$jubilado', '1', 'A', '$descuento_total', '$cant_max_prov', '$prod_hosp', '$prod_pub')";
			$ins = mysql_query($resu, $conn) or die(mysql_error());
			
			$id = mysql_insert_id();
			
			
			if (isset($_POST['contraindicacion'])){
			foreach ($_POST['contraindicacion'] as $contra)
			{
			$resu2 = "insert into contra_medicamentos (codigo_de_barra, codigo_contraindicacion) values ('$codigo_de_barra', '$contra')";
			$ins2 = mysql_query ($resu2, $conn) or die(mysql_error());

			}}
			
					
			
			 $Hora = Time(); // Hora actual
 			 $hora_actual =  date('Y-m-d H:i',$Hora); 
			
			
			$resu3 = "insert into medicamentos_x_bodega (bodega, medicamento_id, fecha_inicial, cantidad_inicial,estado)  
			values ('1','$id', '$hora_actual', '$cantidad_inicial', 'A')";
			$ins3 = mysql_query($resu3, $conn) or die(mysql_error());
			
			$resu3i = "insert into medicamentos_x_bodega (bodega, medicamento_id, fecha_inicial, cantidad_inicial,estado)  
			values ('2','$id', '$hora_actual', 0, 'A')";
			$ins3i = mysql_query($resu3i, $conn) or die(mysql_error());
			
			
			$resu4 = "insert into medicamento_x_proveedor (id_proveedor, medicamento_id, fecha_creacion)  
			values ('$proveedor_principal', '$id', '".date("Y-m-d",time())."')";
			$ins4 = mysql_query($resu4, $conn) or die(mysql_error());				

					
			$l = "update consecutivo_sin_barra set consecutivo_barra = consecutivo_barra + 1";
			
			$lres = mysql_query ($l, $conn) or die(mysql_error());
			
			
			echo "<font color='blue'><b>Se ha insertado el medicamento ".$nombre_comercial." con éxito</b></font>";
               
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

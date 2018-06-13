<?php
ob_start();
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = 'apdosis_pub';
include ('seguridad.php');  
mysql_query("SET NAMES 'utf8'");
$db_selected = mysql_select_db('apdosis_pub', $conn);
?>


 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Formulario de Dispensación de Medicamentos</title>
        <script language="javascript" type="text/javascript" src="jquery-1.3.2.min.js"></script>
        <script language="javascript" type="text/javascript" src="jquery.validate.1.5.2.js"></script>
        	<script type="text/javascript" src="js/jquery.validate.min"></script>
        <script language="javascript" type="text/javascript" src="script.js"></script>
        <link href="estilo.css" rel="stylesheet" type="text/css" />
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
	  
	  
	  
    </head>
    
    <body>
        <div id="contenedor">
    
    
            <h1>
              
            </h1>
          <h1>Formulario de Dispensación de Medicamentos</h1>
          <p align="center"><img src="images/apdosis.png" alt="apdosis" width="268" height="85" /></p>
          <p>&nbsp;</p>
			<form action="<? $_SERVER['PHP_SELF']; ?>" method="post" name="agregar_med" id="agregar_med">
			<table width="780" border="0">
  <tr>
    <td width="162">Código de Barra </td>
    <td width="608">
      <input type="text" name="codigo_de_barra" size="50" class="required" />   </td>
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
    <td>Forma Farmacéutica </td>
    <td><select name="forma_farma">
		<?php $n = "select codigo_forma, descripcion from formas_farmaceuticas";
	          $resul = mysql_query($n, $conn) or die(mysql_error());
			  while($cols = mysql_fetch_array($resul)){	  
			  ?>
			  <option value="<? echo $cols["codigo_forma"] ?>"><? echo $cols["descripcion"] ?></option>
			    <?php } ?> </select></td>
  </tr>
  <tr>
    <td>Posología</td>
    <td><input type="text" name="posologia" size="10" /> <select name="tipo_posologia">
		<?php $g = "select codigo_posologia, descripcion from tipos_posologias";
	          $resul1 = mysql_query($g, $conn) or die(mysql_error());
			  while($cols1 = mysql_fetch_array($resul1)){	  
			  ?>
			  <option value="<? echo $cols1["codigo_posologia"] ?>"><? echo $cols1["descripcion"] ?></option>
			    <?php } ?> </select></td>
  </tr>
  <tr>
    <td>Presentación</td>
    <td><select name="presentacion"><?php $h = "select codigo_presentacion, descripcion from presentacion";
	          $resul2 = mysql_query($h, $conn) or die(mysql_error());
			  while($cols2 = mysql_fetch_array($resul2)){	  
			  ?>
			  <option value="<? echo $cols2["codigo_presentacion"] ?>"><? echo $cols2["descripcion"] ?></option>
			    <?php } ?> </select></td>
  </tr>
  <tr>
  
    <td>Fabricante</td>
    <td><input type="text" name="fabricante" id="fabricante" size="50"><input name="fabricantes" type="button" value="Crear Nuevo Fabricante" onClick="javascript:popUp('anadir_fabricante.php')"/> 
				
				<input name="fabricante_id" type="hidden" id="fabricante_id" size="50" />				</td>
  </tr>
    <tr>
      <td>Costo</td>
      <td><label>Bl/.<input type="text" name="costo" size="20" align="right"/></label></td>
    </tr>
    <tr>
      <td>Precio de Venta </td>
      <td><label>Bl/.<input type="text" name="percio_venta" size="20" align="right" /></label></td>
    </tr>
    <tr>
      <td>Cantidad Inicial </td>
      <td><label>Bl/.<input type="text" name="cantidad" size="20" align="right" /></label></td>
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
    <td colspan="2" align="center"><input type="submit" name="submit" value="Guardar Medicamento"/></td>
    </tr>
  <tr>
    <td colspan="2" align="center">
	<?  
		if(isset($_POST['submit'])){
			$codigo_de_barra = $_POST['codigo_de_barra'];
			$nombre_generico = $_POST['nombre_generico'];
			$nombre_comercial = $_POST['nombre_comercial'];
			$forma_farmaceutica = $_POST['forma_farma'];
			$posologia = $_POST['posologia'];
			$tipo_posologia = $_POST['tipo_posologia'];
			$presentacion = $_POST['presentacion'];
			$fabricante = $_POST['fabricante_id'];
			$costo = $_POST['costo'];
			$precio_venta = $_POST['precio_venta'];
			$cantidad_inicial = $_POST['cantidad_inicial'];
			
			$resu = "insert into medicamentos (codigo_de_barra, nombre_generico, nombre_comercial, forma_farmaceutica, posologia, tipo_posologia, presentacion, fabricante, usuario_creacion, costo, precio_venta, cantidad_inicial) 
			values ('$codigo_de_barra', '$nombre_generico', '$nombre_comercial', '$forma_farmaceutica', '$posologia', '$tipo_posologia', '$presentacion', '$fabricante', '".$_SESSION['MM_user']."', '$costo', '$precio_venta', '$cantidad_inicial')";
			$ins = mysql_query($resu, $conn) or die(mysql_error());
			
			
			foreach ($_POST['contraindicacion'] as $contra)
			{
			$resu2 = "insert into contra_medicamentos (codigo_de_barra, codigo_contraindicacion) values ('$codigo_de_barra', '$contra')";
			$ins2 = mysql_query ($resu2, $conn) or die(mysql_error());

			}
			
			echo "Se ha insertado el medicamento ".$nombre_comercial." con éxito";
               
		} ?></td>
  </tr>
</table>
</form>
    </div>
	
</body>
</html>

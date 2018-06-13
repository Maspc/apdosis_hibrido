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
     

	  
</head>
    
<body>
     
    
    
            <h1>
             Añadir Persona 
            </h1>
         	<form action="<? $_SERVER['PHP_SELF'] ?>" method="post" name="agregar_fabri">
			<table width="351" border="0">
  <tr>
    <td>Identificación</td>
    <td><input name="identificacion" type="text" size="50" class="required" /></td>
  </tr>
   <tr>
    <td>Nombre del Paciente</td>
    <td><input name="nombre" type="text" size="50" class="required" /></td>
  </tr>
     <tr>
    <td>Alergias</td>
    <td><input name="alergias" type="text" size="50" class="required" /></td>
  </tr>
       <tr>
    <td>Diabetes</td>
    <td><input name="diabetes" type="checkbox" value="S" /></td>
  </tr> 
         <tr>
    <td>Hipertensión</td>
    <td><input name="hipertension" type="checkbox" value="S" /></td>
  </tr>
         <tr>
    <td>Peso</td>
    <td><input name="peso" type="text" size="20" align="right"/> lb.</td>
  </tr>
           <tr>
    <td>Otros</td>
    <td><input name="otros" type="text" size="50" /></td>
  </tr>
             <tr>
    <td>Compañía de Seguro</td>
    <td><input name="compania_seguro" type="text" size="50" /></td>
  </tr>
    <tr>
    <td colspan="2"><div align="center">
      <input name="anadir" type="submit" value="A&ntilde;adir" />
    </div></td>
	    </tr>
		<tr>
		<td colspan="2">
			<?
	if(isset($_POST['anadir'])){
	$alergias = $_POST['alergias'];
	if(isset($_POST['diabetes'])){
	$diabetes = $_POST['diabetes'];
	} 
	else{
	$diabetes = 'N';
	}
	if(isset($_POST['hipertension'])){
$hipertension = $_POST['hipertension'];
}	else{
	$hipertension = 'N';
	}
$peso = $_POST['peso'];
$otros = $_POST['otros'];
$compania_de_seguro = $_POST['compania_seguro'];
$nombre_paciente = $_POST['nombre'];
$identificacion = $_POST['identificacion'];

 
    $q = "insert into paciente ( ID_PACIENTE, NOMBRE, ALERGIAS,  PESO, OTROS, COMPANIA_DE_SEGURO, DIABETES, HIPERTENSION)
values ( '$identificacion', '$nombre_paciente', '$alergias',  '$peso', '$otros', '$compania_de_seguro', '$diabetes', '$hipertension')";
$res = mysql_query($q, $conn) or die(mysql_error());
		
	echo "Ha añadido con éxito el paciente: ".$nombre_paciente;	

     }
	 
		  ?>
		</td>
		</tr>
		
</table>

			
</form>
  
	
</body>
</html>

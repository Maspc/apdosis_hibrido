<?php
ob_start();
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = 'apdosis_pub';
include ('seguridad.php');  
mysql_query("SET NAMES 'utf8'");
mysql_select_db($dbname);
/*
echo "antes de entrar";
if(isset($_POST['enviar'])){
echo "entre";
echo "var cont ".$_POST["var_cont"];
for ($i=1;$i<=$_POST["var_cont"];$i++)
 {
echo "Numero de Fila: " ; echo $i;
echo "Medicamento: ";  echo $_POST["medicamento_$i"];
echo "Forma farmaceutica: "; echo $_POST["forma_$i"];
echo "Dosis: "; echo $_POST["dosis_$i"];echo "<br>";
echo "Horas: "; echo $_POST["horas_$i"];echo "<br>";
echo "Dias: "; echo $_POST["dias_$i"];echo "<br>";

 }

}
*/


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
        <div id="contenedor">
    
    
            <h1></h1>
          <p align="center"><img src="images/apdosis.png" alt="apdosis" width="268" height="85" /></p>
          <p>&nbsp;</p>
			
			<div align="center">
			  <table width="300" border="0">
			    <tr>
			      <td><h1 align="center">FARMACIA</h1></td>
      <td><h1 align="center">HOSPITAL</h1></td>
    </tr>
			    <tr>
			      <td><ul>
			        <li>
			          <div align="center"><a href="agregar_medicamentos.php" align="left">Crear medicamentos</a></div>
			        </li>
			        <p align="center">
			          <li>
			            <div align="center"><a href="devolucion.php" align="left">Crear Devolución</a></div>
			          </li>
			        <p align="center">
			          <li>
			            <div align="center"><a href="facturar.php" align="left">Crear Factura</a> </div>
			          </li>
				    <p align="center">
				      <li>
				        <div align="center"><a href="cargos_pendientes.php" align="left">Cargos Pendientes</a> </div>
				      </li>
				  
		        </ul></td>
      <td> <ul><li>
        <div align="center"><a href="cargos.php" align="left">Añadir Cargos</a></div>
      </li>
	    <p align="center">
				      <li>
				        <div align="center"><a href="anadir_medico.php" align="left">Añadir Médicos</a> </div>
				      </li>
	  
	  </ul>
			        <p></td>
    </tr>
              </table>
		  </div>
			<hr />
    
    </div>
	
</body>
</html>

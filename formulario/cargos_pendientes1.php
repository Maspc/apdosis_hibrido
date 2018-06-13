<?php
ob_start();
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
include ('seguridad.php');  
mysql_query("SET NAMES 'utf8'");
$db_selected = mysql_select_db('apdosis_pub', $conn);
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
    
            <h1>Formulario de Dispensación de Medicamentos</h1>
          <p align="center"><img src="images/apdosis.png" alt="apdosis" width="268" height="85" /></p>
          <p>&nbsp;</p>
			  <table width="900" border="0" cellspacing="0" >
              <p>
			  <tr>
			  <td> 

  
  <?php  
     

$n = "SELECT paciente.no_cama, registro.cargo, registro.fecha_creacion, registro.stat
FROM registro, paciente
WHERE registro.estado = 'P'
AND paciente.id_paciente = registro.id_paciente
order by stat desc, fecha_creacion asc";

$resulta = mysql_query($n, $conn) or die(mysql_error());
echo "<table border='1'>";
echo "<tr>";
$i = 0;
while($rows = mysql_fetch_array($resulta))
  {
  
echo "<td><b>No. Cargo:</b> " . $rows['cargo'] .
"<p><b>Fecha creacion:</b> " . $rows['fecha_creacion'] .
"<p><b>No. Cama:</b> " . $rows['no_cama'] . 
"<p><b>Urgente:</b> " . $rows['stat'] ."</td>";

$i = $i +1;

if ($i % 4 == 0 )  {
echo "</tr>
<tr>";
}

 }
  echo "</table> <p>";
  
  
  $m = "SELECT paciente.no_cama, registro.cargo as cargo, registro.fecha_creacion, registro.stat
FROM registro, paciente
WHERE registro.estado = 'P'
AND paciente.id_paciente = registro.id_paciente
order by stat desc, fecha_creacion asc limit 1";

$resulta2 = mysql_query($m, $conn) or die(mysql_error());

while ($rows2 = mysql_fetch_array($resulta2)) {

$cargo = $rows2['cargo'];

}
  
  echo "cargo a enviarse: " .$cargo; 
  echo "<a href='facturar_pend.php?cargo=".$cargo."'>Procesar Cargo</a>";
  
?>


</td>
</tr>
            </table>
    </div>
	
</body>
</html>

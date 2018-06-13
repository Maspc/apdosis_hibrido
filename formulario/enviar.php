<?php 
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$db_selected = mysql_select_db('apdosis_pub', $conn);
error_reporting(E_ALL & ~E_NOTICE);
if (isset($_POST['cargo'])) { 
$cargo = $_POST['cargo'];}
if (isset($_POST['factura'])) { 
$factura = $_POST['factura'];}
if (isset($_POST['nombre_paciente'])) { 
$nombre_paciente = $_POST['nombre_paciente'];}
if (isset($_POST['identificacion'])) { 
$identificacion = $_POST['identificacion'];}
if (isset($_POST['numero_cama'])) { 
$numero_cama = $_POST['numero_cama'];}
if (isset($_POST['medico'])) { 
$medico = $_POST['medico'];}
if (isset($_POST['alergias'])) { 
$alergias = $_POST['alergias'];}
if (isset($_POST['diabetes'])) { 
$diabetes = $_POST['diabetes'];}
if (isset($_POST['hipertension'])) { 
$hipertension = $_POST['hipertension'];}
if (isset($_POST['peso'])) { 
$peso = $_POST['peso'];}
if (isset($_POST['otros'])) { 
$otros = $_POST['otros'];}
if (isset($_POST['compania_de_seguro'])) { 
$compania_de_seguro = $_POST['compania_de_seguro'];}
if (isset($_POST['stat'])) { 
$stat = $_POST['stat'];}


$q = "update paciente set alergias = '$alergias', PESO= '$peso', otros = '$otros', compania_de_seguro = '$compania_de_seguro', diabetes = '$diabetes', hipertension = '$hipertension' 
where id_paciente = '$identificacion'";

$res = mysql_query($q, $conn) or die(mysql_error());


 $w = "insert into registro (  CARGO,  ID_PACIENTE, stat, estado, medico, no_cama)
values ( '$cargo', '$identificacion', '$stat', 'P', '$medico', '$numero_cama' )";
$res = mysql_query($w, $conn) or die(mysql_error());

for ($i=1;$i<=$_POST["var_cont"];$i++)
 {
/*echo "var cont ".$_POST["var_cont"];
echo "Numero de Fila: " ; echo $i;
echo "Medicamento: ";  echo $_POST["medicamento_$i"];
echo "Forma farmaceutica: "; echo $_POST["forma_$i"];
echo "Dosis: "; echo $_POST["dosis_$i"];echo "<br>";
echo "Horas: "; echo $_POST["horas_$i"];echo "<br>";
echo "Dias: "; echo $_POST["dias_$i"];echo "<br>";*/

if (isset($_POST["medicamento_$i"])) {

$x = "insert into registro_detalle(medicamento, forma_farma, dosis, horas, dias, medicamento_id, linea, cargo, cantidad)
values ('".$_POST["medicamento_$i"]."', '".$_POST["forma_$i"]."','".$_POST["dosis_$i"]."','".$_POST["horas_$i"]."', '".$_POST["dias_$i"]."','".$_POST["medicamento_id_$i"]."','".$i."','".$cargo."','".$_POST["cantidad_$i"]."' )";
$res = mysql_query($x, $conn) or die(mysql_error());

}}

echo "<html>
<head>  <link href='estilo.css' rel='stylesheet' type='text/css' /> </head> <body>
 <center><h1>Formulario de Dispensación de Medicamentos - Cargo No.".$cargo."</h1></center><p>";


$m = "SELECT paciente.nombre as paciente, paciente.id_paciente, registro.no_cama, medicos.nombre as medico 
FROM paciente, registro, medicos 
where paciente.id_paciente = '$identificacion' 
and registro.cargo = '$cargo'
and medicos.codigo_medico = registro.medico";
$result = mysql_query($m, $conn) or die(mysql_error());
echo "<table border='1'>
<tr>

<th>Nombre del Paciente</th>
<th>Cédula</th>
<th>Número de Cama</th>
<th>Médico</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['paciente'] . "</td>";
  echo "<td>" . $row['id_paciente'] . "</td>";
  echo "<td>" . $row['no_cama'] . "</td>";
  echo "<td>" . $row['medico'] . "</td>";
  
  echo "</tr>";
  }
echo "</table>";



$n = "SELECT medicamento, forma_farma, dosis, horas, dias, linea, cargo FROM registro_detalle where cargo = '$cargo'";

$resulta = mysql_query($n, $conn) or die(mysql_error());
echo "<table border='1'>
<tr>

<th>Medicamento</th>
<th>Forma Farmaceutica</th>
<th>Dosis</th>
<th>Cada Horas</th>
<th>Por Días</th>
</tr>";

while($rows = mysql_fetch_array($resulta))
  {
  echo "<tr>";
  echo "<td>" . $rows['medicamento'] . "</td>";
  echo "<td>" . $rows['forma_farma'] . "</td>";
  echo "<td>" . $rows['dosis'] . "</td>";
  echo "<td>" . $rows['horas'] . "</td>";
    echo "<td>" . $rows['dias'] . "</td>";
  
  echo "</tr>";
  }
echo "</table>";
echo "</body></html>";

 ?>


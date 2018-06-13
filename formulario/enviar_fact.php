<?php 
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$db_selected = mysql_select_db('apdosis_pub', $conn);
error_reporting(E_ALL & ~E_NOTICE);
if (isset($_POST['medicamento'])) { 
$medicamento = $_POST['medicamento'];}
if (isset($_POST['forma'])) { 
$forma = $_POST['forma'];}
if (isset($_POST['dosis'])) { 
$dosis = $_POST['dosis'];}
if (isset($_POST['horas'])) { 
$horas = $_POST['horas'];}
if (isset($_POST['dias'])) { 
$dias = $_POST['dias'];}
if (isset($_POST['cantidad'])) { 
$cantidad = $_POST['cantidad'];}
if (isset($_POST['precio_unitario'])) { 
$precio_unitario = $_POST['precio_unitario'];}
if (isset($_POST['precio_venta'])) { 
$precio_venta = $_POST['precio_venta'];}
if (isset($_POST['cargo'])) { 
$cargo = $_POST['cargo'];}

$c = "insert into factura (id_paciente, cargo, medico, no_cama) select id_paciente, CARGO, medico, no_cama from registro where cargo ='".$cargo."'";

$res5 = mysql_query($c, $conn) or die (mysql_error());

$z = mysql_insert_id();

 $w = "update factura set total = '".$_POST["total"]."' where factura = '$z'";
$res = mysql_query($w, $conn) or die(mysql_error());

$x = "update registro set factura = '$z' where cargo ='".$cargo."'";
$res8 = mysql_query($x, $conn) or die(mysql_error());

for($c = 0; $c < sizeof($medicamento); $c++) {

$l = $c + 1;

$x = "insert into factura_detalle(medicamento, forma_farma, dosis, horas, dias, cantidad, precio_unitario, precio_venta, factura, linea)
values ('$medicamento[$c]', '$forma[$c]','$dosis[$c]','$horas[$c]', '$dias[$c]','$cantidad[$c]','$precio_unitario[$c]','$precio_venta[$c]', '$z', '$l' )";
$res = mysql_query($x, $conn) or die(mysql_error());

}

echo "<html>
<head>  <link href='estilo.css' rel='stylesheet' type='text/css' /> </head> <body>
 <center><h1>Factura  No.".$z."</h1></center><p>";


$m = "SELECT nombre, id_paciente FROM paciente where id_paciente = (select id_paciente from factura where factura = '$z')";
$result = mysql_query($m, $conn) or die(mysql_error());
echo "<table border='1'>
<tr>

<th>Nombre del Paciente</th>
<th>Cédula</th>

</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['nombre'] . "</td>";
  echo "<td>" . $row['id_paciente'] . "</td>";
  
  echo "</tr>";
  }
echo "</table>";



$n = "SELECT medicamento, forma_farma, dosis, horas, dias, linea, cantidad, precio_unitario, precio_venta FROM factura_detalle where factura = '$z'";

$resulta = mysql_query($n, $conn) or die(mysql_error());
echo "<table border='1'>
<tr>

<th>Medicamento</th>
<th>Forma Farmaceutica</th>
<th>Dosis</th>
<th>Cada Horas</th>
<th>Por Días</th>
<th>Cantidad</th>
<th>Precio Unitario</th>
<th>Precio Venta</th>
</tr>";

while($rows = mysql_fetch_array($resulta))
  {
  echo "<tr>";
  echo "<td>" . $rows['medicamento'] . "</td>";
  echo "<td>" . $rows['forma_farma'] . "</td>";
  echo "<td>" . $rows['dosis'] . "</td>";
  echo "<td>" . $rows['horas'] . "</td>";
    echo "<td>" . $rows['dias'] . "</td>";
	echo "<td>" . $rows['cantidad'] . "</td>";
	echo "<td>" . $rows['precio_unitario'] . "</td>";
	echo "<td>" . $rows['precio_venta'] . "</td>";
  
  echo "</tr>";
  }
  echo "<tr><td align='center' colspan='8'>TOTAL: ".$_POST["total"]."</td></tr>";
echo "</table>";
echo "</body></html>";

 ?>


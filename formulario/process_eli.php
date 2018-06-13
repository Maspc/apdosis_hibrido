<?php 
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$db_selected = mysql_select_db('apdosis_pub', $conn);
echo "entre y me conecte </br>";
error_reporting(E_ALL & ~E_NOTICE);
if (isset($_GET['medicamento'])) {
$medicamento = $_GET['medicamento'];
}
echo "muestro el id: ".$medicamento. " y debe ser el id del medicamento";

$q = "delete from registro_detalle_tmp where medicamento_id =".$medicamento;
echo "el query es: ".$q;
$res = mysql_query($q, $conn) or die(mysql_error());



 ?>

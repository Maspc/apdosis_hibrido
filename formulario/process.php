<?php 
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$db_selected = mysql_select_db('apdosis_pub', $conn);

$medicamento = $_POST['medicamento'];
$forma_farma = $_POST['forma_farma'];
$dosis = $_POST['dosis'].' '.$_POST['dosis_tipo'];
$horas = $_POST['horas'];
$dias = $_POST['dias'];
$medicamento_id = $_POST['medicamento_id'];


$q = "insert into registro_detalle_tmp (medicamento, forma_farma, dosis, horas, dias, medicamento_id)
values ('$medicamento', '$forma_farma', '$dosis', '$horas', '$dias', '$medicamento_id')";
$res = mysql_query($q, $conn) or die(mysql_error());

$ref = $_SERVER['HTTP_REFERER'];
header( 'refresh: 5; url='.$ref);

 ?>

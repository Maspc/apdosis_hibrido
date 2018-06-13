<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'apdosis_pub';
mysql_select_db($dbname);

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select ID_PACIENTE, NOMBRE, ALERGIAS,  PESO, OTROS, COMPANIA_DE_SEGURO, DIABETES, HIPERTENSION from paciente where ID_PACIENTE LIKE '%$q%'";
$rsd = mysql_query($sql) or die(mysql_error());
while($rs = mysql_fetch_array($rsd)) {
	$mid = $rs['ID_PACIENTE'];
	$mdesc = $rs['NOMBRE'];
	$male = $rs['ALERGIAS'];
	$mpeso = $rs['PESO'];
	$motros = $rs['OTROS'];
	$mcia = $rs['COMPANIA_DE_SEGURO'];
	$mdia = $rs['DIABETES'];
	$mhipe = $rs['HIPERTENSION'];
	echo "$mid|$mdesc|$male|$mpeso|$motros|$mcia|$mdia|$mhipe\n";
}
?>


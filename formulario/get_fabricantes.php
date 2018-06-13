<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'apdosis_pub';
mysql_select_db($dbname);

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select codigo_fabricante, descripcion from fabricantes where descripcion LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$mid = $rs['codigo_fabricante'];
	$mdesc = $rs['descripcion'];
	echo "$mdesc|$mid\n";
}
?>


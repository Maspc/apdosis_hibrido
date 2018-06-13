<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'apdosis_pub';
mysql_select_db($dbname);

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre 
FROM medicamentos, formas_farmaceuticas, tipos_posologias
WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%$q%' 
AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma";

$rsd = mysql_query($sql) or die(mysql_error());
while($rs = mysql_fetch_array($rsd)) {
	$mid = $rs['codigo_interno'];
	$mdesc = $rs['nombre'];
	echo "$mdesc|$mid\n";
}
?>


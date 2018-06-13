<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'apdosis_pub';
mysql_select_db($dbname);

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, tipo_impuesto 
FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes
WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%$q%' 
AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
and presentacion.codigo_presentacion = medicamentos.presentacion
and fabricantes.codigo_fabricante = medicamentos.fabricante
and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
and medicamentos.tipo_mercancia = 1";

$rsd = mysql_query($sql) or die(mysql_error());
while($rs = mysql_fetch_array($rsd)) {
	$mid = $rs['codigo_interno']; 
	$mdesc = $rs['nombre']; 
	$mforma = $rs['forma_farma']; 
	$mposo = $rs['tipo_posologia']; 
	$mtipo = $rs['tipo_de_dosis']; 
	$mfdescr = $rs['forma_descri']; 
	$mposo2 = $rs['posologia']; 
	$mcodi = $rs['codigo_de_barra']; 
	$mpre = $rs['precio_unitario']; 
	$mcom = $rs['nombre_comercial']; 
	$mgen = $rs['nombre_generico']; 
	$mpres = $rs['descr_presentacion']; 
	$mcodpres = $rs['presentacion']; 
	$mcantemp = $rs['cantidad_x_empaque']; 
	$mvol =  $rs['volumen']; 
	$mfab = $rs['descr_fabricante']; 
	$mcodfab = $rs['fabricante']; 
	$mcosuni = $rs['costo_unitario']; 
	$mpreuni = $rs['precio_unitario']; 
	$mcoscaja = $rs['costo_caja']; 
	$mprecaja = $rs['precio_caja']; 
	$mcantini = $rs['cantidad_inicial']; 
	$mtipodosis = $rs['tipo_de_dosis']; 
	$mtipodesc = $rs['descr_tipo_dosis']; 
	$manti = $rs['antibiotico']; 
	$mnarco = $rs['narcotico']; 
	$mprepa = $rs['preparacion']; 
	$mdevol = $rs['permite_devol']; 
	$mimp = $rs['tipo_impuesto']; 
	echo "$mdesc|$mid|$mforma|$mposo|$mtipo|$mfdescr|$mposo2|$mcodi|$mpre|$mcom|$mgen|$mpres|$mcodpres|$mcantemp|$mvol|$mfab|$mcodfab|$mcosuni|$mpreuni|$mcoscaja|$mprecaja|$mcantini|$mtipodosis|$mtipodesc|$manti|$mnarco|$mprepa|$mdevol|$mimp\n";
}
?>


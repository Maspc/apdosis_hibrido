<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
include ('seguridad.php'); 
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = 'apdosis_pub';
mysql_select_db($dbname);

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, tipo_impuesto, medicamentos.precio_unitario, medicamentos.codigo_de_barra, grupo_de_medicamentos.descuento_maximo, jubilado, medicamentos.grupo_medicamento, medicamentos.descuento_total  
FROM medicamentos, formas_farmaceuticas, tipos_posologias, grupo_de_medicamentos, medicamentos_x_bodega
WHERE medicamentos.codigo_de_barra LIKE '%$q%' 
AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
and medicamentos.grupo_medicamento = grupo_de_medicamentos.codigo_grupo
AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
and medicamentos.estado_med = 'A'
AND medicamentos_x_bodega.bodega = '2'
and (medicamentos_x_bodega.cantidad_inicial + medicamentos_x_bodega.cantidad_devolucion - medicamentos_x_bodega.cantidad_factura) > medicamentos_x_bodega.inventario_critico
AND medicamentos.precio_unitario > 0";

$rsd = mysql_query($sql) or die(mysql_error());
while($rs = mysql_fetch_array($rsd)) {
	$mid = $rs['codigo_interno'];
	$mdesc = $rs['nombre'];
	$mprecio = $rs['precio_unitario'];
	$mbarra = $rs['codigo_de_barra'];
	$mtipo = $rs['tipo_de_dosis'];
	$mfdescr = $rs['forma_descri'];
	$mposo2 = $rs['posologia'];
	$mgru = $rs['tipo_de_grupo'];
	$mtipoimp = $rs['tipo_impuesto'];
	$mdescmax = $rs['descuento_maximo'];
	$mjubilado = $rs['jubilado'];
	//$mtipogru = $rs['tipo_de_grupo'];
	$grupo =$rs['grupo_medicamento'];
	$mdesctotal =$rs['descuento_total'];
	$g = "select a.porcentaje from grupos_por_dia_desc a  where  a.codigo_grupo = '$grupo' and a.dia_id ='". date("N",time())."'";
	$gres=mysql_query($g,$conn) or die(mysql_error());
	$gnum = mysql_num_rows($gres);
	if($gnum > 0){
			while($grow = mysql_fetch_array($gres)){
		$mdescdia = $grow['porcentaje'];
			}
			}else{
		$mdescdia = 0;
	}
	
	echo "$mbarra|$mid|$mdesc|$mprecio|$mtipoimp|$mdescmax|$mjubilado|$mdescdia|$mdesctotal\n";
}
?>


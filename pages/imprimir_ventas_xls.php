<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=reporte_ventas.csv');
ob_start();
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
include ('seguridad.php');  
mysql_query("SET NAMES 'utf8'");
$db_selected = mysql_select_db('farma', $conn);

$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];
$id_proveedor = $_POST['proveedor'];
$medicamento_id = $_POST['medicamento_id'];


error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300);

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('FECHA','CODIGO', 'CODIGO DE BARRA', 'PRODUCTO', 'COSTO UNITARIO', 'CANTIDAD','PRECIO UNITARIO', 'IMPUESTO', 'PRECIO VENTA', 'PROVEEDOR'));

  $q = "select b.codigo_de_barra, a.factura, CONCAT( b.nombre_comercial,  ' ',  '(', b.nombre_generico,  ')',  ' ', b.posologia,  ' ', e.descripcion,  ' ', f.descripcion, ' ', volumen, ' ',g.descripcion ) as nombre, a.medicamento_id, a.costo_unitario, a.cantidad, a.precio_unitario, a.impuesto, a.precio_venta, c.fecha 
			  from factura_detalle a, medicamentos b, factura c, formas_farmaceuticas f, tipos_posologias e, tipos_posologias g
			  where date(c.fecha) between '$fecha1' and '$fecha2' and a.factura = c.factura  and a.medicamento_id like '$medicamento_id' and a.medicamento_id = b.codigo_interno and a.estado_producto = 'P'
			  AND b.tipo_posologia = e.codigo_posologia
			AND b.forma_farmaceutica = f.codigo_forma
			and b.tipo_volumen = g.codigo_posologia
	union
	select b.codigo_de_barra, a.devolucion as factura, CONCAT( b.nombre_comercial,  ' ',  '(', b.nombre_generico,  ')',  ' ', b.posologia,  ' ', e.descripcion,  ' ', f.descripcion, ' ', volumen, ' ',g.descripcion ) as nombre, a.medicamento_id, a.costo_unitario, (a.cantidad * -1) as cantidad, (a.precio_unitario * -1) as precio_unitario, (a.impuesto * -1) as impuesto, (a.precio_venta * -1) as precio_venta, c.fecha_creacion as fecha 
			  from devolucion_detalle a, medicamentos b, devolucion c,  formas_farmaceuticas f, tipos_posologias e, tipos_posologias g
			  where date(c.fecha_creacion) between '$fecha1' and '$fecha2' and a.factura = c.factura and  a.medicamento_id like '$medicamento_id' and a.medicamento_id = b.codigo_interno and a.no_aceptada != 'S'  AND b.tipo_posologia = e.codigo_posologia
			AND b.forma_farmaceutica = f.codigo_forma
			and b.tipo_volumen = g.codigo_posologia
			  order by fecha";
			  
			  $qres = mysql_query($q, $conn) or die(mysql_error());
			
				
			
				
			
while ($qrow = mysql_fetch_array($qres)){

	$medicamento_id1 = $qrow['medicamento_id'];
	$medicamento = $qrow['nombre'];
	$factura = $qrow['factura'];
	$codigo_de_barra = $qrow['codigo_de_barra'];
	$costo_unitario = $qrow['costo_unitario'];
	$cantidad = $qrow['cantidad'];
	$precio_unitario = $qrow['precio_unitario'];
	$impuesto = $qrow['impuesto'];
	$precio_venta = $qrow['precio_venta'];
	$fecha = $qrow['fecha'];
	
	  $g = "select b.id_proveedor, c.nombre
			  from compras_detalle a, compras b, proveedor c
			  where a.id_compra = b.id_compra and a.medicamento_id = '$medicamento_id1' and b.id_proveedor != '3' and b.id_proveedor = c.id_proveedor order by b.fecha_compra desc limit 1";
			  
			  $gres = mysql_query($g, $conn) or die(mysql_error());
	
	while($grow = mysql_fetch_array($gres)){
		
		$id_proveedor_1 = $grow['id_proveedor']; 
		$nombre_proveedor = $grow['nombre'];
		
		if($id_proveedor == $id_proveedor_1 or $id_proveedor == '%'){
			

	$row = array($fecha,$factura,$codigo_de_barra,$medicamento,$costo_unitario,$cantidad,$precio_unitario,$impuesto,$precio_venta,$nombre_proveedor);

			
	fputcsv($output, $row);
	
}
	}

}
	

?>
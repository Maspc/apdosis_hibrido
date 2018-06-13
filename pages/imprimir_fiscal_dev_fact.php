<?php
	include('./clases/session.php');
	require_once('../modulos/nota_factura.php');
	
	$id = $_POST['id'];
	//echo $id;
	$nombre_carpeta = $_POST['impresora'];
	$factura_fiscal = $_POST['factura_fiscal'];
	$numero_veces = $_POST['numero_veces'];
	$tipo = $_POST['tipo'];
	
	if (isset($_POST['doble'])){
		$doble = $_POST['doble'];
		} else {
		$doble = 'N';
	}
	
	
	
	
	if($nombre_carpeta == 'in1'){
		$nombre_carpeta2 = 'out1';
	}
	
	if($nombre_carpeta == 'in2'){
		$nombre_carpeta2 = 'out2';
	}
	
	if($nombre_carpeta == 'in3'){
		$nombre_carpeta2 = 'out3';
	}
	
	if($tipo == 1){
	$FA = $id;
	$nom_archivo = "facti".str_pad($FA, 7, 0, STR_PAD_LEFT);
	} else if ( $tipo == 2) {
	$w = "select FA from factura where factura = '$id'";
	$wres = mysql_query($w, $conn) or die(mysql_error());
	$nom_archivo = "factic".str_pad($id, 7, 0, STR_PAD_LEFT);
	while ($wrow = mysql_fetch_array($wres)){
	$FA = $wrow['FA'];
	}
	}
	
	
	
	$l = "select nombre from nombres_impresoras where carpeta = '$nombre_carpeta2'";
	
	$lres = mysql_query($l, $conn) or die(mysql_error());
	
	while($lrow = mysql_fetch_array($lres)){
	$equipo_fiscal = $lrow['nombre'];
	}
	
	
	$d = "select factura_fiscal, equipo_fiscal, archivo_fiscal, factura from factura where FA = '$FA' ";
	
	$resd = mysql_query($d, $conn) or die(mysql_error());
	
	while ($rowd = mysql_fetch_array($resd)){
	//$factura_fiscal = $rowd['factura_fiscal'];
	//$archivo_fiscal = $rowd['archivo_fiscal'];
	//$equipo_fiscal = $rowd['equipo_fiscal'];
	$factura = $rowd['factura'];
	//$factura_fiscal = '000000007';
	//$archivo_fiscal = 'FACTI0000077';
	//$equipo_fiscal = 'CLOK311101129';
	}
	
	
	$existe = 0;
	
	
	$b = "select 1 as existe from factura where factura_fiscal = '$factura_fiscal'";
	$bres = mysql_query($b, $conn) or die(mysql_error());
	
	while($brow = mysql_fetch_array($bres)){
	$existe = $brow['existe'];
	}
	
	if ($existe == 0){
	
	
	$myFile1 =  "/home/apdosis/pos/out1/".$nom_archivo;
	$myFile2 = "/home/apdosis/pos/out2/".$nom_archivo;
	$myFile3 = "/home/apdosis/pos/out3/".$nom_archivo;
	
	if (file_exists($myFile1)) {
	$fh = file($myFile);
	} else if (file_exists($myFile2)){
	$fh = file($myFile2);
	} else if (file_exists($myFile3)){
	$fh = file($myFile3);
	}
	
	foreach($fh as $str)
	
    {
	
    list($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k)=explode("\t",$str);
	
	//echo "<li>".$g; //impresora
	//	echo "<li>".$h; //numero fiscal
	//  echo "<hr>";
    }
	
	$c = substr(substr($c,0,-1),1);	//nombre
	$d = substr(substr($d,0,-1),1); //id
	$g = substr(substr($g,0,-1),1); //impresora
	$h = substr(substr($h,0,-1),1); //factura
    
	$mu = "insert into factura_faltante (factura_fiscal, FA, nombre_paciente, id_paciente, fecha, total, equipo_fiscal) values 
	('$factura_fiscal', '$FA', '$c', '$d', '$e','$k' '$g')";
	$mus = mysql_query($mu, $conn) or die(mysql_error());
	
	
	
	
	
	}
	
	
	$r = "select max(numero_devolucion) + 1 as dev from devolucion_manual";
	
	$rres = mysql_query($r, $conn) or die(mysql_error());
	
	while ($rrow = mysql_fetch_array($rres)){
	$dev = $rrow['dev'];
	} 
	
	$dev_long = "NCTI".str_pad(trim($dev), 7, 0, STR_PAD_LEFT);
	$dev_long_min = "ncti".str_pad(trim($dev), 7, 0, STR_PAD_LEFT);
	
	if($doble != 'S'){
	$g = "SELECT total from factura where factura = '$factura'";
	}else{
	$g = "SELECT (total * $numero_veces) as total from factura where factura = '$factura'";
	}
	$gres = mysql_query($g, $conn) or die(mysql_error());
	
	while ($grow = mysql_fetch_array($gres)) {
	$total = $grow['total'];
	}
	
	
	$r = "SELECT total, fecha, factura, historia, no_cama from factura where factura = '$factura'";
	
	$res = mysql_query($r, $conn) or die(mysql_error());
	
	
	
	while ($row = mysql_fetch_array($res)){
	
	$factura = $row['factura'];
	$fecha = $row['fecha'];
	$hist = $row['historia'];
	$cama = $row['no_cama'];
	
	$l = "select distinct nombre_paciente, id_paciente from registro where historia = '$hist'";
	$resl = mysql_query($l, $conn) or die(mysql_error());
	
	
	
	while ($rowl = mysql_fetch_array($resl)){
	$nombre = $rowl['nombre_paciente'];
	$id_paciente = $rowl['id_paciente'];
	}
	
	
	
	
	
	$empresa = $nombre.' Hab: '.$cama.' Hist: '.$hist;
	$ruc = trim($id_paciente);
	$direccion= 'SAN FRANCISCO, URB. PAITILLA  **DEV**';
	
	
	$fp = fopen("/home/apdosis/pos/".$nombre_carpeta."/".$dev_long.".txt","a");
	fwrite($fp, "1\t$dev_long\t$empresa\t$ruc\t$direccion\t$total\t0\tDEVOLUCION\t$fecha\t$equipo_fiscal\t$factura_fiscal\t$FA");
	fclose($fp);
	
	$dev_long_mov = "NCMV".str_pad($dev, 7, 0, STR_PAD_LEFT);
	}
	
	
	$ae = "insert into auditoria_dev_fact(factura, devolucion, factura_fiscal, equipo_fiscal, total, fecha_creacion, historia, no_cama) values
	('$factura', '$dev', '$factura_fiscal', '$equipo_fiscal', '$total', '$fecha', '$hist', '$cama')";
	
	$aer = mysql_query($ae, $conn) or die(mysql_error());
	
	
	if ($doble != 'S') {
	$s = "select factura_detalle.medicamento_id, factura_detalle.medicamento, factura_detalle.dosis, factura_detalle.cantidad, (factura_detalle.precio_unitario + factura_detalle.costo_insumo) as precio_unitario, (impuesto.factor * 100) as impuesto, medicamentos.tipo_de_dosis from factura_detalle, medicamentos, impuesto where factura_detalle.factura = '$factura' and factura_detalle.estado_producto != 'X' and medicamentos.codigo_interno = factura_detalle.medicamento_id and medicamentos.tipo_impuesto = impuesto.tipo_impuesto";
	} else {
	$s = "select factura_detalle.medicamento_id, factura_detalle.medicamento, factura_detalle.dosis, (factura_detalle.cantidad * $numero_veces) as cantidad, (factura_detalle.precio_unitario + factura_detalle.costo_insumo) as precio_unitario, (impuesto.factor * 100) as impuesto, medicamentos.tipo_de_dosis from factura_detalle, medicamentos, impuesto where factura_detalle.factura = '$factura' and factura_detalle.estado_producto != 'X' and medicamentos.codigo_interno = factura_detalle.medicamento_id and medicamentos.tipo_impuesto = impuesto.tipo_impuesto ";
	
	}
	
	$fp2 = fopen("/home/apdosis/pos/".$nombre_carpeta."/".$dev_long_mov.".txt","a");
	
	$res1 = mysql_query($s, $conn) or die(mysql_error());
	while ($row1 = mysql_fetch_array($res1)){
	
	if ($row1['tipo_de_dosis'] == 'M'){
	$cantidad_uni = ceil($row1['cantidad']);
	}else{
	$cantidad_uni = $row1['cantidad'];
	}
	
	
	
	$id = $row1['medicamento_id'];
	$med = $row1['medicamento'];
	$dosis = $row1['dosis'];
	$cant = $cantidad_uni;
	$precio = $row1['precio_unitario'];
	$impuesto = $row1['impuesto'];
	
	$aed = "insert into auditoria_dev_fact_det(factura, devolucion, medicamento_id, medicamento, dosis, cantidad, precio_unitario, impuesto) values
	('$factura', '$dev', '$id', '$med', '$dosis', '$cant', '$precio', '$impuesto')";
	
	$aerd = mysql_query($aed, $conn) or die(mysql_error());
	
	
	fwrite($fp2, "$dev_long\t$id\t$med\t$dosis\t$cant\t$precio\t$impuesto\t2".PHP_EOL);
	}
	fclose($fp2);
	
	
	
	
	
	$up = "insert into devolucion_manual (numero_devolucion,  FA, factura_fiscal, equipo_factura, equipo_fiscal) values ('$dev', '$FA', '$factura_fiscal', '$equipo_fiscal', '$equipo_fiscal')";
	
	$rup = mysql_query($up, $conn) or die(mysql_error());
	
	
	echo "<INPUT TYPE=\"button\" class='blue' value='Obtener N&uacute;mero Fiscal' id='imprimirp' onClick=\"parent.location='numero_fiscal_dev_fact.php?archivo=".$dev_long_min.".txt&FA=".$FA."&dev=".$dev."&factura=".$factura."&carpeta=".$nombre_carpeta2."'\" >";
	//echo "<a href='numero_fiscal_dev.php?archivo=".$dev_long_min.".txt'>Obtener Numero Fiscal</a>";
	
	
	?>
		
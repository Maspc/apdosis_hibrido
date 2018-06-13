<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/caja_menuda.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
	
	if (isset($_POST['proveedor'])) {
		$proveedor = $_POST['proveedor'];
	}
	if (isset($_POST['observaciones'])) {
		$observaciones = $_POST['observaciones'];
	}
	if (isset($_POST['fecha_factura'])) {
		$fecha_factura = $_POST['fecha_factura'];
	}
	
	if(isset($_POST['var_cont'])) {
		$var_cont = $_POST['var_cont'];
	}
	
	
	
	if($var_cont == 0){
		echo "<script language='javascript'>window.location='caja_menuda.php?men=1'</script>";
		} else {
		
		$monto_total = 0;
		$saldo_neg = 0;
		for ($j=1;$j<=$_POST["var_cont"];$j++)
		{
			if ($_POST["codigo_rubro_".$j] == '5'){
				$mon = $_POST["monto_".$j] *  -1;
				}else{
				$mon = $_POST["monto_".$j];
			}
			$monto_total = $monto_total + $mon;
		}						
		
		
		$cols = cajam::cierres_caja();
		foreach($cols as $cs){
			$cierre = $cs->codigo_cierre;
		}			
		
		
		$hrow = cajam::sactual($cierre);
		foreach($hrow as $hw){
			$saldo_actual = $hw->saldo_actual;
		}
		
		$saldo_neg = $saldo_actual * -1;
		
		if ($monto_total > $saldo_neg) {
			echo "<script language='javascript'>window.location='caja_menuda.php?men=2&saldo=$saldo_actual'</script>"; 
			//echo "<p>monto total: ".$monto_total;
			//echo "<p>saldo neg: ".$saldo_neg;
			} else {
			//echo "<p>pase";							
			
			$cont = 0;							
			
			cajam::insert1($proveedor,$observaciones,$_SESSION['MM_iduser'],$fecha_factura);
			
			$maxid = cajam::maxid();
			$y = $maxid[0]->id;
			
			$d = 0;
			for ($i=1;$i<=$_POST["var_cont"];$i++)
			{
				$d = $d + 1;
				$codigo_rubro = $_POST["codigo_rubro_".$i];
				$descripcion = $_POST["descripcion_".$i];
				$monto = $_POST["monto_".$i];
				$itbms = $_POST["itbms_".$i];
				
				
				if ($codigo_rubro == '5'){
					$monto = $monto * -1;
				}
				
				if ($itbms == 'S') {
					$itbms_c = $monto * 0.07;
					$total = $monto + $itbms_c;
					} else {
					$total = $monto;
					$itbms_c = 0;
				}								
				
				cajam::insert2($y,$d,$codigo_rubro,$descripcion,$monto,$itbms_c,$total);
				
				cajam::update1($total,$cierre);
				/*
					$f = "select lote, medicamento_id from medicamentos_x_bodega where lote = '$lote' and medicamento_id = '$medicamento_id' and bodega = 1";
					
					$resf = mysql_query($f, $conn) or die(mysql_error());
					
					$resfnum = mysql_num_rows($resf);
					
					if ($resfnum > 0) {
					while ($row = mysql_fetch_array($resf)){
					$g = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial + '$cantidad_compra' where medicamento_id = '$medicamento_id' and lote = '$lote' and bodega = 1";
					$grs = mysql_query($g, $conn) or die(mysql_error());
					} 
					}else {
					$v = "insert into medicamentos_x_bodega (medicamento_id, bodega, lote, fecha_vencimiento, fecha_inicial, cantidad_inicial, estado) values ('$medicamento_id', 1, '$lote', '$vencimiento', '". date('Y-m-d H:i',time())."', '$cantidad_compra', 'P') ";
					}
					
					$m = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial - '".$cantidad_devuelta."' where medicamento_id = '".$medicamento_id."' and bodega = '1'"; 
					
					$mres = mysql_query($m, $conn) or die(mysql_error());
					
					
					$p = "select fecha_vencimiento, lote from medicamentos_x_lote where medicamento_id = '".$medicamento_id."'";
					
					$pres = mysql_query($p, $conn) or die(mysql_error());
					
					$pnum = mysql_num_rows($pres);
					
					if ($pnum > 0) {
					while ($rows = mysql_fetch_array($pres)) {
					if ($rows['lote'] == $lote) {
					$d = "update medicamentos_x_lote set cantidad = cantidad - '".$cantidad_devuelta."', costo = '".$costo."'  where medicamento_id = '".$medicamento_id."'  and lote = '".$lote."'";
					$resd = mysql_query($d, $conn) or die(mysql_error());
					$cont = 1;
					}
					}
					
					
					
					}	
					
					/* if ($cont == 0) {
					$o = "insert into medicamentos_x_lote (medicamento_id, lote, cantidad, fecha_vencimiento, estado, costo) values ('".$medicamento_id."', '".$lote."','".$cantidad_compra."','".$vencimiento."', 'A', '".$costo."') ";
					$reso = mysql_query($o, $conn) or die(mysql_error());
				}	*/		
				
				
				
			}
			
			
		}}
		
		
		
?>

<h2>Su transacción ha sido realizada con éxito.  El n&uacute;mero del recibo es : <?php echo $y ; ?></h2><p>
	
	<input type="button" value="Imprimir Recibo" class="green" onClick="window.open('imprimir_recibo.php?recibo=<?php echo $y ?>')" />
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script_com.js?r=<?=rand()?>"></script>
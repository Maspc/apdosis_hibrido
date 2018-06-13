<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/enviar_proceso_compra.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
	
	
	if (isset($_POST['id_compra'])) {
		$id_compra = $_POST['id_compra'];
	}
	if (isset($_POST['medicamento_id'])) {
		$medicamento_id = $_POST['medicamento_id'];
	}
	if (isset($_POST['cantidad_entregada'])) {
		$cantidad_entregada = $_POST['cantidad_entregada'];
	}
	if (isset($_POST['cantidad_regalia'])) {
		$cantidad_regalia = $_POST['cantidad_regalia'];
	}
	if (isset($_POST['descuento_uni'])) {
		$descuento_uni = $_POST['descuento_uni'];
	}
	if (isset($_POST['lote'])) {
		$lote = $_POST['lote'];
	}
	if (isset($_POST['anio'])) {
		$anio = $_POST['anio'];
	}
	if (isset($_POST['mes'])) {
		$mes = $_POST['mes'];
	}
	if (isset($_POST['dia'])) {
		$dia = $_POST['dia'];
	}
	if (isset($_POST['costo'])) {
		$costo = $_POST['costo'];
	}
	if (isset($_POST['factura'])) {
		$factura = $_POST['factura'];
	}
	
	
	if (isset($_POST['no_recibido'])) {
		$no_recibido = $_POST['no_recibido'];
	}
	
	if (isset($_POST['tipo_impuesto'])) {
		$tipo_impuesto = $_POST['tipo_impuesto'];
	}
	
	
	if (isset($_POST['factura_proveedor'])) {
		$factura_proveedor = $_POST['factura_proveedor'];
	}
	//echo "ID compra = ".$id_compra;
	
	//echo "<p> size of: ".sizeof($medicamento_id);
	
	
	for($i=0; $i < sizeof($medicamento_id); $i++) {
		//echo "entro al for";
		/*
			$be = "select id_compra_adm from compras_detalle where id_compra = '$id_compra' and medicamento_id = 'medicamento_id[$i]'";
			
			$beres = mysql_query($be, $conn) or die(mysql_error());
			
			while($berow = mysql_fetch_array($beres)){
			
			$id_compra_adm = $berow['$id_compra_adm'];
			
		}*/
		
		$cont = 0;
		
		$fecha_vencimiento = $anio[$i]."-".$mes[$i]."-".$dia[$i];
		
		//echo "<p>tipo impuesto: ".$tipo_impuesto[$i];
		
		$vrow = epcompra::select1($tipo_impuesto[$i]);
		foreach($vrow as $vw){
			$imp_total = ($cantidad_entregada[$i] * ($costo[$i] - $descuento_uni[$i])) * $vw->factor;
		}
		
		//echo "<p>imp total: ".$imp_total;
		
		$total = ($cantidad_entregada[$i] * ($costo[$i] - $descuento_uni[$i])) + $imp_total;
		
		
		if ($cantidad_entregada[$i] > 0 ) {
			
			$hora_actual = date("Y-m-d H:i",time());
			
			epcompra::update1($cantidad_entregada[$i],$lote[$i],$fecha_vencimiento,$costo[$i],$imp_total,$total,$factura_proveedor[$i],$hora_actual,$cantidad_regalia[$i],$descuento_uni[$i],$medicamento_id[$i],$id_compra);
			
			$grow = epcompra::select2($medicamento_id[$i],$id_compra);
			foreach($grow as $gw){
				$cantidad_pendiente = $gw->cantidad_pendiente;
			}
			
			/*añado para guardar el historial de compras*/
			
			epcompra::insert1($id_compra,$medicamento_id[$i],$cantidad_entregada[$i],$cantidad_pendiente,$lote[$i],$fecha_vencimiento,$costo[$i],$imp_total,$total,.$factura_proveedor[$i],$hora_actual);
			if($cantidad_pendiente == 0){
				
				epcompra::update2($medicamento_id[$i],$id_compra);
				
			}
			
			/*
				$le = "update infar_adm.compras_detalle_suc set cantidad_entregada = '".$cantidad_entregada[$i]."', lote='".$lote[$i]."', fecha_de_vencimiento='".$fecha_vencimiento."', costo ='".$costo[$i]."',estado_proceso = 'F', impuesto_total = '$imp_total', total= '$total', factura_proveedor ='".$factura_proveedor[$i]."'   where medicamento_id = '".$medicamento_id[$i]."' and id_compra = '$id_compra' and bodega='$bodega'"; 
				
				$leres = mysql_query($le, $conn) or die(mysql_error());
				
				
				$lei = "update infar_adm.compras_detalle set cantidad_entregada = '".$cantidad_entregada[$i]."', lote='".$lote[$i]."', fecha_de_vencimiento='".$fecha_vencimiento."', costo ='".$costo[$i]."',estado_proceso = 'F', impuesto_total = '$imp_total', total= '$total', factura_proveedor ='".$factura_proveedor[$i]."'   where medicamento_id = '".$medicamento_id[$i]."' and id_compra = '$id_compra_adm'"; 
				
				$leires = mysql_query($lei, $conn) or die(mysql_error());
			*/
			
			epcompra::update3($costo[$i],$medicamento_id[$i]);
			
			$drow = epcompra::select3($medicamento_id[$i]);
			
			foreach($drow as $drw){
				$precio = $drw->precio_unitario;
			}
			
			if ($precio == 0){
				
				epcompra::update4($costo[$i],$medicamento_id[$i]);
				
				epcompra::insert2($medicamento_id[$i],$_SESSION['MM_iduser'],$costo[$i],$precio);
				} else{
				
				epcompra::insert3($medicamento_id[$i],$hora_actual,$_SESSION['MM_iduser'],$costo[$i]);
				
			}
			
		}
		
		//echo $l;
		
		//echo "cantidad entregada: ".$cantidad_entregada[$i];
		//echo "<p>medicamento id: ".$medicamento_id[$i]; 
		
		if (is_null($cantidad_entregada[$i])){
			$cantidad_entregada[$i] = 0;
		}
		
		if (is_null($costo[$i])){
			$costo[$i] = 0;
		}
		
		if (is_null($lote[$i])){
			$lote[$i] = 0;
		}
		
		epcompra::update5($cantidad_entregada[$i],$cantidad_regalia[$i],$medicamento_id[$i]);
		
		$rows = epcompra::select4($medicamento_id);
		
		if (count($rows) > 0) {
			foreach($rows as $rws){
				if ($rws->lote == $lote[$i]) {
					epcompra::update6($cantidad_entregada[$i],$costo[$i],$medicamento_id[$i],$lote[$i]);
					//$cont = 1;
				}
			}
			
			}	else {
			epcompra::insert4($medicamento_id[$i],$lote[$i],$cantidad_entregada[$i],$fecha_vencimiento[$i],$costo[$i]);										
		}
		
	}
	
	if (isset($no_recibido)){
		
		for($j=0; $j < sizeof($no_recibido); $j++) {
			//echo "<p>linea: ".$no_recibido[$j];
			epcompra::update7($no_recibido[$j],$id_compra);
		}
	}
	
	
	$hnum = count(epcompra::select5($id_compra));
	
	if($hnum == 0){
		
		epcompra::update8($factura,$id_compra);
	}
	
	echo "<h2>La orden de compra ".$id_compra." fue procesada</h2>";
	
?>
<p>
	<input type="button" value="Imprimir Proceso de Compra" class="green" onClick="window.open('imprimir_compra_pr.php?compra=<?php echo $id_compra ?>')" />
	
	<?=layout::fin_content()?>
	<script type="text/javascript">
		function toggleDiv(divId) {
			$("#"+divId).toggle();
		}
	</script>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
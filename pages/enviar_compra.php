<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/compras_detalle.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
?>
<style type="text/css">
	
	.red {
	background-color: red;
	color: white;
	}
	.white {
	background-color: white;
	color: black;
	}
	.green {
	background-color: green;
	color: white;
	}
	
	.blue {
	background-color: blue;
	color: white;
	}
	.red, .white, .blue, .green {
	margin: 0.5em;
	padding: 5px;
	font-weight: bold;
	
	}
	
</style>
<?php
	layout::menu();
	layout::ini_content();
?>
<font face="Arial" size="2" color="#000000">
	<?php
		if (isset($_POST['proveedor'])) {
			$proveedor = $_POST['proveedor'];
		}
		if (isset($_POST['observaciones'])) {
			$observaciones = $_POST['observaciones'];
		}
		if (isset($_POST['factura'])) {
			$factura = $_POST['factura'];
		}
		if (isset($_POST['tipo_entrada'])) {
			$tipo_entrada = $_POST['tipo_entrada'];
		}
		
		
		if(isset($_POST['var_cont'])) {
			$var_cont = $_POST['var_cont'];
		}
		
		
		if($var_cont == 0){
			echo "<script language='javascript'>window.location='compras_detalle.php?men=1'</script>";
			} else {
			$total_comp = 0;
			if ($tipo_entrada == 1){
				
				$cols = comprasdet::select1();
				foreach($cols as $cos){ 
					$cierre = $cos->codigo_cierre;
				}
				
				
				for ($i=1;$i<=$_POST["var_cont"];$i++)
				{
					$cantidad_compra = $_POST["cantidad_$i"];
					$costo = $_POST["costo_$i"];
					$tipo_impuesto = $_POST["tipo_impuesto_$i"];
					
					$vrow = comprasdet::select2($tipo_impuesto);
					foreach($vrow as $vrw){
						$imp_total = ($cantidad_compra * $costo) * $vrw->factor;
					}
					
					$total = ($cantidad_compra * $costo) + $imp_total;
					
					$total_comp = $total_comp + $total;			  
				}
				
				$hrow = comprasdet::select3($cierre);
				foreach($hrow as $hrw){
					$saldo_actual = $hrw->saldo_actual;
				}
				
				$saldo_neg = $saldo_actual * -1;
				
				
			}
			
			if ($total_comp > $saldo_neg) {
				echo "<script language='javascript'>window.location='compras_detalle.php?men=2&saldo=$saldo_actual'</script>"; 
				//echo "<p>monto total: ".$monto_total;
				//echo "<p>saldo neg: ".$saldo_neg;
				
				
				
				} else {
				
				
				/*agrego que afecta saldo de caja menuda*/
				
				$cols = comprasdet::select4();
				foreach($cols as $cos2){  
					$cierre = $cos2->codigo_cierre;
				}
				
				/******/
				
				$cont = 0;
				
				$trow = comprasdet::select5($tipo_entrada);
				foreach($trow as $trw){
					$afecta_costo = $trw->afecta_costo;
				}
				
				if ($tipo_entrada == 1) {
					$x = comprasdet::insert2($proveedor,$observaciones,$_SESSION['MM_iduser']);
				}
				
				
				//quemo el valor de bodega mientras lo añado a la session
				$bodega = '2';
				
				$y = comprasdet::insert3($proveedor,$observaciones,$_SESSION['MM_iduser'],$factura,$tipo_entrada);
				
				$d = 0;
				for ($i=1;$i<=$_POST["var_cont"];$i++)
				{
					if (isset($_POST["costo_$i"])){
						$d = $d + 1;
						$medicamento_id = $_POST["medicamento_id_$i"];
						$cantidad_compra = $_POST["cantidad_$i"];
						$lote = $_POST["lote_$i"];
						$vencimiento = $_POST["calendar_$i"];
						$costo = $_POST["costo_$i"];
						$tipo_impuesto = $_POST["tipo_impuesto_$i"];
						$regalias = $_POST["regalias_$i"];
						$descuento = $_POST["descuento_$i"];
						$cantidad_bodega = $_POST["cantidad_bodega_$i"];
						$cantidad_tienda = $_POST["cantidad_tienda_$i"];
						$cantidad_externo = $_POST["cantidad_externo_$i"];
						$codigo_de_barra =  $_POST["codigo_de_barra_$i"];
						
						$vrow = comprasdet::select6($tipo_impuesto);
						foreach($vrow as $vrw){
							$imp_total = ($cantidad_compra * ($costo-$descuento)) * $vrw->factor;
						}
						
						$total = ($cantidad_compra * ($costo-$descuento)) + $imp_total;
						
						comprasdet::insert4($y,$d,$medicamento_id,$cantidad_compra,$lote,$vencimiento,$costo,$cantidad_compra,$imp_total,$total,$regalias,$descuento,$cantidad_bodega,$cantidad_tienda,$cantidad_externo);
						
						if ($tipo_entrada == 1) {
							
							$lrow = comprasdet::select7($medicamento_id);
							foreach($lrow as $lrw){
								$medicamento_nom = $lrw->medicamento;
								
							}
							
							comprasdet::insert5($x,$d,$medicamento_nom,$total);
							
							comprasdet::update1($total,$cierre);
							
						}
						
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
						}*/
						
						
						
						
						
						/*
							
							
							$m = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial + '".$cantidad_compra."' + '".$regalias."' where medicamento_id = '".$medicamento_id."' and bodega = '1'"; 
							
							$mres = mysql_query($m, $conn) or die(mysql_error());
							
						*/
						
						//cambio para actualizar la cantidad por bodegas
						
						comprasdet::update2($cantidad_bodega,$regalias,$medicamento_id);
						
						comprasdet::update3($cantidad_tienda,$medicamento_id);
						
						$hirow = comprasdet::select8();
						foreach($hirow as $hiw){
							$ip = $hiw->ip;
						}
						
						//echo "ip ".$ip;
						
						$valido = 0;
						
						if ($cantidad_externo > 0){
							
							//echo "<p>entro a realizar un traslado externo";
							
							$serow = comprasdet::select9($codigo_de_barra);
							if(count($serow) > 0) {
								
								foreach($serow as $srw){
									$medicamento_id_ext = $srw->codigo_interno;
								}
								
								//echo "<p> dbhost ".$dbhost;
								
								//echo "<p>voy a trasladar el medicamento: ".$medicamento_id_ext;
								
								comprasdet::insert6($_SESSION['MM_iduser'],$medicamento_id_ext,$cantidad_externo);
								
								comprasdet::update4($cantidad_externo,$medicamento_id_ext);
								
								} else {
								echo "No se pudo trasladar el producto con codigo ".$codigo_de_barra." porque no existe en la base de datos externa, verifique";
								$valido = 1;
							}
							
						}
						
						
						if($valido == 1){							
							
							comprasdet::update5($y,$medicamento_id);
							
							comprasdet::update6($y,$medicamento_id);
							
							comprasdet::update7($cantidad_externo,$medicamento_id);
						}
						
						
						if ($afecta_costo == 'S'){
							
							comprasdet::update8($costo,$medicamento_id);
							
							$drow = comprasdet::select10($medicamento_id);
							foreach($drow as $drw){
								$precio = $drw->precio_unitario;
							}
							
							if ($precio == 0){
								
								comprasdet::update9($costo,$medicamento_id);
								
								comprasdet::insert7($medicamento_id,$_SESSION['MM_iduser'],$costo,$precio);								
							}
						}
						
						
						$rows = comprasdet::select11($medicamento_id);
						if (count($rows) > 0) {
							foreach($rows as $rws){
								if ($rws->lote == $lote) {
									comprasdet::update10($cantidad_compra,$costo,$medicamento_id,$lote);
								}
							}
							
							
							
						}
						
						if ($cont == 0) {
							comprasdet::insert8($medicamento_id,$lote,$cantidad_compra,$vencimiento,$costo);
						}						
						
					}
					
				}
				
				
			} 
			
		}
		
		
		
	?>
	
	<h2>Su transacción ha sido realizada con éxito.  El n&uacute;mero de la entrada es : <?php echo $y ; if($tipo_entrada == 1){ echo  " El n&uacute;mero de recibo de caja es : ".$x; } ?></h2><p>
		
		<input type="button" value="Imprimir Entrada" class="green" onClick="window.open('imprimir_compra.php?compra=<?php echo $y; if($tipo_entrada == 1){ echo "&recibo=".$x; } ?>')" />
	<?=layout::fin_content()?>			
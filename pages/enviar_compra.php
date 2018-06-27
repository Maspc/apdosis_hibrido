<?php
	
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/enviar_compra.php');
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
			
			
			$resul= enviar_c::select1();  
			foreach($resul as $cols)
			
			{	  
				$cierre = $cols->codigo_cierre;
			}
			
			
			for ($i=1;$i<=$_POST["var_cont"];$i++)
			{
				$cantidad_compra = $_POST["cantidad_$i"];
				$costo = $_POST["costo_$i"];
				$tipo_impuesto = $_POST["tipo_impuesto_$i"];
				
				
				$vres=  enviar_c::select2($tipo_impuesto);  
				foreach( $vres as $vrow)
				{
					$imp_total = ($cantidad_compra * $costo) * $vrow->factor;
				}
				
				$total = ($cantidad_compra * $costo) + $imp_total;
				
				$total_comp = $total_comp + $total;			  
			}	  
			
			
			
			$hres =enviar_c::select3($cierre);
			foreach($hres as $hrow)
			
			{
				$saldo_actual = $hrow->saldo_actual;
			}
			
			$saldo_neg = $saldo_actual * -1;
			
			
		}
		
		if ($total_comp > $saldo_neg) {
			echo "<script language='javascript'>window.location='compras_detalle.php?men=2&saldo=$saldo_actual'</script>"; 
			//echo "<p>monto total: ".$monto_total;
			//echo "<p>saldo neg: ".$saldo_neg;
			
			
			
			} else {
			
			
			/*agrego que afecta saldo de caja menuda*/
			
			$resul= enviar_c::select4();     
			foreach( $resul as $cols)
			
			{	  
				$cierre = $cols->codigo_cierre;
			}
			
			/******/
			
			$cont = 0;
			
			
			$tres=enviar_c::select5($tipo_entrada);
			foreach($tres as $trow)
			{
				$afecta_costo = $trow->afecta_costo;
			}
			
			if ($tipo_entrada == 1) {
				
				$fres=enviar_c::insert1($proveedor,$observaciones,$_SESSION['MM_iduser']);
				
				
				$x = mysql_insert_id();
			}
			
			
			//quemo el valor de bodega mientras lo añado a la session
			$bodega = '2';
			
			
			
			$fres=enviar_c::insert2($proveedor,$observaciones,$_SESSION['MM_iduser'],$factura,$tipo_entrada);
			
			
			$y = mysql_insert_id();
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
					$codigo_de_barra =  $_POST["codigo_de_barra_$i"];
					
					
					$vres= enviar_c::select6($tipo_impuesto);
					
					foreach($vres as $vrow)
					{
						$imp_total = ($cantidad_compra * ($costo-$descuento)) * $vrow->factor;
					}
					
					$total = ($cantidad_compra * ($costo-$descuento)) + $imp_total;
					
					
					
					$res=enviar_c::insert3($y,$d,$medicamento_id,$cantidad_compra,$lote,$vencimiento,$costo,$regalias,$imp_total,$total,$descuento);
					
					
					
					if ($tipo_entrada == 1) {
						
						
						$lres=enviar_c::select7($medicamento_id);
						foreach($lres as $lrow)
						
						{
							$medicamento_nom = $lrow->medicamento;
							
						}
						
						
						$res=enviar_c::insert4($x,$d,$medicamento_nom,$total);
						
						
						
						
						$fres= enviar_c::update1($total,$cierre);
						
						
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
					
					
					
					$mres = enviar_c::update2($cantidad_compra,$regalias,$medicamento_id);
					
					
					
					
					if ($afecta_costo == 'S'){
						
						$nres = enviar_c::update3($costo,$medicamento_id);
						
						
						$dres = enviar_c::select8($medicamento_id);
						foreach($dres as $drow)
						
						{
							$precio = $dro->precio_unitario;
						}
						
						if ($precio == 0){
							
							
							$mres = enviar_c::update4($medicamento_id,$costo);							
							
							
							$hres = enviar_c::insert5($medicamento_id,$_SESSION['MM_iduser'],$costo,$precio);
							
						}
					}
					
					
					
					$pres =enviar_c::select9($medicamento_id);
					
					
					$pnum = count($pres);
					
					if ($pnum > 0) {
						while ($rows = mysql_fetch_array($pres)) {
							if ($rows['lote'] == $lote) {
								$d = 
								$resd = enviar_c::update5($cantidad_compra,$costo,$medicamento_id,$lote);
								
								$cont = 1;
							}
						}
						
						
						
					}	
					
					if ($cont == 0) {
						
						$reso =enviar_c::insert6($medicamento_id,$lote,$cantidad_compra,$vencimiento,$costo);
						
					}			
					
					
					
					
				}
				
			}
			
			
		} 
		
		}
		
		
		layout::fin_content();
		
?>

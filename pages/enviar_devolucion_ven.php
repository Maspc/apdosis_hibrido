<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/devolucion_vencimiento.php');
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
	
	if(isset($_POST['var_cont'])) {
		$var_cont = $_POST['var_cont'];
	}
	
	if($var_cont == 0){
		echo "<script language='javascript'>window.location='devolucion_vencimiento.php?men=1'</script>";
		} else {
		
		$cont = 0;
		
		dvencimiento::insert1($proveedor,$observaciones,$_SESSION['MM_iduser']);
		
		$mid = dvencimiento::maxid();
		
		$y = $mid[0]->id;
		
		$d = 0;
		for ($i=1;$i<=$_POST["var_cont"];$i++)
		{
			$d = $d + 1;
			$medicamento_id = $_POST["medicamento_id_".$i];
			$cantidad_devuelta = $_POST["cantidad_".$i];
			$lote = $_POST["lote_".$i];
			$vencimiento = $_POST["calendar_".$i];
			$costo = $_POST["costo_".$i];
			
			dvencimiento::insert2($y,$d,$medicamento_id,$cantidad_devuelta,$lote,$vencimiento,$costo);
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
			
			dvencimiento::update1($cantidad_devuelta,$medicamento_id);
			
			$rows = dvencimiento::select1($medicamento_id);
			
			if (count($rows) > 0) {
				foreach($rows as $rws){
					if ($rws->lote == $lote) {
						dvencimiento::update2($cantidad_devuelta,$costo,$medicamento_id,$lote);										
						$cont = 1;
					}
				}
				
			}
			
			/* if ($cont == 0) {
				$o = "insert into medicamentos_x_lote (medicamento_id, lote, cantidad, fecha_vencimiento, estado, costo) values ('".$medicamento_id."', '".$lote."','".$cantidad_compra."','".$vencimiento."', 'A', '".$costo."') ";
				$reso = mysql_query($o, $conn) or die(mysql_error());
			}	*/		
			
			
			
			
			
			
		}
		
		
	}
	
	
	
?>

<h2>Su transacción ha sido realizada con éxito.  El n&uacute;mero de la devolucion por vencimiento es : <?php echo $y ; ?></h2><p>
	
	<input type="button" value="Imprimir Devolución" class="green" onClick="window.open('imprimir_devolucion_vencimiento.php?devolucion=<?php echo $y ?>')" />
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
<script language="javascript" type="text/javascript" src="../js/script_com.js?r=<?=rand()?>"></script>
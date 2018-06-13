<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/historial_compras.php');
	$medicamento_id= $_GET['medicamento_id'];
	$id_compra= $_GET['id_compra'];
	header('Content-Type: text/html; charset=ISO-8859-1');	
	
?>
<html>
	<body>
		<?php 
			$hirow = hcompras::ip();
			foreach($hirow as $hw){
				$ip = $hw->ip;
			}
			
			//echo "ip ".$ip;
			
			$valido = 0;			
		
			$frow = hcompras::select1($id_compra,$medicamento_id);
		?>
		<table border="1">
			<tr>
				<th>Recibida</th>
				<th>Pendiente</th>
				<th>Lote</th>
				<th>Fecha Venc.</th>
				<th>Costo</th>
				<th>Imp. Tot.</th>
				<th>Total</th>
				<th>Lote</th>
				<th>Fact. Prov.</th>
			<th>Fecha Proc.</th></tr>
			<?php
			foreach($frow as $fw){
				echo "<tr><td>".$fw->cantidad_entregada."</td>";
					echo "<td>".$fw->cantidad_pendiente."</td>";
					echo "<td>".$fw->lote."</td>";
					echo "<td>".$fw->fecha_de_vencimiento."</td>";
					echo "<td>".$fw->costo."</td>";
					echo "<td>".$fw->impuesto_total."</td>";
					echo "<td>".$fw->total."</td>";
					echo "<td>".$fw->lote."</td>";
					echo "<td>".$fw->factura_proveedor."</td>";
					echo "<td>".$fw->fecha_proceso."</td></tr>";
				}
			?>
		</table>
	</body>
</html>
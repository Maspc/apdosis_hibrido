<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/vencimiento.php');	
	$cont = 0;
	require_once('../modulos/layout.php');
	layout::encabezado();
?>
<script type="text/javascript">
	function enable()
	{
		if (document.getElementById("cierre_nave").disabled==true)
		{
			document.getElementById("cierre_nave").disabled=false;
		} 
		
		
		
		return false;
	}
</script>
<?php
	layout::menu();
	layout::ini_content();
?>
<center><h2>Medicamentos a Vencer en Tres Meses</h2></center>
<center><table id="dtable" border="1"><tr><th>Medicamento</th><th>Existencia</th><th>Fecha de Vencimiento</th><th>Lote</th><th>Última Compra</th><th>Fecha de Compra</th><th>Cantidad de Compra</th></tr>
	<?php
		
		$dia_actual = date("Y-m-d",time());	
		
		$frow = vence::select1();
		foreach($frow as $fw){
			$id_compra = $fw->id_compra;
			$medicamento_id = $fw->medicamento_id;
			
			$grow = vence::select2($id_compra,$medicamento_id);
			foreach($grow as $gw){
				$fecha_de_vencimiento = $gw->fecha_de_vencimiento;
				$existencia = $gw->cantidad;
				$cantidad_entregada = $gw->cantidad_entregada;
				$lote = $gw->lote;
				
				if ($existencia > $cantidad_entregada){
					
					$row = vence::select3($id_compra,$medicamento_id);
					foreach($row as $rw){
						$compra_anterior = $rw->compra_anterior;
					}										
				}
				
				if ($fecha_de_vencimiento != '0000-00-00'){ //001-01-01
					
					$meses_diferencia = (int)ceil(abs((strtotime($fecha_de_vencimiento) - strtotime($dia_actual))/(60*60*24*30))); 
					
					if (($meses_diferencia <= 3) && ($existencia > 0)) { //001-01-01-01
						echo "<tr>";
						echo "<td>".$gw->medicamento."</td>";
						echo "<td>".$existencia."</td>";
						echo "<td>".$fecha_de_vencimiento."</td>";
						echo "<td>".$lote."</td>";
						echo "<td>".$id_compra."</td>";
						echo "<td>".$gw->fecha_compra."</td>";
						echo "<td>".$gw->cantidad_entregada."</td></tr>";
						
					} //001-01-01-01
					
					
				} 
			}
		}
		
		
	?>
</table></center>
<?=layout::fin_content()?>
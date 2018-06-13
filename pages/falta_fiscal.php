<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/falta_fiscal.php');
	$cont = 0;
	require_once('../modulos/layout.php');
	layout::encabezado();
?>
<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:1200px;dialogHeight:600px");
			} else {
			alert(url);
			window.open(url,'name','height=500,width=600,toolbar=yes,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} 
</script>
<?php
	layout::menu();
	layout::ini_content();
?>
<center>   <h1>Facturas Fiscales</h1></center>
<div class="content_box_inner">
	
	<?php  
		
		$cont = 0;
		
		echo "<table id='dtable' border='1' style='font-size:small' align='center'> <tr>";
		
		$rows5 = ffiscal::select1();
		foreach($rows5 as $rw5){
			$cont = $cont + 1;
			echo "<td>";
			echo "<p><b>No. Id:</b> " . $rw5->factura ."<br>".
			"<p><b>Total:</b> " . $rw5->total ."<br>".
			"<p><b>Usuario:</b> " . $rw5->ordenado_por ."<br>".
			"<p><b>Caja:</b> " . $rw5->caja_id ."<br>".
			"<p><b>Fecha:</b> " . $rw5->fecha ."<br>";							
			
		?>
		<input type='button' value='Reenviar Factura'  class='green' onClick="window.open('numero_fiscal_stat_manual.php?factura=<?=$rw5->factura?>','mywindow','width=400,height=400,toolbar=yes');" />
		
		
		<?php  echo "</td>";
			echo "<p>";
			
			
			
			
			
			if ($cont % 5 == 0 ) {
				echo "</tr><tr>";
			}
		}
		
		echo  "</tr></table>"; 
		
		$cont3 = 0;
		echo "<hr>";
		
		
		echo "<center><h1>Devoluciones Fiscales</h1></center>";							
		
		echo "<table id='dtable' border='1' style='font-size:small' align='center'> <tr>";
		
		$rows7 = ffiscal::select2();
		foreach($rows7 as $rw7){
			
			if ($rw7->estado == 'E') {
				$esta = 'Finalizada';
				} if ($rw7->estado == 'P') { 
				$esta = 'Pendiente';
				} if ($rw7->estado == 'I') { 
				$esta = 'Finalizada';
			}
			
			$cont3 = $cont3 + 1;
			echo "<td>";
			echo "<p><b>No. Devolucion:</b> " . $rw7->devolucion ."<br>".
			"<p><b>Total:</b> " . $rw7->total ."<br>".
			"<p><b>Fecha:</b> " . $rw7->fecha_creacion ."<br>";
			
		?>
		<input type='button' value='Reenviar Devolucion'  class='green' onClick="window.open('numero_fiscal_dev_manual.php?devolucion=<?=$rw7->devolucion?>','mywindow','width=400,height=400,toolbar=yes');" />
	</td>
	<?php							
		
		if ($cont3 % 5 == 0 ) {
			echo "</tr><tr>";
		}
		
	}						
	
	echo  "</tr></table>"; 
	
?>

</div>
<?=layout::fin_content()?>
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/ver_devoluciones.php');
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
<center>   <h1>Devoluciones Pendientes</h1></center>
<div class="content_box_inner">
	
	<?php  
		
		$cont = 0;
		
		$frow = vdevolucion::ecarros();
		
		foreach($frow as $fw){
			$codigo_carro_p = $fw->codigo_carro;
		}											
		
		echo "<table class='dtable' border='1' style='font-size:small'> <tr>";
		
		$rows5 = vdevolucion::select1();
		foreach($rows5 as $rw5){
			$cont = $cont + 1;
			echo "<td>";
			echo "<b>No. Devolucion:</b> " . $rw5->devolucion ."<br>".
			"<b>Tipo:</b> " . $rw5->tipo ."<br>".
			"<p><b>Fecha creacion:</b> " . $rw5->fecha_creacion ."<br>".
			"<p><b>No. Cama:</b> " . $rw5->no_cama ;
			echo "<p><INPUT TYPE=\"button\" class='blue' value='Imprimir Fiscal' id='imprimirp' onClick=\"window.open('imprimir_fiscal_dev.php?devolucion=".$rw5->devolucion."','mywindow','width=800,height=600');\" >>";
			echo "<p>";
			echo "<hr>";
			echo "</td>";
			
			
			
			if ($cont % 5 == 0 ) {
				echo "</tr><tr>";
			}
		}
		
		echo  "</tr></table>"; 
		
		$cont1 = 0;
		echo "<hr>";
		
		echo "<center><h1>Facturas STAT </h1></center>";
		
		$rows6 = vdevolucion::select2();
		echo "<table class='dtable' border='1' style='font-size:small'> <tr>";
		
		foreach($rows6 as $rw6){
			if ($rw6->estado_factura == 'E') {
				$esta = 'Enviada (Sin Procesar)';
				} if ($rw6->estado_factura == 'P') { 
				$esta = 'Por Procesar';
				} if ($rw6->estado_factura == 'I'){
				$esta = 'Impresa';
				} if ($rw6->estado_factura == 'F') { 
				$esta = 'Procesada (por Facturar)';
			}
			
			$cont1 = $cont1 + 1;
			echo "<td>";
			echo "<b>Historia:</b> " . $rw6->historia ."<br>".
			"<b>Nombre:</b> " . $rw6->nombre_paciente ."<br>".
			"<p><b>No. Factura:</b> " . $rw6->factura ."<br>".
			"<p><b>Total:</b> " . $rw6->total ."<br>".
			"<p><b>Fecha:</b> " . $rw6->fecha ."<br>";
			if ($rw6->estado_factura == 'F') {
			?>
			<input type='button' value='Imprimir Factura'  class='green' onClick="window.open('proceso_cierre_paciente_stat.php?no_factura=<?=$rw6->factura?>','mywindow','width=1250,height=750,toolbar=yes');" />
			
			<?php } else { ?>
		Factura Impresa o No Procesada</a>
		<?php } echo "</td>";
		
		
		
		
		if ($cont1 % 5 == 0 ) {
			echo "</tr><tr>";
		}
	}
	
	echo  "</tr></table>"; 
	
	
?>

</div>
<?=layout::fin_content()?>
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/cierre_carro_hospital.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	$cont = 0;
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
	background-color: #0066FF;
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
	
	$cont1 = 0;
	// echo "<hr>";
	
	echo "<center><h1>Facturas Procesadas por el MAR</h1></center>";
	
	$resulta6 = cierre_ch::select1();
	echo "<table border='1' style='font-size:small'> <tr>";
	foreach($resulta6 as $rows6){
	
		if ($rows6->estado_factura == 'E') {
			$esta = 'Enviada (Sin Procesar)';
			} if ($rows6->estado_factura == 'P') { 
			$esta = 'Por Procesar';
			} if ($rows6->estado_factura == 'I'){
			$esta = 'Impresa';
			} if ($rows6->estado_factura == 'F') { 
			$esta = 'Procesada (por Facturar)';
		}
		
		$cont1 = $cont1 + 1;
		echo "<td>";
		echo "<b>Historia:</b> " . $rows6->historia ."<br>".
		"<b>Nombre:</b> " . $rows6->nombre_paciente ."<br>".
		"<p><b>ID Transaccion:</b> " . $rows6->factura ."<br>".
		"<p><b>FU:</b> " . $rows6->FA ."<br>".
		"<p><b>Total:</b> " . $rows6->total ."<br>".
		"<p><b>Fecha:</b> " . $rows6->fecha ."<br>";
		if ($rows6->estado_factura == 'F') {
		?>
		<input type='button' value='Imprimir Factura'  class='green' onClick="window.open('proceso_cierre_paciente.php?no_factura=<?php echo  $rows6->factura ?>','mywindow','width=1250,height=750, scrollbars=yes');" />
		
		<?php } else { ?>
	Factura Impresa o No Procesada</a>
	<?php } echo "</td>";
	
	
	
	
	if ($cont1 % 5 == 0 ) {
		echo "</tr><tr>";
	}
}

echo  "</tr></table>"; 



layout::fin_content();
?>

</div>

<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:1250px;dialogHeight:750px");
			} else {
			alert(url);
			window.open(url,'name','height=1250,width=750,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} 
	</script>	
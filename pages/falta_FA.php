<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/falta_FA.php');
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
?>
<center>   <h1>Facturas Fiscales</h1></center>
<div class="content_box_inner">
	
	<?php  
		
		$cont = 0;
		
		
		
		
		echo "<table border='1' style='font-size:small'> <tr>";
		
		$resulta5 =falta_fa::select1();  
		
		
		foreach($resulta5  as $rows5 )
		
		{
			$cont = $cont + 1;
			echo "<td>";
			echo "<b>Historia:</b> " . $rows5->historia ."<br>".
			"<p><b>Nombre:</b> " . $rows5->nombre_paciente ."<br>".
			"<p><b>No. FU:</b> " . $rows5->FA ."<br>".
			"<p><b>No. Id:</b> " . $rows5->factura ."<br>".
			"<p><b>Total:</b> " . $rows5->total ."<br>".
			"<p><b>Fecha:</b> " . $rows5->fecha."<br>";
			if ($rows5->estado_factura == 'I') {
			?>
			<input type='button' value='Reenviar Factura'  class='green' onClick="window.open('numero_fiscal_stat_manual.php?factura=<?php echo  $rows5['factura'] ?>','mywindow','width=400,height=400,toolbar=yes');" />
			
			<?php } else { ?>
		Factura No Impresa o No Procesada</a>
		<?php } echo "</td>";
		echo "<p>";
		
		
		
		
		
		if ($cont % 5 == 0 ) {
			echo "</tr><tr>";
		}
	}
	
	echo  "</tr></table>"; 
	
	$cont1 = 0;
	echo "<hr>";
	
	echo "<center><h1>Cargos Procesados sin FA</h1></center>";
	
	
	
	$resulta6 =falta_fa::select2(); 
	
	
	echo "<table border='1' style='font-size:small'> <tr>";
	foreach($resulta6 as $rows6)
	
	{
		if ($rows6->estado_factura == 'E') {
			$esta = 'Enviada (Sin Procesar)';
			} if ($rows6->estado_factura == 'P') { 
			$esta = 'Por Procesar';
			} if ($rows6->estado_factura== 'I'){
			$esta = 'Impresa';
			} if ($rows6->estado_factura == 'F') { 
			$esta = 'Procesada (por Facturar)';
		}
		
		$cont1 = $cont1 + 1;
		echo "<td>";
		echo "<b>Historia:</b> " . $rows6->historia ."<br>".
		"<b>Nombre:</b> " . $rows6->nombre_paciente."<br>".
		"<p><b>No.Id:</b> " . $rows6->factura ."<br>".
		"<p><b>Total:</b> " . $rows6->total ."<br>".
		"<p><b>Fecha:</b> " . $rows6->fecha ."<br>";
		if ($rows6->estado_factura == 'F' || $rows6->estado_factura == 'I') {
		?>
		<input type='button' value='Reenviar Cargo'  class='green' onClick="window.open('reenviar_FA_cargo.php?no_factura=<?php echo  $rows6->factura?>','mywindow','width=400,height=400,toolbar=yes');" />
		
		<?php } else { ?>
	Factura Impresa o No Procesada</a>
	<?php } echo "</td>";
	
	
	
	
	if ($cont1 % 5 == 0 ) {
		echo "</tr><tr>";
	}
}

echo  "</tr></table>"; 

$cont8 = 0;

echo "<hr>";

echo "<center><h1>Devoluciones Procesadas sin FA</h1></center>";


$resulta9 =falta_fa::select3(); 


echo "<table border='1' style='font-size:small'> <tr>";
foreach ($resulta9  as $rows9)

{
	if ($rows9->estado == 'E') {
		$esta = 'Finalizada';
		} if ($rows9->estado == 'P') { 
		$esta = 'Pendiente';
		} if ($rows9->estado == 'F') { 
		$esta = 'Procesada';
	}
	
	$cont8 = $cont8 + 1;
	echo "<td>";
	echo "<b>Historia:</b> " . $rows9->historia ."<br>".
	"<b>Nombre:</b> " . $rows9->nombre_paciente ."<br>".
	"<p><b>No. Devolucion:</b> " . $rows9->devolucion ."<br>".
	"<p><b>Total:</b> " . $rows9->total ."<br>".
	"<p><b>Fecha:</b> " . $rows9->fecha_creacion ."<br>";
	
?>

<input type='button' value='Reenviar Cargo'  class='green' onClick="window.open('reenviar_FA_devolucion.php?devolucion=<?php echo  $rows9['devolucion'] ?>','mywindow','width=400,height=400,toolbar=yes');" />


<?php  echo "</td>";
	
	
	
	
	if ($cont8 % 5 == 0 ) {
		echo "</tr><tr>";
	}
}

echo  "</tr></table>"; 



$cont3 = 0;
echo "<hr>";

echo "<center><h1>Devoluciones Fiscales</h1></center>";


$resulta7 =falta_fa::select4(); 


echo "<table border='1' style='font-size:small'> <tr>";
foreach($resulta7 as $rows7)

{
	if ($rows7->estado == 'E') {
		$esta = 'Finalizada';
		} if ($rows7->estado == 'P') { 
		$esta = 'Pendiente';
		} if ($rows7->estado == 'F') { 
		$esta = 'Procesada';
	}
	
	$cont3 = $cont3 + 1;
	echo "<td>";
	echo "<b>Historia:</b> " . $rows7->historia ."<br>".
	"<b>Nombre:</b> " . $rows7->nombre_paciente ."<br>".
	"<p><b>No. Devolucion:</b> " . $rows7->devolucion ."<br>".
	"<p><b>No. FU:</b> " . $rows7->FA."<br>".
	"<p><b>Total:</b> " . $rows7->total ."<br>".
	"<p><b>Fecha:</b> " . $rows7->fecha_creacion ."<br>";
	
?>
<input type='button' value='Reenviar Devolucion'  class='green' onClick="window.open('numero_fiscal_dev_manual.php?devolucion=<?php echo  $rows7['devolucion'] ?>','mywindow','width=400,height=400,toolbar=yes');" />
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
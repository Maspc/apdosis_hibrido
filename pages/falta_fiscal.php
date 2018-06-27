<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/falta_fiscal.php');
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
		
		
		
		
		echo "<table border='1' style='font-size:small' align='center'> <tr>";
		
		$resulta5 = ffiscal:select1();
		foreach($resulta5 as $rows5 )
		
		{
			$cont = $cont + 1;
			echo "<td>";
			echo "<p><b>No. Id:</b> " . $rows5->factura ."<br>".
			"<p><b>Total:</b> " . $rows5->total ."<br>".
			"<p><b>Usuario:</b> " . $rows5->ordenado_por ."<br>".
			"<p><b>Caja:</b> " . $rows5->caja_id ."<br>".
			"<p><b>Fecha:</b> " . $rows5->fecha."<br>";
			
		?>
		<input type='button' value='Reenviar Factura'  class='green' onClick="window.open('numero_fiscal_stat_manual.php?factura=<?php echo  $rows5['factura'] ?>','mywindow','width=400,height=400,toolbar=yes');" />
		
		
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
		
		
		$resulta7 =ffiscal::select2();
		
		
		echo "<table border='1' style='font-size:small' align='center'> <tr>";
		foreach($resulta7 as $rows7 )
		
		{
			if ($rows7->estado == 'E') {
				$esta = 'Finalizada';
				} if ($rows7->estado == 'P') { 
				$esta = 'Pendiente';
				} if ($rows7->estado == 'I') { 
				$esta = 'Finalizada';
			}
			
			$cont3 = $cont3 + 1;
			echo "<td>";
			echo "<p><b>No. Devolucion:</b> " . $rows7->devolucion ."<br>".
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
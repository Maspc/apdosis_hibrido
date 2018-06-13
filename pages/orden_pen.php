<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/orden_pen.php');
	$cont = 0;
	require_once('../modulos/layout.php');
	layout::encabezado();
?>

<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:1500px;dialogHeight:600px");
			} else {
			alert(url);
			window.open(url,'name','height=600,width=1500,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} 
</script>
<?php
	layout::menu();
	layout::ini_content();
?>

<center>   <h1>Traslados Externos Pendientes</h1> </center>
<div class="content_box_inner" style="font-size:smaller">
	
	<?php  
		$prow = open::usuarios($_SESSION['MM_iduser']);
		foreach($prow as $prw){
			$username = $prw->nombre;
		}
		
		$hirow = open::bodegas_e();
		foreach($hirow as $hw){
			$ip = $hw->ip;
		}
		
		//echo "ip ".$ip;
		
		$valido = 0;
		
		//conecto a la base externa
		$bd1 = 'infarsa';						
		echo "<table class='dtable' border='1' style='font-size:small' align='center'> <tr>";
		
		
		$rows5 = open::select1('infarsa',$bd1);
		foreach($rows5 as $rw5){
			
			$snum = count(open::select2($rw5->id_compra,$bd1));
			
			if($snum > 0) {
				
				$cont = $cont + 1;
				echo "<td>";
				echo "<b>Id:</b> " . $rw5->id_compra ."<br>".
				"<p><b>Fecha:</b> " . $rw5->fecha_compra ."<br>".
				"<p><b>Usuario:</b> " . $rw5->usuario_creacion ."<br>";
				$url = "procesar_orden_compra_ext.php?id_compra=". $rw5->id_compra;
				//echo "<p><a href='".$url."' onclick=\"modalWin('".$url."'); return false;\">Procesar Cargo</a>";
				echo "<p><input type='button' value='Procesar' onclick=\"modalWin('".$url."'); return false;\" class='blue' />";
				//echo "<a href='".$url."' onclick='$(this).modal({width:833, height:453}).open(); return false;'>Procesar</a>";
				echo "<p>";
				//echo "<hr>";
				echo "</td>";
				
				//echo "ccont 1 " .$cont;
				if ($cont % 10 == 0 ) {
					echo "</tr><tr>";
				}
			}
		}
		
		
		echo "</tr></table>";							
		
		echo " <center>   <h1>Traslados Internos Pendientes</h1> </center>";
		
		echo "<table class='dtable' border='1' style='font-size:small' align='center'> <tr>";
		
		$rows5 = open::select3();
		foreach($rows5 as $rw5){
			$cont1 = $cont1 + 1;
			echo "<td>";
			echo "<b>Id:</b> " . $rw5->id_compra ."<br>".
			"<p><b>Fecha:</b> " . $rw5->fecha_compra ."<br>".
			"<p><b>Usuario:</b> " . $rw5->usuario_creacion ."<br>";
			$url = "visualizar_orden_compra_ext.php?id_compra=". $rw5->id_compra;
			//echo "<p><a href='".$url."' onclick=\"modalWin('".$url."'); return false;\">Procesar Cargo</a>";
			echo "<p><input type='button' value='Visualizar' onclick=\"modalWin('".$url."'); return false;\" class='green' />";
			//echo "<a href='".$url."' onclick='$(this).modal({width:833, height:453}).open(); return false;'>Procesar</a>";
			echo "<p>";
			//echo "<hr>";
			echo "</td>";
			
			//echo "ccont 1 " .$cont;
			if ($cont1 % 10 == 0 ) {
				echo "</tr><tr>";
			}
		}							
		
		echo "</tr></table>";
		
		echo " <center>   <h1>Traslados Internos Procesados</h1> </center>";
		
		echo "<table class='dtable' border='1' style='font-size:small' align='center'> <tr>";
		
		$rows5 = open::select4();
		foreach($rows5 as $rw5){								
			$cont1 = $cont1 + 1;
			echo "<td>";
			echo "<b>Id:</b> " . $rw5->id_compra ."<br>".
			"<p><b>Fecha:</b> " . $rw5->fecha_compra ."<br>".
			"<p><b>Usuario:</b> " . $rw5->usuario_creacion ."<br>";
			$url = "revisar_orden_compra_ext.php?id_compra=". $rw5->id_compra;
			//echo "<p><a href='".$url."' onclick=\"modalWin('".$url."'); return false;\">Procesar Cargo</a>";
			echo "<p><input type='button' value='Aceptar' onclick=\"modalWin('".$url."'); return false;\" class='yellow' />";
			//echo "<a href='".$url."' onclick='$(this).modal({width:833, height:453}).open(); return false;'>Procesar</a>";
			echo "<p>";
			//echo "<hr>";
			echo "</td>";
			
			//echo "ccont 1 " .$cont;
			if ($cont1 % 10 == 0 ) {
				echo "</tr><tr>";
			}
			
		}							
		
		echo "</tr></table>";
		
	?>
	
</div>
<?=layout::fin_content()?>
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/cargos_pen.php');
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
	.yellow {
	background-color: #FFFF00;
	color: black;
	}
	.purple {
	background-color: #BF5FFF;
	color: white;
	}
	.orange {
	background-color: #FFA500;
	color: black;
	}
	
	.red, .white, .blue, .green, .yellow, .purple, .orange {
	margin: 0.5em;
	padding: 5px;
	font-weight: bold;
	
	}
	
</style>
<?php
	layout::menu();
	layout::ini_content();
?>
<center>   <h1>Cargos Pendientes</h1> </center>
<div class="content_box_inner" style="font-size:smaller">
    
	<?php  
		
		
		$pres = cargosp::select1($_SESSION['MM_iduser']);
		
		foreach($pres as $prow){
			$username = $prow->nombre;
		}
		
		$fres = cargosp::select2();
		
		foreach($fres as $frow){
			$codigo_carro_p = $frow->codigo_carro;
			
		}
		
		
		$xres = cargosp::select3($codigo_carro_p);
		
		echo "<div align='right'><h3>Usuario: ".$username."</h3></div>";  
		
		$feres = cargosp::select4();
		$fenum = count($feres);		
		
		if ($fenum < 1 ) {
			echo "<h2><font color='red'>Hay un problema con el inicio de naves, por favor comuníqueselo al administrador del sistema!!</font></h2>" ;
		}
		
		echo "<table border='1' style='font-size:small' align='center'> <tr>";
		
		$resulta5 = cargosp::select5();
		
		foreach($resulta5 as $rows5){			
			
			$cont = $cont + 1;
			echo "<td "; 
			if ($rows5->cargo_impreso == 'S') { echo "bgcolor='#999999'"; } 
			echo " >";
			echo "<b>Id:</b> " . $rows5->factura ."<br>".
			"<p><b>Orden:</b> " . $rows5->cargo ."<br>".
			"<p><b>Despacho:</b> " . $rows5->despacho ."<br>".
			"<p><b>Cargo:</b> <font color='red'>" . $rows5->est ."</font><br>".
			"<p><b>Tiempo Trans.:</b> <font color='red'>".$rows5->minutos." min.</font><br>".
			"<p><b>Cama:</b> " . $rows5->no_cama ;
			$url = "enviar_fact_urg.php?factura=". $rows5->factura;
			//echo "<p><a href='".$url."' onclick=\"modalWin('".$url."'); return false;\">Procesar Cargo</a>";
			echo "<p><input type='button' value='Procesar' onclick=\"modalWin('".$url."'); return false;\" class='red' />";
			//echo "<a href='".$url."' onclick='$(this).modal({width:833, height:453}).open(); return false;'>Procesar</a>";
			echo "<p>";
			//echo "<hr>";
			echo "</td>";
			
			//echo "ccont 1 " .$cont;
			if ($cont % 10 == 0 ) {
				echo "</tr><tr>";
			}
			
		}	
		
		$resulta5 = cargosp::select6();
		foreach($resulta5 as $rows5){
			$cont = $cont + 1;
			echo "<td "; 
			if ($rows5->cargo_impreso == 'S') { echo "bgcolor='#999999'"; } 
			echo " >";
			echo "<b>Id:</b> " . $rows5->factura ."<br>".
			"<p><b>Orden:</b> " . $rows5->cargo ."<br>".
			"<p><b>Despacho:</b> " . $rows5->despacho ."<br>".
			"<p><b>Cargo:</b> <font color='red'>" . $rows5->est ."</font><br>".
			"<p><b>Cama:</b> " . $rows5->no_cama ;
			$url = "enviar_fact_urg.php?factura=". $rows5->factura;
			//echo "<p><a href='".$url."' onclick=\"modalWin('".$url."'); return false;\">Procesar Cargo</a>";
			echo "<p><input type='button' value='Procesar' onclick=\"modalWin('".$url."'); return false;\" class='orange' />";
			//echo "<a href='".$url."' onclick='$(this).modal({width:833, height:453}).open(); return false;'>Procesar</a>";
			echo "<p>";
			//echo "<hr>";
			echo "</td>";
			
			//echo "ccont 1 " .$cont;
			if ($cont % 10 == 0 ) {
				echo "</tr><tr>";
			}
			
		}
		
		$m = 0;
		
		foreach($xres as $xrow){
			$factura = $xrow->factura;
			
			$resulta2 = cargosp::select7($factura);
			
			foreach($resulta2 as $rows){
				if ($rows->est == 'RECURRENTE'){
				$url = 'enviar_fact.php?tipo=R';}
				else if ($rows->est == 'NUEVO'){
				$url = 'enviar_fact.php?tipo=N';}
				$cont = $cont + 1;
				echo "<td "; 
				if ($rows->cargo_impreso == 'S') { echo "bgcolor='#999999'"; } 
				echo " >";
				echo "<b>Id:</b> " . $rows->factura ."<br>".
				"<p><b>Orden:</b> " . $rows->cargo ."<br>".
				"<p><b>Despacho:</b> " . $rows->despacho ."<br>".
				"<p><b>Cargo:</b> <font color='red'>" . $rows->est ."</font><br>".
				"<p><b>Cama:</b> " . $rows->no_cama ;
				$url .= $url."&factura=". $rows->factura;
				//echo "<p><a href='$url&factura=". $rows->factura ."'>Procesar Cargo</a>";
				echo "<p><input type='button' value='Procesar' onclick=\"modalWin('".$url."'); return false;\" class='blue' />";
				// echo "<p><input type='button' value='Procesar' onclick='modalWin(".$url."); return false;' />";
				//echo "<p>";
				//echo "<hr>";
				echo "</td>";
				
				//echo "ccont 2 " .$cont;
				if ($cont % 10 == 0 ) {
					echo "</tr><tr>";
				}
				
			}
			
			
			
			//}
			
			//if ($m == 0) {
			
			
			$resulta3 = cargosp::select8($factura);
			$url = 'enviar_fact.php?tipo=N';
			
			foreach($resulta3 as $rows1){
				$cont = $cont + 1;
				echo "<td "; 
				if ($rows1->cargo_impreso == 'S') { echo "bgcolor='#999999'"; } 
				echo " >";
				echo "<b>Id:</b> " . $rows1->factura ."<br>".
				"<p><b>Orden:</b> " . $rows1->cargo ."<br>".
				"<p><b>Despacho:</b> " . $rows1->despacho ."<br>".
				"<p><b>Cargo:</b> <font color='red'>" . $rows1->est ."</font><br>".
				"<p><b>Cama:</b> " . $rows1->no_cama ;
				$url .= "&factura=". $rows1->factura;
				//echo "<p><a href='$url&factura=". $rows->factura ."'>Procesar Cargo</a>";
				echo "<p><input type='button' value='Procesar' onclick=\"modalWin('".$url."'); return false;\" class='green' />";
				//echo "<p><input type='button' value='Procesar' onclick='modalWin(".$url."); return false;' />";
				//echo "<p>";
				//echo "<hr>";
				echo "</td>";
				//echo "ccont 3 " .$cont;
				if ($cont % 10 == 0 ) {
					echo "</tr><tr>";
				}
				
				
			}
			
		}
		
		
		$resulta5 = cargosp::select9();
		
		foreach($resulta5 as $rows5){
			$cont = $cont + 1;
			echo "<td "; 
			if ($rows5->cargo_impreso == 'S') { echo "bgcolor='#999999'"; } 
			echo " >";
			echo "<b>Id:</b> " . $rows5->factura ."<br>".
			"<p><b>Orden:</b> " . $rows5->cargo ."<br>".
			"<p><b>Despacho:</b> " . $rows5->despacho ."<br>".
			"<p><b>Cargo:</b> <font color='red'>" . $rows5->est ."</font><br>".
			"<p><b>Cama:</b> " . $rows5->no_cama ;
			$url = "enviar_fact_urg.php?factura=". $rows5->factura;
			//echo "<p><a href='".$url."' onclick=\"modalWin('".$url."'); return false;\">Procesar Cargo</a>";
			echo "<p><input type='button' value='Procesar' onclick=\"modalWin('".$url."'); return false;\" class='yellow' />";
			//echo "<a href='".$url."' onclick='$(this).modal({width:833, height:453}).open(); return false;'>Procesar</a>";
			echo "<p>";
			//echo "<hr>";
			echo "</td>";
			
			//echo "ccont 1 " .$cont;
			if ($cont % 10 == 0 ) {
				echo "</tr><tr>";
			}
			
		}		
		
		$resulta7 = cargosp::select10();
		
		foreach($resulta7 as $rows7){
			$cont = $cont + 1;
			echo "<td "; 
			if ($rows7->cargo_impreso == 'S') { echo "bgcolor='#999999'"; } 
			echo " >";
			echo "<b>Id Devolucion:</b> " . $rows7->devolucion ."<br>".
			"<p><b>Id Cargo:</b> " . $rows7->factura ."<br>".
			"<p><b>Tipo de Dev:</b> <font color='red'>" . $rows7->tipo ."</font><br>".
			"<p><b>Cama:</b> " . $rows7->no_cama ;
			$url = "acept_dev.php?devolucion=".$rows7->devolucion;
			//echo "<p><a href='".$url."' onclick=\"modalWin('".$url."'); return false;\">Procesar Cargo</a>";
			echo "<p><input type='button' value='Procesar' onclick=\"modalWin('".$url."'); return false;\" class='purple' />";
			//echo "<a href='".$url."' onclick='$(this).modal({width:833, height:453}).open(); return false;'>Procesar</a>";
			echo "<p>";
			//echo "<hr>";
			echo "</td>";
			
			//echo "ccont 1 " .$cont;
			if ($cont % 10 == 0 ) {
				echo "</tr><tr>";
			}
			
		}
		
		echo "</tr></table>";
		
	?>
	
</div>
<?=layout::fin_content()?>	
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
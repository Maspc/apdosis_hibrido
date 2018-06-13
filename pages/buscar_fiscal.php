<?php
	
	$rows5 = reportez::select5();
	foreach($rows5 as $rw5){
		$factura = $rw5->factura;
		
		$korow = reportez::select6($factura);
		foreach($korow as $kw){
			$caja_id = $kw->caja_id;
			$carpeta = addslashes($kw->ruta_salida);
		}
		
		$archivo =  "factic".str_pad($factura, 7, 0, STR_PAD_LEFT).".txt";
		//$carro = $_GET['carro'];
		$g = '';
		$h = '';
		
		$myFile = $carpeta."//".$archivo;
		
		//echo "Archivo: ".$myFile;
		
		
		if (file_exists($myFile)) {
			$fh = file($myFile);
		} 
		
		
		
		foreach($fh as $str)
		
		{
			
			list($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k)=explode("\t",$str);
			
			
			
			//echo "<li>".$g; //impresora
			//	echo "<li>".$h; //numero fiscal
			
			
			
			
			// echo "<hr>";
			
		}
		if ($g != '' || $h != '') {
			$g = substr(substr($g,0,-1),1);
			$h = substr(substr($h,0,-1),1);
		}
		//	echo $g;
		//	echo $h;
		
		if ($g == '' && $h == '') {
			//echo 	"<form action='numero_fiscal_s_stat.php?archivo=$archivo&FA=$FA' method='post'><label>Introduzca el n&uacutemero de factura fiscal manualmente: <input type='text' name='numero' /></label> <p> <input type='submit' name='Enviar' value='Enviar' class='red'/></form><p>";
			//echo "Error en obtener numero de factura fiscal";	
			
			} else { 
			
			if ($g == '') {
				
				$berow = reportez::select7($caja_id);
				foreach($berow as $bw){
					$g = $bw->nombre_impresora;
				}				
			}
			
			reportez::update1($h,$g,$archivo,$factura);
			/*$s = "update factura set estado_factura = 'I' where factura = '$factura'";
				
				$res = mysql_query($s, $conn) or die(mysql_query());
			*/
			//echo "Se obtuvo el n&uacute;mero fiscal correctamente";
			/*
				$w = "select FA from factura where factura = '$factura'";
				
				$wres = mysql_query($w,$conn) or die(mysql_error());
				
				while($wrow = mysql_fetch_array($wres)){
				$FA = $wres['FA'];
			}*/
			
			// includes nusoap class
			
			
			
		}
		
	}
	
	$rows7 = reportez::select8();
	foreach($rows7 as $rw7){
		$devolucion = $rw7->devolucion;	
		
		$korow = reportez::select9($devolucion);
		foreach($korow as $kw1){
			$caja_id = $kw1->caja_id;
			$carpeta = addslashes($kw1->ruta_salida);
		}
		
		$archivo =  "nctic".str_pad($devolucion, 7, 0, STR_PAD_LEFT).".txt";
		//$carro = $_GET['carro'];
		$g = '';
		$h = '';
		
		$myFile = $carpeta."//".$archivo;
		
		
		
		//$myFile = $carpeta."\\".$archivo;
		
		if (file_exists($myFile)) {
			$fh = file($myFile);
		} 
		//$fh = file($myFile);
		
		
		//$r = "update devolucion set estado = 'E' where devolucion = '$devolucion'";
		
		//$re = mysql_query($r, $conn) or die(mysql_error());
		
		foreach($fh as $str)
		
		{
			
			list($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k)=explode("\t",$str);
			
			
			//echo "<li>".$g; //impresora
			//echo "<li>".$h; //numero fiscal
		
		}
		
		
		$g = substr(substr($g,0,-1),1);
		$h = substr(substr($h,0,-1),1);
		
		//echo $g;
		//echo $h;
		
		if ($g == '' && $h == '') {
			//echo 	"<form action='numero_fiscal_s_dev.php?archivo=$archivo&FA=$FA' method='post'><label>Introduzca el n&uacutemero de factura fiscal manualmente: <input type='text' name='numero' /></label> <p> <input type='submit' name='Enviar' value='Enviar' /></form><p>";
			
			//$s = "update devolucion set estado = 'E' where devolucion = '" .$devolucion . "'";
			
			///$res = mysql_query($s, $conn) or die(mysql_query());
			
			} else { 
			
			if ($g == '') {
				$berow = reportez::select7($caja_id);
				foreach($berow as $bw1){
					$g = $bw1->nombre_impresora;
				}
			}
			
			reportez::update2($h,$g,$archivo,$devolucion);
			
		}
	}
?>


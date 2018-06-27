<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/buscar_fiscal.php');
	//$factura = $_GET['factura'];
	
	$resulta5 = buscarf::select1();
	foreach($resulta5 as $rows5){
		
		$factura = $rows5->factura;
		
		
		$kores = buscarf::select2($factura);
		
	    foreach($kores as $korow){
			$caja_id = $korow->caja_id;
			$carpeta = addslashes($korow->ruta_salida);
			
		}
		
		
		
		
		
		
		$archivo =  "factic".str_pad($factura, 7, 0, STR_PAD_LEFT).".txt";
		//$carro = $_GET->carro;
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
				
				$beres = buscarf::select3($caja_id);
				foreach($beres as $berow){
					$g = $berow->nombre_impresora;	   
				}	   
				
			}
			
			buscarf::update1($h,$g,$archivo,$factura);
			
			/*$s = "update factura set estado_factura = 'I' where factura = '$factura'";
				
				$res = mysql_query($s, $conn) or die(mysql_query());
			*/
			//echo "Se obtuvo el n&uacute;mero fiscal correctamente";
			/*
				$w = "select FA from factura where factura = '$factura'";
				
				$wres = mysql_query($w,$conn) or die(mysql_error());
				
				while($wrow = mysql_fetch_array($wres)){
				$FA = $wres->FA;
			}*/
			
			// includes nusoap class
			
			
			
		}
	}
	
	
	$resulta7 = buscarf::select4();
	
	foreach($resulta7 as $rows7){
		$devolucion = $rows7->devolucion;
		
		$kores = buscarf::select5($devolucion);
		
		foreach($kores as $korow){
			$caja_id = $korow->caja_id;
			$carpeta = addslashes($korow->ruta_salida);			
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
				
				$beres = buscarf::select6($caja_id);
				
				foreach($beres as $berow){
					$g = $berow->nombre_impresora;	   
				}	     
				
			}
			
			buscarf::update2($h,$g,$archivo,$devolucion);
			
			
			
		}
		
		
		
	} 
	
	
?>
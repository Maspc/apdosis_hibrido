<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/numero_fiscal_dev_manual.php');	
	
	
	//$archivo = $_GET['archivo'];
	//$carpeta = $_GET['carpeta'];
	//$g = '';
	//$h = '';
	$devolucion = $_GET['devolucion'];
	
	$korow = nmanual::select1($devolucion);
	foreach($korow as $kw){
		$caja_id = $kw->caja_id;
		$carpeta = addslashes($kw->ruta_salida);	
	}
	
	$archivo =  "nctic".str_pad($devolucion, 7, 0, STR_PAD_LEFT).".txt";
	//$carro = $_GET['carro'];
	$g = '';
	$h = '';
	
	$myFile = $carpeta."//".$archivo;
	
	echo "Archivo: ".$myFile;
	
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
		echo 	"<p><h2>La devolucion no se pudo leer del archivo fiscal</h2><p>";
		//$s = "update devolucion set estado = 'E' where devolucion = '" .$devolucion . "'";
		
		///$res = mysql_query($s, $conn) or die(mysql_query());
		
		} else { 
		
		if ($g == '') {
			
			$berow = nmanual::select2($caja_id);
			foreach($berow as $bw){
				$g = $bw->nombre_impresora;
			}
			
		}	
		
		nmanual::update1($h,$g,$archivo,$devolucion);
		
	    $wrow = nmanual::select3($devolucion);
		foreach($wrow as $ww){
			$FA = $ww->FA;
		}
		
		echo "<b>Se obtuvo correctamente el n&uacute;mero fiscal</b>";
		
		
	}
	
	echo "<hr>";
	
	// includes nusoap class
	
	
	
	//echo "<a href='ver_devoluciones.php'>Regresar a Devoluciones</a>";
	
	
?>
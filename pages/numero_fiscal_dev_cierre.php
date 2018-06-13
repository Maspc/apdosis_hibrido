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
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/devolucion_pub.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	$archivo = $_GET['archivo'];
	$carpeta = $_GET['carpeta'];
	$g = '';
	$h = '';
	$devolucion = $_GET['devolucion'];
	
	$myFile = $carpeta."//".$archivo;
	
	if (file_exists($myFile)) {
		$fh = file($myFile);
		} else {
		//$fh = file($myFile2);
		echo "<h1>Refresque la pantalla con el bot&oacute;n F5, procure no apretar el bot&oacute;n de 'Obtener Fiscal' hasta que no haya terminado la impresi&oacute;n de la factura</h1>";
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
			
			$berow = dvolucpub::select23($carpeta);
			foreach($berow as $brw){
				$g = $brw->nombre;	   
			}
			
		}
			
		dvolucpub::update5($h,$g,$archivo,$devolucion);
				
		$wrow = dvolucpub::select24($devolucion);
		foreach($wrow as $wrw){
			$FA = $wrw->FA;
		}
		
		echo "<b>Se obtuvo correctamente el n&uacute;mero fiscal</b>";
		
		
	}
	
	echo "<hr>";
	// includes nusoap class
	
	
	
	//echo "<a href='ver_devoluciones.php'>Regresar a Devoluciones</a>";
	
	
?>
<p>
<input type="button" class="white" value="Regresar" onclick="parent.location='facturacion.php'">
<?=layout::fin_content()?>
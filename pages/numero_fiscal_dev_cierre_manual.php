<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/numero_fiscal_dev_cierre_manual.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
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
	
	$archivo = $_GET['archivo'];
	$carpeta = $_GET['carpeta'];
	$g = '';
	$h = '';
	$devolucion = $_GET['devolucion'];
	
	$myFile = "/opt/factura/".$carpeta."//".$archivo;
	
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
			
			$beres = nfdcm::select4($carpeta);
			
			foreach($beres as $berow)
			
			{
				$g = $berow->nombre;	   
			}	   
			
		}
		
		
		$rup = nfdcm::update2($h,$g,$archivo,$devolucion); 
		
		
		
		$wres =nfdcm::select5($devolucion); 
		
		foreach($wres  as $wrow)
		{
			$FA = $wres->FA;
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
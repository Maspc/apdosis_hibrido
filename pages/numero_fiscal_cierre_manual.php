<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/numero_fiscal_cierre_manual.php');
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
	if (isset($_GET['archivo2'])){
		$archivo2 = $_GET['archivo2'];
		}else{
		$archivo2 = ' ';
	}
	$factura = $_GET['factura'];
	$carpeta = $_GET['carpeta'];
	//$carro = $_GET['carro'];
	$g = '';
	$h = '';
	$myFile = "/opt/factura/".$carpeta."/".$archivo;
	$myFile2 = "/opt/factura/".$carpeta."/".$archivo2;
	if (file_exists($myFile)) {
		$fh = file($myFile);
		} else {
		$fh = file($myFile2);
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
		echo "Error en obtener numero de factura fiscal";	
		
		} else { 
		
		if ($g == '') {
			
			$beres= nfcm::select1($carpeta);
			foreach($beres as $berow )
			
			{
				$g = $berow->nombre;	   
			}	   
			
		}
		
		
		
		nfcm::update1($h,$g,$k,$archivo,$factura);
		
		
		nfcm::update2($factura);
		
		
		echo "Se imprimio y se facturo el cargo.";
		
		
		$wres=nfcm::select2($factura);
		foreach($wres as $wrow )
		
		{
			$FA = $wres->FA;
		}
		
		// includes nusoap class
		
		
		
	}
	
	// echo "<a href='proceso_cierre_stat.php'>Regresar a Imprimir Facturas</a>";
	
	
?>
<p>
	<input type="button" class="white" value="Cerrar" onclick="self.close()">
</body></html>
<?=layout::fin_content()?>
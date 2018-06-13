<html>
	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<title>Apdosis</title>
		
		<!-- Start css3menu.com HEAD section -->
		<link rel="stylesheet" href="../default.htm_files/css3menu1/style.css" type="text/css" />
		<!-- End css3menu.com HEAD section -->
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
		
	</head>
	<body>
		<?php
			include('./clases/session.php');
			require_once('../modulos/falta_fiscal.php');
			$factura = $_GET['factura'];
			
			$korow = ffiscal::nfiscal_slt1($factura);
			
			foreach($korow as $kw){
				$caja_id = $kw->caja_id;
				$carpeta = addslashes($kw->ruta_salida);
			}	
			
			$archivo =  "factic".str_pad($factura, 7, 0, STR_PAD_LEFT).".txt";
			//$carro = $_GET['carro'];
			$g = '';
			$h = '';
			
			$myFile = $carpeta."//".$archivo;
			
			echo "Archivo: ".$myFile;
			
			
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
				echo "Error en obtener numero de factura fiscal";	
				
				} else { 
				
				if ($g == '') {
					
					$berow = ffiscal::nfiscal_slt2($caja_id);
					foreach($berow as $bw){
						$g = $bw->nombre_impresora;
						}
				}
				
				ffiscal::nfiscal_up1($h,$g,$archivo,$factura);
				/*$s = "update factura set estado_factura = 'I' where factura = '$factura'";
					
					$res = mysql_query($s, $conn) or die(mysql_query());
				*/
				echo "Se obtuvo el n&uacute;mero fiscal correctamente";
				/*
					$w = "select FA from factura where factura = '$factura'";
					
					$wres = mysql_query($w,$conn) or die(mysql_error());
					
					while($wrow = mysql_fetch_array($wres)){
					$FA = $wres['FA'];
				}*/
				
				// includes nusoap class				
				
			}
			
		?>
	</body></html>							
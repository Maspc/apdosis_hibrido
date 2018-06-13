<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/compras_xero.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
?>
<center><h1>Reporte de Compras Diarias - Xero</h1></center><p>&nbsp;</p><p>&nbsp;</p>
<center>
	<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">Introduzca la fecha que desea buscar</font></p>
	<form  action="<?=$_SERVER['PHP_SELF']?>"  method="post" name="venta">
		Fecha Inicial: <input size="30" id="f_date1" name="fecha1"/><button bsmall id="f_btn1" type="button" >...</button><br />
		<p>
			Fecha Final: <input size="30" id="f_date2" name="fecha2"/><button bsmall id="f_btn2" type="button" >...</button><br />
			
			<script type="text/javascript">//<![CDATA[
				var cal1 = Calendar.setup({
					inputField : "f_date1",
					trigger    : "f_btn1",
					onSelect   : function() { this.hide() },
					dateFormat : "%Y-%m-%d"
				});
				
				var cal2 = Calendar.setup({
					inputField : "f_date2",
					trigger    : "f_btn2",
					onSelect   : function() { this.hide() },
					dateFormat : "%Y-%m-%d"
				});
			//]]></script>
			
			<p>&nbsp;</p>
			<input type="submit" name="reporte" value="Llamar Reporte" class = "blue" >
		</p></form></center>
		<p>
			
			<?php
				if(isset($_POST['reporte'])){
					$fecha1 = $_POST['fecha1'];
					$fecha2 = $_POST['fecha2'];
					
					//(c.impuesto_total/c.cantidad_entregada)
					
					$row1 = comprasx::select1($fecha1,$fecha2);
					
					$fecha = date($fecha1);
					$random = rand();
					
					$nombre_archivo = "compras_".$fecha."_".$random;
					
					
					$fp2 = fopen("C:\\fiscal\\".$nombre_archivo.".csv","a+");
					
					fwrite($fp2," \"ContactName\",	\"EmailAddress\",	\"POAddressLine1\",	\"POAddressLine2\",	\"POAddressLine3\",	\"POAddressLine4\",	\"POCity\",	\"PORegion\",	\"POPostalCode\",	\"POCountry\",	\"InvoiceNumber\",	\"InvoiceDate\",	\"DueDate\",	\"InventoryItemCode\", \"Description\",	\"Quantity\", \"UnitAmount\",		\"AccountCode\",	\"TaxType\",	\"TaxAmount\",	\"TrackingName1\",	\"TrackingOption1\", \"TrackingName2\",	\"TrackingOption2\",	\"Currency\"	 ".PHP_EOL);
					//fwrite($fp2," \"ContactName\",	\"EmailAddress\",	\"POAddressLine1\",	\"POAddressLine2\",	\"POAddressLine3\",	\"POAddressLine4\",	\"POCity\",	\"PORegion\",	\"POPostalCode\",	\"POCountry\",	\"InvoiceNumber\",	\"InvoiceDate\",	\"DueDate\",	\"Total\",	\"InventoryItemCode\", \"Description\",	\"Quantity\", \"UnitAmount\",		\"AccountCode\",	\"TaxType\",	\"TaxAmount\",	\"TrackingName1\",	\"TrackingOption1\", \"TrackingName2\",	\"TrackingOption2\",	\"Currency\"	 ".PHP_EOL);
					
					foreach($row1 as $rw1){
						$ContactName	=	$rw1->ContactName;
						$EmailAddress	=	$rw1->EmailAddress;
						$POAddressLine1	=	$rw1->POAddressLine1;
						$POAddressLine2	=	$rw1->POAddressLine2;
						$POAddressLine3	=	$rw1->POAddressLine3;
						$POAddressLine4	=	$rw1->POAddressLine4;
						$POCity	=	$rw1->POCity;
						$PORegion	=	$rw1->PORegion;
						$POPostalCode	=	$rw1->POPostalCode;
						$POCountry	=	$rw1->POCountry;
						$InvoiceNumber	=	$rw1->InvoiceNumber;
						$InvoiceDate	=	$rw1->InvoiceDate;
						$DueDate	=	$rw1->DueDate;
						$Total	=	$rw1->Total;
						$InventoryItemCode	=	$rw1->InventoryItemCode;
						$Description	=	$rw1->Description;
						$Quantity	=	$rw1->Quantity;
						$UnitAmount	=	$rw1->UnitAmount;
						$AccountCode	=	$rw1->AccountCode;
						$TaxType	=	$rw1->TaxType;
						$TaxAmount	=	$rw1->TaxAmount;
						$TrackingName1	=	$rw1->TrackingName1;
						$TrackingOption1	=	$rw1->TrackingOption1;
						$TrackingName2	=	$rw1->TrackingName2;
						$TrackingOption2	=	$rw1->TrackingOption2;
						$Currency	=	$rw1->Currency;										
						
						fwrite($fp2," \"$ContactName\",	\"$EmailAddress\",	\"$POAddressLine1\",	\"$POAddressLine2\",	\"$POAddressLine3\",	\"$POAddressLine4\",	\"$POCity\",	\"$PORegion\",	\"$POPostalCode\",	\"$POCountry\",	\"$InvoiceNumber\",	\"$InvoiceDate\",	\"$DueDate\",	\"$InventoryItemCode\", \"$Description\",	\"$Quantity\", \"$UnitAmount\",	\"$AccountCode\",	\"$TaxType\",	\"$TaxAmount\",	\"$TrackingName1\",	\"$TrackingOption1\", \"$TrackingName2\",	\"$TrackingOption2\",	\"$Currency\"	 ".PHP_EOL);
						//fwrite($fp2," \"$ContactName\",	\"$EmailAddress\",	\"$POAddressLine1\",	\"$POAddressLine2\",	\"$POAddressLine3\",	\"$POAddressLine4\",	\"$POCity\",	\"$PORegion\",	\"$POPostalCode\",	\"$POCountry\",	\"$InvoiceNumber\",	\"$InvoiceDate\",	\"$DueDate\",	\"$Total\",	\"$InventoryItemCode\", \"$Description\",	\"$Quantity\", \"$UnitAmount\",	\"$AccountCode\",	\"$TaxType\",	\"$TaxAmount\",	\"$TrackingName1\",	\"$TrackingOption1\", \"$TrackingName2\",	\"$TrackingOption2\",	\"$Currency\"	 ".PHP_EOL);
						
					}
					fclose($fp2);
					
					echo "<p><b>Archivo generado exitosamente en la ruta C:\\fiscal\\</b>";
					
				}
				
				layout::fin_content();
			?>					
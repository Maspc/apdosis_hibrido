<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/ventas_xero.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
?>

<center><h1>Reporte de Ventas Diarias - Xero</h1></center><p>&nbsp;</p><p>&nbsp;</p>
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
					// dateFormat : "%Y-%m-%d %H:%M:%S"
					dateFormat : "%Y-%m-%d"
				});
				
				var cal2 = Calendar.setup({
					inputField : "f_date2",
					trigger    : "f_btn2",
					onSelect   : function() { this.hide() },
					//dateFormat : "%Y-%m-%d %H:%M:%S"
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
					
					$row1 = ventasx::select1($fecha1,$fecha2);
					$fecha = date($fecha1);
					$random = rand();
					
					$nombre_archivo = "ventas_".$fecha."_".$random;
					
					$fp2 = fopen("C:\\fiscal\\".$nombre_archivo.".csv","a+");
					
					//fwrite($fp2," \"ContactName\",	\"EmailAddress\",	\"POAddressLine1\",	\"POAddressLine2\",	\"POAddressLine3\",	\"POAddressLine4\",	\"POCity\",	\"PORegion\",	\"POPostalCode\",	\"POCountry\",	\"InvoiceNumber\",	\"Reference\",	\"InvoiceDate\",	\"DueDate\",	\"Total\",	\"InventoryItemCode\", \"Description\",	\"Quantity\", \"UnitAmount\",	\"Discount\",	\"AccountCode\",	\"TaxType\",	\"TaxAmount\",	\"TrackingName1\",	\"TrackingOption1\", \"TrackingName2\",	\"TrackingOption2\",	\"Currency\"	,\"BrandingTheme\" ".PHP_EOL);
					fwrite($fp2," \"ContactName\",	\"EmailAddress\",	\"POAddressLine1\",	\"POAddressLine2\",	\"POAddressLine3\",	\"POAddressLine4\",	\"POCity\",	\"PORegion\",	\"POPostalCode\",	\"POCountry\",	\"InvoiceNumber\",	\"Reference\",	\"InvoiceDate\",	\"DueDate\",	\"InventoryItemCode\", \"Description\",	\"Quantity\", \"UnitAmount\",	\"Discount\",	\"AccountCode\",	\"TaxType\",	\"TaxAmount\",	\"TrackingName1\",	\"TrackingOption1\", \"TrackingName2\",	\"TrackingOption2\",	\"Currency\"	,\"BrandingTheme\" ".PHP_EOL);
					
					foreach($row1 as $rw){
						$ContactName	=	$rw->ContactName;
						$EmailAddress	=	$rw->EmailAddress;
						$POAddressLine1	=	$rw->POAddressLine1;
						$POAddressLine2	=	$rw->POAddressLine2;
						$POAddressLine3	=	$rw->POAddressLine3;
						$POAddressLine4	=	$rw->POAddressLine4;
						$POCity	=	$rw->POCity;
						$PORegion	=	$rw->PORegion;
						$POPostalCode	=	$rw->POPostalCode;
						$POCountry	=	$rw->POCountry;
						$InvoiceNumber	=	$rw->InvoiceNumber;
						$Reference	=	$rw->Reference;
						$InvoiceDate	=	$rw->InvoiceDate;
						$DueDate	=	$rw->DueDate;
						$Total	=	$rw->Total;
						$InventoryItemCode	=	$rw->InventoryItemCode;
						$Description	=	$rw->Description;
						$Quantity	=	$rw->Quantity;
						$UnitAmount	=	$rw->UnitAmount;
						$Discount	=	$rw->Discount;
						$AccountCode	=	$rw->AccountCode;
						$TaxType	=	$rw->TaxType;
						$TaxAmount	=	$rw->TaxAmount;
						$TrackingName1	=	$rw->TrackingName1;
						$TrackingOption1	=	$rw->TrackingOption1;
						$TrackingName2	=	$rw->TrackingName2;
						$TrackingOption2	=	$rw->TrackingOption2;
						$Currency	=	$rw->Currency;
						$BrandingTheme	=	$rw->BrandingTheme;
						
						//fwrite($fp2," \"$ContactName\",	\"$EmailAddress\",	\"$POAddressLine1\",	\"$POAddressLine2\",	\"$POAddressLine3\",	\"$POAddressLine4\",	\"$POCity\",	\"$PORegion\",	\"$POPostalCode\",	\"$POCountry\",	\"$InvoiceNumber\",	\"$Reference\",	\"$InvoiceDate\",	\"$DueDate\",	\"$Total\",	\"$InventoryItemCode\", \"$Description\",	\"$Quantity\", \"$UnitAmount\",	\"$Discount\",	\"$AccountCode\",	\"$TaxType\",	\"$TaxAmount\",	\"$TrackingName1\",	\"$TrackingOption1\", \"$TrackingName2\",	\"$TrackingOption2\",	\"$Currency\"	,\"$BrandingTheme\" ".PHP_EOL);
						fwrite($fp2," \"$ContactName\",	\"$EmailAddress\",	\"$POAddressLine1\",	\"$POAddressLine2\",	\"$POAddressLine3\",	\"$POAddressLine4\",	\"$POCity\",	\"$PORegion\",	\"$POPostalCode\",	\"$POCountry\",	\"$InvoiceNumber\",	\"$Reference\",	\"$InvoiceDate\",	\"$DueDate\",	\"$InventoryItemCode\", \"$Description\",	\"$Quantity\", \"$UnitAmount\",	\"$Discount\",	\"$AccountCode\",	\"$TaxType\",	\"$TaxAmount\",	\"$TrackingName1\",	\"$TrackingOption1\", \"$TrackingName2\",	\"$TrackingOption2\",	\"$Currency\"	,\"$BrandingTheme\" ".PHP_EOL);
					}
					fclose($fp2);
					
					echo "<p><b>Archivo generado exitosamente en la ruta C:\\fiscal\\</b>";
					
				}
				
				layout::fin_content();
			?>			
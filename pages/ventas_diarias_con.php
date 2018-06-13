<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/ventas_diarias_con.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
?>
<?php
	layout::menu();
	layout::ini_content();
?>
<center><h1>Reporte de Ventas Diarias</h1></center><p>&nbsp;</p><p>&nbsp;</p>
<center>
	<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">Introduzca la fecha que desea buscar</font></p>
	<form target="_blank" action="imprimir_venta_con.php" method="post" name="venta">
		Fecha Inicial: <input size="30" id="f_date1" name="fecha1"/><button bsmall id="f_btn1" type="button" >...</button><br />
		<p>
			Fecha Final: <input size="30" id="f_date2" name="fecha2"/><button bsmall id="f_btn2" type="button" >...</button><br />
			
			<script type="text/javascript">//<![CDATA[
				var cal1 = Calendar.setup({
					inputField : "f_date1",
					trigger    : "f_btn1",
					onSelect   : function() { this.hide() },
					dateFormat : "%Y-%m-%d %H:%M:%S"
				});
				
				var cal2 = Calendar.setup({
					inputField : "f_date2",
					trigger    : "f_btn2",
					onSelect   : function() { this.hide() },
					dateFormat : "%Y-%m-%d %H:%M:%S"
				});
			//]]></script>
			
			<p>&nbsp;</p>
			<input type="submit" name="reporte" value="Llamar Reporte" class = "blue" >
		</p></form></center>
		<?=layout::fin_content()?>		
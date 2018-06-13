<?php
	ob_start();
	include ('./clases/session.php');
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
	background-color: blue;
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
?>
<center><h1>Facturas por Paciente</h1></center><p>&nbsp;</p><p>&nbsp;</p>
<center>
	<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">Introduzca la fecha que desea buscar</font></p>
	<form action="enviar_list_facturas_f.php" method="post" name="facturas">
		<label> Historial del Paciente: <input name="id_paciente" id="id_paciente" size="25" /></label><p>
			Fecha Inicial: <input size="30" id="f_date1" name="desde"/><button id="f_btn1" bsmall type="button" >...</button><br />
			<p>
				Fecha Final: <input size="30" id="f_date2" name="hasta"/><button id="f_btn2" bsmall type="button" >...</button><br />
				
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
			<?=layout::fin_content()?>
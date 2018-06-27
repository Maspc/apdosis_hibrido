<?php
	ob_start();
	include ('./clases/session.php');
	//require_once('../modulos/estado_cargosatc_jub.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
?>
<form action="buscar_facturas_jub.php" method="post" name="estado" id="estado">
	
	<table width="780" border="0" cellspacing="0" >
		
		<tr>
			<td>
				<center>
					<table width="510" border="1" cellspacing="0" bordercolor="#000000" align="center">
						<!-- <tr>
							<td>Id. :</td>
							<td><input name="factura" type="text" size="20" /></td>
						</tr> -->
						<tr>
							<td>Fecha Inicio:</td>
							<td><input name="fecha_inicio" id="f_date1" type="text" size="20" /><button bsmall id="f_btn1" type="button" >...</button><br /></td>
						</tr>
						<tr>
							<td>Fecha Fin:</td>
							<td><input name="fecha_fin" id="f_date2" type="text" size="20" /><button bsmall id="f_btn2" type="button" >...</button></td>
						</tr>
						
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
						
						
						
					</table>
				</center>
				<p><p>
					
					<div align="center">
						<input name="buscar" type="submit" value="Buscar Facturas" />  
					</div></td>
				</tr>
			</table>
		</form>
		<?=layout::fin_content()?>
		<script type="text/javascript">
			function toggleDiv(divId) {
				$("#"+divId).toggle();
			}
		</script>		
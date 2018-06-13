<!DOCTYPE html>
<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/reporte_ventas.php');
	require_once('../modulos/layout.php');
	layout::encabezado();

	layout::menu();
	layout::ini_content();
?>
<center><h1>Reporte de Ventas</h1></center><p>&nbsp;</p><p>&nbsp;</p>
<center>
	<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">Introduzca la fecha que desea buscar</font></p>
	<form target="_blank" action="imprimir_ventas_xls.php" method="post" name="venta" id="venta">
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
			Proveedor: <select sformat name="proveedor">
				<?php 
					$grow = repventas::provee();
					foreach($grow as $gw){
						echo '<option value="'.$gw->id_proveedor.'">'.$gw->nombre.'</option>';
					}
				?>
			</select>
			<p>
				<p>&nbsp;</p>
				Producto: <input sformat size="100" id="medicamento" name="medicamento" type="text" required />*<input size="100" id="medicamento_id" name="medicamento_id" type="hidden"/>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				Cliente: <select sformat name="codigo_cliente">
					<?php 
						$grow = repventas::cliente();
						foreach($grow as $gw){
							echo '<option value="'.$gw->id_cliente.'">'.$gw->nombre.'</option>';
						}
					?>
				</select>
				<p>
					<p>&nbsp;</p>
					
					<input type="submit" name="reporte" value="Llamar Reporte" class = "blue" >
				</p></form></center>
	<?=layout::fin_content()?>
	<script>
	function teclas(event) {
		tecla=(document.all) ? event.keyCode : event.which;
		
		if (tecla==13) {
			
			event.keyCode = 40; event.charCode = 40; event.which = 1199; break;
			
			return false;
		}
		
		return true;
	}
</script>


<script type="text/javascript">
	$(document).ready(function() {
		
		//$("#venta").validate();
		function log(event, data, formatted) {
			$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
		}
		
		function formatItem(row) {
			return row[0] + " (<strong>id: " + row[1] + "</strong>)";
		}
		function formatResult(row) {
			return row[0].replace(/(<.+?>)/gi, '');
		}
		
		$("#medicamento").autocomplete({
			serviceUrl : 'get_medicamento_union.php',
			paramName : 'q',
			onSelect: function (data) {
			$("#medicamento_id").val(data.codigo_interno);
			}
		});
		
		$("#clear").click(function() {
			$(":input").unautocomplete();
		});
	});
</script>
<script language="javascript" type="text/javascript" src="../js/script_com_or.js"></script>
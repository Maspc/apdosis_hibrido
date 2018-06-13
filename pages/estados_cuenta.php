<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/estados_cuenta.php');
	$cont = 0;
	if (isset($_GET['no_code'])){
		$no_code = $_GET['no_code'];
		} else {
		$no_code = 0;
	}
	require_once('../modulos/layout.php');
	layout::encabezado();

	layout::menu();
	layout::ini_content();
?>

<center>    <h1>Estados de Cuenta</h1></center>
<div class="content_box_inner">
	<form action="imprimir_estado.php" method="post" name="agregar_med" id="agregar_med">
		<p></p>
		<table width="1000" border="0">
			<tr>
				<td >Cliente</td>
			<td><input type="text" name="codigo_cliente" id="codigo_cliente" size="10" /><input type="text" name="nombre_cliente" id="nombre_cliente" size="75" /></td></tr>
			
			<tr>
				<td>Nombre</td>
				<td><input type="text" name="nombre" id="nombre" size="25" readonly  /></td>
			</tr>
			<tr>
				<td>Apellido</td>
				<td><input type="text" name="apellido" id="apellido" size="25" readonly /></td>
			</tr>
			<tr>
				<td>Identificacion</td>
				<td><input type="text" name="identificacion" id="identificacion" size="25" readonly /></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
				<input type="submit" value ="Imprimir" name="submit" class="green" />
			</td>
		</tr>
	</table>
	</form>
	
	
</div>
<?=layout::fin_content()?>
<script type="text/javascript">
	$(document).ready(function() {
		
		//$("#formulario").validate();
		
		function log(event, data, formatted) {
			$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
		}
		
		function formatItem(row) {
			return row[0] + " (<strong>id: " + row[1] + "</strong>)";
		}
		function formatResult(row) {
			return row[0].replace(/(<.+?>)/gi, '');
		}
		
		
		$("#codigo_cliente").autocomplete({
			serviceUrl : 'get_personas_e.php',
			paramName : 'q',
			onSelect: function (data) {				
			$("#nombre_cliente").val(data.nombre_completo);
			$("#cedula").val(data.identificacion);
			$("#telefono").val(data.telefono);
			$("#saldo_actual").val(data.saldo_actual);
			$("#descuento_maximo").val(data.descuento_maximo);
			$("#limite_credito").val(data.limite_credito);
			$("#tipo_cliente").val(data.tipo_cliente);
			$("#nombre").val(data.nombre);
			$("#apellido").val(data.apellido);
			/*$("#alergias").val(data[2]);
				$("#peso").val(data[3]);
				$("#otros").val(data[4]);
				$("#compania_de_seguro").val(data[5]);
				$("#diabetes").val(data[6]);
				$("#hipertension").val(data[7]);
			$("#contraindicaciones").val(data[8]);*/
			}
		});
		
		$("#nombre_cliente").autocomplete({
			serviceUrl : 'get_personas_ne.php',
			paramName : 'q',
			onSelect: function (data) {				
			$("#codigo_cliente").val(data.id_cliente);
			$("#cedula").val(data.identificacion);
			$("#telefono").val(data.telefono);
			$("#saldo_actual").val(data.saldo_actual);
			$("#descuento_maximo").val(data.descuento_maximo);
			$("#limite_credito").val(data.limite_credito);
			$("#tipo_cliente").val(data.tipo_cliente);
			$("#nombre").val(data.nombre);
			$("#apellido").val(data.apellido);
			/*$("#alergias").val(data[2]);
				$("#peso").val(data[3]);
				$("#otros").val(data[4]);
				$("#compania_de_seguro").val(data[5]);
				$("#diabetes").val(data[6]);
				$("#hipertension").val(data[7]);
			$("#contraindicaciones").val(data[8]);*/
			}
		});		
		
		$("#clear").click(function() {
			$(":input").unautocomplete();
		});
		
		
	});
	
</script>

<script language="javascript">
	<!-- Begin
	function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=200');");
	}
	// End -->
	
	function revisar(){
		
		//alert("Entro");
		if(document.getElementById('saldo_actual').value < document.getElementById('monto_pagado').value){
			alert("El monto pagado no puede ser mayor al saldo actual,verifique!!");
			document.getElementById('monto_pagado').value = document.getElementById('saldo_actual').value;
		}
		
	}
	
	
</script>


<script language="javascript">
	<!-- Begin
	function enable()
	{
		// content  
		//alert("check");
		
		window.location='agregar_medicamentos_us.php?no_code=1';
		
	}
	
	function disable()
	{
		// content
		//alert("uncheck");
		window.location='agregar_medicamentos_us.php?no_code=0'
	}
	// End -->
</script>


<script language="javascript">
	function llamar_popup(){
		//alert('Entre a la funcion ' + document.getElementById('codigo_cliente').value);
		URL = "ver_facturas.php?codigo_cliente=" + document.getElementById('codigo_cliente').value;
		day = new Date();
		id = day.getTime();
		//alert('2');
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=450,height=600');");
		
	}
</script>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
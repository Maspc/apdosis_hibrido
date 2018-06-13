<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/pago_creditos.php');
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
<center>    <h1>Pago de Créditos</h1></center>
<div class="content_box_inner">
	<form action="<? $_SERVER['PHP_SELF']; ?>" method="post" name="agregar_med" id="agregar_med">
		<p></p>
		<table width="1000" border="0">
			<tr>
				<td >Cliente</td>
			<td><input type="text" name="codigo_cliente" id="codigo_cliente" size="10" /><input type="text" name="nombre_cliente" id="nombre_cliente" size="75" /></td></tr>
			
			<tr>
				<td>Saldo Actual</td>
				<td><input type="text" name="saldo_actual" id="saldo_actual" size="25" readonly /></td>
			</tr>
			<tr>
				<td>Monto a Pagar</td>
				<td><input type="text" name="monto_pagado" id="monto_pagado" size="25" onChange="revisar();" required="required"   /></td>
			</tr>
			<tr>
				<td>Visualizar Facturas</td>
				<td><input type="button" name="ver_historia" value="Ver Movimiento" id="ver_factura" onClick="llamar_popup();" /></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center"><input type="submit" name="submit" value="Realizar Recibo"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<?  
						if(isset($_POST['submit'])){
							
							
							
							if(isset($_POST['codigo_cliente'])){
								$codigo_cliente = $_POST['codigo_cliente'];
							}
							if(isset($_POST['monto_pagado'])){
								$monto_pagado = $_POST['monto_pagado'];
							}
							
							$Hora = Time(); // Hora actual
							$hora_actual =  date('Y-m-d H:i',$Hora); 
							
							pcreditos::insert1($codigo_cliente,$hora_actual,$monto_pagado,$_SESSION['MM_iduser']);
							
							$mid = pcreditos::maxid();
							$id = $mid[0]->id;
							
							pcreditos::update1($monto_pagado,$codigo_cliente);
							
							$frow = pcreditos::select1($codigo_cliente);
							
							$monto_resta = $monto_pagado;
							foreach($frow as $fw){
								//echo "<p>factura: ".$frow['factura']." monto resta: ".$monto_resta;
								$saldo_nuevo = $fw->saldo_pendiente - $monto_resta;
								
								
								$monto_resta = $monto_resta - $fw->saldo_pendiente;
								
								if($saldo_nuevo < 0){
									$saldo_nuevo = 0;
								}
								
								if($monto_resta < 0) {
									$monto_resta = 0;
								}
								
								pcreditos::update2($saldo_nuevo,$fw->factura);
							}
							
							echo "<font color='blue'><b>Se ha insertado el recibo con éxito <INPUT TYPE=\"button\" class='blue' value='Imprimir Recibo' id='imprimirp' onClick=\"window.open('imprimir_recibo_credito.php?id_recibo=$id')\" >";
							
						} ?></td>
			</tr>
		</table>
		
	</form>
	
</div>
</font>
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
		
		
		/*$("#articulo").autocomplete("get_articulo.php", {
			width: 500,
			matchContains: true,
			mustMatch: false,
			selectFirst: false
		});
		
		$("#articulo").result(function(event, data, formatted) {
			$("#id_articulo").val(data[1]);
			$("#codigo_de_barra").val(data[2]);
			$("#precio").val(data[3]);
			$("#tipo_impuesto").val(data[4]);
			$("#descuento_producto_max").val(data[5]);
		});
		
		
		$("#codigo_de_barra").autocomplete("get_articulo_barra.php", {
			width: 500,
			matchContains: true,
			mustMatch: false,
			selectFirst: false
		});
		
		$("#codigo_de_barra").result(function(event, data, formatted) {
			$("#id_articulo").val(data[1]);
			$("#articulo").val(data[2]);
			$("#precio").val(data[3]);
			$("#tipo_impuesto").val(data[4]);
			$("#descuento_producto_max").val(data[5]);
		});*/
				
		$("#codigo_cliente").autocomplete({
			serviceUrl : 'get_personas.php',
			paramName : 'q',
			onSelect: function (data) {
				$("#nombre_cliente").val(data.nombre_completo);
				$("#cedula").val(data.identificacion);
				$("#telefono").val(data.telefono);
				$("#saldo_actual").val(data.saldo_actual);
				$("#descuento_maximo").val(data.descuento_maximo);
			}
		});
		
		$("#nombre_cliente").autocomplete({
			serviceUrl : 'get_personas_n.php',
			paramName : 'q',
			onSelect: function (data) {
				$("#codigo_cliente").val(data.id_cliente);
				$("#cedula").val(data.identificacion);
				$("#telefono").val(data.telefono);
				$("#saldo_actual").val(data.saldo_actual);
				$("#descuento_maximo").val(data.descuento_maximo);
			}
		});
		
		
		/*$("#nombre_aseguradora").autocomplete("get_aseguradoras.php", {
			width: 500,
			matchContains: true,
			mustMatch: true,
			selectFirst: true
		});
		
		$("#nombre_aseguradora").result(function(event, data, formatted) {
			$("#codigo_aseguradora").val(data[1]);
			$("#porcentaje_desc").val(data[2]);
			/*$("#alergias").val(data[2]);
				$("#peso").val(data[3]);
				$("#otros").val(data[4]);
				$("#compania_de_seguro").val(data[5]);
				$("#diabetes").val(data[6]);
				$("#hipertension").val(data[7]);
			$("#contraindicaciones").val(data[8]);
		});*/
		
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
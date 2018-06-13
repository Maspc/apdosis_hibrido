<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/facturacion_credito.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
?>
<style>
	th {
    color: #ffffff;
    background-color: #003b66;
	text-align: center;
	}
</style>

<!-- This goes in the document HEAD so IE7 and IE8 don't cry -->
<!--[if lt IE 9]>+
	<style type="text/css">
	table.gradienttable th {
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d5e3e4', endColorstr='#b3c8cc',GradientType=0 );
	position: relative;
	z-index: -1;
	}
	table.gradienttable td {
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ebecda', endColorstr='#ceceb7',GradientType=0 );
	position: relative;
	z-index: -1;
	}
	</style>
<![endif]-->

<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<?php
	layout::menu();
	layout::ini_content();
?>
<center><h1>Pagos a Cr&eacute;dito</h1></center>
<?php
	$korow = fcredito::select1($_SESSION['MM_iduser']);
	foreach($korow as $kw){
		$caja_id = $kw->caja_id;
		$nombre = $kw->nombre;
	}				
	
	$kerow = fcredito::select2();
	foreach($kerow as $kew){
		$nombre_dia = $kew->nombre;
	}
?>

<p>
	Esta facturando en la caja: <?php echo $nombre; ?>.
</p>


<center>
	<form name="facturacion" id="facturacion" action="enviar_factura_credito.php" onkeypress="return anular(event)" onSubmit="popupform(this, 'join')" method="post" >
		<!-- popupform(this, 'join') -->
		
		<table border="0" cellspacing="20"  >
			<tr valign="top"><td>
				
				<p>&nbsp;</p>
				<table border="1" class="gradienttable">
					<th colspan="4"><h2>Datos del Cliente</h2></th>
					<tr><td width="91"><b>Cliente:</b></td>
						<td width="60"><input type="text" name="codigo_cliente" id="codigo_cliente" size="10" value="<?php echo $codigo_cliente; ?>"   /><input type="hidden" name="tipo_cliente" id="tipo_cliente" size="10"/>
						<input type="text" name="nombre_cliente" id="nombre_cliente" size="75" value="<?php echo $nombre_cliente; ?>"  /></td></tr>
						<tr>
							<td width="169"><b>C&eacute;dula:</b></td>
						<td width="303"><input type="text" name="cedula" id="cedula" size="50" value="<?php echo $identificacion; ?>"   /></td></tr>
						<!-- <tr><td><b>Aseguradora:</b></td>
							<td><input type="checkbox" name="aseguradora" value="S" /></td>
							<td align="right"><b>Nombre de Aseguradora:</b></td>
							<td><input type="text" name="nombre_aseguradora" id="nombre_aseguradora" size="50" /><input type="hidden" name="codigo_aseguradora" id="codigo_aseguradora" size="50" /></td></tr>
						-->
						<tr><td><b>Saldo Actual:</b></td>
							<td><input type="text" name="saldo_actual" id="saldo_actual" size="25" class="txtComputerTotal" readonly /></td>
						</tr>
				</table>
				<p>&nbsp;</p>
				
				
				<!-- </p></td><td> -->
				
				<p>&nbsp;</p>
				
				<center>
					<table border="1" class="gradienttable">
						<tr><td>Total a Pagar</td><td><input type="text" name="total" id="total" size="10" value="0.00" class="txtComputerTotal" onclick="verifica_espacio(this);" onkeyup="AddComma(this);"  onKeyPress="return numbersonly(this, event)" onChange="verificaSaldo();" /></td></tr>
						
						
						
					</table>
					
				</center>
				
				<p>&nbsp;</p>
				
				
				<!-- </p></td><td> -->
				
				<p>&nbsp;</p>
				
				<center>
					<table border="1" class="gradienttable">
						<th colspan="2"><h2>Formas de Pago</h2></th>
						<tr><td>Efectivo</td><td><input type="text" name="efectivo" id="efectivo" size="10" value="0.00" class="txtComputer" onclick="verifica_espacio(this);" onkeyup="AddComma(this);"  onKeyPress="return numbersonly(this, event)" onchange="fn_resta_saldo();"  /></td></tr>
						<tr><td>Tarjeta de Crédito</td><td><input type="text" name="tarjeta_credito" id="tarjeta_credito" size="10" value="0.00" class="txtComputer" onclick="verifica_espacio(this);" onkeyup="AddComma(this);" onKeyPress="return numbersonly(this, event)" onchange="fn_resta_saldo();"/>&nbsp;&nbsp;Ref.:<input type="text" name="ref_tdc" id="ref_tdc" size="10" /></td></tr>
						<tr><td>Clave</td><td><input type="text" name="clave" id="clave" size="10" value="0.00" class="txtComputer" onclick="verifica_espacio(this);" onkeyup="AddComma(this);"  onKeyPress="return numbersonly(this, event)" onchange="fn_resta_saldo();"/>&nbsp;&nbsp;Ref.:<input type="text" name="ref_tdb" id="ref_tdb" size="10" /><input type="hidden" name="credito" id="credito" size="10" value="0.00" class="txtComputer" onKeyPress="return numbersonly(this, event)" onchange="fn_check_credito(); fn_resta_saldo();"/></td></tr>
						<tr><td>Cheque</td><td><input type="text" name="cheque" id="cheque" size="10" value="0.00" class="txtComputer" onclick="verifica_espacio(this);" onkeyup="AddComma(this);"  onKeyPress="return numbersonly(this, event)" onchange="fn_resta_saldo();" />&nbsp;&nbsp;&nbsp;&nbsp;<br />No.de Cheque<input type="text" name="no_cheque" id="no_cheque" size="10" />&nbsp;&nbsp;&nbsp;&nbsp;<br />Banco<input type="text" name="nombre_banco" id="nombre_banco" size="20" /></td></tr>
						<tr><td>Saldo</td><td><input type="text" name="saldo" id="saldo" size="10" value="0.00" class="txtComputerTotal" readonly /></td></tr>
						<tr><td>Vuelto</td><td><input type="text" name="vuelto" id="vuelto" size="10" value="0.00" class="txtComputerTotal" readonly /></td></tr>
						
						
					</table>
					
					<p></p>
					
					<input type="submit" name="imprimir" id="imprimir" value="Imprimir Fiscal" class="boton" disabled />
				</center>
				
			</td>
			
			
			</tr></table>
	</form>
</center>
<?=layout::fin_content()?>

<script type="application/javascript">
	function button(){
		alert('funcion q deshabilita boton');
		
	}
</script>

<script type="text/javascript">
	function fn_check_maxdesc(){
		var descuento_maximo = facturacion.descuento_maximo.value * 100;
		var porcentaje_desc = facturacion.porcentaje_desc.value;
		
		if (porcentaje_desc > descuento_maximo) {
			alert('El descuento es mayor al máximo para el tipo de cliente!');
			facturacion.porcentaje_desc.value = descuento_maximo;
			return false;
			} else {
			
			return true;
		}
		
	}
</script>

<script type="text/javascript">
	function fn_check_maxdesc_prod(){
		var descuento_maximo = facturacion.descuento_producto_max.value;
		var porcentaje_desc = facturacion.descuento_producto.value;
		//alert("Descuento maximo: " + descuento_maximo);
		//alert("Porcentaje desc: " + porcentaje_desc);
		if (porcentaje_desc > descuento_maximo) {
			alert('El descuento es mayor al máximo para el tipo de producto!');
			facturacion.descuento_producto.value = descuento_maximo;
			return false;
			} else {
			
			return true;
		}
		
	}
</script>

<script type="text/javascript">
	function fn_activa_descjub(){
		if (facturacion.jubilado.checked == true){
			facturacion.porcentaje_desc.value = 20;
			} else {
			facturacion.porcentaje_desc.value = 0;
		}
		
		return true;
		
	}
</script>

<script type="text/javascript">
	function verifica_espacio(valor){
		if(valor.value == "0.00"){
			valor.value = " ";
		}
		
		return true;
		
	}
	
	function verifica_cero(valor){
		if(valor.value == " "){
			valor.value=="0.00";
		}						
		return true;
		
	}
	
	
</script>


<script type="text/javascript">
	function fn_carga_descuento(){
		if(facturacion.tipo_cliente.value != 5){
			facturacion.porcentaje_desc.value = facturacion.descuento_maximo.value * 100;
			} else {
			//alert('Es tipo contado');
			facturacion.porcentaje_desc.value = 0;
		} 
		
		return true;
		
	}
	
	
	function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=600');");
	}
	
	
	
	
	
	function limpiar_campos()
	{
		
		document.getElementById('codigo_de_barra').value='';
		document.getElementById('id_articulo').value='';
		document.getElementById('articulo').value='';
		document.getElementById('precio').value='';
		document.getElementById('cantidad').value='1';
		document.getElementById('tipo_impuesto').value='';
		document.getElementById('descuento_prod').checked=false;
		document.getElementById('descuento_producto').value='';
		document.getElementById('descuento_producto_max').value='';
		
		
	}
</script>


<script type="text/javascript">
	function AddComma(text) {
		switch (text.value.length) {
			case 1:
			//document.getElementById("txtNumber").value = "0.0" + text.value;
			text.value = "0.0" + text.value
			break;
			default:
			var data = text.value.replace(".", "");
			var first = data.substring(0, (data.length - 2));
			var second = data.substring(data.length - 2);
			var temp = Math.abs(first) + "." + second;
			//document.getElementById("txtNumber").value = temp;
			text.value=temp;
		}
	}
</script>

<script type="text/javascript">
	function fn_check_credito(){
		var saldo_actual = facturacion.saldo_actual.value;
		var limite_credito  = facturacion.limite_credito.value;
		var credito  = facturacion.credito.value;
		var saldo_disponible = limite_credito - saldo_actual;
		
		if (credito > saldo_disponible) {
			alert('El crédito no puede ser mayor al disponible actual para el cliente!');
			facturacion.credito.value = 0;
			return false;
			} else {
			
			return true;
		}
		
	}
</script>


<script type="text/javascript">
	function cambiarPrecio(valor){
		facturacion.primer_pago.value = facturacion.precio.value/valor.value; 
		return true;		
	}
</script>

<script type="text/javascript">
	function cambiarPrecioc(valor){
		facturacion.primer_pago.value = valor.value/facturacion.cantidad_de_pagos.value; 
		return true;		
	}
</script>



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
		
		$('#articulo').autocomplete({
			serviceUrl : 'get_articulo.php',
			paramName : 'q',
			onSelect: function (data) {
				$("#id_articulo").val(data.codigo_interno);
				$("#codigo_de_barra").val(data.codigo_de_barra);
				$("#precio").val(data.precio_unitario);
				$("#tipo_impuesto").val(data.tipo_impuesto);
				$("#descuento_producto_max").val(data.descuento_maximo);
				$("#jubilado_desc").val(data.jubilado);
				$("#descuento_diario").val(data.porcentaje);
			}
		});
		
		$("#codigo_de_barra").autocomplete({
			serviceUrl : 'get_articulo_barra.php',
			paramName : 'q',
			onSelect: function (data) {
				$("#id_articulo").val(data.codigo_interno);
				$("#articulo").val(data.nombre);
				$("#precio").val(data.precio_unitario);
				$("#tipo_impuesto").val(data.tipo_impuesto);
				$("#descuento_producto_max").val(data.descuento_maximo);
				$("#jubilado_desc").val(data.jubilado);
				$("#descuento_diario").val(data.porcentaje);
			}
		});		
		
		$('#codigo_de_barra').bind('keypress', function(e) {
			var code = (e.keyCode ? e.keyCode : e.which);
			if(code == $.ui.keyCode.ENTER) {
				$(this).autocomplete("close");
			}
		});
		
		$("#codigo_cliente").autocomplete({
			serviceUrl : 'get_personas.php',
			paramName : 'q',
			onSelect: function (data) {
				$("#nombre_cliente").val(data.nombre_completo);
				$("#cedula").val(data.identificacion);
				$("#telefono").val(data.telefono);
				$("#saldo_actual").val(data.saldo_actual);
				$("#descuento_maximo").val(data.descuento_maximo);
				$("#tipo_cliente").val(data.tipo_cliente);
				$("#limite_credito").val(data.limite_credito);
				
				if(document.getElementById('tipo_cliente').value != 5){
					document.getElementById('porcentaje_desc').value = document.getElementById('descuento_maximo').value*100;
					} else {
					document.getElementById('porcentaje_desc').value = 0;
				}
				
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
				$("#tipo_cliente").val(data.tipo_cliente);
				$("#limite_credito").val(data.limite_credito);
				
				/*$("#alergias").val(data[2]);
					$("#peso").val(data[3]);
					$("#otros").val(data[4]);
					$("#compania_de_seguro").val(data[5]);
					$("#diabetes").val(data[6]);
					$("#hipertension").val(data[7]);
				$("#contraindicaciones").val(data[8]);*/
				if(document.getElementById('tipo_cliente').value != 5){
					document.getElementById('porcentaje_desc').value = document.getElementById('descuento_maximo').value*100;
					} else {
					document.getElementById('porcentaje_desc').value = 0;
				}
				
			}
		});
		
		
		$("#nombre_aseguradora").autocomplete({
			serviceUrl : 'get_aseguradoras.php',
			paramName : 'q',
			onSelect: function (data) {
				$("#codigo_aseguradora").val(data.codigo_aseg);
				$("#porcentaje_desc").val(data.descuento_maximo);
			}
		});
		
		$("#clear").click(function() {
			$(":input").unautocomplete();
		});
		
		
	});
	
	
	
	
</script>

<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:1500px;dialogHeight:600px");
			} else {
			alert(url);
			window.open(url,'name','height=600,width=1500,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} </script>
	
	<SCRIPT TYPE="text/javascript">
		<!--
		// copyright 1999 Idocs, Inc. http://www.idocs.com
		// Distribute this script freely but keep this notice in place
		function numbersonly(myfield, e, dec)
		{
			var key;
			var keychar;
			
			if (window.event)
			key = window.event.keyCode;
			else if (e)
			key = e.which;
			else
			return true;
			keychar = String.fromCharCode(key);
			
			// control keys
			if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) )
			return true;
			
			// numbers
			else if ((("0123456789.").indexOf(keychar) > -1))
			return true;
			
			// decimal point jump
			else if (dec && (keychar == "."))
			{
				myfield.form.elements[dec].focus();
				return false;
			}
			else
			return false;
		}
		
		
		function popupform(myform, windowname)
		{
			
			if (! window.focus)return true;
			
			window.open('', windowname, 'width=800,height=500, toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
			myform.target=windowname;
			return true;
		}
		
		function anular(e) {
			tecla = (document.all) ? e.keyCode : e.which;
			return (tecla != 13);
		}
		
		
		function valideopenerform(){
			
			if(facturacion.descuento.checked == true){
				if(facturacion.nombre_cliente.value != ''){
					var popy= window.open('popup_autoriza.php','popup_form','location=no,menubar=no,status=no,top=50%,left=50%,height=150,width=200');
					} else {
					alert("No puede habilitar un descuento si no ha cargado al cliente!");
					facturacion.descuento.checked = false;
				}
				} else {
				facturacion.porcentaje_desc.value = 0;
				facturacion.porcentaje_desc.disabled = true;
				
			}
		}
		
		
		function valideopenerform1(){
			
			if(facturacion.descuento_prod.checked == true){
				if(facturacion.articulo.value != ''){
					
					var popy= window.open('popup_autoriza_prod.php','popup_form','location=no,menubar=no,status=no,top=50%,left=50%,height=150,width=200');
					} else {
					alert("No puede habilitar un descuento si no ha cargado el producto!");
					facturacion.descuento_prod.checked = false;
				}
				} else {
				facturacion.descuento_producto.value = 0;
				facturacion.descuento_producto.disabled = true;
			}
			
			
		}
		
		
		// Prevent the backspace key from navigating back.
		$(document).unbind('keydown').bind('keydown', function (event) {
			var doPrevent = false;
			if (event.keyCode === 8) {
				var d = event.srcElement || event.target;
				if ((d.tagName.toUpperCase() === 'INPUT' && (d.type.toUpperCase() === 'TEXT' || d.type.toUpperCase() === 'PASSWORD')) 
				|| d.tagName.toUpperCase() === 'TEXTAREA') {
					doPrevent = d.readOnly || d.disabled;
				}
				else {
					doPrevent = true;
				}
			}
			
			if (doPrevent) {
				event.preventDefault();
			}
		});
		//-->
		
		
	</SCRIPT>
	
	
	<script type="text/javascript">
		function verificaSaldo(){
			//alert("Entro a verificar saldo");
			//alert("saldo: " + document.getElementById('saldo_actual').value);
			//alert("total: " + document.getElementById('total').value);
			if(parseFloat(document.getElementById('saldo_actual').value) < parseFloat(document.getElementById('total').value)){
				
				alert("El monto del pago no puede ser mayor al saldo actual, verifique! Saldo Actual: " + document.getElementById('saldo_actual').value + " Total: " + document.getElementById('total').value);
				document.getElementById('total').value = "0.00";
			}
		}
		
	</script>
	
	<script type="text/javascript">
		function verifica_espacio(valor){
			if(valor.value == "0.00"){
				valor.value = " ";
			}
			
			return true;
			
		}
		
		function verifica_cero(valor){
			if(valor.value == " "){
				valor.value=="0.00";
			}						
			return true;
			
		}
		
		
	</script>
	
	
	<script type="text/javascript">
		function AddComma(text) {
			
			switch (text.value.length) {
				case 1:
				//document.getElementById("txtNumber").value = "0.0" + text.value;
				text.value = "0.0" + text.value
				break;
				default:
				var data = text.value.replace(".", "");
				var first = data.substring(0, (data.length - 2));
				var second = data.substring(data.length - 2);
				var temp = Math.abs(first) + "." + second;
				//document.getElementById("txtNumber").value = temp;
				text.value=temp;
			}
		}
	</script>
	<script language="javascript" type="text/javascript" src="../js/script_fact_cr.js?r=<?=rand()?>"></script>	
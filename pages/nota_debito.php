<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/nota_debito.php');
	if (isset($_GET['men'])){
		$men = $_GET['men'];
		} else {
	$men = 0; }
	require_once('../modulos/layout.php');
	layout::encabezado();
?>
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
		else if ((("0123456789").indexOf(keychar) > -1))
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
	
	//-->
</SCRIPT>


<script type="text/javascript">
	$().ready(function() {
		
		$("#formulario").validate();
		
		function log(event, data, formatted) {
			$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
		}
		
		function formatItem(row) {
			return row[0] + " (<strong>id: " + row[1] + "</strong>)";
		}
		function formatResult(row) {
			return row[0].replace(/(<.+?>)/gi, '');
		}
		
		
		$("#medicamento").autocomplete("get_medicamento.php", {
			width: 500,
			matchContains: true,
			mustMatch: false,
			selectFirst: false
		});
		
		$("#medicamento").result(function(event, data, formatted) {
			$("#medicamento_id").val(data[1]);
			$("#forma_farma").val(data[2]);
			$("#dosis_tipo").val(data[3]);
			$("#tipo_de_dosis").val(data[4]);
			$("#descri_forma").val(data[5]);
			$("#posologia").val(data[6]);
			$("#codigo_barras").val(data[7]);
			$("#costo").val(data[8]);
		});
		
		$("#nommedico").autocomplete("get_medico.php", {
			width: 500,
			matchContains: true,
			mustMatch: false,
			selectFirst: false
		});
		
		$("#nommedico").result(function(event, data, formatted) {
			$("#medico").val(data[1]);
		});
		
		$("#proveedor_desc").autocomplete("get_proveedor.php", {
			width: 500,
			matchContains: true,
			mustMatch: true,
			selectFirst: true
		});
		
		$("#proveedor_desc").result(function(event, data, formatted) {
			$("#proveedor").val(data[1]);
		});
		
		/*
			$("#identificacion").autocomplete("get_personas.php", {
			width: 500,
			matchContains: true,
			mustMatch: true,
			selectFirst: true
			});
			
			$("#identificacion").result(function(event, data, formatted) {
			$("#nombre_paciente").val(data[1]);
			$("#alergias").val(data[2]);
			$("#peso").val(data[3]);
			$("#otros").val(data[4]);
			$("#compania_de_seguro").val(data[5]);
			$("#diabetes").val(data[6]);
			$("#hipertension").val(data[7]);
			$("#contraindicaciones").val(data[8]);
			});
		*/
		
		
		$("#clear").click(function() {
			$(":input").unautocomplete();
		});
		
		
	});
	
	
	
	
</script>

<script type="text/javascript">
	<!--
	function getData(){
		myString+=document.formulario.identificacion.value
		/*location.href = "ver_alergias.php" + '?' + myString*/
		alert("Estoy llamando a la funcion")
		URL = "ver_alergias.php" + '?' + myString
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=400');");
	}
	//-->
</script>





<script type="text/javascript">
	function limpiar_campos()
	{
		
		document.getElementById('medicamento').value='';
		document.getElementById('cantidad').value='';
		document.getElementById('lote').value='';
		document.getElementById('calendar').value='';
		document.getElementById('costo').value='';
		
	}
	
	
	
</script>

<script language="javascript">
	<!-- Begin
	function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=600');");
	}
	
	
	
	
	// End -->
</script>

<script>
	function validate()
	{
		var factura = document.formulario.factura;
		var proveedor = document.formulario.proveedor_desc;
		
		
		if (factura.value == "")
		{
			window.alert("Por favor introduzca el no. de factura");
			factura.focus();
			return false;
		}
		
		if (proveedor.value == "")
		{
			window.alert("Por favor introduzca el proveedor");
			proveedor.focus();
			return false;
		}
		
	}
</script>
<?php
	layout::menu();
	layout::ini_content();
?>
<div>
	
	<h2>Notas de Débito</h2>
	
	
	<div class="content_box_inner">
		<form name="perfil" action="imprimir_fiscal_debito.php" method="post">
			
			<p>Referencia Factura: <input type="text" name="FA" id="FA" size="20" class="required" />
				<p>
					<input type="checkbox" value="S" name="doble"> Se imprimió más de una vez? <select name="numero_veces"><option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
					<p> Número de Nota Fiscal: <input type="text" name="factura_fiscal" class="required"> 
						<p>Impresora a utilizar = <select name="impresora"><option value="in1">Impresora 1 - CLOK311101130</option><option value="in2">Impresora 2 - CLOK311101129</option><option value="in3">Impresora 3 - CLOK311100797</option></select></p>
					<input type="submit" name="Enviar" value="Enviar"></p>
				</p></p></form>
				
				<div></div>
	</div>
	
</div>
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script_com.js?r=<?=rand()?>"></script>
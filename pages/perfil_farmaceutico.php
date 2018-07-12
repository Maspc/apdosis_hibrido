<?php
	ob_start();
	include ('./clases/session.php');
	//require_once('../modulos/perfil_farmaceutico.php');
	require_once('../modulos/layout.php');
	layout::encabezado();	
	
	if (isset($_GET['men'])){
		$men = $_GET['men'];
		} else {
	$men = 0; }
	
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
<div>
	
	<h2>Perfil Farmacéutico</h2>
	
	
	<div class="content_box_inner">
		<form name="perfil" action="imprimir_historial_farma_xls_pr.php" method="post">
			
			<p>Introduzca el número de historia del paciente:<input type="text" name="historia" id="historia" size="20" /><input type="submit" name="Buscar" value="Buscar"></p>
		</form>
		
		<div></div>
	</div>
	
</div>
<?=layout::fin_content()?>
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
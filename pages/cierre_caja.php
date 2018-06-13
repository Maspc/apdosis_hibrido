<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/cierre_caja.php');
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
		else if ((("0123456789.").indexOf(keychar) > -1))
		return true;
		
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
		
		
		$("#insumo").autocomplete("get_insumo.php", {
			width: 500,
			matchContains: true,
			mustMatch: false,
			selectFirst: false
		});
		
		$("#insumo").result(function(event, data, formatted) {
			$("#insumo_id").val(data[1]);
			
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
		
		document.getElementById('insumo').value='';
		document.getElementById('insumo_id').value='';
		document.getElementById('cantidad').value='';
		;
		
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
		
		var proveedor = document.formulario.prove;
		
		
		
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
<p align="center"><h1>Cerrar Caja e Imprimir Reporte </h1></p>
<table>
	<form name="cerrar" id="cerrar" action="cerrar_caja.php" method="post">
		<tr>
			<td>
				Caja
			</td>
			<td>
				<select name="cierre" id="cierre">
					<?php 
						$cols = cierrecaja::cierres_caja();
						foreach($cols as $cs){
							echo '<option value="'.$cs->codigo_cierre.'">'.$cs->fecha_inicio.'</option>';
						}
					?> 
				</select></td>
		</tr>
		<tr>
			<td colspan="2">
				<center><input name="cierre_nave" id="cierre_nave" type="submit" value="Imprimir y Cerrar" /></center>
			</td>
		</tr>
	</form>
</table>

<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script_insumo.js"></script>
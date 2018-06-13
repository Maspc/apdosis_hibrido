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

<p style="margin-left: 20"><b><font color="#B8C0F0" face="Arial" size="2">&nbsp;</font></b>
	
	<font face="Arial" size="2" color="#000000">
		<?php
			
			$cierre = $_POST['cierre'];
			
			$row = cierrecaja::select1($cierre);
			foreach($row as $rw1){
				$fecha_inicio = $rw1->fecha_inicio;
				$monto_inicial = $rw1->monto_inicial;
			}
			
			$grow = cierrecaja::select2($fecha_inicio);
			
			foreach($grow as $gw1){
				$total = $gw1->total;
			}
			
			cierrecaja::update1($total,$cierre);						
			
			$wrow = cierrecaja::select3($cierre);
			foreach($wrow as $rw3){
				$monto_final = $rw3->monto_final;
			}
			
			cierrecaja::insert1($_SESSION['MM_iduser'],$monto_final,$monto_final);
		?>
		
		Se ha cerrado satisfactoriamente la Caja No. <?=$cierre?> 
		<br>
		<input type="button" value="Imprimir Reporte de Cierre de Caja" class="green" onClick="window.open('imprimir_reporte_fin_caja.php?cierre=<?=$cierre?>')" />
		
	</font>
	<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script_insumo.js"></script>	
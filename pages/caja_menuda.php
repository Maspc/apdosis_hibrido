<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/caja_menuda.php');
	if (isset($_GET['men'])){
		$men = $_GET['men'];
		} else {
	$men = 0; }
	
	if (isset($_GET['saldo'])){
		$saldo = $_GET['saldo'];
		} else {
	$saldo = 0; }
	require_once('../modulos/layout.php');
	layout::encabezado();

	layout::menu();
	layout::ini_content();
?>


<div>
	
	<h2>Recibo de Caja</h2>
	
	
	<div class="content_box_inner">
		<?php if ($men == 1) { echo "NO puede enviar una recibo en blanco!!"; } elseif ($men == 2) { echo "Su recibo es por un valor MAYOR al total de la caja menuda. Saldo Actual = ".$saldo;  } ?>
		
		<form action="enviar_caja.php" method="post" target="" name="formulario" id="formulario" onSubmit="return validate();">
			
			<table class="dtable" width="500" border="0" cellspacing="0" >
				
				<!-- <tr>
					
					<td colspan="8" align="right"><label>Cargo # <input name="cargo" type="text" size="10" readonly/></label> 
					<label>Factura # <input name="factura" type="text" size="10" readonly="true" /></label></td>
				</tr> !-->
				<tr>
					<td width="86"><label>Proveedor</label></td>
					<td width="355">
						
						<input name="proveedor_desc" id="proveedor_desc" type="text" size="50" required="required" />
						<input name="proveedor" id="proveedor" type="hidden" />&nbsp; <b>*</b></td><td> 
						<!-- <input name="prove" id="prove" type="text" size="50" required="required" /> -->
						
					</td>
				</tr>
				<tr>
					<td>Fecha Factura Proveedor </td>
					<td>
						<input type="text" sformat name="fecha_factura" id="f_date1" size="25" required="required" /><button bsmall id="f_btn1" type="button" >...</button><br /><script type="text/javascript">//<![CDATA[
							var cal1 = Calendar.setup({
								inputField : "f_date1",
								trigger    : "f_btn1",
								onSelect   : function() { this.hide() },
								dateFormat : "%Y-%m-%d"
							});	  
							
						//]]></script>&nbsp; <b>* (Formato: yyyy-mm-dd)</b>
					</td>
				</tr> 
				<tr>
					
					<td>Observaciones</td>
					<td>
					<textarea id="observaciones" name="observaciones" rows="5" cols="40"  > </textarea></td>
				</tr>
				
				
			</table>
			
			
			
			<table class="dtable" class="formulario"><br />
				<thead>
					<tr>
						<th colspan="2"><img src="../add.png" />Agregar Detalle de Recibo</th>
					</tr>
					<tr>
						<td colspan="2">
							
						</tr>
					</thead> 
					<tbody>
						<tr>
							<td>Rubro</td>
							<td><input name="rubro" type="text" id="rubro" size="75"/>&nbsp; <b>*</b>
							<input name="codigo_rubro" type="hidden" id="codigo_rubro" size="50" /></td>
						</tr>
						<tr>
							<td>Descripción</td>
							<td><input name="descripcion" type="text" id="descripcion" size="100" /> &nbsp; <b>*</b>
							</td>
						</tr>
						<tr>
							<td>Monto</td>
							<td><input name="monto" type="text" id="monto" size="25" onKeyPress="return numbersonly(this, event)" />&nbsp; <b>*</b>
							</td>
						</tr>
						<tr>
							<td>ITBMS</td>
							<td><select name="itmbs" id="itbms"><option value="S">Si</option><option value="N">No</option></select>&nbsp; <b>*</b>
							</td>
						</tr>
						
						<tr>
							<td colspan="2">
								<label>
									<div align="center">
										<input name="agregar" type="button" id="agregar" value="Agregar" onClick="fn_agregar();" class="green"/>
										<input name="limpiar" type="button" id="limpiar" value="Limpiar" onClick="limpiar_campos();" class="red"/>
									</div>
								</label>
							</td>
						</tr>
					</tbody>
					
				</table>
				
				<table class="dtable" id="grilla" class="lista">
					<thead>
						<tr>
							<th>Rubro</th>
							<th>Descripcion</th>
							<th>Monto</th>
							<th>Tiene IBMS?</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<!-- <tr>
							<td colspan="6"><strong>Cantidad:</strong> <span id="span_cantidad">0</span> medicamentos.</td>
						</tr> !-->
						<tr><td colspan="6"> <div id="results"></div></td></tr>
					</tfoot>
					
					
					<p align="center">  
						
						
						<input type="submit" name="enviar" id="enviar" value="Enviar Orden" class="green" /> 
						
						<!--  <input type="button" name="enviar" value="Enviar" id="enviar" onclick="javascript:popUprev('enviar.php')" /> !-->
						
					</p>
					<hr />
					
					
				</form>
				
				
			</table> 
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
		else if ((("0123456789.").indexOf(keychar) > -1))
		return true;
		
		else
		return false;
	}
	
	//-->
</SCRIPT>


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
		
		$("#rubro").autocomplete({
			serviceUrl : 'get_caja_menuda.php',
			paramName : 'q',
			onSelect: function (data) {
			$("#codigo_rubro").val(data.codigo_rubro);
			}
		});
				
		$("#proveedor_desc").autocomplete({
			serviceUrl : 'get_proveedor_caja.php',
			paramName : 'q',
			onSelect: function (data) {
			$("#proveedor").val(data.id_proveedor);
			}
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
		
		document.getElementById('rubro').value='';
		document.getElementById('descripcion').value='';
		document.getElementById('monto').value='';
		
		
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
<script language="javascript" type="text/javascript" src="../js/script_caja.js?r=<?=rand()?>"></script>
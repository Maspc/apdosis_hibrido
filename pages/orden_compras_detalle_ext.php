<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/orden_compras_detalle_ext.php');
	if (isset($_GET['men'])){
		$men = $_GET['men'];
		} else {
	$men = 0; }
	
	if (!isset($_SESSION['page_instance_ids'])) {
		$_SESSION['page_instance_ids'] = array();
	}
	$_SESSION['page_instance_ids'][] = uniqid('', true); 
	require_once('../modulos/layout.php');
	layout::encabezado();

	layout::menu();
	layout::ini_content();
?>

<div>
	
	<h2>Solicitar Mercanc&iacute;a Externa - Apdosis</h2>
	<div class="content_box_inner">
		<?php if ($men == 1) { echo "NO puede enviar una compra en blanco!!"; } elseif ($men == 2) { echo "Una de sus cantidades NO es un monto, verifique!!";  }  ?>
		<form action="enviar_orden_compra_ext.php" method="post" target="" name="formulario" id="formulario" >
			<table class="dtable" width="500" border="0" cellspacing="0" >
				
				
				
				
				<!-- <tr>
					
					<td colspan="8" align="right"><label>Cargo # <input name="cargo" type="text" size="10" readonly/></label> 
					<label>Factura # <input name="factura" type="text" size="10" readonly="true" /></label></td>
				</tr> !-->
				<tr>
					<td width="86"><label> Proveedor</label></td>
					<td width="355"><select name="proveedor" id="proveedor">
						<?php 
							$cols = ocomprasdet::provee();
							foreach($cols as $cs){
								echo '<option value="'.$cs->id_proveedor.'">'.$cs->nombre.'</option>';
							}
						?> 
					</select> &nbsp; <b>*</b>
					<label></label></td>
				</tr>
				
				<tr>
					
					<td>Observaciones</td>
					<td>
					<textarea id="observaciones" name="observaciones" rows="5" cols="40"  > </textarea></td>
				</tr>
				
				
			</table>
			
			
			
			<table class="formulario dtable"><br />
				<thead>
					<tr>
						<th colspan="2"><img src="../add.png" />Agregar Orden</th>
					</tr>
					<tr>
						<td colspan="2">
							
						</tr>
					</thead> 
					<tbody>
						<tr>
							<td>Código de Barras</td>
							<td><input name="codigo_barras" type="text" id="codigo_barras" size="50"/> <b>*</b></td>
						</tr>                      
						
						<tr>
							<td>Medicamento</td>
							<td><input name="medicamento" type="text" id="medicamento" size="75"/>
							<input name="medicamento_id" type="hidden" id="medicamento_id" size="50" /> <input type="button" name="agregar_medicamento" value="Agregar Medicamento" id="agregar_medicamento" onClick="javascript:popUp('agregar_medicamentos_us.php')" />  <b>*</b></td>
						</tr>
						<td>Cantidad</td>
						<td><input name="cantidad" type="number" id="cantidad" size="25" onKeyPress="return numbersonly(this, event)" />
						&nbsp; <b>*</b>   <input type="hidden" name="page_instance_id" value="<?php echo end($_SESSION['page_instance_ids']) ?>" /> </td>
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
						<th>Medicamento/Insumo</th>
						<th>Cantidad</th>
						
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
<script type="text/javascript">
	function comparaCero() {
		if (document.getElementById('cantidad').value <= 0) {
			alert("La cantidad no puede ser cero");
			return false;
			
		}
	}
	
</script>

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
		
		$("#medicamento").autocomplete({
			serviceUrl : 'get_medicamento_com.php',
			paramName : 'q',
			onSelect: function (data) {
			$("#medicamento_id").val(data.codigo_interno);
			$("#forma_farma").val(data.forma_farma);
			$("#dosis_tipo").val(data.tipo_posologia);
			$("#tipo_de_dosis").val(data.tipo_de_dosis);
			$("#descri_forma").val(data.forma_descri);
			$("#posologia").val(data.posologia);
			$("#codigo_barras").val(data.codigo_de_barra);
			}
		});
				
		$("#codigo_barras").autocomplete({
			serviceUrl : 'get_barras_com.php',
			paramName : 'q',
			onSelect: function (data) {
			$("#medicamento_id").val(data.codigo_interno);
			$("#forma_farma").val(data.forma_farma);
			$("#dosis_tipo").val(data.tipo_posologia);
			$("#tipo_de_dosis").val(data.tipo_de_dosis);
			$("#descri_forma").val(data.forma_descri);
			$("#posologia").val(data.posologia);
			$("#medicamento").val(data.nombre);
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
		
		document.getElementById('medicamento').value='';
		document.getElementById('cantidad').value='';
	}
	
	
	
</script>

<script language="javascript">
	
	function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=600');");
	}
	
	
</script>
<script language="javascript" type="text/javascript" src="../js/script_com_or.js"></script>
<?php
	ob_start();
	include ('./clases/session.php');
	//require_once('../modulos/ajustes_inventario.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	if (isset($_GET['men'])){
		$men = $_GET['men'];
		} else {
	$men = 0; }
	
	if (!isset($_SESSION['page_instance_ids'])) {
		$_SESSION['page_instance_ids'] = array();
	}
	$_SESSION['page_instance_ids'][] = uniqid('', true); 
	
	
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
	
	<h2>Ajuste a Inventario</h2>
	
	
	<div class="content_box_inner">
		<?php if ($men == 1) { echo "NO puede enviar una compra en blanco!!"; } elseif ($men == 2) { echo "Su recibo es por un valor MAYOR al total de la caja menuda. Saldo Actual = ".$saldo;  }  ?>
		
		<form action="enviar_ajuste_inventario.php" method="post" target="" name="formulario" id="formulario" onSubmit="return validate();">
			
			
            
			
			<table class="formulario"><br />
				<thead>
					<tr>
						<th colspan="2"><img src="add.png" />Agregar Producto</th>
					</tr>
					<tr>
						<td colspan="2">
							
						</tr>
					</thead> 
					<tbody>
						<tr>
                            <td>C&oacute;digo de Barra</td>
                            <td><input name="codigo_de_barra" type="text" id="codigo_de_barra" size="35"/>&nbsp; <b>*</b>
							</td>
						</tr>
                        <tr>
                            <td>Producto</td>
                            <td><input name="medicamento" type="text" id="medicamento" size="75"/>&nbsp; <b>*</b>
							<input name="medicamento_id" type="hidden" id="medicamento_id" size="50" /></td>
						</tr>
						<tr>
                            <td>Existencia Actual</td>
                            <td><input name="existencia" type="text" id="existencia" size="25" readonly /> &nbsp; <b>*</b>
							</td>
						</tr>
						<tr>
                            <td>Tipo de Ajuste</td>
                            <td><select name="tipo" id="tipo"><option value="P">Positivo</option><option value="N">Negativo</option></select>
								
							</td>
						</tr>
						<tr>
                            <td>Cantidad a Ajustar</td>
                            <td><input name="cantidad" type="text" id="cantidad" size="25" onKeyPress="return numbersonly(this, event)" /> &nbsp; <b>*</b>
							</td>
						</tr>
						<tr>
                            <td>Lote</td>
                            <td><input name="lote" type="text" id="lote" size="25" value="0" /><input type="button" name="lote_bt"  value="Asignar Lotes" id="lote_bt" onClick="javascript:popUpLote('escoger_lote.php')" >&nbsp; <b>*</b>
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
				
				<table id="grilla" class="lista">
					<thead>
						<tr>
							<th>Medicamento</th>
							<th>Tipo de Ajuste</th>
							<th>Cantidad</th>
							<th>Lote</th>
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
						
						
						<input type="submit" name="enviar" id="enviar" value="Enviar" class="green" /> 
						
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
		
		function stopRKey(evt) {
			var evt = (evt) ? evt : ((event) ? event : null);
			var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
			if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
		}
		
		document.onkeypress = stopRKey;
		
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
			else if ((("0123456789.").indexOf(keychar) > -1))
			return true;
			
			
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
					$("#grupo_med").val(data[7]);
					$("#tipo_impuesto").val(data[8]);
					$("#existencia").val(data[9]);
					$("#codigo_de_barra").val(data[10]);
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
				
				$("#codigo_de_barra").autocomplete("get_barras_com1.php", {
					width: 500,
					matchContains: true,
					mustMatch: false,
					selectFirst: true
				});
				
				$("#codigo_de_barra").result(function(event, data, formatted) {
					$("#medicamento_id").val(data[1]);
					$("#forma_farma").val(data[2]);
					$("#dosis_tipo").val(data[3]);
					$("#tipo_de_dosis").val(data[4]);
					$("#descri_forma").val(data[5]);
					$("#posologia").val(data[6]);
					$("#medicamento").val(data[7]);
					$("#tipo_impuesto").val(data[8]);
					$("#existencia").val(data[9]);
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
			
			function popUpLote(URL) {
				
				day = new Date();
				id = day.getTime();
				
				URL = URL + "?medicamento_id=" + formulario.medicamento_id.value;
				
				
				eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=200');");
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
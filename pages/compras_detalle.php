<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/compras_detalle.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	if (isset($_GET['men'])){
		$men = $_GET['men'];
		} else {
	$men = 0; }
	
	if (isset($_GET['saldo'])){
		$saldo = $_GET['saldo'];
		} else {
	$saldo = 0; }
	
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
	
	<h2>Ingreso de Mercanc&iacute;a</h2>
	
	
	<div class="content_box_inner">
		<?php if ($men == 1) { echo "NO puede enviar una compra en blanco!!"; } elseif ($men == 2) { echo "Su recibo es por un valor MAYOR al total de la caja menuda. Saldo Actual = ".$saldo;  } ?>
		
		<form action="enviar_compra.php" method="post" target="" name="formulario" id="formulario">
			
			<table width="500" border="0" cellspacing="0" >
				
				
				
				
				<!-- <tr>
					
					<td colspan="8" align="right"><label>Cargo # <input name="cargo" type="text" size="10" readonly/></label> 
					<label>Factura # <input name="factura" type="text" size="10" readonly="true" /></label></td>
				</tr> !-->
				<tr>
					<td width="86"><label> Proveedor</label></td>
					<td width="355">
						
						<input name="proveedor_desc" id="proveedor_desc" type="text" size="100" class="required" />
						<input name="proveedor" id="proveedor" type="hidden" />&nbsp; <b>*</b></td><td>
						
					<input name="addprov" type="button" value="Crear Nuevo Proveedor" onClick="javascript:popUp('anadir_proveedor.php')"/> </td>
				</tr>
				<tr>
					<td>Tipo de Entrada </td>
					<td><select name="tipo_entrada" id="tipo_entrada" onChange="verifica_entrada();">
						
						<?php 
							
							$resul=comprasdet::select1();         
							foreach($resul as $cols){
							?>   
							<option value="<?php echo $cols->id_entrada ?>"><?php echo $cols->descripcion ?></option>
							
							<?php } 
							
							
						?> </select>  *Las entradas que modifican costos de productos son solo Efectivo y Crédito</td>
				</tr>
				
				<tr>
					<td>Factura Proveedor </td>
					<td>
						<input type="text" name="factura" id="factura" size="25" class="required" />&nbsp; <b>*</b> &nbsp;Si son regal&iacute;as o reposiciones, la factura es 000
					</td>
				</tr>
				<tr>
					
					<td>Observaciones</td>
					<td>
					<textarea id="observaciones" name="observaciones" rows="5" cols="40"  > </textarea></td>
				</tr>
				
				
			</table>
			
			
			
			<table class="formulario"><br />
				<thead>
					<tr>
						<th colspan="2"><img src="add.png" />Agregar Orden</th>
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
							<td>Art&iacute;culo</td>
							<td><input name="medicamento" type="text" id="medicamento" size="75"/>&nbsp; <b>*</b>
							<input name="medicamento_id" type="hidden" id="medicamento_id" size="50" /><input type="button" name="agregar_medicamento" value="Agregar Medicamento" id="agregar_medicamento" onClick="javascript:popUp('agregar_medicamentos_us.php')" /><input type="button" name="agregar_insumo" value="Agregar Producto" id="agregar_insumo" onClick="javascript:popUp('agregar_insumos.php')" /></td>
						</tr>
						
						<tr>
							<td>Cantidad</td>
							<td><input name="cantidad" type="text" id="cantidad" size="25" onKeyPress="return numbersonly(this, event)" /> &nbsp; <b>*</b>
							</td></tr>
							<tr>
								<td>Regal&iacute;as</td>
								<td><input name="regalias" type="text" id="regalias" size="25" onKeyPress="return numbersonly(this, event)" value="0"/> &nbsp; <b>*</b>
								</td>
							</tr>
							
							<tr>
								<td>Lote</td>
								<td><input name="lote" type="text" id="lote" size="25"/><input name="tipo_impuesto" type="hidden" id="tipo_impuesto" size="25"/>&nbsp; <b>*</b>
								</td>
							</tr>
							<tr>
								<td>Fecha de vencimiento</td>
								<td><input name="calendar" type="text" id="calendar" size="25"/><button bsmall id="f_btn1" type="button" >...</button><br />
									<script type="text/javascript">//<![CDATA[
										var cal1 = Calendar.setup({
											inputField : "calendar",
											trigger    : "f_btn1",
											onSelect   : function() { this.hide() },
											dateFormat : "%Y-%m-%d"
										});
										
									//]]></script>
									
								</td>
							</tr>
							<tr>
								<td>Costo Unitario</td>
								<td><input name="costo" type="text" id="costo" size="25"/>&nbsp; <b>*</b>
								</td>
							</tr>
							<tr>
								<td>Descuento Unitario</td>
								<td><select name="tipo_descuento" id="tipo_descuento">
									<option value="1">Porcentaje</option>
									<option name="2">Valor</option>
								</select>&nbsp;<input type="valor_descuento" id="valor_descuento" size="20" />
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
							<th>L&iacute;nea</th>
							<th>Medicamento/Insumo</th>
							<th>Cantidad</th>
							<th>Regal&iacute;as</th>
							<th>Lote</th>
							<th>Fecha de Vencimiento</th>
							<th>Costo Unitario</th>
							<th>Descuento Unitario</th>
							<th>Imp. Unitario</th>
							<th>Costo Total</th>
							
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
						
						
						<input type="submit" name="enviar" id="enviar" value="Enviar Orden" class="green" onClick="return validate(); this.disabled=true; this.value='Enviando...'; "  /> 
						
						<center><p><b><h2>Total de la Compra: &nbsp; </h2><input type="text" name="total_c" id="total_c" value="0" disabled="disabled" style="font-size: 18px;text-align: center;font-color: blue;"><h2>Total Impuesto: &nbsp; </h2><input type="text" name="impuesto_c" id="impuesto_c" value="0" disabled="disabled" style="font-size: 18px;text-align: center;font-color: blue;"></b></p></center>
						
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
	
	
	<script type="text/javascript">
		
		function verifica_entrada() {
			if (document.formulario.tipo_entrada.value == '1') {
				document.formulario.recibo_de_caja.required = 'required'; 
				
				}else {
				document.formulario.recibo_de_caja.required = '';
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
				
				
				$("#medicamento").autocomplete("get_medicamento_com1.php", {
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
					$("#codigo_de_barra").val(data[7]);
					$("#tipo_impuesto").val(data[8]);
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
					mustMatch: false,
					selectFirst: false
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
				document.getElementById('codigo_de_barra').value='';
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
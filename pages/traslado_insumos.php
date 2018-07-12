<?php
	ob_start();
	include ('./clases/session.php');
	//require_once('../modulos/traslado_insumos.php');
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
	
	<h2>Traslado Interno a Cuarto Est&eacute;ril</h2>
	
	
	<div class="content_box_inner">
		<?php if ($men == 1) { echo "NO puede enviar una traslado en blanco!!"; }  ?>
		
		<form action="enviar_traslado_insumos.php" method="post" target="" name="formulario" id="formulario">
			
            <table width="500" border="0" cellspacing="0" >
				
				
				
				
				<!-- <tr>
					
					<td colspan="8" align="right"><label>Cargo # <input name="cargo" type="text" size="10" readonly/></label> 
					<label>Factura # <input name="factura" type="text" size="10" readonly="true" /></label></td>
				</tr> !-->
				
				<!-- <tr>
					<td>Factura Proveedor </td>
					<td>
					<input type="text" name="factura" id="factura" size="25" required="required" />&nbsp; <b>*</b>
					</td>
				</tr> -->
				<tr>
					
					<td>Observaciones</td>
					<td>
					<textarea id="observaciones" name="observaciones" rows="5" cols="40"  > </textarea></td>
				</tr>
				
				
			</table>
			
            
			
			<table class="formulario"><br />
				<thead>
					<tr>
						<th colspan="2"><img src="../add.png" />Agregar Detalle de Traslado Interno</th>
					</tr>
					<tr>
						<td colspan="2">
							
						</tr>
					</thead> 
					<tbody>
                        <tr>
                            <td>Insumo</td>
                            <td><input name="insumo" type="text" id="insumo" size="75"/>&nbsp; <b>*</b>
							<input name="insumo_id" type="hidden" id="insumo_id" size="50" /></td>
							</tr>
						<tr>
                            <td>Cantidad</td>
                            <td><input name="cantidad" type="text" id="cantidad" size="100" /> &nbsp; <b>*</b>
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
							<th>Insumo</th>
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
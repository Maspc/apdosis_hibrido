<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/traslado_detalle.php');
	if (isset($_GET['men'])){
		$men = $_GET['men'];
		} else {
	$men = 0; }
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
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


<div>
	
	<h2>Traslado entre Bodegas</h2>
	
	
	<div class="content_box_inner">
		<?php if ($men == 1) { echo "NO puede enviar un traslado en blanco!!"; }  ?>
		<form id="form" name="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			
			
			<table>
				<tr>
					<td width="86"><label>Bodega Origen</label></td>
					<td width="355"><select name="bodega_origen1" id="bodega_origen1">
						<?php 
							$cols = tdetalle::bodegas();
							foreach($cols as $cs){
								echo '<option value="'.$cs->bodega.'">'.$cs->descripcion.'</option>';
							}
						?> 
					</select>
					<label></label></td>
				</tr>
				<tr>
					<td width="86"><label>Bodega Destino</label></td>
					<td width="355"><select name="bodega_destino1" id="bodega_destino1">
						<?php
							$cols = tdetalle::bodegas();
							foreach($cols as $cs){
								echo '<option '.(($cs->bodega==2)?'selected':'').' value="'.$cs->bodega.'">'.$cs->descripcion.'</option>';
							}
						?> 
					</select>
					<label></label></td>
				</tr>
				<tr>
					<td><input name="buscar" id="buscar"  type="submit" value="Realizar Traslado" /></td>
				</tr>
			</table>	
		</form>	
		
		<?php
			if (isset($_POST['buscar'])){
				
				$bodega_origen = $_POST['bodega_origen1'];
				$bodega_destino = $_POST['bodega_destino1'];
				
				
				if($bodega_origen == $bodega_destino){
					echo "<p><b>El origen no puede ser igual al destino, verifique!</b></p>";
					} else { 
					
					$grow = tdetalle::bodegas2($bodega_origen,$bodega_destino);
					foreach($grow as $gw){
						$nombre_origen = $gw->nombre_origen;
						$nombre_destino = $gw->nombre_destino;
					}									
				?>
				<h1>Traslado entre <?php echo $nombre_origen; ?> y <?php echo $nombre_destino; ?></h1>
				
				<form action="enviar_traslado_detalle.php" method="post" target="" name="formulario" id="formulario" onkeypress="return anular(event)" onSubmit="return validate();">
					<input name="bodega_origen" type="hidden" id="bodega_origen" value="<? echo $bodega_origen ?>" size="50" />
					<input name="bodega_destino" type="hidden" id="bodega_destino" value="<? echo $bodega_destino ?>" size="50" />
					<table class="formulario"><br />
						<thead>
							<tr>
								<th colspan="2"><img src="add.png" />Agregar</th>
							</tr>
							<tr>
								<td colspan="2">
									
								</tr>
							</thead>
							
							
							<tbody>
								<tr>
									<td>C&oacute;digo de Barra</td>
									<td><input name="codigo_de_barra" type="text" id="codigo_de_barra" size="50"/>&nbsp; <b>*</b></td>
									
								</tr>
								<tr>
									<td>Producto</td>
									<td><input name="medicamento" type="text" id="medicamento" size="75"/>&nbsp; <b>*</b>
									<input name="medicamento_id" type="hidden" id="medicamento_id" size="50" /></td>
								</tr>
								<tr>
									<td>Cantidad Bodega Origen</td>
									<td><input name="cantidad_origen" type="text" id="cantidad_origen" size="25" readonly />
										
									</td>
								</tr>
								<tr>						
									<td>Cantidad Bodega Destino</td>
									<td><input name="cantidad_destino" type="text" id="cantidad_destino" size="25" readonly /> 
									</td>
								</tr>
								<tr>						
									<td>Inventario Ideal Destino</td>
									<td><input name="inventario_ideal" type="text" id="inventario_ideal" size="25" readonly /> 
									</td>
								</tr>
								<tr>
									<td>Cantidad</td>
									<td><input name="cantidad" type="text" id="cantidad" size="25" onKeyPress="return numbersonly(this, event)" /> &nbsp; <b>*</b>
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
									<th>Producto</th>
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
					<? }} ?>
					
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
			
			var bodega_origen = $("#bodega_origen").val();
			var bodega_destino = $("#bodega_destino").val();
			
			
			function log(event, data, formatted) {
				$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
			}
			
			function formatItem(row) {
				return row[0] + " (<strong>id: " + row[1] + "</strong>)";
			}
			function formatResult(row) {
				return row[0].replace(/(<.+?>)/gi, '');
			}
			
			
			$("#medicamento").autocomplete("get_medicamento_bod1.php?bodega_origen="+bodega_origen+"&bodega_destino="+bodega_destino+"", {
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
				$("#cant_max").val(data[9]);
				$("#cantidad_origen").val(data[10]);
				$("#cantidad_destino").val(data[11]);
				$("#inventario_ideal").val(data[12]);
			});
			
			$("#codigo_de_barra").autocomplete("get_barras_bod.php?bodega_origen="+bodega_origen+"&bodega_destino="+bodega_destino+"", {
				width: 500,
				matchContains: true,
				mustMatch: false,
				selectFirst: true
			});
			
			
			$('#codigo_de_barra').bind('keypress', function(e) {
				var code = (e.keyCode ? e.keyCode : e.which);
				if(code == $.ui.keyCode.ENTER) {
					$(this).autocomplete("close");
				}
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
				$("#cant_max").val(data[9]);
				$("#cantidad_origen").val(data[10]);
				$("#cantidad_destino").val(data[11]);
				$("#inventario_ideal").val(data[12]);
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
		
		function anular(e) {
			tecla = (document.all) ? e.keyCode : e.which;
			return (tecla != 13);
		}
		
		
		
	</script>
<script language="javascript" type="text/javascript" src="../js/script_bod.js?r=<?=rand()?>"></script>
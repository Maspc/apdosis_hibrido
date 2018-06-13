<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/facturacion_label.php');
	require_once('../modulos/layout.php');
	$userid=$_SESSION['MM_iduser']; 
	
	// $username = $_POST['username'];
	// includes nusoap class
	layout::encabezado();

	layout::menu();
	layout::ini_content();
?>

<div>
	
	<h2>Impresi&oacute;n de Labels</h2>
	<p></p><p></p>
	<div class="content_box_inner">
		<form action="enviar_fact_urg_label_pr.php" method="post" target="" name="formulario" id="formulario" onSubmit="popupform(this, 'join')">
			<table  border="0" cellspacing="0" >
				
				
				<p>
					
					<tr>
					<td colspan='2' width='200'><b>Nombre del Paciente</b></td></tr>
					<tr><td>Nombre:</td> <td ><label>
						<input type="text" name="nombre_paciente" id="nombre_paciente" size="25" required="required" maxlength="20" /> <input type="hidden" name="tipo_paciente" id="tipo_paciente" size="50" value="HOSPITALIZADO"/>
						<input type="hidden" name="env_paciente" value="1P"> <input type="hidden" name="numero_cama" id="numero_cama" value="1" />  <input type="hidden" name="edad" id="edad" value = "30" /><input type="hidden" name="nommedico" id="nommedico" value="0" size="50"><input type="hidden" name="alergias" id="alergias" value="Ninguna" /> <input type="hidden" name="compania_de_seguro" id="compania_de_seguro" value="Ninguna" size="60"/> <input type="hidden" id="contraindicaciones" name="contraindicaciones" value="Ninguna"  />
					</label></td>
					
					</tr>
					<tr><td>Apellido:</td><td>
					<input type="text" name="apellido_paciente" id="apellido_paciente" size="25" required="required" maxlength="20" /> </td></tr>
					<tr>
					<td colspan='2' width='200'><b>M&eacute;dico</b></td></tr>
					<tr><td>Nombre:</td> <td ><label>
						<input type="text" name="nom_med" id="nom_med" value="" size="25" maxlength="20" required="required"  /> <input type="hidden" name="id_paciente" id="id_paciente" value="000" /> 
					</label></td>
					
					</tr>
					<tr><td>Apellido:</td><td>
					<input type="text" name="apellido_med" id="apellido_med" size="25" required="required" maxlength="20" /> </td></tr>
					<!-- <tr>
						<td>N&uacute;mero de Orden</td>
						<td colspan="7"><label>
						
						</label></td>
						</tr
						<tr>
						<td>Tipo de Paciente</td>
						<td colspan="7"><label>
						
						</label></td>
						</tr>
						
						<tr>
						<td>Procedencia</td>
						<td colspan="7"><label>
						
						
						</label></td>
						</tr>
						
						
						
					-->
					<!-- 
						<tr>
						<td>Habitaci&oacute;n</td>
						<td width="128"><input type="text" name="numero_cama" id="numero_cama" /><label>
						
						</label></td></tr>
						<tr>
						<td>Edad</td>
						<td width="128"><label>
						
					</label></td></tr> -->
					
					
					
					
					
				</table>
				
				
				
				<table class="formulario"><br />
					<thead>
						<tr>
							<th colspan="2"><img src="../add.png" />Agregar Orden</th>
						</tr>
						<tr>
							<td colspan="2">
								<input type="hidden" name="tipo_de_dosis" id="tipo_de_dosis" />
								<input type="hidden" name="posologia" id="posologia" />    
								<input type="hidden" name="multiple_prin" id="multiple_prin" />
								<input type="hidden" name="grupo_med" id="grupo_med" />
								<input type="hidden" name="tipo_grupos" id="tipo_grupos"/><input type="hidden" name="tipo_dosis_o" id="tipo_dosis_o"/>
								<input type="hidden" name="codigo_barras" id="codigo_barras" />      
								<input type="hidden" name="tipo_final" id="tipo_final" />            
							</td>
						</tr>
					</thead> 
					<tbody>
						<tr>
							<td width='200'>Medicamento</td>
							<td><input name="medicamento" type="text" id="medicamento" size="75"/>
							<input name="medicamento_id" type="hidden" id="medicamento_id" size="50" /></td>
						</tr>
						
						<tr>
							<td width='200'>Forma Farmaceutica</td>
							<td><input type = "hidden" name="forma_farma" id="forma_farma" readonly>
								<input name="descri_forma" type="text" id="descri_forma" size="75" readonly /><input name="precio_unitario" type="hidden" id="precio_unitario" size="25" readonly />
								<input name="cantidad_x_dosis" type="hidden" id="cantidad_x_dosis" size="10" onKeyPress="return numbersonly(this, event)"  /> <input name="valor_poso" type="hidden" size="10" id="valor_poso" readonly /><input name="dosis" type="hidden" id="dosis" value="1" size="10" onKeyPress="return numbersonly(this, event)" readonly /><input type="hidden" name="tipo_posologia" id="dosis_tipo" >
							</td>
						</tr>
						
						
						<!-- <tr>							
							<td>Volumen</td>
							<td><input name="volumen" type="text" id="volumen" size="10" onKeyPress="return numbersonly(this, event)" readonly /><select name="tipo_volumen" id="tipo_volumen">
							<?php /*/$y = "select codigo_posologia, descripcion from tipos_posologias order by descripcion";
								$resul3 = mysql_query($y, $conn) or die(mysql_error());
								while($cols3 = mysql_fetch_array($resul3)){	  
								?>
								<option value="<?php echo $cols3["codigo_posologia"] ?>"><?php echo $cols3["descripcion"] ?></option>
							<?php }*/  ?> </select></td>
						</tr> -->
						
						
						
						<input name="horas" id="horas" type="hidden" size="10"  readonly />
						<input name="dias" id="dias" type="hidden" size="10"  readonly />
						
						<tr> <td width='200'>Observaci&oacute;n</td><td><input name="obsermed" id="obsermed" type="text" size="90" maxlength="90">  </td></tr>
						<tr>
							<td colspan="2">
								<label>
									<div align="center">
										<input name="agregar" type="button" id="agregar" value="Agregar" onClick="fn_agregar_s();" class="green"/>
										<input name="limpiar" type="button" id="limpiar" value="Limpiar" onClick="limpiar_campos_s();" class="red"/>
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
							<!--    <th>Forma Farmaceutica</th>
								<th>Precio Unitario</th>
								<th>Cantidad</th>
								<th>Frecuencia Horas</th>
								<th>Frecuencia Días</th>
							<!--  <th>Cantidad por Dosis</th> -->
							<th>Obser.</th>
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
						
						
						<input type="submit" name="enviar" id="enviar" value="Crear Label" class="green" /> 
						
						<!--  <input type="button" name="enviar" value="Enviar" id="enviar" onclick="javascript:popUprev('enviar.php')" /> !-->
						
					</p>
					<hr />
					
					
				</form>
				
				
				
				<div></div>
			</div>
			
		</div>
	<?=layout::fin_content()?>
	<script type="text/javascript">
	$(document).ready(function() {
		
		//alert('hola');
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
		
		/*$("#medicamento").autocomplete("get_medicamento_1.php", {
			width: 500,
			matchContains: true,
			mustMatch: true,
			selectFirst: false,
			multiple: true
		});*/
		/*$( "#medicamento" ).autocomplete({
			source: availableTags
		});
		
		var availableTags = [
		"ActionScript",
		"AppleScript",
		"Asp",
		"BASIC",
		"C",
		"C++",
		"Clojure",
		"COBOL",
		"ColdFusion",
		"Erlang",
		"Fortran",
		"Groovy",
		"Haskell",
		"Java",
		"JavaScript",
		"Lisp",
		"Perl",
		"PHP",
		"Python",
		"Ruby",
		"Scala",
		"Scheme"
		];*/
		
		$("#medicamento").autocomplete({
			serviceUrl : 'get_medicamento_1.php',
			paramName : 'q',
			onSelect: function (data) {
			$("#medicamento_id").val(data.codigo_interno);
			$("#forma_farma").val(data.forma_farma);
			$("#dosis_tipo").val(data.tipo_posologia);
			$("#tipo_de_dosis").val(data.tipo_de_dosis);
			$("#descri_forma").val(data.forma_descri);
			$("#posologia").val(data.posologia);
			$("#codigo_barras").val(data.codigo_de_barra);
			$("#tipo_grupos").val(data.tipo_grupo);
			$("#tipo_dosis_o").val(data.tipo_posologia);
			$("#dosis").val(data.posologia);
			$("#multiple_prin").val(data.multiple_principio);
			$("#grupo_med").val(data.grupo_medicamento);
			$("#volumen").val(data.volumen);
			$("#tipo_volumen").val(data.tipo_volumen);
			$("#vol_desc").val(data.vol_desc);
			$("#dosis_desc").val(data.dosis_desc);
			$("#precio_unitario").val(data.precio_unitario);
			
			//alert("tipo de dosis: " + document.getElementById('tipo_de_dosis').value);
			
			if (document.getElementById('multiple_prin').value == 'S' | document.getElementById('tipo_de_dosis').value == 'N' | document.getElementById('tipo_de_dosis').value == 'E'  ) {
				/*	document.getElementById('dosis').readOnly = true;	
					document.getElementById('cantidad_x_dosis').readOnly = false;
				document.getElementById('volumen').readOnly = true;*/
				//alert('Debe introducir la cantidad por dosis directamente');		
				document.getElementById('tipo_final').value = '1';
				document.getElementById('cantidad_x_dosis').value = 1;
				document.getElementById('valor_poso').value = 'Unidad';
				} else {
				/*   document.getElementById('dosis').readOnly = false;	
					document.getElementById('cantidad_x_dosis').readOnly = true;
				document.getElementById('volumen').readOnly = true;	*/
				//alert('Debe introducir la dosis del medicamento en el campo dosis');
				document.getElementById('tipo_final').value = '2';
				document.getElementById('cantidad_x_dosis').value = data[6];
				document.getElementById('valor_poso').value = data[14];
			}
			
			
			if (document.getElementById('grupo_med').value == '7'  | document.getElementById('grupo_med').value == '11') {
				if (document.getElementById('tipo_de_dosis').value == 'U' | document.getElementById('tipo_de_dosis').value == 'M') {
					/*	document.getElementById('dosis').readOnly = true;	
						document.getElementById('cantidad_x_dosis').readOnly = true;
					document.getElementById('volumen').readOnly = false;*/
					//alert('Debe introducir el volumen por dosis del líquido');
					
					document.getElementById('tipo_final').value = '3';
					document.getElementById('cantidad_x_dosis').value = data[11];
					document.getElementById('valor_poso').value = data[13];
				}}				
			}
		});
		
		/*$("#nommedico").autocomplete("get_medico.php", {
			width: 500,
			matchContains: true,
			mustMatch: false,
			selectFirst: false
		});
		
		$("#nommedico").result(function(event, data, formatted) {
			$("#medico").val(data[1]);
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
		else if ((("0123456789.").indexOf(keychar) > -1) & (document.getElementById('tipo_de_dosis').value == 'U' | document.getElementById('tipo_de_dosis').value == 'M')  )
		return true;
		
		else if ((("0123456789").indexOf(keychar) > -1) & (document.getElementById('tipo_de_dosis').value == 'N' | document.getElementById('tipo_de_dosis').value == 'E')  )
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
		document.getElementById('dosis').value='';
		document.getElementById('obsermed').value='';
		document.getElementById('cantidad_x_dosis').value='';
		document.getElementById('volumen').value='';
		document.getElementById('horas').options[0].selected=true;
		document.getElementById('dias').options[0].selected=true;
		
	}
	
	function limpiar_campos_s()
	{
		
		document.getElementById('medicamento').value='';
		document.getElementById('dosis').value='';
		document.getElementById('obsermed').value='';
		document.getElementById('cantidad_x_dosis').value='';
		document.getElementById('volumen').value='';
		document.getElementById('horas').options[47].selected=true;
		document.getElementById('dias').options[0].selected=true;
		
	}
	
	// Prevent the backspace key from navigating back.
	$(document).unbind('keydown').bind('keydown', function (event) {
		var doPrevent = false;
		if (event.keyCode === 8) {
			var d = event.srcElement || event.target;
			if ((d.tagName.toUpperCase() === 'INPUT' && (d.type.toUpperCase() === 'TEXT' || d.type.toUpperCase() === 'PASSWORD')) 
			|| d.tagName.toUpperCase() === 'TEXTAREA') {
				doPrevent = d.readOnly || d.disabled;
			}
			else {
				doPrevent = true;
			}
		}
		
		if (doPrevent) {
			event.preventDefault();
		}
	});
</script>

<script language="javascript">
	<!-- Begin
	function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=400');");
	}
	
	
	
	function popupform(myform, windowname)
	{
		
		if (! window.focus)return true;
		
		window.open('', windowname, 'width=1200,height=600, toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
		myform.target=windowname;
		return true;
	}
	
	
	// End -->
</script>


<script>
	function onCheck()
	{
		// content  
		//alert("check");
		if ( document.getElementById("cambiar_envio").checked == true ) {
			alert("No puede seleccionar un banco y cambio de destino !");
			document.getElementById("mostrar_banco").checked = false;
			}else {
			
			window.location='indexh.php?historia=<?php echo $historia; ?>&userid=<?php echo $userid; ?>&session=<?php echo $session; ?>&username=<?php echo urlencode($username); ?>&bodega=S&cenvio=N&urg=S';
		}
	}
	
	function onUnCheck()
	{
		// content
		//alert("uncheck");
		window.location='indexh.php?historia=<?php echo $historia; ?>&userid=<?php echo $userid; ?>&session=<?php echo $session; ?>&username=<?php echo urlencode($username); ?>&bodega=N&cenvio=N&urg=N'
	}
</script>


<script>
	function actBanco(sel)
	{
		// content  
		alert("Espere unos segundos para que refresque su selección...");
		
		var value = sel.options[sel.selectedIndex].value; 
		
		window.location='indexh.php?historia=<?php echo $historia; ?>&userid=<?php echo $userid; ?>&session=<?php echo $session; ?>&username=<?php echo urlencode($username); ?>&bodega=S&cenvio=N&urg=S&bodnum='+value;
		
	}
	
	
</script>

<script>
	function onCheckM()
	{
		// content  
		//alert("check");
		alert("Espere unos segundos para que refresque su selección...");
		
		if ( document.getElementById("mostrar_banco").checked == true ) {
			alert("No puede seleccionar un banco y cambio de destino !!");
			document.getElementById("cambiar_envio").checked = false;
			}else {
			window.location='indexh.php?historia=<?php echo $historia; ?>&userid=<?php echo $userid; ?>&session=<?php echo $session; ?>&username=<?php echo urlencode($username); ?>&cenvio=S&bodega=N&urg=S';
		}
	}
	
	function onUnCheckM()
	{
		// content
		//alert("uncheck");
		alert("Espere unos segundos para que refresque su selección...");
		
		window.location='indexh.php?historia=<?php echo $historia; ?>&userid=<?php echo $userid; ?>&session=<?php echo $session; ?>&username=<?php echo urlencode($username); ?>&cenvio=N&bodega=N&urg=N'
	}
</script>

<script>
	function onCheckurg()
	{
		// content  
		//alert("check");
		
		alert("Espere unos segundos para que refresque su selección...");
		
		window.location='indexh.php?historia=<?php echo $historia; ?>&userid=<?php echo $userid; ?>&session=<?php echo $session; ?>&username=<?php echo urlencode($username); ?>&bodega=N&cenvio=N&urg=S';
		
	}
	
	function onUnCheckurg()
	{
		// content
		//alert("uncheck");
		alert("Espere unos segundos para que refresque su selección...");
		
		window.location='indexh.php?historia=<?php echo $historia; ?>&userid=<?php echo $userid; ?>&session=<?php echo $session; ?>&username=<?php echo urlencode($username); ?>&bodega=N&cenvio=N&urg=N'
	}
</script>


<script>
	function onCheckprn()
	{
		// content  
		//alert("check");
		
		alert("Espere unos segundos para que refresque su selección...");
		
		window.location='indexh.php?historia=<?php echo $historia; ?>&userid=<?php echo $userid; ?>&session=<?php echo $session; ?>&username=<?php echo urlencode($username); ?>&bodega=N&cenvio=N&urg=S&prn=S';
		
	}
	
	function onUnCheckprn()
	{
		// content
		//alert("uncheck");
		alert("Espere unos segundos para que refresque su selección...");
		
		window.location='indexh.php?historia=<?php echo $historia; ?>&userid=<?php echo $userid; ?>&session=<?php echo $session; ?>&username=<?php echo urlencode($username); ?>&bodega=N&cenvio=N&urg=N&prn=N'
	}
	
	
</script>

<script language="javascript">
	function carga_nombre(obj){
		
		var ind = obj.selectedIndex;
		var val = obj.options[ind].text;
		
		var str = val.split("|");
		var nom = str[0];
		var iden = str[1]; 
		
		if (!iden){
			iden = '99999';
		}
		if (obj.options[ind].value != 5){
			formulario.id_paciente.value = iden;
			formulario.nombre_paciente.value = nom;
			
			
			formulario.id_paciente.readOnly = true;
			formulario.nombre_paciente.readOnly = true;
			} else {
			formulario.id_paciente.value = '';
			formulario.nombre_paciente.value = '';
			formulario.id_paciente.readOnly = false;
			formulario.nombre_paciente.readOnly = false;
			
		}
		
	}
</script>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/facturacion_cargos.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	estado_c::select1();
?>		
<style>
	.txtComputer {
	font-size: 16px;
	font-family:Calibri;
	background-color:#0080FF;
	color:#FFFFFF;
	}
	
	.txtComputerTotal {
	font-size: 32px;
	font-family:Calibri;
	background-color:#0080FF;
	color:#FFFFFF;
	}
	
	.boton {
	-moz-box-shadow:inset 0px 1px 0px 0px #97c4fe;
	-webkit-box-shadow:inset 0px 1px 0px 0px #97c4fe;
	box-shadow:inset 0px 1px 0px 0px #97c4fe;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #3d94f6), color-stop(1, #1e62d0) );
	background:-moz-linear-gradient( center top, #3d94f6 5%, #1e62d0 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3d94f6', endColorstr='#1e62d0');
	background-color:#3d94f6;
	-webkit-border-top-left-radius:0px;
	-moz-border-radius-topleft:0px;
	border-top-left-radius:0px;
	-webkit-border-top-right-radius:0px;
	-moz-border-radius-topright:0px;
	border-top-right-radius:0px;
	-webkit-border-bottom-right-radius:0px;
	-moz-border-radius-bottomright:0px;
	border-bottom-right-radius:0px;
	-webkit-border-bottom-left-radius:0px;
	-moz-border-radius-bottomleft:0px;
	border-bottom-left-radius:0px;
	text-indent:0;
	border:1px solid #337fed;
	display:inline-block;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	font-style:normal;
	height:40px;
	line-height:40px;
	width:120px;
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0px #1570cd;
	}
	.boton:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #1e62d0), color-stop(1, #3d94f6) );
	background:-moz-linear-gradient( center top, #1e62d0 5%, #3d94f6 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0', endColorstr='#3d94f6');
	background-color:#1e62d0;
	}.boton:active {
	position:relative;
	top:1px;
	}
</style>

<!-- This goes in the document HEAD so IE7 and IE8 don't cry -->
<!--[if lt IE 9]>
	<style type="text/css">
	table.gradienttable th {
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d5e3e4', endColorstr='#b3c8cc',GradientType=0 );
	position: relative;
	z-index: -1;
	}
	table.gradienttable td {
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ebecda', endColorstr='#ceceb7',GradientType=0 );
	position: relative;
	z-index: -1;
	}
	</style>
<![endif]-->

<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
	table.gradienttable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
	}
	table.gradienttable th {
	padding: 0px;
	background: #d5e3e4;
	background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Q1ZTNlNCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjQwJSIgc3RvcC1jb2xvcj0iI2NjZGVlMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNiM2M4Y2MiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
	background: -moz-linear-gradient(top,  #d5e3e4 0%, #ccdee0 40%, #b3c8cc 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#d5e3e4), color-stop(40%,#ccdee0), color-stop(100%,#b3c8cc));
	background: -webkit-linear-gradient(top,  #d5e3e4 0%,#ccdee0 40%,#b3c8cc 100%);
	background: -o-linear-gradient(top,  #d5e3e4 0%,#ccdee0 40%,#b3c8cc 100%);
	background: -ms-linear-gradient(top,  #d5e3e4 0%,#ccdee0 40%,#b3c8cc 100%);
	background: linear-gradient(to bottom,  #d5e3e4 0%,#ccdee0 40%,#b3c8cc 100%);
	border: 1px solid #999999;
	}
	table.gradienttable td {
	padding: 0px;
	background: #ebecda;
	background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ViZWNkYSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjQwJSIgc3RvcC1jb2xvcj0iI2UwZTBjNiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNjZWNlYjciIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
	background: -moz-linear-gradient(top,  #ebecda 0%, #e0e0c6 40%, #ceceb7 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ebecda), color-stop(40%,#e0e0c6), color-stop(100%,#ceceb7));
	background: -webkit-linear-gradient(top,  #ebecda 0%,#e0e0c6 40%,#ceceb7 100%);
	background: -o-linear-gradient(top,  #ebecda 0%,#e0e0c6 40%,#ceceb7 100%);
	background: -ms-linear-gradient(top,  #ebecda 0%,#e0e0c6 40%,#ceceb7 100%);
	background: linear-gradient(to bottom,  #ebecda 0%,#e0e0c6 40%,#ceceb7 100%);
	border: 1px solid #999999;
	}
	table.gradienttable th p{
	margin:0px;
	padding:8px;
	border-top: 1px solid #eefafc;
	border-bottom:0px;
	border-left: 1px solid #eefafc;
	border-right:0px;
	}
	table.gradienttable td p{
	margin:0px;
	padding:8px;
	border-top: 1px solid #fcfdec;
	border-bottom:0px;
	border-left: 1px solid #fcfdec;;
	border-right:0px;
	}
</style>
<?php
	layout::menu();
	layout::ini_content();
?>
<center><h1>Facturaci&oacute;n Cargos Manuales</h1></center>
<?php
	$kores =estado_c::select2($_SESSION['MM_iduser']); 
	
	
	$caja_id = 0;
	foreach($kores as $korow);
	{
		$caja_id = $korow->caja_id;
		$nombre = $korow->nombre;
		
	}
	
	
	$keres =estado_c::select3();
	
	foreach($keres as $kerow)
	{
		
		$nombre_dia = $kerow->nombre;
		
	}
?>

<p>
	F8: Formas de Pago - F9: Imprimir Fiscal
</p>


<form name="facturacion" id="facturacion" action="enviar_factura_cargos.php" onkeypress="return anular(event)" method="post" onSubmit="popupform(this, 'join')" >
	<!-- popupform(this, 'join') -->
	<table border="0" cellspacing="20">
		<tr valign="top"><td>
			
			<p>&nbsp;</p>
			<table border="1" class="gradienttable">
				<th colspan="4"><h2>Datos del Cliente</h2></th>
				<tr><td width="91"><b>Cliente:</b></td>
					<td width="60"><input type="text" name="codigo_cliente" id="codigo_cliente" size="10" value="4"  /><input type="hidden" name="tipo_cliente" id="tipo_cliente" size="10"/></td>
				<td colspan="2"><input type="text" name="nombre_cliente" id="nombre_cliente" size="75" value="CONTADO ."  /></td></tr>
				<tr><td><b>Jubilado:</b></td>
					<td><input type="checkbox" name="jubilado" id="jubilado_check" value="S" onchange="fn_activa_descjub();" /></td>
					<td width="169" align="right"><b>C&eacute;dula o Cargo:</b></td>
				<td width="303"><input type="text" name="cedula" id="cedula" size="50" /></td></tr>
				<tr><td><b>Aseguradora:</b></td>
					<td><input type="checkbox" name="aseguradora" value="S" /></td>
					<td align="right"><b>Nombre de Aseguradora:</b></td>
				<td><input type="text" name="nombre_aseguradora" id="nombre_aseguradora" size="50" /><input type="hidden" name="codigo_aseguradora" id="codigo_aseguradora" size="50" /></td></tr>
				<tr><td><b>Descuento:</b></td>
					<td><input type="checkbox" name="descuento" value="S" id="descuento" onchange="valideopenerform()"  /><input type="hidden" name="telefono" id="telefono" size="50" />
					<input type="hidden" name="descuento_maximo" id="descuento_maximo" size="20"/></td>
					<td colspan="2"><input type="text" name="porcentaje_desc" id="porcentaje_desc" size="20" value="0" align="right" onchange="fn_check_maxdesc();" onKeyPress="return numbersonly(this, event)" disabled="disabled"/>&nbsp;%</td>
				</tr>
				<tr><td><b>Saldo Actual:</b></td>
					<td><input type="text" name="saldo_actual" id="saldo_actual" size="25" readonly /></td>
					<td align="right"><b>L&iacute;mite de Cr&eacute;dito:</b></td>
				<td><input type="text" name="limite_credito" id="limite_credito" size="25" readonly /></td></tr>
			</table>
			<p>&nbsp;</p>
			
			<p>&nbsp;</p>
			<table border="1" class="gradienttable">
				<th colspan="4"><h2>Añadir Artículos</h2></th>
				<tr><td><b>Cantidad:</b></td><td><input type="text" name="cantidad" id="cantidad" size="20" onKeyPress="return numbersonly(this, event)" value="1" autocomplete="off" /> <input type="hidden" name="tipo_impuesto" id="tipo_impuesto" size="20"  /> </td></tr>
				<tr><td><b>C&oacute;digo de Barra:</b></td><td><input type="text" name="codigo_de_barra" id="codigo_de_barra" size="30"  /> <input type="hidden" name="id_articulo" id="id_articulo" size="30"  /></td></tr>
				<tr><td><b>Artículo:</b></td><td><input type="text" name="articulo" id="articulo" size="75"  /> </td></tr>
				<tr><td><b>Precio:</b></td><td><input type="text" name="precio" id="precio" size="20" disabled="disabled" /> </td></tr>
				<tr><td><b>Descuento por Producto:</b></td><td><input type="checkbox" name="descuento_prod" value="S" id="descuento_prod" onchange="valideopenerform1()"  /><input type="text" name="descuento_producto" id="descuento_producto" size="20" value="0.00" onchange="fn_check_maxdesc_prod()" onKeyPress="return numbersonly(this, event)" disabled="disabled" /> %
					<input type="hidden" name="descuento_producto_max" id="descuento_producto_max" size="20" value="0.00" />
					<input type="hidden" name="jubilado_desc" id="jubilado_desc" size="20"  /> 
					<input type="hidden" name="descuento_total_u" id="descuento_total_u" size="20"  /> 
				</td></tr>
				<tr><td><b>Descuento por día <?php echo $nombre_dia; ?> </b> </td><td><input type="text" name="descuento_diario" id="descuento_diario" size="20" disabled="disabled"/>%</td></tr>
				<tr><td><input type="button" value="Agregar" name="agregar" id="agregar" class="boton" onClick="fn_agregar();"  /> <input name="limpiar" type="button" id="limpiar" value="Limpiar" onClick="limpiar_campos();" class="boton"/></td><td></td></tr>
			</table>
			<p>&nbsp;</p>
			<table id="grilla" class="gradienttable" border="1">
				<thead>
					<tr>
						<th>L&iacute;nea</th>
						<th>C&oacute;digo de Barra</th>
						<th>Art&iacute;culo</th>
						<th>Cantidad</th>
						<th>Precio Unitario</th>
						<th>Descuento Unitario</th>
						<th>ITBMS Unitario</th>
						<th>Precio Venta</th>
						<th></th>
						<!--  <th>Cantidad por Dosis</th> -->
						
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
					<!-- <tr>
						<td colspan="6"><strong>Cantidad:</strong> <span id="span_cantidad">0</span> medicamentos.</td>
					</tr> !-->
					<tr><td colspan="8"> <div id="results"></div></td></tr>
				</tfoot>
				
			</table>
		</p></td><td>
		<table border="1" class="gradienttable">
			<th colspan="2"><h2>Totales</h2></th>
			<tr><td>Sub Total</td><td><input type="text" name="sub_total" id="sub_total" size="10" value="0.00" class="txtComputer" readonly="readonly" /></td></tr>
			<tr><td>Descuento</td><td><input type="text" name="descuento_total" id="descuento_total" size="10" value="0.00"  class="txtComputer"  readonly="readonly"/></td></tr>
			<tr><td>ITBMS</td><td><input type="text" name="itbms_total" id="itbms_total" size="10" value="0.00" class="txtComputer"  readonly="readonly"/><input type="hidden" name="itbms_completo" id="itbms_completo" size="10" value="0.00" class="txtComputerTotal"/></td></tr>
			<tr><td>Total</td><td><input type="text" name="total" id="total" size="10" value="0.00" class="txtComputerTotal" readonly="readonly"/>
			<input type="hidden" name="total_completo" id="total_completo" size="10" value="0.00" class="txtComputerTotal"/></td></tr>
			
			
		</table>
		
		<p>&nbsp;</p>
		
		
		<table border="1" class="gradienttable">
			<th colspan="2"><h2>Formas de Pago</h2></th>
			<tr><td>Efectivo</td><td><input type="text" name="efectivo" id="efectivo" size="10" value="0.00" class="txtComputer" onclick="verifica_espacio(this);" onkeyup="AddComma(this);"  onKeyPress="return numbersonly(this, event)" onchange="fn_resta_saldo();" onblur="verifica_cero(this);" autocomplete="off" /></td></tr>
			<tr><td>Tarjeta de Crédito</td><td><input type="text" name="tarjeta_credito" id="tarjeta_credito" size="10" value="0.00" class="txtComputer" onclick="verifica_espacio(this);" onkeyup="AddComma(this);"  onKeyPress="return numbersonly(this, event)"  onchange="fn_resta_saldo();" onblur="verifica_cero(this);"autocomplete="off" />&nbsp;&nbsp;Ref.:<input type="text" name="ref_tdc" id="ref_tdc" size="10" autocomplete="off" /></td></tr>
			<tr><td>Clave</td><td><input type="text" name="clave" id="clave" size="10" value="0.00" class="txtComputer" onclick="verifica_espacio(this);" onkeyup="AddComma(this);" onKeyPress="return numbersonly(this, event)"  onchange="fn_resta_saldo();" onblur="verifica_cero(this);" autocomplete="off"/>&nbsp;&nbsp;Ref.:<input type="text" name="ref_tdb" id="ref_tdb" size="10" autocomplete="off" /></td></tr>
			<tr><td>Cr&eacute;dito</td><td><input type="text" name="credito" id="credito" size="10" value="0.00" class="txtComputer" onclick="verifica_espacio(this);" onkeyup="AddComma(this);"  onKeyPress="return numbersonly(this, event)"  onchange="fn_check_credito(); fn_resta_saldo();" onblur="verifica_cero(this);" autocomplete="off" /></td></tr>
			<tr><td>Cheque</td><td><input type="text" name="cheque" id="cheque" size="10" value="0.00" class="txtComputer" onclick="verifica_espacio(this);" onkeyup="AddComma(this);"  onKeyPress="return numbersonly(this, event)"  onchange="fn_resta_saldo();" onblur="verifica_cero(this);" autocomplete="off" />&nbsp;&nbsp;&nbsp;&nbsp;<br />No.de Cheque<input type="text" name="no_cheque" id="no_cheque" size="10"  onKeyPress="return numbersonly(this, event)" autocomplete="off"/>&nbsp;&nbsp;&nbsp;&nbsp;<br />Banco<input type="text" name="nombre_banco" id="nombre_banco" size="20" /></td></tr>
			<tr><td>Saldo</td><td><input type="text" name="saldo" id="saldo" size="10" value="0.00" class="txtComputerTotal" readonly/></td></tr>
			<tr><td>Vuelto</td><td><input type="text" name="vuelto" id="vuelto" size="10" value="0.00" class="txtComputerTotal" readonly/></td></tr>
			
			
		</table>
		
		<p></p>
		
		<input type="submit" name="imprimir" id="imprimir" value="Imprimir Fiscal" class="boton" disabled onClick="this.disabled=true; this.value='Imprimiendo…'; " />
		
		
		
		
		
		</td>
		
		
	</tr></table>
</form>
<?=layout::fin_content()?>
<script type="application/javascript">
	function button(){
		alert('funcion q deshabilita boton');
		
	}
</script>

<script type="text/javascript">
	function fn_check_maxdesc(){
		var descuento_maximo = facturacion.descuento_maximo.value * 100;
		var porcentaje_desc = facturacion.porcentaje_desc.value;
		
		if (porcentaje_desc > descuento_maximo) {
			alert('El descuento es mayor al máximo para el tipo de cliente!');
			facturacion.porcentaje_desc.value = descuento_maximo;
			return false;
			} else {
			
			return true;
		}
		
		}
	</script>
	
	<script type="text/javascript">
		function fn_check_maxdesc_prod(){
			var descuento_maximo = facturacion.descuento_producto_max.value;
			var porcentaje_desc = facturacion.descuento_producto.value;
			//alert("Descuento maximo: " + descuento_maximo);
			//alert("Porcentaje desc: " + porcentaje_desc);
			if (porcentaje_desc > descuento_maximo) {
				alert('El descuento es mayor al máximo para el tipo de producto!');
				facturacion.descuento_producto.value = descuento_maximo;
				return false;
				} else {
				
				return true;
			}
			
		}
	</script>
	
	<script type="text/javascript">
		function fn_activa_descjub(){
			if (facturacion.jubilado.checked == true){
				facturacion.porcentaje_desc.value = 20;
				} else {
				facturacion.porcentaje_desc.value = 0;
			}
			
			return true;
			
		}
	</script>
	
	<script type="text/javascript">
		function verifica_espacio(valor){
			if(valor.value == "0.00"){
				valor.value = " ";
			}
			
			return true;
			
		}
		
		function verifica_cero(valor){
			if(valor.value == " "){
				valor.value=="0.00";
			}						
			return true;
			
		}
		
		
	</script>
	
	
	
	
	<script type="text/javascript">
		function fn_carga_descuento(){
			if(facturacion.tipo_cliente.value != 5){
				facturacion.porcentaje_desc.value = facturacion.descuento_maximo.value * 100;
				} else {
				//alert('Es tipo contado');
				facturacion.porcentaje_desc.value = 0;
			} 
			
			return true;
			
		}
		
		
		
		
		
		
		
		
		function limpiar_campos()
		{
			
			document.getElementById('codigo_de_barra').value='';
			document.getElementById('id_articulo').value='';
			document.getElementById('articulo').value='';
			document.getElementById('precio').value='';
			document.getElementById('cantidad').value='1';
			document.getElementById('tipo_impuesto').value='';
			document.getElementById('descuento_prod').checked=false;
			document.getElementById('descuento_producto').value='';
			document.getElementById('descuento_producto_max').value='';
			
			
		}
	</script>
	
	
	<script type="text/javascript">
		function AddComma(text) {
			
			switch (text.value.length) {
				case 1:
				//document.getElementById("txtNumber").value = "0.0" + text.value;
				text.value = "0.0" + text.value
				break;
				default:
				var data = text.value.replace(".", "");
				var first = data.substring(0, (data.length - 2));
				var second = data.substring(data.length - 2);
				var temp = Math.abs(first) + "." + second;
				//document.getElementById("txtNumber").value = temp;
				text.value=temp;
			}
		}
	</script>
	
	<script type="text/javascript">
		function fn_check_credito(){
			var saldo_actual = facturacion.saldo_actual.value;
			var limite_credito  = facturacion.limite_credito.value;
			var credito  = facturacion.credito.value;
			var saldo_disponible = limite_credito - saldo_actual;
			
			if (credito > saldo_disponible) {
				alert('El crédito no puede ser mayor al disponible actual para el cliente!');
				facturacion.credito.value = 0;
				return false;
				} else {
				
				return true;
			}
			
		}
	</script>
	
	
	
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
			
			
			$("#articulo").autocomplete("get_articulo.php", {
				width: 500,
				matchContains: true,
				mustMatch: false,
				selectFirst: false
			});
			
			$("#articulo").result(function(event, data, formatted) {
				$("#id_articulo").val(data[1]);
				$("#codigo_de_barra").val(data[2]);
				$("#precio").val(data[3]);
				$("#tipo_impuesto").val(data[4]);
				$("#descuento_producto_max").val(data[5]);
				$("#jubilado_desc").val(data[6]);
				$("#descuento_diario").val(data[7]);
				$("#descuento_total_u").val(data[8]);
			});
			
			
			$("#articulo").keyup(function(event){
				if(event.keyCode == 13){
					$("#agregar").click();
				}});
				
				$("#efectivo").keyup(function(event){
					if(event.keyCode == 120){
						$("#efectivo").change();
						$("#imprimir").focus();
						$("#imprimir").click();
					}});
					
					$("#tarjeta_credito").keyup(function(event){
						if(event.keyCode == 120){
							// alert("length tdc: " + $("#ref_tdc").val().length);
							$("#tarjeta_credito").change();
							if($("#ref_tdc").val().length != 0){
							$("#imprimir").click(); }
						}});
						
						$("#ref_tdc").keyup(function(event){
							if(event.keyCode == 120){
								if($("#tarjeta_credito").val().length != 0){
								$("#imprimir").click(); }
							}});
							
							$("#clave").keyup(function(event){
								if(event.keyCode == 120){
									$("#clave").change();
									if($("#ref_tdb").val().length != 0){
									$("#imprimir").click(); }
								}});
								
								$("#ref_tdb").keyup(function(event){
									if(event.keyCode == 120){
										if($("#clave").val().length != 0){
										$("#imprimir").click(); }
									}});
									
									$("#cheque").keyup(function(event){
										if(event.keyCode == 120){
											$("#cheque").change();
											if($("#no_cheque").val().length != 0){
												if($("#nombre_banco").val().length != 0){
												$("#imprimir").click();}}
										}});
										
										$("#no_cheque").keyup(function(event){
											if(event.keyCode == 120){
												if($("#cheque").val().length != 0){
													if($("#nombre_banco").val().length != 0){
													$("#imprimir").click();}}
											}});
											
											$("#nombre_banco").keyup(function(event){
												if(event.keyCode == 120){
													if($("#cheque").val().length != 0){
														if($("#no_cheque").val().length != 0){
														$("#imprimir").click();}}
												}});
												
												
												
												
												
												$("#credito").keyup(function(event){
													if(event.keyCode == 120){
														$("#credito").change();
														$("#imprimir").click();
													}});
													
													/*
														$("#codigo_de_barra").autocomplete("get_articulo_barra.php", {
														width: 500,
														matchContains: true,
														mustMatch: false,
														selectFirst: true
														});
														
														
														$('#codigo_de_barra').bind('keypress', function(e) {
														var code = (e.keyCode ? e.keyCode : e.which);
														console.log('Entro a bind keypress');
														valorinput=$('#codigo_de_barra').val();
														if(code == $.ui.keyCode.ENTER) {
														console.log('Le dio enter a keybode');
														$(this).autocomplete("close");
														alert($('#codigo_de_barra').val());
														}
													});*/
													
													
													
													$("#codigo_de_barra").result(function(event, data, formatted) {
														$("#id_articulo").val(data[1]);
														$("#articulo").val(data[2]);
														$("#precio").val(data[3]);
														$("#tipo_impuesto").val(data[4]);
														$("#descuento_producto_max").val(data[5]);
														$("#jubilado_desc").val(data[6]);
														$("#descuento_diario").val(data[7]);
														$("#descuento_total_u").val(data[8]);
													});
													
													
													/*
														$("#codigo_de_barra").live('paste', function(event) {
														var _this = this;
														// Short pause to wait for paste to complete
														setTimeout( function() {
														var text = $(_this).val();
														$.getJSON("get_articulo_barra.php", { q: text, json: text}, function(data){
														
														
														console.log(data);
														$("#id_articulo").val(data.mid);
														$("#articulo").val(data.mdesc);
														$("#precio").val(data.mprecio);
														$("#tipo_impuesto").val(data.mtipoimp);
														$("#descuento_producto_max").val(data.mdescmax);
														$("#jubilado_desc").val(data.mjubilado);
														$("#descuento_diario").val(data.mdescdia);
														$("#descuento_total_u").val(data.mdesctotal);
														
														});
														
														}, 100);
													});*/
													
													
													/*function getInput(e){
														alert(inputText);
														$(e.target).unbind('keyup');
														$.get("get_articulo_barra.php", { q: pastedData, c: true}, function(data){
														$("#id_articulo").val(data.mid);
														$("#articulo").val(data.mdesc);
														$("#precio").val(data.mprecio);
														$("#tipo_impuesto").val(data.mtipoimp);
														$("#descuento_producto_max").val(data.mdescmax);
														$("#jubilado_desc").val(data.mjubilado);
														$("#descuento_diario").val(data.mdescdia);
														$("#descuento_total_u").val(data.mdesctotal);
														});
													}*/
													
													$("#codigo_de_barra").keyup(function(event){
														if(event.keyCode == 13){
															//alert($("#codigo_de_barra").val());
															$.get("get_articulo_barra.php", { q: $("#codigo_de_barra").val(), c: true}, function(data, formatted){
																//alert("data: " + data);
																str = data.split("|");			
																/*$("#id_articulo").val(data.mid);
																	$("#articulo").val(data.mdesc);
																	$("#precio").val(data.mprecio);
																	$("#tipo_impuesto").val(data.mtipoimp);
																	$("#descuento_producto_max").val(data.mdescmax);
																	$("#jubilado_desc").val(data.mjubilado);
																	$("#descuento_diario").val(data.mdescdia);
																$("#descuento_total_u").val(data.mdesctotal);*/
																$("#id_articulo").val(str[1]);
																$("#articulo").val(str[2]);
																$("#precio").val(str[3]);
																$("#tipo_impuesto").val(str[4]);
																$("#descuento_producto_max").val(str[5]);
																$("#jubilado_desc").val(str[6]);
																$("#descuento_diario").val(str[7]);
																$("#descuento_total_u").val(str[8]);
																$("#agregar").click();
															});
															
															} else if(event.keyCode == 119){
															$("#efectivo").focus();
														}
													});
													
													
													$("#codigo_cliente").autocomplete("get_personas.php", {
														width: 500,
														matchContains: true,
														mustMatch: false,
														selectFirst: true
													});
													
													$("#codigo_cliente").result(function(event, data, formatted) {
														$("#nombre_cliente").val(data[1]);
														$("#cedula").val(data[2]);
														$("#telefono").val(data[3]);
														$("#saldo_actual").val(data[4]);
														$("#descuento_maximo").val(data[5]);
														$("#tipo_cliente").val(data[6]);
														$("#limite_credito").val(data[7]);
														
														/*$("#alergias").val(data[2]);
															$("#peso").val(data[3]);
															$("#otros").val(data[4]);
															$("#compania_de_seguro").val(data[5]);
															$("#diabetes").val(data[6]);
															$("#hipertension").val(data[7]);
														$("#contraindicaciones").val(data[8]);*/
														
														
														if(document.getElementById('tipo_cliente').value != 5){
															document.getElementById('porcentaje_desc').value = document.getElementById('descuento_maximo').value*100;
															} else {
															document.getElementById('porcentaje_desc').value = 0;
														}
														
													});
													
													$("#nombre_cliente").autocomplete("get_personas_n.php", {
														width: 500,
														matchContains: true,
														mustMatch: false,
														selectFirst: true
													});
													
													$("#nombre_cliente").result(function(event, data, formatted) {
														$("#codigo_cliente").val(data[1]);
														$("#cedula").val(data[2]);
														$("#telefono").val(data[3]);
														$("#saldo_actual").val(data[4]);
														$("#descuento_maximo").val(data[5]);
														$("#tipo_cliente").val(data[6]);
														$("#limite_credito").val(data[7]);
														
														/*$("#alergias").val(data[2]);
															$("#peso").val(data[3]);
															$("#otros").val(data[4]);
															$("#compania_de_seguro").val(data[5]);
															$("#diabetes").val(data[6]);
															$("#hipertension").val(data[7]);
														$("#contraindicaciones").val(data[8]);*/
														if(document.getElementById('tipo_cliente').value != 5){
															document.getElementById('porcentaje_desc').value = document.getElementById('descuento_maximo').value*100;
															} else {
															document.getElementById('porcentaje_desc').value = 0;
														}
														
														
													});
													
													
													$("#nombre_aseguradora").autocomplete("get_aseguradoras.php", {
														width: 500,
														matchContains: true,
														mustMatch: true,
														selectFirst: true
													});
													
													$("#nombre_aseguradora").result(function(event, data, formatted) {
														$("#codigo_aseguradora").val(data[1]);
														$("#porcentaje_desc").val(data[2]);
														/*$("#alergias").val(data[2]);
															$("#peso").val(data[3]);
															$("#otros").val(data[4]);
															$("#compania_de_seguro").val(data[5]);
															$("#diabetes").val(data[6]);
															$("#hipertension").val(data[7]);
														$("#contraindicaciones").val(data[8]);*/
													});
													
													
													
													$("#clear").click(function() {
														$(":input").unautocomplete();
													});
													
													
		});
		
		
		
		
	</script>
	
	<script type="text/javascript">
		function modalWin(url) {
			if (window.showModalDialog) {
				window.showModalDialog(url,"name","dialogWidth:1500px;dialogHeight:600px");
				} else {
				alert(url);
				window.open(url,'name','height=600,width=1500,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
			}
		} </script>
		
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
				
				// decimal point jump
				else if (dec && (keychar == "."))
				{
					myfield.form.elements[dec].focus();
					return false;
				}
				else
				return false;
			}
			
			
			function popupform(myform, windowname)
			{
				
				if (! window.focus)return true;
				
				window.open('', windowname, 'width=800,height=500, toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
				myform.target=windowname;
				return true;
			}
			
			function FocusOnInput()
			{
				document.getElementById("codigo_de_barra").focus();
			}
			
			function anular(e) {
				tecla = (document.all) ? e.keyCode : e.which;
				return (tecla != 13);
			}
			
			
			function valideopenerform(){
				
				if(facturacion.descuento.checked == true){
					if(facturacion.nombre_cliente.value != ''){
						var popy= window.open('popup_autoriza.php','popup_form','location=no,menubar=no,status=no,top=50%,left=50%,height=150,width=200');
						} else {
						alert("No puede habilitar un descuento si no ha cargado al cliente!");
						facturacion.descuento.checked = false;
					}
					} else {
					facturacion.porcentaje_desc.value = 0;
					facturacion.porcentaje_desc.disabled = true;
					
				}
			}
			
			
			function valideopenerform1(){
				
				if(facturacion.descuento_prod.checked == true){
					if(facturacion.articulo.value != ''){
						
						var popy= window.open('popup_autoriza_prod.php','popup_form','location=no,menubar=no,status=no,top=50%,left=50%,height=150,width=200');
						} else {
						alert("No puede habilitar un descuento si no ha cargado el producto!");
						facturacion.descuento_prod.checked = false;
					}
					} else {
					facturacion.descuento_producto.value = 0;
					facturacion.descuento_producto.disabled = true;
				}
				
				
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
			//-->
		</SCRIPT>			
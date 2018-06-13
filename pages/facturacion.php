<?php
	include ('../clases/session.php'); 
	require_once('../modulos/facturacion.php');
	require_once('../modulos/menu.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
?>
<style>
	th {
    color: #ffffff;
    background-color: #003b66;
	text-align: center;	
	}
	table {
	margin-right: 20px;
	}
</style>
<?php
	layout::menu();
	layout::ini_content();
?>
<center><h1>Facturaci&oacute;n</h1></center>
<?php
	$cajas = factura::cajas($_SESSION['MM_iduser']);
	
	foreach($cajas as $cj){
		$caja_id = $cj->caja_id;
		$nombre = $cj->nombre;
	}
	
	if($caja_id != 0){
		
		$desc = factura::d_descuento();
		foreach($desc as $de){
			$nombre_dia = $de->nombre;
		}
	?>
	
	<p>
		Esta facturando en la caja: <?php echo $nombre; ?>, con el usuario: <?php echo $_SESSION['MM_iduser']; ?>.<br>
		F8: Formas de Pago - F9: Imprimir Fiscal
	</p>
	
	
	<form name="facturacion" id="facturacion" action="enviar_factura.php" onkeypress="return anular(event)" method="post" onSubmit="popupform(this, 'join')" >
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

<?php } else { echo "<p><h1>Usted no puede facturar si escogió la opción 'NINGUNA CAJA'. Si desea facturar debe salir del sistema y escoger la caja adecuada.</h1></p>";}  ?>

<?=layout::fin_content()?>
<script type='text/javascript' src='../js/facturacion/facturacion.js'></script>
<script language="javascript" type="text/javascript" src="../js/script_fact.js?r=<?=rand()?>"></script>
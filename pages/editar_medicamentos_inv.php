<?php
	ob_start();
	include ('./clases/session.php');
	//require_once('../modulos/editar_medicamentos_inv.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
?>
<h2>Editar Medicamentos - Precios</h2>
<div class="content_box_inner">
	
	
	<form id="form" name="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="438" height="69" border="0" cellspacing="0">
			<tr>
				<td height="33">Medicamento </td>
				<td><label><input type="text" name="medicamento" id="medicamento" size="85" /><input type="hidden" name="medicamento_id" id="medicamento_id" size="85" /></label></td>
			</tr>
			<tr>
				<td>C&oacute;digo de Barras</td>
				<td><label><input name="codigo_barras" id="codigo_barras" size="50" type="text" /></label></td>
			</tr>
			<tr>
				<td><input name="buscar" id="buscar"  type="submit" value="Modificar Medicamento" /></td>
				<td ><label>
					
					
					
					<input name="inventario_minimo" id="inventario_minimo" size="50" type="hidden" readonly />
					<input name="inventario_maximo" id="inventario_maximo" size="50" type="hidden" readonly />
					<input name="inventario_ideal" id="inventario_ideal" size="50" type="hidden" readonly />
					
					<input name="inventario_critico" id="inventario_critico" size="50" type="hidden" readonly />
					<input name="cantidad_inicial" id="cantidad_inicial" size="50" type="hidden" readonly />
					<input name="cantidad_factura" id="cantidad_factura" size="50" type="hidden" readonly />
					<input name="cantidad_devolucion" id="cantidad_devolucion" size="50" type="hidden" readonly />
					<input name="cantidad_existencia" id="cantidad_existencia" size="50" type="hidden" readonly />
					<input name="costo_unitario" id="costo_unitario" size="50" type="hidden" readonly />
					<input name="precio_unitario" id="precio_unitario" size="50" type="hidden" readonly />
					<input name="precio_unitario_pub" id="precio_unitario_pub" size="50" type="hidden" readonly />
					<input name="porcentaje_ganancia" id="porcentaje_ganancia" size="50" type="hidden" readonly />
				</label></td>
			</tr>
		</table>
		
		<p><label>
			
		</label>
		</form>
		
		<?php
			if (isset($_POST['buscar'])){
				
				
				$medic = $_POST['medicamento'];
				$medicamento_id = $_POST['medicamento_id'];
				$inventario_minimo = $_POST['inventario_minimo'];
				$inventario_maximo = $_POST['inventario_maximo'];
				$inventario_ideal = $_POST['inventario_ideal'];
				$inventario_critico = $_POST['inventario_critico'];
				$cantidad_inicial = $_POST['cantidad_inicial'];
				$cantidad_factura = $_POST['cantidad_factura'];
				$cantidad_devolucion = $_POST['cantidad_devolucion'];
				$costo_unitario = $_POST['costo_unitario'];
				$precio_unitario = $_POST['precio_unitario'];
				$porcentaje_ganancia = $_POST['porcentaje_ganancia'];
				$cantidad_existencia = $_POST['cantidad_existencia'];
				$precio_unitario_pub = $_POST['precio_unitario_pub'];
				
				echo   "<form id='form1' name='form1' method='post' action='actualizar_med_inv.php' onSubmit=\"popupform(this, 'join')\" >
				<table width='1200' height='69' border='0' cellspacing='0'>";
				
				echo "<tr><td width='150'>Nombre Medicamento</td>
				<td><label><input type='hidden' name='medicamento_id' id='medicamento_id' size='15' value='".$medicamento_id."' /><input name='medicamento' id='medicamento' size='120' type='text'  value='".$medic."' readonly /></label></td>
				</tr>";
				echo "<tr><td width='150'>Inventario M&iacute;nimo</td>
				<td><label><input name='inventario_minimo' id='inventario_minimo' size='15' type='text'  value='".$inventario_minimo."' /></label></td>
				</tr>";
				echo "<tr>
				<td width='150'>Inventario M&aacute;ximo</td> <td><label><input name='inventario_maximo' id='inventario_maximo' size='15' type='text'  value='".$inventario_maximo."' /></label></td>
				</tr>"; 
				echo "<tr>
				<td width='150'>Inventario Ideal</td> <td><label><input name='inventario_ideal' id='inventario_ideal' size='15' type='text'  value='".$inventario_ideal."' /></label></td>
				</tr>";
				echo "<tr>
				<td width='150'>Inventario Cr&iacute;tico</td> <td><label><input name='inventario_critico' id='inventario_critico' size='15' type='text'  value='".$inventario_critico."' /></label></td>
				</tr>";
				echo "<tr>
				<td width='150'>Compras</td> <td><label><input name='cantidad_inicial' id='cantidad_inicial' size='15' type='text'  value='".$cantidad_inicial."' readonly/></label></td>
				</tr>";
				echo "<tr>
				<td>Ventas</td> <td><label><input name='cantidad_factura' id='cantidad_factura' size='15' type='text'  value='".$cantidad_factura."' readonly /></label></td>
				</tr>";
				echo "<tr>
				<td>Devoluciones</td> <td><label><input name='cantidad_devolucion' id='cantidad_inicial' size='15' type='text'  value='".$cantidad_devolucion."' readonly /></label></td>
				</tr>";
				echo "<tr>
				<td>Existencia</td> <td><label><input name='existencia' id='existencia' size='15' type='text'  value='".$cantidad_existencia."' readonly  /></label></td>
				</tr>";
				echo "<tr>
				<td>Costo Unitario<td><label><input name='costo_unitario' id='costo_unitario' size='15' type='text'  value='".$costo_unitario."' /></label></td>
				</tr>";   echo "<tr>
				<td>Precio Unitario Hosp</td> <td><label><input name='precio_unitario' id='precio_unitario' size='15' type='text'  value='".$precio_unitario."'  /></label></td>
				</tr>";  echo "<tr>
				<td>Precio Unitario Pub</td> <td><label><input name='precio_unitario_pub' id='precio_unitario_pub' size='15' type='text'  value='".$precio_unitario_pub."'  /></label></td>
				</tr>";   echo "<tr>
				<td>Porcentaje de Ganancia</td> <td><label><input name='porcentaje_ganancia' id='porcentaje_ganancia' size='15' type='text'  value='".$porcentaje_ganancia."' /> % (De 0% a 200%) </label></td>
				</tr>";
				
			?>
			<tr><td></td>
				<td><label><input type="button" name="lotes" value="Revisar Lotes" id="lotes" onClick="javascript:popUp('lotes_activos.php?medicamento_id=<?php echo $medicamento_id; ?>')" /></label></td>
			</tr>
			<?php
				echo "<tr><td></td>
				<td><label><input name='actualizar' type='submit' value='Actualizar' /></label></td>
				</tr>";
				
				echo "</table>
				</form>";
			    
				
			}
			
			
			layout::fin_content();
		?>
		<script language="javascript" type="text/javascript">
			function clearText(field)
			{
				if (field.defaultValue == field.value) field.value = '';
				else if (field.value == '') field.value = field.defaultValue;
			}
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				
				//$("#form").validate();
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
					serviceUrl : 'get_medicamento_edit_inv.php',
					paramName : 'q',
					onSelect: function (data) {
						$("#medicamento_id").val(data.codigo_interno);
						$("#inventario_minimo").val(data.inventario_minimo);
						$("#inventario_maximo").val(data.inventario_maximo);
						$("#inventario_ideal").val(data.inventario_ideal);
						$("#inventario_critico").val(data.inventario_critico);
						$("#cantidad_inicial").val(data.cantidad_inicial);
						$("#cantidad_factura").val(data.cantidad_factura);
						$("#cantidad_devolucion").val(data.cantidad_devolucion);
						$("#costo_unitario").val(data.costo_unitario);
						$("#precio_unitario").val(data.precio_unitario);
						$("#porcentaje_ganancia").val(data.porc_ganancia);
						$("#codigo_barras").val(data.codigo_de_barra);
						$("#cantidad_existencia").val(data.cantidad_existencia);
						$("#precio_unitario_pub").val(data.precio_unitario_pub);						
					}
					
				});
				
				$("#codigo_barras").autocomplete({
					serviceUrl : 'get_barras_edit_inv.php',
					paramName : 'q',
					onSelect: function (data) {
						$("#medicamento").val(data.nombre);
						$("#medicamento_id").val(data.codigo_interno);
						$("#inventario_minimo").val(data.inventario_minimo);
						$("#inventario_maximo").val(data.inventario_maximo);
						$("#inventario_ideal").val(data.inventario_ideal);
						$("#inventario_critico").val(data.inventario_critico);
						$("#cantidad_inicial").val(data.cantidad_inicial);
						$("#cantidad_factura").val(data.cantidad_factura);
						$("#cantidad_devolucion").val(data.cantidad_devolucion);
						$("#costo_unitario").val(data.costo_unitario);
						$("#precio_unitario").val(data.precio_unitario);
						$("#porcentaje_ganancia").val(data.porc_ganancia);
						$("#cantidad_existencia").val(data.cantidad_existencia);
						$("#precio_unitario_pub").val(data.precio_unitario_pub);		
					}
					
				});
				
				
				$("#clear").click(function() {
					$(":input").unautocomplete();
				});
				
				
				
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
				
				window.open('', windowname, 'width=500,height=200, toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
				myform.target=windowname;
				return true;
			}
			
			
			// End -->
		</script>
		
		<script type="text/javascript">
			function modalWin(url) {
				if (window.showModalDialog) {
					window.showModalDialog(url,"name","dialogWidth:500px;dialogHeight:200px");
					} else {
					alert(url);
					window.open(url,'name','height=500,width=600,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
				}
			} 
		</script>				
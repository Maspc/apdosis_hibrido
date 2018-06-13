<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/editar_medicamentos_inv.php');
	require_once('../modulos/layout.php');
	layout::encabezado();

	layout::menu();
	layout::ini_content();
?>
<h2>Editar Art&iacute;culos - Inventario</h2>
<div class="content_box_inner">
	
	
	<form id="form" name="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table class="dtable" width="438" height="69" border="0" cellspacing="0">
			<tr>
				<td height="33">Artículo </td>
				<td><label><input type="text" name="medicamento" id="medicamento" size="85" /><input type="hidden" name="medicamento_id" id="medicamento_id" size="85" /></label></td>
			</tr>
			<tr>
				<td>C&oacute;digo de Barras</td>
				<td><label><input name="codigo_barras" id="codigo_barras" size="50" type="text" /></label></td>
			</tr>
			<tr>
				
				<td>	<p></p><input name="buscar" id="buscar"  type="submit" value="Modificar Art&iacute;culo" /></td>
				<td ><label>
					
					
					
					<input name="inventario_minimo" id="inventario_minimo" size="50" type="hidden" readonly />
					<input name="inventario_maximo" id="inventario_maximo" size="50" type="hidden" readonly />
					<input name="inventario_ideal" id="inventario_ideal" size="50" type="hidden" readonly />
					
					<input name="inventario_critico" id="inventario_critico" size="50" type="hidden" readonly />
					<input name="cantidad_inicial" id="cantidad_inicial" size="50" type="hidden" readonly />
					<input name="cantidad_factura" id="cantidad_factura" size="50" type="hidden" readonly />
					<input name="cantidad_devolucion" id="cantidad_devolucion" size="50" type="hidden" readonly />
					<input name="costo_unitario" id="costo_unitario" size="50" type="hidden" readonly />
					<input name="precio_unitario" id="precio_unitario" size="50" type="hidden" readonly />
					<input name="precio_publico" id="precio_publico" size="50" type="hidden" readonly />
					<input name="porcentaje_ganancia" id="porcentaje_ganancia" size="50" type="hidden" readonly />
					<input name="porc_vario" id="porc_vario" size="50" type="hidden" readonly />
				</label></td>
			</tr>
		</table>
		
		<p><label>
			
		</label>
		</form>
		
		<?php
			if (isset($_POST['buscar'])){
				if (!empty($_POST['medicamento'])) {
					
					$medic = $_POST['medicamento'];
					$codigo_de_barra = $_POST['codigo_barras'];
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
					$porc_vario= $_POST['porc_vario'];
					$cantidad_exist = $cantidad_inicial - $cantidad_factura + $cantidad_devolucion;
					
					$frow = emedica::select1($medicamento_id);
					foreach($frow as $fw){
						$existencia_tienda = $fw->existencia;
						$cantidad_inicial_tienda = $fw->cantidad_inicial;
						$cantidad_factura_tienda = $fw->cantidad_factura;
						$cantidad_devolucion_tienda = $fw->cantidad_devolucion;
						$inventario_minimo_tienda  = $fw->inventario_minimo;
						$inventario_maximo_tienda  = $fw->inventario_maximo;
						$inventario_ideal_tienda  = $fw->inventario_ideal;
						$inventario_critico_tienda  = $fw->inventario_critico;
						
					}											
					
					}else{
					
					$drow = emedica::select2($_POST['codigo_barras']);
					if (count($drow) > 0) {
						foreach($drow as $drw){
							$medic = $drw->nombre;
							$medicamento_id = $drw->codigo_interno;
							$codigo_de_barra = $drw->codigo_de_barra;
							$inventario_minimo = $drw->inventario_minimo;
							$inventario_maximo = $drw->inventario_maximo;
							$inventario_ideal = $drw->inventario_ideal;
							$inventario_critico = $drw->inventario_critico;
							$cantidad_inicial = $drw->cantidad_inicial;
							$cantidad_factura = $drw->cantidad_factura;
							$cantidad_devolucion = $drw->cantidad_devolucion;
							$costo_unitario = $drw->costo_unitario;
							$precio_unitario = $drw->precio_unitario;
							$porcentaje_ganancia = $drw->porc_ganancia;
							$porc_vario = $drw->porc_vario;
							$cantidad_exist = $cantidad_inicial - $cantidad_factura + $cantidad_devolucion;
							
							$frow = emedica::select3($medicamento_id);
							foreach($frow as $frw){
								$existencia_tienda = $frw->existencia;
								$cantidad_inicial_tienda = $frw->cantidad_inicial;
								$cantidad_factura_tienda = $frw->cantidad_factura;
								$cantidad_devolucion_tienda = $frw->cantidad_devolucion;	
								$inventario_minimo_tienda  = $frw->inventario_minimo;
								$inventario_maximo_tienda  = $frw->inventario_maximo;
								$inventario_ideal_tienda  = $frw->inventario_ideal;
								$inventario_critico_tienda  = $frw->inventario_critico;	
							}
						}
						
						} else {
						
						$medic = ' ';
						$codigo_de_barra = ' ';
						$medicamento_id = ' ';
						$inventario_minimo = ' ';
						$inventario_maximo = ' ';
						$inventario_ideal = ' ';
						$inventario_critico =' ';
						$cantidad_inicial = ' ';
						$cantidad_factura =' ';
						$cantidad_devolucion = ' ';
						$costo_unitario =' ';
						$precio_unitario = ' ';
						$porcentaje_ganancia = ' ';
						$cantidad_exist = ' ';
						$porc_vario = ' ';
					}
					
					
				}
				
				$info = "";
				if($cantidad_exist < $inventario_critico){
					$info .= "</br><font color='red'><b>La existencia es menor al inventario cr&iacute;tico, no podr&aacute; ser facturado</b></font>";
				} 
				
				if($porcentaje_ganancia == 0){
					$info .= "</br><font color='red'><b>El porcentaje de ganancia es cero, el precio ser&aacute; cero al momento de introducir una compra</b></font>";
				}
				
				if($precio_unitario == 0){
					$info .= "</br><font color='red'><b>El precio es igual a cero, no podr&aacute; ser facturado</b></font>";
				}
				
				if($costo_unitario == 0){
					$info .= "</br><font color='red'><b>El costo es igual a cero</b></font>";
				}
				
				if($inventario_critico == 0){
					$info .= "</br><font color='red'><b>El inventario cr&iacute;tico no deber&iacute;a ser igual cero</b></font>";
				}
				
				if($inventario_maximo == 0){
					$info .= "</br><font color='red'><b>El inventario m&aacute;ximo no deber&iacute;a ser igual cero</b></font>";
				}
				
				if($inventario_ideal == 0){
					$info .= "</br><font color='red'><b>El inventario ideal no debe ser cero, no aplica a la opci&oacute;n de pedido autom&acute;tico</b></font>";
				}
				
				echo "<p>".$info."</p>";
				
				echo   "<form id='form1' name='form1' method='post' action='actualizar_med_inv.php' onSubmit=\"popupform(this, 'join')\" >
				<table class='dtable' width='1200' height='69' border='0' cellspacing='0'>";
				
				echo "<tr><td width='200'>Nombre</td>
				<td><label><input type='hidden' name='medicamento_id' id='medicamento_id' size='15' value='".$medicamento_id."' /><input name='medicamento' id='medicamento' size='120' type='text'  value='".$medic."' readonly /></label></td>
				</tr>";
				echo "<tr><td width='200'>C&oacute;digo de Barra</td>
				<td><label><input name='codigo_de_barra' id='codigo_de_barra' size='15' type='text'  value='".$codigo_de_barra."' /></label></td>
				</tr>";
				echo "<tr><td width='200' bgcolor='#0099ff'>Inventario M&iacute;nimo Almacen</td>
				<td><label><input name='inventario_minimo' id='inventario_minimo' size='15' type='text'  value='".$inventario_minimo."' /></label></td>
				</tr>";
				echo "<tr>
				<td width='200' bgcolor='#0099ff'>Inventario M&aacute;ximo Almacen</td> <td><label><input name='inventario_maximo' id='inventario_maximo' size='15' type='text'  value='".$inventario_maximo."' /></label></td>
				</tr>"; 
				echo "<tr>
				<td width='200' bgcolor='#0099ff'>Inventario Ideal Almacen</td> <td><label><input name='inventario_ideal' id='inventario_ideal' size='15' type='text'  value='".$inventario_ideal."' /></label></td>
				</tr>";
				echo "<tr>
				<td width='200' bgcolor='#0099ff'>Inventario Cr&iacute;tico Almacen</td> <td><label><input name='inventario_critico' id='inventario_critico' size='15' type='text'  value='".$inventario_critico."' /></label></td>
				</tr>";
				echo "<tr>
				<td width='200' bgcolor='#0099ff'>Compras Almacen</td> <td><label><input name='cantidad_inicial' id='cantidad_inicial' size='15' type='text'  value='".$cantidad_inicial."' /></label></td>
				</tr>";
				echo "<tr>
				<td width='200' bgcolor='#0099ff'>Ventas Almacen</td> <td><label><input name='cantidad_factura' id='cantidad_factura' size='15' type='text'  value='".$cantidad_factura."' /></label></td>
				</tr>";
				echo "<tr>
				<td width='200' bgcolor='#0099ff'>Devoluciones Almacen</td> <td><label><input name='cantidad_devolucion' id='cantidad_inicial' size='15' type='text'  value='".$cantidad_devolucion."'  /></label></td>
				</tr>";
				echo "<tr>
				<td width='200' bgcolor='#0099ff'>Existencia Almacen</td> <td><label><input name='existencia'  id='existencia' size='15' type='text'  value='".$cantidad_exist."' readonly  /></label></td>
				</tr>";
				echo "<tr>
				<td width='200' bgcolor='#33cc33'>Inventario M&aacute;ximo Tienda</td> <td><label><input name='inventario_maximo_tienda' id='inventario_maximo_tienda' size='15' type='text'  value='".$inventario_maximo_tienda."' /></label></td>
				</tr>"; 
				echo "<tr>
				<td width='200' bgcolor='#33cc33'>Inventario Ideal Tienda</td> <td><label><input name='inventario_ideal_tienda' id='inventario_ideal_tienda' size='15' type='text'  value='".$inventario_ideal_tienda."' /></label></td>
				</tr>";
				echo "<tr>
				<td width='200' bgcolor='#33cc33'>Inventario Cr&iacute;tico Tienda</td> <td><label><input name='inventario_critico_tienda' id='inventario_critico_tienda' size='15' type='text'  value='".$inventario_critico_tienda."' /></label></td>
				</tr>";
				echo "<tr>
				<td width='200' bgcolor='#33cc33'>Compras Tienda</td> <td><label><input name='cantidad_inicial_tienda' id='cantidad_inicial_tienda' size='15' type='text'  value='".$cantidad_inicial_tienda."' /></label></td>
				</tr>";
				echo "<tr>
				<td width='200' bgcolor='#33cc33'>Ventas Tienda</td> <td><label><input name='cantidad_factura_tienda' id='cantidad_factura_tienda' size='15' type='text'  value='".$cantidad_factura_tienda."' /></label></td>
				</tr>";
				echo "<tr>
				<td width='200' bgcolor='#33cc33'>Devoluciones Tienda</td> <td><label><input name='cantidad_devolucion_tienda' id='cantidad_devolucion_tienda' size='15' type='text'  value='".$cantidad_devolucion_tienda."'  /></label></td>
				</tr>";
				echo "<tr>
				<td width='200' bgcolor='#33cc33'>Existencia Tienda</td> <td><label><input name='existencia_tienda' id='existencia_tienda' size='15' type='text'  value='".$existencia_tienda."' readonly  /></label></td>
				</tr>";
				echo "<tr>
				<td width='200'>Costo Unitario<td><label><input name='costo_unitario' id='costo_unitario' size='15' type='text'  value='".$costo_unitario."' /></label></td>
				</tr>";   echo "<tr>
				<td width='200'>Precio Unitario</td> <td><label><input name='precio_unitario' id='precio_unitario' size='15' type='text'  value='".$precio_unitario."'  /></label></td>
				</tr>";   echo "<tr>
				<td width='200'>Porcentaje de Ganancia</td> <td><label><input type='checkbox' name='porc_vario' id='porc_vario' value='S' "; if($porc_vario =='S'){ echo " checked"; }  echo " /><input name='porcentaje_ganancia' id='porcentaje_ganancia' size='15' type='text'  value='".$porcentaje_ganancia."' /> % (De 0% a 200%) </label></td> *Con el check marcado, este producto no cambiara de porcentaje al momento de actualizar los grupos.
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
			
		?>         
		
		<div class="cleaner"></div>
	</div>
	
</div>
<?=layout::fin_content()?>
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
			$("#precio_publico").val(data.precio_publico);
			$("#porc_vario").val(data.porc_vario);
			}			
			
		});
		
		$("#codigo_barras").autocomplete({
			serviceUrl : 'get_barras_edit_inv.php',
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
			$("#medicamento").val(data.nombre);
			$("#precio_publico").val(data.precio_publico);
			$("#porc_vario").val(data.porc_vario);
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
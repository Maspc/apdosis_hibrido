<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/editar_medicamentos_lotes.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
?>
<h2>Editar Medicamentos - Lotes</h2>
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
				
				echo   "<form id='form1' name='form1' method='post' action='actualizar_med_inv.php' onSubmit=\"popupform(this, 'join')\" >
				<table width='1200' height='69' border='0' cellspacing='0'>";
				
				echo "<tr><td width='150'>Nombre Medicamento</td>
				<td><label><input type='hidden' name='medicamento_id' id='medicamento_id' size='15' value='".$medicamento_id."' /><input name='medicamento' id='medicamento' size='120' type='text'  value='".$medic."' readonly /></label></td>
				</tr>";
				echo "<tr>
				<td>Existencia</td> <td><label><input name='existencia' id='existencia' size='15' type='text'  value='".$cantidad_existencia."' readonly  /></label></td>
				</tr>";
				
				
			?>
			<tr><td></td>
				<td><label><input type="button" name="lotes" value="Ajustar Lotes" id="lotes" onClick="javascript:popUp('lotes_modificar.php?medicamento_id=<?php echo $medicamento_id; ?>&existencia=<?php echo $cantidad_existencia; ?>')" /></label></td>
			</tr>
			<?php
				
				
				echo "</table>
				</form>";
			    
				
			}
			
		?>         
		
		<div class="cleaner"></div>
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
		$().ready(function() {
			
			$("#form").validate();
			function log(event, data, formatted) {
				$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
			}
			
			function formatItem(row) {
				return row[0] + " (<strong>id: " + row[1] + "</strong>)";
			}
			function formatResult(row) {
				return row[0].replace(/(<.+?>)/gi, '');
			}
			
			
			$("#medicamento").autocomplete("get_medicamento_edit_inv.php", {
				width: 500,
				matchContains: true,
				mustMatch: false,
				selectFirst: false
			});
			
			$("#codigo_barras").autocomplete("get_barras_edit_inv.php", {
				width: 500,
				matchContains: true,
				mustMatch: false,
				selectFirst: false
			});
			
			
			$("#medicamento").result(function(event, data, formatted) {
				$("#medicamento_id").val(data[1]);
				$("#inventario_minimo").val(data[2]);
				$("#inventario_maximo").val(data[3]);
				$("#inventario_ideal").val(data[4]);
				$("#inventario_critico").val(data[5]);
				$("#cantidad_inicial").val(data[6]);
				$("#cantidad_factura").val(data[7]);
				$("#cantidad_devolucion").val(data[8]);
				$("#costo_unitario").val(data[9]);
				$("#precio_unitario").val(data[10]);
				$("#porcentaje_ganancia").val(data[11]);
				$("#codigo_barras").val(data[12]);
				$("#cantidad_existencia").val(data[13]);
				
				
				
			});
			
			$("#codigo_barras").result(function(event, data, formatted) {
				$("#medicamento").val(data[1]);
				$("#medicamento_id").val(data[2]);
				$("#inventario_minimo").val(data[3]);
				$("#inventario_maximo").val(data[4]);
				$("#inventario_ideal").val(data[5]);
				$("#inventario_critico").val(data[6]);
				$("#cantidad_inicial").val(data[7]);
				$("#cantidad_factura").val(data[8]);
				$("#cantidad_devolucion").val(data[9]);
				$("#costo_unitario").val(data[10]);
				$("#precio_unitario").val(data[11]);
				$("#porcentaje_ganancia").val(data[12]);
				$("#cantidad_existencia").val(data[13]);	
				
				
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
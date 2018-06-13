<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/consulta_medicamentos.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
?>
<h2>Editar Medicamentos - Inventario</h2>
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
				<td>Tipo de Consulta</td>
				<td><label><select name="tipo" id="tipo"><option value="0">Escoger...</option><option value="1">Contraindicaciones</option><option value="2">Existencia</option><option value="3">Precio</option></select></label></td>
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
				
				$tipo = $_POST['tipo'];	  
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
				$codigo_de_barra = $_POST['codigo_barras'];
				
				
				
				
				echo   "<table width='1200' height='69' border='0' cellspacing='0'>";
				
				echo "<tr><td width='150'>Nombre Medicamento</td>
				<td><label><input type='hidden' name='medicamento_id' id='medicamento_id' size='15' value='".$medicamento_id."' /><input name='medicamento' id='medicamento' size='120' type='text'  value='".$medic."' readonly /></label></td>
				</tr>";
				
				$gres = consultar_m::select1($codigo_de_barra);
				
				if($tipo == 0) {
				echo "<p>No escogi&oacute; ninguna opci&oacute;n</p>";}
				if($tipo == 1) {
					echo "<tr>
					<td>Contraindicaciones: </td><td>";
					foreach($gres as $grow){
						echo "<ul>".$grow->descripcion."</ul>";
					}
					echo"</td>
					</tr>";
				}	
				if($tipo == 2) {
					echo "<tr>
					<td>Existencia</td> <td><label><input name='existencia' id='existencia' size='15' type='text'  value='".$cantidad_existencia."' readonly  /></label></td>
				</tr>";}
				if($tipo == 3) {
					echo "<tr>
					<td>Precio Unitario</td> <td><label><input name='precio_unitario' id='precio_unitario' size='15' type='text'  value='".$precio_unitario."' readonly /></label></td>
					</tr>"; 
				}
				
			?>
			
			<?php
				
				
				echo "</table>
				</form>";
				
				
			}
			
		?>         
		
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
						
			
			$('#medicamento').autocomplete({
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
					//$("#cantidad_existencia").val(data.codigo_interno);					
				}
				
			});
			
			$('#codigo_barras').autocomplete({
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
					$("#codigo_barras").val(data.codigo_de_barra);
					//$("#cantidad_existencia").val(data.codigo_interno);
					
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/editar_medicamentos_estado.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
?>
<h2>Editar Art&iacute;culos - Eliminar / Inactivar</h2>
<div class="content_box_inner">
	
	
	<form id="form" name="form" method="post" action="<?=$_SERVER['PHP_SELF']?>">
		<table width="438" height="69" border="0" cellspacing="0">
			<tr>
				<td height="33">Art&iacute;culo</td>
				<td><label><input type="text" name="medicamento" id="medicamento" size="85" /><input type="hidden" name="medicamento_id" id="medicamento_id" size="85" /></label></td>
			</tr>
			<tr>
				<td>C&oacute;digo de Barras</td>
				<td><label><input name="codigo_barras" id="codigo_barras" size="50" type="text" /></label></td>
			</tr>
			<tr>
				<td><input name="buscar" id="buscar"  type="submit" value="Modificar Medicamento" /></td>
				<td ><label>
					
					
					
					<input name="estado_med" id="estado_med" size="50" type="hidden" readonly />
					
					
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
				$estado_med = $_POST['estado_med'];
				
				
				
				echo   "<form id='form1' name='form1' method='post' action='actualizar_med_estado.php' onSubmit=\"popupform(this, 'join')\" >
				<table width='1200' height='69' border='0' cellspacing='0'>";
				
				echo "<tr><td width='150'>Nombre Art&iacute;culo</td>
				<td><label><input type='hidden' name='medicamento_id' id='medicamento_id' size='15' value='".$medicamento_id."' /><input name='medicamento' id='medicamento' size='120' type='text'  value='".$medic."' readonly /></label></td>
				</tr>";
			echo "<tr><td>Estado de Art&iacute;culo</td>";?>
			<td><label><select name="estado_med"> 
				<option value="A" <? if ('A'  == $estado_med) { echo ' selected'; }  ?> >Activo</option>
				<option value="I" <? if ('I'  == $estado_med) { echo ' selected'; }  ?> >Inactivo</option>
			</select></label></td>
		</tr>
		
		<tr><td>Eliminar Art&iacute;culo: </td>
			<td><label><input type="button" name="borrar" id="borrar" value="Borrar Art&iacute;culo" id="borrar" onClick="javascript:popUp('borrar_medicamento.php?medicamento_id=<?php echo $medicamento_id; ?>')"  /></label> * Solo podrá borrar un art&iacute;culo si el mismo no tiene ninguna transacción en el Sistema ni posea inventario. </td>
			<p>
				<p>
				</tr>
				<?php
					echo "<tr><td></td>
					<td><p><p><label><input name='actualizar' type='submit' value='Actualizar' /></label></td>
					</tr>";
					
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
		
		<script language="javascript" type="text/javascript">
			function botonBanco()
			{
				if (document.getElementById("banco").checked==true) {
					document.getElementById("borrar").disabled=true;
					document.getElementById("borrarbanco").disabled=false;
					} else {
					document.getElementById("borrar").disabled=false;
					document.getElementById("borrarbanco").disabled=true;
				}
			}
			
			function botonSistema()
			{
				if (document.getElementById("sistema").checked==true) {
					document.getElementById("borrar").disabled=false;
					document.getElementById("borrarbanco").disabled=true;
					} else {
					document.getElementById("borrar").disabled=true;
					document.getElementById("borrarbanco").disabled=false;
				}
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
					serviceUrl : 'get_medicamento_edit_estado.php',
					paramName : 'q',
					onSelect: function (data) {
						$("#medicamento_id").val(data.codigo_interno);
					    $("#codigo_barras").val(data.codigo_de_barra);
					    $("#estado_med").val(data.estado_med);
					}
				});
				
				$("#codigo_barras").autocomplete({
					serviceUrl : 'get_barras_edit_estado.php',
					paramName : 'q',
					onSelect: function (data) {
						$("#medicamento_id").val(data.codigo_interno);
					    $("#medicamento").val(data.nombre);
					    $("#estado_med").val(data.estado_med);
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
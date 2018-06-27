<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/editar_medicamentos_us.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
?>
<center> <h1>Editar Medicamentos</h1></center>
<div class="content_box_inner">
	
	
	<form id="form" name="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="438" height="69" border="0" cellspacing="0">
			<tr>
				<td height="33">Medicamento </td>
				<td><label><input type="text" name="medicamento" id="medicamento" size="85" /><input type="hidden" name="medicamento_id" id="medicamento_id" size="85" /></label></td>
			</tr>
			<tr>
				<td>C&oacute;digo de Barras</td>
				<td><label><input name="codigo_barras" id="codigo_barras" size="50" type="text"  /><input name="descri_forma" id="descri_forma" size="50" type="hidden"  readonly /> <input name="forma_farma" id="forma_farma" size="50" type="hidden"  readonly /></label></td>
			</tr>
			<tr>
				<td></td>
				<td><label>
					<input name="tipo_posologia" id="tipo_posologia" size="50" type="hidden" readonly />
					<input name="tipo_de_dosis" id="tipo_de_dosis" size="50" type="hidden" readonly />
					<input name="posologia" id="posologia" size="50" type="hidden" readonly />
					
					<input name="precio_unitario" id="precio_unitario" size="50" type="hidden" readonly />
					<input name="nombre_comercial" id="nombre_comercial" size="50" type="hidden" readonly />
					<input name="nombre_generico" id="nombre_generico" size="50" type="hidden" readonly />
					<input name="presentacion" id="presentacion" size="50" type="hidden" readonly />
					<input name="codigo_presentacion" id="codigo_presentacion" size="50" type="hidden" readonly />
					<input name="cantidad_x_empaque" id="cantidad_x_empaque" size="50" type="hidden" readonly />
					<input name="volumen" id="volumen" size="50" type="hidden" readonly />
					<input name="fabricante" id="fabricante" size="50" type="hidden" readonly />
					<input name="codigo_fabricante" id="codigo_fabricante" size="50" type="hidden" readonly />
					<input name="costo_unitario" id="costo_unitario" size="50" type="hidden" readonly />
					<input name="costo_caja" id="costo_caja" size="50" type="hidden" readonly />
					<input name="precio_caja" id="precio_caja" size="50" type="hidden" readonly />
					<input name="cantidad_inicial" id="cantidad_inicial" size="50" type="hidden" readonly />
					<input name="tipo_dosis" id="tipo_dosis" size="50" type="hidden" readonly />
					<input name="descr_tipo_dosis" id="descr_tipo_dosis" size="50" type="hidden" readonly />
					<input name="antibiotico" id="antibiotico" size="50" type="hidden" readonly />
					<input name="narcotico" id="narcotico" size="50" type="hidden" readonly />
					<input name="preparacion" id="preparacion" size="50" type="hidden" readonly />
					<input name="devolver" id="devolver" size="50" type="hidden" readonly />	
					<input name="codigo_proveedor" id="codigo_proveedor" size="50" type="hidden" readonly />
					<input name="tipo_volumen" id="tipo_volumen" size="50" type="hidden" readonly />
					<input name="grupo_medicamento" id="grupo_medicamento" size="50" type="hidden" readonly />
					<input name="multiple_principio" id="multiple_principio" size="50" type="hidden" readonly />
					<input name="tipo_impuesto" id="tipo_impuesto" size="50" type="hidden" readonly />
					<input name="estado_med" id="estado_med" size="50" type="hidden" readonly />
					<input name="importacion" id="importacion" size="50" type="hidden" readonly />
					<input name="precio_publico" id="precio_publico" size="50" type="hidden" readonly />
					<input name="jubilado" id="jubilado" size="50" type="hidden" readonly />
					<input name="descuento_total" id="descuento_total" size="50" type="hidden" readonly />
					<input name="cant_max_prov" id="cant_max_prov" size="50" type="hidden" readonly />
					<input name="anaquel" id="anaquel" size="50" type="hidden" readonly />
					<input name="precio_unitario_pub" id="precio_unitario_pub" size="50" type="hidden" readonly />
					<input name="prod_hosp" id="prod_hosp" size="50" type="hidden" readonly />
					<input name="prod_pub" id="prod_pub" size="50" type="hidden" readonly />
				<input name="buscar" id="buscar"  type="submit" value="Modificar Medicamento" /></label></td>
			</tr>
		</table>
		
		<p><label>
			
		</label>
		</form>
		
		<?php
			if (isset($_POST['buscar'])){
				if (!empty($_POST['medicamento'])) {
					$medic = $_POST['medicamento'];
					$medicamento_id = $_POST['medicamento_id'];
					$descri_forma = $_POST['descri_forma'];
					$forma_farma = $_POST['forma_farma'];
					$precio_unitario = $_POST['precio_unitario'];
					$tipo_posologia = $_POST['tipo_posologia'];
					$tipo_de_dosis = $_POST['tipo_de_dosis'];
					$posologia = $_POST['posologia'];
					$codigo_barras = $_POST['codigo_barras'];
					$precio_unitario = $_POST['precio_unitario'];
					$nombre_comercial = $_POST['nombre_comercial'];
					$nombre_generico = $_POST['nombre_generico'];
					$presentacion = $_POST['presentacion'];
					$codigo_presentacion = $_POST['codigo_presentacion'];
					$cantidad_x_empaque = $_POST['cantidad_x_empaque'];
					$volumen = $_POST['volumen'];
					$fabricante = $_POST['fabricante'];
					$codigo_fabricante = $_POST['codigo_fabricante'];
					$costo_unitario = $_POST['costo_unitario'];
					$costo_caja = $_POST['costo_caja'];
					$precio_caja = $_POST['precio_caja'];
					$cantidad_inicial = $_POST['cantidad_inicial'];
					$tipo_dosis = $_POST['tipo_dosis'];
					$descr_tipo_dosis = $_POST['descr_tipo_dosis'];
					$antibiotico = $_POST['antibiotico'];
					$narcotico = $_POST['narcotico'];
					$preparacion = $_POST['preparacion'];
					$devolver = $_POST['devolver'];
					$codigo_proveedor = $_POST['codigo_proveedor'];
					$tipo_volumen = $_POST['tipo_volumen'];
					$grupo_medicamento = $_POST['grupo_medicamento'];
					$multiple_principio = $_POST['multiple_principio'];
					$tipo_impuesto = $_POST['tipo_impuesto'];
					$estado_med = $_POST['estado_med'];
					$importacion = $_POST['importacion'];
					$precio_publico = $_POST['precio_publico'];
					$jubilado = $_POST['jubilado'];
					$descuento_total = $_POST['descuento_total'];
					$cant_max_prov = $_POST['cant_max_prov'];
					$anaquel = $_POST['anaquel'];
					$precio_unitario_pub = $_POST['precio_unitario_pub'];
					$prod_hosp = $_POST['prod_hosp'];
					$prod_pub = $_POST['prod_pub'];
					
					} else {
					//si lo leo dsede el lector
					
					$dres=emedica::select1($_POST['codigo_barras']);
					
					
					
					
					$dnum = count($dres);
					
					if ($dnum > 0) {
						foreach( $dres as $drow)
						{
							$medic = $drow->nombre;
							$medicamento_id = $drow->codigo_interno;
							$descri_forma = $drow->forma_descri;
							$forma_farma = $drow->forma_farma;
							$precio_unitario = $drow->precio_unitario;
							$tipo_posologia = $drow->tipo_posologia;
							$tipo_de_dosis = $drow->tipo_de_dosis;
							$posologia = $drow->posologia;
							$codigo_barras = $drow->codigo_de_barra;
							$precio_unitario = $drow->precio_unitario;
							$nombre_comercial = $drow->nombre_comercial;
							$nombre_generico = $drow->nombre_generico;
							$presentacion = $drow->descr_presentacion;
							$codigo_presentacion = $drow->presentacion;
							$cantidad_x_empaque = $drow->cantidad_x_empaque;
							$volumen = $drow->volumen;
							$fabricante = $drow->descr_fabricante;
							$codigo_fabricante = $drow->fabricante;
							$costo_unitario = $drow->costo_unitario;
							$costo_caja = $drow->costo_caja;
							$precio_caja = $drow->precio_caja;
							$cantidad_inicial = $drow->cantidad_inicial;
							$tipo_dosis = $drow->tipo_de_dosis;
							$descr_tipo_dosis = $drow->descr_tipo_dosis;
							$antibiotico = $drow->antibiotico;
							$narcotico = $drow->narcotico;
							$preparacion = $drow->preparacion;
							$devolver = $drow->permite_devol;
							$codigo_proveedor = $drow->codigo_proveedor;
							$tipo_volumen = $drow->tipo_volumen;
							$grupo_medicamento = $drow->grupo_medicamento;
							$multiple_principio = $drow->multiple_principio;
							$tipo_impuesto = $drow->tipo_impuesto;
							$estado_med = $drow->estado_med;
							$importacion = $drow->importacion;
							$precio_publico= $drow->precio_publico;
							$jubilado= $drow->jubilado;
							$descuento_total= $drow->descuento_total;
							$cant_max_prov= $drow->cant_max_prov;
							$anaquel =$drow->ubicacion;
							$precio_unitario_pub =$drow->precio_unitario_pub;
							$prod_hosp =$drow->prod_hosp;
							$prod_pub =$drow->prod_pub;
							
						}
						} else {
						
						$medic = ' ';
						$medicamento_id = ' ';
						$descri_forma = ' ';
						$forma_farma = ' ';
						$precio_unitario = ' ';
						$tipo_posologia = ' ';
						$tipo_de_dosis = ' ';
						$posologia = ' ';
						$codigo_barras = ' ';
						$precio_unitario = ' ';
						$nombre_comercial = ' ';
						$nombre_generico = ' ';
						$presentacion = ' ';
						$codigo_presentacion = ' ';
						$cantidad_x_empaque = ' ';
						$volumen = ' ';
						$fabricante = ' ';
						$codigo_fabricante = ' ';
						$costo_unitario = ' ';
						$costo_caja = ' ';
						$precio_caja = ' ';
						$cantidad_inicial = ' ';
						$tipo_dosis = ' ';
						$descr_tipo_dosis = ' ';
						$antibiotico = ' ';
						$narcotico = ' ';
						$preparacion = ' ';
						$devolver = ' ';
						$codigo_proveedor = ' ';
						$tipo_volumen = ' ';
						$grupo_medicamento = ' ';
						$multiple_principio = ' ';
						$tipo_impuesto = ' ';
						$estado_med = ' ';
						$importacion = ' ';
						$precio_publico= ' ';
						$jubilado= ' ';
						$descuento_total=' ';
						$cant_max_prov= ' ';
						$anaquel =' ';
						$precio_unitario_pub = ' ';
						$prod_hosp = ' ';
						$prod_pub = ' ';
						
						
						
					}
					
					
				}
				
				$prin = 0;
				
				
				$fres=emedica::select2($medicamento_id);
				foreach($fres as frow)
				{
					$prin = $frow->ste;
				}
				
				
				
				echo   "<form id='form1' name='form1' method='post' action='actualizar_med_us.php' onSubmit=\"popupform(this, 'join')\" >
				<table width='600' height='69' border='0' cellspacing='0'>";
				echo "<tr>
				<td height='33'>Codigo de Barras </td>";
				echo "<td><label><input type='text' name='codigo_barras' id='codigo_barras' size='15' value='".$codigo_barras."' /><input type='hidden' name='medicamento_id' id='medicamento_id' size='15' value='".$medicamento_id."' /></label></td>
				</tr>";
				
				echo "<tr><td>Nombre Generico</td>
				<td><label><input name='nombre_generico' id='nombre_generico' size='50' type='text'  value='".$nombre_generico."' /></label>*No se grabar&aacute;n los caracteres especiales doble comillas o comillas</td>
				</tr>";
				echo "<tr><td>Nombre Comercial</td>
				<td><label><input name='nombre_comercial' id='nombre_comercial' size='50' type='text'  value='".$nombre_comercial."' /></label>*No se grabar&aacute;n los caracteres especiales doble comillas o comillas</td>
				</tr>";
				echo "<tr><td>Codigo Proveedor</td>
				<td><label><input name='codigo_proveedor' id='codigo_proveedor' size='50' type='text'  value='".$codigo_proveedor."' /></label></td>
				</tr>";
				echo "<tr>
			<td>Forma Farmceutica</td>"; ?>
			<td><label><select name="forma_farmaceutica"> <?php 
				
				$resul = emedica::select3();      
				foreach($resul as $cols)
				{	  
				?> 
				<option value="<? echo $cols->codigo_forma ?>"
				<? if ($cols->codigo_forma  == $forma_farma)
					{ echo ' selected'; }  ?>><? echo
						
					$cols->descripcion ?></option>
			<?php } ?> </select></label></td>
			</tr> <?php
			
			echo "<tr><td>Multiple Principio Activo</td>
			<td><label><input name='multiple_principio' size='50' type='checkbox'   value='S' "; if ($multiple_principio == 'S') {echo ' checked';}  echo "  /></label> &nbsp;&nbsp; <input type='button' name='agregar_princincipios' value='Agregar Principios Activos'  onClick=\"javascript:popUp('actualizar_principios.php?medicamento_id=".$medicamento_id."&men=0')\" />";
			if($prin == 0){
				echo "<font color='green'>*Este medicamento no tiene principios activos agregados! Verifique!</font>";
			}
			echo "    </td>
			</tr>";
		echo "<tr><td>Concentraci&oacute;n</td>";?>
		<td><input name='posologia' size='15' type='text'  value='<?php echo $posologia; ?>' /><label><select name="tipo_posologia"> <?php 
			
			$resul = emedica::selectn();        
			foreach( $resul  as $cols)
			{	  
			?>
			<option value="<? echo $cols->codigo_posologia ?>" <? if ($cols->codigo_posologia  == $tipo_posologia) { echo ' selected'; }  ?>><? echo $cols->descripcion ?></option>
		<?php } ?> </select></label></td>
		</tr> <?php 
	echo "<tr><td>Presentacion</td>";?>
    <td><label><select name="presentacion"> <?php
		
		$resul= emedica::select4();       
		foreach($resul as $cols)
		{	  
		?>
		<option value="<? echo $cols->codigo_presentacion ?>" <? if ($cols->codigo_presentacion  == $codigo_presentacion) { echo ' selected'; }  ?>><? echo $cols->descripcion ?></option>
	<?php } ?> </select></label></td>
	</tr> <?php "<tr><td>Cantidad por Empaque</td>
    <td><label><input name='cantidad_x_empaque' size='15' type='text'  value='".$cantidad_x_empaque."'/></label></td>
	</tr>";
	
	
echo "<tr><td>Grupo de Medicamentos</td>";?>
<td><label><select name="grupo_medicamento"> <?php 
	
	$resulv=emedica::select5();       
	foreach($resulv as $colsv )
	{	  
	?>
	<option value="<? echo $colsv->codigo_grupo ?>" 
	<? if ($colsv->codigo_grupo  == $grupo_medicamento) 
		{ echo ' selected'; }  ?>><? echo $colsv->descripcion
		?></option>
<?php } ?> </select></label></td>
</tr>


<?php
echo "<tr><td>Volumen</td>";?>
<td><input name='volumen' size='15' type='text'  value='<?php echo $volumen; ?>' /><label><select name="tipo_volumen"> <?php 
	
	$resul9=emedica::select6();   
	foreach($resul9 as $cols9)
	{	  
	?>
	<option value="<? echo $cols9->codigo_posologia ?>" 
	<? if ($cols9->codigo_posologia  == $tipo_volumen) 
		{ echo ' selected'; }  ?>><? echo $cols9->descripcion
		?></option>
<?php } ?> </select></label></td>
</tr> <?php
echo "<tr><td>Fabricante</td>";?>
<td><label><select name="fabricante"> <?php 
	
	$resul= emedica::select7();        
	foreach( $resul as $cols)
	{
	?>
	<option value="<? echo $cols->codigo_fabricante ?>"
	<? if ($cols->codigo_fabricante  == 
		$codigo_fabricante) { echo ' selected'; }  
	?>><? echo $cols["descripcion"] ?></option>
<?php } ?> </select></label></td>
</tr> <?php 
echo "<tr><td>Costo Unitario</td>
<td><label><input name='costo_unitario' size='15' type='text'  value='".$costo_unitario."' readonly  /></label></td>
</tr>";
echo "<tr><td>Precio Unitario Hospital</td>
<td><label><input name='precio_unitario' size='15' type='text'  value='".$precio_unitario."' readonly   /></label></td>
</tr>";
echo "<tr><td>Precio Unitario Publico</td>
<td><label><input name='precio_unitario_pub' size='15' type='text'  value='".$precio_unitario_pub."' readonly   /></label></td>
</tr>";
echo "<tr><td>Costo de Caja</td>
<td><label><input name='costo_caja' size='15' type='text'  value='".$costo_caja."' readonly /></label></td>
</tr>";
echo "<tr><td>Precio de Caja</td>
<td><label><input name='precio_caja' size='15' type='text'  value='".$precio_caja."' readonly  /></label></td>
</tr>";
echo "<tr><td>Existencia</td>
<td><label><input name='cantidad_inicial' size='15' type='text'  value='".$cantidad_inicial."' readonly /></label></td>
</tr>";
echo "<tr><td>Tipo de Dosis</td>";?>
<td><label><select name="tipo_de_dosis"> <?php 
	
	$resul= emedica::select8(); 
	foreach($resul as $cols)
	{	  
	?>
	<option value="<? echo $cols->codigo_tipo ?>"
	<? if ($cols->codigo_tipo  == $tipo_de_dosis)
		{ echo ' selected'; }  ?>><? 
		echo $cols->descripcion ?></option>
<?php } ?>
</select></label> <br> <b>Entero:</b> Medicamento que no se puede dividir, ni entregar recurrentemente y su envase trae más de una dosis. Ejemplos: Cremas, gotas óticas, gotas oftálmicas. La cantidad mínima a enviar es 1.<br>

<b>Fraccionado:</b> Medicamento que se puede dividir y entregar recurrentemente. La unidad se puede dividir en más de una dosis. Ejemplos: jarabes y tabletas.<br>

<b>Unitario:</b> Medicamento que no se puede dividir y si se puede entregar recurrentemente. Ejemplos: capsulas liquid-gel, tabletas efervescentes, cápsulas, tabletas con cubierta entérica, etc.<br>

<b>Mixto:</b> Medicamento que se puede dividir y se puede entregar recurrentemente pero se rebaja de inventario la unidad entera y no fraccionado. Ejemplo: I.V.


</td>
</tr> <?php
echo "<tr><td>Antibiotico</td>
<td><label><input name='antibiotico' size='50' type='checkbox'   value='S' "; if ($antibiotico == 'S') {echo 'checked';}  echo "  /></label></td>
</tr>";
echo "<tr><td>Narcotico</td>
<td><label><input name='narcotico' size='50' type='checkbox'  value='S' "; if ($narcotico == 'S') {echo 'checked';} echo "/></label></td>
</tr>";
echo "<tr><td>Preparaci&oacute;n</td>
<td><label><input name='preparacion' size='50' type='checkbox'  value='S' "; if ($preparacion == 'S') {echo 'checked';} echo "/></label></td>
</tr>";
echo "<tr><td>¿No se puede devolver?</td>
<td><label><input name='devolver' size='50' type='checkbox'  value='S' "; if ($devolver == 'S') {echo 'checked';} echo "/></label></td>
</tr>";
echo "<tr><td>Importacio&oacute;n</td>
<td><label><input name='importacion' size='50' type='checkbox'  value='S' "; if ($importacion == 'S') {echo 'checked';} echo "/></label></td>
</tr>";
echo "<tr><td>Aplica Dect. Jubilado</td>
<td><label><input name='jubilado' size='50' type='checkbox'   value='S' "; if ($jubilado == 'S') {echo 'checked';}  echo "  /></label></td>
</tr>";
echo "<tr><td>Aplica Dect. por Tipo de Cliente</td>
<td><label><input name='descuento_total' size='50' type='checkbox'   value='S' "; if ($descuento_total == 'S') {echo 'checked';}  echo "  /></label></td>
</tr>";
echo "<tr><td>¿Mostrar Producto en Hospital?</td>
<td><label><input name='prod_hosp' size='50' type='checkbox'   value='S' "; if ($prod_hosp == 'S') {echo 'checked';}  echo "  /></label></td>
</tr>";
echo "<tr><td>¿Mostrar Producto en P&uacute;blico?</td>
<td><label><input name='prod_pub' size='50' type='checkbox'   value='S' "; if ($prod_pub == 'S') {echo 'checked';}  echo "  /></label></td>
</tr>";
echo "<tr>
<td>Tipo de Impuesto</td>"; ?>
<td><label><select name="tipo_impuesto"> <?php 
	
	$resulx=emedica::select9(); 
	foreach($resulx as $colsx)
	{	  
	?>
	<option value="<? echo $colsx->tipo_impuesto ?>"
	<? if ($colsx->tipo_impuesto  == $tipo_impuesto)
		{ echo ' selected'; }  ?>>
	<? echo $colsx->factor ?></option>
<?php } ?> </select></label></td>
</tr>

<?php  echo "<tr><td>Estado</td>
    <td><label><input name='estado_med' size='25' type='text'  value='";
	if ($estado_med == 'A'){ echo "Activo"; } else if ($estado_med == 'I') { echo "Inactivo"; }
	echo "' readonly /></label></td>
</tr>"; ?>

<tr><td></td>
<td><label><input type="button" name="actualizar_contra" value="Actualizar Contraindicaciones" id="actualizar_contra" onClick="javascript:popUp('actualizar_contra.php?codigo_de_barra=<?php echo $codigo_barras; ?>&men=0')" /></label></td>
</tr>
<tr><td></td>
<td><label><input type="button" name="actualizar_prov" value="Actualizar Proveedores" id="actualizar_prov" onClick="javascript:popUp('actualizar_prov.php?codigo_de_barra=<?php echo $codigo_barras; ?>&men=0')" /></label></td>
</tr>
<tr><td></td>
<td><label><input type="button" name="actualizar_bancos" value="Actualizar Bancos" id="actualizar_bancos" onClick="javascript:popUp('actualizar_bancos.php?codigo_de_barra=<?php echo $codigo_barras; ?>&men=0')" /></label></td>
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
<script>
function teclas(event) {
tecla=(document.all) ? event.keyCode : event.which;

if (tecla==13) {

event.keyCode = 40; event.charCode = 40; event.which = 1199; break;

return false;
}

return true;
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


$("#medicamento").autocomplete("get_medicamento_edit_us.php", {
width: 500,
matchContains: true,
mustMatch: false,
selectFirst: false
});

$("#codigo_barras").autocomplete("get_barras_edit_us.php", {
width: 500,
matchContains: false,
mustMatch: false,
selectFirst: true
});


$("#medicamento").result(function(event, data, formatted) {
$("#medicamento_id").val(data[1]);
$("#forma_farma").val(data[2]);
$("#tipo_posologia").val(data[3]);
$("#tipo_de_dosis").val(data[4]);
$("#descri_forma").val(data[5]);
$("#posologia").val(data[6]);
$("#codigo_barras").val(data[7]);
$("#precio_unitario").val(data[8]);
$("#nombre_comercial").val(data[9]);
$("#nombre_generico").val(data[10]);
$("#presentacion").val(data[11]);
$("#codigo_presentacion").val(data[12]);
$("#cantidad_x_empaque").val(data[13]);
$("#volumen").val(data[14]);
$("#fabricante").val(data[15]);
$("#codigo_fabricante").val(data[16]);
$("#costo_unitario").val(data[17]);
$("#precio_unitario").val(data[18]);
$("#costo_caja").val(data[19]);
$("#precio_caja").val(data[20]);
$("#cantidad_inicial").val(data[21]);
$("#tipo_dosis").val(data[22]);
$("#descr_tipo_dosis").val(data[23]);
$("#antibiotico").val(data[24]);
$("#narcotico").val(data[25]);
$("#preparacion").val(data[26]);
$("#devolver").val(data[27]);
$("#codigo_proveedor").val(data[28]);
$("#tipo_volumen").val(data[29]);
$("#grupo_medicamento").val(data[30]);
$("#multiple_principio").val(data[31]);
$("#tipo_impuesto").val(data[32]);
$("#estado_med").val(data[33]);
$("#importacion").val(data[34]);
$("#precio_publico").val(data[35]);
$("#jubilado").val(data[36]);
$("#descuento_total").val(data[37]);
$("#cant_max_prov").val(data[38]);
$("#anaquel").val(data[39]);
$("#precio_unitario_pub").val(data[40]);
$("#prod_hosp").val(data[41]);
$("#prod_pub").val(data[42]);

});

$("#codigo_barras").result(function(event, data, formatted) {
$("#medicamento_id").val(data[1]);
$("#forma_farma").val(data[2]);
$("#tipo_posologia").val(data[3]);
$("#tipo_de_dosis").val(data[4]);
$("#descri_forma").val(data[5]);
$("#posologia").val(data[6]);
$("#medicamento").val(data[7]);
$("#precio_unitario").val(data[8]);
$("#nombre_comercial").val(data[9]);
$("#nombre_generico").val(data[10]);
$("#presentacion").val(data[11]);
$("#codigo_presentacion").val(data[12]);
$("#cantidad_x_empaque").val(data[13]);
$("#volumen").val(data[14]);
$("#fabricante").val(data[15]);
$("#codigo_fabricante").val(data[16]);
$("#costo_unitario").val(data[17]);
$("#precio_unitario").val(data[18]);
$("#costo_caja").val(data[19]);
$("#precio_caja").val(data[20]);
$("#cantidad_inicial").val(data[21]);
$("#tipo_dosis").val(data[22]);
$("#descr_tipo_dosis").val(data[23]);
$("#antibiotico").val(data[24]);
$("#narcotico").val(data[25]);
$("#preparacion").val(data[26]);
$("#devolver").val(data[27]);
$("#medicamento").val(data[28]);
$("#codigo_proveedor").val(data[29]);
$("#tipo_volumen").val(data[30]);
$("#grupo_medicamento").val(data[31]);
$("#multiple_principio").val(data[32]);
$("#tipo_impuesto").val(data[33]);
$("#estado_med").val(data[34]);
$("#importacion").val(data[35]);
$("#precio_publico").val(data[36]);
$("#jubilado").val(data[37]);
$("#descuento_total").val(data[38]);
$("#cant_max_prov").val(data[39]);
$("#anaquel").val(data[40]);
$("#precio_unitario_pub").val(data[41]);
$("#prod_hosp").val(data[42]);
$("#prod_pub").val(data[43]);
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
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=600');");
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
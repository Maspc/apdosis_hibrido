<?php
	
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/editar_insumos_us.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
?>
<center>  <h1>Editar Productos</h1> </center>
<div class="content_box_inner">
	
	
	<form id="form" name="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="438" height="69" border="0" cellspacing="0">
			<tr>
				<td height="33">Producto</td>
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
					<input name="grupo_medicamento" id="grupo_medicamento" size="50" type="hidden"   readonly />
					<input name="multiple_principio" id="multiple_principio" size="50" type="hidden" readonly />
					<input name="tipo_impuesto" id="tipo_impuesto" size="50" type="hidden" readonly />
					<input name="codigo_enlace" id="codigo_enlace" size="50" type="hidden" readonly />
					<input name="precio_publico" id="precio_publico" size="50" type="hidden" readonly />
					<input name="sub_grupo" id="sub_grupo" size="50"  type="hidden" readonly />
					<input name="jubilado" id="jubilado" size="50"  type="hidden" readonly />
					<input name="descuento_total" id="descuento_total" size="50"  type="hidden" readonly />
					<input name="cant_max_prov" id="cant_max_prov" size="50"  type="hidden" readonly />
					<input name="precio_unitario_pub" id="precio_unitario_pub" size="50" type="hidden" readonly />
					<input name="prod_hosp" id="prod_hosp" size="50" type="hidden" readonly />
					<input name="prod_pub" id="prod_pub" size="50" type="hidden" readonly />
				<input name="buscar" id="buscar"  type="submit" value="Modificar Producto" /></label></td>
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
					$codigo_enlace = $_POST['codigo_enlace'];
					$precio_publico = $_POST['precio_publico'];
					$sub_grupo = $_POST['sub_grupo'];
					$jubilado = $_POST['jubilado'];
					$descuento_total = $_POST['descuento_total'];
					$cant_max_prov = $_POST['cant_max_prov'];
					$precio_unitario_pub = $_POST['precio_unitario_pub'];
					$prod_hosp = $_POST['prod_hosp'];
					$prod_pub = $_POST['prod_pub'];
					
					
					
					
					$fres=einsumos::select1($medicamento_id);
					
					foreach($fres as $frow)
					{
						$cantidad_inicial_tienda = $frow->cantidad_inicial;
					}
					
					} else {
					//si lo leo dsede el lector
					
					$dres= einsumos::select2($_POST['codigo_barras']); 
					
					
					
					$dnum = count($dres);
					
					if ($dnum > 0) {
						foreach($dres as $drow )
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
							$codigo_enlace = $drow->codigo_enlace;
							$precio_publico = $drow->precio_publico;
							$sub_grupo = $drow->sub_grupo;
							$jubilado = $drow->jubilado;
							$descuento_total = $drow->descuento_total;
							$cant_max_prov = $drow->cant_max_prov;
							$precio_unitario_pub =$drow->precio_unitario_pub;
							$prod_hosp =$drow->prod_hosp;
							$prod_pub =$drow->prod_pub;
							
							
							$fres=einsumos::select3($medicamento_id);
							foreach($fres as $frow)
							{
								$cantidad_inicial_tienda = $frow->cantidad_inicial;
							}
							
							
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
						$codigo_enlace = ' ';
						$precio_publico =' ';
						$sub_grupo = ' ';
						$jubilado = ' ';
						$cantidad_inicial_tienda = ' ';
						$descuento_total = ' ';
						$cant_max_prov = ' ';
						$precio_unitario_pub = ' ';
						$prod_hosp = ' ';
						$prod_pub = ' ';
					}
					
					
				}
				
				
				if ($codigo_enlace != ' '){
					
					$bres=einsumos::select4($codigo_enlace);
					
					
					$bnum = count($bres);
					
					if ($bnum > 0) {
						foreach($bres as $brow)
						{
							$nom_en = $brow->nombre;
						}
						
						
						} else {
						$nom_en = ' ';
						
					}
					
				}
				
				
				echo   "<form id='form1' name='form1' method='post' action='actualizar_ins_us.php' onSubmit=\"popupform(this, 'join')\" >
				<table width='600' height='69' border='0' cellspacing='0'>";
				echo "<tr>
				<td height='33'>Codigo de Barras </td>";
				echo "<td><label><input type='text' name='codigo_barras' id='codigo_barras' size='15' value='".$codigo_barras."' /><input type='hidden' name='medicamento_id' id='medicamento_id' size='15' value='".$medicamento_id."' /></label></td>
				</tr>";
				echo "<tr><td>Descripción</td>
				<td><label><input name='nombre_comercial' id='nombre_comercial' size='50' type='text'  value='".$nombre_comercial."' /></label></td>
				</tr>";
				echo "<tr><td>Marca</td>
				<td><label><input name='nombre_generico' id='nombre_generico' size='50' type='text'  value='".$nombre_generico."' /></label></td>
				</tr>";
				
				echo "<tr><td>Codigo Proveedor</td>
				<td><label><input name='codigo_proveedor' id='codigo_proveedor' size='50' type='text'  value='".$codigo_proveedor."' /></label></td>
				</tr>";
				/* echo "<tr>
					<td>Forma Farmceutica</td>"; ?>
					<td><label><select name="forma_farmaceutica"> <?php $n = "select codigo_forma, descripcion from formas_farmaceuticas";
					$resul = mysql_query($n, $conn) or die(mysql_error());
					while($cols = mysql_fetch_array($resul)){	  
					?>
					<option value="<? echo $cols["codigo_forma"] ?>" <? if ($cols["codigo_forma"]  == $forma_farma) { echo ' selected'; }  ?>><? echo $cols["descripcion"] ?></option>
					<?php } ?> </select></label></td>
					</tr> <?php
					
					echo "<tr><td>Multiple Principio Activo</td>
					<td><label><input name='multiple_principio' size='50' type='checkbox'   value='S' "; if ($multiple_principio == 'S') {echo ' checked';}  echo "  /></label></td>
					</tr>";
					echo "<tr><td>Concentraci&oacute;n</td>";?>
					<td><input name='posologia' size='15' type='text'  value='<?php echo $posologia; ?>' /><label><select name="tipo_posologia"> <?php $n = "select codigo_posologia, descripcion from tipos_posologias";
					$resul = mysql_query($n, $conn) or die(mysql_error());
					while($cols = mysql_fetch_array($resul)){	  
					?>
					<option value="<? echo $cols["codigo_posologia"] ?>" <? if ($cols["codigo_posologia"]  == $tipo_posologia) { echo ' selected'; }  ?>><? echo $cols["descripcion"] ?></option>
					<?php } ?> </select></label></td>
					</tr> <?php 
					echo "<tr><td>Presentacion</td>";?>
					<td><label><select name="presentacion"> <?php $n = "select codigo_presentacion, descripcion from presentacion";
					$resul = mysql_query($n, $conn) or die(mysql_error());
					while($cols = mysql_fetch_array($resul)){	  
					?>
					<option value="<? echo $cols["codigo_presentacion"] ?>" <? if ($cols["codigo_presentacion"]  == $codigo_presentacion) { echo ' selected'; }  ?>><? echo $cols["descripcion"] ?></option>
					<?php } ?> </select></label></td>
					</tr> <?php "<tr><td>Cantidad por Empaque</td>
					<td><label><input name='cantidad_x_empaque' size='15' type='text'  value='".$cantidad_x_empaque."'/></label></td>
					</tr>";
				*/
				
				echo "<tr><td>Aplica Descto. de Jubilado</td>
				<td><label><input name='jubilado' size='50' type='checkbox'   value='S' "; if ($jubilado == 'S') {echo 'checked';}  echo "  /></label></td>
				</tr>";
				
				echo "<tr><td>Aplica Descto. por Tipo de Cliente</td>
				<td><label><input name='descuento_total' size='50' type='checkbox'   value='S' "; if ($descuento_total == 'S') {echo 'checked';}  echo "  /></label></td>
				</tr>";
				
			echo "<tr><td>Grupo de Artículos</td>";?>
			<td><label><input type ="hidden" name="grupo_medicamento" id="grupo_medicamento" value="<?php echo $grupo_medicamento; ?>" > 
				<?php 
					
					$resulv= einsumos::select5($grupo_medicamento);    
					
					$numrows = count($resulv);
					if($numrows > 0){
						foreach($resulv as $colsv )
						{	  
							?> <input type="text" name="grupo_medicamento_nom" id="grupo_medicamento_nom" value="<? echo $colsv->descripcion; 
						} ?>" readonly />
				<?php } else  { ?> <input type="text" name="grupo_medicamento_nom" id="grupo_medicamento_nom" value="No tiene grupo" readonly  /> <?php	}		?>  </label></td>
		</tr>
		
		<?php
		echo "<tr><td>Sub Grupo de Artículos</td>";?>
		<td><label><input type ="hidden" name="sub_grupo" id="sub_grupo" value="<?php echo $sub_grupo; ?>" > 
			<?php
				
				$resulv =einsumos::select6($grupo_medicamento,$sub_grupo);     
				
			    $numrows = count($resulv);
				if($numrows > 0){
					foreach($resulv  as $colsv)
					{	  
						?><input type="text" name="sub_grupo_nom" id="sub_grupo_nom" value="<? echo $colsv->descripcion; 
					} ?>" readonly />  <?php } else  { ?> <input type="text" name="sub_grupo_nom" id="sub_grupo_nom" value="No tiene grupo" readonly  /> <?php	}		?> </label> </td>
	<td><label><input type="button" name="actualizar_grupos" value="Actualizar Grupos" id="actualizar_grupos" onClick="javascript:popUp('actualizar_grupos.php?medicamento_id=<?php echo $medicamento_id; ?>&men=0')" /></label></td></tr>
	
	
	<?php
		/*
			echo "<tr><td>Volumen</td>";?>
			<td><input name='volumen' size='15' type='text'  value='<?php echo $volumen; ?>' /><label><select name="tipo_volumen"> <?php $k = "select codigo_posologia, descripcion from tipos_posologias";
			$resul9 = mysql_query($k, $conn) or die(mysql_error());
			while($cols9 = mysql_fetch_array($resul9)){	  
			?>
			<option value="<? echo $cols9["codigo_posologia"] ?>" <? if ($cols9["codigo_posologia"]  == $tipo_volumen) { echo ' selected'; }  ?>><? echo $cols9["descripcion"] ?></option>
			<?php } ?> </select></label></td>
			</tr> <?php
			echo "<tr><td>Fabricante</td>";?>
			<td><label><select name="fabricante"> <?php $n = "select codigo_fabricante, descripcion from fabricantes";
			$resul = mysql_query($n, $conn) or die(mysql_error());
			while($cols = mysql_fetch_array($resul)){	  
			?>
			<option value="<? echo $cols["codigo_fabricante"] ?>" <? if ($cols["codigo_fabricante"]  == $codigo_fabricante) { echo ' selected'; }  ?>><? echo $cols["descripcion"] ?></option>
			<?php } ?> </select></label></td>
		</tr>*/ 
		/* echo "<tr><td>Costo Unitario</td>
			<td><label><input name='costo_unitario' size='15' type='text'  value='".$costo_unitario."'   /></label></td>
		</tr>";*/
		echo "<tr><td>Precio Unitario Hospital</td>
		<td><label><input name='precio_unitario' size='15' type='text'  value='".$precio_unitario."' readonly   /></label></td>
		</tr>";
		echo "<tr><td>Precio Unitario Publico</td>
		<td><label><input name='precio_unitario_pub' size='15' type='text'  value='".$precio_unitario_pub."' readonly   /></label></td>
		</tr>";
		
		/* echo "<tr><td>Costo de Caja</td>
			<td><label><input name='costo_caja' size='15' type='hidden'  value='".$costo_caja."'  /></label></td>
			</tr>";
			echo "<tr><td>Precio de Caja</td>
			<td><label><input name='precio_caja' size='15' type='hidden'  value='".$precio_caja."'  /></label></td>
		</tr>"; */
		echo "<tr><td>Existencia Almacen</td>
		<td><label><input name='cantidad_inicial_almacen' size='15' type='text'  value='".$cantidad_inicial."' readonly /></label></td>
		</tr>"; 
		echo "<tr><td>Existencia Tienda</td>
		<td><label><input name='cantidad_inicial_tienda' size='15' type='text'  value='".$cantidad_inicial_tienda."' readonly /></label></td>
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
		
		$resulx=einsumos::select7();
		foreach($resulx as $colsx)
		{	  
		?>
		<option value="<? echo $colsx->tipo_impuesto ?>" <? if ($colsx->tipo_impuesto  == $tipo_impuesto) { echo ' selected'; }  ?>><? echo $colsx->factor ?></option>
		<?php } 
	?> </select></label></td>
	</tr> <?php
	
	echo "<tr><td>Cantidad M&iacute;nima para Proveedor Principal</td>
    <td><label><input name='cant_max_prov' size='25' type='text' value='".$cant_max_prov."' /></label></td>
	</tr>";
	
	
	/*  echo "<tr><td>Tipo de Dosis</td>";?>
		<td><label><select name="tipo_de_dosis"> <?php $n = "select codigo_tipo, descripcion from tipos_dosis";
		$resul = mysql_query($n, $conn) or die(mysql_error());
		while($cols = mysql_fetch_array($resul)){	  
		?>
		<option value="<? echo $cols["codigo_tipo"] ?>" <? if ($cols["codigo_tipo"]  == $tipo_de_dosis) { echo ' selected'; }  ?>><? echo $cols["descripcion"] ?></option>
		<?php } ?> </select></label> <br> <b>*Entero:</b>	Medicamento que no puede dividir ni entregar recurrentemente porque su envase trae mas de una dosis  p.e. Cremas, gotas oticas, gotas opticas. La cantidad mínima a enviar es 1 <br>
		<b>*Fraccionado:</b>	Medicamento que se puede dividir y entregar recurrentemente porque la unidad se puede reenvasar. P.e. tabletas, pastillas, jarabes.<br>
		<b>*Unitario:</b>	Medicamento que no se puede dividir y si se puede entregar recurrentemente, p.e. gel caps, tabletas efervecentes, tabletas granuladas.<br>
		<b>*Mixto:</b>	Medicamento que se puede dividir y si se puede entregar recurrentemente pero se disminuye de inventario con la dosis entera y no fraccionado, p.e. I.V.
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
	</tr>"; */?> 
	<!-- 
		<tr><td></td>
		<td><label><input type="button" name="actualizar_contra" value="Actualizar Contraindicaciones" id="actualizar_contra" onClick="javascript:popUp('actualizar_contra.php?codigo_de_barra=&men=0')" /></label></td>
	</tr> --> 
	
	<tr><td></td>
		<td><label><input type="button" name="actualizar_prov" value="Actualizar Proveedores" id="actualizar_prov" onClick="javascript:popUp('actualizar_prov.php?codigo_de_barra=<?php echo $medicamento_id; ?>&men=0')" /></label></td>
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
		
		
		$("#medicamento").autocomplete("get_insumo_edit_us.php", {
			width: 500,
			matchContains: true,
			mustMatch: false,
			selectFirst: false
		});
		
		$("#codigo_barras").autocomplete("get_barras_ins_edit_us.php", {
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
			$("#codigo_enlace").val(data[33]);
			$("#precio_publico").val(data[34]);
			$("#sub_grupo").val(data[35]);
			$("#jubilado").val(data[36]);
			$("#descuento_total").val(data[37])
			$("#cant_max_prov").val(data[38]);
			$("#precio_unitario_pub").val(data[39]);
			$("#prod_hosp").val(data[40]);
			$("#prod_pub").val(data[41]);
			
			
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
			$("#codigo_enlace").val(data[34]);
			$("#precio_publico").val(data[35]);
			$("#sub_grupo").val(data[36]);
			$("#jubilado").val(data[37]);
			$("#descuento_total").val(data[38]);
			$("#cant_max_prov").val(data[39]);
			$("#precio_unitario_pub").val(data[40]);
			$("#prod_hosp").val(data[41]);
			$("#prod_pub").val(data[42]);
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
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=400');");
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
	} </script>
	
	<script type="text/javascript">
		function buscarTexto(){
			//alert("prueba");
			document.form1.nombre_sub.value = $("#sub_grupo option:selected").text();
		}
		</script>		
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/historico_movimientos.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
?>
<h2>Histórico de Movimientos</h2>
<div class="content_box_inner">
	
	
	<form id="form" name="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="438" height="69" border="0" cellspacing="0">
			<tr>
				<td height="33">Medicamento </td>
				<td><label><input type="text" name="medicamento" id="medicamento" size="85" /><input type="hidden" name="medicamento_id" id="medicamento_id" size="85" /></label></td>
			</tr>
			<tr>
				
			<td>Fecha Inicial</td><td> <input size="30" id="f_date1" name="fecha1"/><button bsmall id="f_btn1" type="button" >...</button><br /></td></tr>
			<p>
			<td>Fecha Final</td><td> <input size="30" id="f_date2" name="fecha2"/><button bsmall id="f_btn2" type="button" >...</button><br /></td></tr>
			
			<script type="text/javascript">//<![CDATA[
				var cal1 = Calendar.setup({
					inputField : "f_date1",
					trigger    : "f_btn1",
					onSelect   : function() { this.hide() },
					dateFormat : "%Y-%m-%d"
				});
				
				var cal2 = Calendar.setup({
					inputField : "f_date2",
					trigger    : "f_btn2",
					onSelect   : function() { this.hide() },
					dateFormat : "%Y-%m-%d"
				});
			//]]></script>
			<tr>
				<td></td>
				<td><label>
					<!--	<input name="tipo_posologia" id="tipo_posologia" size="50" type="hidden" readonly />
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
					</label></td> !-->
				</tr>
				
				</table>
				<input name="buscar" id="buscar"  type="submit" value="Buscar Movimientos" />
				<p><label>
					
				</label>
				</form>
				
				<?php
					if (isset($_POST['buscar'])){
						//if (!empty($_POST['medicamento'])) {
						$medic = $_POST['medicamento'];
						$medicamento_id = $_POST['medicamento_id'];
						$fecha1 = $_POST['fecha1'];
						$fecha2 = $_POST['fecha2'];
						/*  $descri_forma = $_POST['descri_forma'];
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
						$tipo_impuesto = $_POST['tipo_impuesto']; */
						// } else {
						//si lo leo dsede el lector
						/* $d = "select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto 
							FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
							WHERE medicamentos.codigo_de_barra = '".$_POST['codigo_barras']."' 
							AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
							AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
							and presentacion.codigo_presentacion = medicamentos.presentacion
							and fabricantes.codigo_fabricante = medicamentos.fabricante
							and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
							and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
						and medicamentos_x_bodega.bodega = '1'"; */
						
						
						//  $dres = mysql_query ($d, $conn) or die(mysql_error());
						
						// $dnum = mysql_num_rows($dres);
						
						/*	  if ($dnum > 0) {
							
							while ($drow = mysql_fetch_array($dres)){
							$medic = $drow['nombre'];
							$medicamento_id = $drow['codigo_interno'];
							$descri_forma = $drow['forma_descri'];
							$forma_farma = $drow['forma_farma'];
							$precio_unitario = $drow['precio_unitario'];
							$tipo_posologia = $drow['tipo_posologia'];
							$tipo_de_dosis = $drow['tipo_de_dosis'];
							$posologia = $drow['posologia'];
							$codigo_barras = $drow['codigo_de_barra'];
							$precio_unitario = $drow['precio_unitario'];
							$nombre_comercial = $drow['nombre_comercial'];
							$nombre_generico = $drow['nombre_generico'];
							$presentacion = $drow['descr_presentacion'];
							$codigo_presentacion = $drow['presentacion'];
							$cantidad_x_empaque = $drow['cantidad_x_empaque'];
							$volumen = $drow['volumen'];
							$fabricante = $drow['descr_fabricante'];
							$codigo_fabricante = $drow['fabricante'];
							$costo_unitario = $drow['costo_unitario'];
							$costo_caja = $drow['costo_caja'];
							$precio_caja = $drow['precio_caja'];
							$cantidad_inicial = $drow['cantidad_inicial'];
							$tipo_dosis = $drow['tipo_de_dosis'];
							$descr_tipo_dosis = $drow['descr_tipo_dosis'];
							$antibiotico = $drow['antibiotico'];
							$narcotico = $drow['narcotico'];
							$preparacion = $drow['preparacion'];
							$devolver = $drow['permite_devol'];
							$codigo_proveedor = $drow['codigo_proveedor'];
							$tipo_volumen = $drow['tipo_volumen'];
							$grupo_medicamento = $drow['grupo_medicamento'];
							$multiple_principio = $drow['multiple_principio'];
							$tipo_impuesto = $drow['tipo_impuesto'];
							
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
							
							
							
							
						} */
						
						
						//  }
						
						$fres = histmov::select1($medicamento_id,$fecha1,$fecha2);
						
						echo "<p><center><h2>Movimientos de ".$fecha1." a ".$fecha2."  para el medicamento: <p>".$medic."</h2></center>";
						
						echo "<p><p><center><table border='1' align='center'><tr><th>Tipo de Transacción</th><th>Doc. Interno</th><th>Doc. Hospital</th><th>Historia</th><th>Tratamiento</th><th>Cargo</th><th>Cantidad</th><th>Fecha</th><th>Precio Venta</th><th>Costo Compra</th></tr>";
						
						foreach($fres as $frow){
							echo "<tr><td>".$frow->tipo."</td>";
							echo "<td>".$frow->id_interno."</td>";
							echo "<td>".$frow->id_hospital."</td>"; 
							echo "<td>".$frow->historia."</td>"; 
							echo "<td>".$frow->tratamiento."</td>"; 
							echo "<td>".$frow->cargo."</td>"; 
							echo "<td>".$frow->cantidad."</td>"; 
							echo "<td>".$frow->fecha."</td>"; 
							echo "<td>".$frow->precio_venta."</td>"; 
							echo "<td>".$frow->costo_compra."</td></tr>";							
						}
						
						
						
						echo "</table></center>";
						
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
						
						
						$("#medicamento").autocomplete("get_medicamento_edit_us_ins.php", {
							width: 500,
							matchContains: true,
							mustMatch: false,
							selectFirst: false
						});
						
						$("#codigo_barras").autocomplete("get_barras_edit_us_ins.php", {
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
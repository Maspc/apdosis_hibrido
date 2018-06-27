<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/conteo_inventario.php');
	require_once('../modulos/layout.php');
	layout::encabezado();	
	
	if (isset($_GET['men'])){
		$men = $_GET['men'];
		} else {
	$men = 0; }
	
	if (!isset($_SESSION['page_instance_ids'])) {
		$_SESSION['page_instance_ids'] = array();
	}
	$_SESSION['page_instance_ids'][] = uniqid('', true); 
	
	
?>
<style type="text/css">
	
	.red {
	background-color: red;
	color: white;
	}
	.white {
	background-color: white;
	color: black;
	}
	.green {
	background-color: green;
	color: white;
	}
	
	.blue {
	background-color: blue;
	color: white;
	}
	.red, .white, .blue, .green {
	margin: 0.5em;
	padding: 5px;
	font-weight: bold;
	
	}
</style>


<?php
	
	layout::menu();
	layout::ini_content();
	
?>


<h2>Conteo de Inventario</h2>


<div class="content_box_inner">
	<?php if ($men == 1) { echo "NO puede enviar una compra en blanco!!"; } elseif ($men == 2) { echo "Su recibo es por un valor MAYOR al total de la caja menuda. Saldo Actual = ".$saldo;  }  ?>
	
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" target="" name="formulario" id="formulario" >
		
		<table width="500" border="0" cellspacing="0" >
			
			
			
			
			<!-- <tr>
				
				<td colspan="8" align="right"><label>Cargo # <input name="cargo" type="text" size="10" readonly/></label> 
				<label>Factura # <input name="factura" type="text" size="10" readonly="true" /></label></td>
			</tr> !-->
			<tr>
				<td width="86"><label>Escoja el anaquel:</label></td>
				<td><select name="anaquel" id="anaquel"> 
					<?php 					
						
						$gres = conteoi::select1();
						foreach($gres as $grow){
						$anaquel = $grow->id_anaquel;	?>
						<option value="<?php echo $anaquel; ?>" <?php if ($anaquel == $_SESSION['anaquel']) { echo " selected"; } ?>>Anaquel <?php echo $anaquel; ?></option>
						
					<?php } ?>
				</select></td>
			</tr>
			
			
		</table>
		
		
		<table class="formulario"><br />
			<thead>
				<tr>
					<th colspan="2"><img src="add.png" />Contar Producto</th>
				</tr>
				<tr>
					<td colspan="2">
						
					</tr>
				</thead> 
				<tbody>
					<tr>
						<td>C&oacute;digo de Barra</td>
						<td><input name="codigo_de_barra" type="text" id="codigo_de_barra" size="35"/>&nbsp; <b>*</b>
						</td>
					</tr>
					<tr>
						<td>Producto</td>
						<td><input name="medicamento" type="text" id="medicamento" size="75"/>&nbsp; <b>*</b>
						<input name="medicamento_id" type="hidden" id="medicamento_id" size="50" /></td>
					</tr>
					
					<tr>
						<td>Cantidad F&iacute;sica</td>
						<td><input name="cantidad" type="text" id="cantidad" size="25" onKeyPress="return numbersonly(this, event)" /> &nbsp; <b>*</b>
						</td>
					</tr>
					
					
					<tr>
						<td>¿Cambiar Descripción?</td>
						<td><input type="checkbox" name="cambiar_desc" value="S" /> &nbsp; 
						</td>
					</tr>
					
					<tr>
						<td colspan="2">
							<label>
								
							</label>
						</td>
					</tr>
				</tbody>
				
			</table>
			
			<input type="submit" name="enviar" id="enviar" value="Cargar" class="green" /> 
		</form>
		
		<p></p>
		<p></p>
		<p></p>
		<?php
			
			
			if (isset($_POST['enviar'])){
				if(isset($_POST['anaquel'])){
					
					$_SESSION['anaquel'] = 	$_POST['anaquel'];
					
						
					$bres = conteoi::select2($_POST['anaquel']);
					
					foreach($bres as $brow){
						$id_conteo = $brow->conteo;						
					}
					
					//busco que no haya el mismo producto para este conteo en este anaquel
					
					$dres = conteoi::select3($_POST['anaquel'],$id_conteo,$_POST['medicamento_id']);
					
					$dnum = count($dres);
					
					
					///
					
					if($dnum == 0){
						conteoi::insert1($id_conteo,$_POST['anaquel'],$_POST['codigo_de_barra'],$_POST['medicamento'],$_POST['medicamento_id'],$_POST['cantidad'],$_POST['cambiar_desc'],$_SESSION['MM_iduser']);
							
						/////////aqui ajusto inventario
						
						//busco que no haya el mismo producto para este conteo en otro anaquel
					
					    $deres = conteoi::select4($_POST['anaquel'],$_POST['medicamento_id']);
						
						$denum = count($deres);
						
						if($denum == 0) {
							
							
							$fres = conteoi::select5($_POST['medicamento_id']);
							foreach($fres as $frow){
								$cantidad_sistema = $frow->cantidad_sistema;
							}
							
							if($cantidad_sistema > $_POST['cantidad']){
								$tipo_ajuste = 'N';
								}else{
								$tipo_ajuste = 'P';
							}
							
							$diferencia = $cantidad_sistema - $_POST['cantidad'];
							
							
							conteoi::insert2($tipo_ajuste,$_POST['medicamento_id'],$diferencia,$_SESSION['MM_iduser']);
							
							conteoi::update1($diferencia,$_POST['medicamento_id']);
							
							conteoi::update2($_POST['anaquel'],$_POST['medicamento_id']);
							
							} else {
							
							//si existe
							
							conteoi::insert3($_POST['medicamento_id'],$_POST['cantidad'],$_SESSION['MM_iduser']);
							
							conteoi::update3($_POST['cantidad'],$_POST['medicamento_id']);
							
							conteoi::update4($_POST['anaquel'],$_POST['medicamento_id']);
							
						}
						
						} else{
						
						echo "<p><b>Este producto ya fue contabilizado para este anaquel en el conteo activo, para añadir, recurra a un ajuste.</b></p>";
					}
					
					
					
					/////////
					
					
				} }
				
				echo "<table border='1' cellspacing='1' cellpadding='1'><tr><th>No. Conteo</th><th>No. Anaquel</th><th>Codigo de Barra</th><th>Producto</th><th>Cantidad Fisica</th></tr>";
				
				$feres = conteoi::select6($_POST['anaquel']);
				
				foreach($feres as $ferow){
					echo "<tr><td><center>".$ferow->id_conteo."</center></td>";
					echo "<td><center>".$ferow->id_anaquel."</center></td>";
					echo "<td>".$ferow->codigo_de_barra."</td>";
					echo "<td>".$ferow->medicamento."</td>";
					echo "<td>".$ferow->conteo_final."</td></tr>";
				}
				echo "</table>";
				
				layout::fin_content();		
				
		?>
		
		<script type="text/javascript">
			
			function stopRKey(evt) {
				var evt = (evt) ? evt : ((event) ? event : null);
				var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
				if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
			}
			
			document.onkeypress = stopRKey;
			
		</script>
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
				
				
				//-->
			</SCRIPT>
			
			
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
					
					
					$("#medicamento").autocomplete("get_medicamento.php", {
						width: 500,
						matchContains: true,
						mustMatch: false,
						selectFirst: false
					});
					
					$("#medicamento").result(function(event, data, formatted) {
						$("#medicamento_id").val(data[1]);
						$("#forma_farma").val(data[2]);
						$("#dosis_tipo").val(data[3]);
						$("#tipo_de_dosis").val(data[4]);
						$("#descri_forma").val(data[5]);
						$("#posologia").val(data[6]);
						$("#grupo_med").val(data[7]);
						$("#tipo_impuesto").val(data[8]);
						$("#existencia").val(data[9]);
						$("#codigo_de_barra").val(data[10]);
					});
					
					$("#nommedico").autocomplete("get_medico.php", {
						width: 500,
						matchContains: true,
						mustMatch: false,
						selectFirst: false
					});
					
					$("#nommedico").result(function(event, data, formatted) {
						$("#medico").val(data[1]);
					});
					
					$("#codigo_de_barra").autocomplete("get_barras_com1.php", {
						width: 500,
						matchContains: true,
						mustMatch: false,
						selectFirst: true
					});
					
					$("#codigo_de_barra").result(function(event, data, formatted) {
						$("#medicamento_id").val(data[1]);
						$("#forma_farma").val(data[2]);
						$("#dosis_tipo").val(data[3]);
						$("#tipo_de_dosis").val(data[4]);
						$("#descri_forma").val(data[5]);
						$("#posologia").val(data[6]);
						$("#medicamento").val(data[7]);
						$("#tipo_impuesto").val(data[8]);
						$("#existencia").val(data[9]);
					});
					
					$("#proveedor_desc").autocomplete("get_proveedor.php", {
						width: 500,
						matchContains: true,
						mustMatch: true,
						selectFirst: true
					});
					
					$("#proveedor_desc").result(function(event, data, formatted) {
						$("#proveedor").val(data[1]);
					});
					
					/*
						$("#identificacion").autocomplete("get_personas.php", {
						width: 500,
						matchContains: true,
						mustMatch: true,
						selectFirst: true
						});
						
						$("#identificacion").result(function(event, data, formatted) {
						$("#nombre_paciente").val(data[1]);
						$("#alergias").val(data[2]);
						$("#peso").val(data[3]);
						$("#otros").val(data[4]);
						$("#compania_de_seguro").val(data[5]);
						$("#diabetes").val(data[6]);
						$("#hipertension").val(data[7]);
						$("#contraindicaciones").val(data[8]);
						});
					*/
					
					
					$("#clear").click(function() {
						$(":input").unautocomplete();
					});
					
					
				});
				
				
				
				
			</script>
			
			<script type="text/javascript">
				<!--
				function getData(){
					myString+=document.formulario.identificacion.value
					/*location.href = "ver_alergias.php" + '?' + myString*/
					alert("Estoy llamando a la funcion")
					URL = "ver_alergias.php" + '?' + myString
					day = new Date();
					id = day.getTime();
					eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=400');");
				}
				//-->
			</script>
			
			
			
			
			
			<script type="text/javascript">
				function limpiar_campos()
				{
					
					document.getElementById('medicamento').value='';
					document.getElementById('cantidad').value='';
					document.getElementById('lote').value='';
					document.getElementById('calendar').value='';
					document.getElementById('costo').value='';
					
				}
				
				
				
			</script>
			
			<script language="javascript">
				<!-- Begin
				function popUp(URL) {
					day = new Date();
					id = day.getTime();
					eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=600');");
				}
				
				function popUpLote(URL) {
					
					day = new Date();
					id = day.getTime();
					
					URL = URL + "?medicamento_id=" + formulario.medicamento_id.value;
					
					
					eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=200');");
				}
				
				
				// End -->
			</script>
			
			<script>
				function validate()
				{
					var factura = document.formulario.factura;
					var proveedor = document.formulario.proveedor_desc;
					
					
					if (factura.value == "")
					{
						window.alert("Por favor introduzca el no. de factura");
						factura.focus();
						return false;
					}
					
					if (proveedor.value == "")
					{
						window.alert("Por favor introduzca el proveedor");
						proveedor.focus();
						return false;
					}
					
				}
			</script>						
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/procesar_orden_compra.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
?>
<script type="text/javascript">
	function toggleDiv(divId) {
		$("#"+divId).toggle();
	}
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
		
		// decimal point jump
		else if (dec && (keychar == "."))
		{
			myfield.form.elements[dec].focus();
			return false;
		}
		else
		return false;
	}
	
	
	function checkIt(valor) {
		factura = "factura_proveedor"+valor;
		//alert("Devolucion "+devolucion);
		//alert("Cantidad "+cantidad);
		if (parseInt(document.getElementById(factura).value) == null)) {
			alert("La factura del proveedor es requerida");
			document.getElementById(factura).focus();
			document.getElementById(factura).select();
			return false
			} else {
			return true
		}
		
	}
	
	//-->
</SCRIPT>

<script >
	function valida_descuento(valor){
		var tipo_descuento = "tipo_descuento"+valor;
		var valor_descuento = "descuento_unitario"+valor;
		var costo = "costo"+valor;
		var descuento_uni = "descuento_uni"+valor;
		var descuento_u;
		
		alert("Entro a validar");
		
		//alert("tipo: " + $("#tipo_descuento").val());
		if (parseFloat(document.getElementById(valor_descuento).value > 0 ) {
			if(parseInt(document.getElementById(tipo_descuento).value == 1){
				descuento_u = (parseFloat(document.getElementById(costo).value))*(parseFloat(document.getElementById(valor_descuento).value)/100);
				}else{
				descuento_u = parseFloat(document.getElementById(valor_descuento).value);
			}
		} 
		
		if(document.getElementById(valor_descuento).length == 0){
			descuento_u = 0;
		}
		
		
		if (parseFloat(document.getElementById(costo).value) <=  descuento_u) {
			alert('El costo no puede ser menor al descuento, verifique por favor');
			return false;
		}
	}
	
</script>

<script>
	function validate()
	{
		
		//alert("Entro a validar");
		
		//var con = 50;
		
		for (var i=1;i<50;i++){
			
			//alert ("Valido "+i);
			
			factura_proveedor = "factura_proveedor"+i;
			cantidad_entregada = "cantidad_entregada"+i;
			cantidad_pendiente = "cantidad_pendiente"+i;
			costo = "costo"+i;
			tipo_descuento = "tipo_descuento"+i;
			valor_descuento = "descuento_unitario"+i;
			descuento_uni = "descuento_uni"+i;
			var descuento_u;
			
			//alert("cant entregada: "+ document.getElementById(cantidad_entregada).value);
			//alert("costo: "+document.getElementById(costo).value);
			//alert ("cantidad entregada: "+document.getElementById(cantidad_entregada).value);
			//alert ("factura proveedor: "+document.getElementById(factura_proveedor.value));
			
			if (parseInt(document.getElementById(cantidad_entregada).value) > 0){
				
				if ((parseInt(document.getElementById(cantidad_entregada).value) > parseInt(document.getElementById(cantidad_pendiente).value))){
					alert("La cantidad entregada no puede ser mayor a la pendiente, verifique");
					document.getElementById(cantidad_entregada).focus();
					document.getElementById(cantidad_entregada).select();
					return false;
				}
				
				
				
			}		
			
			if ((parseInt(document.getElementById(cantidad_entregada).value) > 0) ){
				
				if (document.getElementById(costo).value == 0){
					alert("El costo no puede ser cero, verifique");
					document.getElementById(costo).focus();
					document.getElementById(costo).select();
					return false;
				}
				
				
				
			}		
			if ((parseInt(document.getElementById(cantidad_entregada).value) > 0) || (parseInt(document.getElementById(costo).value) > 0) ){
				
				if (document.getElementById(factura_proveedor).value == ''){
					alert("No puede enviar la factura en blanco cuando tengo cantidad entregada");
					document.getElementById(factura_proveedor).focus();
					document.getElementById(factura_proveedor).select();
					return false;
				} }
				
				//alert("val: "+ valor_descuento);
				//alert("tipo: "+ tipo_descuento);
				
				//alert("valor descuento: " + parseFloat(document.getElementById(valor_descuento).value));
				//alert("tipo descuento: " + parseFloat(document.getElementById(tipo_descuento).value));
				
				descuento_u =0;
				
				if (parseFloat(document.getElementById(valor_descuento).value) > 0 ) {
					//alert("tengo descuento en linea " + i);
					if(document.getElementById(tipo_descuento).value == 1){
						//alert("Entre porcentaje");
						descuento_u = (parseFloat(document.getElementById(costo).value))*(parseFloat(document.getElementById(valor_descuento).value)/100);
						}else{
						//alert("Entre valor");
						descuento_u = parseFloat(document.getElementById(valor_descuento).value);
					}
				} 
				
				//alert("descuento u: "+ descuento_u);
				
				if(document.getElementById(valor_descuento).length == 0){
					descuento_u = 0;
				}
				
				//alert("descuento u: "+ descuento_u);
				
				if (parseFloat(document.getElementById(costo).value) <=  descuento_u) {
					alert('El costo no puede ser menor al descuento, verifique por favor');
					document.getElementById(costo).focus();
					document.getElementById(costo).select();
					return false;
					
				}
				
				document.getElementById(descuento_uni).value = descuento_u;
				
				
				
				//alert("descuento uni: "+document.getElementById(descuento_uni).value);
				
				
				/*  var factura = document.formulario.factura;
					
					
					
					if (factura.value == "")
					{
					window.alert("Por favor introduzca el no. de factura");
					factura.focus();
					return false;
				}*/
				
				
				
		}
		
	}
</script>


<script language="javascript">
	<!-- Begin
	function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=200');");
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
<?php
	layout::menu();
	layout::ini_content();
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="estado" id="estado">
	<center><h2>Procesar Orden de Compra</h2></center><p>
		
		<table class='dtable' width="780" border="0" cellspacing="0" >
			
			<tr>
				<td>
					<table class='dtable' width="510" border="1" cellspacing="0" bordercolor="#000000" align="center">
						<tr>
							<td width="194">No. de Orden de Compra</td>
							<td width="278"><input name="compra" type="text" size="20" /></td>
						</tr>
						
					</table>
					
					
					<div align="center">
						<input name="buscar" type="submit" value="Buscar Orden" />  
					</div></td>
			</tr>
		</table>
	</form>
	<?php     
		if(isset($_POST['buscar'])){
			if(isset($_POST['compra']))
			{
				$compra = $_POST['compra'];
			}
			
			
			$u=1;	
			$v=1;	 
			$rows7 = ocompra::compras_prov($compra);
			
			foreach($rows7 as $rw7){
				if ($rw7->estado == 'P') {
					$esta = 'PENDIENTE';
					}else if ($rw7->estado == 'F'){ 
					$esta = 'FINALIZADA';
					}	else if ($rw7->estado == 'A'){ 
					$esta = 'ANULADA';
				}
				echo "<center><h1>Orden de Compra No. ". $rw7->id_compra."</h1></center>";
				echo "<p><table class='dtable' border='1' align='center'>
				<th>Nombre de Proveedor</th>
				<th>Fecha de Solicitud</th>
				<th>Estado de Orden</th>
				<th>Observaci&oacute;n</th>
				";
				
				
				echo "<tr>
				
				<td>".$rw7->nombre."</td>
				<td align='center'>".$rw7->fecha_compra."</td>
				<td><font color='green'><b>".$esta."</b></font></td>";
				echo "<td>".$rw7->observacion."</td>";
				echo "</tr></table>";
				
				echo "<p>";
				if ($rw7->estado == 'P') {
					
					echo "<form name='formulario' action='enviar_proceso_compra.php' method='post' onSubmit='return validate();' >";
					
					echo "<center><h3>Introduzca el numero de factura: <input type='text' name='factura' size='25' id='factura' class='required' /></h3></center>";
					echo "<p>";
					
					
					echo "<table class='dtable' border='1' align='center'>
					<tr>
					
					<th>Medicamento</th>
					<th>Código de Barra</th>
					<th>Cantidad Pedida</th>
					<th>Cantidad Pendiente</th>
					<th>Cantidad Recibida</th>
					<th>Cantidad Regal&iacute;a</th>
					<th>Lote</th>
					<th>Fecha de Vencimiento</th>
					<th>Costo Unitario</th>
					<th>Descuento Unitario</th>
					<th>Factura Proveedor</th>
					<th>No Fue Recibido?</th>
					<th>Hist.</th>
					</tr>";
					
					$con = 1;
					
					$rows = ocompra::each2($rw7->id_compra);
					
					foreach($rows as $rw1){																
						
						echo "<tr>";
						echo "<td><input type='text' name='medicamento[]' size = '50' value='". $rw1->medicamento . "' readonly /></td>";
						echo "<td><input type='text' name='codigo_de_barra[]' size = '25' value='". $rw1->codigo_de_barra . "' readonly /></td>";
						echo "<td><input type='text' name='cantidad_compra[]' size = '10' value='". $rw1->cantidad . "' readonly /></td>";
						echo "<td><input type='text' name='cantidad_pendiente[]' id='cantidad_pendiente".$con."' size = '10' value='". $rw1->cantidad_pendiente . "' readonly /></td>";
						echo "<td>  <input type='text' name='cantidad_entregada[]' size = '10'  id='cantidad_entregada".$con."'  onKeyPress='return numbersonly(this, event)' /> <input type='hidden' name='medicamento_id[]' value='". $rw1->medicamento_id . "' readonly/>
						<input type='hidden' name='linea[]' value='". $rw1->linea . "' readonly/> 
						<input type='hidden' name='id_compra' value='". $rw1->id_compra . "' readonly /> 
						</td>";
						echo "<td><input type='text' name='cantidad_regalia[]' id='cantidad_regalia".$con."' size = '10' /></td>";
						
						echo "<td><input type='text' name='lote[]' size = '15'   class='required' /><input type='hidden' name='tipo_impuesto[]' value='". $rw1->tipo_impuesto . "' size = '25' class='required' /></td>";
					echo "<td>"; ?>
					<table class='dtable' border="0"><tr><td>
						<select name="anio[]" <?="id='anio".$con."'"?> >
							<option value= "2016">2016</option>
							<option value= "2017" >2017</option>
							<option value= "2018" >2018</option>
							<option value= "2019" >2019</option>
							<option value= "2020" >2020</option>
							<option value= "2021" >2021</option>
							<option value= "2022" >2022</option>
						<option value= "2023" >2023</option></select></td><td>
						<select name="mes[]" <?="id='mes".$con."'"?> >
							<option value="01" >01</option>
							<option value="02" >02</option>
							<option value="03" >03</option>
							<option value="04" >04</option>
							<option value="05" >05</option>
							<option value="06">06</option>
							<option value="07" >07</option>
							<option value="08" >08</option>
							<option value="09">09</option>
							<option value="10" >10</option>
							<option value="11" >11</option>
							<option value="12" >12</option>
						</select></td><td>
						<select name="dia[]" <?="id='dia".$con."'"?>  >
							<option value="01" >01</option>
							<option value="02" >02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05" >05</option>
							<option value="06" >06</option>
							<option value="07" >07</option>
							<option value="08" >08</option>
							<option value="09" >09</option>
							<option value="10" >10</option>
							<option value="11" >11</option>
							<option value="12" >12</option>
							<option value="13" >13</option>
							<option value="14" >14</option>
							<option value="15" >15</option>
							<option value="16" >16</option>
							<option value="17" >17</option>
							<option value="18" >18</option>
							<option value="19" >19</option>
							<option value="20" >20</option>
							<option value="21" >21</option>
							<option value="22" >22</option>
							<option value="23" >23</option>
							<option value="24" >24</option>
							<option value="25" >25</option>
							<option value="26" >26</option>
							<option value="27" >27</option>
							<option value="28" >28</option>
							<option value="29" >29</option>
							<option value="30" >30</option>
							<option value="31" >31</option>
						</select></td></tr></table>
						<?php
							echo "</td>";
							echo "<td><input type='text' name='costo[]' id='costo".$con."'   size = '10' class='required'/></td>";
							//echo "</td>";
							echo "<td><select name='tipo_descuento[]' id='tipo_descuento".$con."'><option value='1'>Porcentaje</option><option value='2'>Valor Descuento</option></select> <input type='text' name='descuento_unitario[]' id='descuento_unitario".$con."' size = '10' value='". $rw1->descuento_unitario . "'  /> <input type='hidden' name='descuento_uni[]' id='descuento_uni".$con."' size = '10'/></td>";
							echo "<td><input type='text' name='factura_proveedor[]'  id='factura_proveedor".$con."' size = '25' class='required' /></td>";
						?>
						<td><input type="checkbox" name="no_recibido[]" value="<?=$rw1->linea?>" /></td>
						<td><input type="button" name="historial"  value="Historial" id="historial" onClick="javascript:popUp('historial_compras.php?medicamento_id=<?=$rw1->medicamento_id?>&id_compra=<?=$rw1->id_compra?>')" />
							<?php
								echo "</tr>";
								$con = $con + 1;
								
							}
							echo "</table> <p>"; 
							
							echo "<input type='submit' name='procesar' value='Procesar' />";
							
							echo "</form>";
							
							
							} else {
							
							echo "Esta orden ya fue procesada!";
							
						}
				}
				
			}
			
		?>
	<?=layout::fin_content()?>
	<script language="javascript" type="text/javascript" src="../js/script.js"></script>
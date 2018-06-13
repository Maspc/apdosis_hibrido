<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/anular_orden_compra.php');
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
		else if ((("0123456789").indexOf(keychar) > -1))
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
	
	//-->
</SCRIPT>

<script>
	function validate()
	{
		var factura = document.formulario.factura;
		
		
		
		if (factura.value == "")
		{
			window.alert("Por favor introduzca el no. de factura");
			factura.focus();
			return false;
		}
		
		
		
	}
</script>

<?php
	layout::menu();
	layout::ini_content();
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="estado" id="estado">
	<center><h2>Anular Orden de Compra</h2></center><p>
		
		<table class="dtable" width="780" border="0" cellspacing="0" >
			
			<tr>
				<td>
					<table class="dtable" width="510" border="1" cellspacing="0" bordercolor="#000000" align="center">
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
			$rows7 = a_ocompra::anular_ocompra($compra);
			
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
				if ($rw7->estado == 'P'  ) {
					
					echo "<form name='formulario' action='enviar_anula_compra.php' method='post' >";
					
					
					echo "<table class='dtable' border='1' align='center'>
					<tr>
					
					<th>Medicamento</th>
					<th>Cantidad Pedida</th>
					</tr>";
					
					$rows = a_ocompra::each2($rw7->id_compra);
					
					foreach($rows as $rw1){
						echo "<tr>";
						echo "<td><input type='text' name='medicamento[]' size = '100' value='". $rw1->medicamento . "' readonly /></td>";
						echo "<td><input type='text' name='cantidad_compra[]' size = '20' value='". $rw1->cantidad . "' readonly /></td>";
						echo " <input type='hidden' name='medicamento_id[]' value='". $rw1->medicamento_id . "' readonly/>
						<input type='hidden' name='linea[]' value='". $rw1->linea . "' readonly/> 
						<input type='hidden' name='id_compra' value='". $rw1->id_compra . "' readonly /> 
						";
						echo "</tr>";
					}
					
					echo "</table> <p>"; 
					
					echo "<input type='submit' name='procesar' value='Anular' />";
					
					echo "</form>";
					
					
					} else {
					
					echo "Esta orden ya fue procesada, no se puede anular!";
					
				}
			}
		}
		
	?>
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
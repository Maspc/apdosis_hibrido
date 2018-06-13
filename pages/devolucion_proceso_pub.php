<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/devolucion_pub.php');	
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	if (isset($_GET['men'])){
	$men = $_GET['men'];}
	else{
		$men = 0;
	}
	
	
	$factura = $_GET['factura'];
	
	echo "<h2> No. Factura ".$factura."  </h2><p></p>";
	
	echo "<table border='1'>
	<tr>
	
	<th>Producto</th>
	
	</tr>";
	
	$rows = dvolucpub::select5($factura);
	
	foreach($rows as $rws)
	{
		echo "<tr>";
		echo "<td>".$rws->medicamento. "</td>";
		
		
		
		echo "</tr>";
	}
	echo "</table> <p></p>";
	
	
	
	echo "  <hr /><p></p>";
	
	echo "<h2>Devoluci&oacute;n de Facturas </h2> <p></p>";
	echo "<form name='devo' id='devo' method='post' action='enviar_devolucion_pub.php'>";
	echo "<p></p>";
	echo "Motivo de la Devoluci&oacute;n: <select name='motivo' id='motivo'><option value='1'>Rechazo</option> <option value='2'>Error de Carga</option></select> ";
	
	echo"<p><b>***Introduzca las cantidades del producto a devolver en el campo Devoluci&oacute;n y seleccione el producto con un gancho***</b></p>";
	
	if ($men == 1) {
		echo "<P>NO PUEDE ENVIAR UNA DEVOLUCION EN BLANCO, POR FAVOR VERIFIQUE QUE INTRODUJO EL MONTO A DEVOLVER<P>";
	}
	
	echo "<table border='1'>
	<tr>
	
	<th>Medicamento</th>
	<th>Precio Unitario</th>
	<th>Cantidad de Dosis</th><th>Devolucion</th><th>Devolver?</th>
	</tr>";
	
	
	$factura = $_GET['factura'];
	
	$r = 0;
	
	$rows2 = dvolucpub::select6($factura);
	foreach($rows2 as $rws2)
	{
		$r = $r + 1;
		echo "<tr>";
		echo "<td> <input type='text' name= 'medicamento[]' value='" . $rws2->medicamento ."' size='50' readonly /> <input type='hidden' name='medicamento_id[]' value='" . $rws2->medicamento_id ."'/> <input type='hidden' name='cargo' value='" . $factura ."'/></td>";
		echo "<td> 	<input type='text' name='precio_unitario[]' value='" . ($rws2->precio_unitario - $rws2->descuento_unitario) ."' readonly /></td>
		<input type='hidden' name='impuesto[]' value='" . $rws2->impuesto ."' readonly /></td>
		<input type='hidden' name='factura' value='". $rws2->factura ."' readonly />
		";
		
		
		
		
		
		echo "<td> <input type='text' name='cant[]' id='cant_".$r."' value='" . $rws2->cantidad_dev ."' readonly /></td>";
		echo "<td> <input type='text' name='devol[]' id ='devol_".$r."' onChange='checkIt(".$r.")' /></td>";
		echo "<td> <input type='checkbox' name='check[]' id='check' value='S' /></td>";
		
		echo "</tr>";
	}
	
	echo "</table> <p>";
	
	echo "<input name='devolu' type='submit' value='Enviar' disabled='disabled' onClick=\"this.form.submit(); this.disabled=true; this.value='Sending…'; \" />";
	echo "</form>";
	
	echo "";
	
	
	layout::fin_content();					
	
?>
<script type="text/javascript">
	function limpiar_campos()
	{
		
		document.getElementById('medicamento').value='';
		document.getElementById('dosis').value='';
	}
	
	function checkIt(valor) {
		devolucion = "devol_"+valor;
		cantidad = "cant_"+valor;
		cantidad_prep = "cantprep_"+valor;
		//alert("Devolucion "+devolucion);
		//alert("Cantidad "+cantidad);
		
		
		if (parseInt(document.getElementById(devolucion).value) > parseInt(document.getElementById(cantidad).value)) {
			alert("La cantidad a devolver no puede ser mayor a la cantidad existente");
			document.getElementById(devolucion).value = document.getElementById(cantidad).value;
			document.getElementById(devolucion).focus();
			document.getElementById(devolucion).select();
			return false
			} else {
			return true
		}
		
		
		
		
	}
	
	
</script><!-- End css3menu.com HEAD section -->


<script type='text/javascript'>//<![CDATA[ 
	$(function(){
		var checkboxes = $("input[type='checkbox']"),
		submitButt = $("input[type='submit']");
		
		checkboxes.click(function() {
			//alert("entro aqui");
			submitButt.attr("disabled", !checkboxes.is(":checked"));
		});
	});//]]>  
	
</script>
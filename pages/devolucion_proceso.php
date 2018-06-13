<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/devolucion_pub.php');	
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	if (isset($_GET['userid'])){
	$userid = $_GET['userid'];}
	if (isset($_GET['session'])){
	$session = $_GET['session'];}
	
	if (isset($_GET['men'])){
	$men = $_GET['men'];}
	else{
		$men = 0;
	} 
	
	$factura = $_GET['cargo'];
	
	echo "<h1> No. Factura ".$factura."  </h1>";

	$rows6 = dvolucpub::select25($factura);
	
	$rows = dvolucpub::select26($factura);
	
	echo "<table border='1'>
	<th>Identificacion</th>
	<th>Nombre</th>
	";
	
	foreach($rows6 as $rw6){
		echo "
		<tr>
		<td>".$rw6->historia."</td>
		<td>".$rw6->nombre_paciente."</td>
		</tr>
		";
		
		$tratamiento=$rw6->tratamiento;
		$historia=$rw6->historia;
		$despacho =$rw6->despacho;
		$factura=$rw6->factura;
		//echo 'historia '.$historia;
		//echo 'tratamiento '.$tratamiento;
		//echo 'despacho '.$despacho;
		
	}
	
	echo "</table>";
	
	echo "<table border='1'>
	<tr>
	
	<th>Medicamento</th>
	<th>Forma Farmaceutica</th>
	<th>Dosis</th>
	<th>Cada Horas</th>
	<th>Por Dias</th>
	</tr>";
	
	foreach($rows as $rws){
		echo "<tr>";
		echo "<td>" . $rws->medicamento . "</td>";
		echo "<td>" . $rws->descripcion . "</td>";
		echo "<td>" . $rws->dosis . "</td>";
		echo "<td>" . $rws->horas . "</td>";
		echo "<td>" . $rws->dias . "</td>";
		
		
		echo "</tr>";
	}
	echo "</table> <p>";
	
	
	
	echo "  <hr /><p>";
	
	echo "<h1>Devolución de Cargos </h1> <p>";
	echo "<form name='devo' id='devo' method='post' action='enviar_devolucion.php'>";
	echo "<p>";
	//echo "Marcar como urgente: <input name='stat' type='checkbox' value='S' />  ";
	
	echo"<p><h2><b>***Introduzca las cantidades de medicamentos a devolver en el campo Devolucion y seleccione el medicamento con un gancho***</b></h2></p>";
	
	if ($men == 1) {
		echo "<P>NO PUEDE ENVIAR UNA DEVOLUCION EN BLANCO, POR FAVOR VERIFIQUE QUE INTRODUJO EL MONTO A DEVOLVER<P>";
	}
	
	echo "<table border='1'>
	<tr>
	
	<th>Medicamento</th>
	<th>Forma Farmaceutica</th>
	<th>Dosis</th>
	<th>Cada Horas</th>
	<th>Por Dias</th><th>Cantidad de Dosis</th><th>Devolucion</th><th>Devolver?</th>
	</tr>";
	
	
	$cargo2 = $_GET['cargo'];
	
	$r = 0;
	$rows = dvolucpub::select27($factura);
	foreach($rows as $rws){
	
		$r = $r + 1;
		echo "<tr>";
		echo "<td> <input type='text' name= 'medicamento[]' value='" . $rws->medicamento ."' readonly /> <input type='hidden' name='medicamento_id[]' value='" . $rws->medicamento_id ."'/> <input type='hidden' name='cargo' value='" . $factura ."'/></td>";
		echo "<td> <input type='text' name='forma[]' value='" . $rws->descripcion ."' readonly /></td>";
		echo "<td> <input type='text' name='dosis[]' value='" . $rws->dosis ."' readonly /></td>";
		echo "<td> <input type='text' name='horas[]' value='" . $rws->horas ."' readonly /></td>";
		echo "<td> <input type='text' name='dias[]' value='" . $rws->dias ."' readonly />
		<input type='hidden' name='historia[]' value='" . $historia ."' readonly />
		<input type='hidden' name='tratamiento[]' value='" . $tratamiento ."' readonly />
		<input type='hidden' name='despacho[]' value='" . $despacho ."' readonly /></td>;
		<input type='hidden' name='precio_unitario[]' value='" . $rws->precio_unitario ."' readonly /></td>
		<input type='hidden' name='costo_insumo[]' value='" . $rws->costo_insumo ."' readonly /></td>
		<input type='hidden' name='impuesto[]' value='" . $rws->impuesto ."' readonly /></td>
		<input type='hidden' name='precio_venta[]' value='" . $rws->precio_venta ."' readonly /></td>
		<input type='hidden' name='userid' value='" . $userid ."' readonly />
		<input type='hidden' name='session' value='1111' readonly />
		<input type='hidden' name='fa' value='". $rws->FA ."' readonly />
		<input type='hidden' name='tipo_de_dosis[]' value='". $rws->tipo_de_dosis ."' readonly />";
		
		
		echo "<td> <input type='text' name='cant[]' id='cant_".$r."' value='" . $rws->cantidad_dev ."' readonly /></td>";
		echo "<td> <input type='text' name='devol[]' id ='devol_".$r."' onChange='checkIt(".$r.")' /></td>";
		echo "<td> <input type='checkbox' name='check[]' id='check' value='S' /></td>";
		
		echo "</tr>";
	}
	
	echo "</table> <p>";
	
	echo "<input name='devolu' type='submit' value='Enviar' disabled='disabled' />";
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
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/editar_medicamentos_inv.php');
	$medicamento_id= $_GET['medicamento_id'];
	
	header('Content-Type: text/html; charset=ISO-8859-1'); 
	
	echo "<table border='1' align='center'><tr><th>Lote</th><th>Fecha de Vencimiento</th><th>Cantidad</th><th>Costo</th></tr>";
	$row = emedica::select4($medicamento_id);
	
	foreach($row as $rw){
		echo "<tr> <td> ". $rw->lote ."</td>";
		echo "<td> ". $rw->fecha_vencimiento ."</td>";
		echo "<td> ". $rw->cantidad ."</td>";
		echo "<td> ". $rw->costo ."</td>";
		echo "</tr>";
	}
	
	echo "</table>";
	
	echo "<p><p><input type='button' name='cerrar' value= 'Cerrar Ventana' onclick='window.close();'>";
		
?>

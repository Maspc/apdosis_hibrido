<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/borrar_medicamento.php');
	$medicamento_id= $_GET['medicamento_id'];
	
	header('Content-Type: text/html; charset=ISO-8859-1'); 
	
	$cant = 0;
	
	$hora_actual = date("Y-m-d H:i",time());
	
	$fres = bmedica::select1($medicamento_id);
	
	$bres = bmedica::select2($medicamento_id);
	
	foreach($bres as $bw){
		$cant = $bw->cantidad;
	}
	
	if (count($fres) > 0 || $cant > 0) {
		echo "Este art&iacute;culo no se puede borrar ya que tiene transacciones o cantidad en inventario, solo puede inactivarlo para su uso";
		}else{
		
		bmedica::delete1($medicamento_id);
		
		bmedica::delete2($medicamento_id);
		
		echo "Borro exitosamente el art&iacute;culo";
		
		bmedica::insert1($medicamento_id,$hora_actual,$_SESSION['MM_iduser']);
	}
	
	echo "<p><p><input type='button' name='cerrar' value= 'Cerrar Ventana' onclick='window.close();'>";
	
?>

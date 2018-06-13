<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/ver_facturas.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
	
	$query_Recordset1 = vfactura::verfactura($_GET['codigo_cliente']);	
	
	
	
	echo "<table border='1'> <tr> 
	<th>Tipo</th>
	<th>Id. Interno</th>
	<th>Total</th>
	
	<th>Fecha</th>
	</tr>";
	foreach($row_Recordset1 as $rc1){
		echo "<tr>";
		echo "<td>".$rc1->tipo."</td>";
		echo "<td>".$rc1->factura."</td>";
		echo "<td align = 'center'>".round($rc1->total,2) ."</td>";
		/*echo "<td align = 'center'>".$rc1->saldo_pendiente."</td>";*/
		echo "<td>".$rc1->fecha."</td>";
		echo "</tr>";
	}
	
	layout::fin_content();
?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
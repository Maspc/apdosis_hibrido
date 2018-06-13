<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/enviar_list_facturas_f.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	$desde = $_POST['desde'];
	$hasta = $_POST['hasta'];
	$id_paciente = $_POST['id_paciente'];
	
	$Recordset1 = enviarl::select1($id_paciente,$desde,$hasta);
	
	$totalRows_Recordset1 = count($Recordset1);
	
	$l = 0;
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
<center><h1>Listado de facturas desde <? echo $desde; ?> hasta <? echo $hasta; ?> </h1></center><p>
	<table border="1" cellpadding="1" cellspacing="1">
		<tr> 
			<th>No. Solicitud</th>
			<th>Historia </th>
			<th>Nombre Paciente</th>
			<th>No. Cama</th>
			<th>Total de Factura</th>
			<th>Factura Fiscal</th>
			<th>Fecha de Creación</th>
		</tr>
		<?php foreach($Recordset1 as $row_Recordset1) {  ?>
			<tr>
                <td><?php echo $row_Recordset1->fa; ?></td>
				<td><?php echo $row_Recordset1->historia; ?></td>
				<td><?php echo $row_Recordset1->nombre_paciente; ?></td>
				<td><?php echo $row_Recordset1->no_cama; ?></td>
				<td><?php echo $row_Recordset1->total; ?></td>
				<td><?php echo $row_Recordset1->factura_fiscal; ?></td>
				<td><?php echo $row_Recordset1->fecha_creacion; ?></td>	
				
			</tr>
		<?php } ?>
	</table>
</center>
<?=layout::fin_content()?>
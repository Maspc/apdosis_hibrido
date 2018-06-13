<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/factura_diaria.php');
	require_once('../modulos/reporte_z.php');
	require_once('../modulos/layout.php');
	include('./buscar_fiscal.php');
	
	layout::encabezado();
?>
<script type="text/javascript">
	function toggleDiv(divId) {
		$("#"+divId).toggle();
	}
</script><!-- End css3menu.com HEAD section -->

<script type="text/javascript">
	function valideopenerform(){
		
		
		var popy= window.open('popup_autoriza_dev.php','popup_form','location=no,menubar=no,status=no,top=50%,left=50%,height=150,width=200');
		
	}
</script>
<?php
	layout::menu();
	layout::ini_content();
?>

<center><h1><font size="4">Facturas Diarias del Usuario: <?php echo $_SESSION['MM_iduser']; ?> </font></h1></center>

<p></p>
<p></p>
<p></p><center>
	
	<?php
		$korow = fdiaria::select1($_SESSION['MM_iduser']);
		foreach($korow as $kw){
			$caja_id = $kw->caja_id;
			$nombre = $kw->nombre;
		}
		
		if($caja_id != 0){
			
			$korow = fdiaria::select2($_SESSION['MM_iduser']);
			
			echo "<table class='dtable' border='1' cellpadding='1'>
			<tr><th>No. FACTI</th>
			<th>Fecha</th>
			<th>Nombre Cliente</th>
			<th>C&eacute;dula o RUC </th>
			<th>Total</th>
			<th>Estado</th>
			<th>Caja</th>
			<th>Equipo Fiscal</th>
			<th>Factura Fiscal</th></tr>";
			
			foreach($korow as $kow){
				
				if($kow->estado_factura == 'I'){
					$imp = 'IMPRESA';
					$color = 'green';} else{
					$imp = 'NO IMPRESA';
					$color= 'red';
				}
				
				echo "<tr><td>".$kow->factura."</td>
				<td>".$kow->nombre_cliente."</td>
				<td>".$kow->fecha."</td>
				<td>".$kow->id_paciente."</td>
				<td>".$kow->total."</td>
				<td><font color='".$color."'>".$imp."</td>
				<td>".$kow->caja_id."</td>
				<td>".$kow->equipo_fiscal."</td>
				<td>".$kow->factura_fiscal."</td>
				<td><input type='button' name='reimprimir' value='Reimprimir' onClick=\"window.open('enviar_factura_r.php?no_factura=".$kow->factura."','mywindow','width=1250,height=750,toolbar=yes, scrollbars=yes'); this.disabled=true; this.value='Imprimiendo…'; \"'> </td></tr>";
				
			}
			
			echo "</table>";
			
			}else{
			echo "<p><h1>Usted no puede facturar si escogió la opción 'NINGUNA CAJA'. Si desea facturar debe salir del sistema y escoger la caja adecuada.</h1></p>";
		}
		
	?>
	
	
</center>		

<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
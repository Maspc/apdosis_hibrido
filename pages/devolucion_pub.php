<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/devolucion_pub.php');	
	require_once('../modulos/layout.php');
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

<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="estado" id="estado">
	<center><h1>Devoluciones P&uacute;blico</h1></center>
	
	<?php
		
		$korow = dvolucpub::select1($_SESSION['MM_iduser']);
		foreach($korow as $kw){
			$caja_id = $kw->caja_id;
			$nombre = $kw->nombre;
		}
		
		if($caja_id != 0){							
			
			$kerow = dvolucpub::select2();
			foreach($kerow as $kew){
				$nombre_dia = $kew->nombre;
			}
		?>
		
		<p>
			Esta facturando en la caja: <?php echo $nombre; ?>, con el usuario: <?php echo $_SESSION['MM_iduser']; ?>.
		</p>
		
		
		<table width="780" border="0" cellspacing="0" align="center" >
			
			<tr>
				<td>
					<table width="510" border="1" cellspacing="0" bordercolor="#000000" align="center">
						<tr>
							<td>Ref. Factura (FACTIC)</td>
							<td><input name="factura" type="text" size="20" /></td>
						</tr>
						
						<tr>
							<td>Cargo</td>
							<td><input name="cargo" type="text" size="20" /></td>
						</tr>
						
					</table>
					
					
					<div align="center">
						<input name="buscar" type="submit" value="Buscar Factura" />  
					</div></td>
			</tr>
		</table>
		
		<center>	<p>Para realizar una devoluci&oacuten debe existir la factura fiscal del producto a devolver.</p></center>
	</form>
	<?php     
		if(isset($_POST['buscar'])){
			
			//include('buscar_fiscal.php');
			if(isset($_POST['factura']) && $_POST['factura']!="")
			{
				$where[] = "factura.factura = '".$_POST['factura']."'";
			}
			if(isset($_POST['cargo']) && $_POST['cargo']!="")
			{
				$where[] = "factura.id_paciente = '".$_POST['cargo']."'";
			}
			
			//echo "valido: ".$valido;
			
			$grow = dvolucpub::select3($where);
			
			foreach($grow as $gw){
				$factura = $gw->factura;
				echo "<table border = '1'>";
				echo "<tr><td>Cliente:</td><td>".$gw->codigo_cliente." - ".$gw->nom_cliente."</td></tr>";
				echo "<tr><td>Referencia:</td><td>".$factura."</td></tr>";
				echo "<tr><td>Total:</td><td>".$gw->total."</td></tr></table>";
			}
			
			$qrow = dvolucpub::select4($factura);
			echo "<p><table border='1'><tr><td>Producto</td><td>Precio Unitario</td><td>Impuesto</td><td>Cantidad</td><td>Devolver?</td></tr>";
			
			$diferencia = 0;
			foreach($qrow as $qw){
				
				$diferencia = $qw->cantidad - $qw->devolucion;
				
				
				echo "<tr><td>".$qw->medicamento."</td>";
				echo "<td>".($qw->precio_unitario - $qw->descuento_unitario )."</td>";
				echo "<td>".$qw->impuesto."</td>";
				echo "<td>".$qw->cantidad."</td>";
				if ($diferencia > 0){
				?>
				
				
				<td><input type="button" name="devolver" value="Devolver de esta Factura" onClick="parent.location='devolucion_proceso_pub.php?factura=<?php echo $factura; ?>'"></td>
			<?php }else {  echo "<td><b>Ya fue devuelto</b></td>"; } } echo "</table>"; }?>
					
			
<?php } else { echo "<p><h1>Usted no puede facturar si escogió la opción 'NINGUNA CAJA'. Si desea facturar debe salir del sistema y escoger la caja adecuada.</h1></p>";}  ?>
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
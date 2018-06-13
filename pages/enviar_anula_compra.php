<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/pedidos_compras.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
	
	if (isset($_POST['id_compra'])) {
		$id_compra = $_POST['id_compra'];
	}
	pcompras::anula_p1($id_compra);
	
	echo "<h2>La orden de compra ".$id_compra." fue anulada</h2>";
	
?>
<p>
	<input type="button" value="Imprimir Anulación de Orden de Compra" class="green" onClick="window.open('imprimir_anula_compra.php?compra=<?php echo $id_compra ?>')" />
	
	<?=layout::fin_content()?>
	<script type="text/javascript">
		function toggleDiv(divId) {
			$("#"+divId).toggle();
		}
	</script>
	<script language="javascript" type="text/javascript" src="../js/script.js"></script>
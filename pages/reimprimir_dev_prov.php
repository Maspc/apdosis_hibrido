<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/reimprimir_dev_prov.php');
	$cont = 0;
	require_once('../modulos/layout.php');
	layout::encabezado();
?>
<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:1200px;dialogHeight:600px");
			} else {
			alert(url);
			window.open(url,'name','height=500,width=600,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} 
</script>
<?php
	layout::menu();
	layout::ini_content();
?>
<form action="reimprimir_devolucion_vencimiento.php" method="post" name="reimprimir" id="reimprimir">
	
	
	
	<tr>
		<td>
			<label>Introduzca el numero de la devoluci&oacute;n a proveedor a reimprimir
			<input name="devolucion" type="text" size="20" /></label>
			<input name="buscar" type="submit" value="Reimprimir" />
		</td>
	</tr>
	
	
</form>
</div>
<?=layout::fin_content()?>	
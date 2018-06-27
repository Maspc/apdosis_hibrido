<?php 
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/borrar.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	$userid = $_GET['userid'];
	
	borrar::delete1($userid);
?>

Borrando temporales.<p>
	<font size="+3" color="#FF0000">NO CIERRE ESTA VENTANA, SE CERRAR&Aacute; AUTOM&Aacute;TICAMENTE<font>
		
		<?=layout::fin_content()?>
		<SCRIPT LANGUAGE="JavaScript"><!--
			setTimeout('self.close()',2000);
		</SCRIPT>				
<?php
	ob_start();
	include ('./clases/session.php');
	//require_once('../modulos/error_salida.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	if (isset($_GET['historia'])) { 
	$historia = $_GET['historia'];}
	
	if (isset($_GET['cargo'])) { 
	$cargo = $_GET['cargo'];}
	
	if (isset($_GET['usuario'])) { 
	$usuario = $_GET['usuario'];}
	
?>
<h2> La historia <?php echo $historia ?> est&aacute; inactiva,  el cargo <?php echo $cargo ?> fue realizado por el usuario <?php echo $usuario ?>, el depto. de enfermer&iacute;a debe darle Salida al Paciente desde Apdosis para que sea cancelado. </h2>
<?=layout::fin_content()?>

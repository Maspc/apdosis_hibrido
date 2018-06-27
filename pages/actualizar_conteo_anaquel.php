<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/actualizar_conteo_anaquel.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	echo "<body onunload=\"opener.location=('apertura_cierre_anaquel.php')\">";
	echo "<font face='Arial, Helvetica, sans-serif' size='+1'>";
	
	if (isset($_GET['anaquel'])){
		$anaquel = $_GET['anaquel'];
	}
	if  (isset($_GET['conteo'])){
		$conteo = $_GET['conteo'];
	} 
	if  (isset($_GET['estado'])){
		$estado = $_GET['estado'];
	} 
	
	$Hora = Time(); // Hora actual
	$hora_actual =  date('Y-m-d H:i',$Hora); 
	$usuario = $_SESSION['MM_iduser'];
	
	$vres = actcona::select1($anaquel,$conteo);
	
	foreach($vres as $vrow){
		$estado_in = $vrow->estado; 
	}
	
	if ($estado == 'A'){
		
		$conteo = $conteo + 1;			  
		actcona::insert1($conteo,$anaquel,$hora_actual,$usuario);
		
		} else if ($estado == 'I') {
		
		actcona::update1($_SESSION['MM_iduser'],$hora_actual,$anaquel,$conteo);
	}
	
	
	
	
	
	echo "Se actualiz&oacute; exit&oacute;samente el estado del conteo";
	echo "<p><a href=\"JavaScript:window.close()\">Volver</a> "
	
	layout::fin_content();
	
?>
<script type="text/javascript">
	{
		if(history.forward(1))
		if(history.forward(1))
		location.replace(history.forward(1))
	}
</script>
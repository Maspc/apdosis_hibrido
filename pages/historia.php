<?php 
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/salida_paciente.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	if (isset($_GET['username'])){
	$username = $_GET['username'];}
	else {
		$username=' ';
	}
	if (isset($_GET['userid'])){
	$userid = $_GET['userid'];}
	//else{
	//$userid = 'ycastill';
	//}
	if (isset($_GET['session'])){
	$session = $_GET['session'];}
	
	if (isset($_GET['usu_crea'])){
	$usu_crea = $_GET['usu_crea'];}
	
	if (isset($_GET['historia'])){
	$historia = $_GET['historia'];}
	//else {
	//$session = '26fb1b77';
	//}
	include('sesion_activa.php');
	
	//echo $username;
	
	if ($estado_sesion == 'A') {
		$msg = " ";
		$mensaje = 'S';
		if (isset($_GET['mensaje'])){
			$mensaje = $_GET['mensaje'];
		}
		
		if ($mensaje == 'N') {
		$msg = "Esta historia no existe";}
		else if ($mensaje == 'U'){
			$msg = "La historia ".$historia." está siendo utilizada por el usuario: ".$usu_crea.". Por favor espere...";
			} else if ($mensaje == 'I'){
			$msg = "La historia ".$historia." está inactiva para este ingreso. Ya se le di&oacute; salida al paciente.";
			} else if ($mensaje == 'A'){
			$msg = "El paciente de la historia ".$historia." no tiene <b>Primer Nombre</b>, que es una informaci&oacute;n obligatoria, verif&iacute;que con Atenci&oacute;n al Cliente";
			}  else if ($mensaje == 'B'){
			$msg = "El paciente de la historia ".$historia." no tiene <b>Apellido Paterno</b>, que es una informaci&oacute;n obligatoria, verif&iacute;que con Atenci&oacute;n al Cliente";
			}  else if ($mensaje == 'C'){
			$msg = "El paciente de la historia ".$historia." no tiene <b>N&uacute;mero de Habitaci&oacute;</b>, que es una informaci&oacute;n obligatoria, verif&iacute;que con Atenci&oacute;n al Cliente";
			} else {
			$msg = " ";
			
		}
		
		$username = urldecode($username);
		
		
	?>
	<form action="indexh.php" method="post" name="historia">
		<label>Historia</label><input name="historia" type="text" size="25" />
		
		
		<input name="userid" type="hidden" value=<?php echo $userid; ?> size="25" />
		<input name="session" type="hidden" value=<?php echo $session; ?>  size="25" />
		<input name="username" type="hidden" value="<?php echo $username; ?>"  size="100" /> 
		<input name="bodega" type="hidden" value="N"  size="1" /> 
		<input name="cenvio" type="hidden" value="N"  size="1" /> 
		<input name="urg" type="hidden" value="N"  size="1" />
		<input name="Enviar" type="submit" />
		<?php echo "<p>".$msg ?>
		
	</form>
	<?php } else { echo "<script language='javascript'>window.location='http://192.168.3.2/cmp_appdosis/'</script>"; } 
	
	layout::fin_content();
?>
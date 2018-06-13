<?php
	
	include ('../clases/session.php'); 
	require_once('../modulos/facturacion.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	mysql_query("SET NAMES 'utf8'");
	if ( isset ($_GET['userName']) ){
	$userName = $_GET['userName'];}
	else{
		//header("Location: error.php");
		//$userName = 'Prueba';
	}
	if ( isset ($_GET['UserId'])) {
	$UserId = $_GET['UserId'];}
	else {
		$UserId = ' ';
	}
	if ( isset ($_GET['IdSession']) ){
	$IdSession = $_GET['IdSession'];}
	else {
		$IdSession = ' ';
	}
	$userid = $UserId;
	$session = $IdSession;
	include('sesion_activa.php');
	/*$r = "delete from registro_tmp where usuario_creacion = '$userid'";
		
		$res = mysql_query($r, $conn) or die(mysql_error());
		
		
		$rd = "delete from registro_detalle_tmp where usuario_creacion = '$userid'";
		
		$resd = mysql_query($rd, $conn) or die(mysql_error());
		
		
		$re = "delete from tratamiento_tmp where usuario_creacion = '$userid'";
		
		$red = mysql_query($re, $conn) or die(mysql_error());
		
		$rg = "delete from tratamiento_detalle_tmp where usuario_creacion = '$userid'";
		
		$rgd = mysql_query($rg, $conn) or die(mysql_error());
		
		$rl = "delete from factura_tmp where usuario_creacion = '$userid'";
		
		$rel = mysql_query($rl, $conn) or die(mysql_error());
		
		$rf = "delete from factura_detalle_tmp where usuario_creacion = '$userid'";
		
		$rfd = mysql_query($rf, $conn) or die(mysql_error());
		
		
		
		if ($estado_sesion == 'A') {
		
		$f = "select codigo_usuario, sesion from logs_usuarios where codigo_usuario = '$userid' ";
		$fres = mysql_query($f, $conn) or die(mysql_error());
		$fco = mysql_num_rows($fres);
		
		if ($fco > 0){
		$d = "update logs_usuarios set sesion = '$session' where codigo_usuario = '$userid'";
		$dres = mysql_query($d, $conn) or die(mysql_error());
		} else {
		$d = "insert into logs_usuarios (codigo_usuario, sesion, nombre_usuario) values ('$userid', '$session', '$userName')";
		$dres = mysql_query($d, $conn) or die(mysql_error());
	}*/
	
	
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%"><font color="#B8C0F0" face="Arial" size="2">
			
			<p style="display:none"><a href="http://css3menu.com/">My CSS Menu Css3Menu.com</a></p>
			<!-- End css3menu.com BODY section -->
			<ul id="css3menu1" class="topmenu">
				
				</ul>
				<p style="display:none"><a href="http://css3menu.com/">My CSS Menu Css3Menu.com</a></p>
				<!-- End css3menu.com BODY section -->
				
				
			</font></td>
		</tr>
	</table>
	<p style="margin-left: 20"><b><font color="#B8C0F0" face="Arial" size="+1">&nbsp;</font></b><font face="Arial" size="+1" color="#000000">
		
	Bienvenido a Apdosis <? echo $userName; ?>. La sesion es <? echo $IdSession; ?></font></p>
	<p style="margin-left: 20">
		<font size="+1" face="Arial, Helvetica, sans-serif"><b><a href="MANUAL_HOSPITAL.pdf">VER MANUAL AQU&Iacute;</a></b></font>
	</p>
<?=layout::fin_content()?>
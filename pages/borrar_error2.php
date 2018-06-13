<?php 
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/borrar_error2.php');
	$userid = $_GET['userid'];
?>
<html>
	<head>
		<SCRIPT LANGUAGE="JavaScript"><!--
			setTimeout('self.close()',5000);
		//--></SCRIPT>
		<script type="text/javascript" src="../js/timer.js"></script>
		
	</head>
	<body>
		<p align="center">
			<?php
				
				berror::delete1($userid);
			?>
		<font color="#FF0000" size="+3">ADVERTENCIA</font></p>
		<p align="center"><font size="+2">Ud. escogió un tipo de conversi&oacute;n de dosis no permitida en algún medicamento de su orden, por favor verifique.</font> </p><p align="center">
			<font size="+2">Esta p&aacute;gina se cerrar&aacute; en:</font>
			<div id="timer" align="center" style="font:large"> </div>
			<script type="text/javascript">window.onload = CreateTimer("timer", 5);</script>
		</body>
	</html>	
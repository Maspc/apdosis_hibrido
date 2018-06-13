<?php 
	
	require_once('../modulos/logout.php');
	
	session_start();
	$usuario = $_SESSION['MM_iduser'];
	
	salir::borrarTemp($usuario);
	session_destroy();
	
	header ("Location: ./login.php");
?> 


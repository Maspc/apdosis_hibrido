<?php
session_start();
if (!isset($_SESSION['autentificado']) or $_SESSION['autentificado'] == false) {
	header ("Location: ./login.php");
	exit;
}
?>
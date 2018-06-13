<?php 
session_start();
if (!$_SESSION['MM_iduser']) 
{
header("Location: login.php");
}
?>
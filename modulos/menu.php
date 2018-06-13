<?php
	require_once('../clases/conexion.php');
	
	class menu{
		
		public static function cierre_mes() {
			$cmes = conexion::sqlGet("select estado from cierre_de_mes");
			return $cmes;
		}
	}
	
?>
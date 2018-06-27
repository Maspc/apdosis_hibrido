<?php
	require_once('../clases/conexion.php');
	
	class menu{
		
		public static function select1() {
			$reg = conexion::sqlGet("select estado from cierre_de_mes");
			return $reg;
		}
	}
	
?>
<?php
	require_once('../clases/conexion.php');
	
	class itdetalle{
		
		public static function usuarios($user) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$user."'");
			return $reg;
		}
	}
	
?>
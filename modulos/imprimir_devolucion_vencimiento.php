<?php
	require_once('../clases/conexion.php');
	
	class idvencimiento{		
				
		public static function compania() {
			$reg = conexion::sqlGet("select nombre from compania");
			return $reg;
		}
		
		public static function usuarios($user) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$user."'");
			return $reg;
		}
	}
	
?>
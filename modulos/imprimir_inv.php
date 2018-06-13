<?php
	
	require_once('../clases/conexion.php');
	
	class impriinv{
		
		public static function usuarios($user) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$user."'");			
			return $reg;
		}
		
	}
	
?>
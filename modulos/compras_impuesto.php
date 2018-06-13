<?php
	
	require_once('../clases/conexion.php');
	
	class cimpuesto{		
		
		public static function usuarios($user) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$user."'");			
			return $reg;
		}
		
	}
	
?>
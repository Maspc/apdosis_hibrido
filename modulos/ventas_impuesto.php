<?php
	
	require_once('../clases/conexion.php');
	
	class vimpuesto{		
		
		public static function usuarios($user) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$user."'");			
			return $reg;
		}
		
	}
	
?>
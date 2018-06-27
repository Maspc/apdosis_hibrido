<?php
	require_once('../clases/conexion.php');
	
	class imprimir{
		
		public static function select1($MM_iduser) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$MM_iduser."'");			
			return $reg;
		}
		
	}
	
?>
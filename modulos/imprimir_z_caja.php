<?php
	require_once('../clases/conexion.php');
	
	class imprimir{
		
		public static function select1($MM_iduser) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$MM_iduser."'");			
			return $reg;
		}
		
		public static function select2($p_caja) {
			$reg = conexion::sqlGet("select nombre, nombre_impresora, caja_id from cajas where caja_id ='".$p_caja."'");			
			return $reg;
		}
		
		public static function select3($p_caja) {
			$reg = conexion::sqlGet("select nombre, nombre_impresora, caja_id from cajas where caja_id = '".$p_caja."'");			
			return $reg;
		}
		
	}
	
?>
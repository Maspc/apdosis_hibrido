<?php
	require_once('../clases/conexion.php');
	
	class fcredito{		
		
		public static function select1($user) {
			$reg = conexion::sqlGet("select a.caja_id, b.nombre from cajas_usuario a, cajas b where a.usuario = '".$user."' and a.caja_id = b.caja_id");			
			return $reg;
		}
		
		public static function select2() {
			$reg = conexion::sqlGet("select nombre from dias_descuento where dia_id = '". date("N",time())."'");			
			return $reg;
		}
		
	}
	
?>
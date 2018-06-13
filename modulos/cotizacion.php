<?php
	require_once('../clases/conexion.php');
	
	class cotizacion{
		
		public static function select1() {
			$reg = conexion::sqlGet("select password from autorizaciones where tipo = 'descuento'");			
			return $reg;
		}
		
		public static function select2($user) {
			$reg = conexion::sqlGet("select a.caja_id, b.nombre from cajas_usuario a, cajas b where a.usuario = '".$user."' and a.caja_id = b.caja_id");			
			return $reg;
		}
		
		public static function select3() {
			$reg = conexion::sqlGet("select nombre from dias_descuento where dia_id = '". date("N",time())."'");			
			return $reg;
		}
		
	}
	
?>
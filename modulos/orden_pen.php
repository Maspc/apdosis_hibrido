<?php
	require_once('../clases/conexion.php');
	
	class open{
		
		public static function usuarios($user) {
			$reg = conexion::sqlGet("select nombre from usuarios where user = '".$user."'");
			return $reg;
		}
		
		public static function bodegas_e() {
			$reg = conexion::sqlGet("select ip from bodegas_externas where bodega='1'");
			return $reg;
		}
		
		public static function select1($bd) {
			$reg = conexion::sqlGet("SELECT id_compra, fecha_compra, usuario_creacion from compras where estado = 'P' and externo = 'S'",$bd);
			return $reg;
		}	
		
		public static function select2($id_compra,$bd) {
			$reg = conexion::sqlGet("select 1 from compras_detalle where id_compra = '".$id_compra."'",$bd);
			return $reg;
		}
		
		public static function select3($bd) {
			$reg = conexion::sqlGet("SELECT id_compra, fecha_compra, usuario_creacion from compras where estado = 'P' and externo = 'S'",$bd);
			return $reg;
		}
		
		public static function select4($bd) {
			$reg = conexion::sqlGet("SELECT id_compra, fecha_compra, usuario_creacion from compras where estado = 'F' and externo = 'S' and aceptada != 'S'",$bd);
			return $reg;
		}
		
	}
	
?>
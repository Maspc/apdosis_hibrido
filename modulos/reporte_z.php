<?php
	
	require_once('../clases/conexion.php');
	
	class reportez{		
		
		public static function cajas() {
			$reg = conexion::sqlGet("SELECT caja_id, nombre FROM cajas WHERE estado = 'A'");			
			return $reg;
		}
		
		public static function usuarios($user) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$user."'");			
			return $reg;
		}
		
		public static function select1($p_caja) {
			$reg = conexion::sqlGet("select nombre, nombre_impresora, caja_id from cajas where caja_id ='".$p_caja."'");			
			return $reg;
		}
		
		public static function select2($p_caja) {
			$reg = conexion::sqlGet("select nombre, nombre_impresora, caja_id from cajas where caja_id = '".$p_caja."'");			
			return $reg;
		}
		
		public static function select5() {
			$reg = conexion::sqlGet("select factura.estado_factura, factura.factura, factura.total, factura.fecha, factura.ordenado_por,
			factura.caja_id
			from  factura where factura.factura_fiscal = ' ' and factura.estado_factura in ('I', 'F')");			
			return $reg;
		}
		
		public static function select6($factura) {
			$reg = conexion::sqlGet("select b.caja_id, a.ruta_salida from cajas a, factura b where a.caja_id = b.caja_id and b.factura = '".$factura."'");			
			return $reg;
		}
		
		public static function select7($caja_id) {
			$reg = conexion::sqlGet("select nombre_impresora from cajas where caja_id = '".$caja_id."'");			
			return $reg;
		}
		
		public static function update1($h,$g,$archivo,$factura) {
			conexion::trQry("update factura set factura_fiscal = '".$h."', equipo_fiscal = '".$g."',  archivo_fiscal = '".$archivo."', hora_impresion_fiscal = '".date('Y-m-d H:i',time())."', estado_factura = 'I' where factura = '".$factura."'");			
			return 1;
		}
		
		public static function select8() {
			$reg = conexion::sqlGet("select devolucion.estado, devolucion.devolucion, devolucion.total, devolucion.fecha_creacion from devolucion where  devolucion.estado in ('E', 'I') and devolucion.factura_fiscal = ' '");			
			return $reg;
		}
		
		public static function select9($devolucion) {
			$reg = conexion::sqlGet("select b.caja_id, a.ruta_salida from cajas a, devolucion b where a.caja_id = b.caja_id and b.devolucion = '".$devolucion."'");			
			return $reg;
		}
		
		public static function update2($h,$g,$archivo,$devolucion) {
			conexion::trQry("update devolucion set factura_fiscal = '".$h."', equipo_fiscal = '".$g."', archivo_fiscal = '".$archivo."', estado = 'E' where devolucion = '".$devolucion."'");			
			return 1;
		}
		
	}
	
?>
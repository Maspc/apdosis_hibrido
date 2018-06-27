<?php
	require_once('../clases/conexion.php');
	
	class buscarf{
		
		public static function select1() {
			$reg = conexion::sqlGet("select factura.estado_factura, factura.factura, factura.total, factura.fecha, factura.ordenado_por,
			factura.caja_id
			from  factura where factura.factura_fiscal = ' ' and factura.estado_factura in ('I', 'F') and factura.publico = 'S'");
			return $reg;
		}
		public static function select2($factura) {
			$reg = conexion::sqlGet("select b.caja_id, a.ruta_salida from cajas a, factura b where a.caja_id = b.caja_id and b.factura = '".$factura."' and b.publico = 'S'");
			return $reg;
		}
		public static function select3($caja_id) {
			$reg = conexion::sqlGet("select nombre_impresora from cajas where caja_id = '".$caja_id."'");
			return $reg;
		}
		public static function update1($h,$g,$archivo,$factura) {
			$sql = "update factura set factura_fiscal = '".$h."', equipo_fiscal = '".$g."',  archivo_fiscal = '".$archivo."', hora_impresion_fiscal = '".date('Y-m-d H:i',time())."', estado_factura = 'I' where factura = '".$factura."' and publico = 'S'";
			conexion::trQry($sql);
			return 1;
		}
		public static function select4() {
			$reg = conexion::sqlGet("select devolucion.estado, devolucion.devolucion, devolucion.total, devolucion.fecha_creacion from devolucion where  devolucion.estado in ('E', 'I') and devolucion.factura_fiscal = ' ' and devolucion.publico = 'S'");
			return $reg;
		}
		public static function select5($devolucion) {
			$reg = conexion::sqlGet("select b.caja_id, a.ruta_salida from cajas a, devolucion b where a.caja_id = b.caja_id and b.devolucion = '".$devolucion."' and b.publico = 'S'");
			return $reg;
		}
		public static function select6($caja_id) {
			$reg = conexion::sqlGet("select nombre_impresora from cajas where caja_id = '".$caja_id."'");
			return $reg;
		}
		public static function update2($h,$g,$archivo,$devolucion) {
			$sql = "update devolucion set factura_fiscal = '".$h."', equipo_fiscal = '".$g."', archivo_fiscal = '".$archivo."', estado = 'E' where devolucion = '".$devolucion."' and publico = 'S'";
			conexion::trQry($sql);
			return 1;
		}
	}
	
?>
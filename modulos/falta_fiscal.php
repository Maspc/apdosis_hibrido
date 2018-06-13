<?php
	require_once('../clases/conexion.php');
	
	class ffiscal{
		
		public static function select1() {
			$reg = conexion::sqlGet("select factura.estado_factura, factura.factura, factura.total, factura.fecha, factura.ordenado_por,
			factura.caja_id
			from  factura where factura.factura_fiscal = ' ' and factura.estado_factura in ('I', 'F')");			
			return $reg;
		}
		
		public static function select2() {
			$reg = conexion::sqlGet("select devolucion.estado, devolucion.devolucion, devolucion.total, devolucion.fecha_creacion from devolucion where  devolucion.estado in ('E', 'I') and devolucion.factura_fiscal = ' '");			
			return $reg;
		}
		
		public static function nfiscal_slt1($factura) {
			$reg = conexion::sqlGet("select b.caja_id, a.ruta_salida from cajas a, factura b where a.caja_id = b.caja_id and b.factura = '".$factura."'");			
			return $reg;
		}
		
		public static function nfiscal_slt2($caja_id) {
			$reg = conexion::sqlGet("select nombre_impresora from cajas where caja_id = '".$caja_id."'");			
			return $reg;
		}
		
		public static function nfiscal_up1($h,$g,$archivo,$factura) {
			conexion::trQry("update factura set factura_fiscal = '".$h."', equipo_fiscal = '".$g."',  archivo_fiscal = '".$archivo."', hora_impresion_fiscal = '".date('Y-m-d H:i',time())."' where factura = '".$factura."'");			
			return 1;
		}
		
	}
	
?>
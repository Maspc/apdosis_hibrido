<?php
	require_once('../clases/conexion.php');
	
	class nmanual{
		
		public static function select1($devolucion) {
			$reg = conexion::sqlGet("select b.caja_id, a.ruta_salida from cajas a, devolucion b where a.caja_id = b.caja_id and b.devolucion = '".$devolucion."'");
			return $reg;
		}
		
		public static function select2($caja_id) {
			$reg = conexion::sqlGet("select nombre_impresora from cajas where caja_id = '".$caja_id."'");
			return $reg;
		}
		
		public static function update1($h,$g,$archivo,$devolucion) {
			$sql = "update devolucion set factura_fiscal = '".$h."', equipo_fiscal = '".$g."', archivo_fiscal = '".$archivo."', estado = 'E' where devolucion = '".$devolucion."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select3($devolucion) {
			$reg = conexion::sqlGet("select FA from devolucion where devolucion = '".$devolucion."'");
			return $reg;
		}
		
	}
	
?>
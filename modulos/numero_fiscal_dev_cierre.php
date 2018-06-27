<?php
	require_once('../clases/conexion.php');
	
	class nfdc{
		
		public static function select1($carpeta) {
			$reg = conexion::sqlGet("select nombre from nombres_impresoras where carpeta = '".$carpeta."'");
			return $reg;
		}
		
		public static function update1($h,$g,$archivo,$devolucion) {
			$sql = "update devolucion set factura_fiscal = 
			'".$h."', equipo_fiscal = '".$g."', archivo_fiscal =
			'".$archivo."', estado = 'E' where devolucion = '".$devolucion."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function select2($devolucion) {
			$reg = conexion::sqlGet("select FA from devolucion where devolucion = '".$devolucion."'");
			return $reg;
		}
	}
	
?>
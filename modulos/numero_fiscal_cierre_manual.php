<?php
	require_once('../clases/conexion.php');
	
	class nfcm{
		
		public static function select1($carpeta) {
			$reg = conexion::sqlGet("select nombre from nombres_impresoras where carpeta = '".$carpeta."'");
			return $reg;
		}
		
		public static function update1($h,$g,$k,$archivo,$factura) {
			$sql = "update factura set factura_fiscal = '".$h."', equipo_fiscal =
			'".$g."', total = '".$k."' , archivo_fiscal = '".$archivo."', hora_impresion_fiscal = 
			'".date('Y-m-d H:i',time())."' where factura = '".$factura."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function update2() {
			$sql ="update factura set estado_factura = 'I' where factura = '".$factura."'"; 
			conexion::trQry($sql);
			return 1;
		}
		public static function select2($factura) {
			$reg = conexion::sqlGet("select FA from factura where factura = '".$factura."'");
			return $reg;
		}
	}
	
?>
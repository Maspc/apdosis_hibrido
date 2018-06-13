<?php
	require_once('../clases/conexion.php');
	
	class tdetalle{
		
		public static function bodegas() {
			$reg = conexion::sqlGet("select bodega, descripcion from bodegas");			
			return $reg;
		}
		
		public static function bodegas2($bodega_origen,$bodega_destino) {
			$reg = conexion::sqlGet("select a.descripcion as nombre_origen, b.descripcion as nombre_destino from bodegas a, bodegas b where a.bodega = '".$bodega_origen."' and b.bodega = '".$bodega_destino."'");			
			return $reg;
		}
				
	}
	
?>
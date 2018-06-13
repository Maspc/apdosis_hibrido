<?php
	require_once('../clases/conexion.php');
	
	class ifiscales{		
		
		public static function select1() {
			$reg = conexion::sqlGet("select * from impresoras_fiscales");			
			return $reg;
		}
		
		public static function select2($id) {
			$reg = conexion::sqlGet("select * from impresoras_fiscales where tipo_impresion='".$id."'");			
			return $reg;
		}
		
		public static function update1($impresora,$impresora2,$id) {
			$sql = "update impresoras_fiscales set nombre_carpeta = '".$impresora."', nombre_carpeta2 = '".$impresora2."' where tipo_impresion='".$id."'";
			conexion::trQry($sql);
			return 1;
		}
		
	}
	
?>
<?php
	require_once('../clases/conexion.php');
	
	class edit_aseg{
		
		public static function select1($id) {
			$reg = conexion::sqlGet("select * from aseguradoras where codigo_aseg='".$id."'");
			return $reg;
		}
		public static function update1($descripcion,$descuento_maximo,$id) {
			$sql = "update aseguradoras set descripcion = 
			'".$descripcion."', descuento_maximo = '".$descuento_maximo."'  
			where codigo_aseg='".$id."'";
			conexion::trQry($sql);
			return 1;
		}
		}
	
?>
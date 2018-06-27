<?php
	require_once('../clases/conexion.php');
	
	class addaseg{
		
		public static function insert1($descripcion,$descuento_maximo) {
			$sql = "insert into aseguradoras (descripcion, descuento_maximo)
			values('".$descripcion."', '".$descuento_maximo."')";
			conexion::trQry($sql);
			return 1;
		}
	}
	
?>
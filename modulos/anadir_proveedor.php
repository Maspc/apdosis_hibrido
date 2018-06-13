<?php
	require_once('../clases/conexion.php');
	
	class aproveedor{
		
		public static function insert1($proveedor,$contacto,$telefono) {
			$sql = "insert into proveedor (nombre, contacto, telefono) values ('".$proveedor."', '".$contacto."', '".$telefono."')";
			conexion::trQry($sql);
			return 1;
		}
		
	}
	
?>
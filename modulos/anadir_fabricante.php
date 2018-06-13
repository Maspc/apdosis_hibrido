<?php
	require_once('../clases/conexion.php');
	
	class afabrica{
		
		public static function insert1($fabric) {
			
			$sql = "insert into fabricantes (descripcion) values ('".$fabric."')";
			conexion::trQry($sql);			
			
			return 1;
		}
		
	}
	
?>
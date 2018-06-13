<?php
	
	require_once('../clases/conexion.php');
	
	class emedica_es{
		
		public static function select1($user) {
			$reg = conexion::sqlGet("select user, nombre, password from usuarios where user ='".$user."'");			
			return $reg;
		}
		
		public static function update_eusu($nombre,$tipo,$estado,$id) {
			conexion::trQry("update usuarios set nombre = '".$nombre."', tipo = '".$tipo."', estado = '".$estado."' where user='".$id."'");			
			return 1;
		}
		
	}
	
?>
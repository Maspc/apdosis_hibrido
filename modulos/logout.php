<?php
	require_once('../clases/conexion.php');
	
	class salir{
		
		public static function borrarTemp($usuario) {
			
			conexion::trQry("delete from temp_pend where usuario = '".$usuario."'");
			
			return 1;
		}
	}
	
?>
<?php
	require_once('../clases/conexion.php');
	
	class repo_zc{
		
		public static function select1() {
			$reg = conexion::sqlGet("SELECT caja_id, nombre FROM cajas WHERE estado = 'A'");
			return $reg;
		}
	}
	
?>	
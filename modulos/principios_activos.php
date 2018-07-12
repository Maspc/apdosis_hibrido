<?php
	require_once('../clases/conexion.php');
	
	class prin_a {
		public static function select1() {
			$sql =	"select * from principios_activos order
			by descripcion" 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}		
	}
?>
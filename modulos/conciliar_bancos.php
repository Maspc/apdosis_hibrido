<?php
	require_once('../clases/conexion.php');
	
	class conciliarb{
				
		public static function select1(){
			$sql =	"select c.bodega, c.descripcion from bodegas c where c.bodega != 1"; 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}

	}
	
?>
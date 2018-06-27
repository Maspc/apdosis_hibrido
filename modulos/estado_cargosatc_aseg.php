<?php
	require_once('../clases/conexion.php');
	
	class estado_ca{
		
		public static function select1() {
			$reg = conexion::sqlGet("select '%' as codigo_aseg, 
			'TODOS' as descripcion from dual union select codigo_aseg,
			descripcion from aseguradoras");
			return $reg;
		}
	}
?>
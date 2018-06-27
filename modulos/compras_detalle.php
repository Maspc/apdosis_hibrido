<?php
	require_once('../clases/conexion.php');
	
	class comprasdet{
		
		
		public static function select1() {
			$reg = conexion::sqlGet("select id_entrada, descripcion from tipos_de_entrada order by descripcion");			
			return $reg;
		}	
	}
	
?>
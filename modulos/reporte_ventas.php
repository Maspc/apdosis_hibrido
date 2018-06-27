<?php
	
	require_once('../clases/conexion.php');
	
	class repventas{		
		
		public static function select1() {
			$reg = conexion::sqlGet( "select '%' as id_proveedor, 'TODOS' as nombre from dual union select id_proveedor, nombre from proveedor");			
			return $reg;
		}
		
		
		
	}
	
?>
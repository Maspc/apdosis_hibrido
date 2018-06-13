<?php
	require_once('../clases/conexion.php');
	
	class provee{		
		
		public static function proveedor() {
			$reg = conexion::sqlGet("select id_proveedor, nombre from proveedor");
			return $reg;
		}
		
	}
	
?>
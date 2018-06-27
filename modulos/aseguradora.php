<?php
	require_once('../clases/conexion.php');
	
	class asegura{
				
		public static function select1() {
			$reg = conexion::sqlGet("select codigo_aseg, descripcion, descuento_maximo from aseguradoras order by descripcion");
			return $reg;
		}
	}
	
?>
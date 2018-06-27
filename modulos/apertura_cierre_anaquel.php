<?php
	require_once('../clases/conexion.php');
	
	class apertca{
				
		public static function select1() {
			$reg = conexion::sqlGet("select id_anaquel, max(id_conteo) as id_conteo, estado from conteo_anaquel group by id_anaquel, estado");
			return $reg;
		}
	}
	
?>
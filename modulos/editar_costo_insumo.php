<?php
	require_once('../clases/conexion.php');
	
	class edicosto{
		
		public static function gmedica() {
			$gmedica = conexion::sqlGet("select codigo_grupo, descripcion from grupo_de_medicamentos");
			return $gmedica;
		}
		
		public static function g_dmedica($tipo) {
			$g_dmedica = conexion::sqlGet("select descripcion from grupo_de_medicamentos where codigo_grupo = '".$tipo."'");
			foreach($g_dmedica as $gd){
				$gdmedica = $gd->descripcion;
			}
			return $gdmedica;
		}
		
		public static function record1($tipo) {
			$record1 = conexion::sqlGet("select codigo_sub, descripcion, porcentaje_ganancia, descuento_maximo
			from sub_grupo where codigo_grupo = '".$tipo."'");
			return $record1;
		}
		
	}
	
?>
<?php
	require_once('../clases/conexion.php');
	
	class imprimir{
		
		public static function select1() {
			$reg = conexion::sqlGet("SELECT codigo_de_barra, medicamento, sum(conteo_final) as cantidad
			FROM conteo_inventario where codigo_de_barra is not null and medicamento is not null group by codigo_de_barra, medicamento");			
			return $reg;
		}
		
	}
	
?>
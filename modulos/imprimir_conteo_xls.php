<?php
	require_once('../clases/conexion.php');
	
	class imprimir{
		
		public static function select1() {
			$reg = conexion::sqlGet(" id_anaquel, codigo_de_barra, medicamento, conteo_final as cantidad
			FROM conteo_inventario where codigo_de_barra is not null and medicamento is not null");			
			return $reg;
		}
		
	}
	
?>
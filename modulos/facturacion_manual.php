<?php
	require_once('../clases/conexion.php');
	
	class fmanual{		
		
		public static function select1() {
			$reg = conexion::sqlGet("select id_cliente, concat(nombre, ' ', apellido) as nom, identificacion, descuento_maximo, tipo_cliente from clientes a , tipo_clientes b where a.tipo_cliente = b.codigo_tipo and a.tipo_cliente in (6,7)");			
			return $reg;
		}
		
		public static function select2() {
			$reg = conexion::sqlGet("select codigo_posologia, descripcion from tipos_posologias order by descripcion");			
			return $reg;
		}		
		
	}
	
?>
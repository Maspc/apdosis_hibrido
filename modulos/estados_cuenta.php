<?php
	require_once('../clases/conexion.php');
	
	class ecuenta{		
				
		public static function lis_cliente() {
			$lis_cliente = conexion::sqlGet("select a.id_cliente, concat(a.nombre, ' ', a.apellido) as nom_cliente, b.descripcion, a.saldo_actual from clientes a, tipo_clientes b where a.tipo_cliente = b.codigo_tipo order by a.nombre");
			return $lis_cliente;
		}
		
	}
	
?>
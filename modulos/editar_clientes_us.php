<?php
	require_once('../clases/conexion.php');
	
	class clientes{		
		
		public static function update_cliente($nombre,$apellido,$identificacion,$limite_credito,$tipo_cliente,$codigo_cliente) {
			
			conexion::trQry("update clientes set nombre = '".$nombre."', apellido = '".$apellido."', identificacion = '".$identificacion."', limite_credito='".$limite_credito."', tipo_cliente='".$tipo_cliente."' where id_cliente = '".$codigo_cliente."'");
			return 1;
		}
		
		public static function tclientes() {
			$tclientes = conexion::sqlGet("select codigo_tipo, descripcion from tipo_clientes");
			return $tclientes;
		}
	}
	
?>
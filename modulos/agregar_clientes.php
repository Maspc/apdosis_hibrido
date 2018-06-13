<?php
	require_once('../clases/conexion.php');
	
	class clientes{		
		
		public static function guarda_cliente($cedula, $nombre, $apellido, $telefono, $tipo_cliente, $limite_credito, $user) {
			
			$Hora = Time(); // Hora actual
			$hora_actual =  date('Y-m-d H:i',$Hora); 
			conexion::trQry("insert into clientes (identificacion, nombre, apellido, telefono, tipo_cliente, limite_credito, usuario_creacion, fecha_creacion) 
			values ('".$cedula."', '".$nombre."', '".$apellido."', '".$telefono."', '".$tipo_cliente."', '".$limite_credito."', '".$user."', '".$hora_actual."')");
			return 1;
		}
		
		public static function tclientes() {
			$tclientes = conexion::sqlGet("select codigo_tipo, descripcion from tipo_clientes order by descripcion");
			return $tclientes;
		}
		
	}
	
?>
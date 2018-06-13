<?php
	require_once('../clases/conexion.php');
	
	class vdevolucion{
		
		public static function ecarros() {
			$reg = conexion::sqlGet("select codigo_carro from eventos_carros where estado = 'P' order by codigo_carro asc limit 1");			
			return $reg;
		}
		
		public static function fdetalle($codigo_carro_p) {
			$reg = conexion::sqlGet("select distinct despacho from factura_detalle where codigo_carro = '".$codigo_carro_p."'");			
			return $reg;
		}
		
		public static function select1() {
			$reg = conexion::sqlGet("SELECT no_cama, devolucion, fecha_creacion, factura, if(stat='S', 'URGENTE', 'NUEVA') as tipo
			FROM devolucion
			WHERE estado = 'F'
			ORDER BY stat desc, fecha_creacion asc");			
			return $reg;
		}
		
		public static function select2() {
			$reg = conexion::sqlGet("select registro.historia, registro.nombre_paciente, factura.estado_factura, factura.factura, factura.total, factura.fecha 
			from registro, factura where factura.cargo = registro.cargo and factura.historia = registro.historia 
			and factura.tratamiento = registro.tratamiento and factura.stat = 'S' and factura.estado_factura = 'F' and factura.total > 0");			
			return $reg;
		}
		
	}
	
?>
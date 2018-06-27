<?php
	require_once('../clases/conexion.php');
	
	class imprimir{
		
		public static function select1($fecha1,$fecha2) {
			$reg = conexion::sqlGet("SELECT a.FA, a.id_paciente, a.factura, substring(a.nombre_cliente,1,30) as nombre_paciente, round(a.total, 2) as total,a.equipo_fiscal, a.factura_fiscal, a.fecha, 1 as tipo from factura a where date(a.fecha) between '".$fecha1."' and '".$fecha2."' and a.estado_factura = 'I' 
			union
			SELECT c.FA, a.id_paciente, c.devolucion as factura, substring(a.nombre_cliente,1,30) as nombre_paciente, (round(c.total, 2)*-1) as total,c.equipo_fiscal, c.factura_fiscal, c.fecha_creacion as fecha, 2 as tipo from factura a, devolucion c where date(c.fecha_creacion) between '".$fecha1."' and '".$fecha2."' and a.factura = c.factura and c.estado = 'E' 
			order by fecha");			
			return $reg;
		}
		
		public static function select2($factura) {
			$reg = conexion::sqlGet("select sum(impuesto) as impuesto from factura_detalle where factura = '".$factura."'");			
			return $reg;
		}
		
		public static function select3($factura) {
			$reg = conexion::sqlGet("select (sum(impuesto) * -1) as impuesto from devolucion_detalle where devolucion = '".$factura."'");			
			return $reg;
		}
		
	}
	
?>
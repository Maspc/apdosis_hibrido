<?php
	require_once('../clases/conexion.php');
	
	class buscarf{
		
		public static function select1($where) {
			$reg = conexion::sqlGet("select * from factura a where a.estado_factura in ('I') and ".implode(" and ", $where)." order by a.fecha desc");
			return $reg;
		}
		public static function select2($where2) {
			$reg = conexion::sqlGet("select * from devolucion a, factura b where a.estado in ('E') and a.factura = b.factura and ".implode(" and ", $where2)." order by a.fecha_creacion desc");
			return $reg;
		}
		public static function select3($where) {
			$reg = conexion::sqlGet("select round(sum(a.total),2) as total from factura a where a.estado_factura in ('I') and ".implode(" and ", $where));
			return $reg;
		}
		public static function select4($where2) {
			$reg = conexion::sqlGet("select round(sum(a.total),2) as total from devolucion a, factura b where a.estado in ('E') and a.factura = b.factura and ".implode(" and ", $where2));
			return $reg;
		}
		public static function select5($where) {
			$reg = conexion::sqlGet("select round(sum(b.impuesto),2) as total from factura a, factura_detalle b where a.factura = b.factura and a.estado_factura in ('I') and ".implode(" and ", $where);
			return $reg;
		}
		public static function select6($where2) {
			$reg = conexion::sqlGet("select round(sum(c.impuesto),2) as total from devolucion a, factura b, devolucion_detalle c where a.devolucion = c.devolucion and a.estado in ('E') and a.factura = b.factura and ".implode(" and ", $where2);
			return $reg;
		}
		public static function select7($where2,$compag,$CantidadMostrar) {
			$reg = conexion::sqlGet("select a.factura, a.fecha, a.nombre_cliente, a.id_paciente, round(a.total,2) as total, a.estado_factura, a.caja_id, a.equipo_fiscal, a.factura_fiscal, 1 as tipo from factura a where a.estado_factura in ('I') and ".implode(" and ", $where)."
			union
			select a.devolucion as factura, a.fecha_creacion as fecha, b.nombre_cliente, b.id_paciente, (round(a.total,2)*-1) as total, a.estado as estado_factura, a.caja_id, a.equipo_fiscal, a.factura_fiscal, 2 as tipo from devolucion a, factura b where a.estado in ('E') and a.factura = b.factura and ".implode(" and ", $where2)."
			order by fecha desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
			return $reg;
		}
	}
	
?>
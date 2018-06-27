<?php
	require_once('../clases/conexion.php');
	
	class buscarfa{
		
		public static function select1($where) {
			$reg = conexion::sqlGet("select * from factura a where a.estado_factura in ('I') and ".implode(" and ", $where)." order by a.fecha desc");
			return $reg;
		}
		public static function select2($where) {
			$reg = conexion::sqlGet("select round(sum(a.descuento_total),2) as total from factura a where a.estado_factura in ('I') and ".implode(" and ", $where);
			return $reg;
		}
		public static function select3($where,$compag,$CantidadMostrar) {
			$reg = conexion::sqlGet("select a.factura, a.fecha, a.nombre_cliente, a.id_paciente, round(a.total,2) as total, a.estado_factura, a.caja_id, a.equipo_fiscal, a.factura_fiscal, a.descuento_total, b.descripcion from factura a, aseguradoras b where a.estado_factura in ('I') and a.codigo_aseguradora = b.codigo_aseg and ".implode(" and ", $where)."
			order by a.fecha desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar);
			return $reg;
		}
	}
	
?>		
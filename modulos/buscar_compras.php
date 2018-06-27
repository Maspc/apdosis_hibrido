<?php
	require_once('../clases/conexion.php');
	
	class buscarc{
		
		public static function select1($where) {
			$reg = conexion::sqlGet("select  id_compra from compras_detalle a where a.estado_proceso in ('F') and a.cantidad_entregada > 0 and a.total > 0 and ".implode(" and ", $where)." order by a.fecha_proceso desc");
			return $reg;
		}
		public static function select2($where) {
			$reg = conexion::sqlGet("select round(sum(a.total),2) as total from compras_detalle a, compras b where a.estado_proceso in ('F') and a.cantidad_entregada > 0 and a.total > 0 and a.id_compra = b.id_compra and b.id_proveedor != 1 and ".implode(" and ", $where));
			return $reg;
		}
		public static function select3($where) {
			$reg = conexion::sqlGet("select round(sum(a.total),2) as total from compras_detalle a, compras b where a.estado_proceso in ('F') and a.cantidad_entregada > 0 and a.total > 0 and a.id_compra = b.id_compra and b.id_proveedor = 1 and ".implode(" and ", $where));
			return $reg;
		}
		public static function select4($where) {
			$reg = conexion::sqlGet("select round(sum(a.impuesto_total),2) as total from compras_detalle a where a.estado_proceso in ('F') and a.cantidad_entregada > 0  and a.total > 0 and ".implode(" and ", $where));
			return $reg;
		}
		public static function select5($where,$compag,$CantidadMostrar) {
			$reg = conexion::sqlGet("select a.id_compra, a.medicamento_id, a.fecha_proceso, c.nombre, b.id_proveedor, round(a.total,2) as total, round(a.impuesto_total,2) as impuesto_total, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' ', formas_farmaceuticas.descripcion, ' ', volumen, ' ',f.descripcion ) as nombre_producto from compras_detalle a, compras b, proveedor c, medicamentos, formas_farmaceuticas, tipos_posologias, tipos_posologias f where a.estado_proceso in ('F') and a.cantidad_entregada > 0 and a.id_compra = b.id_compra and b.id_proveedor = c.id_proveedor and a.total > 0  and a.medicamento_id = medicamentos.codigo_interno and medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and medicamentos.tipo_volumen = f.codigo_posologia and ".implode(" and ", $where)." 
			order by b.id_proveedor desc  LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar);
			return $reg;
		}
	}
	
?>
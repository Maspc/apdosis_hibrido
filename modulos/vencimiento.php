<?php
	require_once('../clases/conexion.php');
	
	class vence{
		
		public static function select1() {
			$reg = conexion::sqlGet("SELECT a.medicamento_id, max( a.id_compra ) as id_compra
			FROM compras_detalle a, compras b
			WHERE a.id_compra = b.id_compra
			AND a.estado_proceso = 'F'
			GROUP BY a.medicamento_id");			
			return $reg;
		}
		
		public static function select2($id_compra,$medicamento_id) {
			$reg = conexion::sqlGet("select g.fecha_de_vencimiento, g.lote, concat(a.nombre_comercial,' ', '(', a.nombre_generico, ')',' ', a.posologia, b.descripcion,' ', c.descripcion) as medicamento, (d.cantidad_inicial - d.cantidad_factura + d.cantidad_devolucion) as cantidad, h.fecha_compra , g.cantidad_entregada from compras_detalle g, medicamentos a, tipos_posologias b, formas_farmaceuticas c, medicamentos_x_bodega d, compras h where g.id_compra = '".$id_compra."' and g.medicamento_id = '".$medicamento_id."' and  a.tipo_posologia = b.codigo_posologia and c.codigo_forma = a.forma_farmaceutica and g.medicamento_id = a.codigo_interno and d.medicamento_id = g.medicamento_id and d.bodega = 1 and g.id_compra = h.id_compra order by g.fecha_de_vencimiento");			
			return $reg;
		}
		
		public static function select3($id_compra,$medicamento_id) {
			$reg = conexion::sqlGet("select max(g.id_compra) as compra_anterior from compras_detalle g, compras h where g.id_compra != '".$id_compra."' and h.id_compra = g.id_compra and g.estado_proceso = 'F' and g.medicamento_id = '".$medicamento_id."'");			
			return $reg;
		}
		
	}
	
?>
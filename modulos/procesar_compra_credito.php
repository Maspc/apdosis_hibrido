<?php
	require_once('../clases/conexion.php');
	
	class ccredito{		
		
		public static function compras_prov($compra) {
			$reg = conexion::sqlGet("SELECT a.id_compra, b.nombre, a.fecha_compra, a.observacion, a.estado 
					FROM compras a, proveedor b
					where a.id_compra = '".$compra."'
					and a.id_proveedor = b.id_proveedor");
			return $reg;
		}
		
		public static function each2($id_compra) {
			$reg = conexion::sqlGet("SELECT a.linea, a.id_compra, a.medicamento_id, concat(b.nombre_comercial, '( ', b.nombre_generico, ' )', ' ', b.posologia, c.descripcion) as medicamento ,a.cantidad_compra as cantidad_pedida, a.cantidad_entregada, (a.cantidad_compra - a.cantidad_entregada) as cantidad_diferencia, a.costo from compras_detalle a, medicamentos b, tipos_posologias c where id_compra = '". $id_compra."' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia and a.cantidad_entregada != a.cantidad_compra");
			return $reg;
		}
	}
	
?>
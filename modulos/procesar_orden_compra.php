<?php
	require_once('../clases/conexion.php');
	
	class ocompra{		
		
		public static function compras_prov($compra) {
			$reg = conexion::sqlGet("SELECT a.id_compra, b.nombre, a.fecha_compra, a.observacion, a.estado 
							FROM compras a, proveedor b
							where a.id_compra = '".$compra."'
							and a.id_proveedor = b.id_proveedor");
			return $reg;
		}
		
		public static function each2($id_compra) {
			$reg = conexion::sqlGet("SELECT a.linea, a.id_compra, a.medicamento_id, concat(b.nombre_comercial, '( ', b.nombre_generico, ' )', ' ', b.posologia, c.descripcion) as medicamento , b.codigo_de_barra, a.lote, a.cantidad_compra as cantidad, a.cantidad_entregada, a.costo, a.factura_proveedor, b.tipo_impuesto, a.cantidad_pendiente, a.descuento_unitario, a.cantidad_regalia from compras_detalle a, medicamentos b, tipos_posologias c where id_compra = '".$id_compra."' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia and a.estado_proceso in('P','E')");
			return $reg;
		}		
	}
	
?>
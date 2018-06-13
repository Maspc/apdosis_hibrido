<?php
	require_once('../clases/conexion.php');
	
	class hcompras{
		
		public static function ip() {
			$reg = conexion::sqlGet("select ip from bodegas_externas where bodega='1'");			
			return $reg;
		}
		
		public static function select1($id_compra,$medicamento_id) {
			$reg = conexion::sqlGet("select cantidad_entregada, cantidad_pendiente, lote, fecha_de_vencimiento, costo, impuesto_total, total, lote, factura_proveedor, fecha_proceso
			from compras_detalle_hist where id_compra = '".$id_compra."' and medicamento_id = '".$medicamento_id."'");			
			return $reg;
		}
		
	}
	
?>
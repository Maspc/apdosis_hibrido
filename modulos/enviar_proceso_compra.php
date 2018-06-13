<?php
	require_once('../clases/conexion.php');
	
	class epcompra{
		
		public static function select1($tipo_impuesto) {
			$reg = conexion::sqlGet("select factor from impuesto where tipo_impuesto = '".$tipo_impuesto."'");
			return $reg;
		}
		
		public static function update1($cantidad_entregada,$lote,$fecha_vencimiento,$costo,$imp_total,$total,$factura_proveedor,$hora_actual,$cantidad_regalia,$descuento_uni,$medicamento_id,$id_compra) {
			$sql = "update compras_detalle set cantidad_entregada = '".$cantidad_entregada."', cantidad_pendiente = cantidad_pendiente - '".$cantidad_entregada."', lote='".$lote."', fecha_de_vencimiento='".$fecha_vencimiento."', costo ='".$costo."', impuesto_total = '".$imp_total."', total= '".$total."', factura_proveedor ='".$factura_proveedor."', fecha_proceso = '".$hora_actual."', cantidad_regalia ='".$cantidad_regalia."', descuento_unitario ='".$descuento_uni."'    where medicamento_id = '".$medicamento_id."' and id_compra = '".$id_compra."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select2($medicamento_id,$id_compra) {
			$reg = conexion::sqlGet("select cantidad_pendiente from compras_detalle where medicamento_id = '".$medicamento_id."' and id_compra = '".$id_compra."'");
			return $reg;
		}
		
		
		public static function insert1($id_compra,$medicamento_id,$cantidad_entregada,$cantidad_pendiente,$lote,$fecha_vencimiento,$costo,$imp_total,$total,$factura_proveedor,$hora_actual) {
			$sql = "insert into compras_detalle_hist(id_compra,medicamento_id, cantidad_entregada, cantidad_pendiente, lote, fecha_de_vencimiento, costo, impuesto_total, total,  factura_proveedor, fecha_proceso)
			values ('".$id_compra."', '".$medicamento_id."','".$cantidad_entregada."','".$cantidad_pendiente."','".$lote."','".$fecha_vencimiento."','".$costo."','".$imp_total."','".$total."','".$factura_proveedor."','".$hora_actual."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update2($medicamento_id,$id_compra) {
			$sql = "update compras_detalle set estado_proceso = 'F' where medicamento_id = '".$medicamento_id."' and id_compra = '".$id_compra."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update3($costo,$medicamento_id) {
			$sql = "update medicamentos set costo_unitario = '".$costo."' where codigo_interno = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select3($medicamento_id) {
			$reg = conexion::sqlGet("select precio_unitario from medicamentos where codigo_interno = '".$medicamento_id."'");
			return $reg;
		}
		
		public static function update4($costo,$medicamento_id) {
			$sql = "update medicamentos set precio_unitario=($costo * (porc_ganancia / 100))+ $costo   where codigo_interno = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert2($medicamento_id,$user,$costo,$precio) {
			$sql = "insert into auditoria_med (medicamento_id, fecha, usuario, transaccion, costo,precio) values ('".$medicamento_id."', '". date('Y-m-d H:i',time())."', '".$user."', 'UPDATEINGRESO2','".$costo."', '".$precio."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert3($medicamento_id,$hora_actual,$user,$costo) {
			$sql = "insert into auditoria_med (medicamento_id, fecha, usuario, transaccion, costo) values ('".$medicamento_id."', '".$hora_actual."', '".$user."', 'UPDATECOSTO1', '".$costo."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update5($cantidad_entregada,$cantidad_regalia,$medicamento_id) {
			$sql = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial + '".($cantidad_entregada + $cantidad_regalia)."' where medicamento_id = '".$medicamento_id."' and bodega = 1";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select4($medicamento_id) {
			$reg = conexion::sqlGet("select fecha_vencimiento, lote from medicamentos_x_lote where medicamento_id = '".$medicamento_id."'");
			return $reg;
		}
		
		public static function update6($cantidad_entregada,$costo,$medicamento_id,$lote) {
			$sql = "update medicamentos_x_lote set cantidad = cantidad + ".$cantidad_entregada.", costo = '".$costo."' where medicamento_id = '".$medicamento_id."'  and lote = '".$lote."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert4($medicamento_id,$lote,$cantidad_entregada,$fecha_vencimiento,$costo) {
			$sql = "insert into medicamentos_x_lote (medicamento_id, lote, cantidad, fecha_vencimiento, estado, costo) values ('".$medicamento_id."', '".$lote."','".$cantidad_entregada."','".$fecha_vencimiento."', 'A', '".$costo."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update7($no_recibido,$id_compra) {
			$sql = "update compras_detalle set cantidad_entregada = '0', lote='0', costo ='0.00',estado_proceso = 'F'  where linea = '".$no_recibido."'  and id_compra = '".$id_compra."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select5($id_compra) {
			$reg = conexion::sqlGet("select 1 from compras_detalle where estado_proceso = 'P' and id_compra = '".$id_compra."'");
			return $reg;
		}
		
		public static function update8($factura,$id_compra) {
			$sql = "update compras set estado = 'F', factura_proveedor = '".$factura."' where id_compra = '".$id_compra."'";
			conexion::trQry($sql);
			return 1;
		}
		
	}
	
?>		
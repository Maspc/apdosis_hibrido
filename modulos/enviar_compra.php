<?php
	require_once('../clases/conexion.php');
	
	class enviar_c{
		
		public static function select1($forma_farma) {
			$reg = conexion::sqlGet("select codigo_cierre, fecha_inicio from cierres_de_caja
			where estado = 'P' order by codigo_cierre limit 1");
			return $reg;
		}
		public static function select2($tipo_impuesto) {
			$reg = conexion::sqlGet("select factor from impuesto where tipo_impuesto = '".$tipo_impuesto."'");
			return $reg;
		}
		public static function select3($cierre) {
			$reg = conexion::sqlGet("select saldo_actual from cierres_de_caja where codigo_cierre = '".$cierre."'");
			return $reg;
		}
		public static function select4() {
			$reg = conexion::sqlGet("select codigo_cierre, fecha_inicio from cierres_de_caja
			where estado = 'P' order by codigo_cierre limit 1");
			return $reg;
		}
		public static function select5($tipo_entrada) {
			$reg = conexion::sqlGet("select afecta_costo from tipos_de_entrada 
			where id_entrada = '".$tipo_entrada."'");
			return $reg;
		}
		public static function insert1($proveedor,$observaciones,$MM_iduser) {
			$sql = "insert into recibos (proveedor, observacion, fecha_recibo,
			usuario_creacion, estado) values ('".$proveedor."', '".$observaciones."', '".
			date('Y-m-d H:i',time())."', '".$MM_iduser."', 'F')";
			conexion::trQry($sql);
			return 1;
		}
		public static function insert2($proveedor,$observaciones,$MM_iduser,$factura,$tipo_entrada) {
			$sql ="insert into compras (id_proveedor, observacion, fecha_compra,
			usuario_creacion, estado, factura_proveedor, tipo_entrada) values 
			('".$proveedor."', '".$observaciones."', '". date('Y-m-d H:i',time())."',
			'".$MM_iduser."', 'F', '".$factura."', '".$tipo_entrada."')"; 
			conexion::trQry($sql);
			return 1;
		}
		public static function select6($tipo_impuesto) {
			$reg = conexion::sqlGet("select factor from impuesto where tipo_impuesto = '".$tipo_impuesto."'");
			return $reg;
		}
		public static function insert3($y,$d,$medicamento_id,$cantidad_compra,$lote,$vencimiento,$costo,$regalias,$imp_total,$total,$descuento) {
			$sql ="insert into compras_detalle (id_compra, linea,
			medicamento_id, cantidad_compra, lote, fecha_de_vencimiento,
			costo, cantidad_entregada, cantidad_regalia, impuesto_total, 
			total,estado_proceso, descuento_unitario, fecha_proceso) value
			('".$y."', '".$d."', '".$medicamento_id."', '".$cantidad_compra."', '".$lote."',
			'".$vencimiento."',  '".$costo."', '".$cantidad_compra."', '".$regalias."', 
			'".$imp_total."', '".$total."', 'F','".$descuento."','". date('Y-m-d H:i',time())."')"; 
			conexion::trQry($sql);
			return 1;
		}
		public static function select7($medicamento_id) {
			$reg = conexion::sqlGet("select  concat(b.nombre_comercial, 
			' (', b.nombre_generico, ')', ' ', b.posologia, c.descripcion) 
			as medicamento from medicamentos b, tipos_posologias c where
			b.codigo_interno = '".$medicamento_id."' and b.tipo_posologia = c.codigo_posologia");
			return $reg;
		}
		public static function insert4($x,$d,$medicamento_nom,$total) {
			$sql =  "insert into recibos_detalle (id_recibo, linea, codigo_rubro, descripcion, monto, total) 
			value ('".$x."', '".$d."', 4, '".$medicamento_nom."', '".$total."','".$total."' )";
			conexion::trQry($sql);
			return 1;
		}
		public static function update1($total,$cierre) {
			$sql = "update cierres_de_caja set saldo_actual =
			saldo_actual + '".$total."' where codigo_cierre = '".$cierre."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function update2($cantidad_compra,$regalias,$medicamento_id) {
			$sql = "update medicamentos_x_bodega set cantidad_inicial = 
			cantidad_inicial + '".$cantidad_compra."' + '".$regalias."' where 
			medicamento_id = '".$medicamento_id."' and bodega = '1'"; 
			conexion::trQry($sql);
			return 1;
		}
		public static function update3($costo,$medicamento_id) {
			$sql = "update medicamentos set costo_unitario =
			'".$costo."'   where codigo_interno = '".$medicamento_id."'"; 
			conexion::trQry($sql);
			return 1;
		}
		public static function select8($medicamento_id) {
			$reg = conexion::sqlGet("select precio_unitario from medicamentos where codigo_interno = '".$medicamento_id."'");
			return $reg;
		}
		public static function update4($medicamento_id,$costo) {
			$sql ="update medicamentos set precio_unitario = 
			(".$costo." * (porc_ganancia / 100))+ ".$costo."   where 
			codigo_interno = '".$medicamento_id."'";  
			conexion::trQry($sql);
			return 1;
		}
		public static function insert5($medicamento_id,$MM_iduser,$costo,$precio) {
			$sql ="insert into auditoria_med (medicamento_id, fecha, 
			usuario, transaccion, costo,precio) values ('".$medicamento_id."',
			'". date('Y-m-d H:i',time())."', '".$MM_iduser."', 
			'UPDATEINGRESO1','".$costo."', '".$precio."' )"; 
			conexion::trQry($sql);
			return 1;
		}
		public static function select9($medicamento_id) {
			$reg = conexion::sqlGet("select fecha_vencimiento, 
			lote from medicamentos_x_lote where medicamento_id = '".$medicamento_id."'");
			return $reg;
		}
		public static function update5($cantidad_compra,$costo,$medicamento_id,$lote) {
			$sql ="update medicamentos_x_lote set cantidad = cantidad + 
			'".$cantidad_compra."', costo = '".$costo."'  where medicamento_id =
			'".$medicamento_id."'  and lote = '".$lote."'"; 
			conexion::trQry($sql);
			return 1;
		}
		public static function insert6($medicamento_id,$lote,$cantidad_compra,$vencimiento,$costo) {
			$sql = "insert into medicamentos_x_lote (medicamento_id, lote,
			cantidad, fecha_vencimiento, estado, costo) values
			('".$medicamento_id."', '".$lote."','".$cantidad_compra."',
			'".$vencimiento."', 'A', '".$costo."') ";
			conexion::trQry($sql);
			return 1;
		}
		
		
	}
	
?>
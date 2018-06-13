<?php
	require_once('../clases/conexion.php');
	
	class comprasdet{
		
		public static function tentrada() {
			$reg = conexion::sqlGet("select id_entrada, descripcion from tipos_de_entrada order by descripcion");			
			return $reg;
		}
		
		public static function insert1($medicamento_id,$hora_actual,$user) {
			$sql = "insert into auditoria_med (medicamento_id, fecha, usuario, transaccion) values ('".$medicamento_id."', '".$hora_actual."', '".$user."', 'DELETE')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select1() {
			$reg = conexion::sqlGet("select codigo_cierre, fecha_inicio from cierres_de_caja where estado = 'P' order by codigo_cierre limit 1");			
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
			$reg = conexion::sqlGet("select codigo_cierre, fecha_inicio from cierres_de_caja where estado = 'P' order by codigo_cierre limit 1");			
			return $reg;
		}
		
		public static function select5($tipo_entrada) {
			$reg = conexion::sqlGet("select afecta_costo from tipos_de_entrada where id_entrada = '".$tipo_entrada."'");			
			return $reg;
		}
		
		public static function insert2($proveedor,$observaciones,$MM_iduser) {
			$sql = "insert into recibos (proveedor, observacion, fecha_recibo, usuario_creacion, estado) values ('".$proveedor."', '".$observaciones."', '". date('Y-m-d H:i',time())."', '".$MM_iduser."', 'F')";
			$id = conexion::trQryId($sql);
			return $id;
		}
		
		public static function insert3($proveedor,$observaciones,$MM_iduser,$factura,$tipo_entrada) {
			$sql = "insert into compras (id_proveedor, observacion, fecha_compra, usuario_creacion, estado, factura_proveedor, tipo_entrada) values ('".$proveedor."', '".$observaciones."', '". date('Y-m-d H:i',time())."', '".$MM_iduser."', 'F', '".$factura."', '".$tipo_entrada."')";
			$id = conexion::trQryId($sql);
			return $id;
		}
		
		public static function select6($tipo_impuesto) {
			$reg = conexion::sqlGet("select factor from impuesto where tipo_impuesto = '".$tipo_impuesto."'");			
			return $reg;
		}
		
		public static function insert4($y,$d,$medicamento_id,$cantidad_compra,$lote,$vencimiento,$costo,$cantidad_compra,$imp_total,$total,$regalias,$descuento,$cantidad_bodega,$cantidad_tienda,$cantidad_externo) {
			$sql = "insert into compras_detalle (id_compra, linea, medicamento_id, cantidad_compra, lote, fecha_de_vencimiento, costo, cantidad_entregada, impuesto_total, total,estado_proceso, cantidad_regalia, descuento_unitario, cantidad_bodega, cantidad_tienda, cantidad_externo) value ('".$y."', '".$d."', '".$medicamento_id."', '".$cantidad_compra."', '".$lote."', '".$vencimiento."',  '".$costo."', '".$cantidad_compra."', '".$imp_total."', '".$total."', 'F','".$regalias."', '".$descuento."', '".$cantidad_bodega."', '".$cantidad_tienda."', '".$cantidad_externo."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select7($medicamento_id) {
			$reg = conexion::sqlGet("select  concat(b.nombre_comercial, ' (', b.nombre_generico, ')', ' ', b.posologia, c.descripcion) as medicamento from medicamentos b, tipos_posologias c where b.codigo_interno = '".$medicamento_id."' and b.tipo_posologia = c.codigo_posologia");			
			return $reg;
		}
		
		public static function insert5($x,$d,$medicamento_nom,$total) {
			$sql = "insert into recibos_detalle (id_recibo, linea, codigo_rubro, descripcion, monto, total) value ('".$x."', '".$d."', 4, '".$medicamento_nom."', '".$total."','".$total."' )";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update1($total,$cierre) {
			$sql = "update cierres_de_caja set saldo_actual = saldo_actual + '".$total."' where codigo_cierre = '".$cierre."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update2($cantidad_bodega,$regalias,$medicamento_id) {
			$sql = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial + '".$cantidad_bodega."' + '".$regalias."' where medicamento_id = '".$medicamento_id."' and bodega = '1'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update3($cantidad_tienda,$medicamento_id) {
			$sql = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial + '".$cantidad_tienda."' where medicamento_id = '".$medicamento_id."' and bodega = '2'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select8() {
			$reg = conexion::sqlGet("select ip from bodegas_externas where bodega='1'");			
			return $reg;
		}
		
		public static function select9($codigo_de_barra) {
			$reg = conexion::sqlGet("select codigo_interno from medicamentos where codigo_de_barra = '".$codigo_de_barra."'",'infarsa');			
			return $reg;
		}
		
		public static function insert6($MM_iduser,$medicamento_id_ext,$cantidad_externo) {
			$sql = "insert into traslados_ext (bodega_origen, bodega_destino,fecha_creacion, usuario_creacion, medicamento_id, cantidad, estado) values ('1', '1', '". date('Y-m-d H:i',time())."', '".$MM_iduser."', '".$medicamento_id_ext."','".$cantidad_externo."', 'F')";
			conexion::trQry($sql,'infarsa');
			return 1;
		}
		
		public static function update4($cantidad_externo,$medicamento_id_ext) {
			$sql = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial + '".$cantidad_externo."' where medicamento_id = '".$medicamento_id_ext."' and bodega = '1'";
			conexion::trQry($sql,'infarsa');
			return 1;
		}
		
		public static function update5($y,$medicamento_id) {
			$sql = "update compras_detalle set cantidad_bodega = cantidad_bodega + cantidad_externo where id_compra = '".$y."' and medicamento_id = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update6($y,$medicamento_id) {
			$sql = "update compras_detalle set cantidad_externo = 0 where id_compra = '".$y."' and medicamento_id = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update7($cantidad_externo,$medicamento_id) {
			$sql = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial + '".$cantidad_externo."' where medicamento_id = '".$medicamento_id."' and bodega = '1'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update8($costo,$medicamento_id) {
			$sql = "update medicamentos set costo_unitario = '".$costo."'   where codigo_interno = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select10($medicamento_id) {
			$reg = conexion::sqlGet("select precio_unitario from medicamentos where codigo_interno = '".$medicamento_id."'");			
			return $reg;
		}
		
		public static function update9($costo,$medicamento_id) {
			$sql = "update medicamentos set precio_unitario = (".$costo." * (porc_ganancia / 100))+ ".$costo."   where codigo_interno = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert7($medicamento_id,$MM_iduser,$costo,$precio) {
			$sql = "insert into auditoria_med (medicamento_id, fecha, usuario, transaccion, costo,precio) values ('".$medicamento_id."', '". date('Y-m-d H:i',time())."', '".$MM_iduser."', 'UPDATEINGRESO1','".$costo."', '".$precio."' )";
			conexion::trQry($sql,'infarsa');
			return 1;
		}
		
		public static function select11($medicamento_id) {
			$reg = conexion::sqlGet("select fecha_vencimiento, lote from medicamentos_x_lote where medicamento_id = '".$medicamento_id."'");			
			return $reg;
		}
		
		public static function update10($cantidad_compra,$costo,$medicamento_id,$lote) {
			$sql = "update medicamentos_x_lote set cantidad = cantidad + '".$cantidad_compra."', costo = '".$costo."'  where medicamento_id = '".$medicamento_id."'  and lote = '".$lote."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert8($medicamento_id,$lote,$cantidad_compra,$vencimiento,$costo) {
			$sql = "insert into medicamentos_x_lote (medicamento_id, lote, cantidad, fecha_vencimiento, estado, costo) values ('".$medicamento_id."', '".$lote."','".$cantidad_compra."','".$vencimiento."', 'A', '".$costo."') ";
			conexion::trQry($sql,'infarsa');
			return 1;
		}
		
		public static function select12() {
			$reg = conexion::sqlGet("select nombre from compania");
			return $reg;
		}
		
		public static function select13($MM_iduser) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$MM_iduser."'");
			return $reg;
		}
		
		public static function select14($z) {
			$reg = conexion::sqlGet("SELECT  sum(a.total) as total from compras_detalle a, medicamentos b, tipos_posologias c where id_compra = '".$z."' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia");
			return $reg;
		}
		
		public static function select15($z) {
			$reg = conexion::sqlGet("select sum(cantidad_externo) as cantidad_externo_total from compras_detalle where id_compra = '".$z."'");
			return $reg;
		}
		
		public static function select16($z) {
			$reg = conexion::sqlGet("SELECT  sum(monto) as total from recibos_detalle a where id_recibo = '".$z."'");
			return $reg;
		}
		
	}
	
?>
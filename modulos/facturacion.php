<?php
	require_once('../clases/conexion.php');
	
	class factura{
		
		public static function cajas($id_user) {
			$cajas = conexion::sqlGet("select a.caja_id, b.nombre from cajas_usuario a, cajas b where a.usuario = '".$id_user."' and a.caja_id = b.caja_id");
			return $cajas;
		} 
		
		public static function d_descuento($id_user) {
			$de = conexion::sqlGet("select nombre from dias_descuento where dia_id = '". date("N",time())."'");
			return $de;
		}
		
		public static function update1($credito,$codigo_cliente) {
			$sql = "update clientes set saldo_actual = saldo_actual + '".$credito."' where id_cliente = '".$codigo_cliente."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select1($MM_iduser) {
			$de = conexion::sqlGet("select a.caja_id, b.nombre from cajas_usuario a, cajas b where a.usuario = '".$MM_iduser."' and a.caja_id = b.caja_id");
			return $de;
		}
		
		public static function insert1($userid,$identificacion,$codigo_cliente,$jubilado,$codigo_aseguradora,$porcentaje_desc,$total,$sub_total,$itbms_total,$descuento_total,$efectivo,$tarjeta_credito,$clave,$credito,$saldo_pendiente,$cheque,$no_cheque,$nombres_banco,$ref_tdb,$ref_tdc,$vuelto,$caja_id,$nombre_cliente) {
			$sql = "insert into factura  (
			ordenado_por,
			fecha,
			estado_factura ,
			id_paciente, codigo_cliente, jubilado, codigo_aseguradora, porcentaje_desc,  publico, total,sub_total, itbms_total,descuento_total, efectivo,tarjeta_credito,tarjeta_clave,credito, saldo_pendiente, cheque, no_cheque, nombre_banco, ref_tdb, ref_tdc,vuelto, caja_id, nombre_cliente) values ( '".$userid."', '".date('Y-m-d H:i',time())."', 'F',  '".$identificacion."', '".$codigo_cliente."', '".$jubilado."', '".$codigo_aseguradora."', '".$porcentaje_desc."', 'S', '".$total."', '".$sub_total."', '".$itbms_total."', '".$descuento_total."','".$efectivo."', '".$tarjeta_credito."', '".$clave."', '".$credito."', '".$saldo_pendiente."', '".$cheque."', '".$no_cheque."', '".$nombres_banco."', '".$ref_tdb."', '".$ref_tdc."', '".$vuelto."', '".$caja_id."', '".$nombre_cliente."')";
			$id = conexion::trQryId($sql);
			return $id;
		}
		
		public static function select2($id_articulo) {
			$de = conexion::sqlGet("select costo_unitario from medicamentos where codigo_interno = '".$id_articulo."'");
			return $de;
		}
		
		public static function insert2($g,$articulo,$i,$identificacion,$id_articulo,$cantidad,$precio_unitario,$itbms_unitario,$descuento_unitario,$precio_venta,$costo_unitario) {
			$sql = "insert into factura_detalle (factura,medicamento,
			linea,
			id_paciente,
			medicamento_id,
			cantidad,
			estado_producto, precio_unitario, impuesto, descuento_unitario, precio_venta, costo_unitario) values ('".$g."','".$articulo."', '".$i."','".$identificacion."','".$id_articulo."','".$cantidad."','P', '".$precio_unitario."', '".$itbms_unitario."', '".$descuento_unitario."', '".$precio_venta."', '".$costo_unitario."' )";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update2($cantidad,$id_articulo) {
			$sql = "update medicamentos_x_bodega set cantidad_factura = cantidad_factura + '".$cantidad."' where bodega = '2' and medicamento_id = '".$id_articulo."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select3($g) {
			$de = conexion::sqlGet("SELECT a.factura, a.codigo_cliente, concat(b.nombre, ' ', b.apellido) as nombre,a.id_paciente as identificacion, a.fecha, a.ordenado_por, a.total, a.descuento_total, a.porcentaje_desc, a.efectivo, a.tarjeta_clave, a.tarjeta_credito, a.credito, a.cheque
			from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.factura = '".$g."'");
			return $de;
		}
		
		public static function select4($MM_iduser) {
			$de = conexion::sqlGet("select caja_id from cajas_usuario where usuario = '".$MM_iduser."'");
			return $de;
		}
		
		public static function select5($caja_id) {
			$de = conexion::sqlGet("select ruta_entrada, ruta_salida from cajas where caja_id = '".$caja_id."'");
			return $de;
		}
		
		public static function select6($g) {
			$de = conexion::sqlGet("SELECT a.medicamento_id, a.medicamento, a.cantidad, a.precio_unitario,a.descuento_unitario, a.impuesto, a.precio_venta FROM factura_detalle a where factura = '".$g."'");
			return $de;
		}
		
		public static function select7($id) {
			$de = conexion::sqlGet("select (tipo_impuesto - 1) as tipo_impuesto from medicamentos where codigo_interno= '".$id."'");
			return $de;
		}
		
		public static function select8($factura) {
			$de = conexion::sqlGet("select f.codigo_de_barra, a.medicamento, a.medicamento_id, a.horas, a.dias, b.historia, b.no_cama, b.medico, b.nombre_medico, a.linea, b.fecha, a.cantidad, b.localidad_entrega, a.dosis_mostrar as dosis, a.average, a.observacion, b.id_paciente from factura_detalle a, factura b, medicamentos f
			where a.factura = '".$factura."' and a.factura = b.factura  and f.codigo_interno = a.medicamento_id ");
			return $de;
		}
		
		public static function select9($carpeta) {
			$de = conexion::sqlGet("select nombre from nombres_impresoras where carpeta = '".$carpeta."'");
			return $de;
		}
		
		public static function update3($h,$g,$archivo,$factura) {
			$sql = "update factura set factura_fiscal = '".$h."', equipo_fiscal = '".$g."',  archivo_fiscal = '".$archivo."', hora_impresion_fiscal = '".date('Y-m-d H:i',time())."' where factura = '".$factura."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update4($factura) {
			$sql = "update factura set estado_factura = 'I' where factura = '".$factura."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select10($factura) {
			$de = conexion::sqlGet("select FA from factura where factura = '".$factura."'");
			return $de;
		}
	}
	
?>
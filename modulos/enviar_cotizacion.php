<?php
	require_once('../clases/conexion.php');
	
	class ecotiza{		
		
		public static function select1($user) {
			$reg = conexion::sqlGet("select a.caja_id, b.nombre from cajas_usuario a, cajas b where a.usuario = '".$user."' and a.caja_id = b.caja_id");			
			return $reg;
		}
		
		public static function select2($id_articulo) {
			$reg = conexion::sqlGet("select costo_unitario from medicamentos where codigo_interno = '".$id_articulo."'");			
			return $reg;
		}
		
		public static function insert1($userid,$identificacion,$codigo_cliente,$jubilado,$codigo_aseguradora,$porcentaje_desc,$total,$sub_total,$itbms_total,$descuento_total,$efectivo,$tarjeta_credito,$clave,$credito,$saldo_pendiente,$cheque,$no_cheque,$nombres_banco,$ref_tdb,$ref_tdc,$vuelto,$caja_id,$nombre_cliente) {
			$sql = "insert into cotizacion  (
			ordenado_por,
			fecha,
			estado_factura ,
			id_paciente, codigo_cliente, jubilado, codigo_aseguradora, porcentaje_desc,  publico, total,sub_total, itbms_total,descuento_total, efectivo,tarjeta_credito,tarjeta_clave,credito, saldo_pendiente, cheque, no_cheque, nombre_banco, ref_tdb, ref_tdc,vuelto, caja_id, nombre_cliente) values ( '".$userid."', '".date('Y-m-d H:i',time())."', 'F',  '".$identificacion."', '".$codigo_cliente."', '".$jubilado."', '".$codigo_aseguradora."', '".$porcentaje_desc."', 'S', '".$total."', '".$sub_total."', '".$itbms_total."', '".$descuento_total."','".$efectivo."', '".$tarjeta_credito."', '".$clave."', '".$credito."', '".$saldo_pendiente."', '".$cheque."', '".$no_cheque."', '".$nombres_banco."', '".$ref_tdb."', '".$ref_tdc."', '".$vuelto."', '".$caja_id."', '".$nombre_cliente."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function maxid() {
			$reg = conexion::sqlGet("select max(id_cotizacion) as id from cotizacion");			
			return $reg;
		}
		
		public static function insert2($g,$articulo,$i,$identificacion,$id_articulo,$cantidad,$precio_unitario,$itbms_unitario,$desc_unitario,$precio_venta,$costo_unitario) {
			$sql = "insert into cotizacion_detalle (factura,medicamento,
			linea,
			id_paciente,
			medicamento_id,
			cantidad,
			estado_producto, precio_unitario, impuesto, descuento_unitario, precio_venta, costo_unitario) values ('".$g."','".$articulo."', '".$i."','".$identificacion."','".$id_articulo."','".$cantidad."','P', '".$precio_unitario."', '".$itbms_unitario."', '".$desc_unitario."', '".$precio_venta."', '".$costo_unitario."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function compania() {
			$reg = conexion::sqlGet("select nombre from compania");			
			return $reg;
		}
		
		public static function select3($z) {
			$reg = conexion::sqlGet("select ordenado_por, fecha from cotizacion where factura = '".$z."'");			
			return $reg;
		}
		
		public static function usuarios($procesado_por) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$procesado_por."'");			
			return $reg;
		}
		
	}
	
?>
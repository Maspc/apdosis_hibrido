<?php
	require_once('../clases/conexion.php');
	
	class enviar_f{
		public static function update1($credito,$codigo_cliente) {
			$sql ="update clientes set saldo_actual = saldo_actual +
			'".$credito."' where id_cliente = 
			'".$codigo_cliente."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select1($MM_iduser) {
			$reg = conexion::sqlGet("select a.caja_id, b.nombre from
			cajas_usuario a, cajas b where a.usuario = 
			'".$MM_iduser."' and a.caja_id = b.caja_id");
			return $reg;
		}
		public static function insert1($userid, $identificacion, $codigo_cliente, $jubilado, $codigo_aseguradora, $porcentaje_desc, $total, $sub_total, $itbms_total, $descuento_total,$efectivo, $tarjeta_credito, $clave, $credito, $saldo_pendiente, $cheque, $no_cheque, $nombres_banco, $ref_tdb, $ref_tdc, $vuelto, $caja_id, $nombre_cliente) {
			$sql ="insert into factura  (ordenado_por, fecha,estado_factura ,
			id_paciente, codigo_cliente, jubilado, 
			codigo_aseguradora, porcentaje_desc,  
			publico, total,sub_total, itbms_total,descuento_total, 
			efectivo,tarjeta_credito,tarjeta_clave,credito, 
			saldo_pendiente, cheque, no_cheque, nombre_banco,
			ref_tdb, ref_tdc,vuelto, caja_id, nombre_cliente) values 
			( '".$userid."', '".date('Y-m-d H:i',time())."', 'F',  
			'".$identificacion."', 
			'".$codigo_cliente."', 
			'".$jubilado."',
			'".$codigo_aseguradora."',
			'".$porcentaje_desc."',
			'S', '".$total."', 
			'".$sub_total."',
			'".$itbms_total."',
			'".$descuento_total."',
			'".$efectivo."', 
			'".$tarjeta_credito."', 
			'".$clave."',
			'".$credito."', 
			'".$saldo_pendiente."', 
			'".$cheque."', 
			'".$no_cheque."', 
			'".$nombres_banco."',
			'".$ref_tdb."', 
			'".$ref_tdc."',
			'".$vuelto."', 
			'".$caja_id."',
			'".$nombre_cliente."')";
			$id = conexion::trQryId($sql);
			return $id;
		}
		public static function select2($id_articulo_$i) {
			$reg = conexion::sqlGet("select costo_unitario from 
			medicamentos where codigo_interno = 
			'".$id_articulo_$i."'");
			return $reg;
		}
		public static function insert2($g,$articulo_$i, $i,$identificacion,$id_articulo_$i,$cantidad_$i,$precio_unitario_$i, $itbms_unitario_$i, $descuento_unitario_$i, $precio_venta_$i,$costo_unitario ) {
			$sql ="insert into factura_detalle (factura,medicamento,linea,
            id_paciente,medicamento_id, cantidad,estado_producto,
			precio_unitario, impuesto, descuento_unitario,
			precio_venta, costo_unitario) values (
			'".$g."',
			'".$articulo_$i."', 
			'".$i."',
			'".$identificacion."',
			'".$id_articulo_$i."',
			'".$cantidad_$i."','P',
			'".$precio_unitario_$i."', 
			'".$itbms_unitario_$i."', 
			'".$descuento_unitario_$i."', 
			'".$precio_venta_$i."', 
			'".$costo_unitario."' )";
			conexion::trQry($sql);
			return 1;
		}
		public static function update2($cantidad_$i,$id_articulo_$i) {
			$sql = "update medicamentos_x_bodega set cantidad_factura =
			cantidad_factura + 
			'".$cantidad_$i."' where bodega = '1' and medicamento_id =
			'".$id_articulo_$i."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function select3($g) {
			$reg = conexion::sqlGet("SELECT a.factura, a.codigo_cliente, 
			concat(b.nombre, ' ', b.apellido) as nombre,a.id_paciente 
			as identificacion, a.fecha, a.ordenado_por, a.total, 
			a.descuento_total, a.porcentaje_desc, a.efectivo, a.tarjeta_clave, 
			a.tarjeta_credito, a.credito, a.cheque
            from fact   ura a, clientes b where a.codigo_cliente = b.id_cliente and
            a.factura = '".$g."'");
			return $reg;
		}
		public static function select4($MM_iduser) {
			$reg = conexion::sqlGet("select caja_id from cajas_usuario where usuario =
			'".$MM_iduser."'");
			return $reg;
		}
		public static function select5($caja_id) {
			$reg = conexion::sqlGet("select ruta_entrada, ruta_salida from cajas
			where caja_id = '".$caja_id."'");
			return $reg;
		}
		public static function select6($g) {
			$reg = conexion::sqlGet("SELECT a.medicamento_id, 
			a.medicamento, a.cantidad, a.precio_unitario,
			a.descuento_unitario, a.impuesto, a.precio_venta FROM 
			factura_detalle a where factura = '".$g."'");
			return $reg;
		}
		public static function select7($id) {
			$reg = conexion::sqlGet("select (tipo_impuesto - 1) as tipo_impuesto from medicamentos where codigo_interno= '".$id."'");
			return $reg;
		}
	}
	
	?>
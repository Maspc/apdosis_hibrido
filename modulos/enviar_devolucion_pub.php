<?php
	require_once('../clases/conexion.php');
	
	class enviar_dp{
		
		public static function select1($cargo,$medicamento_id) {
			$reg = conexion::sqlGet("select devolucion, cantidad from
			factura_detalle where medicamento_id= '".$medicamento_id."'
			and factura = '".$cargo."' ");
			return $reg;
		}
		public static function select2($MM_iduser) {
			$reg = conexion::sqlGet("select a.caja_id, b.nombre from 
			cajas_usuario a, cajas b where a.usuario = 
			'".$MM_iduser."' and a.caja_id = b.caja_id");
			return $reg;
		}
		public static function insert1($fecha_creacion,$userid,$bodega,$motivo,$caja_id,$cargo) {
			$sql = "insert into devolucion (historia, factura, 
			medico, no_cama, estado, fecha_creacion, stat, ordenado_por,
			bodega, motivo, publico, caja_id) select historia, factura,
			medico, no_cama, 'I', '".$fecha_creacion."', '".$stat."',
			'".$userid."','".$bodega."', '".$motivo."', 'S', '".$caja_id."' from factura where 
			factura ='".$cargo."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function select3() {
			$reg = conexion::sqlGet("select max(devolucion) as dev from devolucion");
			return $reg;                    
		}
		public static function select4($medicamento_id) {
			$reg = conexion::sqlGet("select costo_unitario from medicamentos where
			codigo_interno = '".$medicamento_id."'");
			return $reg;
		}
		public static function insert2($medicamento,$forma,$dosis,$horas,$dias,$cantidad_uni,$z, $l,$medicamento_id, $cargo, $precio_unitario,$precio_venta_dev, $historia, $costo_insumo,$impuesto, $costo_unitario) {
			$sql = "insert into devolucion_detalle(medicamento, 
			forma_farma, dosis, horas, dias, cantidad,  devolucion, 
			linea, medicamento_id,factura, precio_unitario, precio_venta,
			historia, costo_insumo, impuesto, costo_unitario)
            values ('".$medicamento."', '".$forma."','".$dosis."',
			'".$horas."', '".$dias."','".$cantidad_uni."','".$z."', '".$l."',
			'".$medicamento_id."', '".$cargo."', '".$precio_unitario."',
			'".$precio_venta_dev."', '".$historia."', '".$costo_insumo."',
			'".$impuesto."', '".$costo_unitario."')";
			conexion::trQry($sql);
			return 1;
		}
		public static function update1($devol,$medicamento_id,$cargo) {
			$sql ="update factura_detalle set devolucion = devolucion 
			+ '".$devol."' where medicamento_id= '".$medicamento_id."'
			and factura = '".$cargo."' "; 
			conexion::trQry($sql);
			return 1;
		}
		public static function select5($historia,$tratamiento,$despacho) {
			$reg = conexion::sqlGet("SELECT historia, nombre_paciente 
			FROM registro where historia = '" .$historia . "'
			and tratamiento = '".$tratamiento."' and cargo = 
			'".$despacho."'");
			return $reg;
		}
		public static function update2($devol,$medicamento_id) {
			$sql ="update medicamentos_x_bodega set cantidad_devolucion =
			cantidad_devolucion + '".$devol."' where medicamento_id=
			'".$medicamento_id."' and bodega = '2'";
			conexion::trQry($sql);
			return 1;
		}
		public static function update3($precio_venta1,$efectivo,$clave,$tdc,$cheque,$credito,$z) {
			$sql ="update devolucion set total = '".$precio_venta1."', 
			efectivo = '".$efectivo."', tarjeta_clave = '".$clave."',
			tarjeta_credito = '".$tdc."', cheque = '".$cheque."', credito = 
			'".$credito."' where devolucion = '".$z."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function update4($precio_venta1,$z) {
			$sql ="update clientes a, factura b, devolucion c set
			a.saldo_actual = a.saldo_actual - '".$precio_venta1."' where 
			c.devolucion = '".$z."' and c.factura = b.factura and 
			a.id_cliente = b.codigo_cliente and b.credito > 0";
			conexion::trQry($sql);
			return 1;
		}
		public static function select6($z) {
			$reg = conexion::sqlGet("SELECT medicamento, forma_farma,
			dosis, horas, dias, linea, cantidad FROM devolucion_detalle
			where devolucion = '".$z."'");
			return $reg;
		}
		public static function select7($devolucion) {
			$reg = conexion::sqlGet("select factura from devolucion where devolucion = '".$devolucion."'");
			return $reg;
		}
		public static function select8($devolucion) {
			$reg = conexion::sqlGet("SELECT sum(precio_venta) as total 
			from devolucion_detalle where devolucion = '".$devolucion."' 
			and no_aceptada != 'S'");
			return $reg;
		}
		public static function select9($factura) {
			$reg = conexion::sqlGet("SELECT total, fecha_creacion, 
			factura, historia, no_cama from factura where factura =
			'".$factura."'");
			return $reg;
		}
		public static function select10($factura) {
			$reg = conexion::sqlGet("SELECT a.factura, a.codigo_cliente,
			concat(b.nombre, ' ', b.apellido) as nombre,a.id_paciente as
			identificacion, a.fecha, a.ordenado_por, a.total, 
			a.descuento_total, a.porcentaje_desc, a.efectivo,
			a.tarjeta_clave, a.tarjeta_credito, a.credito,
			a.factura_fiscal, a.equipo_fiscal
            from factura a, clientes b where a.codigo_cliente = 
			b.id_cliente and a.factura = '".$factura."'");
			return $reg;
		}
		public static function select11($devolucion) {
			$reg = conexion::sqlGet("select factura_fiscal, 
			equipo_fiscal, archivo_fiscal, FA, factura, efectivo, 
			tarjeta_clave, tarjeta_credito, credito, cheque,
			date(fecha_creacion) as fecha_creacion from devolucion
			where devolucion = '".$devolucion."' ");
			return $reg;
		}
		public static function select12($MM_iduser) {
			$reg = conexion::sqlGet("select caja_id from cajas_usuario 
			where usuario = '".$MM_iduser."'");
			return $reg;
		}
		public static function select13($caja_id) {
			$reg = conexion::sqlGet("select ruta_entrada, ruta_salida 
			from cajas where caja_id = '".$caja_id."'");
			return $reg;
		}
		public static function select14($devolucion) {
			$reg = conexion::sqlGet("select medicamento_id, 
			medicamento, dosis, cantidad, 
			(devolucion_detalle.precio_unitario + 
			devolucion_detalle.costo_insumo) as precio_unitario, 
			(impuesto.factor * 100) as impuesto, 
			devolucion_detalle.impuesto, medicamentos.tipo_de_dosis 
			from devolucion_detalle, impuesto, medicamentos where 
			devolucion= '".$devolucion."' and medicamentos.codigo_interno 
			= devolucion_detalle.medicamento_id and
			medicamentos.tipo_impuesto = impuesto.tipo_impuesto and 
			no_aceptada != 'S'");
			return $reg;
		}
		public static function select15($id) {
			$reg = conexion::sqlGet("select (tipo_impuesto - 1) as
			tipo_impuesto from medicamentos where codigo_interno= '".$id."'");
			return $reg;
		}
	}
?>
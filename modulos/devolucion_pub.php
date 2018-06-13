<?php
	require_once('../clases/conexion.php');
	
	class dvolucpub{
		
		public static function select1($user) {
			$reg = conexion::sqlGet("select a.caja_id, b.nombre from cajas_usuario a, cajas b where a.usuario = '".$user."' and a.caja_id = b.caja_id");			
			return $reg;
		}
		
		public static function select2() {
			$reg = conexion::sqlGet("select nombre from dias_descuento where dia_id = '". date("N",time())."'");			
			return $reg;
		}
		
		public static function select3($where) {
			$reg = conexion::sqlGet("select factura.codigo_cliente, factura.factura, factura.total, concat(clientes.nombre, ' ', clientes.apellido) as nom_cliente, factura.fecha_creacion, factura.codigo_cliente from factura, clientes where  factura.codigo_cliente = clientes.id_cliente and publico = 'S' and ".implode(" and ", $where));			
			return $reg;
		}
		
		public static function select4($factura) {
			$reg = conexion::sqlGet("select factura.factura, factura.fecha_creacion, factura_detalle.precio_unitario, factura_detalle.medicamento, factura_detalle.cantidad, factura_detalle.impuesto, factura_detalle.descuento_unitario, factura_detalle.devolucion from factura, factura_detalle, medicamentos where factura.factura = '".$factura."' and factura.factura = factura_detalle.factura and factura.estado_factura = 'I'  and factura_detalle.medicamento_id = medicamentos.codigo_interno and medicamentos.tipo_mercancia != '3' order by factura");			
			return $reg;
		}
		
		public static function select5($factura) {
			$reg = conexion::sqlGet("SELECT a.medicamento, a.forma_farma, a.dosis, a.horas, a.dias, a.linea, (a.cantidad-a.devolucion) as cantidad_dev, a.devolucion, b.factura FROM factura_detalle a, factura b,  medicamentos d  where b.factura = '".$factura."' and a.cantidad > a.devolucion and a.factura = b.factura and a.medicamento_id = d.codigo_interno and d.tipo_mercancia != '3'");			
			return $reg;
		}
		
		public static function select6($factura) {
			$reg = conexion::sqlGet("SELECT a.medicamento, a.forma_farma, a.dosis, a.horas, a.dias, a.linea, a.cargo, (a.cantidad-a.devolucion) as cantidad_dev, a.devolucion, b.factura, a.medicamento_id, a.precio_unitario, a.costo_insumo, a.impuesto, a.precio_venta, a.cantidad, d.tipo_de_dosis, b.bodega, a.average, a.preparacion, a.cantidad_por_dosis, d.grupo_medicamento, a.descuento_unitario FROM factura_detalle a, factura b,  medicamentos d where b.factura = '".$factura."' and a.cantidad > a.devolucion and a.factura = b.factura and b.estado_factura = 'I' and a.medicamento_id = d.codigo_interno and d.tipo_mercancia != '3'");			
			return $reg;
		}
		
		public static function select7($medicamento_id,$cargo) {
			$reg = conexion::sqlGet("select devolucion, cantidad from factura_detalle where medicamento_id= '".$medicamento_id."' and factura = '".$cargo."' ");			
			return $reg;
		}
		
		public static function select8($MM_iduser) {
			$reg = conexion::sqlGet("select a.caja_id, b.nombre from cajas_usuario a, cajas b where a.usuario = '".$MM_iduser."' and a.caja_id = b.caja_id");			
			return $reg;
		}
		
		public static function insert1($fecha_creacion,$stat,$userid,$bodega,$motivo,$caja_id,$cargo) {
			$sql = "insert into devolucion (historia, factura, medico, no_cama, estado, fecha_creacion, stat, ordenado_por, bodega, motivo, publico, caja_id) select historia, factura, medico, no_cama, 'I', '".$fecha_creacion."', '".$stat."', '".$userid."', '".$bodega."', '".$motivo."', 'S', '".$caja_id."' from factura where factura ='".$cargo."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select9() {
			$reg = conexion::sqlGet("select max(devolucion) as dev from devolucion");			
			return $reg;
		}
		
		public static function select10($medicamento_id) {
			$reg = conexion::sqlGet("select costo_unitario from medicamentos where codigo_interno = '".$medicamento_id."'");			
			return $reg;
		}
		
		public static function insert2($medicamento,$forma,$dosis,$horas,$dias,$cantidad_uni,$z,$l,$medicamento_id,$cargo,$precio_unitario,$precio_venta_dev,$historia,$costo_insumo,$impuesto,$costo_unitario) {
			$sql = "insert into devolucion_detalle(medicamento, forma_farma, dosis, horas, dias, cantidad,  devolucion, linea, medicamento_id,factura, precio_unitario, precio_venta, historia, costo_insumo, impuesto, costo_unitario)
			values ('".$medicamento."', '".$forma."','".$dosis."','".$horas."', '".$dias."','".$cantidad_uni."','".$z."', '".$l."', '".$medicamento_id."', '".$cargo."', '".$precio_unitario."', '".$precio_venta_dev."', '".$historia."', '".$costo_insumo."', '".$impuesto."', '".$costo_unitario."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update1($devol,$medicamento_id,$cargo) {
			$sql = "update factura_detalle set devolucion = devolucion + '".$devol."' where medicamento_id= '".$medicamento_id."' and factura = '".$cargo."' ";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select11($historia,$tratamiento,$despacho) {
			$reg = conexion::sqlGet("SELECT historia, nombre_paciente FROM registro where historia = '" .$historia . "' and tratamiento = '".$tratamiento."' and cargo = '".$despacho."'");			
			return $reg;
		}
		
		public static function update2($devol,$medicamento_id) {
			$sql = "update medicamentos_x_bodega set cantidad_devolucion = cantidad_devolucion + '".$devol."' where medicamento_id= '".$medicamento_id."' and bodega = '2'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update3($precio_venta1,$z) {
			$sql = "update devolucion set total = '".$precio_venta1."' where devolucion = '".$z."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update4($precio_venta1,$z) {
			$sql = "update clientes a, factura b, devolucion c set a.saldo_actual = a.saldo_actual - '".$precio_venta1."' where c.devolucion = '".$z."' and c.factura = b.factura and a.id_cliente = b.codigo_cliente and b.credito > 0";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select12($z) {
			$reg = conexion::sqlGet("SELECT medicamento, forma_farma, dosis, horas, dias, linea, cantidad FROM devolucion_detalle where devolucion = '".$z."'");			
			return $reg;
		}
		
		public static function select13($devolucion) {
			$reg = conexion::sqlGet("select factura from devolucion where devolucion = '".$devolucion."'");			
			return $reg;
		}
		
		public static function select14($devolucion) {
			$reg = conexion::sqlGet("SELECT sum(precio_venta) as total from devolucion_detalle where devolucion = '".$devolucion."' and no_aceptada != 'S'");			
			return $reg;
		}
		
		public static function select15($devolucion) {
			$reg = conexion::sqlGet("SELECT sum(precio_venta) as total from devolucion_detalle where devolucion = '".$devolucion."' and no_aceptada != 'S'");			
			return $reg;
		}
		
		public static function select16($factura) {
			$reg = conexion::sqlGet("SELECT total, fecha_creacion, factura, historia, no_cama from factura where factura = '".$factura."'");			
			return $reg;
		}
		
		public static function select17($factura) {
			$reg = conexion::sqlGet("SELECT a.factura, a.codigo_cliente, concat(b.nombre, ' ', b.apellido) as nombre,a.id_paciente as identificacion, a.fecha, a.ordenado_por, a.total, a.descuento_total, a.porcentaje_desc, a.efectivo, a.tarjeta_clave, a.tarjeta_credito, a.credito
			from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.factura = '".$factura."'");			
			return $reg;
		}
		
		public static function select18($devolucion) {
			$reg = conexion::sqlGet("select factura_fiscal, equipo_fiscal, archivo_fiscal, FA, factura from devolucion where devolucion = '".$devolucion."' ");			
			return $reg;
		}
		
		public static function select19($MM_iduser) {
			$reg = conexion::sqlGet("select caja_id from cajas_usuario where usuario = '".$MM_iduser."'");			
			return $reg;
		}
		
		public static function select20($caja_id) {
			$reg = conexion::sqlGet("select ruta_entrada, ruta_salida from cajas where caja_id = '".$caja_id."'");			
			return $reg;
		}
		
		public static function select21($devolucion) {
			$reg = conexion::sqlGet("select medicamento_id, medicamento, dosis, cantidad, (devolucion_detalle.precio_unitario + devolucion_detalle.costo_insumo) as precio_unitario, (impuesto.factor * 100) as impuesto, devolucion_detalle.impuesto, medicamentos.tipo_de_dosis from devolucion_detalle, impuesto, medicamentos where devolucion= '".$devolucion."' and medicamentos.codigo_interno = devolucion_detalle.medicamento_id and medicamentos.tipo_impuesto = impuesto.tipo_impuesto and no_aceptada != 'S'");			
			return $reg;
		}
		
		public static function select22($id) {
			$reg = conexion::sqlGet("select (tipo_impuesto - 1) as tipo_impuesto from medicamentos where codigo_interno= '".$id."'");			
			return $reg;
		}
		
		public static function select23($carpeta) {
			$reg = conexion::sqlGet("select nombre from nombres_impresoras where carpeta = '".$carpeta."'");			
			return $reg;
		}
		
		public static function update5($h,$g,$archivo,$devolucion) {
			$sql = "update devolucion set factura_fiscal = '".$h."', equipo_fiscal = '".$g."', archivo_fiscal = '".$archivo."', estado = 'E' where devolucion = '".$devolucion."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select24($devolucion) {
			$reg = conexion::sqlGet("select FA from devolucion where devolucion = '".$devolucion."'");			
			return $reg;
		}
		
		public static function select25($factura) {
			$reg = conexion::sqlGet("select registro.historia, registro.nombre_paciente, FA, factura.tratamiento, factura.despacho, factura.historia, factura.tratamiento, factura.despacho, factura.factura from registro, factura where registro.historia = factura.historia and registro.cargo = factura.cargo and registro.tratamiento = factura.tratamiento and factura.factura = '".$factura."' and factura.estado_factura = 'I'");			
			return $reg;
		}
		
		public static function select26($factura) {
			$reg = conexion::sqlGet("SELECT a.medicamento, a.forma_farma, c.descripcion, a.dosis, a.horas, a.dias, a.linea, a.cargo, (a.cantidad-a.devolucion) as cantidad_dev, a.devolucion, b.FA FROM factura_detalle a, factura b, formas_farmaceuticas c where b.factura = '".$factura."' and a.cantidad > a.devolucion and a.factura = b.factura and a.forma_farma = c.codigo_forma");			
			return $reg;
		}
		
		public static function select27($factura) {
			$reg = conexion::sqlGet("SELECT a.medicamento, a.forma_farma, c.descripcion, a.dosis, a.horas, a.dias, a.linea, a.cargo, (a.cantidad-a.devolucion) as cantidad_dev, a.devolucion, b.FA, a.medicamento_id, a.precio_unitario, a.costo_insumo, a.impuesto, a.precio_venta, a.cantidad, d.tipo_de_dosis FROM factura_detalle a, factura b, formas_farmaceuticas c, medicamentos d where b.factura = '".$factura."' and a.cantidad > a.devolucion and a.factura = b.factura and b.estado_factura = 'I' and a.forma_farma = c.codigo_forma and a.medicamento_id = d.codigo_interno");			
			return $reg;
		}
	}
	
?>
<?php
	require_once('../clases/conexion.php');
	
	class redv{
		
		public static function select1($z) {
			$reg = conexion::sqlGet("SELECT medicamento, forma_farma,
			dosis, horas, dias, linea, cantidad FROM devolucion_detalle
			where devolucion = '".$z."'";);
			return $reg;
		}
		
		public static function select2($devolucion) {
			$reg = conexion::sqlGet("select factura from 
			devolucion where devolucion = '".$devolucion."'";);
			return $reg;
		}
		public static function select3($devolucion) {
			$reg = conexion::sqlGet("SELECT sum(precio_venta) as total 
			from devolucion_detalle where devolucion = '".$devolucion."'
			and no_aceptada != 'S'");
			return $reg;
		}
		public static function select4($factura) {
			$reg = conexion::sqlGet("SELECT total, fecha_creacion, factura, 
			historia, no_cama from factura where factura = '".$factura."'");
			return $reg;
		}
		public static function select5($factura) {
			$reg = conexion::sqlGet("SELECT a.factura, a.codigo_cliente,
			concat(b.nombre, ' ', b.apellido) as nombre,a.id_paciente as
			identificacion, a.fecha, a.ordenado_por, a.total,
			a.descuento_total, a.porcentaje_desc, a.efectivo, 
			a.tarjeta_clave, a.tarjeta_credito, a.credito
            from factura a, clientes b where a.codigo_cliente = 
            b.id_cliente and a.factura = '".$factura."'");
			return $reg;
		}
		public static function select6($devolucion) {
			$reg = conexion::sqlGet("select factura_fiscal, equipo_fiscal, archivo_fiscal,
			FA, factura from devolucion where devolucion = '".$devolucion."' ");
			return $reg;
		}
		public static function select7($MM_iduser) {
			$reg = conexion::sqlGet("select caja_id 
			from cajas_usuario where usuario = '".$MM_iduser."'");
			return $reg;
		}
		public static function select8($caja_id) {
			$reg = conexion::sqlGet("select ruta_entrada, ruta_salida from cajas where caja_id = '".$caja_id."'");
			return $reg;
		}
		public static function select9($devolucion) {
			$reg = conexion::sqlGet("select medicamento_id, medicamento, 
			dosis, cantidad, (devolucion_detalle.precio_unitario + 
			devolucion_detalle.costo_insumo) as precio_unitario, 
			(impuesto.factor * 100) as impuesto,
			devolucion_detalle.impuesto, medicamentos.tipo_de_dosis
			from devolucion_detalle, impuesto, medicamentos where
			devolucion= '".$devolucion."' and medicamentos.codigo_interno = 
			devolucion_detalle.medicamento_id and 
			medicamentos.tipo_impuesto = impuesto.tipo_impuesto and 
			no_aceptada != 'S'");
			return $reg;
		}
		public static function select10($id) {
			$reg = conexion::sqlGet("select (tipo_impuesto - 1) as tipo_impuesto 
			from medicamentos where codigo_interno= '".$id."'");
			return $reg;
		}
	}
	
?>
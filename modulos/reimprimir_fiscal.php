<?php
	require_once('../clases/conexion.php');
	
	class rfiscal{
		
		public static function select1($FA) {
			$reg = conexion::sqlGet("select factura.codigo_cliente, concat(clientes.nombre, ' ', clientes.apellido) as nombre_cliente, factura.estado_factura, factura.factura,  factura.total, factura.fecha 
			from  clientes, factura where factura = '".$FA."' and clientes.id_cliente = factura.codigo_cliente");			
			return $reg;
		}
		
		public static function efactura_sl1($g) {
			$reg = conexion::sqlGet("SELECT a.factura, a.codigo_cliente, a.nombre_cliente as nombre,a.id_paciente as identificacion, a.fecha, a.ordenado_por, a.total, a.descuento_total, a.porcentaje_desc, a.efectivo, a.tarjeta_clave, a.tarjeta_credito, a.credito, a.cheque
			from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.factura = '".$g."'");			
			return $reg;
		}
		
		public static function efactura_sl2($user) {
			$reg = conexion::sqlGet("select caja_id from cajas_usuario where usuario = '".$user."'");			
			return $reg;
		}
		
		public static function efactura_sl3($caja_id) {
			$reg = conexion::sqlGet("select ruta_entrada, ruta_salida from cajas where caja_id = '".$caja_id."'");			
			return $reg;
		}
		
		public static function efactura_sl4($g) {
			$reg = conexion::sqlGet("SELECT a.medicamento_id, a.medicamento, a.cantidad, a.precio_unitario,a.descuento_unitario, a.impuesto, a.precio_venta FROM factura_detalle a where factura = '".$g."'");			
			return $reg;
		}
		
		public static function efactura_sl5($id) {
			$reg = conexion::sqlGet("select (tipo_impuesto - 1) as tipo_impuesto from medicamentos where codigo_interno= '".$id."'");			
			return $reg;
		}
		
	}
	
?>
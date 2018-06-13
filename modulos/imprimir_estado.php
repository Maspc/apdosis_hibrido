<?php
	require_once('../clases/conexion.php');
	
	class iestado{		
		
		public static function lfactura($id_cliente) {
			$lfactura = conexion::sqlGet("select factura, saldo_pendiente, fecha, DATE_FORMAT(LAST_DAY(CURDATE() - INTERVAL 1 MONTH ) , '%Y-%m-%d 23:59:59' ) as fecha_30, DATE_FORMAT(LAST_DAY(CURDATE() - INTERVAL 2 MONTH ) , '%Y-%m-%d 23:59:59' ) as fecha_60, DATE_FORMAT(LAST_DAY(CURDATE() - INTERVAL 3 MONTH ) , '%Y-%m-%d 23:59:59' ) as fecha_90, DATE_FORMAT(LAST_DAY(CURDATE() - INTERVAL 4 MONTH ), '%Y-%m-%d 23:59:59' ) as fecha_120 from factura where codigo_cliente = '".$id_cliente."' and saldo_pendiente > 0 and estado_factura = 'I'");
			return $lfactura;
		}
		
		public static function devol($factura) {
			$devol = conexion::sqlGet("select total from devolucion where factura = '".$factura."'");
			return $devol;
		}
		
		public static function dual() {
			$dual = conexion::sqlGet("select  DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%m' ) as mes, DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%Y' ) as anio, DATE_FORMAT(CURDATE(), '%Y-%m-%d' ) as fecha from DUAL");
			return $dual;
		}
		
		public static function insert_sclie($id_cliente, $saldo_corriente,$saldo_30,$saldo_60, $saldo_90, $saldo_120, $saldo_total,$mes,$anio, $fecha) {
			conexion::trQry("INSERT INTO saldo_clientes (id_cliente,  saldo_corriente, saldo_30, saldo_60, saldo_90, saldo_120,saldo_total, mes, anio, fecha)
			VALUES ('".$id_cliente."', '".$saldo_corriente."','".$saldo_30."','".$saldo_60."', '".$saldo_90."', '".$saldo_120."', '".$saldo_total."','".$mes."','".$anio."', '".$fecha."')");
			return 1;
		}
		
		public static function delete_sclie($id_cliente) {
			conexion::trQry("DELETE FROM saldo_clientes  WHERE id_cliente = '".$id_cliente."'");
			return 1;
		}
		
		public static function usuarios($user) {
			$usuarios = conexion::sqlGet("select nombre from usuarios where user='".$user."'");
			return $usuarios;
		}
		
		public static function lclientes($id_cliente) {
			$lclientes = conexion::sqlGet("select concat(a.nombre,' ',a.apellido) as nom, a.identificacion, b.saldo_corriente, b.saldo_30, b.saldo_60, b.saldo_90, b.saldo_120, b.saldo_total from clientes a, saldo_clientes b where a.id_cliente = '".$id_cliente."' and a.id_cliente = b.id_cliente");
			return $lclientes;
		}
		
		public static function ldocs($id_cliente) {
			$ldocs = conexion::sqlGet("select 'FACTURA' as tipo_tran, fecha, credito as total from factura where credito > 0 and codigo_cliente = '".$id_cliente."' and fecha > DATE_FORMAT(LAST_DAY(CURDATE() - INTERVAL 1 MONTH ) , '%Y-%m-%d 23:59:59' ) and estado_factura = 'I'
			union
			select 'NOTA DE CREDITO' as tipo_tran, fecha_creacion as fecha, (total * -1) as total from devolucion where factura in (select factura from factura where credito > 0 and codigo_cliente = '".$id_cliente."') and fecha_creacion > DATE_FORMAT(LAST_DAY(CURDATE() - INTERVAL 1 MONTH ) , '%Y-%m-%d 23:59:59' )
			union
			select 'PAGO' as tipo_tran, fecha, (monto_pagado * -1)  as total from recibo_credito where id_cliente = '".$id_cliente."' and fecha > DATE_FORMAT(LAST_DAY(CURDATE() - INTERVAL 1 MONTH ) , '%Y-%m-%d 23:59:59' )
			order by fecha");
			return $ldocs;
		}
		
	}
	
?>
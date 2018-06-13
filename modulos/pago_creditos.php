<?php
	
	require_once('../clases/conexion.php');
	
	class pcreditos{
		
		public static function insert1($codigo_cliente,$hora_actual,$monto_pagado,$user) {
			conexion::trQry("insert into recibo_credito (id_cliente, fecha, monto_pagado, creado_por) 
			values ('".$codigo_cliente."', '".$hora_actual."', '".$monto_pagado."', '".$user."')");			
			return 1;
		}
		
		public static function maxid() {
			$reg = conexion::sqlGet("select max(id_recibo) as id from recibo_credito");			
			return $reg;
		}
		
		public static function update1($monto_pagado,$codigo_cliente) {
			conexion::trQry("update clientes set saldo_actual = saldo_actual - '".$monto_pagado."' where id_cliente = '".$codigo_cliente."'");			
			return 1;
		}
		
		public static function select1($codigo_cliente) {
			$reg = conexion::sqlGet("select factura, saldo_pendiente from factura where codigo_cliente = '".$codigo_cliente."' and saldo_pendiente > 0 order by factura");			
			return $reg;
		}
		
		public static function update2($saldo_nuevo,$factura) {
			conexion::trQry("update factura set saldo_pendiente = '".$saldo_nuevo."' where factura = '".$factura."'");			
			return 1;
		}
		
	}
	
?>
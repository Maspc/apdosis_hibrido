<?php
	require_once('../clases/conexion.php');
	
	class vfactura{
		
		public static function verfactura($codigo_cliente) {
			$verfactura = conexion::sqlGet("SELECT a.factura, a.fecha, a.total,a.saldo_pendiente, 'FACTURA' as tipo 
			FROM factura a
			WHERE a.codigo_cliente='".$codigo_cliente."' 
			AND a.credito > 0
			union
			select a.devolucion as factura, a.fecha_creacion as fecha, (a.total * -1) total, 0 as saldo_pendiente, 'DEVOLUCION' as tipo  from devolucion a where a.factura in (SELECT a.factura 
			FROM factura a
			WHERE a.codigo_cliente='".$codigo_cliente."' and a.credito > 0 )
			union
			select a.id_recibo, a.fecha, a.monto_pagado, 0, 'PAGO' as tipo 
			from recibo_credito a 
			where a.id_cliente = '".$codigo_cliente."'
			order by fecha");
			return $verfactura;
		}
		
	}
	
?>
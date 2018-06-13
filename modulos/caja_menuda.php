<?php
	require_once('../clases/conexion.php');
	
	class cajam{
		
		public static function cierres_caja() {
			$reg = conexion::sqlGet("select codigo_cierre, fecha_inicio from cierres_de_caja where estado = 'P' order by codigo_cierre limit 1");			
			return $reg;
		}
		
		public static function sactual($cierre) {
			$reg = conexion::sqlGet("select saldo_actual from cierres_de_caja where codigo_cierre = '".$cierre."'");			
			return $reg;
		}
		
		public static function maxid() {
			$reg = conexion::sqlGet("SELECT MAX(id_recibo) id FROM recibos");			
			return $reg;
		}
		
		public static function insert1($proveedor,$observaciones,$user,$fecha_factura) {
			conexion::trQry("insert into recibos (proveedor, observacion, fecha_recibo, usuario_creacion, estado, fecha_factura) values ('".$proveedor."', '".$observaciones."', '". date('Y-m-d H:i',time())."', '".$user."', 'F','".$fecha_factura."')");			
			return 1;
		}
		
		public static function insert2($id_recibo,$linea,$codigo_rubro,$descripcion,$monto,$itbms_c,$total) {
			conexion::trQry("insert into recibos_detalle (id_recibo, linea, codigo_rubro, descripcion, monto, itbms,total) value ('".$id_recibo."', '".$linea."', '".$codigo_rubro."', '".$descripcion."', '".$monto."','".$itbms_c."','".$total."')");			
			return 1;
		}
		
		public static function update1($total,$cierre) {
			conexion::trQry("update cierres_de_caja set saldo_actual = saldo_actual + '".$total."' where codigo_cierre = '".$cierre."'");			
			return 1;
		}
		
	}
	
?>
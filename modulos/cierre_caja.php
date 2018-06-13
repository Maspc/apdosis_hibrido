<?php
	require_once('../clases/conexion.php');
	
	class cierrecaja{
		
		public static function cierres_caja() {
			$reg = conexion::sqlGet("select codigo_cierre, fecha_inicio from cierres_de_caja where estado = 'P' order by codigo_cierre limit 1");			
			return $reg;
		}		
		
		public static function select1($cierre) {
			$reg = conexion::sqlGet("select fecha_inicio, monto_inicial from cierres_de_caja where codigo_cierre = '".$cierre."'");			
			return $reg;
		}
		
		public static function select2($fecha_inicio) {
			$reg = conexion::sqlGet("select sum(b.total) as total from recibos a,recibos_detalle b where a.id_recibo = b.id_recibo and a.fecha_recibo between '".$fecha_inicio."' and '". date('Y-m-d H:i',time())."' ");			
			return $reg;
		}
		
		public static function select3($cierre) {
			$reg = conexion::sqlGet("select monto_final from cierres_de_caja where codigo_cierre = '".$cierre."'");			
			return $reg;
		}
		
		public static function update1($total,$cierre) {
			conexion::trQry("update cierres_de_caja set monto_final = '".$total."' + monto_inicial, estado = 'F', fecha_fin ='". date('Y-m-d H:i',time())."' where codigo_cierre = '".$cierre."'");			
			return 1;
		}
		
		public static function insert1($user,$monto_final,$monto_final) {
			conexion::trQry("insert into cierres_de_caja(fecha_inicio, usuario, estado, monto_inicial, saldo_actual) values ('". date('Y-m-d H:i',time())."', '".$user."', 'P', '".$monto_final."', '".$monto_final."')");			
			return 1;
		}
		
		public static function cierres_caja_rep($cierre) {
			$reg = conexion::sqlGet("select fecha_inicio, fecha_fin, monto_inicial, monto_final from cierres_de_caja where codigo_cierre = '".$cierre."'");			
			return $reg;
		}
		
		public static function usuario($user) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$user."'");
			foreach($reg as $re){
				$reg1 = $re->nombre;
			}
			return $reg1;
		}
		
	}
	
?>
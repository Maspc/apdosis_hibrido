<?php
	require_once('../clases/conexion.php');
	
	class bmedica{
		
		public static function select1($medicamento_id) {
			$reg = conexion::sqlGet("select 1 from factura_detalle where medicamento_id = '".$medicamento_id."'");			
			return $reg;
		}
		
		public static function select2($medicamento_id) {
			$reg = conexion::sqlGet("select (cantidad_inicial - cantidad_factura + cantidad_devolucion) as cantidad from medicamentos_x_bodega where medicamento_id = '".$medicamento_id."'");			
			return $reg;
		}
		
		public static function delete1($medicamento_id) {
			$sql = "delete from medicamentos where codigo_interno = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function delete2($medicamento_id) {
			$sql = "delete from medicamentos_x_bodega where medicamento_id = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert1($medicamento_id,$hora_actual,$user) {
			$sql = "insert into auditoria_med (medicamento_id, fecha, usuario, transaccion) values ('".$medicamento_id."', '".$hora_actual."', '".$user."', 'DELETE')";
			conexion::trQry($sql);
			return 1;
		}
		
	}
	
?>
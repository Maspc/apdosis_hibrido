<?php
	require_once('../clases/conexion.php');
	
	class amestado{
		
		public static function update1($estado_med,$user,$hora_actual,$medicamento_id) {
			$sql = "update medicamentos set estado_med = '".$estado_med."', usuario_modificacion='".$user."', fecha_modificacion='".$hora_actual."' where codigo_interno = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert1($medicamento_id,$hora_actual,$user,$tran) {
			$sql = "insert into auditoria_med (medicamento_id, fecha, usuario, transaccion) values ('".$medicamento_id."', '".$hora_actual."', '".$user."', '".$tran."')";
			conexion::trQry($sql);
			return 1;
		}
		
	}
	
?>
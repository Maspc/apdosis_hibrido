<?php
	require_once('../clases/conexion.php');
	
	class actcona{
		
		public static function select1($anaquel,$conteo) {
			$reg = conexion::sqlGet("select estado from conteo_anaquel where id_anaquel = '".$anaquel."' and id_conteo =  '".$conteo."'");
			return $reg;
		}
		
		public static function insert1($conteo,$anaquel,$hora_actual,$usuario) {
			$sql = "insert into conteo_anaquel (id_conteo, id_anaquel, estado, fecha_inicio, usuario_inicio) values ('".$conteo."', '".$anaquel."', 'A', '".$hora_actual."', '".$usuario."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update1($MM_iduser,$hora_actual,$anaquel,$conteo) {
			$sql = "update conteo_anaquel set estado = 'I', usuario_fin = '".$MM_iduser."', fecha_fin = '".$hora_actual."' where id_anaquel = '".$anaquel."' and id_conteo = '".$conteo."'";
			conexion::trQry($sql);
			return 1;
		}
	}
	
?>
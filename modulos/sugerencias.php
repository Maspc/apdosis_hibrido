<?php
	require_once('../clases/conexion.php');
	
	class sugerencias{
		public static function inser1($medicamento,$forma_farmaceutica,$observacion,$userid) {
			$sql ="insert into sugerencias(medicamento, 
			forma_farmaceutica, observacion, usuario_creacion,
			fecha_creacion) values ('".$medicamento."', 
			'".$forma_farmaceutica."', '".$observacion."', 
			'".$userid."', '".date('Y-m-d H:i',time())."')";	 
			conexion::trQry($sql);
			return 1;
		}		
	}
?>
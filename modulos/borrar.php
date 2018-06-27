<?php
	require_once('../clases/conexion.php');
	
	class borrar{
		
		public static function delete1($userid) {
			
			conexion::trQry("delete from registro_tmp where usuario_creacion = '".$userid."'");
						
			conexion::trQry("delete from registro_detalle_tmp where usuario_creacion = '".$userid."'");
			
			conexion::trQry("delete from tratamiento_tmp where usuario_creacion = '".$userid."'");
						
			conexion::trQry("delete from tratamiento_detalle_tmp where usuario_creacion = '".$userid."'");
						
			conexion::trQry("delete from factura_tmp where usuario_creacion = '".$userid."'");
			
			conexion::trQry("delete from factura_detalle_tmp where usuario_creacion = '".$userid."'");
			
			return 1;
		}
		
	}
	
?>
<?php
	require_once('../clases/conexion.php');
	
	class bblanco{
		
		public static function delete1($userid) {
			$r = "delete from registro_tmp where usuario_creacion = '".$userid."'";
			conexion::trQry($r);			
			
			$rd = "delete from registro_detalle_tmp where usuario_creacion = '".$userid."'";
			
			conexion::trQry($rd);			
			
			$re = "delete from tratamiento_tmp where usuario_creacion = '".$userid."'";
			
			conexion::trQry($re);
			
			$rg = "delete from tratamiento_detalle_tmp where usuario_creacion = '".$userid."'";
			
			conexion::trQry($rg);
			
			$rl = "delete from factura_tmp where usuario_creacion = '".$userid."'";
			
			conexion::trQry($rel);
			
			$rf = "delete from factura_detalle_tmp where usuario_creacion = '".$userid."'";
			
			conexion::trQry($rf);
			return 1;
		}
		
	}
	
?>
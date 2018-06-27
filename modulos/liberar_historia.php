<?php
	require_once('../clases/conexion.php');
	
	class lib_h{
		
		public static function delete1($historia) {
			
			conexion::trQry("delete from registro_tmp where historia = '".$historia."'");
						
			conexion::trQry("delete from registro_detalle_tmp where historia = '".$historia."'");
			
			conexion::trQry("delete from tratamiento_tmp where historia = '".$historia."'");
						
			conexion::trQry("delete from tratamiento_detalle_tmp where historia = '".$historia."'");
						
			conexion::trQry("delete from factura_tmp where historia = '".$historia."'");
			
			conexion::trQry("delete from factura_detalle_tmp where historia = '".$historia."'");
			
			return 1;
		}
		
	}
	
?>
<?php
	require_once('../clases/conexion.php');
	
	class del_aseg{
		public static function delete1($id) {
			
			conexion::trQry("delete from aseguradoras where codigo_aseg='".$id."'");
			return 1;
		}
		
	}
	
?>
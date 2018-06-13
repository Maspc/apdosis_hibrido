<?php
	require_once('../clases/conexion.php');
	
	class pcompras{
		
		public static function anula_p1($id_compra) {
			
			$sql1 = "update compras set estado = 'A' where id_compra = '".$id_compra."'";
			conexion::trQry($sql1);
			$sql2 = "update compras_detalle set estado_proceso = 'F' where id_compra = '".$id_compra."'";
			conexion::trQry($sql2);	
			
			return 1;
		}
		
	}
	
?>
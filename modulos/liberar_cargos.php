
<?php
	require_once('../clases/conexion.php');
	
	class liberar_c{
		
		public static function delete1($factura) {
			conexion::trQry("delete from temp_pend where factura = '".$factura."'");
			return 1;
		}
	}	
?>
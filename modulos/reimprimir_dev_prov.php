<?php
	
	require_once('../clases/conexion.php');
	
	class reimpridev{
		
		public static function compania($user) {
			$reg = conexion::sqlGet("select nombre from compania");			
			return $reg;
		}
		
		public static function usuarios($user) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$user."'");			
			return $reg;
		}
		
		public static function total($z) {
			$reg = conexion::sqlGet("SELECT  sum((a.costo*a.cantidad_devolucion)) as total from devolucion_ven_detalle a, medicamentos b, tipos_posologias c where id_devolucion = '".$z."' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia");			
			return $reg;
		}
		
	}
	
?>
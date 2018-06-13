<?php
	require_once('../clases/conexion.php');
	
	class re_comprar{
		
		public static function compania() {
			$reg = conexion::sqlGet("select nombre from compania");
			foreach($reg as $re){
				$reg1 = $re->nombre;
			}
			return $reg1;
		}
		
		public static function usuario($user) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$user."'");
			foreach($reg as $re){
				$reg1 = $re->nombre;
			}
			return $reg1;
		}
		
		public static function tcompra($id_compra) {
			$reg = conexion::sqlGet("SELECT  sum(a.total) as total from compras_detalle a, medicamentos b, tipos_posologias c where id_compra = '".$id_compra."' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia");
			foreach($reg as $re){
				$reg1 = $re->total;
			}
			return $reg1;
		}
		
	}
	
?>
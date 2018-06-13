<?php
	require_once('../clases/conexion.php');
	
	class re_compra{
		
		public static function compania() {
			$reg = conexion::sqlGet("select nombre from compania");
			foreach($reg as $re){
				$reg1 = $re->nombre;
			}
			return $reg1;
		}
		
		public static function usuario($id_compra) {
			$reg = conexion::sqlGet("select usuario_creacion from compras where id_compra = '".$id_compra."'");
			foreach($reg as $re){
				$reg1 = $re->usuario_creacion;
			}
			return $reg1;
		}
		
	}
	
?>
<?php
	require_once('../clases/conexion.php');
	
	class vnarcoticos{
		
		public static function usuario($user) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$user."'");
			foreach($reg as $re){
				$reg1 = $re->nombre;
			}
			return $reg1;
		}
		
	}
	
?>
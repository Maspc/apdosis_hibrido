<?php
	require_once('../clases/conexion.php');
	
	class cierrec{
				
		public static function select1(){
			$sql =	"select codigo_carro, intervalo1 from eventos_carros where estado = 'P' order by codigo_carro limit 1"; 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}

	}
	
?>
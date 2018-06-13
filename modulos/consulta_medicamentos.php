<?php
	require_once('../clases/conexion.php');
	
	class consultar_m{
	
		public static function select1($codigo_de_barra) {
			$sql ="select a.descripcion, b.codigo_contraindicacion 
			from contraindicaciones a, contra_medicamentos b 
			where a.codigo_contraindicacion = b.codigo_contraindicacion 
			and b.codigo_de_barra = '".$codigo_de_barra."'";
	 
			$reg = conexion::sqlGet($sql);
			return $reg;
		}		
		
	}
	
?>
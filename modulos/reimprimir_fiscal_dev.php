<?php
	require_once('../clases/conexion.php');
	
	class rfiscal{
		
		public static function select1($devolucion) {
			$reg = conexion::sqlGet("select  devolucion.devolucion, devolucion.total, devolucion.fecha_creacion as fecha 
						from  devolucion where devolucion.devolucion = '".$devolucion."'");			
			return $reg;
		}
		
	}
	
?>
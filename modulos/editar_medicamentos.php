<?php
	require_once('../clases/conexion.php');
	
	class emedica{
		
		public static function ffarma() {
			$ffarma = conexion::sqlGet("select codigo_forma, descripcion from formas_farmaceuticas");
			return $ffarma;
		}
		
		public static function posologia() {
			$posologia = conexion::sqlGet("select codigo_posologia, descripcion from tipos_posologias");
			return $posologia;
		}	
		
		public static function presenta() {
			$presenta = conexion::sqlGet("select codigo_presentacion, descripcion from presentacion");
			return $presenta;
		}	
		
		public static function fabricante() {
			$fabricante = conexion::sqlGet("select codigo_fabricante, descripcion from fabricantes");
			return $fabricante;
		}
		
		public static function tdosis() {
			$tdosis = conexion::sqlGet("select codigo_tipo, descripcion from tipos_dosis");
			return $tdosis;
		}
		
	}
	
?>
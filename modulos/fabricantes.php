<?php
	require_once('../clases/conexion.php');
	
	class fabrica{
					
		public static function edit_fabrica($id) {
			$edit_fabrica = conexion::sqlGet("select * from fabricantes where codigo_fabricante='".$id."'");
			return $edit_fabrica;
		}
		
		public static function delete_fabrica($id) {
			conexion::trQry("delete from fabricantes where codigo_fabricante='".$id."'");
			return 1;
		}
		
		public static function update_fabrica($descripcion,$id) {
			conexion::trQry("update fabricantes set descripcion = '".$descripcion."' where codigo_fabricante='".$id."'");
			return 1;
		}
		
		public static function add_fabrica($descripcion) {
			conexion::trQry("insert into fabricantes (descripcion)
			values('".$descripcion."')");
			return 1;
		}
		
		public static function fabricantes() {
			$fabricantes = conexion::sqlGet("select * from fabricantes order by descripcion");
			return $fabricantes;
		}
		
	}
	
?>
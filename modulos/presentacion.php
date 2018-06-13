<?php
	require_once('../clases/conexion.php');
	
	class presenta{
		
		public static function edit_prese($id) {
			$edit_provee = conexion::sqlGet("select * from presentacion where codigo_presentacion='".$id."'");
			return $edit_provee;
		}
		
		public static function delete_prese($id) {
			conexion::trQry("delete from presentacion where codigo_presentacion='".$id."'");
			return 1;
		}
		
		public static function update_prese($descripcion,$id) {
			conexion::trQry("update presentacion set descripcion = '".$descripcion."' where codigo_presentacion='".$id."'");
			return 1;
		}
		
		public static function add_prese($descripcion) {
			conexion::trQry("insert into presentacion (descripcion)
			values('".$descripcion."')");
			return 1;
		}
		
		public static function dat_prese() {
			$dat_prese = conexion::sqlGet("select * from presentacion order by descripcion");
			return $dat_prese;
		}
		
	}
	
?>
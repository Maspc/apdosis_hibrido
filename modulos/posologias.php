<?php
	require_once('../clases/conexion.php');
	
	class posologia{
		
		public static function edit_poso($id) {
			$edit_poso = conexion::sqlGet("select * from tipos_posologias where codigo_posologia='".$id."'");
			return $edit_poso;
		}
		
		public static function delete_poso($id) {
			conexion::trQry("delete from tipos_posologias where codigo_posologia='".$id."'");
			return 1;
		}
		
		public static function update_poso($descripcion,$id) {
			conexion::trQry("update tipos_posologias set descripcion = '".$descripcion."' where codigo_posologia='".$id."'");
			return 1;
		}
		
		public static function add_poso($descripcion) {
			conexion::trQry("insert into tipos_posologias (descripcion)
			values('".$descripcion."')");
			return 1;
		}
		
		public static function posologias() {
			$posologias = conexion::sqlGet("select * from tipos_posologias order by descripcion");
			return $posologias;
		}
		
	}
	
?>
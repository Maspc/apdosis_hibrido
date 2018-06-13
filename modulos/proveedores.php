<?php
	require_once('../clases/conexion.php');
	
	class provee{
		
		public static function edit_provee($id) {
			$edit_provee = conexion::sqlGet("select * from proveedor where id_proveedor='".$id."'");
			return $edit_provee;
		}
		
		public static function delete_provee($id) {
			conexion::trQry("delete from proveedor where id_proveedor='".$id."'");
			return 1;
		}
		
		public static function update_provee($nombre,$contacto,$telefono,$id) {
			conexion::trQry("update proveedor set nombre = '".$nombre."', contacto = '".$contacto."', telefono = '".$telefono."' where id_proveedor='".$id."'");
			return 1;
		}
		
		public static function add_provee($nombre,$contacto,$telefono) {
			conexion::trQry("insert into proveedor (nombre,contacto,telefono)
			values('".$nombre."', '".$contacto."', '".$telefono."')");
			return 1;
		}
		
		public static function dat_provee() {
			$dat_provee = conexion::sqlGet("select * from proveedor order by nombre");
			return $dat_provee;
		}
		
	}
	
?>
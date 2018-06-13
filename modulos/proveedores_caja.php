<?php
	require_once('../clases/conexion.php');
	
	class provee{
		
		public static function edit_provee($id) {
			$edit_provee = conexion::sqlGet("select * from proveedores_caja where id_proveedor='".$id."'");
			return $edit_provee;
		}
		
		public static function delete_provee($id) {
			conexion::trQry("delete from proveedores_caja where id_proveedor='".$id."'");
			return 1;
		}
		
		public static function update_provee($nombre,$ruc,$contacto,$telefono,$id) {
			conexion::trQry("update proveedores_caja set nombre_proveedor = '".$nombre."', contacto = '".$contacto."', telefono = '".$telefono."', ruc = '".$ruc."' where id_proveedor='".$id."'");
			return 1;
		}
		
		public static function add_provee($nombre,$ruc,$contacto,$telefono) {
			conexion::trQry("insert into proveedores_caja (nombre_proveedor,ruc,contacto,telefono)
			values('".$nombre."', '".$ruc."', '".$contacto."', '".$telefono."')");
			return 1;
		}
		
		public static function dat_provee() {
			$dat_provee = conexion::sqlGet("select * from proveedores_caja order by nombre_proveedor");
			return $dat_provee;
		}
		
	}
	
?>
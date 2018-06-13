<?php
	require_once('../clases/conexion.php');
	
	class contra{
					
		public static function edit_contra($id) {
			$edit_contra = conexion::sqlGet("select * from contraindicaciones where codigo_contraindicacion='".$id."'");
			return $edit_contra;
		}
		
		public static function delete_contra($id) {
			conexion::trQry("delete from contraindicaciones where codigo_contraindicacion='".$id."'");
			return 1;
		}
		
		public static function update_contra($descripcion,$descripcion_paciente,$id) {
			conexion::trQry("update contraindicaciones set descripcion = '".$descripcion."', descripcion_paciente = '".$descripcion_paciente."' where codigo_contraindicacion='".$id."'");
			return 1;
		}
		
		public static function add_contra($descripcion,$descripcion_paciente) {
			$hrow = conexion::sqlGet("select max(codigo_contraindicacion) as cod from contraindicaciones");			
			$contra = ($hrow[0]->cod) + 1;
			
			conexion::trQry("insert into contraindicaciones (codigo_contraindicacion, descripcion, descripcion_paciente)
			values('".$contra."', '".$descripcion."', '".$descripcion_paciente."')");
			return 1;
		}
		
		public static function dat_contra() {
			$dat_contra = conexion::sqlGet("select * from contraindicaciones order by descripcion");
			return $dat_contra;
		}
		
	}
	
?>
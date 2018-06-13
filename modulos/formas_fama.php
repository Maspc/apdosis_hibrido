<?php
	require_once('../clases/conexion.php');
	
	class ffama{
		
		public static function ffarma() {
			$ffarma = conexion::sqlGet("select * from formas_farmaceuticas order by descripcion");
			return $ffarma;
		}
		
		public static function descrip($id) {
			$descrip = conexion::sqlGet("select * from formas_farmaceuticas where codigo_forma='".$id."'");
			return $descrip[0]->descripcion;
		}
		
		public static function delete_forma($id) {
			conexion::trQry("delete from formas_farmaceuticas where codigo_forma='".$id."'");
			return 1;
		}
		
		public static function update_descrip($descripcion,$id) {
			conexion::trQry("update formas_farmaceuticas set descripcion = '".$descripcion."' where codigo_forma='".$id."'");
			return 1;
		}
		
		public static function add_descrip($descripcion) {
			conexion::trQry("insert into formas_farmaceuticas (descripcion)
			values('".$descripcion."')");
			return 1;
		}
		
		public static function imp_codigo($medicamento_id) {
			$imp_codigo = conexion::sqlGet("select CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  
			' ', tipos_posologias.descripcion) as nombre, codigo_de_barra
			FROM medicamentos, formas_farmaceuticas, tipos_posologias
			WHERE medicamentos.codigo_interno = '".$medicamento_id."' 
			and medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma");
			return $imp_codigo;
		}
		
	}
	
?>
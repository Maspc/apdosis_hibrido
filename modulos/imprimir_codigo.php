<?php
	require_once('../clases/conexion.php');
	
	class icodigo{
		
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
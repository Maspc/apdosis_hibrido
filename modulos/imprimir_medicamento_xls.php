<?php
	
	require_once('../clases/conexion.php');
	
	class imprimedxls{
		
		public static function select1() {
			$reg = conexion::sqlGet("SELECT a.codigo_interno, concat(a.nombre_comercial,' ', '(', a.nombre_generico, ')',' ', a.posologia, b.descripcion,' ', c.descripcion) as medicamento, a.codigo_de_barra from medicamentos a, tipos_posologias b, formas_farmaceuticas c where a.tipo_posologia = b.codigo_posologia and c.codigo_forma = a.forma_farmaceutica order by a.nombre_comercial");			
			return $reg;
		}
		
	}
	
?>

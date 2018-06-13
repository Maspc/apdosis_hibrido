<?php
	require_once('../clases/conexion.php');
	
	class icodigo{
		
		public static function imp_codigo() {
			$imp_codigo = conexion::sqlGet("select substr(medicamentos.nombre_comercial,1,15) as nombre, codigo_de_barra, precio_unitario
			FROM medicamentos, formas_farmaceuticas, tipos_posologias
			WHERE medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and tipo_mercancia = 2
			and codigo_de_barra REGEXP '^[0-9]+$'
			and precio_unitario > 0
			and codigo_interno >= 3063");
			return $imp_codigo;
		}
		
	}
	
?>
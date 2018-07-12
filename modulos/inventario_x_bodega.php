<?php
	require_once('../clases/conexion.php');
	
	class inv_xb{
		public static function select1() {
			$sql =	"select bodega, descripcion from bodegas where
			bodega != 1"; 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}	
		public static function select2($bod_num) {
			$sql =	 "select descripcion from bodegas where bodega =
			'".$bod_num."'"; 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select3($bod_num) {
			$sql ="select a.medicamento_id, concat(b.nombre_comercial, 
			' ',b.nombre_generico,' ', b.posologia,  ' ', 
			tipos_posologias.descripcion,  ' ',
			formas_farmaceuticas.descripcion, ' ', 
			volumen, ' ',f.descripcion) nombre, 
			(a.cantidad_inicial - a.cantidad_factura +
			a.cantidad_devolucion) cantidad from
			medicamentos_x_bodega a, medicamentos b, 
			tipos_posologias, tipos_posologias f, 
			formas_farmaceuticas where a.bodega = 
			'".$bod_num."' and a.medicamento_id = 
			b.codigo_interno AND b.tipo_posologia = 
			tipos_posologias.codigo_posologia
			AND b.forma_farmaceutica = 
			formas_farmaceuticas.codigo_forma
			and b.tipo_volumen = f.codigo_posologia order 
			by concat(b.nombre_comercial, ' ',b.nombre_generico)";	 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}		
	}
?>
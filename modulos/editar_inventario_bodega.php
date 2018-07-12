<?php
	require_once('../clases/conexion.php');
	
	class editar_ib{
	
		public static function select0(){
		    $sql = "select bodega, descripcion from bodegas where bodega != 1";
			$regis = conexion::sqlGet($sql);
			return $regis
			}
		public static function select1($bod_num) {
			$sql = "select descripcion from bodegas where bodega =
			'".$bod_num."'";
	        $regis = conexion::sqlGet($sql);
			return $regis;
		}	
        public static function select2($bod_num) {
			$sql ="select a.medicamento_id, CONCAT
			( b.nombre_comercial,  ' ', 
			'(', b.nombre_generico,  ')', 
			' ', b.posologia,  ' ', 
			tipos_posologias.descripcion, 
			' - ', formas_farmaceuticas.descripcion ) 
			as nombre, (a.cantidad_inicial - a.cantidad_factura + 
			a.cantidad_devolucion) cantidad, a.inventario_ideal,
			a.bodega, a.orden_banco from medicamentos_x_bodega a,
			medicamentos b, formas_farmaceuticas, tipos_posologias
			where a.bodega = '".$bod_num."' and a.medicamento_id = 
			b.codigo_interno and b.tipo_posologia =
			tipos_posologias.codigo_posologia and
			b.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			order by a.orden_banco";
	        $regis = conexion::sqlGet($sql);
			return $regis;
		}		
		
	}
	
?>
<?php
	
	require_once('../clases/conexion.php');
	
	class imprimed{
		
		public static function select1() {
			$reg = conexion::sqlGet("SELECT a.codigo_interno, concat(a.nombre_comercial,' ', '(', a.nombre_generico, ')',' ', a.posologia, b.descripcion,' ', c.descripcion) as medicamento, a.codigo_de_barra, (d.cantidad_inicial - d.cantidad_factura + d.cantidad_devolucion) as cantidad, a.precio_unitario, a.costo_unitario, a.tipo_mercancia, e.descripcion as grupo, f.descripcion as sub_grupo from medicamentos a, tipos_posologias b, formas_farmaceuticas c, medicamentos_x_bodega d, grupo_de_medicamentos e, sub_grupo f where a.tipo_posologia = b.codigo_posologia and c.codigo_forma = a.forma_farmaceutica and a.codigo_interno = d.medicamento_id and d.bodega = 1 and estado_med = 'A' and a.grupo_medicamento = e.codigo_grupo and a.sub_grupo = f.codigo_sub and f.codigo_grupo = a.grupo_medicamento order by medicamento");			
			return $reg;
		}
		
		public static function select2($codigo_interno) {
			$reg = conexion::sqlGet("select a.id_proveedor, b.nombre, max(fecha_creacion) from medicamento_x_proveedor a, proveedor b where a.medicamento_id = '".$codigo_interno."' and a.id_proveedor = b.id_proveedor group by a.id_proveedor, b.nombre");			
			return $reg;
		}
		
		public static function select3($codigo_interno) {
			$reg = conexion::sqlGet("select (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial
			from medicamentos_x_bodega where medicamento_id = '".$codigo_interno."'
			and bodega = '2'");			
			return $reg;
		}
	}
	
?>
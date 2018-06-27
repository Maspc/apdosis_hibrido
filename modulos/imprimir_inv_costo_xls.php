<?php
	require_once('../clases/conexion.php');
	
	class imprimir{
		
		public static function select1() {
			$reg = conexion::sqlGet("SELECT a.codigo_interno, substring(concat(a.nombre_comercial,' ', '(', a.nombre_generico, ')', ' ', a.posologia, b.descripcion,' ', d.descripcion),1,70) as medicamento, a.codigo_de_barra, (c.cantidad_inicial - c.cantidad_factura + c.cantidad_devolucion) as cantidad, format(((c.cantidad_inicial - c.cantidad_factura + c.cantidad_devolucion) * costo_unitario),2) as costo_total, a.costo_unitario, a.tipo_mercancia from medicamentos a, medicamentos_x_bodega c, tipos_posologias b,formas_farmaceuticas d where a.tipo_posologia = b.codigo_posologia and a.codigo_interno = c.medicamento_id and estado_med = 'A' and d.codigo_forma = a.forma_farmaceutica and (c.cantidad_inicial - c.cantidad_factura + c.cantidad_devolucion) > 0 order by ((c.cantidad_inicial - c.cantidad_factura + c.cantidad_devolucion) * costo_unitario) desc");			
			return $reg;
		}
		
	}
	
?>
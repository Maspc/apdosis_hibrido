<?php
	
	require_once('../clases/conexion.php');
	
	class repventasxls{		
		
		public static function usuarios($user) {
			$reg = conexion::sqlGet("select nombre from usuarios where user='".$user."'");			
			return $reg;
		}
		
		public static function select1($fecha1,$fecha2) {
			$reg = conexion::sqlGet("SELECT c.medicamento_id, date(a.fecha) as fecha, date_format(a.fecha, '%r') as hora, a.ordenado_por, a.caja_id, a.factura, b.codigo_de_barra,c.medicamento, d.descripcion as grupo_medicamento, e.descripcion as sub_grupo, c.cantidad, c.precio_unitario, c.descuento_unitario, round((c.impuesto/c.cantidad),2) as impuesto
			from factura a, medicamentos b, factura_detalle c, grupo_de_medicamentos d, sub_grupo e
			where a.fecha between '".$fecha1."' and '".$fecha2."'
			and a.factura = c.factura
			and a.estado_factura = 'I'
			and b.codigo_interno = c.medicamento_id  
			and b.grupo_medicamento = d.codigo_grupo
			and b.sub_grupo = e.codigo_sub
			and b.grupo_medicamento = e.codigo_grupo
			union
			SELECT c.medicamento_id, date(a.fecha_creacion) as fecha, date_format(a.fecha_creacion, '%r') as hora, 'devolucion' as ordenado_por, a.caja_id, a.devolucion as factura, b.codigo_de_barra,c.medicamento, d.descripcion as grupo_medicamento, e.descripcion as sub_grupo, (c.cantidad * -1) as cantidad, c.precio_unitario, 0 as decuento_unitario, round((c.impuesto/c.cantidad),2) as impuesto
			from devolucion a, medicamentos b, devolucion_detalle c, grupo_de_medicamentos d, sub_grupo e
			where a.fecha_creacion between '".$fecha1."' and '".$fecha2."'
			and a.devolucion = c.devolucion
			and a.estado = 'E'
			and b.codigo_interno = c.medicamento_id  
			and b.grupo_medicamento = d.codigo_grupo
			and b.sub_grupo = e.codigo_sub
			and b.grupo_medicamento = e.codigo_grupo
			order by fecha, hora, factura");			
			return $reg;
		}
		
		public static function select2($medicamento_id) {
			$reg = conexion::sqlGet("select b.id_proveedor, c.nombre
			from compras_detalle a, compras b, proveedor c
			where a.id_compra = b.id_compra and a.medicamento_id = '".$medicamento_id."' and b.id_proveedor != '3' and b.id_proveedor = c.id_proveedor order by b.fecha_compra desc limit 1");			
			return $reg;
		}
		
	}
	
?>
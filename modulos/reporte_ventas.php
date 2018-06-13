<?php
	
	require_once('../clases/conexion.php');
	
	class repventas{		
		
		public static function provee() {
			$reg = conexion::sqlGet("select '%' as id_proveedor, 'TODOS' as nombre from dual union select id_proveedor, nombre from proveedor");			
			return $reg;
		}
		
		public static function cliente() {
			$reg = conexion::sqlGet("select '%' as id_cliente, 'TODOS' as nombre from dual union select id_cliente, concat(nombre,' ',apellido) as nombre from clientes");			
			return $reg;
		}
		
		public static function select1($fecha1,$fecha2,$medicamento_id,$codigo_cliente) {
			$reg = conexion::sqlGet("select b.codigo_de_barra, a.factura, a.medicamento, a.medicamento_id, a.costo_unitario, a.cantidad, a.precio_unitario, a.impuesto, a.precio_venta, c.fecha, c.codigo_cliente, c.nombre_cliente 
			from factura_detalle a, medicamentos b, factura c
			where c.fecha between '".$fecha1."' and '".$fecha2."' and a.factura = c.factura  and a.medicamento_id like '".$medicamento_id."' and a.medicamento_id = b.codigo_interno and c.codigo_cliente like '".$codigo_cliente."'
			union
			select b.codigo_de_barra, a.devolucion as factura, a.medicamento, a.medicamento_id, a.costo_unitario, (a.cantidad * -1) as cantidad, (a.precio_unitario * -1) as precio_unitario, (a.impuesto * -1) as impuesto, (a.precio_venta * -1) as precio_venta, c.fecha, d.codigo_cliente, d.nombre_cliente 
			from devolucion_detalle a, medicamentos b, devolucion c, factura d
			where c.fecha between '".$fecha1."' and '".$fecha2."' and a.factura = c.factura and  a.medicamento_id like '".$medicamento_id."' and a.medicamento_id = b.codigo_interno and d.factura = c.factura and c.codigo_cliente like '".$codigo_cliente."'
			order by fecha");			
			return $reg;
		}
		
		public static function select2($medicamento_id1) {
			$reg = conexion::sqlGet("select b.id_proveedor, c.nombre
			from compras_detalle a, compras b, proveedor c
			where a.id_compra = b.id_compra and a.medicamento_id = '".$medicamento_id1."' and b.id_proveedor != '3' and b.id_proveedor = c.id_proveedor order by b.fecha_compra desc limit 1");			
			return $reg;
		}
		
	}
	
?>
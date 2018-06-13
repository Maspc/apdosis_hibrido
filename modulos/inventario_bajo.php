<?php
	require_once('../clases/conexion.php');
	
	class inventb{		
		
		public static function each1() {
			$reg = conexion::sqlGet("select a.codigo_interno, a.codigo_de_barra, 
			a.cant_max_prov, concat(a.nombre_comercial,' (', a.nombre_generico,') ', ' ', 
			a.posologia, c.descripcion,' ',d.descripcion) as medicamento_nom, 
			sum(b.cantidad_inicial - b.cantidad_factura + b.cantidad_devolucion) as 
			cantidad_med, (b.inventario_ideal - sum(b.cantidad_inicial - 
			b.cantidad_factura + b.cantidad_devolucion)) as inve_ide,  
			b.inventario_minimo, b.inventario_ideal from medicamentos a, 
			medicamentos_x_bodega b, tipos_posologias c,formas_farmaceuticas d 
			where a.codigo_interno = b.medicamento_id and a.tipo_posologia= 
			c.codigo_posologia and estado_med = 'A' and a.forma_farmaceutica = 
			d.codigo_forma and a.codigo_interno not in (select a.medicamento_id from 
			compras_detalle a, compras b where a.id_compra = b.id_compra and 
			b.estado = 'P' ) group by b.medicamento_id having sum(b.cantidad_inicial - 
			b.cantidad_factura + b.cantidad_devolucion) < b.inventario_minimo and 
			inve_ide > 0 order by 2");
			return $reg;
		}
		
		public static function medica_provee($id_medica) {
			$reg = conexion::sqlGet("select id_proveedor from medicamento_x_proveedor 
			where medicamento_id = '".$id_medica."' limit 1");
			return $reg;
		}
		
		public static function provee() {
			$reg = conexion::sqlGet("select a.id_proveedor, a.nombre from proveedor a");
			return $reg;
		}
		
	}
	
?>
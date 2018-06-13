<?php
	
	require_once('../clases/conexion.php');
	
	class repcompras{		
		
		public static function provee() {
			$reg = conexion::sqlGet("select '%' as id_proveedor, 'TODOS' as nombre from dual union select id_proveedor, nombre from proveedor");			
			return $reg;
		}
		
		public static function cliente() {
			$reg = conexion::sqlGet("select '%' as id_cliente, 'TODOS' as nombre from dual union select id_cliente, concat(nombre,' ',apellido) as nombre from clientes");			
			return $reg;
		}
		
		public static function select1($fecha1,$fecha2,$id_proveedor,$medicamento_id) {
			$reg = conexion::sqlGet("select a.medicamento_id AS medicamento_id,a.id_compra AS id_interno, a.cantidad_entregada AS cantidad,b.fecha_compra AS fecha,a.costo AS costo_compra, b.usuario_creacion as usuario, c.nombre as proveedor, d.codigo_de_barra as codigo_de_barra from compras_detalle a, compras b, proveedor c, medicamentos d where a.id_compra = b.id_compra and b.id_proveedor = c.id_proveedor and a.medicamento_id = d.codigo_interno and a.estado_proceso = 'F' and b.fecha_compra between '".$fecha1."' and '".$fecha2."' and b.id_proveedor like '".$id_proveedor."' and medicamento_id like '".$medicamento_id."' and a.cantidad_entregada > 0
			union 
			select a.medicamento_id AS medicamento_id,a.id_devolucion AS id_interno,(a.cantidad_devolucion * -1) AS cantidad,b.fecha_devolucion AS fecha,a.costo AS costo_compra, b.usuario_creacion as usuario, c.nombre as proveedor, d.codigo_de_barra as codigo_de_barra from devolucion_ven_detalle a, devolucion_vencimiento b, proveedor c, medicamentos d where a.id_devolucion = b.id_devolucion and b.id_proveedor = c.id_proveedor and a.medicamento_id = d.codigo_interno and b.estado = 'F' and b.fecha_devolucion between '".$fecha1."' and '".$fecha2."' and b.id_proveedor like '".$id_proveedor."' and medicamento_id like '".$medicamento_id."'
			order by fecha, id_interno");			
			return $reg;
		}
		
		public static function select2($medicamento_id1) {
			$reg = conexion::sqlGet("select CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' ', formas_farmaceuticas.descripcion) as nombre
			FROM medicamentos, formas_farmaceuticas, tipos_posologias
			WHERE medicamentos.codigo_interno = '".$medicamento_id1."' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma");			
			return $reg;
		}
		
	}
	
?>		
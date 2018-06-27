<?php
	require_once('../clases/conexion.php');
	
	class devolucion_ppub{
		
		public static function select1($factura) {
			$reg = conexion::sqlGet("SELECT a.medicamento,
			a.forma_farma, a.dosis, a.horas, a.dias, a.linea, 
			(a.cantidad-a.devolucion) as cantidad_dev, a.devolucion,
			b.factura FROM factura_detalle a, factura b,  
			medicamentos d  where b.factura = '".$factura."' 
			and a.cantidad > a.devolucion and a.factura =
			b.factura and a.medicamento_id = d.codigo_interno and 
			d.tipo_mercancia != '3'");
			return $reg;
		}
		public static function select2($factura) {
			$reg = conexion::sqlGet("SELECT a.medicamento, 
			a.forma_farma, a.dosis, a.horas, a.dias, a.linea, 
			a.cargo, (a.cantidad-a.devolucion) as cantidad_dev, 
			a.devolucion, b.factura, a.medicamento_id,
			a.precio_unitario, a.costo_insumo, a.impuesto, 
			a.precio_venta, a.cantidad, d.tipo_de_dosis, b.bodega,
			a.average, a.preparacion, a.cantidad_por_dosis,
			d.grupo_medicamento, a.descuento_unitario FROM 
			factura_detalle a, factura b,  medicamentos d where 
			b.factura = '".$factura."' and a.cantidad > a.devolucion
			and a.factura = b.factura and b.estado_factura = 'I'
			and a.medicamento_id = d.codigo_interno and
			d.tipo_mercancia != '3'");
			return $reg;
		}
		
	}
	
?>
<?php
	
	require_once('../clases/conexion.php');
	
	class comprasx{
		
		public static function select1($fecha1,$fecha2) {
			$reg = conexion::sqlGet("SELECT b.nombre as ContactName,' ' AS EmailAddress, ' ' AS POAddressLine1, ' ' AS POAddressLine2, ' ' AS POAddressLine3, ' ' AS POAddressLine4, ' ' AS POCity, ' ' AS PORegion, ' ' AS POPostalCode, ' ' AS POCountry, a.id_compra as InvoiceNumber,  date_format(a.fecha_compra,'%m/%d/%Y') as InvoiceDate, date_format(a.fecha_compra,'%m/%d/%Y') as DueDate, (select sum(g.total) from compras_detalle g where g.id_compra = c.id_compra and g.estado_proceso = 'F') as Total, c.medicamento_id as InventoryItemCode,  CONCAT( d.nombre_comercial, ' ', '(', d.nombre_generico, ')', ' ', d.posologia, ' ', f.descripcion, ' - ', e.descripcion ) as Description, c.cantidad_entregada as Quantity, (c.costo - c.descuento_unitario) as UnitAmount, '12001' as AccountCode,  if( c.impuesto_total >0, 'ITBMS', 0 ) AS TaxType, 0 AS TaxAmount, ' ' AS TrackingName1, ' ' AS TrackingOption1, ' ' AS TrackingName2, ' ' AS TrackingOption2, ' ' AS Currency
			FROM compras a, proveedor b, compras_detalle c, medicamentos d, formas_farmaceuticas e, tipos_posologias f
			WHERE a.id_proveedor = b.id_proveedor
			AND a.id_compra = c.id_compra
			AND a.estado = 'F'
			and c.estado_proceso = 'F'
			and c.cantidad_entregada > 0
			and date(a.fecha_compra) between '".$fecha1."' and '".$fecha2."'
			and c.medicamento_id = d.codigo_interno
			AND e.codigo_forma = d.forma_farmaceutica
			AND f.codigo_posologia = d.tipo_posologia");			
			return $reg;
		}
		
	}
	
?>
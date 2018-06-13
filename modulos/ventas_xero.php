<?php
	
	require_once('../clases/conexion.php');
	
	class ventasx{
		
		public static function select1($fecha1,$fecha2) {
			$reg = conexion::sqlGet("SELECT concat(b.nombre,' ',b.apellido) AS ContactName, ' ' AS EmailAddress, ' ' AS POAddressLine1, ' ' AS POAddressLine2, ' ' AS POAddressLine3, ' ' AS POAddressLine4,
			' ' AS POCity, ' ' AS PORegion, ' ' AS POPostalCode, ' ' AS POCountry, a.factura AS InvoiceNumber, ' ' AS Reference, 
			date_format(a.fecha,'%m/%d/%Y') AS InvoiceDate, date_format(a.fecha,'%m/%d/%Y')  AS DueDate, a.total AS Total,
			c.medicamento_id AS InventoryItemCode, c.medicamento AS Description, c.cantidad AS Quantity, 
			c.precio_unitario AS UnitAmount, round((c.descuento_unitario*100/c.precio_unitario),2) AS Discount, '12101' AS AccountCode, if( c.impuesto >0, 'ITBMS', 0 ) AS TaxType, round(c.impuesto,2) AS TaxAmount, 
			' ' AS TrackingName1, ' ' AS TrackingOption1, ' ' AS TrackingName2, ' ' AS TrackingOption2, ' ' AS Currency, ' ' AS BrandingTheme
			FROM factura a, clientes b, factura_detalle c
			WHERE a.codigo_cliente = b.id_cliente
			AND date(a.fecha)
			BETWEEN '".$fecha1."'
			AND '".$fecha2."'
			AND a.estado_factura = 'I'
			AND a.factura = c.factura
			AND c.estado_producto = 'P'");			
			return $reg;
		}
		
	}
	
?>
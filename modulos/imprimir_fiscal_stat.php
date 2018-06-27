<?php
	require_once('../clases/conexion.php');
	
	class imprimir{
		
		public static function select1($factura) {
			$reg = conexion::sqlGet("SELECT total, FA, historia, cargo, no_cama, tratamiento, stat, bodega from factura where factura = '".$factura."'");			
			return $reg;
		}
		
		public static function select2($car,$hist,$trata) {
			$reg = conexion::sqlGet("select nombre_paciente, id_paciente from registro where cargo = '".$car."' and historia = '".$hist."' and tratamiento = '".$trata."' ");			
			return $reg;
		}
		
		public static function select3($bodega) {
			$reg = conexion::sqlGet("select descripcion from bodegas where bodega = '".$bodega."'");			
			return $reg;
		}
		
		public static function select4() {
			$reg = conexion::sqlGet("select nombre_carpeta, nombre_carpeta2 from impresoras_fiscales where tipo_impresion = 'STA'");			
			return $reg;
		}
		
		public static function select5() {
			$reg = conexion::sqlGet("select factura_detalle.medicamento_id, factura_detalle.medicamento, factura_detalle.dosis, factura_detalle.cantidad, (factura_detalle.precio_unitario + factura_detalle.costo_insumo) as precio_unitario, (impuesto.factor * 100) as impuesto, medicamentos.tipo_de_dosis, linea_adic from factura_detalle, medicamentos, impuesto where factura_detalle.factura = '$factura' and factura_detalle.estado_producto != 'X' and medicamentos.codigo_interno = factura_detalle.medicamento_id and medicamentos.tipo_impuesto = impuesto.tipo_impuesto order by factura_detalle.linea_adic");			
			return $reg;
		}
		
	}
	
?>
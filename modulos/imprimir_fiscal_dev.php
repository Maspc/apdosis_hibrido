<?php
	require_once('../clases/conexion.php');
	
	class imprimir_fd{
	
		public static function select1($devolucion) {
			$sql ="SELECT sum(precio_venta) as total from 
			devolucion_detalle where devolucion = '".$devolucion."' 
			and no_aceptada != 'S'"; 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}		
		public static function select2($devolucion) {
			$sql = "SELECT total, fecha_creacion, 
			factura, historia, no_cama, FA from devolucion
			where devolucion = '".$devolucion."'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select3($hist) {
			$sql = "select distinct nombre_paciente,
			id_paciente from registro where historia = '".$hist."'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select4($factura) {
			$sql = "select factura_fiscal, equipo_fiscal, 
			archivo_fiscal from factura where factura = '".$factura."' ";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select5() {
			$sql = "select nombre_carpeta, nombre_carpeta2
			from impresoras_fiscales where tipo_impresion = 'DEV'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select6($devolucion) {
			$sql =  "select medicamento_id, medicamento,
			dosis, cantidad, (devolucion_detalle.precio_unitario +
			devolucion_detalle.costo_insumo) as precio_unitario,
			(impuesto.factor * 100) as impuesto,
			medicamentos.tipo_de_dosis from devolucion_detalle, 
			impuesto, medicamentos where devolucion= '".$devolucion."'
			and medicamentos.codigo_interno = 
			devolucion_detalle.medicamento_id and 
			medicamentos.tipo_impuesto = impuesto.tipo_impuesto 
			and no_aceptada != 'S'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		
		public static function select7($devolucion) {
			$sql = "SELECT sum(precio_venta) as total from devolucion_detalle where devolucion = '".$devolucion."' and no_aceptada != 'S'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		
		public static function select8($devolucion) {
			$sql = "SELECT total, fecha_creacion, factura, historia, no_cama, FA from devolucion where devolucion = '".$devolucion."'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		
		public static function select9($hist) {
			$sql = "select distinct nombre_paciente, id_paciente from registro where historia = '".$hist."'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		
		public static function select10($factura) {
			$sql = "select factura_fiscal, equipo_fiscal, archivo_fiscal from factura where factura = '".$factura."'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		
		public static function select11() {
			$sql = "select nombre_carpeta, nombre_carpeta2 from impresoras_fiscales where tipo_impresion = 'DEV'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		
		public static function select12($devolucion) {
			$sql = "select medicamento_id, medicamento, dosis, cantidad, (devolucion_detalle.precio_unitario + devolucion_detalle.costo_insumo) as precio_unitario, (impuesto.factor * 100) as impuesto, medicamentos.tipo_de_dosis from devolucion_detalle, impuesto, medicamentos where devolucion= '".$devolucion."' and medicamentos.codigo_interno = devolucion_detalle.medicamento_id and medicamentos.tipo_impuesto = impuesto.tipo_impuesto and no_aceptada != 'S'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
	}
	
?>
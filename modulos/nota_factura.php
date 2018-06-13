<?php
	
	require_once('../clases/conexion.php');
	
	class notafactura{		
		
		public static function nimpresoras($nombre_carpeta2) {
			$reg = conexion::sqlGet("select nombre from nombres_impresoras where carpeta = '".$nombre_carpeta2."'");			
			return $reg;
		}
		
		public static function devol($FA) {
			$reg = conexion::sqlGet("SELECT (total) as total, devolucion from devolucion where FA = '".$FA."'");			
			return $reg;
		}
		
		public static function nnota() {
			$reg = conexion::sqlGet("select max(nota_debito) as nota_debito from nota_debito");			
			return $reg;
		}
		
		public static function insert1($devolucion,$total,$factura_fiscal,$equipo_fiscal) {
			conexion::trQry("insert into nota_debito(devolucion, total, fecha_nota, estado, devolucion_fiscal, equipo_devolucion) values ('".$devolucion."', '".$total."', '".date('Y-m-d H:i',time())."','P', '".$factura_fiscal."', '".$equipo_fiscal."')");			
			return 1;
		}
		
		public static function select1($factura_fiscal) {
			$reg = conexion::sqlGet("select 1 as existe from devolucion where factura_fiscal = '".$factura_fiscal."'");			
			return $reg;
		}
		
		public static function insert2($factura_fiscal,$FA,$c,$d,$e,$k,$g) {
			conexion::trQry("insert into factura_faltante (factura_fiscal, FA, nombre_paciente, id_paciente, fecha, total, equipo_fiscal) values 
			('".$factura_fiscal."', '".$FA."', '".$c."', '".$d."', '".$e."','".$k."' '".$g."')");			
			return 1;
		}
		
		public static function select2($devolucion) {
			$reg = conexion::sqlGet("SELECT total, fecha_creacion, factura, historia, no_cama from devolucion where devolucion = '".$devolucion."'");			
			return $reg;
		}
		
		public static function select3($hist) {
			$reg = conexion::sqlGet("select distinct nombre_paciente, id_paciente from registro where historia = '".$hist."'");			
			return $reg;
		}
		
		public static function select4($devolucion) {
			$reg = conexion::sqlGet("select factura_fiscal, equipo_fiscal, archivo_fiscal, FA from devolucion  where devolucion = '".$devolucion."' ");			
			return $reg;
		}
		
	}
	
?>
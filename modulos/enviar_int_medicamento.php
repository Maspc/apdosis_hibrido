<?php
	require_once('../clases/conexion.php');
	
	class enviar_inm{
		
		public static function update1($razon,$userid,$cargo,$tratamiento,$historia,$ine) {
			$sql ="update registro_detalle set cantidad_de_dosis = 
			0, estado = 'X', razon_int = '".$razon."',
			interrumpido_por='".$userid."', fecha_interrupcion =
			'".date('Y-m-d H:i',time())."' where cargo = 
			'".$cargo."' and tratamiento = '".$tratamiento."' 
			and historia = '".$historia."' and linea = '".$ine."'"; 
			conexion::trQry($sql);
			return 1;
		}
		public static function update2($cargo,$tratamiento,$historia,$ine) {
			$sql ="update factura_detalle set estado_producto =
			'X' where factura_detalle.cargo = '".$cargo."' and 
			factura_detalle.tratamiento = '".$tratamiento."' and 
			factura_detalle.historia = '".$historia."' and linea = 
			'".$ine."' and factura_detalle.estado_producto = 'E' ";
			conexion::trQry($sql);
			return 1;
		}
		public static function select1($cargo,$tratamiento,$historia) {
			$reg = conexion::sqlGet("select sum(cantidad_de_dosis)
			as valido from registro_detalle where cargo = '".$cargo."' 
			and tratamiento = '".$tratamiento."' and historia = '".$historia."'");
			return $reg;
		}
		public static function update3($cargo,$tratamiento,$historia) {
			$sql ="update registro set estado = 'F' where cargo =
			'".$cargo."' and tratamiento = '".$tratamiento."' and historia =
			'".$historia."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function update4($cargo,$historia,$tratamiento) {
			$sql ="update factura set estado_factura =
			'X' where cargo = '".$cargo."' and historia = '".$historia."' 
			and tratamiento = '".$tratamiento."' and (estado_factura = 
			'E' or estado_factura = 'R')";
			conexion::trQry($sql);
			return 1;
		}
		public static function select2($cargo,$historia,$tratamiento) {
			$reg = conexion::sqlGet("select factura from factura where 
			cargo = '".$cargo."' and historia = '".$historia."' and tratamiento = 
			'".$tratamiento."' and estado_factura = 'X'");
			return $reg;
		}
		public static function update5($hrow) {
			$sql ="update factura_detalle set estado_producto = 'X' where factura = ".$hrow."";
			conexion::trQry($sql);
			return 1;
		}
	}
?>
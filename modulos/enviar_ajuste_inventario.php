<?php
	require_once('../clases/conexion.php');
	
	class buscarf{
		
		public static function select1() {
			$reg = conexion::sqlGet("select factura.estado_factura, factura.factura, factura.total, factura.fecha, factura.ordenado_por,
			factura.caja_id
			from  factura where factura.factura_fiscal = ' ' and factura.estado_factura in ('I', 'F') and factura.publico = 'S'");
			return $reg;
		}
		public static function update1($cantidad,$medicamento_id,$lote) {
			$sql ="update medicamentos_x_lote set cantidad =
			cantidad + '".$cantidad."' where medicamento_id =
			'".$medicamento_id."' and lote = '".$lote."'"; 
			conexion::trQry($sql);
			return 1;
		}
		public static function update2($cantidad,$medicamento_id) {
			$sql ="update medicamentos_x_bodega set cantidad_inicial =
			cantidad_inicial + '".$cantidad."' where medicamento_id = 
			'".$medicamento_id."' and bodega = '1'"; 
			conexion::trQry($sql);
			return 1;
		}
		
		
		public static function insert1($medicamento_id,$hora_actual,$MM_iduser) {
			$sql ="insert into auditoria_med (medicamento_id, 
			fecha, usuario, transaccion) values ('".$medicamento_id."', 
			'".$hora_actual."', '".$MM_iduser."',
			'UPDATEINVEN1')";
			conexion::trQry($sql);			
			
			return 1;
		}
		public static function insert2($tipo,$medicamento_id,$cantidad,$hora_actual,$MM_iduser) {
			$sql ="insert into ajuste_inventario 
			(tipo_ajuste, medicamento_id, bodega, cantidad, 
			fecha_ajuste, usuario_ajuste) values 
			('".$tipo."','".$medicamento_id."', '1', '".$cantidad."', 
			'".$hora_actual."', '".$MM_iduser."')";
			conexion::trQry($sql);			
			
			return 1;
		}
	}
	
?>
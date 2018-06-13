<?php
	require_once('../clases/conexion.php');
	
	class ocomprasdet{
		
		public static function provee() {
			$reg = conexion::sqlGet("select id_proveedor, nombre from proveedor where id_proveedor = '360'");			
			return $reg;
		}
		
		public static function insert1($proveedor,$observaciones,$user) {
			$sql = "insert into compras (id_proveedor, observacion, fecha_compra, usuario_creacion, estado, factura_proveedor, tipo_entrada, externo) values ('".$proveedor."', '".$observaciones."', '". date('Y-m-d H:i',time())."', '".$user."', 'P', ' ', '2', 'S')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function maxid() {
			$reg = conexion::sqlGet("select max(id_compra) as id from compras");			
			return $reg;
		}
		
		public static function select1($medicamento_id) {
			$reg = conexion::sqlGet("select codigo_de_barra from medicamentos where codigo_interno = '".$medicamento_id."'");			
			return $reg;
		}
		
		public static function select2() {
			$reg = conexion::sqlGet("select ip from bodegas_externas where bodega='1'");			
			return $reg;
		}
		
		public static function select3() {
			$reg = conexion::sqlGet("select codigo_interno from medicamentos where codigo_de_barra = '".$codigo_de_barra."'");			
			return $reg;
		}
		
		public static function insert2($y,$d,$medicamento_id,$cantidad_compra,$cantidad_compra) {
			$sql = "insert into compras_detalle (id_compra, linea, medicamento_id, cantidad_compra,cantidad_pendiente, estado_proceso) value ('".$y."', '".$d."', '".$medicamento_id."', '".$cantidad_compra."','".$cantidad_compra."','P')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert3($user,$medicamento_id_ext,$cantidad_externo) {
			$sql = "insert into traslados_ext (bodega_origen, bodega_destino,fecha_creacion, usuario_creacion, medicamento_id, cantidad, estado) values ('2', '1', '". date('Y-m-d H:i',time())."', '".$user."', '".$medicamento_id_ext."','".$cantidad_externo."', 'F')";
			conexion::trQry($sql);
			return 1;
		}
				
	}
	
?>
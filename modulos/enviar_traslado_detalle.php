<?php
	require_once('../clases/conexion.php');
	
	class edetalle{		
		
		public static function insert1($bodega_origen,$bodega_destino,$user) {
			$sql = "insert into traslados (bodega_origen, bodega_destino,fecha, usuario_creacion) values ('".$bodega_origen."', '".$bodega_destino."', '". date('Y-m-d H:i',time())."', '".$user."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function maxid() {
			$reg = conexion::sqlGet("select max(id_traslado) as id from traslados");
			return $reg;
		}
		
		public static function insert2($y,$d,$medicamento_id,$cantidad) {
			$sql = "insert into traslados_detalle (id_traslado, linea, medicamento_id, cantidad) value ('".$y."', '".$d."', '".$medicamento_id."', '".$cantidad."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select1($bodega_destino,$medicamento_id) {
			$reg = conexion::sqlGet("select medicamento_id from medicamentos_x_bodega where bodega = '".$bodega_destino."' and medicamento_id = '".$medicamento_id."'");
			return $reg;
		}
		
		public static function insert3($medicamento_id,$cantidad,$bodega_destino) {
			$sql = "insert into medicamentos_x_bodega (medicamento_id, fecha_inicial, cantidad_inicial, estado, inventario_ideal, inventario_maximo, 				inventario_critico, bodega) values ('".$medicamento_id."', '".date("Y-m-d H:i",time())."', 0, 'A', '".$cantidad."','".$cantidad."','0','".$bodega_destino."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update1($cantidad,$medicamento_id,$bodega_destino) {
			$sql = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial + '".$cantidad."'  where medicamento_id = '".$medicamento_id."' and bodega = '".$bodega_destino."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update2($cantidad,$medicamento_id,$bodega_origen) {
			$sql = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial - '".$cantidad."'  where medicamento_id = '".$medicamento_id."' and bodega = '".$bodega_origen."'";
			conexion::trQry($sql);
			return 1;
		}
		
	}
	
?>
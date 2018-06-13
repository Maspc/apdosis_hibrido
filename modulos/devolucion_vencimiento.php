<?php
	require_once('../clases/conexion.php');
	
	class dvencimiento{		
		
		public static function insert1($proveedor,$observaciones,$user) {
			$sql = "insert into devolucion_vencimiento (id_proveedor, observacion, fecha_devolucion, usuario_creacion, estado) values ('".$proveedor."', '".$observaciones."', '". date('Y-m-d H:i',time())."', '".$user."', 'F')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function maxid() {
			$reg = conexion::sqlGet("select max(id_devolucion) as id from devolucion_vencimiento");
			return $reg;
		}
		
		public static function insert2($y,$d,$medicamento_id,$cantidad_devuelta,$lote,$vencimiento,$costo) {
			$sql = "insert into devolucion_ven_detalle (id_devolucion, linea, medicamento_id, cantidad_devolucion, lote, fecha_de_vencimiento, costo) value ('".$y."', '".$d."', '".$medicamento_id."', '".$cantidad_devuelta."', '".$lote."', '".$vencimiento."',  '".$costo."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update1($cantidad_devuelta,$medicamento_id) {
			$sql = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial - '".$cantidad_devuelta."' where medicamento_id = '".$medicamento_id."' and bodega = '1'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select1($medicamento_id) {
			$reg = conexion::sqlGet("select fecha_vencimiento, lote from medicamentos_x_lote where medicamento_id = '".$medicamento_id."'");
			return $reg;
		}
		
		public static function update2($cantidad_devuelta,$costo,$medicamento_id,$lote) {
			$sql = "update medicamentos_x_lote set cantidad = cantidad - '".$cantidad_devuelta."', costo = '".$costo."'  where medicamento_id = '".$medicamento_id."'  and lote = '".$lote."'";
			conexion::trQry($sql);
			return 1;
		}
		
	}
	
?>
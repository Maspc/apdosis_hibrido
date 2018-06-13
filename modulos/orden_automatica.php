<?php
	require_once('../clases/conexion.php');
	
	class oautomatica{
		
		public static function idcompras() {
			$reg = conexion::sqlGet("select max(id_compra) as id from compras_detalle_temp");			
			return $reg;
		}
		
		public static function insert1($id,$l,$medicamento_id,$canti_orden,$proveedor) {
			
			$sql = "insert into compras_detalle_temp ( 	id_compra, 		
			linea ,
			medicamento_id ,
			cantidad_compra 	,
			lote ,
			fecha_de_vencimiento , id_proveedor) values ( '".$id."', '".$l."', '".$medicamento_id."', '".$canti_orden."', ' ', ' ', '".$proveedor."')";
			conexion::trQry($sql);			
			
			return 1;
		}
		
		public static function select1($id) {
			$reg = conexion::sqlGet("select distinct id_proveedor from compras_detalle_temp where id_compra = '".$id."'");			
			return $reg;
		}
		
		public static function insert2($prov,$user) {
			$Hora = Time(); // Hora actual
			$hora_actual =  date('Y-m-d H:i',$Hora);
			
			$sql = "insert into compras (fecha_compra ,id_proveedor ,
			usuario_creacion,
			observacion ,id_medicamento ,
			cantidad ,
			lote ,
			fecha_vencimiento ,
			factura_proveedor ,
			estado, tipo_entrada) values ('".$hora_actual."', '".$prov."','".$user."', 'Orden generada automaticamente por inventario bajo', ' ', ' ', ' ', ' ', ' ', 'P', '2')";
			conexion::trQry($sql);			
			
			return 1;
		}
		
		public static function idcompras2() {
			$reg = conexion::sqlGet("select max(id_compra) as id2 from compras");			
			return $reg;
		}
		
		public static function select2($id,$prov) {
			$reg = conexion::sqlGet("select id_compra,	linea ,
			medicamento_id 	,cantidad_compra ,lote ,
			fecha_de_vencimiento from compras_detalle_temp where id_compra = '".$id."' and id_proveedor = '".$prov."'");			
			return $reg;
		}
		
		public static function insert3($id2,$con,$medicamento_id,$cantidad_compra) {
			
			$sql = "insert into compras_detalle  (id_compra,	linea ,	medicamento_id 	,cantidad_compra ,lote ,
								fecha_de_vencimiento, estado_proceso, cantidad_pendiente) values ('".$id2."', '".$con."', '".$medicamento_id."', '".$cantidad_compra."', ' ', ' ', 'P', '".$cantidad_compra."')";
			conexion::trQry($sql);			
			
			return 1;
		}
		
	}
	
?>
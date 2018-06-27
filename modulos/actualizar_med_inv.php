<?php
	require_once('../clases/conexion.php');
	
	class amedinv{
				
		public static function update1($inventario_minimo,$inventario_maximo,$inventario_ideal,$inventario_critico,$cantidad_inicial,$cantidad_factura,$cantidad_devolucion,$MM_iduser,$hora_actual,$medicamento_id) {
			$sql = "update medicamentos_x_bodega set inventario_minimo = '".$inventario_minimo."', inventario_maximo = '".$inventario_maximo."', inventario_ideal = '".$inventario_ideal."', inventario_critico = '".$inventario_critico."', cantidad_inicial = '".$cantidad_inicial."', cantidad_factura = '".$cantidad_factura."', cantidad_devolucion = '".$cantidad_devolucion."', usuario_modificacion='".$MM_iduser."', fecha_modificacion='".$hora_actual."' where medicamento_id = '".$medicamento_id."' and bodega = '1'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update2($costo_unitario,$porcentaje_ganancia,$MM_iduser,$hora_actual,$medicamento_id) {
			$sql = "update medicamentos set costo_unitario = '".$costo_unitario."',  porc_ganancia = '".$porcentaje_ganancia."', usuario_modificacion='".$MM_iduser."', fecha_modificacion='".$hora_actual."' where codigo_interno = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert1($medicamento_id,$hora_actual,$MM_iduser,$costo_unitario) {
			$sql = "insert into auditoria_med (medicamento_id, fecha, usuario, transaccion, costo) values ('".$medicamento_id."', '".$hora_actual."', '".$MM_iduser."', 'UPDATECOSTO3', '".$costo_unitario."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select1($medicamento_id) {
			$reg = conexion::sqlGet("select precio_unitario from medicamentos where codigo_interno = '".$medicamento_id."'");
			return $reg;
		}
		
		public static function update3($precio_unitario,$precio_unitario_pub,$MM_iduser,$hora_actual,$medicamento_id) {
			$sql = "update medicamentos set precio_unitario='".$precio_unitario."', precio_unitario_pub='".$precio_unitario_pub."', usuario_modificacion='".$MM_iduser."', fecha_modificacion='".$hora_actual."' where codigo_interno = '".$medicamento_id."' ";
			conexion::trQry($sql);
			return 1;
		}	
		
		public static function insert2($medicamento_id,$hora_actual,$MM_iduser,$precio_unitario) {
			$sql = "insert into auditoria_med (medicamento_id, fecha, usuario, transaccion, precio) values ('".$medicamento_id."', '".$hora_actual."', '".$MM_iduser."', 'UPDATEPRECIO2', '".$precio_unitario."')";
			conexion::trQry($sql);
			return 1;
		}
		
	}
	
?>
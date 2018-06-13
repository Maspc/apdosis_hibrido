<?php
	require_once('../clases/conexion.php');
	
	class amedinv{
		
		public static function select1($user) {
			$reg = conexion::sqlGet("select a.codigo_tipo from tipos_usuario a, usuarios b where a.codigo_tipo = b.tipo and b.user = '".$user."'");
			return $reg;
		}
		
		public static function update1($inventario_minimo,$inventario_maximo,$inventario_ideal,$inventario_critico,$cantidad_inicial,$cantidad_factura,$cantidad_devolucion,$user,$hora_actual,$medicamento_id) {
			$sql = "update medicamentos_x_bodega set inventario_minimo = '".$inventario_minimo."', inventario_maximo = '".$inventario_maximo."', inventario_ideal = '".$inventario_ideal."', inventario_critico = '".$inventario_critico."', cantidad_inicial = '".$cantidad_inicial."', cantidad_factura = '".$cantidad_factura."', cantidad_devolucion = '".$cantidad_devolucion."', usuario_modificacion='".$user."', fecha_modificacion='".$hora_actual."' where medicamento_id = '".$medicamento_id."' and bodega = '1'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update2($inventario_minimo_tienda,$inventario_maximo_tienda,$inventario_ideal_tienda,$inventario_critico_tienda,$cantidad_inicial_tienda,$cantidad_factura_tienda,$cantidad_devolucion_tienda,$user,$hora_actual,$medicamento_id) {
			$sql = "update medicamentos_x_bodega set inventario_minimo = '".$inventario_minimo_tienda."', inventario_maximo = '".$inventario_maximo_tienda."', inventario_ideal = '".$inventario_ideal_tienda."', inventario_critico = '".$inventario_critico_tienda."', cantidad_inicial = '".$cantidad_inicial_tienda."', cantidad_factura = '".$cantidad_factura_tienda."', cantidad_devolucion = '".$cantidad_devolucion_tienda."', usuario_modificacion='".$user."', fecha_modificacion='".$hora_actual."' where medicamento_id = '".$medicamento_id."' and bodega = '2'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select2($medicamento_id) {
			$reg = conexion::sqlGet("select precio_unitario from medicamentos where codigo_interno = '".$medicamento_id."'");
			return $reg;
		}
		
		public static function update3($costo_unitario,$precio_unitario,$porcentaje_ganancia,$user,$hora_actual,$codigo_de_barra,$porc_vario,$medicamento_id) {
			$sql = "update medicamentos set costo_unitario = '".$costo_unitario."', precio_unitario = '".$precio_unitario."', porc_ganancia = '".$porcentaje_ganancia."', usuario_modificacion='".$user."', fecha_modificacion='".$hora_actual."', codigo_de_barra='".$codigo_de_barra."', porc_vario='".$porc_vario."' where codigo_interno = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}	
		
		public static function insert1($medicamento_id,$user,$costo_unitario,$precio_unitario) {
			$sql = "insert into auditoria_med (medicamento_id, fecha, usuario, transaccion, costo, precio) values ('".$medicamento_id."', '". date('Y-m-d H:i',time())."', '".$user."', 'UPDATEPRECIO1', '".$costo_unitario."', '".$precio_unitario."')";
			conexion::trQry($sql);
			return 1;
		}
		
	}
	
?>
<?php
	require_once('../clases/conexion.php');
	
	class conteoi{
		
		public static function select1() {
			$reg = conexion::sqlGet("select distinct id_anaquel from conteo_anaquel where estado = 'A'");
			return $reg;
		}
		
		public static function select2($anaquel) {
			$reg = conexion::sqlGet("select max(b.id_conteo) as conteo from conteo_anaquel b  where b.id_anaquel = '".$anaquel."' and  b.estado = 'A'");
			return $reg;
		}
		
		public static function select3($anaquel,$id_conteo,$medicamento_id) {
			$reg = conexion::sqlGet("select medicamento_id from conteo_inventario a where id_anaquel = '".$anaquel."' and id_conteo = '".$id_conteo."' and medicamento_id = '".$medicamento_id."'");
			return $reg;
		}
		
		public static function insert1($id_conteo,$anaquel,$codigo_de_barra,$medicamento,$medicamento_id,$cantidad,$cambiar_desc,$MM_iduser) {
			$sql = "insert into conteo_inventario (id_conteo, id_anaquel, codigo_de_barra, medicamento, medicamento_id, conteo_final, realizar_cambio, usuario_ajuste) values ('".$id_conteo."','".$anaquel."', '".$codigo_de_barra."', '".$medicamento."', '".$medicamento_id."', '".$cantidad."', '".$cambiar_desc."', '".$MM_iduser."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select4($anaquel,$medicamento_id) {
			$reg = conexion::sqlGet("select medicamento_id from conteo_inventario a where id_anaquel != '".$anaquel."'  and medicamento_id = '".$medicamento_id."' and id_conteo in ( select max(id_conteo) from conteo_anaquel where id_anaquel != '".$anaquel."' and estado = 'A')");
			return $reg;
		}
		
		public static function select5($medicamento_id) {
			$reg = conexion::sqlGet("select (cantidad_inicial - cantidad_factura + cantidad_devolucion) as cantidad_sistema from medicamentos_x_bodega where medicamento_id = '".$medicamento_id."' and bodega = '1'");
			return $reg;
		}
		
		public static function insert2($tipo_ajuste,$medicamento_id,$diferencia,$MM_iduser) {
			$sql = "insert into ajuste_inventario (tipo_ajuste, medicamento_id, bodega, cantidad, usuario_ajuste) values ('".$tipo_ajuste."', '".$medicamento_id."','1', '".$diferencia."', '".$MM_iduser."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update1($diferencia,$medicamento_id) {
			$sql = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial - ".$diferencia." where medicamento_id = '".$medicamento_id."' and bodega = '1'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update2($anaquel,$medicamento_id) {
			$sql = "update medicamentos set ubicacion =  '".$anaquel."' where codigo_interno = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert3($medicamento_id,$cantidad,$MM_iduser) {
			$sql = "insert into ajuste_inventario (tipo_ajuste, medicamento_id, bodega, cantidad, usuario_ajuste) values ('P', '".$medicamento_id."','1', '".$cantidad."', '".$MM_iduser."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update3($cantidad,$medicamento_id) {
			$sql = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial + '".$cantidad."' where medicamento_id = '".$medicamento_id."' and bodega = '1'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update4($anaquel,$medicamento_id) {
			$sql = "update medicamentos set ubicacion =  '".$anaquel."' where codigo_interno = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select6($anaquel) {
			$reg = conexion::sqlGet("select codigo_de_barra, medicamento, conteo_final, id_conteo, id_anaquel from conteo_inventario where id_anaquel = '".$anaquel."' and id_conteo = (select max(a.id_conteo) from conteo_inventario a, conteo_anaquel b  where a.id_anaquel = '".$anaquel."' and a.id_conteo = b.id_conteo and a.id_anaquel = b.id_anaquel and b.estado = 'A')");
			return $reg;
		}
		
	}
	
?>
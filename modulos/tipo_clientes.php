<?php
	require_once('../clases/conexion.php');
	
	class clientes{		
		
		public static function insert_clie($descripcion,$descuento_maximo) {
			conexion::trQry("insert into tipo_clientes (descripcion,descuento_maximo)
			values('".$descripcion."', '".$descuento_maximo."')");
			return 1;
		}
		
		public static function update_clie($descripcion,$descuento_maximo,$codigo) {
			conexion::trQry("update tipo_clientes set descripcion = '".$descripcion."', descuento_maximo = '".$descuento_maximo."' where codigo_tipo='".$codigo."'");
			return 1;
		}
		
		public static function edita_clie($codigo) {
			$edita_clie = conexion::sqlGet("select * from tipo_clientes where codigo_tipo='".$codigo."'");
			return $edita_clie;
		}
		
		public static function dat_tcliente() {
			$dat_tcliente = conexion::sqlGet("select * from tipo_clientes order by descripcion");
			return $dat_tcliente;
		}
		
	}
	
?>
<?php
	require_once('../clases/conexion.php');
	
	class amedmed{
		
		public static function update1($forma_farma,$tipo_posologia,$tipo_de_dosis,$posologia,$codigo_barras,$nombre_comercial,$nombre_generico,$presentacion,$cantidad_x_empaque,$volumen,$fabricante,$costo_unitario,$costo_caja,$precio_caja,$cantidad_inicial,$antibiotico,$narcotico,$preparacion,$devolucion,$codigo_proveedor,$tipo_volumen,$grupo_medicamento,$multiple_principio,$tipo_impuesto,$MM_iduser,$importacion,$jubilado,$descuento_total,$cant_max_prov,$anaquel,$prod_hosp,$prod_pub,$medicamento_id) {
			$sql = "update medicamentos set forma_farmaceutica = '".$forma_farma."', tipo_posologia = '".$tipo_posologia."', tipo_de_dosis = '".$tipo_de_dosis."', posologia = '".$posologia."', codigo_de_barra = '".$codigo_barras."', nombre_comercial = '".$nombre_comercial."', nombre_generico = '".$nombre_generico."', presentacion = '".$presentacion."', cantidad_x_empaque = '".$cantidad_x_empaque."', volumen = '".$volumen."', fabricante = '".$fabricante."', costo_unitario = '".$costo_unitario."', costo_caja = '".$costo_caja."', precio_caja = '".$precio_caja."', cantidad_inicial = '".$cantidad_inicial."', antibiotico = '".$antibiotico."', narcotico = '".$narcotico."', preparacion = '".$preparacion."', permite_devol = '".$devolucion."', codigo_proveedor = '".$codigo_proveedor."', tipo_volumen = '".$tipo_volumen."', grupo_medicamento = '".$grupo_medicamento."', sub_grupo='1', multiple_principio='".$multiple_principio."', tipo_impuesto='".$tipo_impuesto."', usuario_modificacion='".$MM_iduser."', fecha_modificacion='".date("Y-m-d H:i",time())."', importacion = '".$importacion."', jubilado='".$jubilado."', descuento_total = '".$descuento_total."', cant_max_prov='".$cant_max_prov."', ubicacion='".$anaquel."', prod_hosp='".$prod_hosp."', prod_pub='".$prod_pub."' where codigo_interno = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select1($forma_farma) {
			$reg = conexion::sqlGet("select descripcion from formas_farmaceuticas where codigo_forma = '".$forma_farma."'");
			return $reg;
		}
	}
	
?>
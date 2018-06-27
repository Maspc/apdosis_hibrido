<?php
	require_once('../clases/conexion.php');
	
	class actins{
		
		public static function select1($anaquel,$conteo) {
			$reg = conexion::sqlGet("select estado from conteo_anaquel where id_anaquel = '".$anaquel."' and id_conteo =  '".$conteo."'");
			return $reg;
		}
		
		public static function update1($codigo_barras,$nombre_comercial,$nombre_generico,$presentacion,$cantidad_x_empaque,$volumen,$costo_unitario,$costo_caja,$precio_caja,$cantidad_inicial,$antibiotico,$narcotico,$preparacion,$devolucion,$codigo_proveedor,$grupo_medicamento,$multiple_principio,$tipo_impuesto,$sub_grupo,$jubilado,$descuento_total,$cant_max_prov,$prod_hosp,$prod_pub,$medicamento_id) {
			$sql = "update medicamentos set  codigo_de_barra = '".$codigo_barras."', 
			nombre_comercial = '".$nombre_comercial."', 
			nombre_generico = '".$nombre_generico."', 
			presentacion = '".$presentacion."', 
			cantidad_x_empaque = '".$cantidad_x_empaque."', volumen = '".$volumen."',  
			costo_unitario = '".$costo_unitario."', costo_caja = '".$costo_caja."', 
			precio_caja = '".$precio_caja."', cantidad_inicial = '".$cantidad_inicial."', 
			antibiotico = '".$antibiotico."', narcotico = '".$narcotico."', 
			preparacion = '".$preparacion."', permite_devol = '".$devolucion."', 
			codigo_proveedor = '".$codigo_proveedor."', 
			grupo_medicamento = '".$grupo_medicamento."', 
			multiple_principio='".$multiple_principio."',
			tipo_impuesto = '".$tipo_impuesto."',sub_grupo='".$sub_grupo."', 
			jubilado='".$jubilado."', descuento_total='".$descuento_total."', 
			cant_max_prov='".$cant_max_prov."', prod_hosp = '".$prod_hosp."', 
			prod_pub = '".$prod_pub."' where codigo_interno = '".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
	}
	
?>
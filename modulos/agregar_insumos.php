<?php
	require_once('../clases/conexion.php');
	
	class ainsumos{
		
		public static function gmedica() {
			$gmedica = conexion::sqlGet("SELECT codigo_grupo, descripcion FROM grupo_de_medicamentos where tipo=2");
			return $gmedica;
		}
		
		public static function provee() {
			$provee = conexion::sqlGet("select id_proveedor, nombre from proveedor");
			return $provee;
		}
		
		public static function timpuesto() {
			$timpuesto = conexion::sqlGet("select tipo_impuesto, factor from impuesto");
			return $timpuesto;
		}
		
		public static function codigoBarra() {
			$codigoBarra = conexion::sqlGet("select consecutivo_barra + 1 as consec from consecutivo_sin_barra");
			
			foreach($codigoBarra as $cb){
				$codigob = $cb->consec;
			}
			return $codigob;
		}
		
		public static function PorcenGana($grupo_medicamento,$sub_grupo) {
			$PorcenGana = conexion::sqlGet("select porcentaje_ganancia from sub_grupo where codigo_grupo = '".$grupo_medicamento."' and codigo_sub = '".$sub_grupo."'");
			
			foreach($PorcenGana as $pg){
				$porceng = $pg->porcentaje_ganancia;
			}
			return $porceng;
		}
		
		public static function procesaInfo($codigo_de_barra, $nombre_generico,  $nombre_comercial, $user, $cantidad_inicial, $codigo_prov, $costo_unitario, $tipo_impuesto, $grupo_medicamento, $sub_grupo, $jubilado, $descuento_total,$cant_max_prov,$porcentaje_ganancia,$proveedor_principal) {
			
			$resu = "insert into medicamentos (codigo_de_barra, nombre_generico, nombre_comercial, tipo_posologia, forma_farmaceutica, presentacion, usuario_creacion,  cantidad_inicial, codigo_proveedor, costo_unitario, tipo_mercancia,fabricante,tipo_de_dosis,tipo_impuesto, grupo_medicamento, sub_grupo, jubilado, estado_med, descuento_total,cant_max_prov, porc_ganancia) 
			values ('".$codigo_de_barra."', '".$nombre_generico."',  '".$nombre_comercial."', '8', '192' ,'23','".$_SESSION['MM_user']."', '".$cantidad_inicial."', '".$codigo_prov."', '".$costo_unitario."', '2', '1', 'N', '".$tipo_impuesto."', '".$grupo_medicamento."', '".$sub_grupo."', '".$jubilado."', 'A', '".$descuento_total."','".$cant_max_prov."','".$porcentaje_ganancia."')";
			conexion::trQry($resu);
			
			$idm = conexion::sqlGet("select max(codigo_interno) as id from medicamentos");
			
			$id = $idm[0]->id;
			
			$l= "insert into medicamentos_x_bodega (medicamento_id, fecha_inicial, cantidad_inicial, estado, inventario_ideal, inventario_maximo, inventario_critico, bodega) values ('".$id."', '".date("Y-m-d H:i",time())."', 0, 'A', 0,0,0,'1' )";
			conexion::trQry($l);
			
			$li= "insert into medicamentos_x_bodega (medicamento_id, fecha_inicial, cantidad_inicial, estado, inventario_ideal, inventario_maximo, inventario_critico, bodega) values ('".$id."', '".date("Y-m-d H:i",time())."', 0, 'A', 0,0,0,2)";
			conexion::trQry($li);
			
			$m= "insert into medicamento_x_proveedor (medicamento_id, id_proveedor, fecha_creacion) values ('".$id."', '".$proveedor_principal."', '".date("Y-m-d",time())."')";
			conexion::trQry($m);			
			
			$Hora = Time(); // Hora actual
			$hora_actual =  date('Y-m-d H:i',$Hora);		
			
			
			$lii = "update consecutivo_sin_barra set consecutivo_barra = consecutivo_barra + 1";
			
			conexion::trQry($lii);
			
			return 1;
		}
		
	}
	
?>
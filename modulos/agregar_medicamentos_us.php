<?php
	require_once('../clases/conexion.php');
	
	class medicamentos{
		
		public static function ffarma() {
			$ffarma = conexion::sqlGet("select codigo_forma, descripcion from formas_farmaceuticas order by descripcion");
			return $ffarma;
		}
		
		public static function posologia() {
			$posologia = conexion::sqlGet("select codigo_posologia, descripcion from tipos_posologias order by descripcion");
			return $posologia;
		}
		
		public static function present() {
			$present = conexion::sqlGet("select codigo_presentacion, descripcion from presentacion order by descripcion");
			return $present;
		}
		
		public static function gmedica() {
			$gmedica = conexion::sqlGet("select codigo_grupo, descripcion from grupo_de_medicamentos where tipo=1 order by descripcion");
			return $gmedica;
		}
		
		public static function contrai() {
			$contrai = conexion::sqlGet("select codigo_contraindicacion, descripcion from contraindicaciones");
			return $contrai;
		}
		
		public static function impuesto() {
			$impuesto = conexion::sqlGet("select tipo_impuesto, factor from impuesto");
			return $impuesto;
		}
		
		public static function provee() {
			$provee = conexion::sqlGet("select id_proveedor, nombre from proveedor");
			return $provee;
		}
		
		public static function codigoBarra() {
			$codigoBarra = conexion::sqlGet("select consecutivo_barra + 1 as consec from consecutivo_sin_barra");
			
			foreach($codigoBarra as $cb){
				$codigob = $cb->consec;
			}
			return $codigob;
		}
		
		public static function porcentaje_ganancia($grupo_medicamento) {
			$porcentaje_ganancia = conexion::sqlGet("select porcentaje_ganancia from sub_grupo where codigo_grupo = '".$grupo_medicamento."' and codigo_sub = '1'");
			
			foreach($porcentaje_ganancia as $pg){
				$porcentaje_g = $pg->porcentaje_ganancia;
			}
			return $porcentaje_g;
		}
		
		public static function procesaInfo($contraindica, $codigo_de_barra, $nombre_generico, $nombre_comercial, $forma_farmaceutica, $posologia, $tipo_posologia, $presentacion, $fabricante, $user, $cantidad_inicial, $antibiotico, $narcotico, $preparacion, $permite_devol, $otras_contra, $codigo_prov, $volumen, $tipo_volumen, $grupo_medicamento, $multiple_principio, $tipo_impuesto, $porcentaje_ganancia, $anaquel, $importacion, $jubilado, $descuento_total, $cant_max_prov, $codigo_de_barra, $proveedor_principal) {
			
			$resu = "insert into medicamentos (codigo_de_barra, nombre_generico, nombre_comercial, forma_farmaceutica, posologia, tipo_posologia, presentacion, fabricante, usuario_creacion,  cantidad_inicial, tipo_de_dosis, antibiotico, narcotico, preparacion, permite_devol, otras_contra, codigo_proveedor, volumen, tipo_volumen, grupo_medicamento, tipo_mercancia, multiple_principio, tipo_impuesto, porc_ganancia, ubicacion, importacion, jubilado, sub_grupo, estado_med, descuento_total, cant_max_prov) 
			values ('$codigo_de_barra', '$nombre_generico', '$nombre_comercial', '$forma_farmaceutica', '$posologia', '$tipo_posologia', '$presentacion', '$fabricante', '$user', '$cantidad_inicial', 'N', '$antibiotico', '$narcotico', '$preparacion', '$permite_devol', '$otras_contra', '$codigo_prov', '$volumen', '$tipo_volumen', '$grupo_medicamento', '1', '$multiple_principio', '$tipo_impuesto', '$porcentaje_ganancia', '$anaquel', '$importacion', '$jubilado', '1', 'A', '$descuento_total', '$cant_max_prov')";
			conexion::trQry($resu);
			
			$idm = conexion::sqlGet("select max(codigo_interno) as id from medicamentos");
			
			$id = $idm[0]->id;
			
			
			if (isset($contraindica)){
				foreach ($contraindica as $contra)
				{
					$resu2 = "insert into contra_medicamentos (codigo_de_barra, codigo_contraindicacion) values ('$codigo_de_barra', '$contra')";
					conexion::trQry($resu2);
					
				}}
				
				
				
				$Hora = Time(); // Hora actual
				$hora_actual =  date('Y-m-d H:i',$Hora); 
				
				
				$resu3 = "insert into medicamentos_x_bodega (bodega, medicamento_id, fecha_inicial, cantidad_inicial,estado)  
				values ('1','$id', '$hora_actual', '$cantidad_inicial', 'A')";
				conexion::trQry($resu3);
				
				$resu3i = "insert into medicamentos_x_bodega (bodega, medicamento_id, fecha_inicial, cantidad_inicial,estado)  
				values ('2','$id', '$hora_actual', 0, 'A')";
				conexion::trQry($resu3i);
				
				
				$resu4 = "insert into medicamento_x_proveedor (id_proveedor, medicamento_id, fecha_creacion)  
				values ('$proveedor_principal', '$id', '".date("Y-m-d",time())."')";
				conexion::trQry($resu4);
				
				return 1;
		}
		
	}
	
?>
<?php
	require_once('../clases/conexion.php');
	
	class emedica{
		
		public static function ffarma() {
			$ffarma = conexion::sqlGet("select codigo_forma, descripcion from formas_farmaceuticas");
			return $ffarma;
		}
		
		public static function posologia() {
			$posologia = conexion::sqlGet("select codigo_posologia, descripcion from tipos_posologias");
			return $posologia;
		}	
		
		public static function presenta() {
			$presenta = conexion::sqlGet("select codigo_presentacion, descripcion from presentacion");
			return $presenta;
		}
		
		public static function gmedica() {
			$gmedica = conexion::sqlGet("select codigo_grupo, descripcion from grupo_de_medicamentos where tipo=1 order by descripcion");
			return $gmedica;
		}
		
		public static function fabricante() {
			$fabricante = conexion::sqlGet("select codigo_fabricante, descripcion from fabricantes");
			return $fabricante;
		}
		
		public static function timpuesto() {
			$timpuesto = conexion::sqlGet("select tipo_impuesto, factor from impuesto");
			return $timpuesto;
		}
		
		public static function tdosis() {
			$tdosis = conexion::sqlGet("select codigo_tipo, descripcion from tipos_dosis");
			return $tdosis;
		}
		
		public static function cant_ini($medicamento_id) {
			$cant_ini = conexion::sqlGet("select (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial
			from medicamentos_x_bodega where medicamento_id = '".$medicamento_id."'
			and bodega = '2'");
			
			foreach($cant_ini as $ca){
				$canti = $ca->cantidad_inicial;
			}
			return $canti;
		}
		
		public static function medicam($codigoBarra) {
			$medicam = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia,
			medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion,
			cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial,
			tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre,
			preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto , precio_publico, importacion, jubilado, descuento_total, anaquel, cant_max_prov 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra = '".$codigoBarra."' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'");
			return $medicam;
		}
		
	}
	
?>
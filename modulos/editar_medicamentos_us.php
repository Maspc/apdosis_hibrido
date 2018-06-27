<?php
	require_once('../clases/conexion.php');
	
	class emedica{
		
		public static function select1($codigo_barras) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto, estado_med, importacion, precio_publico, jubilado, descuento_total, cant_max_prov,   ubicacion, precio_unitario_pub, prod_hosp, prod_pub
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra = '".$codigo_barras."' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos.tipo_mercancia = '1'
			and medicamentos_x_bodega.bodega = '1'");
			return $reg;
		}
		public static function select2($medicamento_id) {
			$reg = conexion::sqlGet("select 1 as existe from 
			principios_x_medicamento where medicamento_id = 
			'".$medicamento_id."'");
			return $reg;
		}
		public static function select3() {
			$reg = conexion::sqlGet("select codigo_forma, descripcion 
			from formas_farmaceuticas");
			return $reg;
		}
		public static function selectn() {
			$reg = conexion::sqlGet("select codigo_posologia, descripcion from tipos_posologias";);
			return $reg;
		}
		public static function select4() {
			$reg = conexion::sqlGet("select codigo_presentacion, descripcion
			from presentacion");
			return $reg;
		}
		public static function select5() {
			$reg = conexion::sqlGet("select codigo_grupo, descripcion from 
			grupo_de_medicamentos order by descripcion");
			return $reg;
		}
		public static function select6() {
			$reg = conexion::sqlGet("select codigo_posologia, descripcion from 
			tipos_posologias");
			return $reg;
		}
		public static function select7() {
			$reg = conexion::sqlGet("select codigo_fabricante, descripcion from fabricantes");
			return $reg;
		}
		public static function select8() {
			$reg = conexion::sqlGet("select codigo_tipo, descripcion from tipos_dosis");
			return $reg;
		}
		public static function select9() {
			$reg = conexion::sqlGet("select tipo_impuesto, factor from impuesto");
			return $reg;
		}
	}
	
?>
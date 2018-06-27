<?php
	require_once('../clases/conexion.php');
	
	class einsumos{	
		
		
		public static function select1($medicamento_id) {
			$reg = conexion::sqlGet("select (medicamentos_x_bodega
			.cantidad_inicial - medicamentos_x_bodega.cantidad_factura 
			+ medicamentos_x_bodega.cantidad_devolucion) as 
			cantidad_inicial from medicamentos_x_bodega where
			medicamento_id = '".$medicamento_id."'
			and bodega = '2'");
						
			return $reg;
		}
		
		public static function select2($codigoBarra) {
			$medicam = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio,tipo_impuesto, codigo_enlace ,precio_publico,sub_grupo, jubilado, descuento_total, cant_max_prov,precio_unitario_pub, prod_hosp, prod_pub
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra = '".$codigo_barras."' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'
			and tipo_mercancia = 2");
			return $medicam;
		}
		
		public static function select3($codigo_enlace) {
			$nmedica = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, tipo_impuesto 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias
			WHERE medicamentos.codigo_interno = ".$codigo_enlace." 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma");
			
		}
		
		public static function select4($codigo_enlace) {
			$gmedica = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, tipo_impuesto 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias
			WHERE medicamentos.codigo_interno = ".$codigo_enlace." 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma");
			return $gmedica;
		}
		
		public static function select5($grupo_medicamento) {
			$sgrupom = conexion::sqlGet("select codigo_grupo, descripcion from grupo_de_medicamentos where codigo_grupo = '".$grupo_medicamento."' order by descripcion");
			return $sgrupom;
		}
		
		public static function select6($grupo_medicamento,$sub_grupo) {
			$timpuesto = conexion::sqlGet("select codigo_sub, descripcion from sub_grupo where codigo_grupo = '".$grupo_medicamento."' and codigo_sub='".$sub_grupo."' order by descripcion");
			return $timpuesto;
		}
		public static function select7() {
			$timpuesto = conexion::sqlGet("select tipo_impuesto, factor from impuesto");
			return $timpuesto;
		}
	}
	
?>
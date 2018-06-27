<?php
	
	require_once('../clases/conexion.php');
	
	class getgen{		
		
		public static function get_medica1($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'
			union
			select '%' as codigo_interno, 'TODOS' as nombre");			
			return $reg;
		}
		
		public static function get_cliente1($q) {
			$reg = conexion::sqlGet("select id_cliente, nombre, apellido, concat(nombre, ' ',apellido) as nombre_completo, identificacion, limite_credito, tipo_cliente, telefono, saldo_actual, descuento_maximo from clientes, tipo_clientes where concat(nombre, ' ',apellido) like '%".$q."%' and tipo_cliente = codigo_tipo");			
			return $reg;
		}
		
		public static function get_cliente2($q) {
			$reg = conexion::sqlGet("select id_cliente, nombre, apellido, identificacion, telefono, limite_credito, tipo_cliente, saldo_actual, concat(nombre,' ',apellido) as nombre_completo, descuento_maximo from clientes, tipo_clientes where id_cliente like '%".$q."%' and tipo_cliente = codigo_tipo");			
			return $reg;
		}	
		
		public static function get_barras1($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, tipo_impuesto, medicamentos.codigo_de_barra, medicamentos.cant_max_prov 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias
			WHERE medicamentos.codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma");			
			return $reg;
		}
		
		public static function get_medicam1($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, tipo_impuesto, medicamentos.codigo_de_barra, medicamentos.cant_max_prov 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion,  ' - ', codigo_proveedor) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma");			
			return $reg;
		}
		
		public static function get_medica_est($q) {
			$reg = conexion::sqlGet("SELECT medicamentos.codigo_interno, medicamentos.codigo_de_barra, medicamentos_x_bodega.inventario_minimo, medicamentos_x_bodega.inventario_ideal, medicamentos_x_bodega.inventario_maximo, medicamentos_x_bodega.inventario_critico, medicamentos_x_bodega.cantidad_inicial, medicamentos_x_bodega.cantidad_factura, medicamentos_x_bodega.cantidad_devolucion, medicamentos.costo_unitario, medicamentos.precio_unitario, medicamentos.porc_ganancia, CONCAT( medicamentos.nombre_comercial, ' ', '(', medicamentos.nombre_generico, ')', ' ', medicamentos.posologia, ' ', tipos_posologias.descripcion, ' - ', formas_farmaceuticas.descripcion ) AS nombre, estado_med
			FROM medicamentos, medicamentos_x_bodega, formas_farmaceuticas, tipos_posologias
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%".$q."%' 
			AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			AND medicamentos_x_bodega.bodega =1
			AND formas_farmaceuticas.codigo_forma = medicamentos.forma_farmaceutica
			AND tipos_posologias.codigo_posologia = medicamentos.tipo_posologia");			
			return $reg;
		}
		
		public static function get_barras_est($q) {
			$reg = conexion::sqlGet("SELECT medicamentos.codigo_interno, medicamentos.codigo_de_barra, medicamentos_x_bodega.inventario_minimo, medicamentos_x_bodega.inventario_ideal, medicamentos_x_bodega.inventario_maximo, medicamentos_x_bodega.inventario_critico, medicamentos_x_bodega.cantidad_inicial, medicamentos_x_bodega.cantidad_factura, medicamentos_x_bodega.cantidad_devolucion, medicamentos.costo_unitario, medicamentos.precio_unitario, medicamentos.porc_ganancia, CONCAT( medicamentos.nombre_comercial, ' ', '(', medicamentos.nombre_generico, ')', ' ', medicamentos.posologia, ' ', tipos_posologias.descripcion, ' - ', formas_farmaceuticas.descripcion ) AS nombre, estado_med
			FROM medicamentos, medicamentos_x_bodega, formas_farmaceuticas, tipos_posologias
			WHERE medicamentos.codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			AND medicamentos_x_bodega.bodega =1
			AND formas_farmaceuticas.codigo_forma = medicamentos.forma_farmaceutica
			AND tipos_posologias.codigo_posologia = medicamentos.tipo_posologia");			
			return $reg;
		}
		
		public static function get_rubros($q) {
			$reg = conexion::sqlGet("select codigo_rubro,descripcion 
			FROM rubros
			WHERE descripcion LIKE '%".$q."%'");			
			return $reg;
		}
		
		public static function get_provee($q) {
			$reg = conexion::sqlGet("select id_proveedor, nombre_proveedor as nombre from proveedores_caja where nombre_proveedor LIKE '%".$q."%'");			
			return $reg;
		}
		
		public static function get_fabrica1($q) {
			$reg = conexion::sqlGet("select codigo_fabricante, descripcion from fabricantes where descripcion LIKE '%".$q."%'");			
			return $reg;
		}
		
		public static function get_insumos1($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto, codigo_enlace, sub_grupo, precio_publico, jubilado, descuento_total , cant_max_prov 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'
			and medicamentos.tipo_mercancia = 2");			
			return $reg;
		}
		
		public static function get_barra_insumos1($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto,codigo_enlace, sub_grupo, precio_publico, jubilado, descuento_total, cant_max_prov 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'
			and medicamentos.tipo_mercancia = 2");			
			return $reg;
		}
		
		public static function get_medica_e1($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto,  precio_publico, importacion, jubilado  
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'");			
			return $reg;
		}
		
		public static function get_barramedica_e1($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto , precio_publico, jubilado, importacion
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'");			
			return $reg;
		}
		
		public static function get_provee2($q) {
			$reg = conexion::sqlGet("select id_proveedor, nombre from proveedor where nombre LIKE '%".$q."%'");			
			return $reg;
		}
		
		public static function get_medicab1($bodega_origen,$q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, tipo_impuesto, medicamentos.codigo_de_barra, 0 as cant_max_prov 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion,  ' - ', codigo_proveedor) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '".$bodega_origen."'
			and (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) > 0");			
			return $reg;
		}
		
		public static function get_medicab1_slt1($mid,$bodega_origen) {
			$reg = conexion::sqlGet("select (cantidad_inicial - cantidad_factura + cantidad_devolucion) as cantidad from medicamentos_x_bodega where medicamento_id = '".$mid."' and bodega = '".$bodega_origen."'");			
			return $reg;
		}
		
		public static function get_medicab1_slt2($mid,$bodega_destino) {
			$reg = conexion::sqlGet("select (cantidad_inicial - cantidad_factura + cantidad_devolucion) as cantidad, inventario_ideal from medicamentos_x_bodega where medicamento_id = '".$mid."' and bodega = '".$bodega_destino."'");			
			return $reg;
		}
		
		public static function get_barrab1($bodega_origen,$q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, tipo_impuesto, medicamentos.codigo_de_barra, 0 as cant_max_prov 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '".$bodega_origen."'
			and (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) > 0");			
			return $reg;
		}
		
		public static function get_asegura1($q) {
			$reg = conexion::sqlGet("select codigo_aseg, descripcion, (descuento_maximo * 100) as descuento_maximo from aseguradoras where descripcion like '%".$q."%'");			
			return $reg;
		}
		
		public static function get_articulo1($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, tipo_impuesto, medicamentos.precio_unitario, medicamentos.codigo_de_barra, grupo_de_medicamentos.descuento_maximo, jubilado, medicamentos.grupo_medicamento, medicamentos.descuento_total  
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, grupo_de_medicamentos, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion,  ' - ', codigo_proveedor) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			and medicamentos.estado_med = 'A'
			AND medicamentos_x_bodega.bodega = '2'
			and (medicamentos_x_bodega.cantidad_inicial + medicamentos_x_bodega.cantidad_devolucion - medicamentos_x_bodega.cantidad_factura) > medicamentos_x_bodega.inventario_critico
			AND medicamentos.precio_unitario > 0
			and medicamentos.grupo_medicamento = grupo_de_medicamentos.codigo_grupo");			
			return $reg;
		}
		
		public static function get_barticulo1($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, tipo_impuesto, medicamentos.precio_unitario, medicamentos.codigo_de_barra, grupo_de_medicamentos.descuento_maximo, jubilado, medicamentos.grupo_medicamento, medicamentos.descuento_total  
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, grupo_de_medicamentos, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and medicamentos.grupo_medicamento = grupo_de_medicamentos.codigo_grupo
			AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			and medicamentos.estado_med = 'A'
			AND medicamentos_x_bodega.bodega = '2'
			and (medicamentos_x_bodega.cantidad_inicial + medicamentos_x_bodega.cantidad_devolucion - medicamentos_x_bodega.cantidad_factura) > medicamentos_x_bodega.inventario_critico
			AND medicamentos.precio_unitario > 0");			
			return $reg;
		}
		
		public static function get_artgrupo1($grupo) {
			$reg = conexion::sqlGet("select a.porcentaje from grupos_por_dia_desc a  where  a.codigo_grupo = '".$grupo."' and a.dia_id ='". date("N",time())."'");			
			return $reg;
		}
		
		public static function get_personas1($q) {
			$reg = conexion::sqlGet("select id_cliente, nombre, apellido, identificacion, telefono, saldo_actual, concat(nombre,' ',apellido) as nombre_completo, descuento_maximo, limite_credito, tipo_cliente from clientes, tipo_clientes where id_cliente like '%".$q."%' and tipo_cliente = codigo_tipo");			
			return $reg;
		}
		
		public static function get_personasn1($q) {
			$reg = conexion::sqlGet("select id_cliente, nombre, apellido, concat(nombre, ' ',apellido) as nombre_completo, identificacion, telefono, saldo_actual, descuento_maximo, tipo_cliente, limite_credito from clientes, tipo_clientes where concat(nombre, ' ',apellido) like '%".$q."%' and tipo_cliente = codigo_tipo");			
			return $reg;
		}
		
		public static function get_medica2($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' ', formas_farmaceuticas.descripcion, ' ', volumen, ' ',f.descripcion ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion as forma_descri, medicamentos.posologia,  codigo_de_barra, tipos_posologias.tipo_grupo as tipo_grupo, medicamentos.multiple_principio, medicamentos.grupo_medicamento, medicamentos.volumen, medicamentos.tipo_volumen,f.descripcion as vol_desc, tipos_posologias.descripcion as dosis_desc, medicamentos.precio_unitario 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, medicamentos_x_bodega, tipos_posologias f
			WHERE LOWER(CONCAT( medicamentos.nombre_comercial,  ' ',  medicamentos.nombre_generico )) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			AND medicamentos_x_bodega.bodega = '1'
			and medicamentos.tipo_volumen = f.codigo_posologia
			and medicamentos.tipo_mercancia = 1");			
			return $reg;
		}
		
		public static function get_medicae2($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto,  precio_publico, importacion, jubilado, descuento_total, ubicacion  
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'");			
			return $reg;
		}
		
		public static function get_barrase2($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto , precio_publico, jubilado, importacion, descuento_total, ubicacion
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'");			
			return $reg;
		}
		
		public static function get_medica3($q) {
			$reg = conexion::sqlGet("SELECT medicamentos.codigo_interno, medicamentos.codigo_de_barra, medicamentos_x_bodega.inventario_minimo, medicamentos_x_bodega.inventario_ideal, medicamentos_x_bodega.inventario_maximo, medicamentos_x_bodega.inventario_critico, medicamentos_x_bodega.cantidad_inicial, medicamentos_x_bodega.cantidad_factura, medicamentos_x_bodega.cantidad_devolucion, medicamentos.costo_unitario, medicamentos.precio_unitario, medicamentos.porc_ganancia, CONCAT( medicamentos.nombre_comercial, ' ', '(', medicamentos.nombre_generico, ')', ' ', medicamentos.posologia, ' ', tipos_posologias.descripcion, ' - ', formas_farmaceuticas.descripcion ) AS nombre, precio_publico, porc_vario
			FROM medicamentos, medicamentos_x_bodega, formas_farmaceuticas, tipos_posologias
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%".$q."%' 
			AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			AND medicamentos_x_bodega.bodega =1
			AND formas_farmaceuticas.codigo_forma = medicamentos.forma_farmaceutica
			AND tipos_posologias.codigo_posologia = medicamentos.tipo_posologia");			
			return $reg;
		}
		
		public static function get_barras3($q) {
			$reg = conexion::sqlGet("SELECT medicamentos.codigo_interno, medicamentos.codigo_de_barra, medicamentos_x_bodega.inventario_minimo, medicamentos_x_bodega.inventario_ideal, medicamentos_x_bodega.inventario_maximo, medicamentos_x_bodega.inventario_critico, medicamentos_x_bodega.cantidad_inicial, medicamentos_x_bodega.cantidad_factura, medicamentos_x_bodega.cantidad_devolucion, medicamentos.costo_unitario, medicamentos.precio_unitario, medicamentos.porc_ganancia, CONCAT( medicamentos.nombre_comercial, ' ', '(', medicamentos.nombre_generico, ')', ' ', medicamentos.posologia, ' ', tipos_posologias.descripcion, ' - ', formas_farmaceuticas.descripcion ) AS nombre, precio_publico, porc_vario
			FROM medicamentos, medicamentos_x_bodega, formas_farmaceuticas, tipos_posologias
			WHERE codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			AND medicamentos_x_bodega.bodega =1
			AND formas_farmaceuticas.codigo_forma = medicamentos.forma_farmaceutica
			AND tipos_posologias.codigo_posologia = medicamentos.tipo_posologia");			
			return $reg;
		}
		
		public static function get_medica_ven($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, costo_unitario , medicamentos.tipo_impuesto
			FROM medicamentos, formas_farmaceuticas, tipos_posologias
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion,  ' - ', codigo_proveedor) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma");			
			return $reg;
		}
		
		public static function get_medicamento_edit_us_1($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto,  precio_publico, importacion, jubilado, descuento_total  
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'");			
			return $reg;
		}
		
		public static function get_barras_com1($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, tipo_impuesto, codigo_de_barra , (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion )  as cantidad, costo_unitario
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, medicamentos_x_bodega
			WHERE codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			and medicamentos_x_bodega.bodega = '1'");			
			return $reg;
		}
		
		public static function get_barras_edit_inv($q) {
			$reg = conexion::sqlGet("SELECT medicamentos.codigo_interno, medicamentos.codigo_de_barra, medicamentos_x_bodega.inventario_minimo, medicamentos_x_bodega.inventario_ideal, medicamentos_x_bodega.inventario_maximo, medicamentos_x_bodega.inventario_critico, medicamentos_x_bodega.cantidad_inicial, medicamentos_x_bodega.cantidad_factura, medicamentos_x_bodega.cantidad_devolucion, medicamentos.costo_unitario, medicamentos.precio_unitario, medicamentos.porc_ganancia, 
			CONCAT( medicamentos.nombre_comercial, ' ', '(', medicamentos.nombre_generico, ')', ' ', medicamentos.posologia, ' ', tipos_posologias.descripcion, ' - ', formas_farmaceuticas.descripcion ) AS nombre,
			(medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_existencia, precio_unitario_pub
			FROM medicamentos, medicamentos_x_bodega, formas_farmaceuticas, tipos_posologias
			WHERE codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			AND medicamentos_x_bodega.bodega =1
			AND formas_farmaceuticas.codigo_forma = medicamentos.forma_farmaceutica
			AND tipos_posologias.codigo_posologia = medicamentos.tipo_posologia");			
			return $reg;
		}
		
		public static function get_barras_edit_us($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto, estado_med, importacion, precio_publico, jubilado, descuento_total, cant_max_prov,   ubicacion, precio_unitario_pub, prod_hosp, prod_pub  
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'
			and medicamentos.tipo_mercancia = 1");			
			return $reg;
		}
		
		public static function get_barras_edit_us_con($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto , precio_unitario_pub, tipo_mercancia
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'");			
			return $reg;
		}
		
		public static function get_barras_ins_edit_us($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto,codigo_enlace, sub_grupo, precio_publico, jubilado, descuento_total, cant_max_prov,precio_unitario_pub, prod_hosp, prod_pub 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'
			and medicamentos.tipo_mercancia = 2");			
			return $reg;
		}
		
		public static function get_insumo_edit_us($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto, codigo_enlace, sub_grupo, precio_publico, jubilado, descuento_total , cant_max_prov,precio_unitario_pub, prod_hosp, prod_pub  
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'
			and medicamentos.tipo_mercancia = 2");			
			return $reg;
		}
		
		public static function get_medicamento_1($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' ', formas_farmaceuticas.descripcion, ' ', volumen, ' ',f.descripcion ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion as forma_descri, medicamentos.posologia,  codigo_de_barra, tipos_posologias.tipo_grupo as tipo_grupo, medicamentos.multiple_principio, medicamentos.grupo_medicamento, medicamentos.volumen, medicamentos.tipo_volumen,f.descripcion as vol_desc, tipos_posologias.descripcion as dosis_desc, (medicamentos_x_bodega.cantidad_inicial + medicamentos_x_bodega.cantidad_devolucion - medicamentos_x_bodega.cantidad_factura) as existencia 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, medicamentos_x_bodega, tipos_posologias f
			WHERE LOWER(CONCAT( medicamentos.nombre_comercial,  ' ',  medicamentos.nombre_generico )) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			AND medicamentos_x_bodega.bodega = '1'
			and medicamentos.tipo_volumen = f.codigo_posologia
			and (medicamentos_x_bodega.cantidad_inicial + medicamentos_x_bodega.cantidad_devolucion - medicamentos_x_bodega.cantidad_factura) > medicamentos_x_bodega.inventario_critico
			AND medicamentos.precio_unitario > 0
			and medicamentos.estado_med = 'A'
			and medicamentos.prod_hosp = 'S'");			
			return $reg;
		}
		
		public static function get_medicamento_edit_inv($q) {
			$reg = conexion::sqlGet("SELECT medicamentos.codigo_interno, medicamentos.codigo_de_barra, medicamentos_x_bodega.inventario_minimo, medicamentos_x_bodega.inventario_ideal, medicamentos_x_bodega.inventario_maximo, medicamentos_x_bodega.inventario_critico, medicamentos_x_bodega.cantidad_inicial, medicamentos_x_bodega.cantidad_factura, medicamentos_x_bodega.cantidad_devolucion, medicamentos.costo_unitario, medicamentos.precio_unitario, medicamentos.porc_ganancia, 
			CONCAT( medicamentos.nombre_comercial, ' ', '(', medicamentos.nombre_generico, ')', ' ', medicamentos.posologia, ' ', tipos_posologias.descripcion, ' - ', formas_farmaceuticas.descripcion ) AS nombre,
			(medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_existencia, precio_unitario_pub
			FROM medicamentos, medicamentos_x_bodega, formas_farmaceuticas, tipos_posologias
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%".$q."%' 
			AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			AND medicamentos_x_bodega.bodega =1
			AND formas_farmaceuticas.codigo_forma = medicamentos.forma_farmaceutica
			AND tipos_posologias.codigo_posologia = medicamentos.tipo_posologia");			
			return $reg;
		}
		
		public static function get_medicamento_edit_us($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto, estado_med, importacion, precio_publico, jubilado, descuento_total, cant_max_prov,   ubicacion, precio_unitario_pub, prod_hosp, prod_pub 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'
			and medicamentos.tipo_mercancia = 1");			
			return $reg;
		}
		
		public static function get_medicamento_edit_us_con($q) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto,  precio_unitario_pub, importacion, tipo_mercancia
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'");			
			return $reg;
		}
		
		public static function get_medicamento_union($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'
			union
			select '%' as codigo_interno, 'TODOS' as nombre");			
			return $reg;
		}
		
		public static function get_medicamento_ven($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, costo_unitario, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion )  as cantidad, codigo_de_barra, tipo_impuesto
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion,  ' - ', codigo_proveedor) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			and medicamentos_x_bodega.bodega = '1'");			
			return $reg;
		}
		
		public static function get_articulo($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, tipo_impuesto, medicamentos.precio_unitario, medicamentos.codigo_de_barra, grupo_de_medicamentos.descuento_maximo, jubilado, medicamentos.grupo_medicamento, medicamentos.descuento_total, medicamentos.precio_unitario_pub  
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, grupo_de_medicamentos, medicamentos_x_bodega
			WHERE CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion,  ' - ', codigo_proveedor) LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			and medicamentos.estado_med = 'A'
			AND medicamentos_x_bodega.bodega = '1'
			and (medicamentos_x_bodega.cantidad_inicial + medicamentos_x_bodega.cantidad_devolucion - medicamentos_x_bodega.cantidad_factura) > medicamentos_x_bodega.inventario_critico
			AND medicamentos.precio_unitario_pub > 0
			and medicamentos.grupo_medicamento = grupo_de_medicamentos.codigo_grupo
			and medicamentos.prod_pub = 'S'");			
			return $reg;
		}
		
		public static function get_articulo_select1($grupo) {
			$reg = conexion::sqlGet("select a.porcentaje from grupos_por_dia_desc a  where  a.codigo_grupo = '".$grupo."' and a.dia_id ='". date("N",time())."'");			
			return $reg;
		}
		
		public static function get_articulo_barra($q) {
			$reg = conexion::sqlGet("select codigo_interno, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion, ' - ', codigo_proveedor ) as nombre, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  tipos_posologias.tipo_grupo as tipo_de_grupo, tipo_impuesto, medicamentos.precio_unitario, medicamentos.codigo_de_barra, grupo_de_medicamentos.descuento_maximo, jubilado, medicamentos.grupo_medicamento, medicamentos.descuento_total, medicamentos.precio_unitario_pub  
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, grupo_de_medicamentos, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra LIKE '%".$q."%' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and medicamentos.grupo_medicamento = grupo_de_medicamentos.codigo_grupo
			AND medicamentos.codigo_interno = medicamentos_x_bodega.medicamento_id
			and medicamentos.estado_med = 'A'
			AND medicamentos_x_bodega.bodega = '1'
			and (medicamentos_x_bodega.cantidad_inicial + medicamentos_x_bodega.cantidad_devolucion - medicamentos_x_bodega.cantidad_factura) > medicamentos_x_bodega.inventario_critico
			AND medicamentos.precio_unitario_pub > 0
			and medicamentos.prod_pub = 'S'");			
			return $reg;
		}
		
		public static function get_articulo_barra_select1($grupo) {
			$reg = conexion::sqlGet("select a.porcentaje from grupos_por_dia_desc a  where  a.codigo_grupo = '".$grupo."' and a.dia_id ='". date("N",time())."'");			
			return $reg;
		}
		
	}
	
?>		
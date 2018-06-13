<?php
	require_once('../clases/conexion.php');
	
	class cproducto{		
		
		public static function select1($medicamento_id) {
			$reg = conexion::sqlGet("select (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial
			from medicamentos_x_bodega where medicamento_id = '".$medicamento_id."'
			and bodega = '2'");			
			return $reg;
		}
		
		public static function select2($codigo_barra) {
			$reg = conexion::sqlGet("select codigo_interno, nombre_comercial, nombre_generico, medicamentos.forma_farmaceutica as forma_farma, medicamentos.tipo_posologia as tipo_posologia, medicamentos.tipo_de_dosis, formas_farmaceuticas.descripcion forma_descri, medicamentos.posologia,  codigo_de_barra, presentacion.descripcion as descr_presentacion, presentacion, cantidad_x_empaque, volumen, fabricantes.descripcion as descr_fabricante, fabricante, costo_unitario, precio_unitario, costo_caja, precio_caja, (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial, tipos_dosis.descripcion as descr_tipo_dosis, tipo_de_dosis, antibiotico, narcotico, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, preparacion, permite_devol, codigo_proveedor, tipo_volumen, grupo_medicamento, multiple_principio, tipo_impuesto , precio_publico, importacion, jubilado, descuento_total, ubicacion 
			FROM medicamentos, formas_farmaceuticas, tipos_posologias, presentacion, tipos_dosis, fabricantes, medicamentos_x_bodega
			WHERE medicamentos.codigo_de_barra = '".$codigo_barra."' 
			AND medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and presentacion.codigo_presentacion = medicamentos.presentacion
			and fabricantes.codigo_fabricante = medicamentos.fabricante
			and tipos_dosis.codigo_tipo = medicamentos.tipo_de_dosis
			and medicamentos_x_bodega.medicamento_id = medicamentos.codigo_interno
			and medicamentos_x_bodega.bodega = '1'");			
			return $reg;
		}
		
		public static function select3($medicamento_id) {
			$reg = conexion::sqlGet("select (medicamentos_x_bodega.cantidad_inicial - medicamentos_x_bodega.cantidad_factura + medicamentos_x_bodega.cantidad_devolucion) as cantidad_inicial
			from medicamentos_x_bodega where medicamento_id = '".$medicamento_id."'
			and bodega = '2'");			
			return $reg;
		}
		
		public static function insert1($historia,$numero_cama,$userid,$tratamiento,$nombre_paciente,$compania_de_seguro,$edad,$identificacion,$peso) {
			$sql = "insert into tratamiento_tmp (historia,habitacion,fecha_inicio, estado,usuario_creacion,fecha_creacion, tratamiento, nombre_paciente, compania_de_seguro, edad, id_paciente, peso) 
			values ('".$historia."', '".$numero_cama."', '".  date('Y-m-d H:i',time())."', 'A', '".$userid."', '". date('Y-m-d H:i',time()) ."', '".$tratamiento."', '".$nombre_paciente."', '".$compania_de_seguro."', '".$edad."', '".$identificacion."', '".$peso."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert2($stat,$medico,$numero_cama,$userid,$historia,$registro,$tratamiento,$nombre_paciente,$compania_de_seguro,$tipo_paciente,$identificacion,$contraindicaciones,$peso,$edad) {
			$sql = "insert into registro_tmp (stat, estado, medico, no_cama, usuario_creacion, historia, fecha_creacion, id_tmp, tratamiento, nombre_paciente, compania_de_seguro, tipo_paciente, id_paciente, contraindicaciones, peso, edad)
			values ( '".$stat."', 'E', '".$medico."', '".$numero_cama."','".$userid."', '".$historia."','". date('Y-m-d H:i',time())."', '".$registro."', '".$tratamiento."', '".$nombre_paciente."', '".$compania_de_seguro."', '".$tipo_paciente."', '".$identificacion."', '".$contraindicaciones."', '".$peso."', '".$edad."')";
			conexion::trQry($sql);
			return 1;
		}
		
		
	}
	
?>	
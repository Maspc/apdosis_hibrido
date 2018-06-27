<?php
	require_once('../clases/conexion.php');
	
	class finalizar{
		
		public static function select1($factura) {
			$reg = conexion::sqlGet("select estado_factura, procesado_por from factura where factura = '".$factura."'");
			return $reg;
		}
		public static function select2($factura) {
			$reg = conexion::sqlGet("select bodega from factura where factura = '".$factura."'");
			return $reg;
		}
		public static function select3($factura) {
			$reg = conexion::sqlGet("SELECT factura_detalle.medicamento, 
			factura_detalle.forma_farma, formas_farmaceuticas.descripcion, 
			factura_detalle.dosis, factura_detalle.horas, factura_detalle.dias,
			factura_detalle.linea, factura_detalle.cargo, factura_detalle.cantidad,
            medicamentos.precio_unitario, grupo_de_medicamentos.costo_adicional, 
            grupo_de_medicamentos.insumo_prep, factura_detalle.medicamento_id, 
            factura_detalle.hora_evento_carro, factura_detalle.intervalo_dosis, 
            factura_detalle.codigo_carro, factura_detalle.codigo_carro,
            medicamentos.codigo_de_barra, factura_detalle.factura,
            factura_detalle.tratamiento, factura_detalle.historia, 
            factura_detalle.cargo, factura_detalle.precio_venta,
            registro_detalle.cantidad_de_dosis as cant_total, 
            factura_detalle.observacion, medicamentos.tipo_de_dosis,
            medicamentos.grupo_medicamento, factura_detalle.preparacion,
            factura_detalle.average, impuesto.factor,
            grupo_de_medicamentos.costo_adicional_2,
            factura_detalle.average, grupo_de_medicamentos.medicamento_insumo, 
            grupo_de_medicamentos.medicamento_insumo_2, 
            grupo_de_medicamentos.no_paga, medicamentos.costo_unitario
            FROM factura_detalle, formas_farmaceuticas, 
            medicamentos, registro_detalle, grupo_de_medicamentos, impuesto 
            where factura = '".$factura."'
            and factura_detalle.forma_farma = formas_farmaceuticas.codigo_forma
            and factura_detalle.medicamento_id = medicamentos.codigo_interno
            and registro_detalle.cargo = factura_detalle.cargo
           and registro_detalle.historia = factura_detalle.historia
           and registro_detalle.tratamiento = factura_detalle.tratamiento
            and registro_detalle.linea = factura_detalle.linea
            and medicamentos.grupo_medicamento = grupo_de_medicamentos.codigo_grupo
             and medicamentos.tipo_impuesto = impuesto.tipo_impuesto
            and estado_producto = 'E' 
            order by factura_detalle.linea");
			return $reg;
		}
		public static function select4($factura) {
			$reg = conexion::sqlGet("select max(linea) + 1 as linea_siguiente from factura_detalle where factura = '".$factura."'");
			return $reg;
		}
		public static function select5($medicamento_insumo) {
			$reg = conexion::sqlGet("select codigo_interno,nombre_generico as medicamento from medicamentos where codigo_interno = '".$medicamento_insumo."'");
			return $reg;
		}
		public static function insert1($medicamento_ins,$medicamento_id_ins,$linea_siguiente,$costo_adicional,$cantidad_insumo,$costo_adicional_c, $factura,$medicamento_id,$historia,$tratamiento,$cargo,$linea2) {
			$sql = "insert into factura_detalle 
			(medicamento, medicamento_id,linea, 
			precio_unitario, cantidad,  precio_venta,
			estado_producto,factura,forma_farma, med_insumo,
			historia, tratamiento, cargo, linea_adic)
            values ('".$medicamento_ins."', '".$medicamento_id_ins."',
			'".$linea_siguiente."', '".$costo_adicional."',
			'".$cantidad_insumo."',
			'".$costo_adicional_c."','P', '".$factura."','192', 
			'".$medicamento_id."', '".$historia."', 
			'".$tratamiento."', '".$cargo."',
			'".$linea2."'";
			return 1;
		}
		public static function update1($cantidad,$precio_unitario,$precio_venta,$impuesto_u,$linea2,$costo_unitario,$factura,$medicamento_id) {
			$sql ="update factura_detalle set cantidad =
			'".$cantidad."', precio_unitario = 
			'".$precio_unitario."', precio_venta = 
			'".$precio_venta."', estado_producto = 'P',  impuesto = 
			'".$impuesto_u."', linea_adic = 
			'".$linea2."', costo_unitario = 
			'".$costo_unitario."' where factura=
			'".$factura."' and medicamento_id = 
			'".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function update2($medicamento_id,$historia,$tratamiento,$despacho) {
			$sql ="update registro_detalle set estado = 'P'
			where medicamento_id = 
			'".$medicamento_id."' and historia = 
			'".$historia."' and tratamiento = 
			'".$tratamiento."' and cargo = 
			'".$despacho."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function update3($cantidad,$medicamento_id,$bodega) {
			$sql = "update medicamentos_x_bodega set cantidad_factura
			= cantidad_factura + 
			'".$cantidad."' where medicamento_id =
			'".$medicamento_id."' and bodega=
			'".$bodega."' ";
			conexion::trQry($sql);
			return 1;
		}
		public static function update4($cantidad,$medicamento_id,$bodega) {
			$sql = "update medicamentos_x_bodega set cantidad_factura =
			cantidad_factura +
			'".ceil($cantidad)."' where medicamento_id = 
			'".$medicamento_id."'
			and bodega='".$bodega."' ";
			conexion::trQry($sql);
			return 1;
		}
		public static function select6($factura,$medicamento_id) {
			$reg = conexion::sqlGet("select lote, medicamento_id, 
			cantidad from lotes_x_factura where factura = '".$factura."' 
			and medicamento_id = '".$medicamento_id."'");
			return $reg;
		}
		public static function update5($cantidad,$medicamento_id,$lote) {
			$sql = "update medicamentos_x_lote set cantidad = 
			cantidad - '".$cantidad."' where medicamento_id =
			'".$medicamento_id."' and lote =
			'".$lote."' ";
			conexion::trQry($sql);
			return 1;
		}
		public static function select7($medicamento_id,$bodega) {
			$reg = conexion::sqlGet("select (cantidad_inicial - 
			cantidad_factura + cantidad_devolucion) cant from 
			medicamentos_x_bodega where medicamento_id =
			'".$medicamento_id."' and bodega = 
			'".$bodega."'  ");
			return $reg;
		}
		public static function update6($historia,$tratamiento,$despacho) {
			$sql =  "update registro set estado = 'P' where historia =
			'" .$historia . "' and tratamiento = 
			'".$tratamiento."' and cargo = 
			'".$despacho."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function select8($factura) {
			$reg = conexion::sqlGet("select sum(precio_venta) as total
			from factura_detalle where factura = '".$factura."' and 
			estado_producto != 'X'");
			return $reg;
		}
		public static function update7($hora_actual,$total_suma,$MM_iduser,$factura) {
			$sql ="update factura set fecha =
			'".$hora_actual."',estado_factura = 'P', total = 
			'".$total_suma."',procesado_por=
			'".$MM_iduser."', fecha_proceso='".date('Y-m-d H:i',time())."' where factura =
			'".$factura."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function delete1($factura) {
			
			conexion::trQry("delete from temp_pend where factura = '".$factura."'");
			return 1;
		}
		public static function select9($factura) {
			$reg = conexion::sqlGet("SELECT factura_detalle.medicamento, factura_detalle.forma_farma, formas_farmaceuticas.descripcion, factura_detalle.dosis, factura_detalle.horas, factura_detalle.dias, factura_detalle.linea, factura_detalle.cargo, factura_detalle.cantidad,
            medicamentos.precio_unitario, grupo_de_medicamentos.costo_adicional, grupo_de_medicamentos.insumo_prep, factura_detalle.medicamento_id, factura_detalle.hora_evento_carro, factura_detalle.intervalo_dosis, factura_detalle.codigo_carro, factura_detalle.codigo_carro, medicamentos.codigo_de_barra, factura_detalle.factura, factura_detalle.tratamiento, factura_detalle.historia, factura_detalle.cargo, factura_detalle.precio_venta, registro_detalle.cantidad_de_dosis as cant_total, factura_detalle.observacion, medicamentos.tipo_de_dosis, factura_detalle.preparacion, medicamentos.grupo_medicamento, impuesto.factor
            FROM factura_detalle, formas_farmaceuticas, medicamentos, registro_detalle, grupo_de_medicamentos, impuesto 
            where factura = '".$factura."'
            and factura_detalle.forma_farma = formas_farmaceuticas.codigo_forma
            and factura_detalle.medicamento_id = medicamentos.codigo_interno
            and registro_detalle.cargo = factura_detalle.cargo
            and registro_detalle.historia = factura_detalle.historia
            and registro_detalle.tratamiento = factura_detalle.tratamiento
            and registro_detalle.linea = factura_detalle.linea
            and medicamentos.grupo_medicamento = grupo_de_medicamentos.codigo_grupo
            and medicamentos.tipo_impuesto = impuesto.tipo_impuesto
            and estado_producto = 'X' 
            order by factura_detalle.linea");
			return $reg;
		}
		}
		>?
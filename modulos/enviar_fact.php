<?php
	require_once('../clases/conexion.php');
	
	class enviar_fac{
		
		public static function update1($MM_iduser,$hora_actual,$factura) {
			$sql ="update factura set usuario_apertura = 
			'".$MM_iduser."' and fecha_apertura =
			'".$hora_actual."'  where factura  =
			'".$factura."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function select1($factura) {
			$reg = conexion::sqlGet("select historia, usuario_creacion, 
			cargo from factura where factura = '".$factura."'");
			return $reg;
		}
		public static function select2($factura) {
			$reg = conexion::sqlGet("SELECT b.medico FROM  factura b
            WHERE b.factura = '".$factura."'
            and b.estado_factura in ('E', 'R')");
			return $reg;
		}
		public static function select3($medico) {
			$reg = conexion::sqlGet("select nombre from medicos where codigo_medico = '".$medico."'");
			return $reg;
		}
		public static function insert1($MM_iduser,$factura, $id) {
			$sql ="insert into temp_pend (usuario, factura, sessionid)
			values ('".$MM_iduser."', '".$factura."', '".$id."')";
			conexion::trQry($sql);
			return 1;
		}
		public static function select4($factura) {
			$reg = conexion::sqlGet("SELECT a.historia, 
			a.nombre_paciente, b.no_cama, a.compania_de_seguro, 
			b.medico, d.edad, a.contraindicaciones, a.tratamiento
			as tratamiento, a.cargo as orden, b.despacho as despacho,
			b.cargo_impreso
            FROM registro a, factura b, tratamiento d
            WHERE b.factura = '".$factura."'
            AND a.historia = b.historia
            AND a.cargo = b.cargo
            AND a.historia = d.historia
            AND a.tratamiento = d.tratamiento
            and b.tratamiento = d.tratamiento
            and d.estado = 'A'
            and b.estado_factura in ('E','R')");
			return $reg;
		}
		public static function update2($pachab ,$rowcargo,$historia,$tratamiento) {
			$sql ="update registro set no_cama = 
			'".$pachab."' where cargo = 
			'".$cargo."' and historia = 
			'".$historia."' and tratamiento =
			'".$tratamiento."' ";
			conexion::trQry($sql);
			return 1;
		}
		public static function update3($pachab,$factura) {
			$sql ="update factura set no_cama = 
			'".$pachab."' where factura  = 
			'".$factura."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function select5($historia) {
			$reg = conexion::sqlGet("select historia, observacion, usuario, fecha_creacion from historias where historia = '".$historia."'");
			return $reg;
		}
		public static function select6($medico) {
			$reg = conexion::sqlGet("select nombre from medicos where codigo_medico = '".$medico."'");
			return $reg;
		}
		public static function select7($factura) {
			$reg = conexion::sqlGet("SELECT a.medicamento, a.forma_farma,
			b.descripcion, a.dosis_mostrar as dosis, concat(a.average, 
			' dosis de ', a.dosis_mostrar ) as cantidad_mostrar , 
			a.horas, a.dias, a.linea, a.cantidad, a.observacion, 
			a.contra, a.observacion_farma, a.razon_observacion, 
			d.descripcion as desc_turno, a.lote, a.medicamento_id, 
			a.turno FROM factura_detalle a, formas_farmaceuticas b,
			factura c, frecuencia_turno d where a.factura = 
			'".$factura."' and estado_producto not in ('X', 'P') 
			and a.forma_farma = b.codigo_forma and c.factura = 
			a.factura and c.estado_factura in ('E', 'R') and a.turno =
			d.id_frecuencia_turno");
			return $reg;
		}
		public static function select8() {
			$reg = conexion::sqlGet("select lote_auto, ven_auto from lotes_parametros");
			return $reg;
		}
		public static function select9() {
			$reg = conexion::sqlGet("select codigo_razon, descripcion from razon_observacion");
			return $reg;
		}
		public static function select10($medicamento_id) {
			$reg = conexion::sqlGet("select (cantidad_inicial - cantidad_factura + cantidad_devolucion)
			as existencia from medicamentos_x_bodega where medicamento_id =
			'".$medicamento_id."'  and bodega = 1 ");
			return $reg;
		}
		public static function select11($medicamento_id) {
			$reg = conexion::sqlGet("select lote from medicamentos_x_lote where medicamento_id = '".$medicamento_id."' and estado = 'A'  and cantidad > 0");
			return $reg;
		}
		public static function select12($medicamento_id) {
			$reg = conexion::sqlGet( "select lote, fecha_vencimiento from medicamentos_x_lote where medicamento_id = '".$medicamento_id."' and estado = 'A'  and cantidad > 0 order by fecha_vencimiento asc limit 1");
			return $reg;
		}
		public static function select13($medicamento_id) {
			$reg = conexion::sqlGet("select lote from medicamentos_x_lote where medicamento_id = '".$medicamento_id."' and estado = 'A'  and cantidad > 0" );
			return $reg;
		}
	}
?>
<?php
	require_once('../clases/conexion.php');
	
	class rei_l{
		
		public static function select1($factura) {
			$reg = conexion::sqlGet("select linea, preparacion 
			from factura_detalle where factura = '".$factura."'");
			return $reg;
		}
		public static function select2($factura,$linea) {
			$reg = conexion::sqlGet("select a.cargo, a.medicamento,
			a.horas, a.dias, b.historia, c.nombre_paciente nom_paciente, 
			b.no_cama, b.medico, concat(d.apellido_paterno, ' ',
			substring(d.primer_nombre,1,1),'.') as nombre, a.linea, 
			b.fecha, a.cantidad, b.localidad_entrega, a.dosis_mostrar
			as dosis, a.average, a.lote, a.factura, a.linea, a.turno, 
			a.medicamento_id from factura_detalle a, factura b, registro 
			c, medicos d, tratamiento e
            where a.factura = '".$factura."' and a.linea = '".$linea."'
			and a.cargo = c.cargo and a.factura = b.factura and 
			b.historia = c.historia and a.tratamiento = e.tratamiento 
			and b.tratamiento = e.tratamiento and c.tratamiento =
			e.tratamiento and a.historia = e.historia and e.estado =
			'A' and d.codigo_medico = b.medico";);
			return $reg;
		}
		public static function select3($factura) {
			$reg = conexion::sqlGet("select stat from factura where factura = '".$factura."'");
			return $reg;
		}
		public static function select4($turno) {
			$reg = conexion::sqlGet("select id_turno_inicio 
			from frecuencia_turno where id_frecuencia_turno = '".$turno."'");
			return $reg;
		}
		public static function select5($factura,$linea_cod) {
			$reg = conexion::sqlGet("select hora_inicio_entrega from factura_detalle where 
			factura = '".$factura."' and linea = '".$linea_cod."'");
			return $reg;
		}
		public static function select6($factura_cod,$medicamento_id,$inicio_turno) {
			$reg = conexion::sqlGet("select lote from lotes_x_factura where factura =
			'".$factura_cod."' and medicamento_id = '".$medicamento_id."' 
			and hora like '%".$inicio_turno."%'";);
			return $reg;
		}
		public static function select7($factura,$linea) {
			$reg = conexion::sqlGet("select a.cargo, a.medicamento, 
			a.horas, a.dias, b.historia, c.nombre_paciente nom_paciente,
			b.no_cama, b.medico, concat(d.apellido_paterno, ' ',
			substring(d.primer_nombre,1,1),'.') as nombre, a.linea,
			b.fecha, a.cantidad, b.localidad_entrega, a.observacion, 
			a.dosis_mostrar as dosis, a.observacion_farma, a.preparacion, 
			a.fecha_vencimiento, a.average, a.turno, a.factura, a.lote,
			a.medicamento_id from factura_detalle a, factura b, registro c,
			medicos d, tratamiento e
            where a.factura = '".$factura."' and a.linea = '".$linea."' and 
			a.cargo = c.cargo and a.factura = b.factura and b.historia =
			c.historia and d.codigo_medico = b.medico and a.tratamiento =
			e.tratamiento and b.tratamiento = e.tratamiento and 
			c.tratamiento = e.tratamiento and a.historia = e.historia 
			and e.estado = 'A'");
			return $reg;
		}
		public static function select8($factura) {
			$reg = conexion::sqlGet("select stat from factura where factura = '".$factura."'");
			return $reg;
		}
		public static function select9($turno) {
			$reg = conexion::sqlGet("select id_turno_inicio from frecuencia_turno where id_frecuencia_turno = '".$turno."'");
			return $reg;
		}
		public static function select10($factura,$linea_cod) {
			$reg = conexion::sqlGet("select hora_inicio_entrega from factura_detalle where  factura = '".$factura."' and linea = '".$linea_cod."'");
			return $reg;
		}
		public static function select11($factura_cod,$medicamento_id,$inicio_turno) {
			$reg = conexion::sqlGet("select lote from lotes_x_factura
			where factura = '".$factura_cod."' and medicamento_id = 
			'".$medicamento_id."' and hora like '%".$inicio_turno."%'";);
			return $reg;
		}
		
		
	}
	
?>
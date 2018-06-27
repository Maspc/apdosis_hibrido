<?php
	require_once('../clases/conexion.php');
	
	class imprimir{
	
	    public static function update1($lote,$factura,$linea) {
			$sql = "update factura_detalle set fecha_vencimiento=' ', preparacion=' ', lote='".$lote."' where factura = '".$factura."' and linea = '".$linea."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select1($factura,$medicamento_id) {
			$reg = conexion::sqlGet("select lote from lotes_x_factura where factura = '".$factura."' and medicamento_id = '".$medicamento_id."'");			
			return $reg;
		}
		
		public static function select2($factura) {
			$reg = conexion::sqlGet("select stat from factura where factura = '".$factura."'");			
			return $reg;
		}
		
		public static function select3($turno) {
			$reg = conexion::sqlGet("select id_turno_inicio from frecuencia_turno where id_frecuencia_turno = '".$turno."'");			
			return $reg;
		}
		
		public static function select4($factura,$linea) {
			$reg = conexion::sqlGet("select hora_inicio_entrega from factura_detalle where  factura = '".$factura."' and linea = '".$linea."'");			
			return $reg;
		}
		
		public static function select5($factura,$medicamento_id) {
			$reg = conexion::sqlGet("select b.tipo_de_dosis, b.grupo_medicamento,b.multiple_principio, a.cantidad_por_dosis, f.descripcion as vol_desc, tipos_posologias.descripcion as dosis_desc, a.average, a.horas, b.volumen, b.posologia, a.dosis_mostrar from factura_detalle a, medicamentos b, tipos_posologias, tipos_posologias f where a.factura = '".$factura."' and a.medicamento_id = '".$medicamento_id."' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = tipos_posologias.codigo_posologia and b.tipo_volumen = f.codigo_posologia");			
			return $reg;
		}
		
		public static function insert1($factura,$medicamento_id,$lote,$cantidad_por_dosis,$turno,$inicio_turno,$dosis_mostrar) {
			$sql = "insert into lotes_x_factura (factura, medicamento_id, lote, cantidad, turno, hora, dosis_mostrar) values ('".$factura."','".$medicamento_id."',  '".$lote."', '".$cantidad_por_dosis."', '".$turno."', '".$inicio_turno."', '".$dosis_mostrar."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update2($obsfarma,$razonobs,$factura,$linea) {
			$sql = "update factura_detalle set observacion_farma = '".$obsfarma."', razon_observacion = '".$razonobs."' where factura = '".$factura."' and linea = '".$linea."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function update3($fecha_ven,$factura,$linea) {
			$sql = "update factura_detalle set fecha_vencimiento='".$fecha_ven."', preparacion='S' where factura = '".$factura."' and linea = '".$linea."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select6($factura,$linea) {
			$reg = conexion::sqlGet("select a.turno, a.codigo_carro, a.average, b.fecha_creacion, b.stat_inicio, a.hora_inicio_entrega, a.cantidad_entregas, a.turno from factura_detalle a, factura b where a.factura = '".$factura."' and a.linea = '".$linea."' and a.factura = b.factura");			
			return $reg;
		}
		
		public static function select7($turno) {
			$reg = conexion::sqlGet("select id_frecuencia from preparacion_frecuencia where id_frecuencia_turno = '".$turno."' order by id_frecuencia");			
			return $reg;
		}
		
		public static function insert2($fact,$lin,$codigo_carro,$id_frecuencia) {
			$sql = "insert into preparacion_nave (factura, linea, codigo_carro, id_frecuencia) values('".$fact."', '".$lin."', '".$codigo_carro."', '".$id_frecuencia."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select8() {
			$reg = conexion::sqlGet("select codigo_carro, intervalo1 from eventos_carros where estado = 'F' order by codigo_carro desc limit 1");			
			return $reg;
		}
		
		public static function select9() {
			$reg = conexion::sqlGet("select id_frecuencia, hora from preparacion_turno order by id_frecuencia");			
			return $reg;
		}
		
		public static function select10($fact,$lin,$id_frecuencia) {
			$reg = conexion::sqlGet("select 1 from preparacion_nave where factura = '".$fact."' and linea = '".$lin."' and id_frecuencia = '".$id_frecuencia."'");			
			return $reg;
		}
		
		public static function insert3($fact,$lin,$codigo_carro_p,$turno_inicio) {
			$sql = "insert into preparacion_nave (factura, linea, codigo_carro, id_frecuencia, stat) values('".$fact."', '".$lin."', '".$codigo_carro_p."', '".$turno_inicio."', 'S')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select11($turno,$turno_inicio) {
			$reg = conexion::sqlGet("select id_frecuencia from preparacion_frecuencia where id_frecuencia_turno = '".$turno."' and id_frecuencia >= '".$turno_inicio."' order by id_frecuencia");			
			return $reg;
		}
		
		public static function select12($fact,$lin,$id_frecuencia) {
			$reg = conexion::sqlGet("select 1 from preparacion_nave where factura = '".$fact."' and linea = '".$lin."' and id_frecuencia = '".$id_frecuencia."'");			
			return $reg;
		}
		
		public static function insert4($fact,$lin,$codigo_carro_p,$id_frecuencia) {
			$sql = "insert into preparacion_nave (factura, linea, codigo_carro, id_frecuencia) values('".$fact."', '".$lin."', '".$codigo_carro_p."', '".$id_frecuencia."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select13($factura) {
			$reg = conexion::sqlGet("select sum(a.cantidad) as cantidad_lote from lotes_x_factura a, factura_detalle b where a.factura='".$factura."' and a.factura = b.factura and a.medicamento_id = b.medicamento_id and b.estado_producto != 'X'");			
			return $reg;
		}
		
		public static function select14($factura) {
			$reg = conexion::sqlGet("select sum(b.cantidad) as cantidad_factura from factura_detalle b where b.factura='".$factura."' and b.estado_producto != 'X'");			
			return $reg;
		}
		
		public static function select15($factura,$imprimir) {
			$reg = conexion::sqlGet("select a.cargo, a.medicamento, a.horas, a.dias, b.historia, c.nombre_paciente nom_paciente, b.no_cama, b.medico, concat(d.apellido_paterno, ' ', substring(d.primer_nombre,1,1),'.') as nombre, a.linea, b.fecha, a.cantidad, b.localidad_entrega, a.dosis_mostrar as dosis, a.average, a.lote, a.factura, a.linea, a.turno, a.medicamento_id from factura_detalle a, factura b, registro c, medicos d, tratamiento e
						where a.factura = '".$factura."' and a.linea = '".$imprimir."' and a.cargo = c.cargo and a.factura = b.factura and b.historia = c.historia and a.tratamiento = e.tratamiento and b.tratamiento = e.tratamiento and c.tratamiento = e.tratamiento and a.historia = e.historia and e.estado = 'A' and d.codigo_medico = b.medico");			
			return $reg;
		}
		
		public static function select16($factura) {
			$reg = conexion::sqlGet("select stat from factura where factura = '".$factura."'");			
			return $reg;
		}
		
		public static function select17($turno) {
			$reg = conexion::sqlGet("select id_turno_inicio from frecuencia_turno where id_frecuencia_turno = '".$turno."'");			
			return $reg;
		}
		
		public static function select18($factura,$linea_cod) {
			$reg = conexion::sqlGet("select hora_inicio_entrega from factura_detalle where  factura = '".$factura."' and linea = '".$linea_cod."'");			
			return $reg;
		}
		
		public static function select19($factura_cod,$medicamento_id,$inicio_turno) {
			$reg = conexion::sqlGet("select lote from lotes_x_factura  where factura = '".$factura_cod."' and medicamento_id = '".$medicamento_id."' and hora like '%".$inicio_turno."%'");			
			return $reg;
		}
		
		public static function select20($factura,$imprimir) {
			$reg = conexion::sqlGet("select a.cargo, a.medicamento, a.horas, a.dias, b.historia, c.nombre_paciente nom_paciente, b.no_cama, b.medico, concat(d.apellido_paterno, ' ', substring(d.primer_nombre,1,1),'.') as nombre, a.linea, b.fecha, a.cantidad, b.localidad_entrega, a.observacion, a.dosis_mostrar as dosis, a.observacion_farma, a.preparacion, a.fecha_vencimiento, a.average, a.turno, a.factura, a.lote, a.medicamento_id from factura_detalle a, factura b, registro c, medicos d, tratamiento e
						where a.factura = '".$factura."' and a.linea = '".$imprimir."' and a.cargo = c.cargo and a.factura = b.factura and b.historia = c.historia and d.codigo_medico = b.medico and a.tratamiento = e.tratamiento and b.tratamiento = e.tratamiento and c.tratamiento = e.tratamiento and a.historia = e.historia and e.estado = 'A'");			
			return $reg;
		}
		
		public static function select21($factura) {
			$reg = conexion::sqlGet("select stat from factura where factura = '".$factura."'");			
			return $reg;
		}
		
		public static function select22($turno) {
			$reg = conexion::sqlGet("select id_turno_inicio from frecuencia_turno where id_frecuencia_turno = '".$turno."'");			
			return $reg;
		}
		
		public static function select23($factura,$linea_cod) {
			$reg = conexion::sqlGet("select hora_inicio_entrega from factura_detalle where  factura = '".$factura."' and linea = '".$linea_cod."'");			
			return $reg;
		}
		
		public static function select24($factura_cod,$medicamento_id,$inicio_turno) {
			$reg = conexion::sqlGet("select lote from lotes_x_factura where factura = '".$factura_cod."' and medicamento_id = '".$medicamento_id."' and hora like '%".$inicio_turno."%'");			
			return $reg;
		}
	}
	
?>
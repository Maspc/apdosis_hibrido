<?php
	require_once('../clases/conexion.php');
	
	class cargosp{
		
		public static function select1($MM_iduser) {
			$sql = "select nombre from usuarios where user =
			'".$MM_iduser."'";  
			$reg = conexion::sqlGet($sql);
			return $reg;
		}		
		public static function select2() {
			$sql = "select codigo_carro from eventos_carros where estado =
			'P' order by codigo_carro limit 1";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select3($codigo_carro_p) {
			$sql =  "select distinct factura_detalle.factura from
			factura_detalle, factura where factura_detalle.codigo_carro = 
			'".$codigo_carro_p."' and factura.factura = factura_detalle.factura
			and factura_detalle.linea > 0 order by factura.no_cama";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select4() {
			$sql = "select codigo_carro from eventos_carros where estado =
			'P'";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select5() {
			$sql =  "SELECT DISTINCT f.no_cama, f.factura, f.fecha_creacion,
			'URGENTE' est, r.nombre_paciente, r.cargo, f.despacho,
			f.cargo_impreso, TIMESTAMPDIFF(MINUTE,f.fecha_creacion,NOW()) 
			as minutos
		    FROM factura f, registro r, factura_detalle fd
		    WHERE f.estado_factura = 'E'
		    and f.stat = 'S'
		    and f.prn != 'S'
		    and f.stat_inicio != 'S'
		    and f.cargo = r.cargo
		    and f.historia = r.historia
		    and f.tratamiento = r.tratamiento
		    and fd.factura = f.factura
		    ORDER BY fecha_creacion asc";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select6() {
			$sql = "SELECT DISTINCT f.no_cama, f.factura, f.fecha_creacion,
			'URGENTE NAVE' est, r.nombre_paciente, r.cargo,
			f.despacho,f.cargo_impreso
		    FROM factura f, registro r, factura_detalle fd
		    WHERE f.estado_factura = 'E'
		    and f.stat = 'S'
		    and f.prn != 'S'
		    and f.stat_inicio = 'S'
		    and f.cargo = r.cargo
		    and f.historia = r.historia
		    and f.tratamiento = r.tratamiento
		    and fd.factura = f.factura
		    ORDER BY fecha_creacion asc";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select7($factura) {
			$sql = "SELECT f.no_cama, f.factura, f.fecha_creacion, 
			'X' stat, 'RECURRENTE' est, r.nombre_paciente, r.cargo,
			f.despacho, f.cargo_impreso
			FROM factura f, registro r
			WHERE f.estado_factura = 'R'
			and f.factura = '".$factura."'
			and f.cargo = r.cargo
			and f.historia = r.historia
			and f.tratamiento = r.tratamiento
			ORDER BY f.no_cama";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select8($factura) {
			$sql = "SELECT f.no_cama, f.factura, f.fecha_creacion,
			'NUEVO' est, r.nombre_paciente, r.cargo, f.despacho, 
			f.cargo_impreso
			FROM factura f, registro r
			WHERE f.estado_factura = 'E'
			and f.stat != 'S'
			and f.cargo = r.cargo
			and f.factura = '".$factura."'
			and f.historia = r.historia
			and f.tratamiento = r.tratamiento
			ORDER BY f.no_cama";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select9() {
			$sql = "SELECT distinct f.no_cama, f.factura, f.fecha_creacion,
			'PRN' est, r.nombre_paciente, r.cargo, f.despacho,
			f.cargo_impreso
		    FROM factura f, registro r, factura_detalle fd
		    WHERE f.estado_factura = 'E'
		    and f.stat = 'S'
		    and f.prn = 'S'
		    and f.cargo = r.cargo
		    and f.historia = r.historia
		    and f.tratamiento = r.tratamiento
		    and f.factura = fd.factura
		    ORDER BY fecha_creacion asc";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select10() {
			$sql = "SELECT no_cama, devolucion, fecha_creacion, factura, 
			if(stat='S', 'URGENTE', 'NUEVA') as tipo, cargo_impreso
		    FROM devolucion
		    WHERE estado = 'P'
		    ORDER BY stat desc, fecha_creacion asc";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
	}
	
?>
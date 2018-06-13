<?php
	require_once('../clases/conexion.php');
	
	class estado_c{
				
		public static function select1($where,$estado_cargo) {
			$sql = "SELECT DISTINCT registro.historia, 
			registro.nombre_paciente, registro.cargo, registro.estado,
			registro.cargo, registro.tratamiento, registro.stat,
			registro.fecha_creacion
			FROM registro, tratamiento
			WHERE ".implode(" and ", $where)."  
			AND registro.historia = tratamiento.historia 
			AND registro.tratamiento = tratamiento.tratamiento
			and registro.estado like '".$estado_cargo."'
			AND tratamiento.estado ='A' 
			order by registro.cargo desc";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select2($historia,$tratamiento,$cargo) {
			$sql = "select a.bodega, b.descripcion from factura a, 
			bodegas b where a.historia = '".$historia."' 
			and a.tratamiento = '".$tratamiento."' and a.cargo =
			'".$cargo."' and a.bodega = b.bodega";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select3($historia,$tratamiento,$cargo) {
			$sql = "SELECT medicamento, forma_farma,
			formas_farmaceuticas.descripcion, dosis, horas, dias, 
			linea, cargo, cantidad_de_dosis, registro_detalle.estado, 
			registro_detalle.cargo, 
			registro_detalle.historia, registro_detalle.tratamiento,
			registro_detalle.cantidad, 
			registro_detalle.interrumpido_por, 
			if(registro_detalle.fecha_interrupcion = '0000-00-00 00:00:00', 
			' ', registro_detalle.fecha_interrupcion) as fecha_interrupcion, 
			registro_detalle.razon_int,registro_detalle.cantidad_de_dosis 
			FROM registro_detalle, tratamiento, formas_farmaceuticas 
			where registro_detalle.historia ='".$historia."' 
			and registro_detalle.tratamiento = '".$tratamiento."'
			AND registro_detalle.cargo='".$cargo."' 
			and tratamiento.historia = registro_detalle.historia 
			and tratamiento.tratamiento  = registro_detalle.tratamiento
			and tratamiento.estado = 'A' 
			and forma_farma = formas_farmaceuticas.codigo_forma";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select4() {
			$sql =  "select codigo_carro, intervalo1 from eventos_carros 
			where estado = 'P' order by codigo_carro limit 1";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select5($historia) {
			$sql ="SELECT DISTINCT registro.historia, 
			registro.nombre_paciente
			FROM registro
			WHERE historia = '".$historia."' limit 1"; 
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select6($historia,$codigo_carro) {
			$sql = "select factura.factura, factura.historia, 
			factura.fecha_creacion, factura_detalle.precio_unitario, 
			factura_detalle.horas, factura_detalle.dias, factura.cargo,
			factura.tratamiento, factura.stat, factura_detalle.medicamento, 
			factura_detalle.cantidad, factura_detalle.hora_evento_carro,
			factura_detalle.despacho, factura_detalle.estado_producto,
			factura.ordenado_por, factura.cargo, 
			tipos_dosis.descripcion, registro_detalle.cantidad_de_dosis 
			from factura, factura_detalle, medicamentos,tipos_dosis, 
			registro_detalle where factura.historia = '".$historia."'
		    and factura.factura = factura_detalle.factura 
			and factura_detalle.codigo_carro = '".$codigo_carro."'
			and factura_detalle.historia = registro_detalle.historia
			and factura_detalle.tratamiento = registro_detalle.tratamiento
			and factura_detalle.cargo = registro_detalle.cargo 
			and factura_detalle.medicamento_id = registro_detalle.medicamento_id
			and medicamentos.codigo_interno = factura_detalle.medicamento_id
		    and medicamentos.tipo_de_dosis  = tipos_dosis.codigo_tipo
			order by factura";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select7($hora_evento_carro) {
			$sql =  "select codigo_carro from eventos_carros where
			intervalo1 = '".$hora_evento_carro."'";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		
	}
	
?>
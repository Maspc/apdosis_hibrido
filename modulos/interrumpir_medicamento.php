<?php
	require_once('../clases/conexion.php');
	
	class int_m {
		public static function select1($cargo,$historia) {
			$sql ="select registro.historia, registro.nombre_paciente,
			registro.tratamiento, registro.stat from registro,
			tratamiento where registro.cargo = '".$cargo."' and 
			registro.historia = '".$historia."' and registro.tratamiento =
			tratamiento.tratamiento and tratamiento.estado = 
			'A' and tratamiento.historia = '".$historia."' and 
			registro.estado != 'F' and registro.estado != 
			'C' and registro.estado != 'X'";	 
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select2($cargo,$historia) {
			$sql =	"SELECT medicamento, forma_farma, 
			dosis, horas, dias, linea, registro_detalle.cargo,
			registro_detalle.cantidad_de_dosis, descripcion,
			registro.stat FROM registro_detalle, formas_farmaceuticas, 
			registro, tratamiento where registro_detalle.cargo = 
			'".$cargo."' and registro_detalle.historia = '".$historia."' 
			and registro_detalle.tratamiento = tratamiento.tratamiento 
			and tratamiento.estado = 'A' and tratamiento.historia =
			'".$historia."' and registro_detalle.estado != 'X'
			and registro_detalle.forma_farma = 
			formas_farmaceuticas.codigo_forma and
			registro_detalle.estado != 'F' and registro.historia = 
			registro_detalle.historia and registro.tratamiento =
			registro_detalle.tratamiento and registro.cargo = 
			registro_detalle.cargo and registro.estado != 'X'"; 
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select3($cargo,$historia) {
			$sql =	"select factura from factura, tratamiento where 
			factura.cargo = '".$cargo."' and factura.historia = 
			'".$historia."' and factura.estado_factura in ('E','R')
			and tratamiento.historia = factura.historia and
			tratamiento.estado = 'A'"; 
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select4($cargo2,$historia) {
			$sql =	"SELECT medicamento, medicamento_id,
			forma_farma, descripcion, dosis, horas, dias, 
			linea, registro_detalle.cargo,
			registro_detalle.cantidad_de_dosis FROM registro_detalle, 
			formas_farmaceuticas, registro, 
			tratamiento where registro_detalle.cargo =
			'".$cargo2."' and registro_detalle.historia = 
			'".$historia."' and registro_detalle.tratamiento =
			tratamiento.tratamiento and tratamiento.historia = 
			'".$historia."' and tratamiento.estado='A' 
			and registro_detalle.forma_farma = 
			formas_farmaceuticas.codigo_forma and 
			registro_detalle.estado != 'X' and
			registro_detalle.estado != 'F' and 
			registro.historia = registro_detalle.historia 
			and registro.tratamiento = registro_detalle.tratamiento
			and registro.cargo = registro_detalle.cargo
			and registro.estado != 'X' and registro.stat != 'S'"; 
			$reg = conexion::sqlGet($sql);
			return $reg;
		}		
	}
?>
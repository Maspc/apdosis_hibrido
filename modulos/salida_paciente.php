<?php
	require_once('../clases/conexion.php');
	
	class salida_p {
		
		public static function select1($historia) {
			$reg = conexion::sqlGet("SELECT DISTINCT registro.historia, registro.nombre_paciente, registro.cargo, registro.estado, registro.cargo, registro.tratamiento, registro.stat
			FROM registro, tratamiento
			WHERE registro.tratamiento = tratamiento.tratamiento
			AND registro.historia = tratamiento.historia
			AND tratamiento.estado ='A' and registro.historia = '".$historia."'");
			return $reg;
			
		}
		public static function select2($historia,$cargo) {
			$reg = conexion::sqlGet("SELECT medicamento, 
			forma_farma, formas_farmaceuticas.descripcion, 
			dosis, horas, dias, linea, cargo, cantidad_de_dosis,
			registro_detalle.estado, registro_detalle.cargo, 
			registro_detalle.historia, registro_detalle.tratamiento, 
			registro_detalle.cantidad FROM registro_detalle,
			tratamiento, formas_farmaceuticas where
			registro_detalle.historia ='".$historia."' 
			and tratamiento.estado = 'A' and registro_detalle.tratamiento =
			tratamiento.tratamiento and tratamiento.historia = 
			registro_detalle.historia AND registro_detalle.cargo=
			'".$cargo."' and forma_farma =
			formas_farmaceuticas.codigo_forma";);
			return $reg;
		}
	}
?>
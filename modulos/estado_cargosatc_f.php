<?php
	require_once('../clases/conexion.php');
	
	class estadoc_f{
	
		public static function select1($where) {
			$sql ="SELECT DISTINCT registro.historia, registro.nombre_paciente, registro.cargo, registro.estado, registro.cargo, registro.tratamiento, registro.stat, registro.fecha_creacion
			FROM registro, tratamiento
			WHERE registro.tratamiento = tratamiento.tratamiento
			AND registro.historia = tratamiento.historia
			AND tratamiento.estado ='A' and ".implode(" and ", $where);
			$regis = conexion::sqlGet($sql);
			return $regis;
		}		
	public static function select2($historia,$tratamiento,$cargo) {
			$sql = "select a.bodega, 
			b.descripcion from factura a,
			bodegas b where a.historia = 
			'".$historia."'  and a.tratamiento =
			'".$tratamiento."' and a.cargo = '".$cargo."' 
			and a.bodega = b.bodega";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}	
    public static function select3($historia,$cargo,$tratamiento) {
			$sql = "SELECT medicamento, 
			forma_farma, formas_farmaceuticas.descripcion, 
			dosis, horas, dias, linea, cargo, cantidad_de_dosis,
			registro_detalle.estado, registro_detalle.cargo, 
			registro_detalle.historia, registro_detalle.tratamiento,
			registro_detalle.cantidad, registro_detalle.interrumpido_por, 
			if(registro_detalle.fecha_interrupcion = '0000-00-00 00:00:00', ' ',
			registro_detalle.fecha_interrupcion) as fecha_interrupcion, 
			registro_detalle.razon_int FROM registro_detalle, 
			tratamiento, formas_farmaceuticas
			where registro_detalle.historia ='".$historia."' 
			and tratamiento.estado = 'A' and registro_detalle.tratamiento = 
			tratamiento.tratamiento and tratamiento.historia = 
			registro_detalle.historia AND registro_detalle.cargo=
			'".$cargo."' and forma_farma = 
			formas_farmaceuticas.codigo_forma and tratamiento.tratamiento = 
			'".$tratamiento."'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
	
	}
	
?>
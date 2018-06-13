<?php
	require_once('../clases/conexion.php');
	
	class dv{
		
		public static function select1($factura_codigo) {
			$sql = "select factura.factura, 
			factura.historia, factura.fecha_creacion,
			factura_detalle.precio_unitario, factura.fa, 
			factura_detalle.medicamento, factura_detalle.cantidad,
			factura_detalle.hora_evento_carro, 
			factura_detalle.despacho, factura_detalle.estado_producto 
			from factura, factura_detalle, medicamentos where
			factura.factura = '".$factura_codigo."' and factura.factura =
			factura_detalle.factura and factura.estado_factura = 'I'  
			and factura_detalle.medicamento_id =
			medicamentos.codigo_interno and medicamentos.tipo_mercancia
			!= '3' order by factura";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}		
		public static function select2($where) {
			$sql = "SELECT DISTINCT registro.historia,
			registro.nombre_paciente, registro.cargo, 
			registro.estado, registro.cargo, 
			registro.tratamiento, registro.stat
			FROM registro, tratamiento
			WHERE registro.tratamiento = tratamiento.tratamiento
			AND registro.historia = tratamiento.historia
			AND tratamiento.estado =
			'A' and ".implode(" and ", $where);
			$reg = conexion::sqlGet($sql);
			return $reg;
		}	
		public static function select3($historia,$cargo) {
			$sql ="SELECT medicamento, 
			forma_farma, formas_farmaceuticas.descripcion, 
			dosis, horas, dias, linea, cargo, 
			cantidad_de_dosis, registro_detalle.estado, 
			registro_detalle.cargo, registro_detalle.historia, 
			registro_detalle.tratamiento,
			registro_detalle.cantidad FROM 
			registro_detalle, tratamiento,
			formas_farmaceuticas where 
			registro_detalle.historia =
			'".$historia."' and tratamiento.estado =
			'A' and registro_detalle.tratamiento =
			tratamiento.tratamiento and tratamiento.historia =
			registro_detalle.historia AND 
			registro_detalle.cargo='".$cargo."' 
			and forma_farma = 
			formas_farmaceuticas.codigo_forma";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		public static function select4($historia,$tratamiento,$cargo) {
			$sql ="select factura.factura, factura.historia, 
			factura.fecha_creacion, factura_detalle.precio_unitario,
			factura.fa, factura_detalle.medicamento,
			factura_detalle.cantidad, 
			factura_detalle.hora_evento_carro,
			factura_detalle.despacho, factura_detalle.estado_producto
			from factura, factura_detalle, medicamentos where 
			factura.historia = '".$historia."'
			and factura.tratamiento = '".$tratamiento."'
			and factura.cargo = '".$cargo."' 
			and factura.factura = factura_detalle.factura and 
			factura.estado_factura = 'I'  and
			factura_detalle.medicamento_id =
			medicamentos.codigo_interno and 
			medicamentos.tipo_mercancia != '3' order by factura";
			$reg = conexion::sqlGet($sql);
		    return $reg;
		}
		
		
	}
?>
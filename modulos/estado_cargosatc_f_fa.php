<?php
	require_once('../clases/conexion.php');
	
	class estado_cff{
				
		public static function select1($FA) {
			$sql = "select historia, cargo, tratamiento, factura from 
			factura where FA = '".$FA."'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select2($FA) {
			$sql = "select devolucion.historia, devolucion.devolucion, 
			devolucion.factura, factura.FA as factura_fa,
			factura.tratamiento, factura.cargo from devolucion,
			factura where devolucion.FA = '".$FA."' and devolucion.factura =
			factura.factura";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select3($cargo,$historia) {
			$sql = "SELECT DISTINCT registro.historia,
			registro.nombre_paciente, registro.cargo,
			registro.estado, registro.cargo, registro.tratamiento,
			registro.stat, registro.fecha_creacion
		    FROM registro, tratamiento
			WHERE registro.tratamiento = tratamiento.tratamiento
			AND registro.historia = tratamiento.historia
			and  registro.cargo = '".$cargo."' and registro.historia = 
			'".$historia."' ";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select4($historia,$tratamiento,$cargo) {
			$sql = "select a.bodega, b.descripcion from factura a,
			bodegas b where a.historia = '".$historia."' 
			and a.tratamiento = '".$tratamiento."' and a.cargo = 
			'".$cargo."' and a.bodega = b.bodega";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select5($historia,$cargo,$tratamiento) {
			$sql = "SELECT medicamento, forma_farma, 
			formas_farmaceuticas.descripcion, dosis, horas, dias,
			linea, cargo, cantidad_de_dosis, registro_detalle.estado,
			registro_detalle.cargo, registro_detalle.historia, 
			registro_detalle.tratamiento, registro_detalle.cantidad, 
			registro_detalle.interrumpido_por, 
			if(registro_detalle.fecha_interrupcion =
			'0000-00-00 00:00:00', ' ', registro_detalle.fecha_interrupcion)
			as fecha_interrupcion, registro_detalle.razon_int FROM 
			registro_detalle, tratamiento, formas_farmaceuticas where 
			registro_detalle.historia ='".$historia."' and 
			registro_detalle.tratamiento = tratamiento.tratamiento and 
			tratamiento.historia = registro_detalle.historia AND 
			registro_detalle.cargo='".$cargo."' and
			forma_farma = formas_farmaceuticas.codigo_forma and
			tratamiento.tratamiento = '".$tratamiento."'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select6($historia,$tratamiento,$cargo,$factura) {
			$sql = "select factura.factura, factura.historia, 
			factura.fecha_creacion, factura_detalle.precio_unitario, 
			factura.fa, factura.tratamiento, factura.stat, 
			factura_detalle.medicamento, factura_detalle.cantidad, 
			factura_detalle.hora_evento_carro, factura_detalle.despacho,
			factura_detalle.estado_producto, factura.ordenado_por,
			factura.cargo, factura.factura_fiscal, 
			(factura_detalle.precio_unitario + factura_detalle.costo_insumo + 
			factura_detalle.impuesto) as precio_unitario from factura, 
			factura_detalle where factura.historia = '".$historia."'
			and factura.tratamiento = '".$tratamiento."'
			and factura.cargo = '".$cargo."' and factura.factura = 
			factura_detalle.factura and factura.factura = '".$factura."'
			order by
			factura";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select7($hora_evento_carro) {
			$sql = "select codigo_carro from eventos_carros where 
			intervalo1 =
			'".$hora_evento_carro."'";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select8($historia,$tratamiento,$cargo,$factura) {
			$sql = "select devolucion.devolucion, devolucion.historia, 
			devolucion.fecha_creacion, (devolucion_detalle.precio_unitario +
			devolucion_detalle.costo_insumo + devolucion_detalle.impuesto)
			as precio_unitario, devolucion.fa, devolucion_detalle.medicamento,
			devolucion_detalle.cantidad, devolucion.factura_fiscal from 
			factura, devolucion, devolucion_detalle where factura.historia =
			'".$historia."'
			and factura.tratamiento = '".$tratamiento."'
			and factura.cargo = '".$cargo."' and factura.factura = 
			devolucion.factura and devolucion.devolucion = 
			devolucion_detalle.devolucion and devolucion.factura =
			'".$factura."' order by devolucion";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select9($cargo,$historia) {
			$sql = "SELECT DISTINCT registro.historia,
			registro.nombre_paciente, registro.cargo, 
			registro.estado, registro.cargo, registro.tratamiento, 
			registro.stat, registro.fecha_creacion
			FROM registro, tratamiento
			WHERE registro.tratamiento = tratamiento.tratamiento
			AND registro.historia = tratamiento.historia
			and  registro.cargo = '".$cargo."' and registro.historia = 
			'".$historia."' ";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select10($historia,$tratamiento,$cargo) {
			$sql = "select a.bodega, b.descripcion from factura a,
			bodegas b where a.historia = '".$historia."' 
			and a.tratamiento = '".$tratamiento."' and a.cargo =
			'".$cargo."' and a.bodega = b.bodega";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select11($FA) {
			$sql = "select devolucion.devolucion, devolucion.historia,
			devolucion.fecha_creacion, (devolucion_detalle.precio_unitario + 
			devolucion_detalle.costo_insumo + devolucion_detalle.impuesto)
			as precio_unitario, devolucion.fa, 
			devolucion_detalle.medicamento, devolucion_detalle.cantidad,
			devolucion.factura_fiscal, devolucion_detalle.no_aceptada from 
			factura, devolucion, devolucion_detalle 
			where  factura.factura = devolucion.factura and 
			devolucion.devolucion = devolucion_detalle.devolucion and
			devolucion.fa = '".$FA."' order by devolucion";
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		
	}
	
?>
<?php
	require_once('../clases/conexion.php');
	
	class falta_fa{
		
		public static function select1() {
			$reg = conexion::sqlGet("select registro.historia, 
			registro.nombre_paciente, factura.estado_factura,
			factura.factura, factura.total, factura.fecha,factura.FA 
            from registro, factura where factura.cargo = registro.cargo 
			and factura.historia = registro.historia 
            and factura.tratamiento = registro.tratamiento and 
			factura.estado_factura = 'I' and fa_fiscal = '' 
			and FA is not NULL and FA != 0 and factura.publico !=
			'S' and date(factura.fecha) >= (curdate() -  interval 1 month) 
			order by factura.fecha desc");
			return $reg;
			
		}
		public static function select2() {
			$reg = conexion::sqlGet("select registro.historia, 
			registro.nombre_paciente, factura.estado_factura, 
			factura.factura, factura.total, factura.fecha 
            from registro, factura where factura.cargo = registro.cargo 
			and factura.historia = registro.historia 
            and factura.tratamiento = registro.tratamiento and 
			factura.estado_factura = 'F' and (FA is NULL or FA = 0) and contingencia != 'S' and factura.publico != 'S' and factura.total > 0 and date(factura.fecha) >= (curdate() -  interval 1 month) 
            union
            select registro.historia, registro.nombre_paciente, 
			factura.estado_factura, factura.factura, factura.total,
			factura.fecha 
            from registro, factura where factura.cargo = registro.cargo 
			and factura.historia = registro.historia 
            and factura.tratamiento = registro.tratamiento and
			factura.estado_factura = 'I' and (FA is NULL or FA = 0) 
			and factura.publico != 'S' and factura.total > 0
			and date(factura.fecha) >= (curdate() -  interval 1 month) 
			order by fecha desc");
			return $reg;
		}
		public static function select3() {
			$reg = conexion::sqlGet("select registro.historia,
			registro.nombre_paciente, devolucion.estado,
			devolucion.devolucion, devolucion.total, 
			devolucion.fecha_creacion
            from registro, devolucion, factura where factura.cargo =
			registro.cargo and factura.historia = registro.historia  
			and factura.factura = devolucion.factura and 
			factura.tratamiento = registro.tratamiento and 
			(devolucion.FA IS NULL or  devolucion.FA = 0)
			and devolucion.estado = 'F' and devolucion.contingencia !=
			'S' and date(devolucion.fecha_creacion) >= (curdate() - 
			interval 1 month) 
            union
            select registro.historia, registro.nombre_paciente,
			devolucion.estado, devolucion.devolucion, devolucion.total,
			devolucion.fecha_creacion
            from registro, devolucion, factura where factura.cargo = 
			registro.cargo and factura.historia = registro.historia 
			and factura.factura = devolucion.factura and
			factura.tratamiento = registro.tratamiento 
			and devolucion.FA IS NULL and devolucion.estado = 
			'E' and devolucion.contingencia != 'S' and 
			date(devolucion.fecha_creacion) >= (curdate() - 
			interval 1 month) order by fecha_creacion desc");
			return $reg;
			
		}
		public static function select4() {
			$reg = conexion::sqlGet("select registro.historia, 
			registro.nombre_paciente, devolucion.estado, 
			devolucion.devolucion, devolucion.total,
			devolucion.fecha_creacion, devolucion.FA
            from registro, devolucion, factura where factura.cargo = 
			registro.cargo and factura.historia = registro.historia 
			and factura.factura = devolucion.factura and
			factura.tratamiento = registro.tratamiento and 
			devolucion.fa_fiscal = 0 and devolucion.estado = 
			'E' and (devolucion.FA != 0 or devolucion.FA is not NULL)
			and date(devolucion.fecha_creacion) >= (curdate() -  interval
			1 month) order by devolucion.fecha_creacion desc");
			return $reg;
			
		}
	}	
	
?>
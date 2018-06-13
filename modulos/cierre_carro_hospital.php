<?php
	require_once('../clases/conexion.php');
	
	class cierre_ch{
		
		public static function select1() {
			$sql ="select registro.historia, registro.nombre_paciente, factura.estado_factura, factura.factura, factura.FA, factura.total, factura.fecha 
			from registro, factura where factura.cargo = registro.cargo and factura.historia = registro.historia 
			and factura.tratamiento = registro.tratamiento and factura.estado_factura = 'F' and factura.stat != 'S' and FA != ''";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}		
		
		public static function select2($factura) {
			$sql ="select a.historia,a.nombre_paciente, a.no_cama, a.compania_de_seguro, 
			c.nombre as nombre_med from registro a, factura b, medicos c,tratamiento d 
			where b.factura = '".$factura."' and a.historia = b.historia 
			and b.medico = c.codigo_medico and a.cargo = b.cargo 
			and a.historia = d.historia and a.tratamiento =d.tratamiento 
			and b.tratamiento = d.tratamiento and d.estado = 'A'";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		
		public static function select3($factura) {
			$sql ="SELECT a.medicamento, a.forma_farma, b.descripcion, a.dosis, a.horas, 
			a.dias, a.linea, a.cantidad, a.precio_unitario, a.precio_venta,a.costo_insumo,
			a.impuesto FROM factura_detalle a, formas_farmaceuticas b 
			where factura = '".$factura."' and a.forma_farma = b.codigo_forma 
			and estado_producto != 'X' ";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		
		public static function select4($factura) {
			$sql ="SELECT a.precio_unitario, a.cantidad FROM factura_detalle a, 
			formas_farmaceuticas b where factura = '".$factura."' and a.forma_farma = 
			b.codigo_forma and estado_producto != 'X' ";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		
		public static function select5($factura) {
			$sql ="select a.FA, a.factura, b.nombre_carpeta2 from factura a, 
			impresoras_fiscales b where a.factura = '".$factura."' 
			and b.tipo_impresion = 'FAC'";
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
	}
	
?>
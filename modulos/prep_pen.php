<?php
	require_once('../clases/conexion.php');
	
	class pre_pen{
		public static function select1($MM_iduser) {
			$sql ="select nombre from usuarios where user =
			'".$MM_iduser."'"; 	 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
		public static function select2() {
			$sql ="select codigo_carro, intervalo1 from 
			eventos_carros where estado = 'F'
			order by codigo_carro desc limit 1";	 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}	
		public static function select3($codigo_carro) {
			$sql ="SELECT distinct a.medicamento, a.forma_farma, 
			b.descripcion, a.dosis_mostrar as dosis, concat
			(a.cantidad_por_dosis, ' dosis de ', a.dosis ) 
			as cantidad_mostrar , a.horas, a.dias, a.linea,
			a.cantidad, a.observacion, a.contra, 
			a.observacion_farma, a.razon_observacion,
			d.descripcion as desc_turno, c.historia, 
			c.no_cama, a.estado_producto, a.devolucion  
			FROM factura_detalle a, formas_farmaceuticas b, 
			factura c, frecuencia_turno d, preparacion_nave e 
			where a.factura = e.factura and a.forma_farma =
			b.codigo_forma and c.factura = a.factura and 
			c.estado_factura in ('E', 'R', 'I') and a.turno = 
			d.id_frecuencia_turno and e.codigo_carro = 
			'".$codigo_carro."' and e.linea = a.linea and e.stat =
			'S' and c.stat_inicio = 'S' order by c.no_cama";	 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}	
		public static function select4($codigo_carro,$id_frecuencia) {
			$sql ="SELECT distinct a.medicamento, a.forma_farma,
			b.descripcion, a.dosis_mostrar as dosis, 
			concat(a.cantidad_por_dosis, ' dosis de ', a.dosis )
			as cantidad_mostrar , a.horas, a.dias, a.linea, 
			a.cantidad, a.observacion, a.contra,
			a.observacion_farma, a.razon_observacion, 
			d.descripcion as desc_turno, c.historia, 
			c.no_cama, a.estado_producto, a.devolucion 
			FROM factura_detalle a, formas_farmaceuticas b,
			factura c, frecuencia_turno d, preparacion_nave
			e where a.factura = e.factura  and a.forma_farma = 
			b.codigo_forma and c.factura = a.factura and 
			c.estado_factura in ('E', 'R', 'I') and a.turno = 
			d.id_frecuencia_turno and e.codigo_carro = 
			'".$codigo_carro."' and e.linea = a.linea and
			e.id_frecuencia = '".$id_frecuencia."'
			union SELECT distinct a.medicamento, 
			a.forma_farma, b.descripcion, a.dosis_mostrar as
			dosis, concat(a.cantidad_por_dosis, ' dosis de 
			', a.dosis ) as cantidad_mostrar , a.horas,
			a.dias, a.linea, a.cantidad, a.observacion,
			a.contra, a.observacion_farma, a.razon_observacion,
			d.descripcion as desc_turno, c.historia, c.no_cama,
			a.estado_producto, a.devolucion FROM factura_detalle a,
			formas_farmaceuticas b, factura c, frecuencia_turno d,
			preparacion_nave e where a.factura = e.factura and
			a.forma_farma = b.codigo_forma and c.factura =
			a.factura and c.estado_factura in ('E', 'R', 'I') 
			and a.turno = d.id_frecuencia_turno and e.codigo_carro =
			'".$codigo_carro."' and e.linea = a.linea and e.id_frecuencia =
			'".$id_frecuencia."' and c.stat_inicio = 'S'
			order by no_cama";  	 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}	
		public static function select5($codigo_carro,$id_frecuencia) {
			$sql ="SELECT distinct a.medicamento, a.forma_farma, 
			b.descripcion, a.dosis_mostrar as dosis, 
			concat(a.cantidad_por_dosis, ' dosis de ',
			a.dosis ) as cantidad_mostrar , a.horas, 
			a.dias, a.linea, a.cantidad, a.observacion, 
			a.contra, a.observacion_farma, a.razon_observacion, 
			d.descripcion as desc_turno, c.historia, c.no_cama, 
			a.estado_producto, a.devolucion FROM factura_detalle a,
			formas_farmaceuticas b, factura c, frecuencia_turno d,
			preparacion_nave e where a.factura = e.factura  and
			a.forma_farma = b.codigo_forma and c.factura =
			a.factura and c.estado_factura in ('E', 'R', 'I') 
			and a.turno = d.id_frecuencia_turno and e.codigo_carro =
			'".$codigo_carro."' + 1 and e.linea = a.linea and e
			.id_frecuencia = '".$id_frecuencia."'
			order by no_cama
			";  	 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}	
		public static function select6($id_frecuencia) {
			$sql =	"select id_frecuencia, hora from preparacion_turno where id_frecuencia = 
			'".$id_frecuencia."' order by id_frecuencia"; 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}	
		public static function select7() {
			$sql ="select id_frecuencia, descripcion from 
			preparacion_turno order by id_frecuencia";	 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}	
		public static function select8($codigo_carro,$id_frecuencia) {
			$sql =	"SELECT distinct a.medicamento, a.forma_farma,
			b.descripcion, a.dosis_mostrar as dosis, concat
			(a.cantidad_por_dosis, ' dosis de ', a.dosis ) 
			as cantidad_mostrar , a.horas, a.dias, a.linea,
			a.cantidad, a.observacion, a.contra, a.observacion_farma,
			a.razon_observacion, d.descripcion as desc_turno, 
			c.historia, c.no_cama, a.estado_producto, a.devolucion 
			FROM factura_detalle a, formas_farmaceuticas b, factura c, 
			frecuencia_turno d, preparacion_nave e where a.factura = 
			e.factura and a.forma_farma = b.codigo_forma and c.factura =
			a.factura and c.estado_factura in ('E', 'R', 'I') 
			and a.turno = d.id_frecuencia_turno and e.codigo_carro = 
			'".$codigo_carro."' and e.linea = a.linea and e.id_frecuencia =
			'".$id_frecuencia."' union SELECT distinct a.medicamento, 
			a.forma_farma, b.descripcion, a.dosis_mostrar as dosis,
			concat(a.cantidad_por_dosis, ' dosis de ', a.dosis )
			as cantidad_mostrar , a.horas, a.dias, a.linea, a.cantidad,
			a.observacion, a.contra, a.observacion_farma, 
			a.razon_observacion, d.descripcion as desc_turno, 
			c.historia, c.no_cama, a.estado_producto, a.devolucion
			FROM factura_detalle a, formas_farmaceuticas b,
			factura c, frecuencia_turno d, preparacion_nave e 
			where a.factura = e.factura and a.forma_farma =
			b.codigo_forma and c.factura = a.factura and
			c.estado_factura in ('E', 'R', 'I') and a.turno = 
			d.id_frecuencia_turno and e.codigo_carro = 
			'".$codigo_carro."' and e.linea = a.linea and e.id_frecuencia =
			'".$id_frecuencia."' and c.stat_inicio = 'S'
			order by no_cama, medicamento";  
			$regis = conexion::sqlGet($sql);
			return $regis;
		}	
		public static function select9($codigo_carro,$id_frecuencia) {
			$sql =	"SELECT distinct a.medicamento, a.forma_farma, 
			b.descripcion, a.dosis_mostrar as dosis, 
			concat(a.cantidad_por_dosis, ' dosis de ', a.dosis ) 
			as cantidad_mostrar , a.horas, a.dias, a.linea,
			a.cantidad, a.observacion, a.contra, a.observacion_farma,
			a.razon_observacion, d.descripcion as desc_turno, 
			c.historia, c.no_cama, a.estado_producto, a.devolucion  
			FROM factura_detalle a, formas_farmaceuticas b, factura c, 
			frecuencia_turno d, preparacion_nave e where a.factura = 
			e.factura and a.forma_farma = b.codigo_forma and c.factura =
			a.factura and c.estado_factura in ('E', 'R', 'I') 
			and a.turno = d.id_frecuencia_turno and e.codigo_carro =
			'".$codigo_carro."' + 1 and e.linea = 
			a.linea and e.id_frecuencia = '".$id_frecuencia."'
			order by no_cama, medicamento
			";  
			$regis = conexion::sqlGet($sql);
			return $regis;
		}	
		public static function select10($id_frecuencia) {
			$sql ="select id_frecuencia, hora from preparacion_turno where id_frecuencia =
			'".$id_frecuencia."' order by id_frecuencia";	 
			$regis = conexion::sqlGet($sql);
			return $regis;
		}
	}
?>
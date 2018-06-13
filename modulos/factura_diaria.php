<?php
	require_once('../clases/conexion.php');
	
	class fdiaria{		
		
		public static function select1($user) {
			$reg = conexion::sqlGet("select a.caja_id, b.nombre from cajas_usuario a, cajas b where a.usuario = '".$user."' and a.caja_id = b.caja_id");			
			return $reg;
		}
		
		public static function select2($user) {
			$reg = conexion::sqlGet("select a.factura, a.fecha, a.nombre_cliente, a.id_paciente, round(a.total,2) as total, a.estado_factura, a.caja_id, a.equipo_fiscal, a.factura_fiscal from factura a where a.ordenado_por = '".$user."' and a.estado_factura in ('F', 'I') and a.fecha >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 DAY) order by a.fecha desc");			
			return $reg;
		}
		
		public static function update1($impresora,$impresora2,$id) {
			$sql = "update impresoras_fiscales set nombre_carpeta = '".$impresora."', nombre_carpeta2 = '".$impresora2."' where tipo_impresion='".$id."'";
			conexion::trQry($sql);
			return 1;
		}
		
	}
	
?>
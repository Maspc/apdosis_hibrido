<?php
	require_once('../clases/conexion.php');
	
	class histmov{
		
		public static function select1($medicamento_id,$fecha1,$fecha2) {
			$reg = conexion::sqlGet("select a.tipo,  a.medicamento_id,  a.id_interno,  a.id_hospital,  a.cantidad,  a.fecha,  a.precio_venta,  a.costo_compra, a.historia, a.cargo, a.tratamiento
			from historico_movimientos a where a.medicamento_id = '".$medicamento_id."' and a.fecha between '".$fecha1."' and '".$fecha2."' order by a.fecha, a.id_interno");			
			return $reg;
		}
		
	}
	
?>
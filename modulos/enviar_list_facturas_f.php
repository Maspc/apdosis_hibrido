<?php
	require_once('../clases/conexion.php');
	
	class enviarl {
		public static function select1($id_paciente,$desde,$hasta) {
			$sql ="select factura.cargo, factura.factura, factura.historia, 
			factura.fecha_creacion, factura.total, factura.no_cama, 
			registro.nombre_paciente, factura.fa, factura.factura_fiscal 
			from factura, registro where factura.historia = '".$id_paciente."' and 
			registro.historia = factura.historia and 
			registro.tratamiento = factura.tratamiento and registro.cargo = factura.cargo 
			and estado_factura = 'I' and date(factura.fecha) between '".$desde."' and '".$hasta."' 
			order by factura";	 
			$reg = conexion::sqlGet($sql);
			return $reg;
		}
		
	}
?>
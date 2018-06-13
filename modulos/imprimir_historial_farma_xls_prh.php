<?php
	require_once('../clases/conexion.php');
	
	class dimprimir_hfxp{
	
		public static function select1($historia) {
			$sql = "SELECT historia, nombre_paciente, tratamiento, 
			edad, peso, fecha_inicio
	        FROM tratamiento
	        WHERE tratamiento.estado ='A' 
	        AND tratamiento.historia = '".$historia."'";
			$reg = conexion::trQry($sql);
			return $reg;
		}
        public static function select2($historia,$tratamiento) {
			$sql ="select max(factura.fecha_proceso)
			as fecha_fin from factura_detalle, 
			factura where factura.historia = 
			'".$historia."' and factura.tratamiento = 
			'".$tratamiento."' and estado_producto !=
			'X' and factura.factura = factura_detalle.factura and
			factura.estado_factura in ('F', 'I', 'P')"; 
			$reg = conexion::trQry($sql);
			return $reg;
		}	
         public static function select3($historia) {
			$sql =  "SELECT historia, nombre_paciente, tratamiento, 
			edad, peso, fecha_inicio
        	FROM tratamiento
	        WHERE tratamiento.estado ='A' 
	        AND tratamiento.historia = '".$historia."'";
            $reg = conexion::trQry($sql);
			return $reg;
		}		
		public static function delete1($userid) {
			$sql = "delete from temp_perfil where usuario ='".$userid."'";
			$reg = conexion::trQry($sql);
			return $reg;
		}
		public static function select4($historia,$tratamiento,$mes) {
			$sql = "select factura_detalle.medicamento_id,
			sum(factura_detalle.cantidad - factura_detalle.devolucion) 
			as cantidad,  factura.fecha_proceso from factura_detalle,
			factura where factura.historia = '".$historia."' and 
			factura.tratamiento = '".$tratamiento."' 
			and estado_producto != 'X' and factura.factura = 
			factura_detalle.factura and factura.estado_factura 
			in ('F', 'P', 'I') and month(factura.fecha_proceso) = 
			'".$mes."' group by factura_detalle.medicamento_id, 
			factura.fecha_proceso order by factura_detalle.medicamento_id";
			$reg = conexion::trQry($sql);
			return $reg;
		}
		public static function insert1($medicamento_id,$cantidad,$fecha_proceso,$userid) {
			$sql = "insert into temp_perfil (medicamento_id, cantidad, 
			fecha_proceso, usuario) values ('".$medicamento_id."',
			'".$cantidad."',
			'".$fecha_proceso."','".$userid."' )";
			$reg = conexion::trQry($sql);
			return $reg;
		}	
			public static function delete1($userid) {
			$sql = "select distinct CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion) as nombre, temp_perfil.medicamento_id from temp_perfil, medicamentos, tipos_posologias, formas_farmaceuticas
			where medicamentos.codigo_interno = temp_perfil.medicamento_id
			and medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			and medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and temp_perfil.usuario = '".$userid."'
			order by temp_perfil.medicamento_id";
			$reg = conexion::trQry($sql);
			return $reg;
		}
		public static function select6($userid) {
			$sql = "select temp_perfil.medicamento_id, 
			sum(temp_perfil.cantidad) as cantidad,
			temp_perfil.fecha_proceso from temp_perfil
			where  temp_perfil.usuario = '".$userid."'
			group by temp_perfil.medicamento_id,temp_perfil.fecha_proceso
			order by temp_perfil.medicamento_id";
			$reg = conexion::trQry($sql);
			return $reg;
		}		
	}
	
?>
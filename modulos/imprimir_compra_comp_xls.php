<?php
	require_once('../clases/conexion.php');
	
	class imprimir{
		
		public static function select1($fecha1,$fecha2) {
			$reg = conexion::sqlGet("select a.id_compra, a.medicamento_id, a.fecha_proceso, c.nombre, b.id_proveedor, round(a.total,2) as total, round(a.impuesto_total,2) as impuesto_total, CONCAT( medicamentos.nombre_comercial,  ' ',  '(', medicamentos.nombre_generico,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' ', formas_farmaceuticas.descripcion, ' ', volumen, ' ',f.descripcion ) as nombre_producto from compras_detalle a, compras b, proveedor c, medicamentos, formas_farmaceuticas, tipos_posologias, tipos_posologias f where a.estado_proceso in ('F') and a.cantidad_entregada > 0 and a.id_compra = b.id_compra and b.id_proveedor = c.id_proveedor and a.total > 0  and a.medicamento_id = medicamentos.codigo_interno and medicamentos.tipo_posologia = tipos_posologias.codigo_posologia
			AND medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma
			and medicamentos.tipo_volumen = f.codigo_posologia and date(a.fecha_proceso) between '".$fecha1."' and '".$fecha2."'");			
			return $reg;
		}
		
	}
	
?>
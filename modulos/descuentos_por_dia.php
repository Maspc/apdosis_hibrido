<?php
	require_once('../clases/conexion.php');
	
	class dpordia{
		
		public static function ddescuento() {
			$ddescuento = conexion::sqlGet("select dia_id, nombre from dias_descuento");
			return $ddescuento;
		}
		
		public static function gmedica() {
			$gmedica = conexion::sqlGet("select codigo_grupo, descripcion, descuento_maximo from grupo_de_medicamentos");
			return $gmedica;
		}
		
		public static function gpordia($dia,$codigo_grupo) {
			$gpordia = conexion::sqlGet("select codigo_grupo, dia_id, porcentaje from grupos_por_dia_desc where dia_id = '".$dia."' and codigo_grupo = '".$codigo_grupo."'");
			return $gpordia;
		}
		
		public static function borra_pdia($dia) {
			conexion::trQry("delete from grupos_por_dia_desc where dia_id = '".$dia."'");
			return 1;
		}
		
		public static function guarda_pdia($codigo_grupo,$dia,$porcentaje,$user) {
			conexion::trQry("insert into grupos_por_dia_desc (codigo_grupo, dia_id, 
			porcentaje, usuario_modificacion, fecha_modificacion) values 
			('".$codigo_grupo."','".$dia."', '".$porcentaje."','".$user."',
			'". date("Y-m-d H:i",time())."')");
			return 1;
		}
	}
	
?>
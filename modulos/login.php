<?php
	require_once('../clases/conexion.php');
	
	class login{
		
		public static function cajas() {
			$cajas = conexion::sqlGet("SELECT caja_id, nombre FROM cajas WHERE estado = 'A'");
			return $cajas;
		} 
		
		public static function validaLogin($loginUsername,$password,$caja='') {
			$hora_actual = date("Y-m-d H:i",time());
			
			$LoginRS = conexion::sqlGet("SELECT user, tipo, nombre FROM usuarios WHERE user='".$loginUsername."' AND password='".$password."'");
			
			if ($caja!=''){
			conexion::trQry("delete from cajas_usuario where usuario='".$loginUsername."'");
			
			conexion::trQry("insert into cajas_usuario (caja_id, usuario, fecha_inicio) values ('".$caja."','".$loginUsername."','".$hora_actual."')");
			}
			
			return $LoginRS;
		}
	}
	
?>
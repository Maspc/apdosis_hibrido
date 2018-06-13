<?php	
	require_once('../clases/conexion.php');
	
	class usuarios{
		
		public static function select1($user) {
			$sql = "select user, nombre, password from usuarios where user ='".$user."'";
			$reg = conexion::sqlGet($sql);			
			return $reg;
		}
		
		public static function insert1($usuario,$nombre,$apellido,$contra,$tipo_usuario) {
			conexion::trQry("insert into usuarios (user,nombre, password, tipo,estado) values ('".$usuario."', concat('".$nombre."',' ','".$apellido."'), '".$contra."','".$tipo_usuario."', 'A')");			
			return 1;
		}
		
		public static function upadte1($nombre,$usuario) {
			conexion::trQry("update usuarios set nombre = '".$nombre."' where user = '".$usuario."'");			
			return 1;
		}
		
		public static function update2($contra,$usuario) {
			conexion::trQry("update usuarios set password = '".$contra."' where user = '".$usuario."'");			
			return 1;
		}
		
		public static function usuarios_edi() {
			$reg = conexion::sqlGet("select u.user, u.nombre, if(u.estado = 'A', 'Activo', 'Inactivo') as estado, u.tipo, t.descripcion from usuarios u, tipos_usuario t where u.user != 'admin' and u.tipo = t.codigo_tipo order by nombre");			
			return $reg;
		}
		
		public static function usuarios_edit($id) {
			$reg = conexion::sqlGet("select * from usuarios where user='".$id."'");			
			return $reg;
		}
		
		public static function t_usuarios() {
			$reg = conexion::sqlGet("select codigo_tipo, descripcion from tipos_usuario");			
			return $reg;
		}
		
		public static function update_eusu($nombre,$tipo,$estado,$id) {
			conexion::trQry("update usuarios set nombre = '".$nombre."', tipo = '".$tipo."', estado = '".$estado."' where user='".$id."'");			
			return 1;
		}
		
	}
	
?>
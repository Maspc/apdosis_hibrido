<?php
	require_once('../clases/conexion.php');
	
	class ffaclabel{		
		
		public static function select1($historia,$tratamiento) {
			$reg = conexion::sqlGet("select estado from tratamiento where historia = '".$historia."' and tratamiento = '".$tratamiento."' and estado='A'");			
			return $reg;
		}
		
		public static function insert1($historia,$numero_cama,$userid,$tratamiento,$nombre_paciente,$compania_de_seguro,$edad,$identificacion,$peso) {
			$sql = "insert into tratamiento_tmp (historia,habitacion,fecha_inicio, estado,usuario_creacion,fecha_creacion, tratamiento, nombre_paciente, compania_de_seguro, edad, id_paciente, peso) 
			values ('".$historia."', '".$numero_cama."', '".  date('Y-m-d H:i',time())."', 'A', '".$userid."', '". date('Y-m-d H:i',time()) ."', '".$tratamiento."', '".$nombre_paciente."', '".$compania_de_seguro."', '".$edad."', '".$identificacion."', '".$peso."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select2($historia,$tratamiento) {
			$reg = conexion::sqlGet("select cargo from registro where historia = '".$historia."' and tratamiento = '".$tratamiento."'");			
			return $reg;
		}
		
		public static function insert2($stat,$medico,$numero_cama,$userid,$historia,$registro,$tratamiento,$nombre_paciente,$compania_de_seguro,$tipo_paciente,$identificacion,$contraindicaciones,$peso,$edad) {
			$sql = "insert into registro_tmp (stat, estado, medico, no_cama, usuario_creacion, historia, fecha_creacion, id_tmp, tratamiento, nombre_paciente, compania_de_seguro, tipo_paciente, id_paciente, contraindicaciones, peso, edad)
			values ( '".$stat."', 'E', '".$medico."', '".$numero_cama."','".$userid."', '".$historia."','". date('Y-m-d H:i',time())."', '".$registro."', '".$tratamiento."', '".$nombre_paciente."', '".$compania_de_seguro."', '".$tipo_paciente."', '".$identificacion."', '".$contraindicaciones."', '".$peso."', '".$edad."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert3($registro,$userid,$numero_cama,$medico,$historia,$tratamiento,$despacho,$stat,$tipo_paciente,$banco,$localidad_actual,$localidad_entrega,$identificacion,$prn,$orden,$id_cliente) {
			$sql = "insert into factura_tmp  (cargo,
			ordenado_por,
			fecha,
			usuario_creacion,
			fecha_creacion,
			no_cama,
			medico,
			estado_factura ,
			historia,
			tratamiento,
			despacho, stat, tipo_paciente, bodega, localidad_actual, localidad_entrega, id_paciente, prn, FA, codigo_cliente, nombre_medico) values ('".$registro."', '".$userid."', '".date('Y-m-d H:i',time())."', '".$userid."', '".date('Y-m-d H:i',time())."',
			'".$numero_cama."', '".$medico."', 'E',  '".$historia."', '".$tratamiento."', '".$despacho."', '".$stat."', '".$tipo_paciente."', '".$banco."', '".$localidad_actual."', '".$localidad_entrega."', '".$identificacion."', '".$prn."', '".$orden."', '".$id_cliente."', '".$medico."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select3($historia,$tratamiento) {
			$reg = conexion::sqlGet("select max(linea) + 1 as linea_nueva from tratamiento_detalle where historia = '".$historia."' and tratamiento = '".$tratamiento."'");			
			return $reg;
		}
		
		public static function select4($medicamento_id) {
			$reg = conexion::sqlGet("select tipo_de_dosis, posologia, tipo_posologia, codigo_de_barra, volumen from medicamentos where codigo_interno ='".$medicamento_id."'");			
			return $reg;
		}
		
		public static function select5($tipo_posologia_orig) {
			$reg = conexion::sqlGet("select  descripcion from tipos_posologias where codigo_posologia = '".$tipo_posologia_orig."'");			
			return $reg;
		}
		
		public static function select6($dosis_tipo) {
			$reg = conexion::sqlGet("select tipo_grupo, descripcion from tipos_posologias where codigo_posologia = '".$dosis_tipo."'");			
			return $reg;
		}
		
		public static function select7($medicamento_id) {
			$reg = conexion::sqlGet("select antibiotico from medicamentos where codigo_interno = '".$medicamento_id."'");			
			return $reg;
		}
		
		public static function insert4($medicamento,$forma,$dosis,$dosis_num,$dosis_tipo,$horas,$dias,$medicamento_id,$linea,$cantidad,$cantidad_por_dosis,$cantidad_de_dosis,$intervalo_dosis,$historia,$tratamiento,$userid,$dosis_mostrar) {
			$sql = "insert into tratamiento_detalle_tmp(  medicamento,
			forma_farma,
			dosis,
			dosis_en_numero,
			tipo_de_dosis,
			horas,
			dias,
			medicamento_id,
			linea,
			cantidad_x_tratamiento,
			cantidad_x_dosis,
			cantidad_a_entregar,
			intervalo_dosis,
			fecha_creacion,
			estado,
			historia,
			tratamiento, usuario_creacion,dosis_mostrar)
			values ('".$medicamento."', '".$forma."','".$dosis."','".$dosis_num."','".$dosis_tipo."','".$horas."', '".$dias."','".$medicamento_id."','".$linea."','".$cantidad."', '".$cantidad_por_dosis."', '".$cantidad_de_dosis."', '".$intervalo_dosis."', '".date('Y-m-d H:i',time())."', 'P', '".$historia."', '".$tratamiento."', '".$userid."','".$dosis_mostrar."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select8($medicamento_id,$tratamiento,$historia) {
			$reg = conexion::sqlGet("select 'x' from registro_detalle where medicamento_id = '". $medicamento_id. "' and tratamiento = '".$tratamiento."' and cantidad_de_dosis > 0 and historia = '".$historia."' and estado != 'X'");			
			return $reg;
		}
		
		public static function insert5($medicamento,$forma,$dosis,$dosis_num,$dosis_tipo,$horas,$dias,$medicamento_id,$i,$cantidad,$cantidad_por_dosis,$cantidad_de_dosis,$intervalo_dosis,$userid,$cont,$tipo_cont,$registro,$historia,$tratamiento,$existe,$antibiotico,$obsermed,$dosis_mostrar,$precio) {
			$sql = "insert into registro_detalle_tmp(medicamento, forma_farma, dosis, dosis_num, dosis_tipo, horas, dias, medicamento_id, linea, cantidad, cantidad_x_dosis,cantidad_de_dosis, intervalo_dosis, usuario_creacion, contra, tipo_cont, estado, id_tmp, historia, tratamiento, existe,antibiotico, observacion, dosis_mostrar,precio_unitario)
			values ('".$medicamento."', '".$forma."','".$dosis."','".$dosis_num."','".$dosis_tipo."','".$horas."', '".$dias."','".$medicamento_id."','".$i."','".$cantidad."', '".$cantidad_por_dosis."', '".$cantidad_de_dosis."', '".$intervalo_dosis."', '".$userid."', '".$cont."', '".$tipo_cont."', 'E', '".$registro."', '".$historia."', '".$tratamiento."', '".$existe."', '".$antibiotico."','".$obsermed."', '".$dosis_mostrar."', '".$precio."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert6($medicamento,$forma,$dosis,$horas,$dias,$i,$identificacion,$registro,$medicamento_id,$cantidad_por_dosis,$intervalo_dosis,$historia,$tratamiento,$despacho,$userid,$obsermed,$tipo_cont,$dosis_mostrar) {
			$sql = "insert into factura_detalle_tmp (medicamento,
			forma_farma,
			dosis,
			horas,
			dias,
			linea,
			id_paciente,
			cargo,
			medicamento_id,
			cantidad,
			intervalo_dosis,
			historia,
			tratamiento,
			despacho, usuario_creacion, estado_producto, observacion, contra, dosis_mostrar, cantidad_por_dosis) values ('".$medicamento."', '".$forma."','".$dosis."','".$horas."', '".$dias."','".$i."','".$identificacion."','".$registro."','".$medicamento_id."','".$cantidad_por_dosis."', '".$intervalo_dosis."','".$historia."', '".$tratamiento."', '".$despacho."', '".$userid."','E', '".$obsermed."', '".$tipo_cont."', '".$dosis_mostrar."', '".$cantidad_por_dosis."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select9($userid) {
			$reg = conexion::sqlGet("select historia,habitacion,fecha_inicio, estado,usuario_creacion,fecha_creacion, tratamiento, nombre_paciente, compania_de_seguro, id_paciente from tratamiento_tmp where usuario_creacion='".$userid."'");			
			return $reg;
		}
		
		public static function select10($historia,$tratamiento) {
			$reg = conexion::sqlGet("select historia, tratamiento from tratamiento where historia = '".$historia."' and tratamiento = '".$tratamiento."' and estado = 'A'");
			return $reg;
		}
		
		public static function insert7($userid) {
			$sql = "insert into tratamiento (historia,habitacion,fecha_inicio, estado,usuario_creacion,fecha_creacion, tratamiento, nombre_paciente, compania_de_seguro, edad, id_paciente) select historia,habitacion,fecha_inicio, estado,usuario_creacion,fecha_creacion, tratamiento, nombre_paciente, compania_de_seguro, edad, id_paciente from tratamiento_tmp where usuario_creacion='".$userid."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert8($userid) {
			$sql = "insert into tratamiento_detalle (medicamento,
			forma_farma,
			dosis,
			dosis_en_numero,
			tipo_de_dosis,
			horas,
			dias,
			medicamento_id,
			cantidad_x_tratamiento,
			cantidad_x_dosis,
			cantidad_a_entregar,
			intervalo_dosis,
			fecha_creacion,
			estado,
			historia,
			tratamiento, dosis_mostrar) select medicamento,
			forma_farma,
			dosis,
			dosis_en_numero,
			tipo_de_dosis,
			horas,
			dias,
			medicamento_id,
			cantidad_x_tratamiento,
			cantidad_x_dosis,
			cantidad_a_entregar,
			intervalo_dosis,
			fecha_creacion,
			estado,
			historia,
			tratamiento, dosis_mostrar from tratamiento_detalle_tmp where usuario_creacion='".$userid."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert9($userid) {
			$sql = "Rinsert into registro (stat, estado, medico, no_cama, usuario_creacion, cargo, historia, tratamiento, nombre_paciente, compania_de_seguro, tipo_paciente, edad, id_paciente, contraindicaciones, peso)
			select stat, estado, medico, no_cama, usuario_creacion, id_tmp, historia, tratamiento, nombre_paciente, compania_de_seguro, tipo_paciente, edad, id_paciente, contraindicaciones, peso from registro_tmp where usuario_creacion='".$userid."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert10($userid) {
			$sql = "insert into registro_detalle(medicamento, forma_farma, dosis, dosis_num, dosis_tipo, horas, dias, medicamento_id, linea, cargo, cantidad, cantidad_x_dosis,cantidad_de_dosis, intervalo_dosis, estado, historia, tratamiento, tipo_cont, existe, contra, antibiotico, observacion, dosis_mostrar)
			select medicamento, forma_farma, dosis, dosis_num, dosis_tipo, horas, dias, medicamento_id, linea, id_tmp , cantidad, cantidad_x_dosis,cantidad_de_dosis, intervalo_dosis, estado, historia, tratamiento, tipo_cont, existe, contra, antibiotico, observacion, dosis_mostrar from registro_detalle_tmp where usuario_creacion='".$userid."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert11($userid) {
			$sql = "insert into factura (cargo,
			ordenado_por,
			fecha,
			usuario_creacion,
			fecha_creacion,
			no_cama,
			medico,
			estado_factura ,
			historia,
			tratamiento,
			despacho, stat, tipo_paciente, bodega, localidad_actual, localidad_entrega, id_paciente, prn, FA, codigo_cliente, nombre_medico) select cargo,
			ordenado_por,
			fecha,
			usuario_creacion,
			fecha_creacion,
			no_cama,
			medico,
			estado_factura ,
			historia,
			tratamiento,
			despacho, stat, tipo_paciente, bodega, localidad_actual, localidad_entrega, id_paciente, prn, FA, codigo_cliente, nombre_medico from factura_tmp where usuario_creacion = '".$userid."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select11($userid) {
			$reg = conexion::sqlGet("SELECT max(factura) AS fact FROM factura where usuario_creacion = '".$userid."'");
			return $reg;
		}
		
		public static function insert12($historia,$obs,$userid,$fact) {
			$sql = "insert into historias (historia, observacion, usuario, factura) values ('".$historia."', '".$obs."', '".$userid."', '".$fact."')";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert13($fact,$userid) {
			$sql = "insert into factura_detalle(medicamento,
			forma_farma,
			dosis,
			horas,
			dias,
			linea,
			cargo,
			medicamento_id,
			cantidad,
			intervalo_dosis,
			historia,
			tratamiento,
			despacho, factura, estado_producto, observacion, contra,dosis_mostrar, cantidad_por_dosis) select medicamento,
			forma_farma,
			dosis,
			horas,
			dias,
			linea,
			cargo,
			medicamento_id,
			cantidad,
			intervalo_dosis,
			historia,
			tratamiento,
			despacho, ".$fact.", estado_producto, observacion, contra,dosis_mostrar, cantidad_por_dosis from factura_detalle_tmp where usuario_creacion = '".$userid."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function select12($fact) {
			$reg = conexion::sqlGet("select factura_detalle.linea, factura_detalle.despacho, factura_detalle.cantidad, factura_detalle.intervalo_dosis, medicamentos.precio_unitario,   medicamentos.tipo_de_dosis from factura_detalle, medicamentos, grupo_de_medicamentos where factura='".$fact."' and medicamentos.codigo_interno = factura_detalle.medicamento_id");
			return $reg;
		}
		
		public static function insert14($cantidad2,$precio_venta3,$precio_unitario2,$fact,$linea2) {
			$sql = "update factura_detalle set cantidad = '".$cantidad2."' ,precio_venta = '".$precio_venta3."', precio_unitario = '".$precio_unitario2."', average='1'  where factura='".$fact."' and linea = '".$linea2."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function insert15($precio_total2,$fact) {
			$sql = "update factura set total = '".$precio_total2."' where factura = '".$fact."'";
			conexion::trQry($sql);
			return 1;
		}
		
		public static function delete1($userid) {
			conexion::trQry("delete from registro_tmp where usuario_creacion = '".$userid."'");
			
			conexion::trQry("delete from registro_detalle_tmp where usuario_creacion = '".$userid."'");
			
			conexion::trQry("delete from tratamiento_tmp where usuario_creacion = '".$userid."'");
			
			conexion::trQry("delete from tratamiento_detalle_tmp where usuario_creacion = '".$userid."'");
			
			conexion::trQry("delete from factura_tmp where usuario_creacion = '".$userid."'");
			
			conexion::trQry("delete from factura_detalle_tmp where usuario_creacion = '".$userid."'");
			
			return 1;
		}
		
		public static function select13($factura) {
			$reg = conexion::sqlGet("SELECT b.medico
			FROM  factura b
			WHERE b.factura = '".$factura."'
			and b.estado_factura = 'E'");
			return $reg;
		}
		
		public static function select14($medico) {
			$reg = conexion::sqlGet("select nombre from medicos where codigo_medico = '".$medico."'");
			return $reg;
		}
		
		public static function select15($factura) {
			$reg = conexion::sqlGet("select f.codigo_de_barra, a.medicamento, a.medicamento_id, a.horas, a.dias, b.historia, c.nombre_paciente nom_paciente, b.no_cama, b.medico, b.nombre_medico, a.linea, b.fecha, a.cantidad, b.localidad_entrega, a.dosis_mostrar as dosis, a.average, a.observacion, b.id_paciente from factura_detalle a, factura b, registro c, tratamiento e, medicamentos f
			where a.factura = '".$factura."'  and a.cargo = c.cargo and a.factura = b.factura and b.historia = c.historia and a.tratamiento = e.tratamiento and b.tratamiento = e.tratamiento and c.tratamiento = e.tratamiento and a.historia = e.historia and e.estado = 'A' and f.codigo_interno = a.medicamento_id");
			return $reg;
		}
	}
	
?>		
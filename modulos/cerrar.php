<?php
	require_once('../clases/conexion.php');
	
	class cerrar{
		
		public static function select1($carro) {
			$reg = conexion::sqlGet("select distinct factura_detalle.factura, factura_detalle.hora_evento_carro
			from factura_detalle, registro, factura where 
			factura_detalle.codigo_carro = '".$carro."' and
			factura_detalle.historia = registro.historia and 
			factura_detalle.tratamiento = registro.tratamiento 
			and factura_detalle.cargo = registro.cargo 
			and registro.estado not in ('C', 'F', 'X') and 
			factura.factura = factura_detalle.factura and 
			factura.estado_factura not in ('X', 'P') and 
			factura_detalle.estado_producto != 'X' and
			factura_detalle.linea > 0");
			return $reg;
		}
		
		public static function select2($carro) {
			$reg = conexion::sqlGet("select distinct factura_detalle.factura,
			factura_detalle.hora_evento_carro
			from factura_detalle, registro, factura where codigo_carro = 
			'".$carro."' and factura_detalle.cargo = registro.cargo and
			factura_detalle.historia = registro.historia
			and factura_detalle.tratamiento = registro.tratamiento and
			registro.estado not in ('C', 'F', 'X') and factura.factura = 
			factura_detalle.factura and factura.stat != 'S'");
			return $reg;
		}
		public static function select3($factura) {
			$reg = conexion::sqlGet("SELECT factura_detalle.medicamento,  
			factura_detalle.dosis, factura_detalle.horas,
			factura_detalle.dias, factura_detalle.linea,
			factura_detalle.cargo, factura_detalle.cantidad,
		    factura_detalle.medicamento_id, 
			factura_detalle.hora_evento_carro,
			factura_detalle.intervalo_dosis, factura_detalle.codigo_carro,
			factura_detalle.codigo_carro,  factura_detalle.factura, 
			factura_detalle.tratamiento, factura_detalle.historia,
			factura_detalle.cargo, registro_detalle.cantidad_de_dosis as 
			cant_total, factura_detalle.observacion, factura_detalle.average
			FROM factura_detalle,  registro_detalle 
			where factura = '".$factura."'
			and registro_detalle.historia = factura_detalle.historia
			and registro_detalle.tratamiento = factura_detalle.tratamiento
			and registro_detalle.cargo = factura_detalle.cargo
			and registro_detalle.linea = factura_detalle.linea
			and estado_producto = 'P' 
			order by factura_detalle.linea");
			return $reg;
		}
		public static function update1($historia,$tratamiento,$despacho,$medicamento_id) {
			$sql = "update registro_detalle set estado = 'F',
			cantidad_de_dosis = '0' where historia =
			'".$historia."' and tratamiento = 
			'".$tratamiento."' and cargo =
			'".$despacho."' and medicamento_id = 
			'".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function update2($average,$historia,$tratamiento,$despacho,$medicamento_id) {
			$sql = "update registro_detalle set cantidad_de_dosis =
			cantidad_de_dosis -
			'".$average."', vuelta = 'F' where historia =
			'".$historia."' and tratamiento =
			'".$tratamiento."' and cargo = 
			'".$despacho."' and medicamento_id = 
			'".$medicamento_id."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function select4($historia,$tratamiento,$despacho) {
			$reg = conexion::sqlGet("select sum(cantidad_de_dosis) as
			valido from registro_detalle where historia = 
			'" .$historia . "' and tratamiento = 
			'".$tratamiento."' and cargo = 
			'".$despacho."'");
			return $reg;
		}
		public static function update3($historia,$tratamiento,$despacho) {
			$sql = "update registro set estado = 'F' where historia = 
			'" .$historia. "' and tratamiento = 
			'".$tratamiento."' and cargo =
			'".$despacho."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function update4($hora_actual_S,$MM_iduser,$carro) {
			$sql ="update eventos_carros set estado = 'F', 
			fecha_cierre_nave = 
			'".$hora_actual_S."', usuario_cierre_nave=
			'".$MM_iduser."' where codigo_carro=
			'".$carro."'"; 
			conexion::trQry($sql);
			return 1;
		}
		public static function select5($carro) {
			$reg = conexion::sqlGet("select intervalo1 from eventos_carros
			where codigo_carro='".$carro."'");
			return $reg;
		}
		public static function select6($carro) {
			$reg = conexion::sqlGet( "select distinct
			factura_detalle.factura, factura_detalle.hora_evento_carro
			from factura_detalle, registro, factura 
			where factura_detalle.codigo_carro = '".$carro."' 
			and factura.factura = factura_detalle.factura 
			and factura.stat != 'S' 
			and factura.estado_factura != 'X'
			and factura_detalle.historia = registro.historia
			and factura_detalle.tratamiento = registro.tratamiento
			and factura_detalle.cargo = registro.cargo
			and registro.estado not in ('C','F','X')");
			return $reg;
		}
		
		public static function delete1() {			
			conexion::trQry("delete from temp_factura_detalle");
			return 1;
		}
		public static function select7($factura) {
			$reg = conexion::sqlGet("select factura_detalle.linea,
			factura_detalle.despacho,registro_detalle.cantidad_x_dosis as 
			cantidad, 	factura_detalle.intervalo_dosis,
			medicamentos.precio_unitario, factura_detalle.factura, 
			registro_detalle.cantidad_de_dosis,
			factura_detalle.cantidad_por_dosis,
			medicamentos.tipo_de_dosis, 
		    factura_detalle.hora_evento_carro,
			factura_detalle.hora_ultima_dosis, factura_detalle.turno 
			from factura_detalle, medicamentos,registro_detalle 
			where factura='".$factura."' 
			and registro_detalle.historia = factura_detalle.historia 
			and registro_detalle.tratamiento = factura_detalle.tratamiento 
			and registro_detalle.cargo = factura_detalle.cargo 
			and registro_detalle.linea = factura_detalle.linea
		    and factura_detalle.medicamento_id = medicamentos.codigo_interno  
		    and registro_detalle.medicamento_id = 
			factura_detalle.medicamento_id ");
			$precio_total = 0);
			return $reg;
			
		}
		public static function insert1($hora_actual_n) {
			$sql ="insert into temp_hora_actual (hora_actual)
			values ('".$hora_actual_n."')";
			conexion::trQry($sql);
			return 1;
		}
		public static function select8() {
			$reg = conexion::sqlGet("select hora_actual from 
			temp_hora_actual");
			return $reg;
		}
		public static function select9($hora_actual_b) {
			$reg = conexion::sqlGet("select codigo_carro,
			intervalo1, intervalo2, estado from eventos_carros where 
			'".$hora_actual_b."'  >= DATE_ADD(intervalo1,
			INTERVAL 1 HOUR)  and 
			'".$hora_actual_b."' < DATE_ADD(intervalo2, INTERVAL 1 HOUR)");
			return $reg;
		}
		public static function select10($codigo_carro) {
			$reg = conexion::sqlGet("select intervalo1 from
			eventos_carros where codigo_carro = '".$codigo_carro."'
			and estado='P'");
			return $reg;
		}
		public static function delete2() {
			
			conexion::trQry( "delete from temp_hora_actual");
			return 1;
		}
		public static function select11($codigo_carro) {
			$reg = conexion::sqlGet("select intervalo1, 
			intervalo2 from eventos_carros where codigo_carro =
			'".$codigo_carro."'");
			return $reg;
		}
		public static function insert2($factu,$lin, $codigo_carro, $hora_evento_carro, $cantidad_f, $precio_venta1,$precio_unitario,$average, $hora_ultima_dosis_2 ) {
			$sql = "insert into temp_factura_detalle(factura, linea, 
			codigo_carro, hora_evento_carro,cantidad,
			precio_venta, precio_unitario, average, 
			hora_ultima_dosis) values (
			'".$factu."',
			'".$lin."', 
			'".$codigo_carro."', 
			'".$hora_evento_carro."', 
			'".$cantidad_f."', 
			'".$precio_venta1."',
			'".$precio_unitario."',
			'".$average."', 
			'".$hora_ultima_dosis_2."' )";
			conexion::trQry($sql);
			return 1;
		}
		public static function select12() {
			$reg = conexion::sqlGet( "select distinct codigo_carro 
			from temp_factura_detalle");
			return $reg;
		}
		public static function select13($factu) {
			$reg = conexion::sqlGet( "select historia, cargo,
			despacho from factura_detalle where factura = '".$factu."'");
			return $reg;
		}
		public static function select14($codigo_carro,$historia_rep,$cargo_rep,$despacho_rep) {
			$reg = conexion::sqlGet("select 1 from factura_detalle where 
			codigo_carro =
			'".$codigo_carro."' and historia = 
			'".$historia_rep."' and cargo = 
			'".$cargo_rep."' and despacho = 
			'".$despacho_rep."'");
			return $reg;
		}
		public static function insert3($factu) {
			$sql ="insert into factura (cargo,ordenado_por,fecha,
		    usuario_creacion,fecha_creacion,no_cama,medico,
			estado_factura ,historia,tratamiento,
			despacho, stat, localidad_actual, localidad_entrega, 
			tipo_paciente, bodega, id_paciente) select cargo,
			ordenado_por,fecha,usuario_creacion,
			fecha_creacion,no_cama,medico,'R',historia,
			tratamiento,(despacho + 1), stat, localidad_actual,
			localidad_entrega, tipo_paciente, bodega, id_paciente
			from factura where factura = '".$factu."'";
			$id = conexion::trQryId($sql);
			return $id;
		}
		public static function select15($codigo_carro) {
			$reg = conexion::sqlGet( "select factura, linea, codigo_carro,
			hora_evento_carro,cantidad, precio_venta, precio_unitario, 
			average, hora_ultima_dosis from temp_factura_detalle where 
			codigo_carro = '".$codigo_carro."'");
			return $reg;
		}
		public static function insert4($cantidad,$fact,$precio_unitario,$precio_venta,$codigo_carro, $hora_evento_carro,$average,$hora_ultima_dosis,$factu,$linea) {
			$sql ="insert into factura_detalle(medicamento,
			forma_farma,dosis,horas,dias,linea,cargo,medicamento_id,
			cantidad,intervalo_dosis,historia,tratamiento,
			despacho, factura, precio_unitario, precio_venta, 
			estado_producto, dosis_mostrar, cantidad_por_dosis,
			codigo_carro, hora_evento_carro,average, hora_ultima_dosis, 
			observacion, observacion_farma,contra, turno) select
			factura_detalle.medicamento,factura_detalle.forma_farma,
			factura_detalle.dosis,factura_detalle.horas, 
			factura_detalle.dias,factura_detalle.linea,
			factura_detalle.cargo,factura_detalle.medicamento_id,
			'".$cantidad."',factura_detalle.intervalo_dosis,
			factura_detalle. historia,factura_detalle.tratamiento,
			(factura_detalle.despacho + 1),
			'".$fact."', 
			'".$precio_unitario."', 
			'".$precio_venta."', 'E', 
			factura_detalle.dosis_mostrar, factura_detalle.cantidad_por_dosis,
			'".$codigo_carro."', 
			'".$hora_evento_carro."', 
			'".$average."', '".$hora_ultima_dosis."',
			factura_detalle.observacion, factura_detalle.observacion_farma,
			factura_detalle.contra, factura_detalle.turno from factura_detalle,
			registro_detalle, medicamentos 
			where factura_detalle.factura = '".$factu."' 
			and factura_detalle.linea = '".$linea."' 
			and registro_detalle.historia = factura_detalle.historia 
			and registro_detalle.tratamiento = factura_detalle.tratamiento 
			and registro_detalle.cargo = factura_detalle.cargo   
			and registro_detalle.linea = factura_detalle.linea 
			and registro_detalle.estado not in ('F','X')   
			and medicamentos.codigo_interno = factura_detalle.medicamento_id 
			and medicamentos.tipo_mercancia != '3'";
			conexion::trQry($sql);
			return 1;
		}
		public static function select16($fact) {
			$reg = conexion::sqlGet("select sum(precio_venta) as
			prec from factura_detalle where factura = '".$fact."'");
			return $reg;
		}
		public static function update5($prec,$fact) {
			$sql ="update factura set total=
			'".$prec."' where factura =
			'".$fact."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function select17($carro) {
			$reg = conexion::sqlGet("select factura_detalle.codigo_carro, 
			factura_detalle.cargo, factura_detalle.medicamento, 
			factura_detalle.cantidad, 
			factura_detalle.linea, factura_detalle.hora_evento_carro,
			factura_detalle.intervalo_dosis, 
			registro.no_cama, registro.nombre_paciente, 
			factura_detalle.factura, factura_detalle.historia, factura.FA
			from factura_detalle, registro, factura 
			where factura_detalle.codigo_carro = '".$carro."' 
			and factura.factura = factura_detalle.factura
			and factura.historia = registro.historia
			and factura.tratamiento = registro.tratamiento 
			and factura.cargo = registro.cargo 
			and estado_producto != 'X'  
			and factura.estado_factura != 'X'
			and factura.stat != 'S' 
			order by historia");
			return $reg;
		}
		public static function insert5($hora_actual_n) {
			$sql ="insert into temp_hora_actual (hora_actual) 
			values ('".$hora_actual_n."')";
			conexion::trQry($sql);
			return 1;
		}
		public static function select18() {
			$reg = conexion::sqlGet("select hora_actual from 
			temp_hora_actual");
			return $reg;
		}
		public static function select19($hora_actual_b) {
			$reg = conexion::sqlGet("select codigo_carro, intervalo1, 
			intervalo2, estado from eventos_carros where
			'".$hora_actual_b."'  >= DATE_ADD(intervalo1, INTERVAL 1 HOUR)  and 
			'".$hora_actual_b."'  < DATE_ADD(intervalo2, INTERVAL 1 HOUR)");
			return $reg;
		}
		public static function select20($codigo_carro) {
			$reg = conexion::sqlGet("select intervalo1 from eventos_carros 
			where codigo_carro = '".$codigo_carro."' and estado='P'");
			return $reg;
		}
        public static function delete3() {
			
			conexion::trQry( "delete from temp_hora_actual");
			return 1;
		}
		public static function update6($codigo_carro,$factura) {
			$sql ="update factura set carro =
			'".$codigo_carro."' - 1 where factura = 
			'".$factura."'";
			conexion::trQry($sql);
			return 1;
		}
        public static function insert6($carro,$factura,$linea) {
			$sql ="insert into registro_carros (codigo_carro, 
			factura, linea) values ('".$carro."','".$factura."','".$linea."')";
			conexion::trQry($sql);
			return 1;
		}
        public static function select21($carro) {
			$reg = conexion::sqlGet("select distinct factura from
			registro_carros where codigo_carro = '".$carro."'");
			return $reg;
		}
		public static function update7($factu) {
			$sql ="update factura set estado_factura = 'F' where factura
			= '".$factu."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function select22($factu) {
			$reg = conexion::sqlGet("select linea, cantidad, 
			(factura_detalle.precio_unitario + factura_detalle.costo_insumo 
			+ factura_detalle.impuesto) as precio_unitario,
			factura_detalle.preparacion, medicamento_id, 
			medicamento,historia, medicamentos.tipo_de_dosis from 
			factura_detalle, medicamentos where factura = '".$factu."'
			and factura_detalle.medicamento_id = 
			medicamentos.codigo_interno and estado_producto != 'X'
			order by factura_detalle.linea_adic");
			return $reg;
		}
		public static function insert7($factu) {
			$sql ="insert into logs_errores (codigo_error, id_interno_fac)
			values ('FAULTCIERRE', '".$factu."')";
			conexion::trQry($sql);
			return 1;
		}
		public static function insert8($factu) {
			$sql ="insert into logs_errores (codigo_error, id_interno_fac)
			values ('ERRCIERRE', '".$factu."')";
			conexion::trQry($sql);
			return 1;
		}
		public static function update8($documento,$factu) {
			$sql ="update factura set FA=
			'".$documento."', estado_envio = 'S', hora_primer_fa = '".date('Y-m-d H:i',time())."' where factura = 
			'".$factu."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function insert9($documento,$factu) {
			$sql ="insert into logs_errores (codigo_error, id_interno_fac) 
			values ('".$documento."', '".$factu."')";
			conexion::trQry($sql);
			return 1;
		}
		public static function update9($documento_f,$factu) {
			$sql ="update factura set FA=
			'".$documento_f."', estado_envio = 'S', hora_primer_fa = '".date('Y-m-d H:i',time())."' where factura =
			'".$factu."'";
			conexion::trQry($sql);
			return 1;
		}
		public static function insert10($documento,$factu) {
			$sql ="insert into logs_errores (codigo_error, id_interno_fac)
			values ('".$documento."', '".$factu."')";
			conexion::trQry($sql);
			return 1;
		}
		public static function insert11($documento,$factu) {
			$sql ="insert into logs_errores (codigo_error, id_interno_fac) values 
			('".$documento."', '".$factu."')";
			conexion::trQry($sql);
			return 1;
		}
		public static function insert12($documento,$factu) {
			$sql ="insert into logs_errores (codigo_error, id_interno_fac) values
			('".$documento."', '".$factu."')";
			conexion::trQry($sql);
			return 1;
		}
		public static function select23($carro) {
			$reg = conexion::sqlGet("select factura_detalle.codigo_carro, 
			factura_detalle.cargo, factura_detalle.medicamento, 
			factura_detalle.cantidad, 
			factura_detalle.linea, factura_detalle.hora_evento_carro,
			factura_detalle.intervalo_dosis, 
			registro.no_cama, registro.nombre_paciente, 
			factura_detalle.factura, factura_detalle.historia, factura.FA
			from factura_detalle, registro, factura 
			where factura_detalle.codigo_carro = '".$carro."' 
			and factura.factura = factura_detalle.factura 
			and factura_detalle.historia = registro.historia
			and factura_detalle.tratamiento = registro.tratamiento 
			and factura_detalle.cargo = registro.cargo 
			and factura_detalle.estado_producto != 'X' 
			and factura.estado_factura != 'X' 
			and factura.stat != 'S' order by historia");
			return $reg;
		}
		public static function delete4() {
			
			conexion::trQry( "delete from temp_fact");
			return 1;
		}
	}
	
?>
<?php 
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/enviar_factura_cargos.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	$userid=$_SESSION['MM_iduser'];
	
	/*if (isset($_POST['userid'])){
		$userid = $_POST['userid'];
		}
		if (isset($_POST['session'])){
		$session = $_POST['session'];
		}
		if (isset($_POST['username'])){
		$username = $_POST['username'];
		}
		
		include('sesion_activa.php');
		//sesionActiva($userid, $session);
		if ($estado_sesion == 'A') {
	*/
	//require_once('lib/nusoap.php');
	//include ('seguridad.php');  
	error_reporting(E_ALL & ~E_NOTICE);
	if (isset($_POST['codigo_cliente'])) { 
	$codigo_cliente = $_POST['codigo_cliente'];}
	if (isset($_POST['nombre_cliente'])) { 
	$nombre_cliente = $_POST['nombre_cliente'];}
	if (isset($_POST['jubilado'])) { 
	$jubilado = $_POST['jubilado'];}
	if (isset($_POST['cedula'])) { 
	$identificacion = $_POST['cedula'];}
	if (isset($_POST['codigo_aseguradora'])) { 
	$codigo_aseguradora = $_POST['codigo_aseguradora'];}
	if (isset($_POST['porcentaje_desc'])) { 
	$porcentaje_desc = $_POST['porcentaje_desc'];}
	if (isset($_POST['sub_total'])) { 
	$sub_total = $_POST['sub_total'];}
	if (isset($_POST['total'])) { 
	$total = $_POST['total'];}
	if (isset($_POST['itbms_total'])) { 
	$itbms_total = $_POST['itbms_total'];}
	if (isset($_POST['descuento_total'])) { 
	$descuento_total = $_POST['descuento_total'];}
	if (isset($_POST['efectivo'])) { 
	$efectivo = $_POST['efectivo'];}
	if (isset($_POST['clave'])) { 
	$clave = $_POST['clave'];}
	if (isset($_POST['tarjeta_credito'])) { 
	$tarjeta_credito = $_POST['tarjeta_credito'];}
	if (isset($_POST['credito'])) { 
	$credito = $_POST['credito'];}
	if (isset($_POST['vuelto'])) { 
	$vuelto = $_POST['vuelto'];}
	if (isset($_POST['cheque'])) { 
	$cheque = $_POST['cheque'];}
	if (isset($_POST['no_cheque'])) { 
	$no_cheque = $_POST['no_cheque'];}
	if (isset($_POST['nombre_banco'])) { 
	$nombre_banco = $_POST['nombre_banco'];}
	if (isset($_POST['ref_tdc'])) { 
	$ref_tdc = $_POST['ref_tdc'];}
	if (isset($_POST['ref_tdb'])) { 
	$ref_tdb = $_POST['ref_tdb'];}
	if (isset($_POST['vuelto'])) { 
	$vuelto = $_POST['vuelto'];}
	
	if (isset($_POST['userid'])) { 
	$userid = $_POST['userid'];}
	if (isset($_POST['session'])) { 
	$session = $_POST['session'];}
	if (isset($_POST['var_cont'])){
		$var_cont = $_POST['var_cont'];
	}
	
	//echo "entre<p>";
	
	$blanco = 0;
	
	if($var_cont == 0){
		echo "<script language='javascript'>window.location='borrar_error_blanco.php?userid=".$userid."'</script>";
		$blanco = 1;
		
	}
	
	if($blanco == 0){
		//Verifico que no haya nada en los temporales
		
		/*$f = "select historia, usuario_creacion from registro_tmp where historia = '$historia'";
			
			$fres = mysql_query($f, $conn) or die(mysql_error());
			
			$fcount = mysql_num_rows($fres);
			
			if ($fcount > 0) {
			while($frow = mysql_fetch_array($fres) ){
			$usu_crea = $frow['usuario_creacion'];
			$g = "select sesion from logs_usuarios where codigo_usuario = '$usu_crea'";
			$gres = mysql_query($g, $conn) or die(mysql_error());
			while($grow = mysql_fetch_array($gres) ){
			$ses = $grow['sesion'];
			
			//Llamo al webservice para verificar la sesion activa
			
			require_once('lib/nusoap.php');
			
			$client1 = new nusoap_client('http://192.168.3.2/wsAppDosis_CMP/wsAppDosis_Listas.asmx?WSDL', true);//set your dot net web service url
			
			$err = $client1->getError();
			
			if ($err) {
			
			// error if any
			
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			
			}
			
			// Call mathod
			//  echo "userid: ".$userid;
			//echo "</br>session: ".$session;
			
			$result1 = $client1->call('Session_Activa', array('UserId' => $usu_crea, 'Session' => $ses));
			
			// fault if any
			
			if ($client1->fault) {
			
			// echo '<h2>Fault</h2><pre>';
			
			print_r($result1);
			
			//  echo '</pre>';
			
			} else {
			
			// Check for errors
			
			$err = $client1->getError();
			
			if ($err) {
			
			// Display the error
			
			//   echo '<h2>Error</h2><pre>' . $err . '</pre>';
			
			} else {
			
			// Display the result
			
			//echo '<h2>Result</h2><pre>';
			//print_r($result1);
			
			
			
			$estado_sesion1 = $result1['Session_ActivaResult'];
			
			//echo "Estado: ".$estado;
			// if ($estado_sesion == 'I') 
			//{
			/*echo "<script language='javascript'>window.location='http://192.168.3.2/cmp_appdosis/'</script>";
		}*/
		
		
		
		// echo '</pre>';
		
		/*  }
			
			}
			
			// echo "estado sesion1 : ".$estado_sesion1;
			if ($estado_sesion1 == 'A') {
			//echo "la sesion anterior esta activa";
			$r = "delete from registro_tmp where usuario_creacion = '$userid'";
			
			$res = mysql_query($r, $conn) or die(mysql_error());
			
			
			$rd = "delete from registro_detalle_tmp where usuario_creacion = '$userid'";
			
			$resd = mysql_query($rd, $conn) or die(mysql_error());
			
			
			$re = "delete from tratamiento_tmp where usuario_creacion = '$userid'";
			
			$red = mysql_query($re, $conn) or die(mysql_error());
			
			$rg = "delete from tratamiento_detalle_tmp where usuario_creacion = '$userid'";
			
			$rgd = mysql_query($rg, $conn) or die(mysql_error());
			
			$rl = "delete from factura_tmp where usuario_creacion = '$userid'";
			
			$rel = mysql_query($rl, $conn) or die(mysql_error());
			
			$rf = "delete from factura_detalle_tmp where usuario_creacion = '$userid'";
			
			$rfd = mysql_query($rf, $conn) or die(mysql_error());
			echo "<script language='javascript'>window.location='borrar_historia.php?userid=".$userid."&usu_crea=".$usu_crea."&historia=".$historia."'</script>";
			
			} else {
			
			$r = "delete from registro_tmp where usuario_creacion = '$usu_crea'";
			
			$res = mysql_query($r, $conn) or die(mysql_error());
			
			
			$rd = "delete from registro_detalle_tmp where usuario_creacion = '$usu_crea'";
			
			$resd = mysql_query($rd, $conn) or die(mysql_error());
			
			
			$re = "delete from tratamiento_tmp where usuario_creacion = '$usu_crea'";
			
			$red = mysql_query($re, $conn) or die(mysql_error());
			
			$rg = "delete from tratamiento_detalle_tmp where usuario_creacion = '$usu_crea'";
			
			$rgd = mysql_query($rg, $conn) or die(mysql_error());
			
			$rl = "delete from factura_tmp where usuario_creacion = '$usu_crea'";
			
			$rel = mysql_query($rl, $conn) or die(mysql_error());
			
			$rf = "delete from factura_detalle_tmp where usuario_creacion = '$usu_crea'";
			
			$rfd = mysql_query($rf, $conn) or die(mysql_error());
			
			}
			
			
			}
			
			
			}
			
			}
			
			
			
			
		/*******************************************************/
		
		
		
		
		
		
		
		/*
			if ($mostrar_banco == 'S') {
			$stat = 'S';
			} else {
			$banco = '1';
			$mostrar_banco = 'N'; }
		*/
		
		//echo "valor de mostrar banco: ".$mostrar_banco;
		
		//busco si tenia un tratamiento existente
		//echo "1";
		//echo "VAR CONT!!!!!! ".$var_cont."<p>";
		
		//echo "pase por aqui";
		
		$stat = 'S';
		
		$banco = '1';
		
		$tratamiento = '-1';
		/*
			$t = "select estado from tratamiento where historia = '$historia' and tratamiento = '$tratamiento' and estado='A'";
			
			$rest = mysql_query($t, $conn) or die(mysql_error());
			//$tratamiento = 0;
			$restnum = mysql_num_rows($rest);
			
			if ($restnum == 0) {
			
			//$tratamiento = 1;
			
			//echo "userid ".$userid;
			echo "tratamiento ".$tratamiento; 
			
			//echo "3";
			//echo "<p>el tratamiento es ".$tratamiento;
			//echo "<p>1";
			$x = "insert into tratamiento_tmp (historia,habitacion,fecha_inicio, estado,usuario_creacion,fecha_creacion, tratamiento, nombre_paciente, compania_de_seguro, edad, id_paciente, peso) 
			values ('$historia', '$numero_cama', '".  date('Y-m-d H:i',time())."', 'A', '$userid', '". date('Y-m-d H:i',time()) ."', '$tratamiento', '$nombre_paciente', '$compania_de_seguro', $edad, '$identificacion', '$peso' )";
			$resx = mysql_query($x, $conn); //or die(mysql_error());
			//echo "error: ".mysql_errno();
			
			if (mysql_errno() == 1062) {
			
			echo "<script language='javascript'>window.location='borrar_error.php?userid=".$userid."'</script>";
			
			}
			
			
			
			} 
			
			
			
			if ($tratamiento == 0) {
			$tratamiento = '-1';
			}
			
			
			//echo "<p>2";
			$y = "select cargo from registro where historia = '$historia' and tratamiento = '$tratamiento'";
			
			$resy = mysql_query($y, $conn) or die(mysql_error());
			$resy1 = mysql_num_rows($resy);
			//echo "resy1 ".$resy1;
			if ($resy1 == 0){
			$registro = 1;
			}else{
			while ($rowy = mysql_fetch_array($resy)){
			$registro = $rowy['cargo'] + 1;
			}
			}
			
			//echo "resgitro ".$registro;
			//inserto la primera orden, el encabezado
			$w = "insert into registro_tmp (stat, estado, medico, no_cama, usuario_creacion, historia, fecha_creacion, id_tmp, tratamiento, nombre_paciente, compania_de_seguro, tipo_paciente, id_paciente, contraindicaciones, peso, edad)
			values ( '$stat', 'E', '$medico', '$numero_cama','$userid', '$historia','". date('Y-m-d H:i',time())."', '$registro', '$tratamiento', '$nombre_paciente', '$compania_de_seguro', '$tipo_paciente', '$identificacion', '$contraindicaciones', '$peso', '$edad')";
			
			$res = mysql_query($w, $conn);
			//echo "<p>";
			//echo $w;
			//echo "<p>";
			
			if (mysql_errno() == 1062) {
			
			echo "<script language='javascript'>window.location='borrar_error.php?userid=".$userid."'</script>";
			
			}
			//busco el id de la orden
			//$id_tmp = mysql_insert_id();
			//echo "pase el registro tmp";
			//inserto el primer despacho, se crea con estado E de enviado
			
			//$g = "select max(despacho) from factura where tratamiento = '$tratamiento' and historia = '$historia' and cargo = '$registro'";
			
			//$resg = mysql_query($g, $conn) or die(mysql_error());
			
			//$resg1 = mysql_num_rows($resg);
			//echo "resg1 ".$resd1;
			//if ($resg1 == 0){
			$despacho = 1;
			//}else{
			//while ($rowg = mysql_fetch_array($resg)){
			//$despacho = $rowg['despacho'] + 1;
			//}
			//}
		*/
		if($credito > 0){
			$saldo_pendiente = $credito;
			$bres =enviar_fc::update1($credito,$codigo_cliente);
			
			} else {
			$saldo_pendiente = 0;
		}
		
		$caja_id = 0;
		
		$kores =enviar_fc::select1($_SESSION['MM_iduser']); 
		foreach(kores as $korow )
		
		{
			$caja_id = $korow->caja_id;
			$nombre = $korow->nombre;
			
		}
		
		
		$g =enviar_fc::insert1($userid, $identificacion, $codigo_cliente, $jubilado, $codigo_aseguradora, $porcentaje_desc, $total, $sub_total, $itbms_total, $descuento_total,$efectivo, $tarjeta_credito, $clave, $credito, $saldo_pendiente, $cheque, $no_cheque, $nombres_banco, $ref_tdb, $ref_tdc, $vuelto, $caja_id, $nombre_cliente); 
		
		
		echo "<p>";
		//echo $u;
		//echo "<p>";
		
		/*if (mysql_errno() == 1062) {
			
			echo "<script language='javascript'>window.location='borrar_error.php?userid=".$userid."'</script>";
			
		}*/
		//echo "inserte la factura";
		/*
			$f = "select max(linea) + 1 as linea_nueva from tratamiento_detalle where historia = '$historia' and tratamiento = '$tratamiento'";
			$resf = mysql_query($f, $conn) or die(mysql_error());
			$resf1 = mysql_num_rows($resf);
			//echo "resf1 ".$resf1;
			if ($resf1 > 0){
			while ($rowf = mysql_fetch_array($resf)){
			$linea = $rowf['linea_nueva'];
			}
			}
			
		*/
		
		
		for ($i=1;$i<=$var_cont;$i++)
		{
			
			if (isset($_POST["id_articulo_$i"])) {
				if ($linea == 0){
					$linea = $i;     
				}
				/*
					$cantidad_x_dosis = $_POST["cantidad_x_dosis_$i"];
					$volumen = $_POST["volumen_$i"];
					
					
					//echo "ESTOY EN EL LOOP DE MEDICAMENTOS ".$_POST["medicamento_$i"];
					
				/*aqui calculo la cantidad por dosis dependiendo de el tipo de medicamento que estoy aplicando*/
				/*
					$p = "select tipo_de_dosis, posologia, tipo_posologia, codigo_de_barra, volumen from medicamentos where codigo_interno ='".$_POST["medicamento_id_$i"]."'";
					$res8 = mysql_query($p, $conn) or die(mysql_error());
					while ($row8 = mysql_fetch_array($res8)) {
					$tipo_de_dosis = $row8['tipo_de_dosis'];
					$posologia = $row8['posologia'];
					$tipo_posologia_orig = $row8['tipo_posologia'];
					$codigo_barra = $row8['codigo_de_barra'];
					$vol_orig = $row8['volumen'];
					}
					
					
					
					//obtengo el tipo de posologia original
					$q = "select  descripcion from tipos_posologias where codigo_posologia = '".$tipo_posologia_orig."'";
					$resq = mysql_query($q, $conn) or die(mysql_query());
					while ($rowq = mysql_fetch_array($resq)) {
					$descri = $rowq['descripcion'];
					}
					
				/*obtengo el grupo de medicamentos*/
				/*
					$f = "select tipo_grupo, descripcion from tipos_posologias where codigo_posologia = '".$_POST["dosis_tipo_$i"]."'";
					$res11 = mysql_query($f, $conn) or die(mysql_query());
					while ($row11 = mysql_fetch_array($res11)) {
					$tipo_grupoc = $row11['tipo_grupo'];
					
					}
					
					$dosis = $_POST["dosis_num_$i"];
					
					if ($tipo_grupoc != $_POST["tipo_grupos_$i"]) {
					echo "<script language='javascript'>window.location='borrar_error2.php?userid=".$userid."'</script>";
					//echo "a ". $tipo_grupoc;
					//echo "</br> b ". $_POST["tipo_grupos_$i"];
					}
					
					if ($_POST["tipo_dosis_o_$i"] != $_POST["dosis_tipo_$i"]) {
					//echo "recalcule";
					if ($_POST["tipo_grupos_$i"] == 1) {
					if ($_POST["tipo_dosis_o_$i"] == 3 && $_POST["dosis_tipo_$i"] == 1 ) {
					$dosis =  $_POST["dosis_num_$i"] * 0.001;
					}else if ($_POST["tipo_dosis_o_$i"] ==3 && $_POST["dosis_tipo_$i"] == 12 ) {
					$dosis = $_POST["dosis_num_$i"] * 0.0000001;
					}else if ($_POST["tipo_dosis_o_$i"] == 1 && $_POST["dosis_tipo_$i"] == 3 ) {
					$dosis = $_POST["dosis_num_$i"] * 1000;
					}else if ($_POST["tipo_dosis_o_$i"] == 1 && $_POST["dosis_tipo_$i"] == 12 ) {
					$dosis =  $_POST["dosis_num_$i"] * 0.001;
					}
					}else if ($_POST["tipo_grupos_$i"] == 3) {
					if ($_POST["tipo_dosis_o_$i"] == 4 && $_POST["dosis_tipo_$i"] == 6 ) {
					$dosis =  $_POST["dosis_num_$i"] * 0.001;
					}else if ($_POST["tipo_dosis_o_$i"] == 6 && $_POST["dosis_tipo_$i"] == 4) {
					$dosis = $_POST["dosis_num_$i"] * 1000;
					}}else if ($_POST["tipo_grupos_$i"] == 5) {
					if ($_POST["tipo_dosis_o_$i"] == 7 && $_POST["dosis_tipo_$i"] == 18 ) {
					$dosis =  $_POST["dosis_num_$i"] * 0.001;
					}else if ($_POST["tipo_dosis_o_$i"] == 18 && $_POST["dosis_tipo_$i"] == 7) {
					$dosis = $_POST["dosis_num_$i"] * 1000;
					}}
					
					}
					
					
					$horas = $_POST["horas_$i"];
					$dias = $_POST["dias_$i"];
					
					//echo 'vol '.$_POST["vol_comp_$i"];
					//echo "<p>cantidad_x_dosis ".$cantidad_x_dosis;
					//echo "<p>volumen ".$volumen;
					
				/*$cantidad_por_dosis = $dosis/$posologia;*/
				//esta es la cantidad por dosis que calcule segun las horas y dias
				/*
					if ($_POST["tipo_final_$i"] == 2) {
					$cantidad_por_dosis = $cantidad_x_dosis/$_POST["posologia_$i"];
					$dosis_mostrar = $_POST["cant_comp_$i"];
					//echo "<p>calculo por dosis";
					} 
					
					if ($_POST["tipo_final_$i"] == 3) {
					$cantidad_por_dosis = $cantidad_x_dosis/$vol_orig;
					$dosis_mostrar = $_POST["cant_comp_$i"];
					//echo "<p>calculo por volumen";
					}
					
					if ($_POST["tipo_final_$i"] == 1) {
					$cantidad_por_dosis = $cantidad_x_dosis;
					$dosis_mostrar = $cantidad_x_dosis.' Unid.';
					//echo "<p>calculo por cantidad";
					} 
					
					//echo "<p>dosis ".$dosis;
					//echo "<p>posologia ".$_POST["posologia_$i"];
					//echo "<p>cantidad_por_dosis ".$cantidad_por_dosis;
					//echo "<p>tipo_de_dosis ".$tipo_de_dosis;
					
					//verifico que la cantidad de dosis se por lo menos uno para u fraccionado y e entero
					if ($tipo_de_dosis == 'N' or $tipo_de_dosis == 'E') {
					if ($cantidad_por_dosis <= 1) {
					$cantidad_por_dosis = 1;
					} else {
					//cambio para fraccionado
					//$cantidad_por_dosis = ceil($cantidad_por_dosis);
					$cantidad_por_dosis = ceil($cantidad_por_dosis);
					}
					}
					else {
					$cantidad_por_dosis = $cantidad_por_dosis;
					}
					
					$intervalo_dosis = $horas;
					
					//echo "</br>cantidad por dosis: ".$cantidad_por_dosis;
					
					//si el tipo de dosis es entera entonces solo mando una dosis en todo el tratamiento, si es unica entonces hago el calculo segun los dias y las horas
					if ($tipo_de_dosis == 'E') {
					$cantidad_de_dosis = 1;
					} else{
					$cantidad_de_dosis = ceil((24 * $dias) / $horas);
					}
					
					$Hora = Time(); // Hora actual
					$hora_actual =  date('Y-m-d H:i',$Hora);   
					$hora_evento_s = Time() + (60 *60 * $intervalo_dosis);
					$hora_evento = date('Y-m-d H:i',$hora_evento_s);
					$antibiotico = 'N';
					//añado que busque si es antibiotico o no y por cuantos dias
					if ($dias >= 10) {
					$anti = "select antibiotico from medicamentos where codigo_interno = '".$_POST["medicamento_id_$i"]."'";
					$resanti = mysql_query($anti, $conn) or die(mysql_error());
					while($rowsanti = mysql_fetch_array($resanti)){
					$antibiotico = $rowsanti['antibiotico'];
					}
					
					}
					
					/*
					$hora_evento = date("H:i") + date("i",60*60*$intervalo_dosis);
					$hora_actual = date("H:i");
				*/
				
				//busco las ocntraundicaciones de los medicamentos contra las precondiciones del paciente
				/*
					$cont = 'N';
					
					
					//voy a buscar a contraindicacion en el websevice >_<
					//$contra = "select codigo_contra from paciente_contra where id_paciente = '$identificacion'";
					
					
					// Create object
					
					//$client = new nusoap_client('http://192.168.3.2/wsAppDosis_CMP/wsAppDosis_Listas.asmx?WSDL', true);//set your dot net web service url
					
					// $err = $client->getError();
					
					//if ($err) {
					
					// error if any
					
					//echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
					
					//}
					
					// Call mathod
					
					//$result = $client->call('ContraIndicacionbyHistoria', array('Historia' => $historia, 'UserId' => $userid, 'Session' => $session));
					
					// fault if any
					
					//if ($client->fault) {
					
					//echo '<h2>Fault</h2><pre>';
					
					//  print_r($result);
					
					//echo '</pre>';
					
					// } else {
					
					// Check for errors
					
					// $err = $client->getError();
					
					//if ($err) {
					
					// Display the error
					
					//echo '<h2>Error</h2><pre>' . $err . '</pre>';
					
					//} else {
					//echo "<pre>";
					// print_r($result);
					//echo "</pre>";
					// Display the result
					//$h = 0;
					
					
					//if (isset($result['ContraIndicacionbyHistoriaResult']['diffgram']['NewDataSet']['Table1']['Error'])){
					//echo "<script language='javascript'>window.location='http://192.168.3.2/CMP_CONTRAINDICACIONES/_contraindicaciones.aspx?UserId=".$userid."&IdSession=".$session."&userName=".$username."&Historia=".$historia."'  
					// $h = 0;
					//$cont = 'N';
					//}elseif (isset($result['ContraIndicacionbyHistoriaResult']['diffgram']['NewDataSet']['Table']['codigo_contraindicacion']) ) {
					//$h = 1;
					//echo "aqui 1..";
					//}else  {
					//$h = 2;
					//echo "aqui 2..";
					//}
					//var_dump($result);
					//if ($h == 1) {
					//echo "ENTRE POR AQUI AJA";
					//$contra = $result['ContraIndicacionbyHistoriaResult']['diffgram']['NewDataSet']['Table']['codigo_contraindicacion'];
					//$o = "select descripcion from contraindicaciones a, contra_medicamentos b where b.codigo_contraindicacion = '$contra' and a.codigo_contraindicacion = b.codigo_contraindicacion and b.codigo_de_barra = '$codigo_barra'";
					//echo $o;
					//$reso =  mysql_query($o, $conn) or die(mysql_error());
					//$r = mysql_fetch_row($reso);
					//$d = mysql_num_rows($reso);
					//if ($d > 0) {
					//$cont = 'S';
					//}
					//$tipo_cont = $r[0];
					
					//if ($contra == 0){
					//$cont = 'N';
					//}
					
					
					//} else if ($h == 2) {
					// echo "ENTRE POR ACA AJA";
					//$tipo_cont = ".";
					//foreach ($result['ContraIndicacionbyHistoriaResult']['diffgram']['NewDataSet']['Table'] as $iClave => $aElemento){
					//$contra = $aElemento['codigo_contraindicacion'];
					//$p = "select descripcion from contraindicaciones a, contra_medicamentos b where b.codigo_contraindicacion = '$contra' and a.codigo_contraindicacion = b.codigo_contraindicacion and b.codigo_de_barra = '$codigo_barra'";
					//echo $p;
					//$resp =  mysql_query($p, $conn) or die(mysql_error());
					//$re = mysql_fetch_row($resp);
					//$d = mysql_num_rows($resp);
					//if ($d > 0) {
					//$cont = 'S';
					//}
					//$tipo_cont .= $re[0]." ";
					
					//   }  
					//}  
					//}
					//}
					
					
					//echo "<br>tiene contraindicacion: ".$cont;
					//echo "<br>la contraindicacion es: ".$tipo_cont;
					
					//echo "<p>5";
					
					$tipo_cont = '0';
					$cont = 'N';
					
					//inserto el detalle del tratamiento
					$e = "insert into tratamiento_detalle_tmp(  medicamento,
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
					values ('".$_POST["medicamento_$i"]."', '".$_POST["forma_$i"]."','".$_POST["dosis_$i"]."','".$_POST["dosis_num_$i"]."','".$_POST["dosis_tipo_$i"]."','".$_POST["horas_$i"]."', '".$_POST["dias_$i"]."','".$_POST["medicamento_id_$i"]."','".$linea."','".$_POST["cantidad_$i"]."', '$cantidad_por_dosis', '$cantidad_de_dosis', '$intervalo_dosis', '".date('Y-m-d H:i',time())."', 'P', '$historia', '$tratamiento', '$userid','$dosis_mostrar')"; //cuando creo el tratamiento detalle lo pongo en estado pendiente, se quedara asi hasta que se termine de entregar o se cancele el tratamiento.
					$res1e = mysql_query($e, $conn) or die(mysql_error());
					//echo "<p>6";
					//verifico si ya existe ese medicamento para este tratamiento
					$existe = 0;
					$f = "select 'x' from registro_detalle where medicamento_id = '". $_POST["medicamento_id_$i"]. "' and tratamiento = '$tratamiento' and cantidad_de_dosis > 0 and historia = '$historia' and estado != 'X'";
					$fres = mysql_query($f, $conn) or die(mysql_error());
					$frow = mysql_num_rows($fres);
					
					if ($frow > 0) {
					$existe = 1;
					}
					
					
					//inserto el detalle de orden
					
					$x = "insert into registro_detalle_tmp(medicamento, forma_farma, dosis, dosis_num, dosis_tipo, horas, dias, medicamento_id, linea, cantidad, cantidad_x_dosis,cantidad_de_dosis, intervalo_dosis, usuario_creacion, contra, tipo_cont, estado, id_tmp, historia, tratamiento, existe,antibiotico, observacion, dosis_mostrar)
					values ('".$_POST["medicamento_$i"]."', '".$_POST["forma_$i"]."','".$_POST["dosis_$i"]."','".$_POST["dosis_num_$i"]."','".$_POST["dosis_tipo_$i"]."','".$_POST["horas_$i"]."', '".$_POST["dias_$i"]."','".$_POST["medicamento_id_$i"]."','".$i."','".$_POST["cantidad_$i"]."', '$cantidad_por_dosis', '$cantidad_de_dosis', '$intervalo_dosis', '$userid', '$cont', '$tipo_cont', 'E', '$registro', '$historia', '$tratamiento', '$existe', '$antibiotico','".$_POST["obsermed_$i"]."', '$dosis_mostrar' )";
					$res11 = mysql_query($x, $conn) or die(mysql_error());
					//inserto el detalle el primer despacho
					//echo "<p>7";
					
				*/
				
				//echo "itbms unitario: ". $_POST["itbms_unitario_$i"];
				
				$vres =enviar_fc::select2($_POST["id_articulo_$i"]); 
				foreach($vres as $vrow )
				
				{
					$costo_unitario = $vrow->costo_unitario;
				}
				
				
				
				$res1r = enviar_fc::insert2($g,$articulo_$i, $i,$identificacion,$id_articulo_$i,$cantidad_$i,$precio_unitario_$i, $itbms_unitario_$i, $descuento_unitario_$i, $precio_venta_$i,$costo_unitario ); 
				
				
				
				$kres =enviar_fc::update2($cantidad_$i,$id_articulo_$i);
				
				
				
				//echo "r: ".$r;
				/*
					if (mysql_errno() == 1062) {
					
					echo "<script language='javascript'>window.location='borrar_error.php?userid=".$userid."'</script>";
					
				} */
				$linea++;
				//echo "<p>8";
			}}
			
			
			
			
			echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
			echo "<html>
			<head>    <style type='text/css'>
			
			.red {
			background-color: red;
			color: white;
			}
			.white {
			background-color: white;
			color: black;
			}
			.green {
			background-color: green;
			color: white;
			}
			
			.blue {
			background-color: blue;
			color: white;
			}
			.red, .white, .blue, .green {
			margin: 0.5em;
			padding: 5px;
			font-weight: bold;
			}
			
			table {
			border-collapse:separate;
			border:solid 1px;
			border-radius:10px;
			-moz-border-radius:10px;
			
			
			
			}
			
			td, th {
			border-left:solid 1px;
			border-top:solid 1px;
			}
			
			th {
			background-color: #2E7AD2;
			color:#FFFFFF;
			border-top: none;
			}
			
			td:first-child {
			border-left: solid 1px;
			}
			
			body {
			font-family:Arial, Helvetica, sans-serif;
			font-size:14px;
			}
			
			
			</style>
			
			
			<script language='javascript'>
			<!-- Begin
			function popUp(URL) {
			day = new Date();
			id = day.getTime();
			eval('page' + id + ' = window.open(URL, '' + id + '', 'toolbar=1,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=50,height=50');');
			}
			
			
			
			</script>
			
			
			
			</head> <body onunload=\"opener.location=('facturacion_cargos.php')\">
			
			
			<center><h2>Previsualizaci&oacute;n de Factura</h2></center><p>";
			
			
			$result =enviar_fc::select3($g); 
			
			
			
			
			echo "<table align='center'>
			<tr>
			
			<th>Id. Interno</th>
			<th>Nombre del Cliente</th>
			<th>Identificación</th>
			<th>Fecha de Factura</th>
			<th>Usuario</th>
			</tr>";
			foreach($result as $row)
			
			{
				
				echo "<tr>";
				echo "<td>" . $row->factura . "</td>";
				echo "<td>" . $nombre_cliente . "</td>";
				echo "<td>" . $identificacion . "</td>";
				echo "<td>" . $row->fecha . "</td>";
				echo "<td>" . $row->ordenado_por. "</td>";
				echo "</tr>";
				
				$codigo_cliente = $row->codigo_cliente;
				
				$fact_long = "FACTIC".str_pad($g, 7, 0, STR_PAD_LEFT);
				$fact_long_min = "factic".str_pad($g, 7, 0, STR_PAD_LEFT);
				
				$total_pagado = 0;
				$efectivo = 0;
				$tarjeta_debito = 0;
				$tarjeta_credito = 0;
				$credito = 0;
				$descuento_total = 0;
				$porcentaje_desc = 0;
				$cheque = 0;
				$empresa = trim($row->nombre);
				//$ruc = '9999';
				$ruc = $identificacion;
				$total = $row->total;
				$efectivo = $row->efectivo;
				$tarjeta_debito = $row->tarjeta_clave;
				$tarjeta_credito = $row->tarjeta_credito;
				$credito = $row->credito;
				$descuento_total = $row->descuento_total;
				$porcentaje_desc = $row->porcentaje_desc;
				$cheque = $row->cheque;
				$total_pagado = $efectivo + $tarjeta_debito + $tarjeta_credito + $cheque;
				$direccion= 'SAN FRANCISCO, URB. PAITILLA - **PUBLICO**';
				
				if ($descuento_total > 0 && $porcentaje_desc == 0){
					$porcentaje_desc = round(($descuento_total * 100 / $total),2);
				}
				
				
				$kores = enviar_fc::select4($_SESSION['MM_iduser']); 
				
				foreach()
				
				{
					$caja_id = $korow->caja_id;
					
				}
				
				/*añado parametrización de impresoras fiscales*/
				
				$respe = enviar_fc::select5();"select nombre_carpeta, nombre_carpeta2 from impresoras_fiscales where tipo_impresion = 'PUB'";
				
				foreach($respe as $rowspe )
				
				{
					$nombre_carpeta = $rowspe->nombre_carpeta;
					$nombre_carpeta2 = $rowspe->nombre_carpeta2;
				}
				
				/* fin de añado parametrización de impresoras fiscales */
				
				
				if($efectivo == '0.00'){
					$efectivo = 0;
				}
				
				if($cheque == '0.00'){
					$cheque = 0;
				}
				
				if($tarjeta_credito == '0.00'){
					$tarjeta_credito = 0;
				}
				
				if($tarjeta_debito == '0.00'){
					$tarjeta_debito = 0;
				}
				
				if($descuento_total == '0.00'){
					$descuento_total = 0;
				}
				
				
				$fp = fopen("/opt/factura/".$nombre_carpeta."//".$fact_long.".txt","a");
				//$fp = fopen("/home/apdosis/pos/in1/".$fact_long.".txt","a");
				
				fwrite($fp, "$fact_long\t$nombre_cliente\t$ruc\t$direccion\t$descuento_total\t$total_pagado\t$total\t$credito\t0\t$efectivo\t$cheque\t$tarjeta_credito\t$tarjeta_debito\t0\t0\t0");
				fclose($fp);
				
				
				
				
			}
			echo "</table> <p>";
			
			$fact_long_mov = "FACMVC".str_pad($g, 7, 0, STR_PAD_LEFT);
			
			$resulta = enviar_fc::select6($g); 
			
			$fp2 = fopen("/opt/factura/".$nombre_carpeta."//".$fact_long_mov.".txt","a");
			//$fp2 = fopen("/home/apdosis/pos/in1/".$fact_long_mov.".txt","a");
			
			
			
			
			echo "<table align='center'>
			<tr>
			
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Precio Unitario</th>
			<th>Descuento Unit.</th>
			<th>Itbms Unit.</th>
			<th>Precio Venta</th>
			
			</tr>";
			foreach($resulta as  $rows )
			
			{
				echo "<tr>";
				echo "<td>" . $rows->medicamento . "</td>";
				echo "<td>" . $rows->cantidad . "</td>";
				echo "<td>" . round($rows->precio_unitario,2) . "</td>";
				echo "<td>" . round($rows->descuento_unitario,2) . "</td>";
				echo "<td>" . round($rows->impuesto,2) . "</td>";
				echo "<td>" . round($rows->precio_venta,2) . "</td>";
				
				
				echo "</tr>";
				
				
				
				
				$id = $rows->medicamento_id;
				$med = $rows->medicamento;
				$dosis = 0;
				$cant = $rows->cantidad;
				//$precio = (round($rows->precio_unitario'],2) - round($rows['descuento_unitario'],2)) ;
				$precio = (round($rows->precio_unitario,2));
				$descuento_unitario = (round($rows->descuento_unitario,2));
				$impuesto = $rows->impuesto;
				
				/**agrego tipo de impuesto**/
				$cres =enviar_fc::select7(); 
				foreach($cres as $crow )
				
				{
					$tipo_impuesto = $crow->tipo_impuesto;
				}
				
				
				/**fin de agrego tipo de impuesto**/
				
				
				
				
				fwrite($fp2, "$fact_long\t$id\t$med\t$dosis\t$cant\t$precio\t$impuesto\t$descuento_unitario\t$tipo_impuesto".PHP_EOL);
				
				
			}
			fclose($fp2);
			echo "</table>"; 
			echo "<p>Espere hasta que se imprima en su totalidad la factura fiscal y de clic al botón Obtener Número Fiscal</p><p></p>";
			
			echo "<INPUT TYPE=\"button\" class='blue' value='Obtener Número Fiscal' id='imprimirp' onClick=\"parent.location='numero_fiscal_cierre_manual.php?archivo=".$fact_long_min.".txt&factura=".$g."&carpeta=".addslashes($nombre_carpeta2)."'\" >";
			if($codigo_cliente == 5){
				echo "<INPUT TYPE=\"button\" class='green' value='Imprimir Labels' id='imprimirl' onClick=\"parent.location='imprimir_labels_l_fa.php?factura=".$g."&nombre_cliente=".$nombre_cliente."'\" >"; 
			}
			
			echo "</body>
			
			
			</html>";
			//} else {
			/*echo "<script language='javascript'>window.location='http://192.168.3.2/cmp_appdosis/'</script>";
				}
			*/
	}
	
	layout::fin_content();
?>


<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/facturacion_label.php');
	$userid=$_SESSION['MM_iduser'];
	/*carga*/
	error_reporting(E_ALL & ~E_NOTICE);
	if (isset($_POST['historia'])) { 
	$historia = $_POST['historia'];}
	if (isset($_POST['nombre_paciente'])) { 
	$nombre_paciente = $_POST['nombre_paciente'];}
	if (isset($_POST['id_paciente'])) { 
	$identificacion = $_POST['id_paciente'];}
	if (isset($_POST['numero_cama'])) { 
	$numero_cama = $_POST['numero_cama'];}
	if (isset($_POST['nommedico'])) { 
	$medico = $_POST['nommedico'];}
	if (isset($_POST['alergias'])) { 
	$alergias = $_POST['alergias'];}
	if (isset($_POST['diabetes'])) { 
	$diabetes = $_POST['diabetes'];}
	if (isset($_POST['hipertension'])) { 
	$hipertension = $_POST['hipertension'];}
	if (isset($_POST['peso'])) { 
	$peso = $_POST['peso'];}
	if (isset($_POST['otros'])) { 
	$otros = $_POST['otros'];}
	if (isset($_POST['compania_de_seguro'])) { 
	$compania_de_seguro = $_POST['compania_de_seguro'];}
	if (isset($_POST['stat'])) { 
	$stat = $_POST['stat'];}
	if (isset($_POST['userid'])) { 
	$userid = $_POST['userid'];}
	if (isset($_POST['session'])) { 
	$session = $_POST['session'];}
	if (isset($_POST['var_cont'])){
		$var_cont = $_POST['var_cont'];
		}if (isset($_POST['tipo_paciente'])){
		$tipo_paciente = $_POST['tipo_paciente'];
	}
	if (isset($_POST['tratamiento'])){
		$tratamiento = $_POST['tratamiento'];
	}
	if (isset($_POST['edad'])){
		$edad = $_POST['edad'];
	}
	if (isset($_POST['banco'])){
		$banco = $_POST['banco'];
	}
	if (isset($_POST['mostrar_banco'])){
		$mostrar_banco = $_POST['mostrar_banco'];
	}
	if (isset($_POST['env_paciente'])){
		$localidad_entrega = $_POST['env_paciente'];
		$localidad_actual= $_POST['env_paciente'];
	}
	if (isset($_POST['contraindicaciones'])){
		$contraindicaciones= $_POST['contraindicaciones'];
	}
	if (isset($_POST['obs_pac'])){
		$obs_pac = $_POST['obs_pac'];
	}
	if (isset($_POST['prn'])){
		$prn = $_POST['prn'];
		} else {
		$prn = 'N';
	}
	if (isset($_POST['orden'])){
		$orden = $_POST['orden'];
		} else {
		$orden = '';
	}
	if (isset($_POST['id_cliente'])){
		$id_cliente = $_POST['id_cliente'];
		} else {
		$id_cliente = '';
		} if (isset($_POST['nom_med'])){
		$nom_med = $_POST['nom_med'];
		}else{
		$nom_med = ' ';
		} if (isset($_POST['apellido_med'])){
		$apellido_med = $_POST['apellido_med'];
		}else{
		$apellido_med = ' ';
	}
	if (isset($_POST['apellido_paciente'])) { 
	$apellido_paciente = $_POST['apellido_paciente'];}
	
	
	
	//echo "entre<p>";
	
	if($var_cont == 0){
		echo "<script language='javascript'>window.location='borrar_error_blanco.php?userid=".$userid."'</script>";
	}
	
	
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
	
	$rest = ffaclabel::select1($historia,$tratamiento);
	//$tratamiento = 0;
	$restnum = count($rest);
	
	if ($restnum == 0) {
		
		//$tratamiento = 1;
		
		//echo "userid ".$userid;
		//echo "tratamiento ".$tratamiento; 
		
		//echo "3";
		//echo "<p>el tratamiento es ".$tratamiento;
		//echo "<p>1";
		
		ffaclabel::insert1($historia,$numero_cama,$userid,$tratamiento,$nombre_paciente,$compania_de_seguro,$edad,$identificacion,$peso);
		/*if (mysql_errno() == 1062) {
			
			echo "<script language='javascript'>window.location='borrar_error.php?userid=".$userid."'</script>";
			
		}*/
	}
	
	
	
	if ($tratamiento == 0) {
		$tratamiento = '-1';
	}
	
	
	//echo "<p>2";
	
	$rowy = ffaclabel::select2($historia,$tratamiento);
	//echo "resy1 ".$resy1;
	if (count($rowy) == 0){
		$registro = 1;
		}else{
		foreach($rowy as $ry){
			$registro = $ry->cargo + 1;
		}
	}
	
	//echo "<p>";
	//echo $w;
	//echo "<p>";
	
	ffaclabel::insert2($stat,$medico,$numero_cama,$userid,$historia,$registro,$tratamiento,$nombre_paciente,$compania_de_seguro,$tipo_paciente,$identificacion,$contraindicaciones,$peso,$edad);
	
	/*if (mysql_errno() == 1062) {
		
		echo "<script language='javascript'>window.location='borrar_error.php?userid=".$userid."'</script>";
		
	}*/
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
	
	ffaclabel::insert3($registro,$userid,$numero_cama,$medico,$historia,$tratamiento,$despacho,$stat,$tipo_paciente,$banco,$localidad_actual,$localidad_entrega,$identificacion,$prn,$orden,$id_cliente);
	//echo "<p>";
	//echo $u;
	//echo "<p>";
	
	/*
		if (mysql_errno() == 1062) {
		
		echo "<script language='javascript'>window.location='borrar_error.php?userid=".$userid."'</script>";
		
	}*/
	
	//echo "inserte la factura";
	
	//echo "resf1 ".$resf1;
	$rowf = ffaclabel::select3($historia,$tratamiento);
	if (count($rowf) > 0){
		foreach($rowf as $rwf){
			$linea = $rwf->linea_nueva;
		}
	}
	
	for ($i=1;$i<=$_POST["var_cont"];$i++)
	{
		
		if (isset($_POST["medicamento_".$i])) {
			if ($linea == 0){
				$linea = $i;     
			}
			
			$cantidad_x_dosis = $_POST["cantidad_x_dosis_".$i];
			$volumen = $_POST["volumen_".$i];
			
			
			//echo "ESTOY EN EL LOOP DE MEDICAMENTOS ".$_POST["medicamento_".$i];
			
			/*aqui calculo la cantidad por dosis dependiendo de el tipo de medicamento que estoy aplicando*/
			$row8 = ffaclabel::select4($_POST["medicamento_id_".$i]);
			foreach($row8 as $rw8){
				$tipo_de_dosis = $rw8->tipo_de_dosis;
				$posologia = $rw8->posologia;
				$tipo_posologia_orig = $rw8->tipo_posologia;
				$codigo_barra = $rw8->codigo_de_barra;
				$vol_orig = $rw8->volumen;
			}
			
			//obtengo el tipo de posologia original
			$rowq = ffaclabel::select5($tipo_posologia_orig);
			foreach($rowq as $rwq){
				$descri = $rwq->descripcion;
			}
			
			/*obtengo el grupo de medicamentos*/
			$row11 = ffaclabel::select6($_POST["dosis_tipo_".$i]);
			foreach($row11 as $rw11){
				$tipo_grupoc = $rw11->tipo_grupo;
			}
			
			$dosis = $_POST["dosis_num_".$i];
			
			if ($tipo_grupoc != $_POST["tipo_grupos_".$i]) {
				echo "<script language='javascript'>window.location='borrar_error2.php?userid=".$userid."'</script>";
				//echo "a ". $tipo_grupoc;
				//echo "</br> b ". $_POST["tipo_grupos_".$i];
			}
			
			if ($_POST["tipo_dosis_o_".$i] != $_POST["dosis_tipo_".$i]) {
				//echo "recalcule";
				if ($_POST["tipo_grupos_".$i] == 1) {
					if ($_POST["tipo_dosis_o_".$i] == 3 && $_POST["dosis_tipo_".$i] == 1 ) {
						$dosis =  $_POST["dosis_num_".$i] * 0.001;
						}else if ($_POST["tipo_dosis_o_".$i] ==3 && $_POST["dosis_tipo_".$i] == 12 ) {
						$dosis = $_POST["dosis_num_".$i] * 0.0000001;
						}else if ($_POST["tipo_dosis_o_".$i] == 1 && $_POST["dosis_tipo_".$i] == 3 ) {
						$dosis = $_POST["dosis_num_".$i] * 1000;
						}else if ($_POST["tipo_dosis_o_".$i] == 1 && $_POST["dosis_tipo_".$i] == 12 ) {
						$dosis =  $_POST["dosis_num_".$i] * 0.001;
					}
					}else if ($_POST["tipo_grupos_".$i] == 3) {
					if ($_POST["tipo_dosis_o_".$i] == 4 && $_POST["dosis_tipo_".$i] == 6 ) {
						$dosis =  $_POST["dosis_num_".$i] * 0.001;
						}else if ($_POST["tipo_dosis_o_".$i] == 6 && $_POST["dosis_tipo_".$i] == 4) {
						$dosis = $_POST["dosis_num_".$i] * 1000;
					}}else if ($_POST["tipo_grupos_".$i] == 5) {
					if ($_POST["tipo_dosis_o_".$i] == 7 && $_POST["dosis_tipo_".$i] == 18 ) {
						$dosis =  $_POST["dosis_num_".$i] * 0.001;
						}else if ($_POST["tipo_dosis_o_".$i] == 18 && $_POST["dosis_tipo_".$i] == 7) {
						$dosis = $_POST["dosis_num_".$i] * 1000;
					}}
					
			}
			
			
			$horas = $_POST["horas_".$i];
			$dias = $_POST["dias_".$i];
			
			//echo 'vol '.$_POST["vol_comp_".$i];
			//echo "<p>cantidad_x_dosis ".$cantidad_x_dosis;
			//echo "<p>volumen ".$volumen;
			
			/*$cantidad_por_dosis = $dosis/$posologia;*/
			//esta es la cantidad por dosis que calcule segun las horas y dias
			if ($_POST["tipo_final_".$i] == 2) {
				$cantidad_por_dosis = $cantidad_x_dosis/$_POST["posologia_".$i];
				$dosis_mostrar = $_POST["cant_comp_".$i];
				//echo "<p>calculo por dosis";
			} 
			
			if ($_POST["tipo_final_".$i] == 3) {
				$cantidad_por_dosis = $cantidad_x_dosis/$vol_orig;
				$dosis_mostrar = $_POST["cant_comp_".$i];
				//echo "<p>calculo por volumen";
			}
			
			if ($_POST["tipo_final_".$i] == 1) {
				$cantidad_por_dosis = $cantidad_x_dosis;
				$dosis_mostrar = $cantidad_x_dosis.' Unid.';
				//echo "<p>calculo por cantidad";
			} 
			
			//echo "<p>dosis ".$dosis;
			//echo "<p>posologia ".$_POST["posologia_".$i];
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
				$cantidad_de_dosis = $cantidad_x_dosis;
			}
			
			$Hora = Time(); // Hora actual
			$hora_actual =  date('Y-m-d H:i',$Hora);   
			$hora_evento_s = Time() + (60 *60 * $intervalo_dosis);
			$hora_evento = date('Y-m-d H:i',$hora_evento_s);
			$antibiotico = 'N';
			//añado que busque si es antibiotico o no y por cuantos dias
			if ($dias >= 10) {
				$rowsanti = ffaclabel::select7($_POST["medicamento_id_".$i]);
				foreach($rowsanti as $rwi){
					$antibiotico = $rwi->antibiotico;
				}				
			}
			
			/*
				$hora_evento = date("H:i") + date("i",60*60*$intervalo_dosis);
				$hora_actual = date("H:i");
			*/
			
			//busco las ocntraundicaciones de los medicamentos contra las precondiciones del paciente
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
		    ffaclabel::insert4($_POST["medicamento_".$i],$_POST["forma_".$i],$_POST["dosis_".$i],$_POST["dosis_num_".$i],$_POST["dosis_tipo_".$i],$_POST["horas_".$i],$_POST["dias_".$i],$_POST["medicamento_id_".$i],$linea,$_POST["cantidad_".$i],$cantidad_por_dosis,$cantidad_de_dosis,$intervalo_dosis,$historia,$tratamiento,$userid,$dosis_mostrar);
			//echo "<p>6";
			//verifico si ya existe ese medicamento para este tratamiento
			$existe = 0;
			$frow = count(ffaclabel::($_POST["medicamento_id_".$i],$tratamiento,$historia));
			
			if ($frow > 0) {
				$existe = 1;
			}
			
			
			//inserto el detalle de orden
			ffaclabel::insert5($_POST["medicamento_".$i],$_POST["forma_".$i],$_POST["dosis_".$i],$_POST["dosis_num_".$i],$_POST["dosis_tipo_".$i],$_POST["horas_".$i],$_POST["dias_".$i],$_POST["medicamento_id_".$i],$i,$_POST["cantidad_".$i],$cantidad_por_dosis,$cantidad_de_dosis,$intervalo_dosis,$userid,$cont,$tipo_cont,$registro,$historia,$tratamiento,$existe,$antibiotico,$obsermed,$dosis_mostrar,$precio);
			
			//inserto el detalle el primer despacho
			//echo "<p>7";
			
			ffaclabel::insert6($_POST["medicamento_".$i],$_POST["forma_".$i],$_POST["dosis_".$i],$_POST["horas_".$i],$_POST["dias_".$i],$i,$identificacion,$registro,$_POST["medicamento_id_".$i],$cantidad_por_dosis,$intervalo_dosis,$historia,$tratamiento,$despacho,$userid,$obsermed,$tipo_cont,$dosis_mostrar);
			/*if (mysql_errno() == 1062) {
				
				echo "<script language='javascript'>window.location='borrar_error.php?userid=".$userid."'</script>";
				
			}*/
			$linea++;
			//echo "<p>8";
		}}
		
		/*fin de carga/
			
			
		/*proceso de envio de factura*/
		
		if (isset($_POST['factura'])) { 
		$factura = $_POST['factura'];}
		if (isset($_POST['nombre_paciente'])) { 
		$nombre_paciente = $_POST['nombre_paciente'];}
		if (isset($_POST['identificacion'])) { 
		$identificacion = $_POST['identificacion'];}
		if (isset($_POST['numero_cama'])) { 
		$numero_cama = $_POST['numero_cama'];}
		if (isset($_POST['medico'])) { 
		$medico = $_POST['medico'];}
		if (isset($_POST['alergias'])) { 
		$alergias = $_POST['alergias'];}
		if (isset($_POST['diabetes'])) { 
		$diabetes = $_POST['diabetes'];}
		if (isset($_POST['hipertension'])) { 
		$hipertension = $_POST['hipertension'];}
		if (isset($_POST['peso'])) { 
		$peso = $_POST['peso'];}
		if (isset($_POST['otros'])) { 
		$otros = $_POST['otros'];}
		if (isset($_POST['compania_de_seguro'])) { 
		$compania_de_seguro = $_POST['compania_de_seguro'];}
		if (isset($_POST['stat'])) { 
		$stat = $_POST['stat'];}
		if (isset($_GET['registro'])) { 
		$registro = $_GET['registro'];}
		if (isset($_GET['tratamiento'])) { 
		$tratamiento = $_GET['tratamiento'];}
		if (isset($_GET['historia'])) { 
		$historia = $_GET['historia'];}
		if (isset($_GET['userid'])) { 
		$userid = $_GET['userid'];}
		if (isset($_GET['username'])) { 
		$username = $_GET['username'];}
		if (isset($_GET['session'])) { 
		$session = $_GET['session'];}
		if (isset($_GET['banco'])) { 
		$banco = $_GET['banco'];}
		if (isset($_GET['obs'])) { 
		$obs_pac = $_GET['obs'];}
		
		//include('sesion_activa.php');
		//if ($estado_sesion == 'A') {
		
		$userid=$_SESSION['MM_iduser'];
		
		$resl1 = count(ffaclabel::select9($userid));
		//echo "resl1 ".$resl1;
		if ($resl1 > 0){
			$resdn = count(ffaclabel::select10($historia,$tratamiento));
			if ($resdn == 0){ 
				ffaclabel::insert7($userid);
			}}
			
			//echo "1";
			ffaclabel::insert8($userid);
			//echo "2";
			ffaclabel::insert9($userid);
			//echo "3";
			ffaclabel::insert10($userid);
			//echo "4";
			ffaclabel::insert11($userid);
			//echo "5";
			
			$rrowg = ffaclabel::select11($userid);
			foreach($rrowg as $rrg){
				$fact = $rrg->fact;
			}
			
			
			if (!empty($_GET['obs'])) {
				ffaclabel::insert12($historia,$_GET['obs'],$userid,$fact);			
			}
			
			//$fact = mysql_insert_id($conn);
			
			//echo "el numeroooo de facturaaaaaaaa fue  ".$fact;
			
			ffaclabel::insert13($fact,$userid);
			//echo "el numeroooo de factura fue ".$fact;
			//echo "6";
			
			//echo "el numero de factura fue ".$fact;
			
			/*$m = "SELECT registro.nombre_paciente as paciente, registro.historia, registro.no_cama, registro.medico as medico, registro.stat, registro.tipo_paciente FROM tratamiento, registro 
				where tratamiento.historia = '$historia'
				and registro.cargo = '$registro'
				and registro.historia = '$historia'
				and registro.tratamiento = '$tratamiento'";
				$result = mysql_query($m, $conn) or die(mysql_error());
				
				
				$n = "SELECT a.medicamento_id, a.medicamento, a.forma_farma, b.descripcion as forma, a.dosis_mostrar as dosis, a.horas, a.dias, a.linea, a.cargo, a.cantidad_de_dosis, a.existe, a.contra, a.tipo_cont, a.antibiotico, a.observacion FROM registro_detalle a, formas_farmaceuticas b where cargo = '$registro' and historia = '$historia'
				and tratamiento = '$tratamiento' and a.forma_farma = b.codigo_forma";
				
			$resulta = mysql_query($n, $conn) or die(mysql_error());*/
			
			
			
			
			//traigo el calculo de la nave
			//para urgentes			
			$precio_total2 = 0;
			$precio_venta3 = 0;
			
			$rowsk = ffaclabel::select12($fact);
			foreach($rowsk as $rk){
				
				$linea2 = $rk->linea;
				$precio_unitario2 = round($rk->precio_unitario,2);
				$cantidad2 = $rk->cantidad;	
				$tipo_de_dosis2 = $rk->tipo_de_dosis;
				
				
				
				//echo "hora evento de carro: ".$hora_evento_carro;
				
				$precio_venta3 = 0;
				
				//intervalo 
				if ($tipo_de_dosis2 == 'M') {
					$precio_venta3 = $precio_unitario2 * ceil($cantidad2);
					}else{
					$precio_venta3 = $precio_unitario2 * $cantidad2;
				}
				
				
				
				//echo "la cantidad de horas entre el carro es: ".$cantidad_de_horas;
				//echo "la cantidad de dosis que debo dar es: ".$average;
				//echo "mi precio unitario es: ".$precio_unitario;
				
				
				
				//echo "la cantidad x medicamento ".$cantidad_f;
				
				
				//fin de intervalo
				ffaclabel::insert14($cantidad2,$precio_venta3,$precio_unitario2,$fact,$linea2);
				//echo "el update: ".$hi;
				
				$precio_total2 = $precio_total2 + $precio_venta3;
			}
			
			ffaclabel::insert15($precio_total2,$fact);
			
			//fin del calculo de urgentes
			
			//verifico si es una factura de banco y la proceso inmediatamente
			
			// echo "Banco: ".$banco;
			
			
			
			
			//fin de verificar si es banco
			
			
			/*$query_Recordset1 = "select factura.factura, factura.historia, factura.fecha_creacion, factura_detalle.precio_unitario, factura.fa, factura_detalle.medicamento, factura_detalle.cantidad, factura_detalle.hora_evento_carro from factura, factura_detalle where factura_detalle.factura = '$fact' and factura.factura = factura_detalle.factura order by factura";
				$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
			$row_Recordset1 = mysql_fetch_assoc($Recordset1);*/
			
			ffaclabel::delete1($userid);
			
			/*proceso de envio de factura*/
			
			$factura = $fact;
			
			//echo "factura: ".$factura;
			
			$row1 = ffaclabel::select13($factura);
			foreach($row1 as $rw1){
				$fenum = count(ffaclabel::select14($rw1->medico));
			}
			/*
				if($nom_med !=' '){
				$nom_med = 'Dr.'.' '.$nom_med;
				}
			*/
			
			require ('./TCPDF/tcpdf.php');
			//$pdf = new FPDF('L','mm',array(90,29));
			//require('ean13.php');
			
			$tamano = array(90,29);
			
			$pdf = new TCPDF('L', 'mm', $tamano, true, 'UTF-8', false);
			
			
			//echo "la linea ".$linea[$c]."el valor de imprimir es ".$imprimir[$c]." de la factura ".$factura[$c];
			
			$rows = ffaclabel::select15($factura);
			foreach($rows as $rws){
				//echo "cantidad ".$rws->cantidad;
				
				for ($i=1; $i<=ceil($rws->average); $i++) {
					
					$medicamento = $rws->medicamento;
					$horas = $rws->horas;
					$dias = $rws->dias;
					//$paciente = $rws->nom_paciente;
					$paciente = '<b>Pcte. </b>'.substr($nombre_paciente,0,1).'. '.$apellido_paciente;
					$id_paciente = $rws->id_paciente;
					$cama = $rws->no_cama;
					//$medico = $rws->nombre_medico;
					$medico = '<b>Dr(a). </b>'.substr($nom_med,0,1).'. '.$apellido_med;
					$fecha = date('Y-m-d H:i',time());
					$localidad = $rws->localidad_entrega;
					$dosis = $rws->dosis;
					$observacion = $rws->observacion;
					$codigo = $rws->codigo_de_barra;
					$codigo = str_pad($codigo,13,'0',STR_PAD_LEFT);
					
					if($horas == 0){
						$horas = '___';
					}
					
					if($dias == 0){
						$dias = '___';
					}
					
					
					
					$pdf->AddPage();
					$pdf->SetMargins(1,1,1);
					$pdf->SetAutoPageBreak(3);
					$pdf->SetY(1) ;
					$pdf->setPrintHeader(false);
					$pdf->setPrintFooter(false);
					
					$style = array(
					'position' => '',
					'align' => 'C',
					'stretch' => false,
					'fitwidth' => true,
					'cellfitalign' => '',
					'border' => false,
					'hpadding' => 'auto',
					'vpadding' => 'auto',
					'fgcolor' => array(0,0,0),
					'bgcolor' => false, //array(255,255,255),
					'text' => true,
					'font' => 'helvetica',
					'fontsize' => 8,
					'stretchtext' => 4
					);
					
					
					
					$params = $pdf->serializeTCPDFtagParameters(array($codigo, 'EAN13', '', '', 30, 10, 0.4, array('position'=>'', 'border'=>false, 'padding'=>1, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>4, 'stretchtext'=>4), 'N'));
					
					$tbl = '<table border="0.5" cellpadding="0.5">
					<tr><td colspan="2"><b>FARMACIA CENTRO M&Eacute;DICO PAITILLA &nbsp;&nbsp;&nbsp;&nbsp;TEL: 269-0655</b></td></tr>	 
					<tr>
					<td>'.$paciente.'</td><td>'.$medico.'</td></tr>
					<tr>
					<td colspan="2">'.$medicamento.'</td></tr>
					<tr><td width="63%"><b>Obs.</b>:'.$observacion.'</td><td align="center" width="37%"><tcpdf method="write1DBarcode" params="'.$params.'" /></td>
					</tr> 
					</table>';
					
					
					$pdf->SetFont('helvetica','',8);
					
					$pdf->writeHTML($tbl, true, false, false, false, '');
					/*
						$pdf->SetFont('helvetica','B',8);
						$pdf->Write(1, "FARMACIA CENTRO MEDICO PAITILLA\n");
						$pdf->SetFont('helvetica','',8);
						$pdf->Write(1, $paciente." Dr.: ".$nom_med."\n");
						$pdf->Write(1, $medicamento); 
						$pdf->SetFont('helvetica','',8);
						$pdf->Write(1, "\nObs.:".$observacion);
						$pdf->Write(1, "\n");
						$pdf->write1DBarcode($codigo, 'EAN13', '', '', '', 10, 0.4, $style, 'N');
						//$data= date("dmy");  
					//$fileD = $factura[$c]."_".$linea[$c].".pdf";*/
				}
				
			}			
			
			$pdf -> Output();
?>											
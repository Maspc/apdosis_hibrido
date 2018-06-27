<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_labels.php');
	//require ('fpdf.php');
	require ('TCPDF/tcpdf.php');
	if (isset($_POST['factura'])) { 
	$factura=$_POST['factura'];}
	if (isset($_POST['linea'])) { 
	$linea=$_POST['linea'];}
	if (isset($_POST['int'])) { 
	$imprimir=$_POST['int'];}
	else{
		$imprimir = 0;
	}
	if(isset($_POST['label'])){
		$lbl = 1;
		} else if(isset($_POST['prep']))  {
		$lbl = 2;
		} else if (isset($_POST['actobs'])) {
		$lbl = 0;
	}
	if(isset($_POST['obs'])){
		$obs = $_POST['obs']; 
		} else {
		$obs =  ' ';
	}
	if(isset($_POST['obsfarma'])){
		$obsfarma = $_POST['obsfarma']; 
		} else {
		$obsfarma = ' ';
	}
	if(isset($_POST['razonobs'])){
		$razonobs = $_POST['razonobs']; 
		} else {
		$razonobs = ' ';
	}
	if(isset($_POST['fecha'])){
		$fecha = $_POST['fecha']; 
		} else {
		$fecha = 'N';
	}
	if(isset($_POST['anio'])){
		$anio = $_POST['anio']; 
		} else {
		$anio= ' ';
	}
	if(isset($_POST['mes'])){
		$mes = $_POST['mes']; 
		} else {
		$mes = ' ';
	}
	if(isset($_POST['dia'])){
		$dia = $_POST['dia']; 
		} else {
		$dia = ' ';
	}
	if(isset($_POST['lote'])){
		$lote = $_POST['lote']; 
		} else {
		$lote = ' ';
	}
	
	if(isset($_POST['turno'])){
		$turno = $_POST['turno']; 
		} else {
		$turno = ' ';
	}
	
	if(isset($_POST['medicamento_id'])){
		$medicamento_id	 = $_POST['medicamento_id']; 
		} else {
		$medicamento_id = ' ';
	}
	
	
	
	
	
	
	
	if ($lbl == 0) {
		
		for($d = 0; $d < sizeof($linea); $d++) {
			
		    imprimir::update1($lote[$d],$factura[$d],$linea[$d]);
			/*
				echo "entre al for <br>";
				
				echo "<p>lote ".$lote[$d];
				echo "<p>turno ".$turno[$d];
				echo "<p>factura ".$factura[$d];
				echo "<p>medicamento_id 
				".$medicamento_id[$d];
			echo "<p>-------------";*/

			$sres = imprimir::select1($factura[$d],$medicamento_id[$d]);
			
			$snum = count($sres);
			
			if(strlen($lote[$d]) > 0 && $snum == 0){
				
				
				//echo "<p>entro a grabar el lote";	

				$bres = imprimir::select2($factura[$d]);
                
				foreach($bres as $brow){
					$stat = $brow->stat;
				}
				
				
				if($stat != 'S'){
					
					$gres = imprimir::select3($turno[$d]);
					
					foreach($gres as $grow){
						$inicio_turno = $grow->id_turno_inicio;
					}
					} else{
					
					
					$gres = imprimir::select3($factura[$d],$linea[$d]);;
					
					foreach($gres as $grow){
						$inicio_turno = $grow->hora_inicio_entrega;						
					}
				}
				
				$inicio_turno = date('H:i', strtotime($inicio_turno)); 
				
				/*
					echo "<p>inicio turno".$inicio_turno;	
					
					echo "<p>factura".$factura[$d];	
					
				echo "<p>medicamento_id".$medicamento_id[$d];	*/
				
				$rres = imprimir::select5($factura[$d],$medicamento_id[$d]);
			
			    foreach($rres as $rrow){
					$tipo_de_dosis = $rrow->tipo_de_dosis;
					$grupo_medicamento = $rrow->grupo_medicamento;
					$cantidad_por_dosis = $rrow->cantidad_por_dosis;
					$multiple_principio = $rrow->multiple_principio;
					$dosis_desc = $rrow->dosis_desc;
					$vol_desc = $rrow->vol_desc;
					$average = $rrow->average;
					$horas = $rrow->horas;
					$volumen = $rrow->volumen;
					$posologia = $rrow->posologia;
					$dosis_mostrar = $rrow->dosis_mostrar;
					
					//	echo "<p>entro al while";	
				}
				
				$tipo_final = 0;
				
				
				
				if ($multiple_principio == 'S' || $tipo_de_dosis == 'N' || $tipo_de_dosis == 'E'  ) {
					$tipo_final = '1';
					$valor_poso = 'Unidad';
					$cantidad_x_dosis = $cantidad_por_dosis;
					} else {
					$tipo_final = '2';
					$valor_poso = $dosis_desc;
					$cantidad_x_dosis = $cantidad_por_dosis * $posologia ;
				}
				
				
				if ($grupo_medicamento == '7'  || $grupo_medicamento == '11') {
					if ($tipo_de_dosis == 'U' || $tipo_de_dosis == 'M') {
						$tipo_final = '3';
						$valor_poso = $vol_desc;
						$cantidad_x_dosis = $cantidad_por_dosis * $volumen ;
					}}
					
					
					//echo "<p>average".$average;	
					
					for ($i=1; $i<=ceil($average); $i++) { 
						
						imprimir::insert1($factura[$d],$medicamento_id[$d],$lote[$d],$cantidad_por_dosis,$turno[$d],$inicio_turno,$dosis_mostrar);
						
						$inicio_turno = date('H:i', strtotime($inicio_turno.'+'.$horas.' hour'));  
						
						//echo "<p>...h". $h;
						
					}
					
			}
			
			
			if (isset($_POST['obsfarma'])){
				imprimir::update2($obsfarma[$d],$razonobs[$d],$factura[$d],$linea[$d]);
				
			}
			echo "<br>Se actualizaron las observaciones farmac&eacute;uticas";
		}
		
		
		
		
		
		for($e = 0; $e < sizeof($fecha); $e++) {
			
			$fecha_ven = $anio[$e].'-'.$mes[$e].'-'.$dia[$e];
			
			$in = intval($fecha[$e]);
			
			$in = $in - 1;
			
			imprimir::update3($fecha_ven,$factura[$e],$linea[$in]);
			echo "<br>Se actualizo la fecha de vencimiento";
			//echo "<p>g: ".$g;
			/**Agrego insercion en tabla de preparaciones para la nave**/
			
			$pres = imprimir::select6($factura[$e],$linea[$in]);
			
			foreach($pres as $prow){				
				$turno = $prow->turno;	
				$codigo_carro = $prow->codigo_carro;
				$average = $prow->average;
				$fact = 	$factura[$e];
				$lin = $linea[$in];
				$fecha_creacion = $prow->fecha_creacion;
				$stat_inicio = $prow->stat_inicio;
				$hora_inicio_entrega = $prow->hora_inicio_entrega;
				$cantidad_entregas = $prow->cantidad_entregas;
				$turno = $prow->turno;
				
				if($stat_inicio != 'S'){
					
					$sres = imprimir::select7($turno);					
					
					$cont = 0;
					
					foreach($sres as $srow){	
						$cont = $cont + 1;
						
						$id_frecuencia = $srow->id_frecuencia;
						
						if($cont <= $average){
							
							
							imprimir::insert2($fact,$lin,$codigo_carro,$id_frecuencia);
							
						}
						
					}
					
					} else {
					
					$fres = imprimir::select8();
					
					foreach($fres as $frow){
						$codigo_carro_p = $frow->codigo_carro;
						$intervalo1 = $frow->intervalo1;
					}
					
					
					$hora_actual = date('Y-m-d H:i:s', time());
					
					
					
					$i = 1;
					//$turno = date('Y-m-d', time()).' '.
					
					
					$pres = imprimir::select9();
					
					foreach($pres as $prow){
						${'turno_'.$i} = date('Y-m-d', time()).' '.$prow->hora; 
						
						$i = $i + 1;
					}
					$turno_4 = date('Y-m-d H:i:s', strtotime($turno_4. ' + 1 days'));
					
					if($turno == 1){
						
						$hora_inicio_entrega = date('Y-m-d', time()).' 00:00'; 
						$hora_inicio_entrega = date('Y-m-d H:i:s', strtotime($hora_inicio_entrega. ' + 1 days'));
						
					}
					
					/*echo "<p>turno 1: ".$turno_1;
						echo "<p>turno 2: ".$turno_2;
						echo "<p>turno 3: ".$turno_3;
						echo "<p>turno 4: ".$turno_4;
						
						echo "<p>hora inicio entrega: ".$hora_inicio_entrega;
						echo "<p>hora actual: ".$hora_actual;
						echo "<p>hora inicio entrega str: ".strtotime($hora_inicio_entrega);
					echo "<p>turno str: ".strtotime($turno_3);*/
					
					
					if (strtotime($hora_inicio_entrega) > strtotime($turno_1) && strtotime($hora_inicio_entrega) <= strtotime($turno_2)) {
						//echo "<p>se le asigna turno 1";
						$turno_inicio = 1;
						$hora_turno_inicio = $turno_1;
						} else if (strtotime($hora_inicio_entrega) > strtotime($turno_2) && strtotime($hora_inicio_entrega) <= strtotime($turno_3)) {
						//echo "<p>se le asigna turno 2";
						$turno_inicio = 2;
						$hora_turno_inicio = $turno_2;
						} else if (strtotime($hora_inicio_entrega) > strtotime($turno_3) && strtotime($hora_inicio_entrega) < strtotime($turno_4)) {
						//	echo "<p>se le asigna turno 3";
						$turno_inicio = 3;
						$hora_turno_inicio = $turno_3;
						} else if (strtotime($hora_inicio_entrega) >= strtotime($turno_4)) {
						//	echo "<p>se le asigna turno 4";
						$turno_inicio = 4;
						$hora_turno_inicio = $turno_4;
					} 
					
					
					
					
					do {
						$cont = $cont + 1;
						if($cont == 1){
							$hora_calcular = $hora_actual;
							
							} else {
							$hora_calcular = $hora_inicio_entrega;
						}
						
						
						if(strtotime($hora_calcular) > strtotime($hora_turno_inicio)){
							
							$eires = imprimir::select10($fact,$lin,$id_frecuencia);
							
							$einum = count($eires);
							
							if($einum == 0){
								$cantidad_entregas = $cantidad_entregas + 1;
								imprimir::insert3($fact,$lin,$codigo_carro_p,$turno_inicio);
							}
						}
						
						
						
						$hora_inicio_entrega = date('Y-m-d H:i:s', strtotime($hora_inicio_entrega.'+'.$horas.' hour'));
						
					} while ($cont <= $average);
										
					$sres = imprimir::select11($turno,$turno_inicio);
					
					foreach($sres as $srow){ 	
						$cont1 = $cont1 + 1;
						
						$average1 = $average - $cantidad_entregas;
						
						$id_frecuencia = $srow->id_frecuencia;
						
						$eres = imprimir::select12($fact,$lin,$id_frecuencia);
						
						$enum = count($eres);
						
						if($enum == 0){
							if($cont1 <= $average1){
								//echo "<p> lo inserto en un turno normal";								
								imprimir::insert4($fact,$lin,$codigo_carro_p,$id_frecuencia);
							}}
							
							
					} 
					
					
					
				} }
				
		}
		
		
		
		
		} else {
		
		if($imprimir == 0){
			echo "Debe escoger un label para poder imprimirlo";
			
			} else {
			for($d = 0; $d < sizeof($linea); $d++) {
				
				$gres = imprimir::select13($factura[$d]);
				
				$hres = imprimir::select14($factura[$d]);
				
				foreach($gres as $grow){
					$cantidad_lote = $grow->cantidad_lote;
				}
				
				foreach($hres as $hrow){
					$cantidad_factura = $hrow->cantidad_factura;
				}
				
			}
			
			//echo "cantidad lote: ".$cantidad_lote;
			//echo "cantidad factura: ".$cantidad_factura;
			
			if($cantidad_lote == $cantidad_factura){
				
				
				
				
				if ($lbl == 1) {
					
					$tamano = array(90,29);
					
					$pdf = new TCPDF('L', 'mm', $tamano, true, 'UTF-8', false);
					
					for($c = 0; $c < sizeof($imprimir); $c++) {
						
						//echo "la linea ".$linea[$c]."el valor de imprimir es ".$imprimir[$c]." de la factura ".$factura[$c];
						
						$res = imprimir::select15($factura[$c],$imprimir[$c]);
						
						foreach($res as $rows){							
							//echo "cantidad ".$rows->cantidad;
							
							
							$turno = $rows->turno;
							$linea_cod = $rows->linea;
							
							$bres = imprimir::select16($factura[$c]);
							
							foreach($bres as $brow){
								$stat = $brow->stat;
							}
							
							
							if($stat != 'S'){
								
								$gres = imprimir::select17($turno);
								
								foreach($gres as $grow){
									$inicio_turno = $grow->id_turno_inicio;
								}
								} else{
								
								
								$gres = imprimir::select18($factura[$c],$linea_cod);
								
								foreach($gres as $grow){
									$inicio_turno = $grow->hora_inicio_entrega;
									
								}
							}
							
							
							$inicio_turno = date('H:i',strtotime($inicio_turno));
							
							
							for ($i=1; $i<=ceil($rows->average); $i++) {
								
								$medicamento = $rows->medicamento;
								$horas = $rows->horas;
								$dias = $rows->dias;
								$paciente =  preg_replace('([^A-Z a-z 0-9])', '',$rows->nom_paciente);
								$cama = $rows->no_cama;
								$medico = preg_replace('([^A-Z a-z 0-9])', '',$rows->nombre);
								$fecha = date('Y-m-d H:i',time());
								$localidad = $rows->localidad_entrega;
								$dosis = $rows->dosis;
								$cargo = $rows->cargo;
								//$lote = $rows->lote;
								$turno = $rows->turno;
								$cantidad = $rows->cantidad;
								$factura_cod = $rows->factura;
								
								$codigo = str_pad($factura_cod, 10, 0, STR_PAD_LEFT).str_pad($linea_cod, 2, 0, STR_PAD_LEFT);
								$medicamento_id = $rows->medicamento_id;
								//echo "codigo: ".$codigo;
								
								/////anterior////////
								
								/*
									$pdf->AddPage();
									$pdf->SetMargins(2,2,2);
									$pdf->SetAutoPageBreak(3);
									$pdf->SetY(5) ;
									$pdf->SetFont('Arial','B',8);
									$pdf->Write(4, $paciente."      Dr.: ".$medico."      No. Cama: ".$cama."\n");
									//$pdf->Write(4, $firstname." ".$lastname); 
									//$pdf->Line(3, 10, 86, 10);
									$pdf->SetFont('Arial','B',8);
									//$pdf->Text(5, 15, $address) ;
									$pdf->Write(4, $medicamento); 
									$pdf->Write(4, "\n Cada ".$horas." hrs. por ".$dias." dias,   Entregar en: ".$localidad); 
									$pdf->Write(4, "\n Dosis: ".$dosis." Fecha: ".$fecha." Orden No.: ".$cargo); 
									$data= date("dmy");  
									$fileD = $factura[$c]."_".$linea[$c].".pdf";
									
								*/
								///fin anterior////////
								//echo "l: ".$l;
								$lres = imprimir::select19($factura_cod,$medicamento_id,$inicio_turno);
								$lote = ' ';
								foreach($lres as $lrow){
									$lote .= $lrow->lote.',';
									
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
								'stretch' => false,  //false
								'fitwidth' => true, //true
								'cellfitalign' => '',
								'border' => false,
								'hpadding' => 'auto',
								'vpadding' => 'auto',
								'fgcolor' => array(0,0,0),
								'bgcolor' => false, //array(255,255,255),
								'text' => true,
								'font' => 'helvetica',
								'fontsize' => 6,
								'stretchtext' => 3
								);
								
								/*
									
									$params = $pdf->serializeTCPDFtagParameters(array($codigo, 'EAN13', '', '', 45, 12, 4, array('position'=>'', 'border'=>false, 'padding'=>1, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>4, 'stretchtext'=>6), 'N'));
									
									
									
									$params = $pdf->serializeTCPDFtagParameters(array($codigo, 'EAN13', '', '', 44, 12, 0.5, $style, 'N')); 
									
								*/
								
								$params = $pdf->serializeTCPDFtagParameters(array($codigo, 'EAN13', '', '', 35, 10, 0.5, array('position'=>'', 'border'=>false, 'padding'=>1, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>4, 'stretchtext'=>6), 'N'));
								
								
								
								$tbl = '<table border="0.5" cellpadding="0.5">
								<tr><td colspan="3">'.$paciente.'</td></tr>	
								<tr>
								<td width="45%">Dr.'.$medico.'</td><td width="25%">No. Cama: '.$cama.'</td><td width="30%">Orden No.: '.$cargo.'</td></tr>
								<tr>
								<td colspan="3">'.$medicamento.'</td></tr>
								<tr>
								<td width="23%">Dosis:'.$dosis.'<br>Cantidad:'.$cantidad.'<br>Ent.: '.$localidad.'</td><td width="27%">Hora Adm:'.$inicio_turno.'<br>Lote: </td><td width="50%" style="text-align:center"><tcpdf method="write1DBarcode" params="'.$params.'" /></td></tr>
								</table>';
								
								
								$pdf->SetFont('helvetica','',8);
								
								$pdf->writeHTML($tbl, true, false, false, false, '');
								
								$inicio_turno = date('H:i', strtotime($inicio_turno.'+'.$horas.' hour'));
								
								
							}
							
							
						}
						
					}
					$pdf -> Output();
					
					} else {
					
					
					$tamano = array(100,62);
					
					$pdf = new TCPDF('L', 'mm', $tamano, true, 'UTF-8', false);
					
					
					for($c = 0; $c < sizeof($imprimir); $c++) {
						
						//echo "la linea ".$linea[$c]."el valor de imprimir es ".$imprimir[$c];
						
						
						$res = imprimir::select20($factura[$c],$imprimir[$c]);
						
						foreach($res as $rows){
							
							$turno = $rows->turno;
							$linea_cod = $rows->linea;							
							
							$bres = imprimir::select21($factura[$c]);
							
							foreach($bres as $brow){
								$stat = $brow->stat;
							}
							
							
							if($stat != 'S'){
								$gres = imprimir::select22($turno);
								
								foreach($gres as $grow){
									$inicio_turno = $grow->id_turno_inicio;
								}
								} else{
																
								$gres = imprimir::select23($factura[$c],$linea_cod);
								
								foreach($gres as $grow){
									$inicio_turno = $grow->hora_inicio_entrega;
									
								}
							}
							
							$inicio_turno = date('H:i', strtotime($inicio_turno));
							
							if (!empty($rows->fecha_vencimiento)){
								
								for ($i=1; $i<=ceil($rows->average); $i++) {
									
									
									
									
									$medicamento = $rows->medicamento;
									$horas = $rows->horas;
									$dias = $rows->dias;
									$paciente = preg_replace('([^A-Z a-z 0-9])', '',$rows->nom_paciente);
									$cama = $rows->no_cama;
									$medico = preg_replace('([^A-Z a-z 0-9])', '',$rows->nombre);
									$fecha = date('Y-m-d H:i',time());
									$localidad = $rows->localidad_entrega;
									$dosis = $rows->dosis;
									$fecha_vencimiento = $rows->fecha_vencimiento;
									$cargo = $rows->cargo;
									$cantidad = $rows->cantidad;
									$factura_cod = $rows->factura;
									//$lote = $rows->lote;
									$codigo = str_pad($factura_cod, 10, 0, STR_PAD_LEFT).str_pad($linea_cod, 2, 0, STR_PAD_LEFT);
									$medicamento_id = $rows->medicamento_id;
									
									
									if (!empty($rows->observacion_farma)){
										$observacion = $rows->observacion_farma;
										} else {
										$observacion = $rows->observacion;
									}
								
									$lres = imprimir::select24($factura_cod,$medicamento_id,$inicio_turno);
									$lote = ' ';
									foreach($lres as $lrow){
										$lote .= $lrow->lote.',';
										
									}
									
									/*
										$pdf->AddPage();
										$pdf->SetMargins(2,2,2);
										$pdf->SetAutoPageBreak(3);
										$pdf->SetY(5) ;
										$pdf->SetFont('Arial','B',12);
										$pdf->Write(4, $paciente."\n");
										$pdf->Ln(1);
										$pdf->Write(4, "Dr.: ".$medico." \n");
										$pdf->Ln(1);
										$pdf->Write(4, "No. Cama: ".$cama."\n");
										//$pdf->Write(4, $firstname." ".$lastname); 
										//$pdf->Line(3, 10, 86, 10);
										$pdf->SetFont('Arial','B',12);
										//$pdf->Text(5, 15, $address) ;
										$pdf->Ln(1);
										$pdf->Write(4, $medicamento); 
										$pdf->Ln(1);
										$pdf->Ln(1);
										$pdf->Ln(1);
										$pdf->Ln(1);
										$pdf->Write(4, $observacion); 
										$pdf->Ln(1);
										$pdf->Ln(1);
										$pdf->Write(4, "\n Cada ".$horas." hrs. por ".$dias." días "); 
										$pdf->Ln(1);
										$pdf->Write(4, "\n Dosis: ".$dosis); 
										$pdf->Ln(1);
										$pdf->Write(4, "\n Entregar en: ".$localidad." Fecha: ".$fecha." Orden No.:".$cargo);
										//$pdf->Write(4, "\n Por ".$dias." dias "); 
										$pdf->Ln(1);
										$pdf->Write(4, "\n Exp: ".$fecha_vencimiento." Hora: ___________ "); 
										
										$data= date("dmy");  
										$fileD = $factura[$c]."_".$linea[$c].".pdf";
									*/
									
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
									
									
									$params = $pdf->serializeTCPDFtagParameters(array($codigo, 'EAN13', '', '', 40, 10, 0.8, array('position'=>'', 'border'=>false, 'padding'=>1, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>4, 'stretchtext'=>6), 'N'));
									
									$tbl = '<table border="0.5" cellpadding="0.5">
									<tr><td colspan="3">'.$paciente.'</td></tr>	 
									<tr><td>Dr.'.$medico.'</td><td>No. Cama: '.$cama.' </td><td>Orden No.: '.$cargo.'</td></tr>
									<tr><td colspan="3">'.$medicamento.'</td></tr>
									<tr><td colspan="3">'.$observacion.'</td></tr>
									<tr><td>Dosis:'.$dosis.'<br>Fecha de Vencimiento: '.$fecha_vencimiento.'</td><td>Cantidad:'.$cantidad.'<br>Hora: '.$hora.'</td><td>Hora Adm:'.$inicio_turno.'<br>Entregar en: '.$localidad.'<br>Lote: </td></tr>
									<tr><td colspan="3" style="text-align:center"><tcpdf method="write1DBarcode" params="'.$params.'" /></td></tr>
									
									</table>';
									
									
									$pdf->SetFont('helvetica','',10);
									
									$pdf->writeHTML($tbl, true, false, false, false, '');
									
									$inicio_turno = date('H:i', strtotime($inicio_turno.'+'.$horas.' hour'));
									
								} 
								
								}else { 
								echo "Hay una preparación sin fecha de vencimiento, verifique!!";
							}
						} 
						
					}$pdf -> Output();
					
				}
				
				} else{
			echo "No ha asignado la cantidad por lote de medicamento a entregar, verifique!";}
		}
		
	}
	/*
		$output = shell_exec('lpr -P label1 /var/www/htdocs/apdosis/htdocs/labels/102_1.pdf | lpstat -t' );
		echo "<pre>$output</pre>";
	sleep(2);*/	
?>
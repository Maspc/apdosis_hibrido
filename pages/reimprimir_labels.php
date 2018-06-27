<?php
	
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/reimprimir_labels.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	//require ('fpdf.php');
	require ('TCPDF/tcpdf.php');
	if (isset($_GET['factura'])) { 
	$factura=$_GET['factura'];}
	
	$pdf = new TCPDF('L','mm');
	
	
	
	$fres = rei_l::select1($factura);
	
	foreach($fres as $frow){
		
		$linea = $frow->linea;
		
		if ($frow->preparacion != 'S'){
			$tamano = array(90,29);
			
			
			//echo "la linea ".$linea[$c]."el valor de imprimir es ".$imprimir[$c]." de la factura ".$factura[$c];
			
			
			$res = rei_l::select2($factura,$linea);
			foreach($res  as $rows)
			
			{
				
				//echo "cantidad ".$rows['cantidad'];
				
				
				$turno = $rows->turno;
				$linea_cod = $rows->linea;
				
				
				
				$bres =rei_l::select3($factura);
				foreach($bres as $brow)
				{
					$stat = $brow->stat;
				}
				
				
				if($stat != 'S'){
					
					$gres =rei_l::select4($turno);	
					foreach($gres as $grow)
					
					{
						$inicio_turno = $grow->id_turno_inicio;
					}
					} else{
					
					
					$gres =rei_l::select5($factura,$linea_cod);	
					foreach($gres as $grow)
					
					
					{
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
					//$lote = $rows['lote'];
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
					$lres =rei_l::select6($factura_cod,$medicamento_id,$inicio_turno);
					//echo "l: ".$l;
					
					$lote = ' ';
					foreach($lres as $lrow)
					{
						$lote .= $lrow->lote.',';
						
					}
					
					$pdf->AddPage('L',$tamano);
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
					<td width="23%">Dosis:'.$dosis.'<br>Cantidad:'.$cantidad.'<br>Ent.: '.$localidad.'</td><td width="27%">Hora Adm:'.$inicio_turno.'<br>Lote: '.$lote.'</td><td width="50%" style="text-align:center"><tcpdf method="write1DBarcode" params="'.$params.'" /></td></tr>
					</table>';
					
					
					$pdf->SetFont('helvetica','',8);
					
					$pdf->writeHTML($tbl, true, false, false, false, '');
					
					$inicio_turno = date('H:i', strtotime($inicio_turno.'+'.$horas.' hour'));
					
					
				}
				
				
			}
			
			
			
			
			
			
			} else {
			
			//$pdf = new FPDF('L','mm',array(100,62));
			
			
			$tamano = array(100,62);
			//echo "la linea ".$linea[$c]."el valor de imprimir es ".$imprimir[$c];
			
			
			
			$res =rei_l::select7($factura,$linea);
			foreach($res as $rows)
			
			
			{
				
				$turno = $rows->turno;
				$linea_cod = $rows->linea;
				
				
				
				$bres =rei_l::select8($factura);
				foreach($bres as $brow )
				
				{
					$stat = $brow->stat;
				}
				
				
				if($stat != 'S'){
					
					$gres = rei_l::select9($turno);
					foreach($gres as $grow )
					
					{
						$inicio_turno = $grow->id_turno_inicio;
					}
					} else{
					
					
					$gres = rei_l::select10($factura,$linea_cod);	
					foreach($gres as $grow)
					{
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
						//$lote = $rows['lote'];
						$codigo = str_pad($factura_cod, 10, 0, STR_PAD_LEFT).str_pad($linea_cod, 2, 0, STR_PAD_LEFT);
						$medicamento_id = $rows->medicamento_id;
						
						
						if (!empty($rows->observacion_farma)){
							$observacion = $rows->observacion_farma;
							} else {
							$observacion = $rows->observacion;
						}
						
						
						$lres = rei_l::select11(($factura_cod,$medicamento_id,$inicio_turno);
						
						$lote = ' ';
						foreach($lres as $lrow)
						{
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
						
						$pdf->AddPage('L',$tamano);
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
						<tr><td>Dosis:'.$dosis.'<br>Fecha de Vencimiento: '.$fecha_vencimiento.'</td><td>Cantidad:'.$cantidad.'<br>Hora: '.$hora.'</td><td>Hora Adm:'.$inicio_turno.'<br>Entregar en: '.$localidad.'</td></tr>
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
			
		}
		
		
		
		
	}
	
	
	
	$pdf -> Output();
	
	
	
	
	
	
	/*
		$output = shell_exec('lpr -P label1 /var/www/htdocs/apdosis/htdocs/labels/102_1.pdf | lpstat -t' );
		echo "<pre>$output</pre>";
	sleep(2);*/
	
	
	
	
	layout::fin_content();
?>


<?php
	require ('TCPDF/tcpdf.php');
	error_reporting(E_ALL & ~E_NOTICE);
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_estado.php');
	$id_cliente = $_POST['codigo_cliente'];
	
	/***REALIZO ANALISIS DE ANTIGUEDAD PARA CLIENTE ***/
	
	$hrow = iestado::lfactura($id_cliente);
	
	$saldo_corriente = 0;
	$saldo_30 = 0;
	$saldo_60 = 0;
	$saldo_90 = 0;
	$saldo_120 = 0;
	$saldo_total = 0;
	
	foreach($hrow as $hw){
		$factura = $hw->factura;
		$saldo_pendiente = $hw->saldo_pendiente;
		$fecha = $hw->fecha;
		$fecha_30 = $hw->fecha_30;
		$fecha_60 = $hw->fecha_60;
		$fecha_90 = $hw->fecha_90;
		$fecha_120 = $hw->fecha_120;		
		
		$irow = iestado::devol($factura);
		
		if(count($irow) > 0){
			
			foreach($irow as $iw){
				$total_dev = $iw->total;
				
				$saldo_pendiente = $saldo_pendiente - $total_dev;
				
				if($saldo_pendiente < 0) {
					$saldo_pendiente = 0;
				}
			}
			
			
		}		
		
		if ($fecha >  $fecha_30) {
			$saldo_corriente = $saldo_corriente + $saldo_pendiente;		
			} else if ($fecha <= $fecha_30 && $fecha > $fecha_60) {
			$saldo_30 = $saldo_30 + $saldo_pendiente;		
			} else if ($fecha <= $fecha_60 && $fecha > $fecha_90) {
			$saldo_60 = $saldo_60 + $saldo_pendiente;
			} else if ($fecha <= $fecha_90 && $fecha > $fecha_120) {
			$saldo_90 = $saldo_90 + $saldo_pendiente;		
			} else if ($fecha <= $fecha_120) {
			$saldo_120 = $saldo_120 + $saldo_pendiente;	
		}	
		
	}
	
	$saldo_total = $saldo_corriente + $saldo_30 + $saldo_60 + $saldo_90 + $saldo_120;
	
	$lrow = iestado::dual();
	
	foreach($lrow as $lw){
		$mes = $lw->mes;
		$anio = $lw->anio;
		$fecha = $lw->fecha;
	}	
	
	iestado::delete_sclie($id_cliente);
	
	iestado::insert_sclie($id_cliente, $saldo_corriente,$saldo_30,$saldo_60, $saldo_90, $saldo_120, $saldo_total,$mes,$anio, $fecha);
	
	/***FIN DE REALIZO ANALISIS DE ANTIGUEDAD PARA CLIENTE ***/
	
	$rowd = iestado::usuarios($_SESSION['MM_iduser']);
	
	foreach($rowd as $rd){
		$username = $rd->nombre;
	}
	
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->AddPage();
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	
	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	
	$grow = iestado::lclientes($id_cliente);
	
	foreach($grow as $grw){
		$nombre = $grw->nom;
		$saldo_corriente = number_format($grw->saldo_corriente,2,'.',',');
		$saldo_30 = number_format($grw->saldo_30,2,'.',',');
		$saldo_60 = number_format($grw->saldo_60,2,'.',',');
		$saldo_90 = number_format($grw->saldo_90,2,'.',',');
		$saldo_120 = number_format($grw->saldo_120,2,'.',',');
		$saldo_total = number_format($grw->saldo_total,2,'.',',');
		$identificacion = $grw->identificacion;
		
		
		$tbl1 = '<table style="text-align:center; border:1px solid black;">
		<tr><td colspan="6"><b>FARMACIA CENTRO M&Eacute;DICO PAITILLA - ESTADO DE CUENTA</b></td></tr>	 
		<tr>
		<td colspan="3">Nombre Cliente:  '.$nombre.' </td>
		<td colspan="3">C&eacute;dula o RUC: '.$identificacion.'</td></tr><tr>
		<td colspan="6">Fecha: '.$fecha.'</td>
	    </tr></table>';		
		
		$tbl2 = '<table><tr><td colspan="6" style=" text-align:center; border:1px solid black;    background-color: #000000;
		color: white;"><b>TRANSACCIONES DEL MES CORRIENTE</b></td></tr><tr><td colspan="2"><b>Fecha</b></td><td colspan="2"><b>Tipo Transacci&oacute;n</b></td><td colspan="2" style="text-align:right;"><b>Monto</b></td></tr>';
		
		$hrow = iestado::ldocs($id_cliente);
		
		if(count($hrow) > 0){
			foreach($hrow as $hrw){
				$tipo_tran = $hrw->tipo_tran;
				$fecha = $hrw->fecha;
				$total = number_format($hrw->total,2,'.',',');
				
				$tbl2 .= '<tr><td colspan="2">'.$fecha.'</td><td colspan="2">'.$tipo_tran.'</td><td colspan="2" style="text-align:right;">'.$total.'</td></tr>';
			}
			} else {
			
			$tbl2 .= '<tr><td colspan="6">No existen transacciones para este mes</td></tr>';			
		}
		
		$tbl2 .= '</table>';
		
			$tbl3 = '<table style="text-align:center; border:1px solid black;"><tr><td colspan="6" style="border:1px solid black;    background-color: #000000;
			color: white;"><b>AN&Aacute;LISIS DE ANTIG&Uuml;EDAD</b></td></tr><tr><td style="border:1px solid black;" ><b>Saldo Corriente</b></td><td style="border:1px solid black;" ><b>Saldo 30 d&iacute;as</b></td><td style="border:1px solid black;" ><b>Saldo 60 d&iacute;as</b></td><td style="border:1px solid black;" ><b>Saldo 90 d&iacute;as</b></td><td style="border:1px solid black;" ><b>Saldo 120 d&iacute;as</b></td><td style="border:1px solid black;" ><b>Saldo Total</b></td></tr>
			<tr><td style="border:1px solid black;" >'.$saldo_corriente.'</td><td>'.$saldo_30.'</td><td style="border:1px solid black;" >'.$saldo_60.'</td><td style="border:1px solid black;" >'.$saldo_90.'</td><td style="border:1px solid black;" >'.$saldo_120.'</td><td>'.$saldo_total.'</td></tr>
			
			</table>';
			
			$pdf->writeHTML($tbl1, true, false, false, false, '');
			$pdf->writeHTML($tbl2, true, false, false, false, '');
			$pdf->writeHTML($tbl3, true, false, false, false, '');
	}
	
	$pdf->Output();
?>			
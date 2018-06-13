<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/imprimir_recibo_credito.php');
	require_once('./mysql_table.php');
	
	$z = $_GET['id_recibo'];
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{			
			$ciaro = ircredito::compania();
			foreach($ciaro as $co){
				$nom_cia = $co->nombre;
			}
			//Title
			$z = $_GET['id_recibo'];
			$this->SetFont('Arial','',18);
			$titulo = 'Recibo de Pago a Crédito '.$z.' - '.$nom_cia;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	$rowd = ircredito::usuarios($_SESSION['MM_iduser']);
	foreach($rowd as $rd){
		$username = $rd->nombre;
	}
	
	$pdf=new PDF();
	$pdf->AddPage();
	//First table: put all columns automatically
	$pdf->AddCol('Nombre',50,'Nombre de Cliente','C');
	$pdf->AddCol('identificacion',50,'Identificación','C');
	$pdf->AddCol('monto',25,'Monto Pagado','C');
	$pdf->AddCol('fecha',30,'Fecha de Pago','C');
	$pdf->AddCol('Usuario',25,'Usuario','C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.id_recibo as Recibo, a.id_cliente, concat(b.nombre, ' ',b.apellido) as Nombre,  b.identificacion,	a.creado_por as Usuario, a.monto_pagado as monto, a.fecha from recibo_credito a, clientes b where id_recibo = '$z' and a.id_cliente = b.id_cliente ", $prop3);
	$pdf->Ln(10);
	
	$pdf->Write(5,'Recibido por: ');
	$hora_actual = date("Y-m-d H:i",time());
	$pdf->Ln(10);
	$pdf->Ln(10);
	$pdf->Write(5,'_______________________________________________');
	$pdf->Ln(10);
	$pdf->Write(5,$username);
	$pdf->Ln(5);
	$pdf->Write(5,'Autorizado por: ');
	$pdf->Ln(10);
	$pdf->Ln(10);
	$pdf->Write(5,'_______________________________________________');
	$pdf->Ln(10);
	
	//$pdf -> Output($z.".pdf","F");
	//$output = shell_exec('lpr -P cargos1  /var/www/htdocs/apdosis/htdocs/apdosis/fact/'.$z.'.pdf | lpstat -t' );
	//echo "<pre>$output</pre>";
	//sleep(2);
	$pdf->Output();
?>

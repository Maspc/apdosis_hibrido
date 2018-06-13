<?php
	//Connect to database
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/cierre_caja.php');
	require_once('./mysql_table.php');
	
	$cierre = $_GET['cierre'];
	
	$grow = cierrecaja::cierres_caja_rep($cierre);
	foreach($grow as $gw){
		$fecha_inicio = $gw->fecha_inicio;
		$fecha_fin = $gw->fecha_fin;
		$monto_inicial = $gw->monto_inicial;
		$monto_final = $gw->monto_final;
	}
	
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{
			//Title
			$this->SetFont('Arial','',18);
			$cierre = $_GET['cierre'];
			$titulo = 'Reporte de Caja No. '.$cierre;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}	
	
	$username = cierrecaja::usuario($_SESSION['MM_iduser']);
	
	
	$pdf=new PDF();
	$pdf->AddPage();
	//First table: put all columns automatically
	$pdf->AddCol('monto_inicial',50,'Monto Inicial', 'C');
	$pdf->AddCol('monto_final',50,'Monto Final', 'C');
	$pdf->AddCol('fecha_inicio',50,'Fecha Inicio', 'C');
	$pdf->AddCol('fecha_fin',50,'Fecha Final', 'C');
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("select fecha_inicio, fecha_fin, (monto_inicial * -1) as monto_inicial, (monto_final * -1) as monto_final from cierres_de_caja where codigo_cierre = '$cierre'", $prop3);
	
	$pdf->Ln(10);
	
	
	$pdf->AddCol('recibo',20,'Recibo', 'C');
	$pdf->AddCol('nombre',50,'Nombre', 'C');
	$pdf->AddCol('rubro',30,'Rubro','C');
	$pdf->AddCol('descripcion',60,'Descripcion','C');
	$pdf->AddCol('total',20,'Monto','C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.id_recibo as recibo, a.codigo_rubro, b.descripcion as rubro, a.descripcion, a.total, c.proveedor as nombre from recibos_detalle a, rubros b, recibos c where a.id_recibo = c.id_recibo and a.codigo_rubro = b.codigo_rubro and a.codigo_rubro != 5 and c.fecha_recibo between '$fecha_inicio' and '$fecha_fin'", $prop3);
	
	$pdf->Ln(10);
	$pdf->AddCol('total',50,'Total de Salidas', 'C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	
	$pdf->Table("SELECT sum(total) as total from recibos_detalle a, recibos b where a.id_recibo = b.id_recibo and a.codigo_rubro != 5 and b.fecha_recibo between '$fecha_inicio' and '$fecha_fin'", $prop3);
	
	
	
	$pdf->Ln(10);
	$pdf->AddCol('recibo',20,'Recibo', 'C');
	$pdf->AddCol('nombre',50,'Nombre', 'C');
	$pdf->AddCol('rubro',30,'Rubro','C');
	$pdf->AddCol('descripcion',60,'Descripcion','C');
	$pdf->AddCol('monto',20,'Monto','C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.id_recibo as recibo, a.codigo_rubro, b.descripcion as rubro, a.descripcion, abs(a.total) as monto, c.proveedor as nombre from recibos_detalle a, rubros b, recibos c where a.id_recibo = c.id_recibo and a.codigo_rubro = b.codigo_rubro and a.codigo_rubro = '5' and c.fecha_recibo between '$fecha_inicio' and '$fecha_fin'", $prop3);
	
	$pdf->Ln(10);
	$pdf->AddCol('total',50,'Total de Entradas', 'C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	
	$pdf->Table("SELECT sum(abs(total)) as total from recibos_detalle a, recibos b where a.id_recibo = b.id_recibo and a.codigo_rubro = 5 and b.fecha_recibo between '$fecha_inicio' and '$fecha_fin'", $prop3);
	
	
	
	$pdf->Ln(10);
	
	$pdf->Write(5,'Revisado por: ');
	$hora_actual = date("Y-m-d H:i",time());
	$pdf->Ln(10);
	$pdf->Ln(10);
	$pdf->Write(5,'_______________________________________________');
	$pdf->Ln(10);
	$pdf->Write(5,$username);
	$pdf->Ln(10);
	$pdf->Write(5,'Hora de Proceso: '.$hora_actual);
	
	//$pdf -> Output($z.".pdf","F");
	//$output = shell_exec('lpr -P cargos1  /var/www/htdocs/apdosis/htdocs/apdosis/fact/'.$z.'.pdf | lpstat -t' );
	//echo "<pre>$output</pre>";
	//sleep(2);
	$pdf->Output();
?>

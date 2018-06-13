<?php
	include('./clases/session.php');
	require_once('../modulos/reporte_caja.php');
	require_once('./mysql_table.php');
	
	$fecha1 = $_POST['fecha1'];
	$fecha2 = $_POST['fecha2'];
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{
			//Title
			$fecha1 = $_POST['fecha1'];
			$fecha2 = $_POST['fecha2'];
			$this->SetFont('Arial','',18);
			$titulo = 'Reporte de Caja del '.$fecha1. ' al '.$fecha2;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	$username = report_caja::usuario($_SESSION['MM_iduser']);	
	
	$pdf=new PDF();
	$pdf->AddPage();
	//First table: put all columns automatically
	$pdf->AddCol('nombre',50,'Nombre', 'C');
	$pdf->AddCol('rubro',30,'Rubro','C');
	$pdf->AddCol('descripcion',60,'Descripcion','C');
	$pdf->AddCol('monto',20,'Monto','C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.codigo_rubro, b.descripcion as rubro, a.descripcion, a.monto, c.proveedor as nombre from recibos_detalle a, rubros b, recibos c where a.id_recibo = c.id_recibo and a.codigo_rubro = b.codigo_rubro and a.codigo_rubro != 5 and c.fecha_recibo between '$fecha1' and '$fecha2'", $prop3);
	
	$pdf->Ln(10);
	$pdf->AddCol('total',50,'Total de Salidas', 'C');
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Ln(10);
	$pdf->Table("SELECT sum(monto) as total from recibos_detalle a, recibos b where a.id_recibo = b.id_recibo and a.codigo_rubro != 5 and b.fecha_recibo between '$fecha1' and '$fecha2'", $prop3);
	
	$pdf->Ln(10);
	$pdf->AddCol('nombre',50,'Nombre', 'C');
	$pdf->AddCol('rubro',30,'Rubro','C');
	$pdf->AddCol('descripcion',60,'Descripcion','C');
	$pdf->AddCol('monto',20,'Monto','C');
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.codigo_rubro, b.descripcion as rubro, a.descripcion, abs(a.monto) as monto, c.proveedor as nombre from recibos_detalle a, rubros b, recibos c where a.id_recibo = c.id_recibo and a.codigo_rubro = b.codigo_rubro and a.codigo_rubro = 5 and c.fecha_recibo between '$fecha1' and '$fecha2'", $prop3);
	
	$pdf->Ln(10);
	$pdf->AddCol('total',50,'Total de Entradas', 'C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	
	$pdf->Table("SELECT sum(abs(monto)) as total from recibos_detalle a, recibos b where a.id_recibo = b.id_recibo and a.codigo_rubro = 5  and b.fecha_recibo between '$fecha1' and '$fecha2'", $prop3);
	
	
	$pdf->Ln(10);
	$pdf->Write(5,'Entregado por: ');
	$hora_actual = date("Y-m-d H:i",time());
	$pdf->Ln(10);
	$pdf->Ln(10);
	$pdf->Write(5,'_______________________________________________');
	$pdf->Ln(10);
	$pdf->Write(5,$username);
	$pdf->Ln(10);
	$pdf->Write(5,'Recibido por: ');
	$pdf->Ln(10);
	$pdf->Ln(10);
	$pdf->Write(5,'_______________________________________________');
	$pdf->Ln(10);
	$pdf->Write(5,'Hora de Proceso: '.$hora_actual);
	
	//$pdf -> Output($z.".pdf","F");
	//$output = shell_exec('lpr -P cargos1  /var/www/htdocs/apdosis/htdocs/apdosis/fact/'.$z.'.pdf | lpstat -t' );
	//echo "<pre>$output</pre>";
	//sleep(2);
	$pdf->Output();
?>
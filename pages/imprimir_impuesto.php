<?php
	include('./clases/session.php');
	require_once('../modulos/ventas_impuesto.php');
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
			$titulo = 'Reporte de Impuesto por Ventas del '.$fecha1. ' al '.$fecha2;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	$rowd = vimpuesto::usuarios($_SESSION['MM_iduser']);
	foreach($rowd as $rw){
		$username = $rw->nombre;
	}
	
	$pdf=new PDF();
	$pdf->AddPage('L');
	//First table: put all columns automatically
	$pdf->AddCol('FA',20,'FA', 'C');
	$pdf->AddCol('factura_fiscal',25,'Fact. Fiscal','C');
	$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
	$pdf->AddCol('historia',30,'Historia','C');
	$pdf->AddCol('id_paciente',30,'Id. Paciente','C');
	$pdf->AddCol('nombre_paciente',80,'Nombre','C');
	$pdf->AddCol('total',20,'Total','C');
	$pdf->AddCol('impuesto',20,'Impuesto','C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.FA, a.id_paciente, b.nombre_paciente, round(sum( (c.precio_unitario + c.costo_insumo + c.impuesto) * c.cantidad ),2) AS total, round(sum(c.impuesto * c.cantidad),2) as impuesto, a.historia, a.factura_fiscal, a.fecha_proceso from factura a, registro b, factura_detalle c where a.factura = c.factura and a.historia = b.historia and a.tratamiento =b.tratamiento and a.cargo = b.cargo and date(a.fecha) between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and c.impuesto > 0 GROUP BY a.FA, a.id_paciente, b.nombre_paciente, a.factura_fiscal, a.fecha_proceso
	order by a.factura_fiscal", $prop3);
	
	$pdf->Ln(10);
	$pdf->AddCol('total',20,'Total', 'C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	
	$pdf->Table("SELECT round(sum((c.impuesto) * c.cantidad),2) as total from factura a, registro b, factura_detalle c where a.factura = c.factura and a.historia = b.historia and a.tratamiento =b.tratamiento and a.cargo = b.cargo and date(a.fecha) between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and c.impuesto > 0
	order by a.factura_fiscal", $prop3);
	
	
	$pdf->Ln(10);
	$pdf->Write(5,'Realizada por: ');
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

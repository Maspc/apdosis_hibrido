<?php
	require('mysql_table.php');
	
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
			$titulo = 'Reporte de Narcóticos del '.$fecha1. ' al '.$fecha2;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	//Connect to database
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_narcoticos.php');
	
	$resd = imprimir::select1($_SESSION['MM_iduser']);
	
	foreach($resd as $rowd){
		$username = $rowd->nombre;
	}
	
	
	$pdf=new PDF();
	$pdf->AddPage("L");
	//First table: put all columns automatically
	$titulo = 'Hospital';
    $pdf->Cell(0,6,$titulo,0,1,'C');
	$pdf->Ln(10);
	$pdf->AddCol('FA',20,'FA', 'C');
	$pdf->AddCol('fecha',30,'Fecha','C');
	$pdf->AddCol('nombre_paciente',80,'Nombre','C');
	$pdf->AddCol('no_cama',20,'No. Cama','C');
	$pdf->AddCol('medicamento',80,'Medicamento','C');
	$pdf->AddCol('cantidad',20,'Cantidad','C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT b.FA, b.factura_fiscal, SUBSTR(a.medicamento,1,35) as medicamento, b.no_cama, c.nombre_paciente, b.fecha, a.cantidad from factura_detalle a, factura b, registro c, medicamentos d where b.historia = c.historia and b.tratamiento =c.tratamiento and b.cargo = c.cargo and a.factura = b.factura and date(b.fecha) between '$fecha1' and '$fecha2' and d.codigo_interno = a.medicamento_id and d.narcotico = 'S' and b.estado_factura = 'I' order by b.fecha", $prop3);
	
	$pdf->Ln(10);
	
	$pdf->AddPage("L");
$titulo = 'Publico';
$pdf->Cell(0,6,$titulo,0,1,'C');
$pdf->Ln(10);
//First table: put all columns automatically
$pdf->AddCol('factura',20,'Cod. Int.', 'C');
$pdf->AddCol('fecha',30,'Fecha','C');
$pdf->AddCol('nombre_cliente',80,'Nombre','C');
$pdf->AddCol('medicamento',80,'Medicamento','C');
$pdf->AddCol('cantidad',20,'Cantidad','C');


$prop3=array('HeaderColor'=>array(255,150,100),
'color1'=>array(210,245,255),
'color2'=>array(255,255,210),
'padding'=>2);

$pdf->Table("SELECT b.factura, b.factura_fiscal, SUBSTR(a.medicamento,1,35) as medicamento, b.no_cama, b.nombre_cliente, b.fecha, a.cantidad from factura_detalle a, factura b, medicamentos d where a.factura = b.factura and date(b.fecha) between '$fecha1' and '$fecha2' and d.codigo_interno = a.medicamento_id and d.narcotico = 'S' and b.estado_factura = 'I' and b.publico = 'S' order by b.fecha", $prop3);

$pdf->Ln(10);
/*$pdf->AddCol('total',20,'Total', 'C');



$prop3=array('HeaderColor'=>array(255,150,100),
'color1'=>array(210,245,255),
'color2'=>array(255,255,210),
'padding'=>2);


$pdf->Table("SELECT sum(round(a.total,2)) as total from factura a, registro b  where a.historia = b.historia and a.tratamiento =b.tratamiento and a.cargo = b.cargo and date(a.fecha) between '$fecha1' and '$fecha2' and a.estado_factura = 'I'", $prop3);

*/

$pdf->Ln(5);
$pdf->Write(5,'Realizada por: ');
$hora_actual = date("Y-m-d H:i",time());
$pdf->Ln(10);
$pdf->Write(5,'_______________________________________________');
$pdf->Ln(5);
$pdf->Write(5,$username);
$pdf->Ln(5);
$pdf->Write(5,'Hora de Proceso: '.$hora_actual);




//$pdf -> Output($z.".pdf","F");
//$output = shell_exec('lpr -P cargos1  /var/www/htdocs/apdosis/htdocs/apdosis/fact/'.$z.'.pdf | lpstat -t' );
//echo "<pre>$output</pre>";
//sleep(2);
$pdf->Output();
?>
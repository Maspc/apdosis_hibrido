<?php
	include('./clases/session.php');
	require_once('../modulos/ventas_diarias_con.php');
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
			$this->SetFont('Arial','',14);
			$titulo = 'Reporte de Ventas Diarias del '.$fecha1. ' al '.$fecha2;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	$rowd = ventasd::usuarios($_SESSION['MM_iduser']);
	foreach($rowd as $rw){
		$username = $rw->nombre;
	}
	
	$pdf=new PDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','','8');
	//First table: put all columns automatically
	$pdf->AddCol('factura_fiscal',25,'Fact. Fiscal','C');
	$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
	$pdf->AddCol('id_paciente',30,'Id. Cliente','C');
	$pdf->AddCol('nombre_paciente',60,'Nombre','C');
	$pdf->AddCol('total',20,'Total','C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.FA, a.codigo_cliente as id_paciente, substring(a.nombre_cliente,1,30) as nombre_paciente, round(a.total, 2) as total, a.factura_fiscal, a.fecha_proceso from factura a where a.fecha between '".$fecha1."' and '".$fecha2."' and a.estado_factura = 'I' and a.factura_fiscal != ' ' order by a.factura_fiscal", $prop3);
	
	$pdf->Ln(10);
	$pdf->AddCol('total',20,'Total', 'C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	
	$pdf->Table("SELECT sum(round(a.total,2)) as total from factura a  where a.fecha between '".$fecha1."' and '".$fecha2."' and a.estado_factura = 'I' and a.factura_fiscal != ' ' order by a.factura_fiscal", $prop3);
	
	
	
	$pdf->Ln(10);
	
	$pdf->AddPage('L');
	$pdf->SetFont('Arial','',14);
	$titulo = 'Facturas de Reemplazo';
	$pdf->Cell(0,6,$titulo,0,1,'C');
	
	$pdf->SetFont('Arial','','8');
	$pdf->Ln(10);
	
	$pdf->AddCol('FA',20,'FA', 'C');
	$pdf->AddCol('factura_original',25,'Fact. Ant.','C');
	$pdf->AddCol('total_original',20,'Total Ant.','C');
	$pdf->AddCol('fecha_fact_orig',30,'Fecha Ant.','C');
	$pdf->AddCol('devolucion_fiscal',25,'Dev. Interna','C');
	$pdf->AddCol('total_devolucion',20,'Total Dev','C');
	$pdf->AddCol('fecha_devolucion',30,'Fecha Dev.','C');
	$pdf->AddCol('factura_nueva',25,'Fact. Reemp','C');
	$pdf->AddCol('total_nuevo',25,'Total Reemp','C');
	$pdf->AddCol('fecha_fact_nueva',30,'Fecha Reemp.','C');
	//$pdf->AddCol('id_paciente',30,'Id. Paciente','C');
	//$pdf->AddCol('nombre_paciente',60,'Nombre','C');
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("select c.FA, a.factura_fiscal as factura_original, a.total as total_original, a.impresion_fiscal as fecha_fact_orig,  b.devolucion_fiscal, b.fecha_impresion as fecha_devolucion, b.total as total_devolucion, c.factura_fiscal as factura_nueva, c.total as total_nuevo, c.hora_impresion_fiscal as fecha_fact_nueva, c.id_paciente, substring(d.nombre_paciente,1,30) as nombre_paciente
	from auditoria_dev_fact a, devolucion_manual b, factura c, registro d
	where a.factura = c.factura
	and a.devolucion = b.numero_devolucion
	and c.historia = d.historia
	and c.tratamiento = d.tratamiento
	and c.cargo = d.cargo
	and a.fecha_creacion between '".$fecha1."' and '".$fecha2."' order by a.factura_fiscal", $prop3);
	
	
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

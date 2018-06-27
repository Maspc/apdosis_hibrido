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
			$titulo = 'Reporte de Impuesto por Compras del '.$fecha1. ' al '.$fecha2;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	//Connect to database
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_impuesto_compra.php');
	
	$resd = imprimir::select1($_SESSION['MM_iduser']);
	
	foreach($resd as $rowd){
		$username = $rowd->nombre;
	}
	
	
	$pdf=new PDF();
	$pdf->AddPage('L');
	//First table: put all columns automatically
	$pdf->AddCol('id_compra',20,'Id Compra', 'C');
	$pdf->AddCol('nombre',75,'Proveedor', 'C');
	$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
	$pdf->AddCol('medicamento',100,'Medicamento','C');
	$pdf->AddCol('costo_total',30,'Costo Total','C');
	$pdf->AddCol('impuesto_total',30,'Impuesto Total','C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("select concat(b.nombre_comercial, ' (', b.nombre_generico, ')', ' ', b.posologia, c.descripcion) as medicamento, a.id_compra, round((a.costo * a.cantidad_entregada),2) as costo_total, a.impuesto_total, a.fecha_proceso, e.nombre  from compras_detalle a, medicamentos b, tipos_posologias c, compras d, proveedor e where a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia and a.id_compra = d.id_compra and d.id_proveedor = e.id_proveedor and date(a.fecha_proceso) between '$fecha1' and '$fecha2' and a.estado_proceso = 'F' and a.impuesto_total > 0 order by a.id_compra ", $prop3);
	
	$pdf->Ln(10);
	$pdf->AddCol('total',20,'Total', 'C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	
	$pdf->Table("select sum( a.impuesto_total) as total from compras_detalle a, medicamentos b, tipos_posologias c, compras d, proveedor e where a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia and a.id_compra = d.id_compra and d.id_proveedor = e.id_proveedor and date(a.fecha_proceso) between '$fecha1' and '$fecha2' and a.estado_proceso = 'F' and a.impuesto_total > 0 ", $prop3);
	
	
	
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
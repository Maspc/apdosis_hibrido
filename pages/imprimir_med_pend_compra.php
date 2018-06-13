<?php
	include('./clases/session.php');
	require_once('../modulos/imprimir_med_pend_compra.php');
	require_once('./mysql_table.php');
	
	
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{
			//Title
			
			$this->SetFont('Arial','',8);
			$titulo = 'Listado de Artículos Pendientes en Orden de Compra';
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	$username = impre_med::usuario($_SESSION['MM_iduser']);
	
	
	$pdf=new PDF();
	$pdf->SetFont('Arial','',8);
	
	$pdf->AddPage();
	//First table: put all columns automatically
	$pdf->AddCol('medicamento',150,'Artículo', 'C');
	$pdf->AddCol('id_compra',20,'Id Compra','C');
	$pdf->AddCol('cantidad_compra',20,'Cant.','C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.codigo_interno, substr(concat(a.nombre_comercial,' ', '(', a.nombre_generico, ')',' ', a.posologia, b.descripcion,' ', c.descripcion),1,80) as medicamento, d.id_compra, d.medicamento_id,d.cantidad_compra, d.cantidad_entregada from medicamentos a, tipos_posologias b, formas_farmaceuticas c,compras_detalle d where a.tipo_posologia = b.codigo_posologia and c.codigo_forma = a.forma_farmaceutica and a.codigo_interno = d.medicamento_id and d.estado_proceso = 'P'  order by a.nombre_comercial", $prop3);
	$pdf->Ln(10);
	$pdf->AddCol('cantidad',50,'Cantidad Total', 'C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT count(*) as cantidad from medicamentos a, tipos_posologias b, formas_farmaceuticas c,compras_detalle d where a.tipo_posologia = b.codigo_posologia and c.codigo_forma = a.forma_farmaceutica and a.codigo_interno = d.medicamento_id and d.estado_proceso = 'P'", $prop3);
	$pdf->Ln(10);
	
	$hora_actual = date("Y-m-d H:i",time());
	$pdf->Write(5,'Hora de Impresion: '.$hora_actual);
	
	
	//$pdf -> Output($z.".pdf","F");
	//$output = shell_exec('lpr -P cargos1  /var/www/htdocs/apdosis/htdocs/apdosis/fact/'.$z.'.pdf | lpstat -t' );
	//echo "<pre>$output</pre>";
	//sleep(2);
	$pdf->Output();
?>

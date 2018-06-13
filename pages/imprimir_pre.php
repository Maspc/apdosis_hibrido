<?php
	include('./clases/session.php');
	require_once('../modulos/imprimir_pre.php');
	require_once('./mysql_table.php');
	
	
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{
			//Title
			
			$this->SetFont('Arial','',18);
			$titulo = 'Listado de Medicamentos Cargados';
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	$rowd = impripre::usuarios($_SESSION['MM_iduser']);
	
	foreach($rowd as $rw){
		$username = $rw->nombre;
	}	
	
	$pdf=new PDF();
	$pdf->AddPage();
	//First table: put all columns automatically
	$pdf->AddCol('medicamento',120,'Artículo', 'C');
	$pdf->AddCol('codigo_de_barra',30,'Codigo de Barra','C');
	$pdf->AddCol('precio_unitario',20,'Precio','C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.codigo_interno, concat(a.nombre_comercial,' ', '(', a.nombre_generico, ')',' ', a.posologia, b.descripcion) as medicamento, a.codigo_de_barra, a.precio_unitario from medicamentos a, tipos_posologias b where a.tipo_posologia = b.codigo_posologia", $prop3);
	$pdf->Ln(10);
	$pdf->AddCol('cantidad',40,'Cantidad Total', 'C');
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT count(*) as cantidad from medicamentos", $prop3);
	$pdf->Ln(10);
	
	$hora_actual = date("Y-m-d H:i",time());
	$pdf->Write(5,'Hora de Impresion: '.$hora_actual);
	
	
	//$pdf -> Output($z.".pdf","F");
	//$output = shell_exec('lpr -P cargos1  /var/www/htdocs/apdosis/htdocs/apdosis/fact/'.$z.'.pdf | lpstat -t' );
	//echo "<pre>$output</pre>";
	//sleep(2);
	$pdf->Output();
?>

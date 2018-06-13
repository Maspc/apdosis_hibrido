<?php
	ob_start();
	include ('./clases/session.php');
	//require_once('../modulos/imprimir_inv_hosp.php');
	require('mysql_table.php');
	
	
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
	
	//$d = "select nombre from usuarios where user='".$_SESSION['MM_iduser']."'";
	
	//$resd = mysql_query($d, $conn) or die(mysql_error());
	
	//while($rowd = mysql_fetch_array($resd)){
	//$username = $rowd['nombre'];
	//}
	
	
	$pdf=new PDF();
	$pdf->AddPage();
	//First table: put all columns automatically
	$pdf->AddCol('medicamento',120,'Medicamento', 'C');
	$pdf->AddCol('codigo_de_barra',30,'Codigo de Barra','C');
	$pdf->AddCol('cantidad',25,'Cantidad','C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.codigo_interno, concat(a.nombre_comercial,' ', '(', a.nombre_generico, ')', ' ', a.posologia, b.descripcion,' ', d.descripcion) as medicamento, a.codigo_de_barra, if((c.cantidad_inicial - c.cantidad_factura + c.cantidad_devolucion) > c.inventario_critico, 'EXISTENCIA', 'AGOTADO') as cantidad  from medicamentos a, medicamentos_x_bodega c, tipos_posologias b,formas_farmaceuticas d where a.tipo_posologia = b.codigo_posologia and a.codigo_interno = c.medicamento_id and tipo_mercancia = 1 and d.codigo_forma = a.forma_farmaceutica and c.bodega = 1 order by a.nombre_comercial", $prop3);
	$pdf->Ln(10);
	$pdf->AddCol('cantidad',40,'Cantidad Total', 'C');
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT count(*) as cantidad from medicamentos where tipo_mercancia = 1", $prop3);
	$pdf->Ln(10);
	
	$hora_actual = date("Y-m-d H:i",time());
	$pdf->Write(5,'Hora de Impresion: '.$hora_actual);
	
	
	//$pdf -> Output($z.".pdf","F");
	//$output = shell_exec('lpr -P cargos1  /var/www/htdocs/apdosis/htdocs/apdosis/fact/'.$z.'.pdf | lpstat -t' );
	//echo "<pre>$output</pre>";
	//sleep(2);
	$pdf->Output();
?>
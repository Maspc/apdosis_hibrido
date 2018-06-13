<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_traslado_detalle.php');	
	require_once('./mysql_table.php');
	
	$z = $_GET['compra'];
	
	
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{
			//Title
			$z = $_GET['compra'];
			$this->SetFont('Arial','',18);
			$titulo = 'Proceso de Traslados - Farmashop';
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	
	
	$rowd = itdetalle::usuarios($_SESSION['MM_iduser']);
	foreach($rowd as $rwd){
		$username = $rwd->nombre;
	}
	
	$pdf=new PDF();
	$pdf->AddPage("L");
	//First table: put all columns automatically
	$pdf->AddCol('id_traslado',20,'Traslado', 'C');
	$pdf->AddCol('nombre_origen',60,'Bodega Origen','C');
	$pdf->AddCol('nombre_destino',60,'Bodega Destino','C');
	$pdf->AddCol('fecha',40,'Fecha','C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.id_traslado ,	b.descripcion as nombre_origen, c.descripcion as nombre_destino, a.fecha from traslados a, bodegas b, bodegas c where id_traslado = '$z' and a.bodega_origen = b.bodega and a.bodega_destino = c.bodega", $prop3);
	$pdf->Ln(10);
	
	//Second table: specify 3 columns
	$pdf->AddCol('medicamento',100,'Medicamento');
	
	$pdf->AddCol('cantidad',20,'Qty.','C');
	
	
	
	$prop=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.medicamento_id, concat(b.nombre_comercial, ' (', b.nombre_generico, ')', ' ', b.posologia, c.descripcion) as medicamento, b.codigo_proveedor ,a.cantidad as cantidad from traslados_detalle a, medicamentos b, tipos_posologias c where id_traslado = '$z' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia ",$prop);
	$pdf->Ln(10);
	$pdf->Ln(10);
	
	$pdf->Ln(10);
	$pdf->Write(5,'Realizado por: ');
	$hora_actual = date("Y-m-d H:i",time());
	$pdf->Ln(10);
	$pdf->Ln(10);
	$pdf->Write(5,'_______________________________________________');
	$pdf->Ln(10);
	$pdf->Write(5,$username);
	$pdf->Ln(5);
	$pdf->Ln(10);
	$pdf->Ln(10);
	
	
	
	
	//$pdf -> Output($z.".pdf","F");
	//$output = shell_exec('lpr -P cargos1  /var/www/htdocs/apdosis/htdocs/apdosis/fact/'.$z.'.pdf | lpstat -t' );
	//echo "<pre>$output</pre>";
	//sleep(2);
	
	
	
	
	$pdf->Output();
?>
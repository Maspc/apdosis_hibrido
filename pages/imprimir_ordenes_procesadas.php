<?php
	include('./clases/session.php');
	require_once('../modulos/ordenes_mercancia.php');
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
			$titulo = 'Reporte de Ingreso de Mercancía de '.$fecha1.' a '.$fecha2;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	$rowd = ordenmerc::usuarios($_SESSION['MM_iduser']);
	foreach($rowd as $rw){
		$username = $rw->nombre;
	}
	
	
	$pdf=new PDF();
	$pdf->AddPage();
	//First table: put all columns automatically
	$pdf->AddCol('id_compra',20,'No. Compra', 'C');
	$pdf->AddCol('fecha_compra',30,'Fecha','C');
	$pdf->AddCol('nombre',50,'Proveedor','C');
	$pdf->AddCol('factura_proveedor',30,'Fact. Prov','C');
	$pdf->AddCol('total',20,'Total','C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.id_compra, a.fecha_compra, b.nombre, a.usuario_creacion, a.factura_proveedor, sum( c.total ) as total
	FROM compras a, proveedor b, compras_detalle c
	WHERE a.id_proveedor = b.id_proveedor
	AND a.estado = 'F'
	and c.estado_proceso = 'F'
	AND a.id_compra = c.id_compra
	and date(a.fecha_compra) between '".$fecha1."' and '".$fecha2."' 
	GROUP BY a.id_compra, a.fecha_compra, b.nombre, a.usuario_creacion, a.factura_proveedor", $prop3);
	
	$pdf->Ln(10);
	
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

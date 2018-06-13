<?php
	include('./clases/session.php');
	require_once('../modulos/reimprimir_compra_r.php');
	require_once('./mysql_table.php');
	
	$z = $_POST['compra'];
	
	
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{
			//Title
			
			$nom_cia = re_comprar::compania();
			
			$z = $_POST['compra'];
			$this->SetFont('Arial','',18);
			$titulo = 'Reimpresión de Compra - '.$nom_cia;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	$username = re_comprar::usuario($_SESSION['MM_iduser']);
	
	$pdf=new PDF();
	$pdf->AddPage("L");
	//First table: put all columns automatically
	$pdf->AddCol('Compra',20,'Compra', 'C');
	$pdf->AddCol('Nombre',60,'Proveedor','C');
	$pdf->AddCol('Usuario',40,'Usuario','C');
	$pdf->AddCol('Tipo',40,'Tipo Entrada','C');
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.id_compra as Compra, b.nombre as Nombre, 	a.usuario_creacion as Usuario, c.descripcion as Tipo from compras a, proveedor b, tipos_de_entrada c where id_compra = '$z' and a.id_proveedor = b.id_proveedor and a.tipo_entrada = c.id_entrada", $prop3);
	$pdf->Ln(10);
	$pdf->AddCol('Fecha',20,'Fecha', 'C');
	$pdf->AddCol('Obs',120,'Observacion','C');
	$pdf->AddCol('Factura',50,'Factura','C');
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT fecha_compra as Fecha, 	observacion as Obs, factura_proveedor as Factura from compras where id_compra = '$z'", $prop3);
	$pdf->Ln(10);
	
	//Second table: specify 3 columns
	$pdf->AddCol('medicamento',100,'Medicamento');
	$pdf->AddCol('codigo_proveedor',30,'Codigo Interno');
	$pdf->AddCol('cantidad',20,'Qty.','C');
	$pdf->AddCol('lote',20,'Lote','C');
	$pdf->AddCol('costo',20,'Cto.','C');
	$pdf->AddCol('impuesto_total',25,'Impto. Total','C');
	$pdf->AddCol('total_costo',20,'Total','C');
	
	
	$prop=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.medicamento_id, concat(b.nombre_comercial, ' (', b.nombre_generico, ')', ' ', b.posologia, c.descripcion) as medicamento, b.codigo_proveedor ,a.cantidad_entregada as cantidad, a.lote, a.costo, a.impuesto_total, a.total as total_costo from compras_detalle a, medicamentos b, tipos_posologias c where id_compra = '$z' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia ",$prop);
	$pdf->Ln(10);
	$pdf->Ln(10);	
	
	$ttotal = re_comprar::tcompra($z);
	$pdf->Write(5,'Total de la compra: '.$ttotal);
	
	$pdf->Ln(10);
	$hora_actual = date("Y-m-d H:i",time());
	$pdf->Ln(10);
	$pdf->Ln(10);
	$pdf->Write(5,'_______________________________________________');
	$pdf->Ln(10);
	$pdf->Write(5,'Autorizado por: Hilda Justiniani - Regente - Reg. 1193 ');
	$pdf->Ln(5);
	$pdf->Write(5,'Proveedor: ');
	$pdf->Ln(10);
	$pdf->Ln(10);
	$pdf->Write(5,'_______________________________________________');
	$pdf->Ln(10);
	
	
	
	//$pdf -> Output($z.".pdf","F");
	//$output = shell_exec('lpr -P cargos1  /var/www/htdocs/apdosis/htdocs/apdosis/fact/'.$z.'.pdf | lpstat -t' );
	//echo "<pre>$output</pre>";
	//sleep(2);
	
	
	$pdf->Output();
?>

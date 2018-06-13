<?php	
	include('./clases/session.php');
	require_once('../modulos/reimprimir_compra.php');
	require_once('./mysql_table.php');
	
	$z = $_POST['orden'];
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{
			$nom_cia = re_compra::compania();
			//Title
			$z = $_POST['orden'];
			$this->SetFont('Arial','',18);
			$titulo = 'Orden de Compra - '.$nom_cia;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	//Connect to database
	ob_start();
	
	$username = re_compra::usuario($z);
	
	$pdf=new PDF();
	$pdf->AddPage();
	//First table: put all columns automatically
	$pdf->AddCol('Compra',20,'Compra', 'C');
	$pdf->AddCol('Nombre',60,'Proveedor','C');
	$pdf->AddCol('Usuario',40,'Usuario','C');
	$pdf->AddCol('Estado',40,'Estado','C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.id_compra as Compra, b.nombre as Nombre, 	a.usuario_creacion as Usuario, if(a.estado = 'P', 'Pendiente', 'Finalizada') as Estado from compras a, proveedor b where id_compra = '$z' and a.id_proveedor = b.id_proveedor", $prop3);
	$pdf->Ln(10);
	$pdf->AddCol('Fecha',20,'Fecha', 'C');
	$pdf->AddCol('Obs',120,'Observacion','C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT 	fecha_compra as Fecha, 	observacion as Obs from compras where id_compra = '$z'", $prop3);
	$pdf->Ln(10);
	
	//Second table: specify 3 columns
	$pdf->AddCol('medicamento',120,'Medicamento');
	$pdf->AddCol('codigo_proveedor',30,'Codigo Interno');
	$pdf->AddCol('cantidad',20,'Cant. Ped.','C');
	$pdf->AddCol('cantidad_c',20,'Cant. Ent.','C');
	
	$prop=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.medicamento_id, concat(b.nombre_comercial, ' (', b.nombre_generico, ')', ' ', b.posologia, c.descripcion) as medicamento, b.codigo_proveedor ,a.cantidad_compra as cantidad, a.cantidad_entregada as cantidad_c from compras_detalle a, medicamentos b, tipos_posologias c where id_compra = '$z' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia ",$prop);
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

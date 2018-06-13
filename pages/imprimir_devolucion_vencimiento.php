<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_devolucion_vencimiento.php');
	require_once('./mysql_table.php');
	
	$z = $_GET['devolucion'];
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{
			
			$ciaro = idvencimiento::compania();
			foreach($ciaro as $cro){
				$nom_cia = $cro->nombre;
			}
			//Title
			$z = $_GET['devolucion'];
			$this->SetFont('Arial','',18);
			$titulo = 'Proceso de Devolución por Vencimiento - '.$nom_cia;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	
	$rowd = idvencimiento::usuarios($_SESSION['MM_iduser']);
	foreach($rowd as $rwd){
		$username = $rwd->nombre;
	}	
	
	$pdf=new PDF();
	$pdf->AddPage();
	//First table: put all columns automatically
	$pdf->AddCol('Devolucion',20,'Devolución', 'C');
	$pdf->AddCol('Nombre',60,'Proveedor','C');
	$pdf->AddCol('Usuario',40,'Usuario','C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.id_devolucion as Devolucion, b.nombre as Nombre, 	a.usuario_creacion as Usuario from devolucion_vencimiento a, proveedor b where id_devolucion = '$z' and a.id_proveedor = b.id_proveedor", $prop3);
	$pdf->Ln(10);
	$pdf->AddCol('Fecha',20,'Fecha', 'C');
	$pdf->AddCol('Obs',120,'Observacion','C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT fecha_devolucion as Fecha, 	observacion as Obs  from devolucion_vencimiento where id_devolucion = '$z'", $prop3);
	$pdf->Ln(10);
	
	//Second table: specify 3 columns
	$pdf->AddCol('medicamento',80,'Artículo');
	$pdf->AddCol('codigo_de_barra',30,'Codigo de Barra');
	$pdf->AddCol('cantidad',20,'Qty.','C');
	$pdf->AddCol('lote',20,'Lote','C');
	$pdf->AddCol('costo',20,'Cto.','C');
	$pdf->AddCol('total_costo',20,'Total','C');
	
	
	$prop=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.medicamento_id, concat(b.nombre_comercial, ' (', b.nombre_generico, ')', ' ', b.posologia, c.descripcion) as medicamento, b.codigo_de_barra ,a.cantidad_devolucion as cantidad, a.lote, a.costo, (a.costo*a.cantidad_devolucion) as total_costo from devolucion_ven_detalle a, medicamentos b, tipos_posologias c where id_devolucion = '$z' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia ",$prop);
	$pdf->Ln(10);
	$pdf->Ln(10);
	
	$r = "SELECT  sum((a.costo*a.cantidad_devolucion)) as total from devolucion_ven_detalle a, medicamentos b, tipos_posologias c where id_devolucion = '$z' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia";
	
	$res = mysql_query($r, $conn) or die(mysql_error());
	$pdf->Ln(10);
	while($row = mysql_fetch_array($res)){
		$pdf->Write(5,'Total de la devolucion: '.$row['total']);
	}
	
	$pdf->Write(5,'Recibida por: ');
	$pdf->Ln(10);
	$hora_actual = date("Y-m-d H:i",time());
	$pdf->Ln(10);
	$pdf->Ln(10);
	$pdf->Write(5,'_______________________________________________');
	$pdf->Ln(10);
	$pdf->Write(5,$username);
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

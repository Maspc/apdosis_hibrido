<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/compras_detalle.php');
	require('mysql_table.php');
	
	$z = $_GET['compra'];
	if (isset($_GET['recibo'])){
		$x = $_GET['recibo'];
	}
	
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{
			//Title
			
			$ciaro = comprasdet::select12();
			foreach($ciaro as $cro){
				$nom_cia = $cro->nombre;	
			}
			
			$z = $_GET['compra'];
			$this->SetFont('Arial','',18);
			$titulo = 'Proceso de Compra No. '.$z.' - '.$nom_cia;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	/*
		$cia = "select nombre from compania";
		
		$ciares = mysql_query($cia, $conn) or die(mysql_error());
		
		while($ciaro = mysql_fetch_array($ciares)){
		$nom_cia = $ciaro['nombre'];
		
	} */
	
	$rowd = comprasdet::select13($_SESSION['MM_iduser']);
	foreach($rowd as $rwd){
		$username = $rwd->nombre;
	}
	
	
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
	$pdf->AddCol('medicamento',80,'Artículo');
	$pdf->AddCol('codigo_de_barra',30,'Codigo de Barra');
	$pdf->AddCol('cantidad',20,'Qty.','C');
	$pdf->AddCol('cantidad_bodega',15,'Qty.B.','C');
	$pdf->AddCol('cantidad_tienda',15,'Qty.T.','C');
	$pdf->AddCol('cantidad_regalia',15,'Regal.','C');
	$pdf->AddCol('lote',16,'Lote','C');
	$pdf->AddCol('costo',16,'Cto.','C');
	$pdf->AddCol('descuento_unitario',22,'Descto. Unit.','C');
	$pdf->AddCol('impuesto_total',20,'Impto.','C');
	$pdf->AddCol('total_costo',20,'Total','C');
	
	
	$prop=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.medicamento_id, concat(b.nombre_comercial, ' (', b.nombre_generico, ')', ' ', b.posologia, c.descripcion) as medicamento, b.codigo_de_barra ,a.cantidad_entregada as cantidad, a.lote, a.costo, a.impuesto_total, a.total as total_costo, a.cantidad_regalia, a.descuento_unitario, a.cantidad_bodega, a.cantidad_tienda from compras_detalle a, medicamentos b, tipos_posologias c where id_compra = '$z' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia ",$prop);
	$pdf->Ln(10);
	$pdf->Ln(10);
	
	$pdf->Ln(10);
	
	$row = comprasdet::select14($z);
	foreach($row as $rw1){
		$pdf->Write(5,'Total de la compra: '.$rw1->total);
	}
	$pdf->Ln(10);
	$pdf->Write(5,'Recibida por: ');
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
		
	$grow = comprasdet::select15($z);
	foreach($grow as $grw){
		$cantidad_externo_total = $grw->cantidad_externo_total;
		
		
		if($cantidad_externo_total > 0){
			$pdf->AddPage("L");
			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(0,10,'Traslado a BODEGA APDOSIS',0,1,'C'); //nombre quemado hasta que llame el parametro de la base de datos
			$pdf->Ln(10);
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
			$pdf->AddCol('medicamento',80,'Artículo');
			$pdf->AddCol('codigo_de_barra',30,'Codigo de Barra');
			$pdf->AddCol('cantidad',20,'Qty.E.','C');
			$pdf->AddCol('lote',16,'Lote','C');
			$pdf->AddCol('costo',16,'Cto.','C');
			
			
			
			$prop=array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);
			
			$pdf->Table("SELECT a.medicamento_id, concat(b.nombre_comercial, ' (', b.nombre_generico, ')', ' ', b.posologia, c.descripcion) as medicamento, b.codigo_de_barra ,a.cantidad_externo as cantidad, a.lote, a.costo, a.impuesto_total,  a.cantidad_regalia, a.descuento_unitario from compras_detalle a, medicamentos b, tipos_posologias c where id_compra = '$z' and a.medicamento_id = b.codigo_interno and b.tipo_posologia = c.codigo_posologia and a.cantidad_externo > 0 ",$prop);
			$pdf->Ln(10);
			$pdf->Ln(10);
			
			$pdf->Ln(10);
			$pdf->Write(5,'Recibida por: ');
			$hora_actual = date("Y-m-d H:i",time());
			$pdf->Ln(10);
			$pdf->Ln(10);
			$pdf->Write(5,'_______________________________________________');
			$pdf->Ln(10);
			$pdf->Write(5,$username);
			
			
			
		}
		
	}
	
	//$pdf -> Output($z.".pdf","F");
	//$output = shell_exec('lpr -P cargos1  /var/www/htdocs/apdosis/htdocs/apdosis/fact/'.$z.'.pdf | lpstat -t' );
	//echo "<pre>$output</pre>";
	//sleep(2);
	if(isset($_GET['recibo'])){
		$pdf->AddPage();
		//First table: put all columns automatically
		$titulo = 'Recibo de Caja '.$x.' - Apdosis';
		$pdf->Cell(0,6,$titulo,0,1,'C');
		$pdf->AddCol('Recibo',20,'Recibo', 'C');
		$pdf->AddCol('Nombre',60,'Proveedor','C');
		$pdf->AddCol('Usuario',40,'Usuario','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.id_recibo as Recibo, a.proveedor, b.nombre as Nombre, a.usuario_creacion as Usuario from recibos a, proveedor b where id_recibo = '$x' and a.proveedor = b.id_proveedor", $prop3);
		$pdf->Ln(10);
		$pdf->AddCol('Fecha',60,'Fecha', 'C');
		$pdf->AddCol('Obs',120,'Observacion','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT fecha_recibo as Fecha, 	observacion as Obs from recibos where id_recibo = '$x'", $prop3);
		$pdf->Ln(10);
		
		//Second table: specify 3 columns
		$pdf->AddCol('rubro',30,'Rubro');
		$pdf->AddCol('descripcion',80,'Descripcion');
		$pdf->AddCol('monto',20,'Monto','C');
		
		
		$prop=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.codigo_rubro, b.descripcion as rubro, a.descripcion, a.monto from recibos_detalle a, rubros b where id_recibo = '$x' and a.codigo_rubro = b.codigo_rubro",$prop);
		$pdf->Ln(10);
		$pdf->Ln(10);
		
		$pdf->Ln(10);
		
		$row = comprasdet::select16($z);
		foreach($row as $rw2){			
			$pdf->Write(5,'Total del Recibo: '.$rw2->total);
		}
		$pdf->Ln(10);
		$pdf->Write(5,'Confeccionado por: ');
		$hora_actual = date("Y-m-d H:i",time());
		$pdf->Ln(10);
		$pdf->Ln(10);
		$pdf->Write(5,'_______________________________________________');
		$pdf->Ln(10);
		$pdf->Write(5,$username);
		$pdf->Ln(5);
		$pdf->Write(5,'Recibido por: ');
		$hora_actual = date("Y-m-d H:i",time());
		$pdf->Ln(10);
		$pdf->Ln(10);
		$pdf->Write(5,'_______________________________________________');
		$pdf->Ln(10);
		$pdf->Write(5,'Autorizado por: Hilda Justiniani - Regente - Reg. 1193 ');
		$pdf->Ln(10);
		$pdf->Ln(10);
		$pdf->Write(5,'_______________________________________________');
		$pdf->Ln(10);	
		
		
	}
	
	
	
	$pdf->Output();
?>
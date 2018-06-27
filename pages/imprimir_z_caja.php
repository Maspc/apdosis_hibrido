<?php
	include('buscar_fiscal.php');
	require('mysql_table.php');
	
	if($_POST['tiempo_inicial'] == 2){
		$hora_inicial = $_POST['hora_inicial'] + 12;
		} else {
		$hora_inicial = $_POST['hora_inicial'];
	}
	
	if($_POST['tiempo_final'] == 2){
		$hora_final = $_POST['hora_final'] + 12;
		} else {
		$hora_final = $_POST['hora_final'];
	}
	$p_caja = $_POST['caja'];
	
	
	if($hora_final == 24){
		$hora_final = 0;
	}
	
	if($hora_inicial == 24){
		$hora_inicial = 0;
	}
	
	
	$fecha1 = $_POST['fecha1'].' '.$hora_inicial.':'.$_POST['minuto_inicial'];
	$fecha2 = $_POST['fecha2'].' '.$hora_final.':'.$_POST['minuto_final'];
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{
			
			if($_POST['tiempo_inicial'] == 2){
				$hora_inicial = $_POST['hora_inicial'] + 12;
				} else {
				$hora_inicial = $_POST['hora_inicial'];
			}
			
			if($_POST['tiempo_final'] == 2){
				$hora_final = $_POST['hora_final'] + 12;
				} else {
				$hora_final = $_POST['hora_final'];
			}
			//Title
			//$fecha1 = $_POST['fecha1'];
			//    $fecha2 = $_POST['fecha2'];
			
			$fecha1 = $_POST['fecha1'].' '.$hora_inicial.':'.$_POST['minuto_inicial'];
			$fecha2 = $_POST['fecha2'].' '.$hora_final.':'.$_POST['minuto_final'];
			$titulo = 'Reporte de Caja del '.$fecha1. ' al '.$fecha2;
			//	$titulo = 'Reporte de Caja';
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	//Connect to database
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_z_caja.php');
	
	$resd = imprimir::select1($_SESSION['MM_iduser']);
	
	foreach($resd as $rowd){
		$username = $rowd->nombre;
	}
	
	$pdf=new PDF();
	$pdf->AddPage();
	$pdf->Ln(10);
	$pdf->SetFont('Arial','',18);
	$titulo = 'Reporte de Caja';
    $pdf->Cell(0,6,$titulo,0,1,'C');
	$pdf->AddPage();
	$pdf->SetFont('Arial','',14);
	$titulo = 'Facturas';
    $pdf->Cell(0,6,$titulo,0,1,'C');

	$fres = imprimir::select2($p_caja);
	
	foreach($fres as $frow){
		$imp = $frow->nombre_impresora;
		$caja = $frow->nombre;
		$caja_id = $frow->caja_id;
		
		//$pdf->SetFont('Arial','','8');
		//First table: put all columns automatically
		$pdf->Ln(10);
		$pdf->SetFont('Arial','',12);
		$titulo = 'Impresora - '.$caja;
		$pdf->Cell(0,6,$titulo,0,1,'C');
		$pdf->Ln(5);
		$pdf->AddCol('equipo_fiscal',35,'Nombre Impresora', 'C');
		$pdf->AddCol('fact_inicial',25,'Fact. Inicial','C');
		$pdf->AddCol('fact_final',25,'Fact. Final','C');
		$pdf->AddCol('total',20,'Total','C');
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("select ifnull(min(a.factura_fiscal),0) as fact_inicial, ifnull(max(a.factura_fiscal),0) as fact_final, ifnull(sum(round(a.total,2)),0) as total, '$imp' as equipo_fiscal from factura a where a.fecha between '$fecha1' and '$fecha2' and a.caja_id = '$caja_id' and a.estado_factura = 'I'", $prop3);
		$pdf->Ln(10);
		$pdf->SetFont('Arial','',12);
		
		
		$pdf->Ln(5);
		
		////añado totales
		$pdf->AddCol('total',25,'Total Efectivo','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.efectivo, 2) - round(a.vuelto,2)) as total from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.efectivo > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		
		$pdf->Ln(5);
		////añado totales
		$pdf->AddCol('total',25,'Total T. Debito','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.tarjeta_clave, 2)) as total from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.tarjeta_clave > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		
		$pdf->Ln(5);
		////añado totales
		$pdf->AddCol('total',25,'Total T. Credito','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.tarjeta_credito, 2)) as total from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.tarjeta_credito > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(5);
		////añado totales
		$pdf->AddCol('total',25,'Total Cheque','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.cheque, 2)) as total from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.cheque > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		
		$pdf->Ln(5);
		////añado totales
		$pdf->AddCol('total',25,'Total Credito','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.credito, 2)) as total from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.credito > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(5);
		
		//añado descuentos e itbms
		
		$pdf->AddCol('total',25,'Total Desc.Jub.','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.descuento_total, 2)) as total from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.jubilado='S' and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.descuento_total > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(5);
		
		$pdf->AddCol('total',25,'Total Desc.Aseg.','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.descuento_total, 2)) as total from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.codigo_aseguradora != 0 and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.descuento_total > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		
		
		
		/*$titulo = 'Impresora - '.$caja2;
			$pdf->Cell(0,6,$titulo,0,1,'C');
			$pdf->Ln(5);
			$pdf->AddCol('equipo_fiscal',35,'Nombre Impresora', 'C');
			$pdf->AddCol('fact_inicial',25,'Fact. Inicial','C');
			$pdf->AddCol('fact_final',25,'Fact. Final','C');
			$pdf->AddCol('total',20,'Total','C');
			
			$prop3=array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);
			$pdf->Table("select ifnull(min(a.factura_fiscal),0) as fact_inicial, ifnull(max(a.factura_fiscal),0) as fact_final, ifnull(sum(round(a.total,2)),0) as total, a.equipo_fiscal as equipo_fiscal from factura a where a.fecha between '$fecha1' and '$fecha2' and a.equipo_fiscal = '$imp2' and a.estado_factura = 'I'", $prop3);
			$pdf->Ln(10);			
		*/
		
		$pdf->Ln(10);
		
		$pdf->SetFont('Arial','',12);
		$titulo = 'Detalle Impresora - '.$caja;
		$pdf->Cell(0,6,$titulo,0,1,'C');
		$pdf->Ln(10);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(0,6,'Efectivo',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'Fact. Fiscal','C');
		$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('ordenado_por',30,'Id. Cajero','C');
		$pdf->AddCol('efectivo',20,'Efectivo','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.FA, a.codigo_cliente, substring(concat(b.nombre,' ',b.apellido),1,30) as nombre_paciente, (round(a.efectivo, 2) - round(a.vuelto,2)) as efectivo, a.factura_fiscal, a.fecha as fecha_proceso, ordenado_por from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.efectivo > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(10);
		
		////añado totales
		$pdf->AddCol('total',25,'Total Efectivo','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.efectivo, 2) - round(a.vuelto,2)) as total from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.efectivo > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(10);
		
		///
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(0,6,'Tarjeta Debito',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'Fact. Fiscal','C');
		$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('ordenado_por',30,'Id. Cajero','C');
		$pdf->AddCol('tarjeta_clave',20,'T. Debito','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.FA, a.codigo_cliente, substring(concat(b.nombre,' ',b.apellido),1,30) as nombre_paciente, round(a.tarjeta_clave, 2) as tarjeta_clave, a.factura_fiscal, a.fecha as fecha_proceso, ordenado_por from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.tarjeta_clave > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(10);
		////añado totales
		$pdf->AddCol('total',25,'Total T. Debito','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.tarjeta_clave, 2)) as total from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.tarjeta_clave > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(10);
		
		///
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(0,6,'Tarjeta Credito',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'Fact. Fiscal','C');
		$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('ordenado_por',30,'Id. Cajero','C');
		$pdf->AddCol('tarjeta_credito',20,'T. Credito','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.FA, a.codigo_cliente, substring(concat(b.nombre,' ',b.apellido),1,30) as nombre_paciente, round(a.tarjeta_credito, 2) as tarjeta_credito, a.factura_fiscal, a.fecha as fecha_proceso, ordenado_por from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.tarjeta_credito > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(10);
		////añado totales
		$pdf->AddCol('total',25,'Total T. Credito','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.tarjeta_credito, 2)) as total from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.tarjeta_credito > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(10);
		
		///
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(0,6,'Cheque',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'Fact. Fiscal','C');
		$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('ordenado_por',30,'Id. Cajero','C');
		$pdf->AddCol('cheque',20,'Cheque','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.FA, a.codigo_cliente, substring(concat(b.nombre,' ',b.apellido),1,30) as nombre_paciente, round(a.cheque, 2) as cheque, a.factura_fiscal, a.fecha as fecha_proceso, ordenado_por from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.cheque > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(10);
		////añado totales
		$pdf->AddCol('total',25,'Total Cheque','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.cheque, 2)) as total from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.cheque > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(10);
		
		///
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(0,6,'Credito',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'Fact. Fiscal','C');
		$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
		$pdf->AddCol('codigo_cliente',30,'Id. Cliente','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('credito',20,'Credito','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.FA, a.codigo_cliente, substring(concat(b.nombre,' ',b.apellido),1,30) as nombre_paciente, round(a.credito, 2) as credito, a.factura_fiscal, a.fecha as fecha_proceso from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.credito > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(10);
		////añado totales
		$pdf->AddCol('total',25,'Total Credito','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.credito, 2)) as total from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.credito > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(10);
		
		
		
		///
		
	}
	
	/*
		
		
		$pdf->Ln(10);
		
		$pdf->SetFont('Arial','',10);
		$titulo = 'Detalle Impresora 2 '.$imp2;
		$pdf->Cell(0,6,$titulo,0,1,'C');
		$pdf->Ln(10);
		
		$pdf->Cell(0,6,'Efectivo',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'Fact. Fiscal','C');
		$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
		$pdf->AddCol('codigo_cliente',30,'Id. Cliente','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('efectivo',20,'Efectivo','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.FA, a.codigo_cliente, substring(concat(b.nombre,' ',b.apellido),1,30) as nombre_paciente, round(a.efectivo, 2) as efectivo, a.factura_fiscal, a.fecha as fecha_proceso from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.efectivo > 0 and a.equipo_fiscal = '$imp2' order by a.factura_fiscal", $prop3);
		
		$pdf->Cell(0,6,'Tarjeta Debito',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'Fact. Fiscal','C');
		$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
		$pdf->AddCol('codigo_cliente',30,'Id. Cliente','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('tarjeta_clave',20,'T. Debito','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.FA, a.codigo_cliente, substring(concat(b.nombre,' ',b.apellido),1,30) as nombre_paciente, round(a.tarjeta_clave, 2) as tarjeta_clave, a.factura_fiscal, a.fecha as fecha_proceso from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.tarjeta_clave > 0 and a.equipo_fiscal = '$imp2' order by a.factura_fiscal", $prop3);
		
		$pdf->Cell(0,6,'Tarjeta Credito',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'Fact. Fiscal','C');
		$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
		$pdf->AddCol('codigo_cliente',30,'Id. Cliente','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('tarjeta_credito',20,'T. Credito','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.FA, a.codigo_cliente, substring(concat(b.nombre,' ',b.apellido),1,30) as nombre_paciente, round(a.tarjeta_credito, 2) as tarjeta_credito, a.factura_fiscal, a.fecha as fecha_proceso from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.tarjeta_credito > 0 and a.equipo_fiscal = '$imp2' order by a.factura_fiscal", $prop3);
		
		$pdf->Cell(0,6,'Cheque',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'Fact. Fiscal','C');
		$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
		$pdf->AddCol('codigo_cliente',30,'Id. Cliente','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('cheque',20,'Cheque','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.FA, a.codigo_cliente, substring(concat(b.nombre,' ',b.apellido),1,30) as nombre_paciente, round(a.cheque, 2) as cheque, a.factura_fiscal, a.fecha as fecha_proceso from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.cheque > 0 and a.equipo_fiscal = '$imp2' order by a.factura_fiscal", $prop3);
		
		$pdf->Cell(0,6,'Credito',0,1,'C');
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'Fact. Fiscal','C');
		$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
		$pdf->AddCol('codigo_cliente',30,'Id. Cliente','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('credito',20,'Credito','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.FA, a.codigo_cliente, substring(concat(b.nombre,' ',b.apellido),1,30) as nombre_paciente, round(a.credito, 2) as credito, a.factura_fiscal, a.fecha as fecha_proceso from factura a, clientes b where a.codigo_cliente = b.id_cliente and a.fecha between '$fecha1' and '$fecha2' and a.estado_factura = 'I' and a.credito > 0 and a.equipo_fiscal = '$imp2' order by a.factura_fiscal", $prop3);
		
	*/
	
	//DEVOLUCIONES
	
	$pdf->AddPage();
	$pdf->SetFont('Arial','',14);
	$titulo = 'Notas de Crédito';
    $pdf->Cell(0,6,$titulo,0,1,'C');
		
	$fres = imprimir::select3($p_caja);
	
	foreach($fres as $frow){
		$imp = $frow->nombre_impresora;
		$caja = $frow->nombre;
		$caja_id = $frow->caja_id;
		
		$pdf->SetFont('Arial','','8');
		//First table: put all columns automatically
		$pdf->Ln(10);
		$pdf->SetFont('Arial','',12);
		$titulo = 'Impresora - '.$caja;
		$pdf->Cell(0,6,$titulo,0,1,'C');
		$pdf->Ln(5);
		$pdf->AddCol('equipo_fiscal',35,'Nombre Impresora', 'C');
		$pdf->AddCol('fact_inicial',25,'N/C Inicial','C');
		$pdf->AddCol('fact_final',25,'N/C Final','C');
		$pdf->AddCol('total',20,'Total','C');
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("select ifnull(min(a.factura_fiscal),0) as fact_inicial, ifnull(max(a.factura_fiscal),0) as fact_final, ifnull(sum(round(a.total,2)),0) as total, ifnull(a.equipo_fiscal, '$imp') as equipo_fiscal from devolucion a where a.fecha_creacion between '$fecha1' and '$fecha2' and a.caja_id = '$caja_id' and a.estado = 'E'
		union
		select min(a.devolucion_fiscal) as fact_inicial, max(a.devolucion_fiscal) as fact_final, sum(round(a.total,2)) as total, a.equipo_fiscal as equipo_fiscal from devolucion_manual a where a.fecha_impresion between '$fecha1' and '$fecha2'  and a.equipo_fiscal = '$imp1'  ", $prop3);
		/*$pdf->Ln(10);
			$pdf->SetFont('Arial','',12);
			$titulo = 'Impresora 2 - '.$caja2;
			$pdf->Cell(0,6,$titulo,0,1,'C');
			$pdf->Ln(5);
			$pdf->AddCol('equipo_fiscal',35,'Nombre Impresora', 'C');
			$pdf->AddCol('fact_inicial',25,'N/C Inicial','C');
			$pdf->AddCol('fact_final',25,'N/C Final','C');
			$pdf->AddCol('total',20,'Total','C');
			
			$prop3=array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);
			
			$pdf->Table("select ifnull(min(a.factura_fiscal),0) as fact_inicial, ifnull(max(a.factura_fiscal),0) as fact_final, ifnull(sum(round(a.total,2)),0) as total, ifnull(a.equipo_fiscal,'$imp2') as equipo_fiscal from devolucion a where a.fecha between '$fecha1' and '$fecha2' and a.equipo_fiscal = '$imp2' and a.estado = 'I'
			union
			select min(a.devolucion_fiscal) as fact_inicial, max(a.devolucion_fiscal) as fact_final, sum(round(a.total,2)) as total, a.equipo_fiscal as equipo_fiscal from devolucion_manual a where a.fecha_impresion between '$fecha1' and '$fecha2'  and a.equipo_fiscal = '$imp2'  ", $prop3);
		*/
		////añado totales
		$pdf->Ln(5);
		$pdf->AddCol('total',25,'Total Efectivo','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.efectivo, 2)) as total from devolucion a where  a.fecha_creacion between '$fecha1' and '$fecha2' and a.estado = 'E' and a.efectivo > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		
		$pdf->Ln(5);
		////añado totales
		$pdf->AddCol('total',25,'Total T. Debito','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.tarjeta_clave, 2)) as total from devolucion a where  a.fecha_creacion between '$fecha1' and '$fecha2' and a.estado = 'E' and a.tarjeta_clave > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		
		$pdf->Ln(5);
		////añado totales
		$pdf->AddCol('total',25,'Total T. Credito','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.tarjeta_credito, 2)) as total from devolucion a where  a.fecha_creacion between '$fecha1' and '$fecha2' and a.estado = 'E' and a.tarjeta_credito > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(5);
		////añado totales
		$pdf->AddCol('total',25,'Total Cheque','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.cheque, 2)) as total from devolucion a where  a.fecha_creacion between '$fecha1' and '$fecha2' and a.estado = 'E' and a.cheque > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		
		$pdf->Ln(5);
		////añado totales
		$pdf->AddCol('total',25,'Total Credito','C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT sum(round(a.credito, 2)) as total from devolucion a where  a.fecha_creacion between '$fecha1' and '$fecha2' and a.estado = 'E' and a.credito > 0 and a.caja_id = '$caja_id' order by a.factura_fiscal", $prop3);
		$pdf->Ln(5);
		
		$pdf->Ln(10);
		
		$pdf->SetFont('Arial','',10);
		$titulo = 'Detalle Impresora - '.$caja;
		$pdf->Cell(0,6,$titulo,0,1,'C');
		
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'N/C Fiscal','C');
		$pdf->AddCol('fecha_creacion',30,'Fecha Proceso','C');
		$pdf->AddCol('codigo_cliente',30,'Id. Cliente','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('total',20,'Total','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT a.FA, c.codigo_cliente, substring(concat(b.nombre,' ',b.apellido),1,30) as nombre_paciente, round(a.total, 2) as total, a.factura_fiscal, a.fecha_creacion from devolucion a, clientes b, factura c where a.factura = c.factura and c.codigo_cliente = b.id_cliente and a.fecha_creacion between '$fecha1' and '$fecha2' and a.estado = 'E' and a.caja_id = '$caja_id' 
		union
		select 'Int' as FA, b.codigo_cliente, substring(c.nombre_paciente,1,30) as nombre_paciente, round(a.total, 2) as total, a.devolucion_fiscal as factura_fiscal, a.fecha_impresion from devolucion_manual a, factura b, registro c where a.FA = b.FA and b.cargo = c.cargo and b.tratamiento = c.tratamiento and b.historia = c.historia and a.fecha_impresion between '$fecha1' and '$fecha2'  and a.equipo_fiscal = '$imp' order by factura_fiscal ", $prop3);
		/*
			$pdf->Ln(10);
			$pdf->SetFont('Arial','',10);
			$titulo = 'Detalle Impresora 2 '.$imp2;
			$pdf->Cell(0,6,$titulo,0,1,'C');
			$pdf->Ln(10);
			
			$pdf->AddCol('factura_fiscal',25,'N/C Fiscal','C');
			$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
			$pdf->AddCol('codigo_cliente',30,'Id. Cliente','C');
			$pdf->AddCol('nombre_paciente',60,'Nombre','C');
			$pdf->AddCol('total',20,'Total','C');
			
			
			$prop3=array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);
			
			$pdf->Table("SELECT a.FA, c.codigo_cliente, substring(b.nombre_paciente,1,30) as nombre_paciente, round(a.total, 2) as total, a.factura_fiscal, a.fecha_proceso from devolucion a, registro b, factura c where a.factura = c.factura and c.historia = b.historia and c.tratamiento =b.tratamiento and c.cargo = b.cargo and a.fecha between '$fecha1' and '$fecha2' and a.estado = 'E' and a.equipo_fiscal = '$imp2' 
			union
			select 'Int' as FA, b.codigo_cliente, substring(c.nombre_paciente,1,30) as nombre_paciente, round(a.total, 2) as total, a.devolucion_fiscal as factura_fiscal, a.fecha_impresion from devolucion_manual a, factura b, registro c where a.FA = b.FA and b.cargo = c.cargo and b.tratamiento = c.tratamiento and b.historia = c.historia and a.fecha_impresion between '$fecha1' and '$fecha2'  and a.equipo_fiscal = '$imp2' order by factura_fiscal ", $prop3);
			
			$pdf->Ln(10);
		*/
	}
	
	//NOTAS DE DEBITO
	/*
		$pdf->AddPage();
		$pdf->SetFont('Arial','',14);
		$titulo = 'Notas de Débito';
		$pdf->Cell(0,6,$titulo,0,1,'C');
		
		$pdf->SetFont('Arial','','8');
		//First table: put all columns automatically
		$pdf->Ln(10);
		$pdf->SetFont('Arial','',12);
		$titulo = 'Impresora 1 - '.$caja1;
		$pdf->Cell(0,6,$titulo,0,1,'C');
		$pdf->Ln(5);
		$pdf->AddCol('equipo_fiscal',35,'Nombre Impresora', 'C');
		$pdf->AddCol('fact_inicial',25,'N/D Inicial','C');
		$pdf->AddCol('fact_final',25,'N/D Final','C');
		$pdf->AddCol('total',20,'Total','C');
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("select ifnull(min(a.factura_fiscal),0) as fact_inicial, ifnull(max(a.factura_fiscal),0) as fact_final, ifnull(sum(round(a.total,2)),0) as total, ifnull(a.equipo_fiscal, '$imp1') as equipo_fiscal from nota_debito a where a.fecha_nota between '$fecha1' and '$fecha2' and a.equipo_fiscal = '$imp1' and a.estado = 'I' ", $prop3);
		$pdf->Ln(10);
		$pdf->SetFont('Arial','',12);
		$titulo = 'Impresora 2 - '.$caja2;
		$pdf->Cell(0,6,$titulo,0,1,'C');
		$pdf->Ln(5);
		$pdf->AddCol('equipo_fiscal',35,'Nombre Impresora', 'C');
		$pdf->AddCol('fact_inicial',25,'N/D Inicial','C');
		$pdf->AddCol('fact_final',25,'N/D Final','C');
		$pdf->AddCol('total',20,'Total','C');
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("select ifnull(min(a.factura_fiscal),0) as fact_inicial, ifnull(max(a.factura_fiscal),0) as fact_final, ifnull(sum(round(a.total,2)),0) as total, ifnull(a.equipo_fiscal, '$imp2') as equipo_fiscal from nota_debito a where a.fecha_nota between '$fecha1' and '$fecha2' and a.equipo_fiscal = '$imp2' and a.estado = 'I'  ", $prop3);
		$pdf->Ln(10);
		
		
		
		$pdf->SetFont('Arial','',10);
		$titulo = 'Detalle Impresora 1 '.$imp1;
		$pdf->Cell(0,6,$titulo,0,1,'C');
		
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'N/D Fiscal','C');
		$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
		$pdf->AddCol('codigo_cliente',30,'Id. Cliente','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('total',20,'Total','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT 'N/D' as FA, c.codigo_cliente, substring(b.nombre_paciente,1,30) as nombre_paciente, round(a.total, 2) as total, e.factura_fiscal, e.fecha_nota from nota_debito e, devolucion a, registro b, factura c where e.devolucion = a.devolucion and a.factura = c.factura and c.historia = b.historia and c.tratamiento =b.tratamiento and c.cargo = b.cargo and e.fecha_nota between '$fecha1' and '$fecha2' and e.estado = 'I' and e.equipo_fiscal = '$imp1' order by e.factura_fiscal", $prop3);
		
		$pdf->Ln(10);
		$pdf->SetFont('Arial','',10);
		$titulo = 'Detalle Impresora 2 '.$imp2;
		$pdf->Cell(0,6,$titulo,0,1,'C');
		$pdf->Ln(10);
		
		$pdf->AddCol('factura_fiscal',25,'N/D Fiscal','C');
		$pdf->AddCol('fecha_proceso',30,'Fecha Proceso','C');
		$pdf->AddCol('codigo_cliente',30,'Id. Cliente','C');
		$pdf->AddCol('nombre_paciente',60,'Nombre','C');
		$pdf->AddCol('total',20,'Total','C');
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
		
		$pdf->Table("SELECT 'N/D' as FA, c.codigo_cliente, substring(b.nombre_paciente,1,30) as nombre_paciente, round(a.total, 2) as total, e.factura_fiscal, e.fecha_nota from nota_debito e, devolucion a, registro b, factura c where e.devolucion = a.devolucion and a.factura = c.factura and c.historia = b.historia and c.tratamiento =b.tratamiento and c.cargo = b.cargo and e.fecha_nota between '$fecha1' and '$fecha2' and e.estado = 'I' and e.equipo_fiscal = '$imp2' order by e.factura_fiscal", $prop3);
		
	*/
	
	$pdf->Ln(10);
	
	
	$pdf->Write(5,'Realizada por: ');
	$hora_actual = date("Y-m-d H:i",time());
	$pdf->Ln(10);
	$pdf->Write(5,'_______________________________________________');
	$pdf->Ln(5);
	$pdf->Write(5,$username);
	$pdf->Ln(5);
	$pdf->Write(5,'Hora de Proceso: '.$hora_actual);
	
	
	
	
	//$pdf -> Output($z.".pdf","F");
	//$output = shell_exec('lpr -P cargos1  /var/www/htdocs/apdosis/htdocs/apdosis/fact/'.$z.'.pdf | lpstat -t' );
	//echo "<pre>$output</pre>";
	//sleep(2);
	$pdf->Output();
?>

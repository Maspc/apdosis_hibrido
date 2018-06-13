<?php
ob_start();
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
include ('seguridad.php');  
mysql_query("SET NAMES 'utf8'");
$db_selected = mysql_select_db('apdosis_pub', $conn);

$carro = $_GET['carro'];

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once 'Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Apdosis")
							 ->setLastModifiedBy("Apdosis")
							 ->setTitle("Banco de Medicamentos")
							 ->setSubject("Impresion de Banco de Medicamentos")
							 ->setDescription("Cierre de banco de medicamentos para la nave")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


$r = "select distinct conciliacion_banco.bodega, bodegas.descripcion  from conciliacion_banco, bodegas where codigo_carro = '$carro' and conciliacion_banco.bodega = bodegas.bodega";

$res = mysql_query($r, $conn) or die(mysql_error());

$con = 3;

while ($rows = mysql_fetch_array($res)) {
$titulo = 'BANCO DE MEDICAMENTOS DE '.$rows['descripcion'];

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', $titulo)
            ->setCellValue('A2', 'CANTIDAD INICIAL')
            ->setCellValue('B2', 'MEDICAMENTO')
            ->setCellValue('C2', 'CONSUMO')
			->setCellValue('D2', 'REPOSICION')
			->setCellValue('E2', 'EXISTENCIA FISICA')
			->setCellValue('F2', 'DIFERENCIA');


$p = "select codigo_carro, medicamento_id, CONCAT( medicamentos.nombre_generico,  ' ',  '(', medicamentos.nombre_comercial,  ')',  ' ', medicamentos.posologia,  ' ', tipos_posologias.descripcion,  ' - ', formas_farmaceuticas.descripcion ) as nombre, bodega, conciliacion_banco.cantidad_inicial, consumo, cantidad_enviada from conciliacion_banco, medicamentos, formas_farmaceuticas, tipos_posologias where codigo_carro = '$carro' and bodega = '".$rows['bodega']."' and medicamentos.tipo_posologia = tipos_posologias.codigo_posologia and medicamentos.forma_farmaceutica = formas_farmaceuticas.codigo_forma and medicamentos.codigo_interno = conciliacion_banco.medicamento_id";

$res1 = mysql_query($p, $conn) or die(mysql_error());

while ($rows1 = mysql_fetch_array($res1)){

$celdaA = 'A'.$con;
$celdaB = 'B'.$con;
$celdaC = 'C'.$con;
$celdaD = 'D'.$con;
$celdaE = 'E'.$con;
$celdaF = 'F'.$con;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($celdaA, $rows1['cantidad_inicial'])
            ->setCellValue($celdaB, $rows1['nombre'])
            ->setCellValue($celdaC, $rows1['consumo'])
            ->setCellValue($celdaD, $rows1['cantidad_enviada']);


// Rename worksheet
$titulo_hoja = 'BANCO DE '.$rows['descripcion'];

$objPHPExcel->getActiveSheet()->setTitle($titulo_hoja);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>

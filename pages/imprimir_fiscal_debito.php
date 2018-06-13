<?php
	include('./clases/session.php');
	require_once('../modulos/nota_debito.php');
	
	$FA = $_POST['FA'];
	//$id = $_POST['id'];
	//echo $id;
	$nombre_carpeta = $_POST['impresora'];
	$factura_fiscal = $_POST['factura_fiscal'];
	$numero_veces = $_POST['numero_veces'];
	//$tipo = $_POST['tipo'];
	
	if (isset($_POST['doble'])){
		$doble = $_POST['doble'];
		} else {
		$doble = 'N';
	}
	
	if($nombre_carpeta == 'in1'){
		$nombre_carpeta2 = 'out1';
	}
	
	if($nombre_carpeta == 'in2'){
		$nombre_carpeta2 = 'out2';
	}
	
	if($nombre_carpeta == 'in3'){
		$nombre_carpeta2 = 'out3';
	}
	
	
	$lrow = notadebito::nimpresoras($nombre_carpeta2);
	foreach($lrow as $lw){
		$equipo_fiscal = $lw->nombre;
	}
	
	//$dev_long = "ncti".str_pad(trim($devolucion), 7, 0, STR_PAD_LEFT).".txt";
	
	$grow = notadebito::devol($FA);
	foreach($grow as $gw){
		$devolucion = $gw->devolucion;
		
		if ($doble != 'S') {
			$total = $gw->total;
			} else {
			$total = $gw->total * $numero_veces;
		}
	}	
	
	notadebito::insert1($devolucion,$total,$factura_fiscal,$equipo_fiscal);
	
	$usrow = notadebito::nnota();
	$nota_debito = $usrow[0]->nota_debito;
	
	$nom_archivo = "ncti".str_pad($devolucion, 7, 0, STR_PAD_LEFT);
	
	$existe = 0;
	
	$brow = notadebito::select1($factura_fiscal);
	foreach($brow as $bw){
		$existe = $bw->existe;
	}
	
	if ($existe == 0){
		
		
		$myFile1 =  "/home/apdosis/pos/out1/".$nom_archivo;
		$myFile2 = "/home/apdosis/pos/out2/".$nom_archivo;
		$myFile3 = "/home/apdosis/pos/out3/".$nom_archivo;
		
		if (file_exists($myFile1)) {
			$fh = file($myFile);
			} else if (file_exists($myFile2)){
			$fh = file($myFile2);
			} else if (file_exists($myFile3)){
			$fh = file($myFile3);
		}
		
		foreach($fh as $str)
		
		{
			
			list($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k)=explode("\t",$str);
			
			//echo "<li>".$g; //impresora
			//	echo "<li>".$h; //numero fiscal
			//  echo "<hr>";
		}
		
		$c = substr(substr($c,0,-1),1);	//nombre
		$d = substr(substr($d,0,-1),1); //id
		$g = substr(substr($g,0,-1),1); //impresora
		$h = substr(substr($h,0,-1),1); //factura
		
		notadebito::insert2($factura_fiscal,$FA,$c,$d,$e,$k,$g);		
		
	}
	
	
	
	$deb_long = "NDTI".str_pad(trim($nota_debito), 7, 0, STR_PAD_LEFT);
	$deb_long_min = "ndti".str_pad(trim($nota_debito), 7, 0, STR_PAD_LEFT);
	
	$row =  notadebito::select2($devolucion);
	foreach($row as $rw1){
		$factura = $rw1->factura;
		$fecha = $rw1->fecha_creacion;
		$hist = $rw1->historia;
		$cama = $rw1->no_cama;
		
		
		$rowl = notadebito::select3($hist);
		foreach($rowl as $rwl){
			$nombre = $rwl->nombre_paciente;
			$id_paciente = $rwl->id_paciente;
		}
		
		$rowd = notadebito::select4($devolucion);
		foreach($rowd as $rwd){
			//$factura_fiscal = $rowd['factura_fiscal'];
			$archivo_fiscal = $rwd->archivo_fiscal;
			//$equipo_fiscal = $rowd['equipo_fiscal'];
			$FA = $rwd->FA;
			//$factura_fiscal = '000000007';
			//$archivo_fiscal = 'FACTI0000077';                                                                                                                                                                                                                                                                                                                                                                                           
			//$equipo_fiscal = 'NCTI';
		}
		
		$empresa = $nombre.' Hab: '.$cama.' Hist: '.$hist;
		$ruc = trim($id_paciente);
		$direccion= 'SAN FRANCISCO, URB. PAITILLA  **DEB**';
		//$fiscal = 'CLOK31110179700000027';
		$fact_completa = $equipo_fiscal.$factura_fiscal;
		$fiscal = $fact_completa;
		$fp = fopen("/home/apdosis/pos/".$nombre_carpeta."/".$deb_long.".txt","a");
		fwrite($fp, $deb_long."\t".$empresa."\t".$ruc."\t".$direccion."\t".$total."\t0\tND\t".$fiscal);
		fclose($fp);
		
	}
	
	
	echo "<INPUT TYPE=\"button\" class='blue' value='Obtener N&uacute;mero Fiscal' id='imprimirp' onClick=\"parent.location='numero_fiscal_deb.php?archivo=".$deb_long_min.".txt&nota_debito=".$nota_debito."&carpeta=".$nombre_carpeta2."'\" >";
	//echo "<a href='numero_fiscal_dev.php?archivo=".$dev_long_min.".txt'>Obtener Numero Fiscal</a>";
	
?>

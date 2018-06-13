<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/orden_automatica.php');
	
	if (isset($_POST['medicamento_id'])) { 
	$medicamento_id=$_POST['medicamento_id'];}
	if (isset($_POST['cantidad_med'])) { 
	$cantidad_med=$_POST['cantidad_med'];}
	if (isset($_POST['proveedor'])) { 
	$proveedor=$_POST['proveedor'];}
	if (isset($_POST['escoger'])) { 
	$escoger =$_POST['escoger'];}
	else{
		$escoger = 0;
	}
	if (isset($_POST['cont'])) { 
	$cont=$_POST['cont'];}
	
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
?>
<p style="margin-left: 20"><b><font color="#B8C0F0" face="Arial" size="2">&nbsp;</font></b>
	<font face="Arial" size="2" color="#000000">
		<?php
			
			$grows = oautomatica::idcompras();						
			$id = ($grows[0]->id==0)?1:$grows[0]->id;
			
			$l = 0;
			for($c = 0; $c < sizeof($escoger); $c++) {
				//echo "-valor de escoger: ".$escoger[$c]."<p>";
				//if ($escoger[$c] >= 0 and !empty($escoger[$c]) ){
				//echo "valor de cont: ".$escoger[$c]."<p>";
				//echo "valor de medicamento id: ".$medicamento_id[$escoger[$c]]."<p>";
				//echo "valor de proveedor: ".$proveedor[$escoger[$c]]."<p>";
				//echo "valor de c: ".$c."<p>";
				$l = $c + 1;
				
				/*
					$m = "select (cantidad_inicial - cantidad_factura + cantidad_devolucion) canti, inventario_ideal from medicamentos_x_bodega where medicamento_id = '".$medicamento_id[$escoger[$c]] ."' and estado = 'A' and bodega = '1'";
					
					$mres = mysql_query($m, $conn) or die(mysql_error());
					
					while($mrow = mysql_fetch_array($mres)) {
					$canti_orden =  $mrow['inventario_ideal'] - $mrow['canti'];
					}
				*/
				$canti_orden = $cantidad_med[$escoger[$c]];
				
				oautomatica::insert1($id,$l,$medicamento_id[$escoger[$c]],$canti_orden,$proveedor[$escoger[$c]]);
				//echo "Inserte el detalle de la compra";
				
				//echo "valor de med id: ".$medicamento_id[$c]."<p>";
				//echo "contador: ". $f. "<p>";
				//echo "<p>".$r[$escoger[$c]]."<p>";
				
				
				/*} else {echo "<script language='javascript'>window.location='inventario_bajo.php?men=1'</script>";*/
				//}
			}
			
			$prow = oautomatica::select1($id);
			foreach($prow as $pw){
				$prov = $pw->id_proveedor;
				
				//quemo labodega hasta q la tenga en session
				$bodega = '2';
				
				oautomatica::insert2($prov,$_SESSION['MM_iduser']);
				
				$crow = oautomatica::idcompras2();
				$id2 = $crow[0]->id2;
				/*
					$f_adm = "insert into compras_suc (id_compra,id_proveedor, observacion, fecha_compra, usuario_creacion, estado, factura_proveedor, tipo_entrada, bodega) values 
					('$id2','$prov', 'Orden generada automaticamente por inventario bajo', '". date('Y-m-d H:i',time())."', '".$_SESSION['MM_iduser']."', 'P', ' ', '2', '$bodega')";
					
					
					
					$dbhost = 'localhost';
					$dbuser = 'root';
					$dbpass = 'nipin18*';
					$dbname2 = 'infar_adm';
					$conn_adm = mysql_connect($dbhost, $dbuser, $dbpass, true) or die ('Error connecting to mysql');
					mysql_select_db($dbname2, $conn_adm);
					
					$fres_adm = mysql_query($f_adm, $conn_adm) or die(mysql_error());
				*/
				
				
				
				echo "Generada la orden de compra ". $id2 ." con &eacute;xito <INPUT TYPE=\"button\" class='blue' value='Imprimir Orden' id='imprimir' onClick=\" window.open('imprimir_orden_compra.php?compra=".$id2."','mywindow','width=800,height=600');\" > <p>";
				
				$xrow = oautomatica::select2($id,$prov);
				$con = 0;
				foreach($xrow as $xw){
					$con = $con + 1;
					oautomatica::insert3($id2,$con,$xw->medicamento_id,$xw->cantidad_compra);
					//$r_adm = "insert into compras_detalle_suc (id_compra, linea, medicamento_id, cantidad_compra,estado_proceso, bodega) value ('$id2', '$con',  '".$xw->medicamento_id."', '".$xw->cantidad_compra."','P', '$bodega')";
					/*
						$dbhost = 'localhost';
						$dbuser = 'root';
						$dbpass = 'nipin18*';
						$dbname2 = 'infar_adm';
						$conn_adm = mysql_connect($dbhost, $dbuser, $dbpass, true) or die ('Error connecting to mysql');
						mysql_select_db($dbname2, $conn_adm);
						
						$res_adm = mysql_query($r_adm, $conn_adm) or die(mysql_error());
					*/
				}
			}
			
		?>
	</font>
	<?=layout::fin_content()?>
	<script type="text/javascript">
		function modalWin(url) {
			if (window.showModalDialog) {
				window.showModalDialog(url,"name","dialogWidth:1200px;dialogHeight:600px");
				} else {
				alert(url);
				window.open(url,'name','height=500,width=600,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
			}
		} 
	</script>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/orden_compras_detalle_ext.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
	
	if (isset($_POST['proveedor'])) {
		$proveedor = $_POST['proveedor'];
	}
	if (isset($_POST['observaciones'])) {
		$observaciones = $_POST['observaciones'];
	}
	if (isset($_POST['var_cont'])) {
		$var_cont = $_POST['var_cont'];
	}
	
	$cont_n = 0;
	
	if ($var_cont == 0){
		echo "<script language='javascript'>window.location='orden_compras_detalle.php?men=1'</script>";
		
		} else {
		
		$page_id_index = array_search($_POST['page_instance_id'], $_SESSION['page_instance_ids']);
		if ($page_id_index !== false) {
			unset($_SESSION['page_instance_ids'][$page_id_index]); 
			
			for ($j=1;$j<=$_POST["var_cont"];$j++)
			{
				$canti_veri = $_POST["cantidad_$j"];
				$medicamento_id_1 = $_POST["medicamento_id_$j"];
				
				if($medicamento_id_1  > 0) {
					
					if(!is_numeric($canti_veri) || $canti_veri <= 0 ){
						echo "<script language='javascript'>window.location='orden_compras_detalle.php?men=2'</script>";
						$cont_n = 1;
					} 
				}
			}
			
			if ($cont_n == 0){
				
				ocomprasdet::insert1($proveedor,$observaciones,$_SESSION['MM_iduser']);
				$mid = ocomprasdet::maxid();
				
				$y = $mid[0]->id;
				
				$d = 0;
				for ($i=1;$i<=$_POST["var_cont"];$i++)
				{
					$d = $d + 1;
					$medicamento_id = $_POST["medicamento_id_".$i];
					$cantidad_compra = $_POST["cantidad_".$i];						
					
					$vrow = ocomprasdet::select1($medicamento_id);
					foreach($vrow as $vw){
						$codigo_de_barra = $vw->codigo_de_barra;
					}								
					
					$hirow = ocomprasdet::select2();
					
					foreach($hirow as $hw){
						$ip = $hw->ip;
					}
					//echo "ip ".$ip;
					
					$valido = 0;
					
					$serow = ocomprasdet::select3();
					
					if(count($serow) > 0) {
						
						foreach($serow as $sw){
							$medicamento_id_ext = $sw->codigo_interno;
						}} else {
						echo "No se pudo trasladar el producto con codigo ".$codigo_de_barra." porque no existe en la base de datos externa, verifique";
						$valido = 1;
					}
					
					if($valido!=1){									
						
						ocomprasdet::insert2($y,$d,$medicamento_id,$cantidad_compra,$cantidad_compra);
						
						ocomprasdet::insert3($_SESSION['MM_iduser'],$medicamento_id_ext,$cantidad_externo);
						
					}
				}
			}
		}
	}
	
?>
<h2>Su transacción ha sido realizada con éxito.  El n&uacute;mero de la orden de compra es : <?php echo $y ; ?></h2>
<p>
	<input type="button" value="Imprimir Orden de Compra" class="green" onClick="window.open('imprimir_orden_compra_ext.php?compra=<?php echo $y ?>')" />
	
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script_com.js?r=<?=rand()?>"></script>
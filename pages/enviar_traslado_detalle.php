<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/enviar_traslado_detalle.php');	
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	layout::menu();
	layout::ini_content();
?>
<style type="text/css">
	
	.red {
	background-color: red;
	color: white;
	}
	.white {
	background-color: white;
	color: black;
	}
	.green {
	background-color: green;
	color: white;
	}
	
	.blue {
	background-color: blue;
	color: white;
	}
	.red, .white, .blue, .green {
	margin: 0.5em;
	padding: 5px;
	font-weight: bold;
	
	}
	
	
	
	
	
</style>

<p style="margin-left: 20"><b><font color="#B8C0F0" face="Arial" size="2">&nbsp;</font></b>
	
	<font face="Arial" size="2" color="#000000">
		<?php
			if (isset($_POST['bodega_origen'])) {
				$bodega_origen = $_POST['bodega_origen'];
			}
			if (isset($_POST['bodega_destino'])) {
				$bodega_destino = $_POST['bodega_destino'];
			}
			
			if(isset($_POST['var_cont'])) {
				$var_cont = $_POST['var_cont'];
			}
			
			
			if($var_cont == 0){
				echo "<script language='javascript'>window.location='traslado_detalle.php?men=1'</script>";
				} else {
				$total_comp = 0;
				
				
				$cont = 0;
				
				
				
				//quemo el valor de bodega mientras lo añado a la session
				$bodega = '2';
				
				edetalle::insert1($bodega_origen,$bodega_destino,$_SESSION['MM_iduser']);
				
				$mid = edetalle::maxid();
				$y = $mid[0]->id;
				$d = 0;
				for ($i=1;$i<=$_POST["var_cont"];$i++)
				{
					
					$d = $d + 1;
					$medicamento_id = $_POST["medicamento_id_".$i];
					$cantidad = $_POST["cantidad_".$i];
					
					if($medicamento_id != 0) {
						
						edetalle::insert2($y,$d,$medicamento_id,$cantidad);
						
						
						/*
							$f = "select lote, medicamento_id from medicamentos_x_bodega where lote = '$lote' and medicamento_id = '$medicamento_id' and bodega = 1";
							
							$resf = mysql_query($f, $conn) or die(mysql_error());
							
							$resfnum = mysql_num_rows($resf);
							
							if ($resfnum > 0) {
							while ($row = mysql_fetch_array($resf)){
							$g = "update medicamentos_x_bodega set cantidad_inicial = cantidad_inicial + '$cantidad_compra' where medicamento_id = '$medicamento_id' and lote = '$lote' and bodega = 1";
							$grs = mysql_query($g, $conn) or die(mysql_error());
							} 
							}else {
							$v = "insert into medicamentos_x_bodega (medicamento_id, bodega, lote, fecha_vencimiento, fecha_inicial, cantidad_inicial, estado) values ('$medicamento_id', 1, '$lote', '$vencimiento', '". date('Y-m-d H:i',time())."', '$cantidad_compra', 'P') ";
						}*/
						
						
						$fnum = count(edetalle::select1($bodega_destino,$medicamento_id));
						
						
						//echo "<p>numera de busqueda ".$fnum;
						if ($fnum == 0) {
							
							edetalle::insert3($medicamento_id,$cantidad,$bodega_destino);
							
						}  
						
						/***/
						
						edetalle::update1($cantidad,$medicamento_id,$bodega_destino);
						
						edetalle::update2($cantidad,$medicamento_id,$bodega_origen);
						
						
					}
					
				} }
				
		?>
		
		<h2>Su transacción ha sido realizada con éxito.  El n&uacute;mero de traslado es : <?php echo $y ?></h2><p>
			
			<input type="button" value="Imprimir Traslado" class="green" onClick="window.open('imprimir_traslado_detalle.php?compra=<?php echo $y; ?>')" />
			<?=layout::fin_content()?>
		<script language="javascript" type="text/javascript" src="../js/script_com.js?r=<?=rand()?>"></script>				
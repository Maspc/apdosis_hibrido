<?php
	
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/enviar_ajuste_inventario.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
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
<?php
	layout::menu();
	layout::ini_content();
	
	if(isset($_POST['var_cont'])) {
		$var_cont = $_POST['var_cont'];
	}
	
	//echo "<p>first var cont".$var_cont;
	
	if($var_cont == 0){
		echo "<script language='javascript'>window.location='ajustes_inventario.php?men=1'</script>";
		} else {
		
		$cont = 0;
		
		
		for ($i=1;$i<=$_POST["var_cont"];$i++)
		{
			$d = $d + 1;
			$medicamento_id = $_POST["medicamento_id_$i"];
			$cantidad = $_POST["cantidad_$i"];
			$lote = $_POST["lote_$i"];
			$tipo = $_POST["tipo_$i"];
			
			if($tipo == 'N'){
				$cantidad = $cantidad * -1;
				
			}
			/*
				echo "<p>varcont: ".$var_cont;
				echo "<p>medicamento_id: ".$medicamento_id;
				echo "<p>cantidad: ".$cantidad;
				echo "<p>lote: ".$lote;
			echo "<p>tipo: ".$tipo;*/
			
			
			$grs=enviarai::update1($cantidad,$medicamento_id,$lote);
			
			
			//echo "<p>g: ".$g;
			
			
			$mres = enviarai::update2($cantidad,$medicamento_id);
			
			
			//echo "<p>m: ".$m;
			
			$hora_actual = date("Y-m-d H:i",time());
			
			
			$hres =enviarai::insert1($medicamento_id,$hora_actual,$_SESSION['MM_iduser']);
			
			
			
			$jres = enviarai::insert2($tipo,$medicamento_id,$cantidad,$hora_actual,$_SESSION['MM_iduser']);
			
		}
	}
	
?>

<h2>Su transacción ha sido realizada con éxito.  </h2><p>
<?=layout::fin_content()?>
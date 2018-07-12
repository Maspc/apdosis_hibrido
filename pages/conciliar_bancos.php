<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/conciliar_bancos.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	$cont = 0;
	if(isset($_GET['mensaje'])){
		$mensaje = $_GET['mensaje'];
		}else{
		$mensaje=0;
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	
	<head>
		<title>Apdosis</title>
		
		<!-- Start css3menu.com HEAD section -->
		<!-- <link href="http://themes.static.deseloper.org/themes/examples/base.css" type="text/css" rel="stylesheet" /> -->
		<link rel="stylesheet" href="default.htm_files/css3menu1/style.css" type="text/css" />
		<!-- <link href="styles/modal-window.css" type="text/css" rel="stylesheet" /> !-->
		<!-- End css3menu.com HEAD section -->
		
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
			background-color: #0066FF;
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
		?>
		<p align="center"><h1>Conciliaci&oacute;n de Bancos</h1></p>
		<table>
			<form name="conciliacion" id="conciliacion" action="conciliacion.php" method="post">
				<tr>
					<td>
						C&oacute;digo de Nave de Requisici&oacute;n
					</td>
					<td>
						<?php
							if($mensaje != 0){
								echo "Esta nave y bodega ya fue cerrada o no existe, verifique <p>";
							}
						?>
						Nave:<input type="text" name="nave" id="nave" size="15"><select name="bodega" id="bodega">
						<?php
							$resul = conciliarb::select1();
							foreach($resul as $cols){	  
								
								$bodega = $cols->bodega;
								$nom_bod = $cols->descripcion;
								
							?>
							<option value="<?php echo $bodega; ?>"><?php echo $nom_bod; ?></option>
						<?php } ?> </select></td>
						
				</tr>
				<tr>
					<td colspan="2">
						<center><input name="conciliar" id="conciliar" type="submit" value="Conciliar" /></center>
					</td>
				</tr>
			</form>
		</table>
		<?=layout::fin_content()?>
		<script type="text/javascript">
			function enable()
			{
				if (document.getElementById("cierre_nave").disabled==true)
				{
					document.getElementById("cierre_nave").disabled=false;
				} 
				
		    	
				
				return false;
			}
		</script>		
<?php 
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/cierre_carro_hospital.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	$factura = $_GET['no_factura'];
	//$carro1 = $_GET['carro'];
	//echo "mi numero de factura ".$factura;
	//echo "mi numero de carro ".$carro1;
?>
<style>
	img {
	border:0;
	}
	
	#page {
	width:800px;
	margin:0 auto;
	padding:15px;
	
	}
	
	#logo {
	float:left;
	margin:0;
	}
	
	#address {
	height:100px;
	margin-left:300px; 
	}
	
	table {
	width:100%;
	}
	
	td {
	padding:5px;
	}
	
	tr.odd {
	background:#e1ffe1;
	}
	
</style>

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

<div id="address">
	
    <p>Inversiones y Farmacias S.A.<br />
		<a href="mailto:info@infarsa.com.pa">info@infarsa.com.pa</a>
		<br /><br />
		
		Factura No. # <?php echo "$factura"; ?><br />
		
	</p>
</div><!--end address-->


<p>
	
	
	<?php
		$result = cierre_ch::select2($factura);		
		
		foreach($result as $row){
			//$carro = $row->carro;
		?>
		<strong>Detalles del Paciente</strong><br />
		<b> Historia: </b><?php echo $row->historia; ?><br />
		<b>  Nombre:</b> <?php echo $row->nombre_paciente; ?><br />
		<b> Habitaci&oacute;n:</b> <?php echo $row->no_cama; ?><br />
	<b> Compa&ntilde;&iacute;a de Seguros:</b> <?php echo $row->compania_de_seguro; }?>    </p>
    <hr>   
	<table>
		<tr><td><strong>Medicamento</strong></td><td><strong>Forma Farmac&eacute;utica</strong></td><td><strong>Dosis</strong></td><td><strong>Cada Horas</strong></td><td><strong>Por D&iacute;as</strong></td>
			<td><strong>Cantidad</strong></td> <td><strong>Precio Unitario</strong></td> <td><strong>Costo Insumo</strong></td> <td><strong>Imp.</strong></td> <td><strong>Precio Venta</strong></td>
		</tr>
		<?php 
			
			$resulta = cierre_ch::select3($factura);
			
			foreach($resulta as $rows){
				if ($rows->linea&1) {
					$class = 'odd';
				}
				else
				{
					$class = 'even';
				}
				
				$valida = 0;
				
				$resultag = cierre_ch::select4($factura);
				
				foreach($resultag as $rowsg){
					if ($rowsg->precio_unitario == 0 || $rowsg->cantidad == 0 ) {
						$valida = 1;
					}
				}
				
				
			?>
			
			<tr class="<?php echo "$class"; ?>"><td><?php echo $rows->medicamento; ?></td>
				<td><?php echo $rows->descripcion; ?></td>
				<td><?php echo $rows->dosis;  ?></td>
				<td><?php echo $rows->horas;  ?></td>
				<td><?php echo $rows->dias; ?></td>
				<td><?php echo $rows->cantidad?></td>
				<td><?php echo $rows->precio_unitario?></td>
				<td><?php echo $rows->costo_insumo?></td>
				<td><?php echo $rows->impuesto?></td>
				<td><?php echo $rows->precio_venta?></td>
				</tr> <?php
			}
			
			
			
			$fres = cierre_ch::select5($factura);
			
			foreach($fres as $frow){
				
				$FA = $frow->FA;
				$factura = $frow->factura;
				$archivo_fiscal = "facti".str_pad($FA, 7, 0, STR_PAD_LEFT).".txt";
				$archivo_fiscal2 = "factic".str_pad($factura, 7, 0, STR_PAD_LEFT).".txt";
				$carpeta = $frow->nombre_carpeta2;
				
			}
			
			if ($valida==0){
				echo "</table><INPUT TYPE=\"button\" class='blue' value='Imprimir Factura' id='imprimirp' onClick=\"parent.location='imprimir_fiscal.php?factura=".$factura."'; this.disabled=true; this.value='Imprimiendo…'; \" ><p>";
				echo "<INPUT TYPE=\"button\" class='green' value='Obtener Número Fiscal Solamente' id='imprimirp1' onClick=\"parent.location='numero_fiscal.php?archivo=".$archivo_fiscal."&archivo2=".$archivo_fiscal2."&FA=".$FA."&carpeta=".$carpeta."&factura=".$factura."'\" >";
				} else {
				echo "<p><h2>Esta factura tiene un precio o cantidad en cero, verifique!</h2></p>";
				
			}
			echo "</body></html>";
			
			layout::fin_content();
		?>				
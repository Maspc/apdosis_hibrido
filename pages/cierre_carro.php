<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/cierre_carro.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	$cont = 0;
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
<p align="center"><h1>Cerrar Nave e Imprimir Reporte </h1></p>
<table>
	<form name="cerrar" id="cerrar" action="cerrar.php" method="post" onsubmit="document.getElementById('cierre_nave').disabled=true;">
		<tr>
			<td>
				Código de Nave
			</td>
			<td>
				<select name="cierre" id="cierre">
				<?php 
				    $resul = cierrec::select1();
					foreach($resul as $cols){  
						$nave = $cols->codigo_carro;
						$hora_nave = $cols->intervalo1; 
					?>
					<option value="<?php echo $cols->codigo_carro ?>"><?php echo $cols->intervalo1 ?></option>
				<?php } ?> </select></td>
		</tr>
		<tr>
			
			<?php   
				
				
				$hora_actual = date("Y-m-d H:i",time());
				
				//echo $hora_actual."<p>";
				
				//echo $hora_nave."<p>";
				
				$hora_disponible = date("Y-m-d H:i:s", strtotime("$hora_nave -2 hours")); 
				
				//echo $hora_disponible."<p>";
				
				if($hora_actual < $hora_disponible) {
					$dis = " disabled";
					} else {
					$dis = " ";
				}
				
				
			?>
			
			
			<td colspan="2">
				<center><input name="cierre_banco" id="cierre_banco" type="button" value="Cerrar Banco" onclick="enable(); window.open('cierre_banco.php?nave=<?php echo $nave; ?>','mywindow','width=800,height=600');" <?php echo $dis; ?>/><input name="cierre_nave" id="cierre_nave" type="submit" value="Imprimir y Cerrar" disabled /><p><b>*La nave estar&aacute; habilitada para su cierre UNA HORA antes de su hora de env&iacute;o</b></center>
					
					
				</td>
			</tr>
		</form>
	</table>
	
</div>
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

<script type="text/javascript">
	$('#cerrar').bind('submit', function (e) {
		var button = $('#cierre_nave');
		
		// Disable the submit button while evaluating if the form should be submitted
		button.prop('disabled', true);
		
		var valid = true;    
		
		// Do stuff (validations, etc) here and set
		// "valid" to false if the validation fails
		/*
			if (!valid) { 
			// Prevent form from submitting if validation failed
			e.preventDefault();
			
			// Reactivate the button if the form was not submitted
			button.prop('disabled', false);
		} */
	});
</script>
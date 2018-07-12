<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/inventario_x_bodega.php');
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
<form name="consultar" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
	
    <label><select name="bodega"> 
		<?php
			$resul = inv_xb::select1();
			foreach($resul as $cols){ 
			?>
			<option value="<? echo $cols->bodega ?>"><? echo $cols->descripcion ?></option>
		<?php } ?> </select></label>
		
		<p>
			<input name="enviar" type="submit" value="Consultar" />
			
		</form>
		
		<?php
			if (isset($_POST['enviar'])) {
				
				$bod_num = $_POST['bodega'];
				
				$fres = inv_xb::select2($bod_num);
				
				foreach($fres as $frow){
					$nom_bode = $frow->descripcion;
					
				}
				
				echo "<center><h2>".$nom_bode."</h2></center>";
				
				$Recordset1 = inv_xb::select3($bod_num);
				
				echo "<table border='1px' align='center'>
				<tr>
				<th>Codigo</th>
				<th>Medicamento</th>
				<th>Cantidad</th>
				
				</tr>";
				
				
				foreach($Recordset1 as $row_Recordset1) {
				
					echo "<tr>
					
					<td>" .$row_Recordset1->medicamento_id."</td>
					<td>".$row_Recordset1->nombre."</td>
					<td>".$row_Recordset1->cantidad."</td>";
					
				}
				
				
				echo "</tr></table>";
				
			}
			
			layout::fin_content();
		?>
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
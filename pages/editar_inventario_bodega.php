<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/editar_inventario_bodega.php');
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
			$resul = editar_ib::select0();
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
				
				$fres = editar_ib::select1($bod_num);
				
				foreach($fres as $frow){
					$nom_bode = $frow->descripcion;
					
				}
				
				echo "<center><h2>".$nom_bode."</h2></center>";
				
				
				$Recordset1 = editar_ib::select2($bod_num);
				
				
				echo "
				<form name='editar_inv' id='editar_inv' action='enviar_editar_bodega.php' method='post' onSubmit=\"popupform(this, 'join')\"  >
				
				<table border='1px' align='center'>
				<tr>
				<th>Codigo</th>
				<th>Medicamento</th>
				<th>Cantidad</th>
				<th>Inventario Ideal</th>
				<th>Modificar Lote</th>
				<th>Orden de Impresi&oacute;n</th>			    
				</tr>";
				
				
				foreach($Recordset1 as $row_Recordset1) {			
					
					
					echo "<tr>
					
					
					
					
					<td>" .$row_Recordset1->medicamento_id."<input type='hidden' name='medicamento_id[]' id='medicamento_id' value='".$row_Recordset1->medicamento_id."' /><input type='hidden' name='bodega[]' id='bodega' value='".$row_Recordset1->bodega."' /></td>
					<td>".$row_Recordset1->nombre."</td>
					<td>".$row_Recordset1->cantidad."</td>
				<td><input type='text' name='inventario_ideal[]' id='inventario_ideal' value='".$row_Recordset1->inventario_ideal."' size='15' /></td> "; ?>
				<td><input type='button' name='lote_modi' value='Modificar Lote' id='lote_modi' onClick="javascript:popUp('lotes_bancos.php?medicamento_id=<?php echo $row_Recordset1->medicamento_id; ?>&existencia=<?php echo $row_Recordset1->cantidad;  ?>&bodega=<?php echo $row_Recordset1->bodega; ?> ')" >	</td>	<?php echo		 "<td><input type='text' name='orden_banco[]' id='orden_banco' value='".$row_Recordset1->orden_banco."' size='15' /></td> </tr>";
					
				}			
				
				echo "</table><input type='submit' value='Actualizar Valores' />";
				
			}
			echo "</form>";
			
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
			
			function popUp(URL) {
				day = new Date();
				id = day.getTime();
				eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=400');");
			}
			
			
			function popupform(myform, windowname)
			{
				
				if (! window.focus)return true;
				
				window.open('', windowname, 'width=500,height=200, toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
				myform.target=windowname;
				return true;
			}
			
		</script>			
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/reimprimir_cargos.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="estado" id="estado">
	
	<center><h1>Reimpresión de Cargos</h1></center>
	<table width="780" border="0" cellspacing="0" >
		
		<tr>
			<td>
				<table width="510" border="1" cellspacing="0" bordercolor="#000000" align="center">
					<tr>
						<td>Historia</td>
						<td><input name="historia" type="text" size="20" /></td>
					</tr>
					<tr>
						<td width="194">Cargo</td>
						<td width="278"><input name="cargo" type="text" size="20" /></td>
					</tr>
				</table>
				
				
				<div align="center">
					<input name="buscar" type="submit" value="Buscar Cargos" />  
				</div></td>
		</tr>
	</table>
</form>
<?php     
	
	
	if(isset($_POST['buscar'])){
		if(isset($_POST['historia']) && $_POST['historia']!="")
		{
			$where[] = "factura.historia = '".$_POST['historia']."'";
		}
		if(isset($_POST['cargo']) && $_POST['cargo']!="")
		{
			$where[] = "factura.factura = '".$_POST['cargo']."'";
		}
		
		$u=1;	
		$v=1;	 
		
		$resulta = reim_c::select1($where);
		
		foreach($resulta as $rows7){
			if ($rows7->estado == 'E') {
				$esta = 'ENVIADO A FARMACIA(SIN PROCESAR)';
				}else if ($rows7->estado == 'P'){ 
				$esta = 'PROCESADA';
				}else if ($rows7->estado == 'F'){ 
				$esta = 'FINALIZADO';
				}else if ($rows7->estado == 'X'){ 
				$esta = 'CANCELADO';
				} else if ($rows7->estado == 'I'){ 
				$esta = 'FISCAL';
				}else { 
				$esta = 'Estado no definido';
			}
			echo "<center><h2>No. de Cargo ". $rows7->factura."</h2></center>";
			echo "<p><table border='1' align='center'>
			<th>Historia</th>
			<th>Nombre</th>
			<th>No. Ingreso</th>
			<th>Fecha de Proceso</th>
			<th>Estado de Orden</th>
			";
			if ($rows7->stat == 'S')  {
				echo "<th>Tipo</th>";
			}
			
			echo "<th>Reimprimir</th>";
			echo "</tr>";
			
			echo "<tr>
			<td>".$rows7->historia."</td>
			<td>".$rows7->nombre_paciente."</td>
			<td align='center'>".$rows7->tratamiento."</td>
			<td align='center'>".$rows7->fecha_proceso."</td>
			<td><font color='green'><b>".$esta."</b></font></td>";
			if ($rows7->stat == 'S') {
				echo "<td><font color='red'><b>STAT</b></font></td>";
			}
			echo "<td><input type=\"button\" name=\"imprimir_fact\" value=\"Reimprimir Cargo\" id=\"imprimir_fact\" onClick=\"javascript:popUp('reimprimir_factura.php?factura=".$rows7->factura."')\" /><input type=\"button\" name=\"imprimir_lbl\" value=\"Reimprimir Label\" id=\"imprimir_fact\" onClick=\"javascript:popUp('reimprimir_labels.php?factura=".$rows7->factura."')\" /></td>";
			echo "</tr></table>";
			
			$Recordset1 = reim_c::select2($historia,$tratamiento,$cargo,$factura);
			
		?>
		
		<a href="javascript:toggleDiv('myContent<? echo $u ?>');">Ver Detalle de Entregas</a>
		<div id="myContent<? echo $u ?>" style=" padding: 5px 10px; display: none;">
			<table border="1px">
				<tr>
					<th>No. Despacho</th>
					<th>Medicamento</th>
					<th>Cantidad</th>
					<th>Fecha de Solicitud</th>
					<th>Nave</th>
					<th>No. de Cargo Hospital</th>
					<th>Estado Prod</th>
				</tr>
				
				
				<?php foreach($Recordset1 as $row_Recordset1){
					
					if ($row_Recordset1->estado_producto == 'E'){
						$est = 'ENVIADO (SIN PROCESAR)';
						}else if  ($row_Recordset1->estado_producto == 'P'){
						$est = 'PROCESADO';
						}else if  ($row_Recordset1->estado_producto == 'X'){
						$est = 'CANCELADO';
						}else{
						$est = 'Estado no definido';
					}
					
					if ($row_Recordset1->stat == 'S') {
						$ho = 'N/A';
						} else {
						$yres = reim_c::select3($hora_evento_carro);
						foreach($yres as $yrow){
							$cc = $yrow->codigo_carro;
						}
						
						$ho = $cc. '-' .$row_Recordset1->hora_evento_carro;
					}
					
					
				?>
				
				<tr>
					<td><?php echo $row_Recordset1->despacho; ?></td>
					<td><?php echo $row_Recordset1->medicamento ?> </td>
					<td><?php echo $row_Recordset1->cantidad ?> </td>
					<td><?php echo $row_Recordset1->fecha_creacion ?> </td>
					<td><?php echo $ho ?> </td>
					<td><?php echo $row_Recordset1->fa; ?></td>
					<td><font color="green"><b><?php echo $est ?></b></font></td>
					
				<?php  } ?> 
				
				</tr>
			</table>
		</div>
		
		<?php $u = $u + 1; 
			
			
		?>
		<?php 
			echo "  <hr /><p>";
			
		}
		
	}
	
	
	/*
	$d = "select registro.historia, registro.nombre_paciente, registro.estado, registro.cargo from registro, tratamiento where registro.tratamiento = tratamiento.tratamiento and tratamiento.historia = registro.historia and tratamiento.estado = 'A' and ".implode(" AND ",$where);*/
	
	
	layout::fin_content();
?>
<script type="text/javascript">
	function toggleDiv(divId) {
		$("#"+divId).toggle();
	}
</script>

<script language="javascript">
	<!-- Begin
	function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=800,height=600');");
	}
	
	
	
	function popupform(myform, windowname)
	{
		
		if (! window.focus)return true;
		
		window.open('', windowname, 'width=800,height=500, toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
		myform.target=windowname;
		return true;
	}
	
	
	// End -->
</script>
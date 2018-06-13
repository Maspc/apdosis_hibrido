<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/estado_cargos.php');
	require_once('../modulos/layout.php');	
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	if (isset($_GET['userid'])){
	$userid = $_GET['userid'];}
	if (isset($_GET['session'])){
	$session = $_GET['session'];}
	include('sesion_activa.php');
	if ($estado_sesion == 'A') {
	?>
	<form action="<?php $_SERVER->PHP_SELF; ?>" method="post" name="estado" id="estado">
		
		<table width="780" border="0" cellspacing="0" >
			
			<tr>
				<td>
					<table width="510" border="1" cellspacing="0" bordercolor="#000000" align="center">
						<tr>
							<td>Historia</td>
							<td><input name="historia" type="text" size="20" /></td>
						</tr>
						<tr>
							<td width="194">Orden</td>
							<td width="278"><input name="orden" type="text" size="20" /></td>
						</tr>
						<tr>
							<td width="194">Estado</td>
							<td width="278"><select name="estado"><option value="%">Todos</option><option value="F">Finalizados</option><option value="E">Enviados a Farmacia</option><option value="P">Recurrentes (Activos)</option><option value="X">Cancelados</option><option value="R">Pr&oacute;xima Nave</option></select></td>
						</tr>
					</table>
					
					
					<div align="center">
						<input name="buscar" type="submit" value="Buscar Orden" />  
					</div></td>
					</tr><tr>
					<td></td></tr><tr>
					<td>Descripci&oacute;n tipos de dosis de medicamentos:  <br> <b>Entero:</b> Medicamento que no se puede dividir, ni entregar recurrentemente y su envase trae más de una dosis. Ejemplos: Cremas, gotas óticas, gotas oftálmicas. La cantidad mínima a enviar es 1.<br>
						
						<b>Fraccionado:</b> Medicamento que se puede dividir y entregar recurrentemente. La unidad se puede dividir en más de una dosis. Ejemplos: jarabes y tabletas.<br>
						
						<b>Unitario:</b> Medicamento que no se puede dividir y si se puede entregar recurrentemente. Ejemplos: capsulas liquid-gel, tabletas efervescentes, cápsulas, tabletas con cubierta entérica, etc.<br>
						
					<b>Mixto:</b> Medicamento que se puede dividir y se puede entregar recurrentemente pero se rebaja de inventario la unidad entera y no fraccionado. Ejemplo: I.V.</td></tr>
		</table>
	</form>
	<?php     
		if(isset($_POST['buscar'])){
			if(isset($_POST['historia']) && $_POST['historia']!="")
			{
				$where[] = "registro.historia = '".$_POST['historia']."'";
			}
			if(isset($_POST['orden']) && $_POST['orden']!="")
			{
				$where[] = "registro.cargo = '".$_POST['orden']."'";
			} 
			
			if(isset($_POST['historia'])){
				$historia = $_POST['historia'];
			} 
			/*
				if(isset($_POST['orden) && $_POST['orden!=""){
				$orden = $_POST['orden;
				} else {
				$orden = '%';
				}
			*/
			
			
			$estado_cargo = $_POST['estado'];
			
			$u=1;	
			$v=1;
			
			
			if($estado_cargo != 'R') {	
				
				
				
				
				$resulta = estado_c::select1($where,$estado_cargo);
				
				foreach($rows7 as $resulta){
					if ($rows7->estado == 'E') {
						$esta = 'ENVIADO A FARMACIA(SIN PROCESAR)';
						}else if ($rows7->estado == 'P'){ 
						$esta = 'EN PROCESO (RECURRENCIA)';
						}else if ($rows7->estado == 'F'){ 
						$esta = 'FINALIZADO';
						}else if ($rows7->estado == 'X'){ 
						$esta = 'CANCELADO';
						} else { 
						$esta = 'Estado no definido';
					}
					echo "<center><h1>No. de Orden ". $rows7->cargo."</h1></center>";
					echo "<p><table border='1' align='center'>
					<th>Historia</th>
					<th>Nombre</th>
					<th>No. Ingreso</th>
					<th>Fecha de Solicitud</th>
					<th>Estado de Orden</th>
					";
					if ($rows7->stat == 'S')  {
						
						
						
						$res = estado_c::select2($rows7->historia,$rows7->tratamiento,$rows7->cargo);
						
						foreach($row as $res){
							$bodega = $row->bodega;
							$nombre = $row->descripcion;
						}
						
						if($bodega != 1){
							$banco = "- ".$nombre;
							} else {
							$banco = ' ';
						}
						echo "<th>Tipo</th>";
					}
					
					echo "<tr>
					<td>".$rows7->historia."</td>
					<td>".$rows7->nombre_paciente."</td>
					<td align='center'>".$rows7->tratamiento."</td>
					<td align='center'>".$rows7->fecha_creacion."</td>
					<td><font color='green'><b>".$esta."</b></font></td>";
					if ($rows7->stat == 'S') {
						echo "<td><font color='red'><b>STAT ".$banco."</b></font></td>";
					}
					echo "</tr></table>";
					
					
					
					
					$resulta2 = estado_c::select3($_POST['historia'],$rows7->tratamiento,$rows7->cargo);
					echo "<table border='1' align='center'>
					<tr>
					
					<th>Medicamento</th>
					<th>Forma Farmaceutica</th>
					<th>Dosis</th>
					<th>Cada Horas</th>
					<th>Por Días</th>
					<th>Cantidad Total</th>
					<th>Cantidad Pendiente</th>
					<th>Estado del Medicamento</th>
					<th>Interrumpido por</th>
					<th>Fecha de Interrupcion</th>
					<th>Razon de Interrupcion </th>
					</tr>";
					
					foreach($resulta2 as $rows){
						if ($rows->estado == 'E') {
							$esta1 = 'ENVIADO A FARMACIA';
							}else if ($rows->estado == 'P'){ 
							$esta1 = 'EN PROCESO';
							}else if ($rows->estado == 'X'){ 
							$esta1 = 'CANCELADO';
							}else if ($rows->estado == 'F'){ 
							$esta1 = 'FINALIZADO';
							} else { 
							$esta1 = 'Estado no definido';
						}
						
						if ($rows->razon_int == '1') {
							$razon = 'Cambio de Medicamento';
							}else if ($rows->razon_int == '2'){ 
							$razon = 'Suspension de Medicamentos';
							} else { 
							$razon = ' ';
						}
						
						$ter = 0;
						
						if($rows->cantidad_de_dosis <= 2 && $rows->horas <= 8 && $rows->estado == 'P'){
							$ter = 1;			
						}
						
						
						echo "<tr>";
						echo "<td>" . $rows->medicamento . "</td>";
						echo "<td>" . $rows->descripcion . "</td>";
						echo "<td>" . $rows->dosis . "</td>";
						echo "<td>" . $rows->horas . "</td>";
						echo "<td>" . $rows->dias . "</td>";
						echo "<td>" . $rows->cantidad . "</td>";
						echo "<td><font color='";
						if($ter==1){ echo "red";} else { echo "black";}
						
						echo "'>". $rows->cantidad_de_dosis . "</td>";
						echo "<td><font color='green'><b>" . $esta1 . "</b></font></td>";
						echo "<td>" . $rows->interrumpido_por . "</td>";
						echo "<td>" . $rows->fecha_interrupcion . "</td>";
						echo "<td>" . $razon . "</td>";
						echo "</tr>";
					}
					echo "</table> <p>"; 
					
					
					echo "<p>";
					echo "<input type='button' name='detalle' value='Ver Detalle de Entregas/Devoluciones' onClick=\"modalWin('ver_entregas.php?historia=".$rows7->historia."&tratamiento=".$rows7->tratamiento."&cargo=".$rows7->cargo."')\" /> ";
					echo "<p>";
					
					
					
					
				}  ?>
				<?php 
					echo "  <hr /><p>";
					
					
					
					//añado busqueda de cargos para el siguente MAR
					} else {
					
					
					$tres = estado_c::select4();
					
					foreach($tres as $trow){
						$codigo_carro = $trow->codigo_carro;
						$intervalo1 = $trow->intervalo1;		
					}
					
					$fres = estado_c::select5($historia);
					
					echo "<p><table border='1' align='center'>
					<th>Historia</th>
					<th>Nombre</th>
					";
					
					foreach($fres as $frow){
						echo "<tr>
						<td>".$frow->historia."</td>
						<td>".$frow->nombre_paciente."</td></tr>";
						
					}
					
					echo "</table><p></p>";
					
					
					
					
					
					
					$gres = estado_c::select6($historia,$codigo_carro);
					
					echo "
					
					<table border='1px' align='center'>
					<tr>
					<th>No. Despacho</th>
					<th>Medicamento</th>
					<th>Cada Horas</th>
					<th>Por D&iacute;as</th>
					<th>Tipo de Dosis</th>
					<th>Cantidad</th>
					<th>Fecha de Solicitud</th>
					<th>Nave</th>
					<th>No. de Orden</th>
					<th>Cantidad de Dosis Pend.</th>
					<th>Estado Prod</th>
					<th>Reimprimir Cargo</th>
					
					</tr>
					";
					
					foreach($gres as $grow){
						
						if ($grow->estado_producto == 'E'){
							$est = 'SIN PROCESAR';
							}else if  ($grow->estado_producto == 'P'){
							$est = 'PROCESADO';
							}else if  ($grow->estado_producto == 'X'){
							$est = 'CANCELADO';
							}else{
							$est = 'Estado no definido';
						}
						
						if ($grow->stat == 'S') {
							$ho = 'N/A';
							} else {
							
							
							$yres = estado_c::select7($grow->hora_evento_carro);
							foreach($yres as $yrow){
								$cc = $yrow->codigo_carro;
							}
							
							$ho = $cc. '-' .$grow->hora_evento_carro;
						}
						
						
						$imcar = $grow->cargo;
						$imhis = $grow->historia;
						$imtrat = $grow->tratamiento;
						$imfact = $grow->factura;
						$imuser = $grow->ordenado_por;
						
						$ter = 0;
						
						if($grow->cantidad_de_dosis <= 2 && $grow->horas <= 8 && $grow->estado_producto != 'X' ){
							$ter = 1;			
						}
						
						echo "
						
						<tr>
						
						
						
						
						<td>" .$grow->despacho.		"</td>
						<td>".$grow->medicamento."</td>
						<td>".$grow->horas."</td>
						<td>".$grow->dias."</td>
						<td>". $grow->descripcion."</td>
						<td>".$grow->cantidad."</td>
						<td>".$grow->fecha_creacion."</td>
						<td>".$ho."</td>
						<td>".$grow->cargo."</td>
						<td><font color='";
						if($ter==1){ echo "red";} else { echo "black";}
						echo "'>". $grow->cantidad_de_dosis."</td>
						<td><font color='green'><b>".$est."</b></font></td>
						<td><input type='button' name='reimp' id='reimp' value='Reimprimir' onClick=\"window.open('reimprimir_factura_hosp.php?factura=". $imfact."')\" /></td>";
						
					} 
					
					
					echo "</table>";
					
					
					echo "  <hr /><p>";
					
					
				}
				
		}
		
		} else { 
	echo "<script language='javascript'>window.location='http://192.168.3.2/cmp_appdosis/'</script>"; }  
	
	layout::fin_content();
?>

<script type="text/javascript">
	function toggleDiv(divId) {
		$("#"+divId).toggle();
	}
</script>
<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:1500px;dialogHeight:600px");
			} else {
			alert(url);
			window.open(url,'name','height=600,width=1500,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} 
</script>
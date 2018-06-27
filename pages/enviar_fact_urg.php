<?php 
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/enviar_fact_urg.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	if (isset($_GET['factura'])) { 
	$factura = $_GET['factura'];}
	
	$Hora = Time(); // Hora actual
	$hora_actual =  date('Y-m-d H:i',$Hora);  
	
	$fcies =  enviar_furg::update1($_SESSION['MM_iduser'],$hora_actual,$factura);
	
	
	
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
	height:150px;
	margin-left:300px;
	font-size:14px;
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
	
	.button[disabled]{
	background-color:#FFF;
	}
	
</style>

<?php
	
	layout::menu();
	layout::ini_content();
	
	$result1 = enviar_furg::select1($factura);
	
	
	
	$num1 = count($result1);
	foreach($result1 as $row1)
	{ 
		
		
		$feres =enviar_furg::select2($row1->medico); 
		
		
		
		$fenum = count($feres);
		
	}
	
	
	if ($fenum == 0){
		echo "El m&eacute;dico de este paciente no existe en Apdosis, por favor dar clic a este boton para actualizar la lista de medicos, espere a que muestre la pantalla de que finalizo la actualizaci&oacute;n de m&eacute;dicos y luego vuelva a abrir el cargo: &nbsp;&nbsp; <input type='button' name='actualizar_medicos' value='Actualizar Lista de M&eacute;dicos' id='actualizar_medicos' onClick=\"javascript:popUp('actualizar_medicos.php')\" />"; 
		} else { 
		
		
	?>
	
	
	
	
	
	<!--end logo-->
	<div>
		
		
		
		<font size="+1"> Orden de Entrega URGENTE No. # <?php echo "$factura"; ?><br /> </font>
		
	</p>
</div><!--end addreb ss-->



<table border="0" bgcolor="#abd0fa" width="200" >
	<tr><td colspan="2" align="center">
		<?php
			
			$id = session_id();
			
			$rres =enviar_furg::select3($factura);
			
			
			$rnum = count($rres);
			
			if($rnum != 0){
				foreach($rres as $rrow )
				{
					$usr = $rrow->usuario;
					$sessionid = $rrow->sessionid;
					$save_path = ini_get('session.save_path');
					if (!file_exists($save_path. '/sess_'.$sessionid)) {
						$h = 1;
						}  else {
						$h = 0;
					}
				}
			}
			
			
			if ($rnum == 0 || $h == 1 || $usr == $_SESSION['MM_iduser'] ) {
				
				$tres = enviar_furg::insert1($_SESSION['MM_iduser'],$factura,$id ); 
				
				
				
				$result =enviar_furg::select4($factura); 
				
				
				
				$num = count($result);
				foreach($result  as $row)
				{ 
					
					$lres =enviar_furg::select5($row->historia);
					
					$lnum = count($lres);
					$oc = '0';
					
					if ($lnum > 0) {
						
						foreach($lres as $lrow )
						{
							$oc = '1';
						}
						} else {
						$oc = '0';
					}
					
					$fres = enviar_furg::select6($row->medico);
					
					
					$nom_med = $row->medico;
					foreach($fres as $frow )
					{
						$nom_med = $frow->nombre;
					}
					
					$cargo_impreso = $row->cargo_impreso;
					
				?>
			<strong>DATOS GENERALES DEL PACIENTE</strong></td></tr><br />
			<tr bgcolor="#FFFFFF"><td><b> Historia: </b></td><td><?php echo $row->historia;  if ($oc == '1') { echo "&nbsp;&nbsp;&nbsp;<h3>Este paciente tiene Observaciones Cl&iacute;nicas</h3>"; } ?> &nbsp;&nbsp;&nbsp;<input type="button" name="ver_historia"  value="Ver Obs. Clínicas" id="ver_historia" onClick="javascript:popUp('ver_historia.php?historia=<?php echo $row['historia']; ?>')" <?php if ($oc == '1') { echo " class='red'"; }  ?>/><br /></td></tr>
			<tr><td> <b>  Nombre:</b></td><td> <?php echo $row->nombre_paciente; ?><br /></td></tr>
			<tr bgcolor="#FFFFFF"><td> <b> Habitaci&oacute;n:</b></td><td> <?php $row->no_cama; ?><br /></td></tr>
			<tr><td>  <b> Compa&ntilde;&iacute;a de Seguros:</b></td><td> <?php echo $row->compania_de_seguro; ?></td></tr> 
			<tr bgcolor="#FFFFFF"><td>  <b> M&eacute;dico:</b> </td><td><?php echo $nom_med; ?> </td></tr></br>
			<tr><td>  <b> Edad:</b></td><td> <?php echo $row->edad; ?></td></tr>
			<tr bgcolor="#FFFFFF"><td>  <b> No. de Tratamiento:</b></td><td> <?php echo $row->tratamiento; ?></td></tr>
			<tr><td>  <b> No. de Orden:</b></td><td> <?php echo $row->orden; ?></td></tr>
	<tr bgcolor="#FFFFFF"><td>  <b> No. de Despacho:</b></td><td> <?php echo $row->despacho; ?></td></tr>   </p> 
	<tr><td colspan="2"><b> <?php echo $row->contraindicaciones; } ?></b> </td></tr></table>
	<hr>
	<form action="imprimir_labels.php" id="labels" method="post" target="_blank">
		<table> 
			<tr><td><strong>Medicamento</strong></td>
				<td><strong>Forma Farmac&eacute;utica</strong></td>
				<td><strong>Dosis</strong></td>
				<td><strong>Cada Horas</strong></td>
				<td><strong>Turno</strong></td>
				<td><strong>Por D&iacute;as</strong></td>
				<td><strong>Cantidad</strong></td>
				<td><strong>Observaci&oacute;n</strong></td>
				<td> <strong> Obs. Farmaceutica</strong></td>
				<td><strong> Raz&oacute;n de Obs.</strong></td>
				<td><strong>Lote</strong></td>
				<td colspan ="4"><strong>Fecha Vencimiento Preparacion</strong></td>
				<td><strong>Contraindicaciones</strong></td>
				<td><strong>&iquest;Imprimir Labels? Todos? <input type='checkbox' name='checkall' onclick='checkedAll(labels);'> </strong></td>
				
				
				
				
				<!--  <td><strong>¿Imprimir Label?</strong></td> -->
			</tr>
			
			<?php 
				/*
					$n = "SELECT a.medicamento, a.forma_farma, b.descripcion, a.dosis_mostrar as dosis, a.horas, a.dias, a.linea, a.cantidad, concat(a.average, ' dosis de ', a.dosis_mostrar ) as cantidad_mostrar, a.observacion, a.contra, a.observacion_farma, a.razon_observacion, a.fecha_vencimiento FROM factura_detalle a, formas_farmaceuticas b, factura c where a.factura = '$factura' and estado_producto not in ('X', 'P') and a.forma_farma = b.codigo_forma and a.factura = c.factura and c.estado_factura = 'E'";
				*/
				
				$resulta =enviar_furg::select7($factura); 
				
				
				
				
				$con = 1;
				foreach($resulta as $rows )
				
				{
					if ($rows->linea&1) {
						$class = 'odd';
					}
					else
					{
						$class = 'even';
					}
					
					$hres =enviar_furg::select8();
					
					foreach($hres as $hrow )
					
					{
						
						$lote_auto = $hrow->lote_auto;
						$ven_auto = $hrow->ven_auto;
					}
					
					
					
					
					
				?>
				
				<tr class="<?php echo "$class"; ?>"><td><?php echo $rows->medicamento; ?></td>
					<td><?php echo $rows->descripcion; ?></td>
					<td><?php echo $rows->dosis;  ?></td>
					<td><?php echo $rows->horas;  ?></td>
					<td><?php echo $rows->desc_turno;  ?></td>
					<td><?php echo $rows->dias; ?></td>
					<td><?php echo $rows->cantidad_mostrar?></td>
					<td><?php echo $rows->observacion?></td>
					<td><input type="hidden" name="obs[]" value="<?php echo $rows->observacion; ?>"><input type="text" name="obsfarma[]" value="<?php echo $rows->observacion_farma?>" size="50" ></td>
					<td><select name="razonobs[]"> <?php
						
						$resul =enviar_furg::select9();
						foreach(  $resul as $cols )
						{	  
						?>
						<option value="<? echo $cols->codigo_razon?>" <? if ($cols->codigo_razon  == $rows->razon_observacion) { echo ' selected'; }  ?>><? echo $cols->descripcion ?></option>
					<?php } ?> </select>		  
					</td>
					
					
					
					<?php
						$gres =  enviar_furg::select10($rows->medicamento_id);
						
						foreach($gres as $grow)
						{
							
							$existencia = $grow->existencia;
						}
						
						
						if ($lote_auto == 'S') {
							
							$gres = enviar_furg::select11($rows->medicamento_id);
							
							
							
							$gnum = count($gres);
							
							if ($gnum == 1) {
								foreach($gres as $grow)			
								{
									echo "<td><input type='text' name='lote[]' id='lote' value='".$grow->lote."' readonly>";
									
								?>
								
								<input type="button" name="lote_bt"  value="Editar Lote" id="lote_bt" onClick="javascript:popUp('lotes_por_factura.php?medicamento_id=<?php echo $rows->medicamento_id; ?>&factura=<?php echo $factura  ?>&medicamento=<?php echo $rows->medicamento  ?>&con=<?php echo $con ?>&turno=<?php echo $rows->turno  ?>')" <?php if ($lo == 1){ echo " class='green'"; } else { echo " class= 'white'";} ?> />
								
								<input type="button" name="lote_modi"  value="Modificar Lote" id="lote_modi" onClick="javascript:popUp('lotes_modificar.php?medicamento_id=<?php echo $rows->medicamento_id; ?>&existencia=<?php echo $existencia  ?> ')" >
								
								<?php
									
									
								} } else {			
								$vres =enviar_furg::select12(); 
								
								foreach( $vres as $vrow)
								{
									echo "<td><input type='text' name='lote[]' id='lote' value='".$vrow->lote."' readonly >";
									
								?>
								
								
								<input type="button" name="lote_bt"  value="Editar Lote" id="lote_bt" onClick="javascript:popUp('lotes_por_factura.php?medicamento_id=<?php echo $rows->medicamento_id; ?>&factura=<?php echo $factura  ?>&medicamento=<?php echo $rows->medicamento ?>&con=<?php echo $con ?>&turno=<?php echo $rows->turno  ?>')" <?php if ($lo == 1){ echo " class='green'"; } else { echo " class= 'white'";} ?> />
								<input type="button" name="lote_modi"  value="Modificar Lote" id="lote_modi" onClick="javascript:popUp('lotes_modificar.php?medicamento_id=<?php echo $rows->medicamento_id; ?>&existencia=<?php echo $existencia  ?> ')" >
								
								<?php
								}
								
								//echo "<td>lote";
								
								
							} }else { 
							
							$gres =enviar_furg::select13($rows->medicamento_id); 
							foreach($gres as )
							{
								
								$gnum =count($gres);
								
								if ($gnum == 1) {	
									foreach($gres as $grow)		
									{
									echo "<td><input type='text' name='lote[]' id='lote' value='".$grow->lote."' readonly > "; ?>
									<input type="button" name="lote_bt"  value="Editar Lote" id="lote_bt" onClick="javascript:popUp('lotes_por_factura.php?medicamento_id=<?php echo $rows->medicamento_id; ?>&factura=<?php echo $factura  ?>&medicamento=<?php echo $rows->medicamento  ?>&con=<?php echo $con ?>&turno=<?php echo $rows->turno  ?>')" <?php if ($lo == 1){ echo " class='green'"; } else { echo " class= 'white'";} ?> />
									<input type="button" name="lote_modi"  value="Modificar Lote" id="lote_modi" onClick="javascript:popUp('lotes_modificar.php?medicamento_id=<?php echo $rows->medicamento_id; ?>&existencia=<?php echo $existencia  ?> ')" >
									<?php
									} } else {		?>	
									
									<td><input type="button" name="lote_bt"  value="Asignar Lotes" id="lote_bt" onClick="javascript:popUp('lotes_por_factura.php?medicamento_id=<?php echo $rows->medicamento_id; ?>&factura=<?php echo $factura  ?>&medicamento=<?php echo $rows->medicamento ?>&con=<?php echo $con ?>&turno=<?php echo $rows->turno  ?>')" <?php if ($lo == 1){ echo " class='green'"; } else { echo " class= 'white'";} ?> />
										<input type='hidden' name='lote[]' id='lote' >
										<input type="button" name="lote_modi"  value="Modificar Lote" id="lote_modi" onClick="javascript:popUp('lotes_modificar.php?medicamento_id=<?php echo $rows->medicamento_id; ?>&existencia=<?php echo $existencia  ?> ')" >
										<?php
										}
										
										
										
									}
							?>
							
						</td>
						<td>
							<?php
								$fecha=getdate(); 
								$anio=$fecha["year"]; 
								$mes=$fecha["mon"]; 
								$dia=$fecha["mday"];   	 
								
								if (strlen($mes) == 1) {
									$mes = '0'.$mes;
								}
								
								if (strlen($dia) == 1) {
									$dia = '0'.$dia;
								}
								
							?>
							<input type="checkbox" value="<?php echo $con; ?> " name="fecha[]" <?php echo "id='fecha".$con."'"; ?> onChange="enableFecha(<?php echo $con;?>);"></td><td>
							<input type="hidden" name="fecha_vencimiento[]" value="<?php echo $rows['fecha_vencimiento']?>" size="30" > 
							<select name="anio[]" <?php echo "id='anio".$con."'"; ?> disabled>
								<option value= "2013" <?php if ($anio == 2013) { echo " selected"; } ?> >2013</option>
								<option value= "2014" <?php if ($anio == 2014) { echo " selected"; } ?>>2014</option>
								<option value= "2015" <?php if ($anio == 2015) { echo " selected"; } ?>>2015</option>
								<option value= "2016" <?php if ($anio == 2016) { echo " selected"; } ?>>2016</option>
								<option value= "2017" <?php if ($anio == 2017) { echo " selected"; } ?>>2017</option>
								<option value= "2018" <?php if ($anio == 2018) { echo " selected"; } ?>>2018</option>
								<option value= "2019" <?php if ($anio == 2019) { echo " selected"; } ?>>2019</option>
								<option value= "2020" <?php if ($anio == 2020) { echo " selected"; } ?>>2020</option>
								<option value= "2021" <?php if ($anio == 2021) { echo " selected"; } ?>>2021</option>
								<option value= "2022" <?php if ($anio == 2022) { echo " selected"; } ?>>2022</option>
							<option value= "2023" <?php if ($anio == 2023) { echo " selected"; } ?>>2023</option></select></td><td>
							<select name="mes[]" <?php echo "id='mes".$con."'"; ?> disabled>
								<option value="01" <?php if ($mes == '01') { echo " selected"; } ?>>01</option>
								<option value="02" <?php if ($mes == '02') { echo " selected"; } ?>>02</option>
								<option value="03" <?php if ($mes == '03') { echo " selected"; } ?>>03</option>
								<option value="04" <?php if ($mes == '04') { echo " selected"; } ?>>04</option>
								<option value="05" <?php if ($mes == '05') { echo " selected"; } ?>>05</option>
								<option value="06" <?php if ($mes == '06') { echo " selected"; } ?>>06</option>
								<option value="07" <?php if ($mes == '07') { echo " selected"; } ?>>07</option>
								<option value="08" <?php if ($mes == '08') { echo " selected"; } ?>>08</option>
								<option value="09" <?php if ($mes == '09') { echo " selected"; } ?>>09</option>
								<option value="10" <?php if ($mes == '10') { echo " selected"; } ?>>10</option>
								<option value="11" <?php if ($mes == '11') { echo " selected"; } ?>>11</option>
								<option value="12" <?php if ($mes == '12') { echo " selected"; } ?>>12</option>
							</select></td><td>
							<select name="dia[]" <?php echo "id='dia".$con."'"; ?> disabled>
								<option value="01" <?php if ($dia == '01') { echo " selected"; } ?>>01</option>
								<option value="02" <?php if ($dia == '02') { echo " selected"; } ?>>02</option>
								<option value="03" <?php if ($dia == '03') { echo " selected"; } ?>>03</option>
								<option value="04" <?php if ($dia == '04') { echo " selected"; } ?>>04</option>
								<option value="05" <?php if ($dia == '05') { echo " selected"; } ?>>05</option>
								<option value="06" <?php if ($dia == '06') { echo " selected"; } ?>>06</option>
								<option value="07" <?php if ($dia == '07') { echo " selected"; } ?>>07</option>
								<option value="08" <?php if ($dia == '08') { echo " selected"; } ?>>08</option>
								<option value="09" <?php if ($dia == '09') { echo " selected"; } ?>>09</option>
								<option value="10" <?php if ($dia == '10') { echo " selected"; } ?>>10</option>
								<option value="11" <?php if ($dia == '11') { echo " selected"; } ?>>11</option>
								<option value="12" <?php if ($dia == '12') { echo " selected"; } ?>>12</option>
								<option value="13" <?php if ($dia == '13') { echo " selected"; } ?>>13</option>
								<option value="14" <?php if ($dia == '14') { echo " selected"; } ?>>14</option>
								<option value="15" <?php if ($dia == '15') { echo " selected"; } ?>>15</option>
								<option value="16" <?php if ($dia == '16') { echo " selected"; } ?>>16</option>
								<option value="17" <?php if ($dia == '17') { echo " selected"; } ?>>17</option>
								<option value="18" <?php if ($dia == '18') { echo " selected"; } ?>>18</option>
								<option value="19" <?php if ($dia == '19') { echo " selected"; } ?>>19</option>
								<option value="20" <?php if ($dia == '20') { echo " selected"; } ?>>20</option>
								<option value="21" <?php if ($dia == '21') { echo " selected"; } ?>>21</option>
								<option value="22" <?php if ($dia == '22') { echo " selected"; } ?>>22</option>
								<option value="23" <?php if ($dia == '23') { echo " selected"; } ?>>23</option>
								<option value="24" <?php if ($dia == '24') { echo " selected"; } ?>>24</option>
								<option value="25" <?php if ($dia == '25') { echo " selected"; } ?>>25</option>
								<option value="26" <?php if ($dia == '26') { echo " selected"; } ?>>26</option>
								<option value="27" <?php if ($dia == '27') { echo " selected"; } ?>>27</option>
								<option value="28" <?php if ($dia == '28') { echo " selected"; } ?>>28</option>
								<option value="29" <?php if ($dia == '29') { echo " selected"; } ?>>29</option>
								<option value="30" <?php if ($dia == '30') { echo " selected"; } ?>>30</option>
								<option value="31" <?php if ($dia == '31') { echo " selected"; } ?>>31</option>
							</select></td>
							<td><?php echo $rows['contra']?></td>
							<td> <input type="checkbox" name="int[]" id="int<?php echo $con ?>" value="<?  echo $rows['linea']; ?>"/><input type="hidden" name="turno[]" value="<? echo $rows['turno']; ?>"><input type="hidden" name="linea[]" value="<? echo $rows['linea']; ?>"><input type="hidden" name="factura[]" value="<?php echo $factura; ?>"><input type="hidden" name="medicamento_id[]" value="<?php echo $rows['medicamento_id']; ?>"></td>
							</tr> <?php 
							
							$con = $con + 1;
					}
					
					
					$url = "finalizar_urg.php?factura=".$factura;
					
					
					
					echo "</table> ";
					
					if ($num > 0) {
						
						echo " 
						<INPUT TYPE=\"button\" class='blue' value='Imprimir Cargo' id='imprimir' onClick=\"enable(); window.open('imprimir_factura.php?factura=".$factura."','mywindow','width=800,height=600');\" >
						<p>
						<INPUT TYPE=\"submit\" id='actobs' value='Actualizar Observaciones' name='actobs' class = 'blue' >
						<p>
						
						<INPUT TYPE=\"button\" id='imprimirbin' name='bin' value='Imprimir Bin'  class = 'blue' onClick=\"window.open('imprimir_bin.php?factura=".$factura."','mywindow','width=800,height=600');\" >
						<p>
						
						<INPUT TYPE=\"submit\" id='imprimirlabel' value='Imprimir Label' name='label' onClick=\" enable2();\" class = 'blue' disabled>
						<p>
						<INPUT TYPE=\"submit\" id='imprimirprep' value='Imprimir Preparaci&oacute;n' name='prep' onClick=\" enable2();\"  class = 'blue' disabled>
						<p>
						<INPUT TYPE=\"button\" class='green' value='Finalizar>>' id='siguiente' onClick=\"modalWin('".$url."'); return false;\" ";
						if($cargo_impreso != 'S'){ echo " disabled "; }
						echo " >";
						echo "</form>";
						echo "<p><p><p>*Debe dar clic al bot&oacute;n de Imprimir Cargo para habilitar el bot&oacute;n de Siguiente</body></html>";
						} else{
						echo "<p>Ya fue procesado";
					}
					}else{
					
					echo "Este cargo ya est&aacute; siendo procesado por ".$usr."!";
				}
			}
			
			layout::fin_content();
		?>
		
		<script type="text/javascript">
			function enable()
			{
				if (document.getElementById("imprimirlabel").disabled==true)
				{
					document.getElementById("imprimirlabel").disabled=false;
				} 
				
				if (document.getElementById("imprimirprep").disabled==true)
				{
					document.getElementById("imprimirprep").disabled=false;
				} 
				
				
				return false;
			}
			
			function enable2()
			{
				if (document.getElementById("siguiente").disabled==true)
				{
					document.getElementById("siguiente").disabled=false;
				} 
				return false;
				
				
			}
			
			
			function enableFecha(con)
			{
				
				var fecha = "fecha"+con;
				var anio = "anio"+con;
				var mes = "mes"+con;
				var dia = "dia"+con;
				
				if (document.getElementById(fecha).checked==true)
				{
					
					
					document.getElementById(anio).disabled=false;
					document.getElementById(mes).disabled=false;
					document.getElementById(dia).disabled=false;
					
					} else {
					
					document.getElementById(anio).disabled=true;
					document.getElementById(mes).disabled=true;
					document.getElementById(dia).disabled=true;
					
					
				}
				return false;
			}
			
			
		</script>
		
		<script language="javascript">
			<!-- Begin
			function popUp(URL) {
				day = new Date();
				id = day.getTime();
				eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=400');");
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
		<base target="_self">
        <script type="text/javascript">
            function Redirect(url)
            {
				document.getElementById('siguiente').href = url;
				document.getElementById('siguiente').click(); 
			}
		</script>
		<script type="text/javascript">
			function modalWin(url) {
				if (window.showModalDialog) {
					window.showModalDialog(url,"name","dialogWidth:1200px;dialogHeight:600px");
					window.close();
					} else {
					//alert(url);
					window.open(url,'name','height=500,width=600,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
				}
			} </script>
			
			<script type="text/javascript">
				
				function checkedAll (labels) {
					
					
					
					for (var i = 1; i < 16; i++) 
					{
						var intt = 'int'+i;	 
						
						
						
						document.getElementById(intt).checked = true;
						
						
						
					}
				}
				
				
				
				
			</script>			
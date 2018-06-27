<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/cerrar.php');
	require_once('../modulos/layout.php');
	layout::encabezado();	
	
	$cont = 0;
	if (isset($_POST['cierre'])) { 
		$carro = $_POST['cierre'];
		} else {
		$carro = 0;
	}
	
	
	if ($carro != 0) {
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
		
		
		$act = 0;
		//echo "<p>carro ".$carro;
		
		//primero busco si tengo algun cargo pendiente sin procesar de esta nave
				
		$bres = cerrar::select1($carro);
		
		//echo "query de existencia ".$b;
		
		$bnum = count($bres);
		
		if ($bnum > 0) {
			echo "<font size='2'>No puede continuar porque tiene ".$bnum." ordenes pendientes por procesar de esta nave</font>";
			$act = 1;
			} else {
			
			//verificar el registro para cargos subsecuentes
						
			$res22 = cerrar::select2($carro);
			
			//echo "<p>query de ty ".$ty;
			
			foreach($res22 as $rows22){
				//actualizo el registro detalle si ya es la ultima vuelta
								
				//echo "<p>query h ".$h;
				
				
				$resulta21 = cerrar::select3($rows22->factura);
				
				foreach($resulta21 as $rows21){
					$historia = $rows21->historia;
					$tratamiento = $rows21->tratamiento;
					$despacho= $rows21->cargo;
					if (($rows21->cant_total - $rows21->average) <= 0) { 
						//echo "<br>se detiene el medicamento porque: ".$rows21['cant_total'];
						//echo"<br>3. la cantidad de dosis menos uno es: ".$rows21['cant_total'] - $rows21['average'];
						
						$ores = cerrar::update1($historia,$tratamiento,$despacho,$rows21->medicamento_id);
						//echo "up ".$o;
						
						} else {
						
						$resui =cerrar::update2($rows21->average,$historia,$tratamiento,$despacho,$rows21->medicamento_id);
						//echo $ui;
						//echo "La cantidad de dosis que restaré a la original es: ".$rows21['average'];
						
						
					}
					
					$rires = cerrar::select4($historia,$tratamiento,$despacho);
				
					//echo $ri;
					foreach($rires as $rirow)
				{
						$valido = $rirow->valido;
					}
					//echo 'valido: '.$valido;
					
					
					if ($valido == 0) {
						$kires =cerrar::update3($historia,$tratamiento,$despacho);
						
						
					}
					
					
					
				}
				
				
			}
			
			$Hora_S = Time(); // Hora actual
			$hora_actual_S =  date('Y-m-d H:i',$Hora_S);
			
			
			$res =  cerrar::update4($hora_actual_S,$_SESSION['MM_iduser'],$carro);
			
			
			
			
		$res0 =  cerrar::select5($carro);
			
			foreach($res0 as $rows0)
			
		    {
				echo "<table border='1' align='center'>
				<tr>
				<td colspan = '3'>
				<h1>Nave - ".$carro." Fecha: ".$rows0->intervalo1."</h1>
				</td>
				<td colspan = '3'>
				<h1>Información del Paciente</h1>
				</td>
				</tr>
				<tr>
				<th>Cargo</th>
				<th>Medicamento</th>
				<th>Cantidad</th>
				<th>Cama</th>
				<th>Id. Paciente</th>
				<th>Nombre Paciente</th>
				<th>FA</th>
				</tr>";
			}
			
			
			
			
			//se crea la nueva factura para procesar
			$res2 =  cerrar::select6($carro);
			
			//echo "<p> query t de factura nueva ".$t;
			
			
			
			foreach($res2 as $rows2 )
			
		{
				
				
				$bres = cerrar::delete1(); 
				
				$bres = mysql_query($b, $conn) or die(mysql_error());
				
				//primero busco las distntas horas de nave que tengo en la factura
				
				$rs =  cerrar::select7($rows2->factura);
				foreach($rs as $ro )
				 {
					
					$hora_actual = $ro->hora_evento_carro;
					
					$lin = $ro->linea;
					
					$intervalo_dosis = $ro->intervalo_dosis;
					
					$factu =  $ro->factura; 
					
					$precio_unitario = round($ro->precio_unitario,2); 
					
					$cantidad = $ro->cantidad; 
					
					$cantidad_de_dosis = $ro->cantidad_de_dosis;
					
					$tipo_de_dosis = $ro->tipo_de_dosis; 
					
					$hora_ultima_dosis = $ro->hora_ultima_dosis;
					
					$turno = $ro->turno;
					
					//echo "intervalo dosis: ".$intervalo_dosis;
					//echo "<p>linea: ".$linea;
					//echo "<p>cargo: ".$cargo;
					
					
					//echo "la hora actual: ".$hora_actual;
					
					$intervalo = (int)$intervalo_dosis;
					
					$valor = strtotime("$hora_ultima_dosis + $intervalo hours");
					
					$hora_actual_n = date("Y-m-d H:i", $valor);
					
					$rest = cerrar::insert1($hora_actual_n);
					
					
					
					$resd = cerrar::select8(); 
					foreach($resd as $rowsd )
					
					
				 {
						$hora_actual_b = $rowsd->hora_actual;
						
						$respar =cerrar::select9($hora_actual_b); 
						foreach($respar as $rowspar )
						
						{ 
							$estado = $rowspar->estado;
							$codigo_carro = $rowspar->codigo_carro;
							$inter2 = $rowspar->intervalo2;
							
							if ($inter2 == $hora_actual_b ) {
								$codigo_carro = $rowspar->codigo_carro + 1;
							}		 
							
							if ($estado == 'F') { 
								$codigo_carro = $rowspar->codigo_carro + 1;
							} 
							
							$resf = cerrar::select10($codigo_carro); 
							foreach($resf as $rowf )
							{
							$hora_evento_carro = $rowf->intervalo1;}
							
							$hora_evento_carro = date("Y-m-d H:i",strtotime($hora_evento_carro));
						}
						
						//echo "<br>hora evento de carro: ".$hora_evento_carro;
						//echo "<br>el carrito en q se va: ".$codigo_carro;  
						//echo "<br>el cargo es: ".$cargo;  
						//echo "<br>la linea es: ".$linea;  
					}
					
						$resg =  cerrar::delete2();
					
					
					
					/*	
						$d = "update factura_detalle set  hora_evento_carro='$hora_evento_carro', codigo_carro = '$codigo_carro' where factura = '$factu' and linea = '$lin'";
						
						//echo $d."</br>";
						
						$resd = mysql_query($d, $conn) or die(mysql_error());
					*/
					$resul2 = cerrar::select11($codigo_carro);
					
				foreach($resul2 as $rows2 )
					
					 {
						
						$hora1 = $rows2->intervalo1;
						
						$hora2 = $rows2->intervalo2;
						
						//$cantidad_de_horas = (date("H:i", strtotime("00:00") + strtotime($hora2) - strtotime($hora1) ));
						
						//  $valor_1 = strtotime("$hora_ultima_dosis + $intervalo hours");
						
						//$hora_mas_ultima = date("Y-m-d H:i", $valor_1);
						
						$cantidad_de_horas =  (date("H:i", strtotime("00:00") + strtotime($hora2) - strtotime("$hora_ultima_dosis + $intervalo hours") ));
						
						$time_array = explode(':', $cantidad_de_horas);
						$horas = (int)$time_array[0];
						$minutos = (int)$time_array[1];
						
						
						$total_segundos = ($horas * 3600) + ($minutos * 60);
						
						$average = ceil(($total_segundos/3600) / $intervalo_dosis);
						
						$average2 = $average - 1;
						
						$int_dosis = $intervalo * $average2;
						
						$hora_2 = strtotime("$hora_ultima_dosis + $intervalo hours");
						
						$hora_2_n = date("Y-m-d H:i", $hora_2);
						
						$valor_2 = strtotime("$hora_2_n + $int_dosis hours");
						
						$hora_ultima_dosis_2 = date("Y-m-d H:i", $valor_2);
						
						$precio_venta1 = 0;
						// echo "la cantidad de horas entre el carro es: ".$cantidad_de_horas;
						//  echo "la cantidad de dosis que debo dar es: ".$average;
						//  echo "mi precio unitario es: ".$precio_unitario;
						
						if($tipo_de_dosis == 'M') {
							$precio_venta1 = $precio_unitario * ceil($cantidad) * $average;
							}else{
							$precio_venta1 = $precio_unitario * $cantidad * $average;
						}
						$cantidad_f = $cantidad * $average;
						
						
						
						
						
						//echo "la cantidad x medicamento ".$cantidad_f;
						
						
						//fin de intervalo
						
						//tentativamente eliminado ya que la cantidad de dosis no tiene que ver con la cantidad que entrego
						/*if ($cantidad_f > $cantidad_de_dosis) {
							$cantidad_f = $cantidad_de_dosis;
						} */
						
						/*
							$hi = "update factura_detalle set cantidad = '$cantidad_f' ,precio_venta = '$precio_venta1', precio_unitario = '$precio_unitario', average='$average'  where factura='$factu' and linea = '$lin' ";
							$res = mysql_query($hi, $conn) or die(mysql_error());
							
							
						*/
						//echo "el update: ".$hi;
						
						$precio_total = $precio_total + $precio_venta1;
						
							$ris = cerrar::insert2($factu,$lin, $codigo_carro, $hora_evento_carro, $cantidad_f, $precio_venta1,$precio_unitario,$average, $hora_ultima_dosis_2);
						
			
						
					} } 
					
					
					
					///corte de creacion de factura nueva
					
					$kres =cerrar::select12();
					
					foreach($kres as $krow);
					{
						
						
						/*agrego para que no se duplique la factura 121116*/
						
						$wres = cerrar::select13($factu); 
						
				        foreach($wres as $wrow)
						
						{
							$historia_rep = $wrow->historia;
							$cargo_rep = $wrow->cargo;
							$despacho_rep = $wrow->despacho;
						}
						
						$tres =cerrar::select14($krow->codigo_carro,$historia_rep,$cargo_rep,$despacho_rep);
						
						
						
						
						$tnum =count($tres);
						
						if ($tnum == 0){
							
							
							/*fin de agrego para que no se duplique la factura*/
							
							
							$fact = cerrar::insert3($factu);
							
							//echo "<p>insert factrura nueva ".$d;
							
							//echo $d;
							
							//echo "<p>la factura nueva es: ".$fact;
							
							
							$pres = cerrar::select15($krow->codigo_carro); 
							
							
							foreach($pres as $prow )
							{
								
								
								$rreh =cerrar::insert4($prow->cantidad,$fact,$prow->precio_unitario,$prow->precio_venta,$prow->codigo_carro, $prow->hora_evento_carro,$prow->average,$prow->hora_ultima_dosis,$factu,$prow->linea);
								 
								//echo $h;
								//echo "<p>insert detalle factura ".$h;
								
								
								
							}
							
							$gires =cerrar::select16($fact); 
							
							
							foreach($gires as $girow)
					        {
								
								
								$resi = cerrar::update5($girow->prec,$fact); 
								
							}
							
							
						}
						
					}
			}
			
			
			$res1 = cerrar::select17($carro);
			
			
			foreach($res1 as $rows1 )
	{
				
				$cargo = $rows1->cargo;
				$linea= $rows1->linea;
				$hora_actual = $rows1->hora_evento_carro;
				$factura = $rows1->factura;
				
				
				$intervalo_dosis = $rows1->intervalo_dosis;
				$linea = $rows1->linea;
				/*
					echo "intervalo dosis: ".$intervalo_dosis;
					echo "<p>linea: ".$linea;
					echo "<p>cargo: ".$cargo;
					
					
				echo "la hora actual: ".$hora_actual;*/
				
				$intervalo = (int)$intervalo_dosis;
				
				$valor = strtotime("$hora_actual + $intervalo hours");
				
				$hora_actual_n = date("Y-m-d H:i", $valor);
				
				$rest = cerrar::insert5($hora_actual_n); 
				
				
				$resd = cerrar::select18(); 
				
				foreach($resd as $rowsd )
				 {
					$hora_actual_b = $rowsd->hora_actual;
					
					$respar =cerrar::select19($hora_actual_b); 
					
					
					foreach($respar as $rowspar)
					{ 
						$estado = $rowspar->estado;
						$codigo_carro = $rowspar->codigo_carro;
						$inter2 = $rowspar->intervalo2;
						
						if ($inter2 == $hora_actual_b ) {
							$codigo_carro = $rowspar->codigo_carro + 1;
						}		
						
						if ($estado == 'F') { 
							$codigo_carro = $rowspar->codigo_carro + 1;
						} 
						$resf = cerrar::select20($codigo_carro);
						foreach($resf as $rowf)
						{
						$hora_evento_carro = $rowf->intervalo1;}
						
						$hora_evento_carro = date("Y-m-d H:i",strtotime($hora_evento_carro));
					}
					
					/*	echo "<br>hora evento de carro: ".$hora_evento_carro;
						echo "<br>el carrito en q se va: ".$codigo_carro;  
						echo "<br>el cargo es: ".$cargo;  
					echo "<br>la linea es: ".$linea;  */
				}
				
				$resg = cerrar::delete3(); 
			
				
				
				
				/*
					$o = "update registro_detalle set hora_creacion = '$hora_actual', hora_evento_carro='$hora_evento_carro', codigo_carro = '$codigo_carro', vuelta = 'P' where cargo = '$cargo' and linea = '$linea'";
					
					
				$reso = mysql_query($o, $conn) or die(mysql_error()); */
				
				$resulv = cerrar::update6($codigo_carro,$factura);
				
				
				
				$reso2 =cerrar::insert6($carro,$factura,$linea);
				
				
				/*
					echo "<tr><td>".$rows1['cargo']."</td>";
					echo "<td>".$rows1['medicamento']."</td>";
					echo "<td>".$rows1['cantidad']."</td>";
					echo "<td>".$rows1['no_cama']."</td>";
					echo "<td>".$rows1['historia']."</td>";
					echo "<td>".$rows1['nombre_paciente']."</td>";
					echo "<td>".$rows1['FA']."</td>";
				echo "</tr>";*/
				
				
			}
			
			$res7  =cerrar::select21($carro); 
			
			foreach($res7 as $row7)
			
		     {
				$factu = $row7->factura;
				
				//echo "<p>la factura que proceso es: ".$factu;
				//inserto webservice
				
				
				$yres = cerrar::update7($factu);
				 
				
				
				$rese =cerrar::select22($factu); 
				
				
				
				
				$n = 0;
				foreach($rese as $rowe)
			    {
					$n = $n +1;
					$i = $n;
					$txt = ' ';
					//echo "linea ".$i."</br>";
					$preparacion = $rowe->preparacion;
					
					//anado enviar en el webservice la cantidad filtrada para mixtos.
					if ($rowe['tipo_de_dosis'] == 'M'){
						$cantidad_uni = ceil($rowe->cantidad);
						}else{
						$cantidad_uni = $rowe->cantidad;
					}
					
					if ($preparacion == 'S'){
						$txt = 'PREP-';
					}
					
					
					$historia = $rowe->historia;
					${'cantidad_'.$i} = $cantidad_uni;
					${'precio_'.$i} = $rowe->precio_unitario;
					${'codigo_'.$i} = $rowe->medicamento_id;
					${'descripcion_'.$i} = $txt.$rowe->medicamento;
				}
				//echo "cantidad ".$cantidad_1;
				
				
				if ($i <= 15){
					$d = $i + 1;
					
					
					
					for ($j=$d;$j<=15;$j++) {
						${'cantidad_'.$j} = 0;
						${'precio_'.$j}= 0;
						${'codigo_'.$j} = 0;
						${'descripcion_'.$j} = 0;
					}
					
					
				}
				
				
				
				
				
				$linea = $n;
				
				//echo "la linea es: ".$linea;
				
				require_once('lib/nusoap.php');
				
				$client = new nusoap_client('http://192.168.3.2/wsAppDosis_CMP/wsAppDosis_Transaccional.asmx?WSDL', true);//set your dot net web service url
				
				$err = $client->getError();
				
				if ($err) {
					
					// error if any
					
					echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
					
				}
				
				// Call method
				
				$result = $client->call('Grabar_Cargo', array('Historia' => $historia,
				'Renglones' => $linea,
				'Cantidad_1' => $cantidad_1,
				'Precio_1' => $precio_1,
				'Codigo_1' => $codigo_1,
				'Descripcion_1' => $descripcion_1,
				'Cantidad_2' => $cantidad_2,
				'Precio_2' => $precio_2,
				'Codigo_2' => $codigo_2,
				'Descripcion_2' => $descripcion_2,
				'Cantidad_3' => $cantidad_3,
				'Precio_3' => $precio_3,
				'Codigo_3' => $codigo_3,
				'Descripcion_3' => $descripcion_3,
				'Cantidad_4'=> $cantidad_4,
				'Precio_4' => $precio_4,
				'Codigo_4' => $codigo_4,
				'Descripcion_4' =>$descripcion_4,
				'Cantidad_5' => $cantidad_5,
				'Precio_5' => $precio_5,
				'Codigo_5' => $codigo_5,
				'Descripcion_5' => $descripcion_5,
				'Cantidad_6' => $cantidad_6,
				'Precio_6' => $precio_6,
				'Codigo_6' => $codigo_6,
				'Descripcion_6' =>$descripcion_6,
				'Cantidad_7' => $cantidad_7,
				'Precio_7' => $precio_7,
				'Codigo_7' => $codigo_7,
				'Descripcion_7' => $descripcion_7,
				'Cantidad_8' => $cantidad_8,
				'Precio_8' => $precio_8,
				'Codigo_8' => $codigo_8,
				'Descripcion_8' => $descripcion_8,
				'Cantidad_9' => $cantidad_9,
				'Precio_9' => $precio_9,
				'Codigo_9' => $codigo_9,
				'Descripcion_9' => $descripcion_9,
				'Cantidad_10' => $cantidad_10,
				'Precio_10' => $precio_10,
				'Codigo_10' => $codigo_10,
				'Descripcion_10' => $descripcion_10,
				'Cantidad_11' => $cantidad_11,
				'Precio_11' => $precio_11,
				'Codigo_11' => $codigo_11,
				'Descripcion_11' => $descripcion_11,
				'Cantidad_12' => $cantidad_12,
				'Precio_12' => $precio_12,
				'Codigo_12' => $codigo_12,
				'Descripcion_12' =>$descripcion_12,
				'Cantidad_13' => $cantidad_13,
				'Precio_13' => $precio_13,
				'Codigo_13' => $codigo_13,
				'Descripcion_13' =>$descripcion_13,
				'Cantidad_14' => $cantidad_14,
				'Precio_14' => $precio_14,
				'Codigo_14' => $codigo_14,
				'Descripcion_14' => $descripcion_14,
				'Cantidad_15' => $cantidad_15,
				'Precio_15' => $precio_15,
				'Codigo_15' => $codigo_15,
				'Descripcion_15' => $descripcion_15,
				'UserId' => 'webapp',
				'Session' => '2aa55c55',
				'TransaccionId' => $factu,
				'Ubicacion' => 1,
				'Grupo' => 1
				));
				
				
				// fault if any
				
				if ($client->fault) {
					
					// echo '<h2>Fault</h2><pre>';
					
					//print_r($result);
					
					//echo '</pre>';
					$ret =cerrar::insert7();
					
					} else {
					
					// Check for errors
					
					$err = $client->getError($factu);
					
					if ($err) {
						
						// Display the error
						
						//  echo '<h2>Error</h2><pre>' . $err . '</pre>';
						
						$ret =cerrar::insert8($factu);
						
						} else {
						
						// Display the result
						
						// echo '<h2>Result</h2><pre>';
						//print_r($result);
						
						$i = 0;
						
						$documento = $result['Grabar_CargoResult'];
						
						//$h = "insert into logs_errores (codigo_error, id_interno_fac) values ('$documento', '$factu')";
						
						//$reh = mysql_query($h, $conn) or die(mysql_error());
						
						
						
						
						//echo $documento;
						
						//$doc = substr($documento, 15);
						
						if (is_numeric($documento)){
							$re =cerrar::update8($documento,$factu);
							
							 
							
							//echo "<p><b>Numero de Documento ".$documento."</b>";  
							} else {
							
							$documento_pre = substr($documento,0,2); //letras hasta el -
							
							$documento_pre2 = substr($documento,2,1); //numero de errorantes de FU
							
							//$documento_e = substr($documento, 0, 3); 
							
							$documento_f = substr($documento, 3);
							
							//$documento_g = substr($documento, 0, 2);
							
							if ($documento == 'w-50018'){
								
								$reh = cerrar::insert9($documento,$factu);
								
	
								
								//echo "Ocurrio un error,el cargo se envio incompleto. Por favor ir a la pantalla de 'Reenviar a Hospital' y reenviar el cargo.";
								
							}
							
							if ($documento_pre == 'w-'){
								
								if ($documento_pre2 == '1'){
									
									$re =cerrar::update9($documento_f,$factu); 
									
									
									
									//echo "<p><b>Numero de Documento ".$documento_f."</b>";  
									
									} else {
									
									$reh =cerrar::insert10($documento,$factu);
									
									
									
								}
								
								
								} else if ($documento_pre =='d-' ) {
								$reh =cerrar::insert11($documento,$factu);
								
								
								
								//echo "Ocurrio un error. Por favor ir a la pantalla de 'Reenviar a Hospital' y reenviar el cargo.";
								
								} else {
								
								$reh = cerrar::insert12($documento,$factu); 
								
								
								
								//echo "Ocurrio un error. Por favor ir a la pantalla de 'Reenviar a Hospital' y reenviar el cargo.";
								
							}
							
							
						}
						
						/*
							if ($documento > 0 ) {
							
							
							$r = "update factura set FA='$documento', hora_primer_fa = '".date('Y-m-d H:i',time())."' where factura = '$factu'";
							
							$re = mysql_query($r, $conn) or die(mysql_error());
							
							//echo "<p><b>Numero de Documento ".$documento."</b>";  
							} else {
							$documento_e = substr($documento, 0, 2);
							if ($documento_e == '-3') {
							
							$documento_f = substr($documento, 2);
							
							$r = "update factura set FA='$documento_f', hora_primer_fa = '".date('Y-m-d H:i',time())."' where factura = '$factura'";
							
							$re = mysql_query($r, $conn) or die(mysql_error());
							
							//echo "<p><b>Numero de Documento ".$documento_f."</b>";  
							
							} else{ 
							$h = "insert into logs_errores (codigo_error, id_interno_fac) values ('$documento', '$factura')";
							
							$reh = mysql_query($h, $conn) or die(mysql_error());
							
							//echo "Ocurrio un error. Por favor ir a la pantalla de 'Reenviar a Hospital' y reenviar el cargo.";
							}
						}*/
					} 
					
					
					// echo '</pre>';
					
				}
				
			}
			
			
			
			
			//termino webservice
			
			
			
			
			
			
			
			
			$res4 = cerrar::select23($carro);
			
		
			foreach($res4 as $rows4)
			{
				echo "<tr><td>".$rows4->cargo."</td>";
				echo "<td>".$rows4->medicamento."</td>";
				echo "<td>".$rows4->cantidad."</td>";
				echo "<td>".$rows4->no_cama."</td>";
				echo "<td>".$rows4->historia."</td>";
				echo "<td>".$rows4->nombre_paciente."</td>";
				echo "<td>".$rows4->FA."</td>";
				echo "</tr>";
				
			}
			
			
			
			$lid =cerrar::delete(); 
			
			
			echo "<p></table>";
			
		} 
	?>
	<input type="button" value="Generar MAR" onClick="window.location.href='mar_cierre.php?carro=<?php echo $carro; ?>'" <?php if ($act ==1){ echo " disabled"; } ?> />
	
	<?php
		
		} else {
		header("Location: cierre_carro.php");
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
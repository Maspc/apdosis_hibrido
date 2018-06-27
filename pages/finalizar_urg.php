<?php
	
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/finalizar_urg.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	$factura = $_GET['factura'];
	
	$lres = finalizar_u::select1($factura);
	foreach($lres as $lrow )
	{
		$estado = $lrow->estado_factura;
		$procesado =  $lrow->procesado_por;
	}
	
	
	if($estado == 'E' || $estado == 'R'){
		
		
		//buscar la bodega al cual pertenece
		$gres = finalizar_u::select2($factura); 
		foreach($gres as $grow)
		{
			$bodega = $grow->bodega;
		}
		
		if ($bodega == '' || $bodega == 0){
			$bodega = 1;
		}
		
		$cont3 = 0;
		
		//$s = "update registro set estado = 'F' where historia = '" .$historia . "' and tratamiento = '".$tratamiento."' and cargo = '".$despacho."'";
		
		//$res = mysql_query($s, $conn) or die(mysql_query());
		
		
		//actualizo la factura y el estado lo pongo en E de que ya se envio el pedido
		/*
			$x = "update registro set factura = '$z' where cargo ='".$cargo."'";
		$res8 = mysql_query($x, $conn) or die(mysql_error());*/
		
		$resulta2 = finalizar_u::select3($factura); 
		
		
		
		
		
		$num = count($resulta2);
		
		
		
		$total = 0;
		foreach($resulta2 as $rows2)
		{
			
			$tipo_de_dosis = $rows2->tipo_de_dosis;
			
			//calculoel precio unitario mas el precio de costo de insumo
			
			$cantidad = $rows2->cantidad;
			$grupo_medicamento = $rows2->grupo_medicamento;
			$costo_adicional = $rows2->costo_adicional;
			$costo_adicional_2 = $rows2->costo_adicional_2;
			$impuesto = $rows2->factor;
			$precio_unitario = $rows2->precio_unitario;
			$average = $rows2->average;
			$txt = ' ';
			$linea2 = $rows2->linea;
			$no_paga = $rows2->no_paga;
			$nombre_med = $rows2->medicamento;
			$costo_unitario = $rows2->costo_unitario; //agrego el costo unitario 121116
			$stat_inicio = $rows2->stat_inicio;
			
			if ($rows2->insumo_prep == 'N') {
				
				$medicamento_insumo = $rows2->medicamento_insumo;
				
				if ($tipo_de_dosis == 'M'){
					$precio_unitario_c = $precio_unitario * ceil($cantidad);
					$costo_adicional_c = $costo_adicional * ceil($cantidad);
					//añado cambio de calculo por insumo separado
					
					$impuesto_u = ($precio_unitario) * $impuesto;
					$impuesto_c = ($precio_unitario_c) * $impuesto;
					$precio_venta = $precio_unitario_c + $impuesto_c;	
					
					$cantidad_insumo = ceil($cantidad);
					
					
					} else {
					$precio_unitario_c = $precio_unitario * $cantidad;
					$costo_adicional_c = $costo_adicional *  ceil($cantidad);
					//añado cambio de calculo por insumo separado
					$impuesto_u = ($precio_unitario) * $impuesto;
					$impuesto_c = ($precio_unitario_c) * $impuesto;    
					$precio_venta = $precio_unitario_c + $impuesto_c;
					
					$cantidad_insumo = ceil($cantidad);
				}
				
				
				} else {
				if ($rows2->preparacion == 'S') {
					
					$txt = ' (PREPARACION)';
					
					$medicamento_insumo = $rows2->medicamento_insumo;
					
					if ($tipo_de_dosis == 'M'){
						$precio_unitario_c = $precio_unitario * ceil($cantidad);
						$costo_adicional_c = ($costo_adicional ) * $average;
						//añado cambio de calculo por insumo separado
						$impuesto_u = ($precio_unitario) * $impuesto;
						$impuesto_c = ($precio_unitario_c) * $impuesto;
						$precio_venta = (($precio_unitario) * ceil($cantidad)) + $impuesto_c;
						//$costo_adicional = $costo_adicional_c;
						
						$cantidad_insumo = ceil($average);
						} else {
						$precio_unitario_c = $precio_unitario * $cantidad;
						$costo_adicional_c = ($costo_adicional) * $average;
						//añado cambio de calculo por insumo separado
						$impuesto_u = ($precio_unitario) * $impuesto;
						$impuesto_c = ($precio_unitario_c ) * $impuesto;
						$precio_venta = (($precio_unitario) * ($cantidad)) + $impuesto_c;
						//$costo_adicional = $costo_adicional_c;
						
						$cantidad_insumo = ceil($average);
					}
					
					} else {
					/*Agrego control para grupo im iv*/
					if($grupo_medicamento != 14){
						
						$medicamento_insumo = $rows2->medicamento_insumo_2;
						
						if ($tipo_de_dosis == 'M'){
							$precio_unitario_c = $precio_unitario * ceil($cantidad);
							$costo_adicional_c = ($costo_adicional_2) * $average;
							$costo_adicional = $costo_adicional_2;
							//añado cambio de calculo por insumo separado
							$impuesto_u = ($precio_unitario ) * $impuesto;
							$impuesto_c = ($precio_unitario_c ) * $impuesto;
							$precio_venta = (($precio_unitario ) * ceil($cantidad)) + $impuesto_c;
							//$costo_adicional = $costo_adicional_c;
							
							$cantidad_insumo = ceil($average);
							} else {
							$precio_unitario_c = $precio_unitario * $cantidad;
							$costo_adicional_c = ($costo_adicional_2) * $average;
							$costo_adicional = $costo_adicional_2;
							//añado cambio de calculo por insumo separado
							$impuesto_u = ($precio_unitario ) * $impuesto;
							$impuesto_c = ($precio_unitario_c ) * $impuesto;
							$precio_venta = ($precio_unitario ) + $impuesto_c;
							//$costo_adicional = $costo_adicional_c;
							
							$cantidad_insumo = ceil($average);
						}
						
						} else {
						$no_paga = 1;
						
						if ($tipo_de_dosis == 'M'){
							$precio_unitario_c = $precio_unitario * ceil($cantidad);
							$costo_adicional_c = ($costo_adicional_2) * $average;
							$costo_adicional = $costo_adicional_2;
							//añado cambio de calculo por insumo separado
							$impuesto_u = ($precio_unitario ) * $impuesto;
							$impuesto_c = ($precio_unitario_c ) * $impuesto;
							$precio_venta = (($precio_unitario ) * ceil($cantidad)) + $impuesto_c;
							//$costo_adicional = $costo_adicional_c;
							
							$cantidad_insumo = ceil($average);
							} else {
							$precio_unitario_c = $precio_unitario * $cantidad;
							$costo_adicional_c = ($costo_adicional_2) * $average;
							$costo_adicional = $costo_adicional_2;
							//añado cambio de calculo por insumo separado
							$impuesto_u = ($precio_unitario ) * $impuesto;
							$impuesto_c = ($precio_unitario_c ) * $impuesto;
							$precio_venta = ($precio_unitario ) + $impuesto_c;
							//$costo_adicional = $costo_adicional_c;
							
							$cantidad_insumo = ceil($average);
						}
						
					}
					
				}
			}
			
			
			
			
			if($no_paga != 1){
				
				//agrego insercion de registro de costo de insumo aparte
				$wres = finalizar_u::select4($factura); 
				foreach($wres as $wrow)
				
				{
					$linea_siguiente = $wrow->linea_siguiente;
				}
				
				$rres =finalizar_u::select5($medicamento_insumo);
				foreach($rres as $rrow )
				
				{
					$medicamento_id_ins = $rrow->codigo_interno;
					$medicamento_ins = $rrow->medicamento.'/'.$nombre_med;
				}
				
				
				
				if(($grupo_medicamento == '7') || ($grupo_medicamento == '11')){
					$cantidad_insumo = 1;
				}
				
				$fres =finalizar_u::insert1($medicamento_ins, $medicamento_id_ins, $linea_siguiente, $costo_adicional,$cantidad_insumo,$costo_adicional_c, $factura,$rows2->medicamento_id, $rows2->historia, $rows2->tratamiento, $rows2->cargo, $linea2);
				
				
			}
			
			//termino insercion de insumo
			
			/*
				if ($rows2['insumo_prep'] == 'N') {
				if ($grupo_medicamento == '7' || $grupo_medicamento == '11') { 
				if ($tipo_de_dosis == 'U') { //para fraccionados
				$precio_unitario = $rows2['precio_unitario'];
				$costo_adicional = $rows2['costo_adicional'] * ceil($rows2['cantidad']);
				$precio_venta = ($precio_unitario * $cantidad) + $costo_adicional;
				} else {
				$precio_unitario = $rows2['precio_unitario'] + $rows2['costo_adicional'];
				$costo_adicional = $rows2['costo_adicional'] * ceil($rows2['cantidad']);
				if ($tipo_de_dosis == 'M') {
				$precio_venta = ($rows2['precio_unitario'] * ceil($cantidad)) + $costo_adicional;
				} else {
				$precio_venta = ($rows2['precio_unitario'] * $cantidad) + $costo_adicional ;
				}
				}
				}else{
				$precio_unitario = $rows2['precio_unitario'] + $rows2['costo_adicional'];
				$costo_adicional = $rows2['costo_adicional'] * ceil($rows2['cantidad']);
				if ($tipo_de_dosis == 'M') {
				$precio_venta = ($rows2['precio_unitario'] * ceil($cantidad)) + $costo_adicional;
				} else {
				$precio_venta = ($rows2['precio_unitario'] * $cantidad) + $costo_adicional ;
				}
				
				}
				
				
				} else {
				if ($rows2['preparacion'] == 'S') {
				$precio_unitario = $rows2['precio_unitario'] + $rows2['costo_adicional'];
				$costo_adicional = $rows2['costo_adicional'] * ceil($rows2['cantidad']);
				if ($tipo_de_dosis == 'M') {
				$precio_venta = ($rows2['precio_unitario'] * ceil($cantidad)) + $costo_adicional;
				} else {
				$precio_venta = ($rows2['precio_unitario'] * $cantidad) + $costo_adicional ;
				}
				} else {
				$precio_unitario = $rows2['precio_unitario'] ;
				$precio_venta = $rows2['precio_venta'];
				}
				}
			*/
			
			//fin de calculo de precio unitario
			
			
			$total = $total + $precio_venta + $costo_adicional_c;
			$historia = $rows2->historia;
			$tratamiento = $rows2->tratamiento;
			$despacho= $rows2->cargo;
			$precio_venta = round($precio_venta,2);
			
			$res = finalizar_u::update1($rows2->cantidad, $precio_unitario,$precio_venta,$impuesto_u,$linea2,$costo_unitario,$factura,$rows2->medicamento_id);
			
			
			if ($tipo_de_dosis != 'M') {
				
				$resss = finalizar_u::update2($rows2->cantidad,$rows2->medicamento_id,$bodega);
				
				}else {
				$resss =finalizar_u::update3(ceil($rows2->cantidad),$rows2->medicamento_id,$bodega); 
				
			}
			//esto lo añado cuando tenga llena la tabla de medicamentos x lote
			//$c = "update medicamentos_x_lote set cantidad = cantidad - '".$rows2['cantidad']."' where medicamento_id = '".$rows2['medicamento_id']."' and fecha_vencimiento in (select fecha_vencimiento from medicamentos_x_lote where medicamento_id ='".$medicamento_id."'  order by fecha_vencimiento limit 1 ) ";
			//$cres = mysql_query($c, $conn) or die(mysql_error());
			
			//añado la actualizacion de lotes segun tabla de lotes por factura
			
			$wres = finalizar_u::select6($factura,$rows2->medicamento_id);
			
			foreach($wres as $wrow)
			
			{
				
				
				$cres =finalizar_u::update4($wrow->cantidad,$wrow->medicamento_id,$wrow->lote); 
				
				
				
				
			}
			
			
			//fin de añado la actualizacion de lotes segun tabla de lotes por factura
			
			if($stat_inicio != 'S') {
				
				$ores =finalizar_u::update5($rows2->medicamento_id,$rows2->historia,$rows2->tratamiento,$rows2->cargo); 
				//echo "up ".$o;
				
				
				$gres = finalizar_u::update6($rows2->historia,$rows2->tratamiento,$rows2->cargo); 
				//echo "up ".$o;
				
			}
			
		}
		
		
		
		
		/**añado sumatoria de  precio venta y totales 130518**/
		
		$hores =  finalizar_u::select7($factura);
		
		
		foreach($hores as $horow )
		{
			$total_suma = $horow->total;
		}
		
		/**fin añado sumatario de precio venta y totales 130518**/
		
		
		$Hora = Time(); // Hora actual
		$hora_actual =  date('Y-m-d H:i',$Hora);   
		
		$ref = finalizar_u::update7($hora_actual,$total_suma,$_SESSION->MM_iduser,$factura);
		
		
		//echo $f;
		
		$rres = finalizar_u::delete1($factura);
		
		
		
		echo "<p>Total de la factura: ".$total_suma."<p>";
		
		
		$rese = finalizar_u::select8($factura);
		
		
		foreach($rese as $rowe)
		
		
		{
			$n = $n +1;
			$i = $n;
			//echo "linea ".$i."</br>";
			//anado enviar en el webservice la cantidad filtrada para mixtos.
			if ($rowe->tipo_de_dosis == 'M'){
				$cantidad_uni = ceil($rowe->cantidad);
				}else{
				$cantidad_uni = $rowe->cantidad;
			}
			
			
			$historia = $rowe->historia;
			${'cantidad_'.$i} = $cantidad_uni;
			${'precio_'.$i} = $rowe->precio_unitario;
			${'codigo_'.$i} = $rowe->medicamento_id;
			${'descripcion_'.$i} = $rowe->medicamento;
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
		'TransaccionId' => $factura,
		'Ubicacion' => 1,
		'Grupo' => 1
		));
		
		
		// fault if any
		
		if ($client->fault) {
			
			echo '<h2>Fault</h2><pre>';
			
			print_r($result);
			
			echo '</pre>';
			
			} else {
			
			// Check for errors
			
			$err = $client->getError();
			
			if ($err) {
				
				// Display the error 
				
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
				
				} else {
				
				// Display the result
				
				// echo '<h2>Result</h2><pre>';
				//print_r($result);
				
				$i = 0;
				
				$documento = $result['Grabar_CargoResult'];
				
				//cambio de control de errores
				
				if (is_numeric($documento)){
					$re =finalizar_u::update8($documento,$factura); 
					
					
					
					echo "<p><b>Numero de Documento ".$documento."</b>";  
					} else {
					
					$documento_pre = substr($documento,0,2); //letras hasta el -
					
					$documento_pre2 = substr($documento,2,1); //numero de errorantes de FU
					
					//$documento_e = substr($documento, 0, 3); 
					
					$documento_f = substr($documento, 3);
					
					if ($documento == 'w-50018'){
						
						$reh =finalizar_u::insert2($documento_f,$factura);
						
						
						
						echo "Ocurrio un error,el cargo se envio incompleto. Por favor ir a la pantalla de 'Reenviar a Hospital' y reenviar el cargo.";
						
					}
					
					//$documento_g = substr($documento, 0, 2);
					
					if ($documento_pre == 'w-'){
						
						if ($documento_pre2 == '1'){
							
							$re =finalizar_u::update9($documento_f,$factura);
							
							
							
							echo "<p><b>Numero de Documento ".$documento_f."</b>";  
							
						} 
						
						
						
						
						
						
						} else if ($documento_pre =='d-' ) {
						$reh = finalizar_u::insert2($documento_f,$factura);
						
						
						
						echo "Ocurrio un error. Por favor ir a la pantalla de 'Reenviar a Hospital' y reenviar el cargo.";
						
					}
					
					
				}
				
				// echo $documento;
				
				//$doc = substr($documento, 15);
				
				
				/*
					
					if ($documento > 0) {
					$r = "update factura set FA='$documento', estado_envio = 'S', hora_primer_fa = '".date('Y-m-d H:i',time())."' where factura = '$factura'";
					
					$re = mysql_query($r, $conn) or die(mysql_error());
					
					echo "<p><b>Numero de Documento ".$documento."</b>";  
					
					} else {
					
					$documento_e = substr($documento, 0, 2);
					if ($documento_e == '-3') {
					
					$documento_f = substr($documento, 2);
					
					$r = "update factura set FA='$documento_f', estado_envio = 'S', hora_primer_fa = '".date('Y-m-d H:i',time())."' where factura = '$factura'";
					
					$re = mysql_query($r, $conn) or die(mysql_error());
					
					echo "<p><b>Numero de Documento ".$documento_f."</b>";  
					
					} else{ 
					$h = "insert into logs_errores (codigo_error, id_interno_fac) values ('$documento', '$factura')";
					
					$reh = mysql_query($h, $conn) or die(mysql_error());
					
					echo "Ocurrio un error. Por favor ir a la pantalla de 'Reenviar a Hospital' y reenviar el cargo.";
					}
					
				} */
			} 
			
			
			// echo '</pre>';
			
			
		}
		
		
		
		
		
		
		
		$resulta9 =finalizar_u::select9($factura);  
		
		
		foreach($resulta9 as $row9 )
		
		{
			echo "<p>En este cargo se interrumpi&oacute; el medicamento: ".$row9->medicamento;
		}
		
		
		} else if ($estado == 'F') {
		
		echo "<h2>Este cargo ya fue finalizado por ".$procesado." !!!</h2>";
		
		} else if ($estado == 'X') {
		
		echo "<h2>Este cargo fue interrumpido!!!</h2>";
		
	} 
	
	
	
?>
<html><head><title>Finalizado</title><style>.red {
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
<h1>CARGO FINALIZADO</h1><p><input type="button" name="cerrar" value="Cerrar Ventana" onClick="window.close();" class="green"/>
	<?=layout::fin_content()?>

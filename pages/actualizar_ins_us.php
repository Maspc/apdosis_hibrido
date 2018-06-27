<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/actualizar_ins_us.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	echo "<body onunload=\"opener.location=('editar_insumo_us.php')\">";
	echo "<font face='Arial, Helvetica, sans-serif' size='+1'>";
	
	if (isset($_POST['medicamento_id'])){
		$medicamento_id = $_POST['medicamento_id'];
	}
	if  (isset($_POST['forma_farmaceutica'])){
		$forma_farma = $_POST['forma_farmaceutica'];
	} $forma_farma = '192';
	if  (isset($_POST['precio_unitario'])){
		$precio_unitario = $_POST['precio_unitario'];
		} else {
		$precio_unitario = 0;
	}
	
	if  (isset($_POST['tipo_posologia'])){
		$tipo_posologia = $_POST['tipo_posologia'];
		
		} else {
		$tipo_posologia= 8;
	}
	if  (isset($_POST['tipo_de_dosis'])){
		$tipo_de_dosis = $_POST['tipo_de_dosis'];
		}  else {
		$tipo_de_dosis = 'N';
	}
	if  (isset($_POST['posologia'])){
		$posologia = $_POST['posologia'];
		}  else {
		$posologia = ' ';
	}
	if  (isset($_POST['codigo_barras'])){
		$codigo_barras = $_POST['codigo_barras'];
	}
	if  (isset($_POST['nombre_comercial'])){
		$nombre_comercial = $_POST['nombre_comercial'];
		}  else {
		$nombre_comercial = ' ';
	}
	if  (isset($_POST['nombre_generico'])){
		$nombre_generico = $_POST['nombre_generico'];
		}  else {
		$nombre_generico = ' ';
	}
	if  (isset($_POST['presentacion'])){
		$presentacion = $_POST['presentacion'];
		}  else {
		$presentacion = 1;
	}
	if  (isset($_POST['cantidad_x_empaque'])){
		$cantidad_x_empaque = $_POST['cantidad_x_empaque'];
		}  else {
		$cantidad_x_empaque = 0;
	}
	if  (isset($_POST['volumen'])){
		$volumen = $_POST['volumen'];
		}  else {
		$volumen = 0;
	}
	if  (isset($_POST['fabricante'])){
		$fabricante = $_POST['fabricante'];
		} else {
		$fabricante = 1;
	}
	if  (isset($_POST['costo_unitario'])){
		$costo_unitario = $_POST['costo_unitario'];
		}  else {
		$costo_unitario = 0;
	}
	if  (isset($_POST['costo_caja'])){
		$costo_caja = $_POST['costo_caja'];
		}  else {
		$costo_caja = 0;
	}
	if  (isset($_POST['precio_caja'])){
		$precio_caja = $_POST['precio_caja'];
		}  else {
		$precio_caja = 0;
	}
	if  (isset($_POST['cantidad_inicial'])){
		$cantidad_inicial = $_POST['cantidad_inicial'];
		}  else {
		$cantidad_inicial = 0;
	}
	if  (isset($_POST['antibiotico'])){
		$antibiotico = $_POST['antibiotico'];
		}  else {
		$antibiotico = 'N';
	}
	if  (isset($_POST['multiple_principio'])){
		$multiple_principio = $_POST['multiple_principio'];
		}  else {
		$multiple_principio = 'N';
	}
	if  (isset($_POST['narcotico'])){
		$narcotico = $_POST['narcotico'];
		}  else {
		$narcotico = 'N';
	}
	if  (isset($_POST['preparacion'])){
		$preparacion = $_POST['preparacion'];
		}  else {
		$preparacion = 'N';
	}
	if  (isset($_POST['devolucion'])){
		$devolucion = $_POST['devolucion'];
		}  else {
		$devolucion = 'N';
	}
	
	
	if  (isset($_POST['codigo_proveedor'])){
		$codigo_proveedor = $_POST['codigo_proveedor'];
		}  else {
		$codigo_proveedor = ' ';
	}
	
	if  (isset($_POST['tipo_volumen'])){
		$tipo_volumen = $_POST['tipo_volumen'];
		}  else {
		$tipo_volumen = ' ';
	}
	
	if  (isset($_POST['grupo_medicamento'])){
		$grupo_medicamento = $_POST['grupo_medicamento'];
		}  else {
		$grupo_medicamento = 12;
	}
	
	if  (isset($_POST['tipo_impuesto'])){
		$tipo_impuesto = $_POST['tipo_impuesto'];
		}  else {
		$tipo_impuesto = 1;
	}
	
	if  (isset($_POST['sub_grupo'])){
		$sub_grupo = $_POST['sub_grupo'];
		}  else {
		$sub_grupo = 1;
	}
	
	if  (isset($_POST['jubilado'])){
		$jubilado = $_POST['jubilado'];
		}  else {
		$jubilado = 'N';
	}
	
	
	if  (isset($_POST['descuento_total'])){
		$descuento_total = $_POST['descuento_total'];
		}  else {
		$descuento_total = 'N';
	}
	
	if  (isset($_POST['cant_max_prov'])){
		$cant_max_prov = $_POST['cant_max_prov'];
		}  else {
		$cant_max_prov = '0';
	}
	
	if  (isset($_POST['prod_hosp'])){
		$prod_hosp = $_POST['prod_hosp'];
		}  else {
		$prod_hosp = 'N';
	}
	
	if  (isset($_POST['prod_pub'])){
		$prod_pub = $_POST['prod_pub'];
		}  else {
		$prod_pub = 'N';
	}
	
	/*  echo '<p>antibiotico: '.$antibiotico;
		echo '<p>narcotico: '.$narcotico;
		echo '<p>preparacion: '.$preparacion;
		echo '<p>devolucion: '.$devolucion;
	echo '<p>medicamento id: '.$medicamento_id;*/
	actins::update1($codigo_barras,$nombre_comercial,$nombre_generico,$presentacion,$cantidad_x_empaque,$volumen,$costo_unitario,$costo_caja,$precio_caja,$cantidad_inicial,$antibiotico,$narcotico,$preparacion,$devolucion,$codigo_proveedor,$grupo_medicamento,$multiple_principio,$tipo_impuesto,$sub_grupo,$jubilado,$descuento_total,$cant_max_prov,$prod_hosp,$prod_pub,$medicamento_id);
	//  echo $sql;
	
	/*
		$sql1 = "update medicamentos_x_bodega set cantidad_inicial = '$cantidad_inicial' where medicamento_id = '$medicamento_id' and bodega = '1'";
		$res1 = mysql_query($sql1, $conn) or die(mysql_error());
	*/
	
	$resd = actins::select1($anaquel,$conteo);

	foreach($resd as $row){
		$desc_forma = $row->descripcion;
	}
	
	
	/**webservice para actuliazacion de medicamentos*/
	
	/*	  
		require_once('lib/nusoap.php');
		
		$client = new nusoap_client('http://192.168.3.2/wsKiosko_CMP/wsKiosko.asmx?WSDL', true);//set your dot net web service url
		
		$err = $client->getError();
		
		if ($err) {
		
		// error if any
		
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		
		}
		
		// Call method
		
		$result = $client->call('Integracion_FarHipoMedi', array('Codigo' => $codigo_barras,
		'Descripcion' => $nombre_comercial,
		'Precio' => $precio_unitario,
		'Unidad' => $desc_forma,
		'User' => '1234',
		'System' => 'Apdosis',
		'Accion' => 'Update',
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
		
		//echo '<h2>Result</h2><pre>';
		//print_r($result);
		echo "Fue actualizado el precio del medicamento.";
		
		
		// echo $documento;
		
		
		
		} 
		
		
		echo '</pre>';
		
		}
		
	*/
	echo "Se actualiz&oacute; exit&oacute;samente el insumo";
	echo "<p><a href=\"JavaScript:window.close()\">Volver</a> "
	
	layout::fin_content();	  
?>
<script type="text/javascript">
	{
		if(history.forward(1))
		location.replace(history.forward(1))
	}
</script>
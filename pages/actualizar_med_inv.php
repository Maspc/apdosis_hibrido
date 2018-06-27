<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/actualizar_med_inv.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	echo "<body onunload=\"opener.location=('editar_medicamentos_inv.php')\">";
	echo "<font face='Arial, Helvetica, sans-serif' size='+1'>";
	
	if (isset($_POST['medicamento_id'])){
		$medicamento_id = $_POST['medicamento_id'];
	}
	if(isset($_POST['medicamento_id'])){
	$medicamento_id = $_POST['medicamento_id'];}
	
	if(isset($_POST['inventario_minimo'])){
		$inventario_minimo = $_POST['inventario_minimo'];
		}else{
		$inventario_minimo = 0;
	}
	
	if(isset($_POST['inventario_maximo'])){
		$inventario_maximo = $_POST['inventario_maximo'];
		}else{
		$inventario_maximo = 0;
	}
	
	if(isset($_POST['inventario_ideal'])){
		$inventario_ideal = $_POST['inventario_ideal'];
		}else{
		$inventario_ideal = 0;
	}
	
	if(isset($_POST['inventario_critico'])){
		$inventario_critico = $_POST['inventario_critico'];
		}else{
		$inventario_critico = 0;
	}
	
	if(isset($_POST['inventario_critico'])){
		$cantidad_inicial = $_POST['cantidad_inicial'];
		}else{
		$cantidad_inicial = 0;
	}
	
	if(isset($_POST['cantidad_factura'])){
		$cantidad_factura = $_POST['cantidad_factura'];
		}else{
		$cantidad_factura = 0;
	}
	
	if(isset($_POST['cantidad_devolucion'])){			  
		$cantidad_devolucion = $_POST['cantidad_devolucion'];
		}else{
		$cantidad_devolucion = 0;
	}
	
	if(isset($_POST['costo_unitario'])){	
		$costo_unitario = $_POST['costo_unitario'];
		}else{
		$costo_unitario = 0;
	}
	
	if(isset($_POST['precio_unitario'])){
		$precio_unitario = $_POST['precio_unitario'];
		}else{
		$precio_unitario = 0;
	}
	
	if(isset($_POST['porcentaje_ganancia'])){			  
		$porcentaje_ganancia = $_POST['porcentaje_ganancia'];
		}else{
		$porcentaje_ganancia = 50;
	}
	
	if(isset($_POST['precio_unitario_pub'])){
		$precio_unitario_pub = $_POST['precio_unitario_pub'];
		}else{
		$precio_unitario_pub = 0;
	}
	
	/*  echo '<p>antibiotico: '.$antibiotico;
		echo '<p>narcotico: '.$narcotico;
		echo '<p>preparacion: '.$preparacion;
		echo '<p>devolucion: '.$devolucion;
	echo '<p>medicamento id: '.$medicamento_id;*/
	
	$hora_actual = date("Y-m-d H:i",time());
	
	amedinv::update1($inventario_minimo,$inventario_maximo,$inventario_ideal,$inventario_critico,$cantidad_inicial,$cantidad_factura,$cantidad_devolucion,$_SESSION['MM_iduser'],$hora_actual,$medicamento_id);
	
	$precio = ($costo_unitario * ($porcentaje_ganancia/100)) + $costo_unitario;
	
	amedinv::update2($costo_unitario,$porcentaje_ganancia,$_SESSION['MM_iduser'],$hora_actual,$medicamento_id);
	
	amedinv::insert1($medicamento_id,$hora_actual,$_SESSION['MM_iduser'],$costo_unitario);
	
	//se añade cambio de precio cuando es cero para los que tienen acceso
	
	$precio_cero = 0;
	
	$peres = amedinv::select1($medicamento_id);
	
	foreach($peres as $perow){
		$precio_cero = $perow->precio_unitario;
	}
	
	// if($precio_cero == 0){
		
	amedinv::insert2($medicamento_id,$hora_actual,$_SESSION['MM_iduser'],$precio_unitario);
	// } else {
	
	
	//if ($_SESSION['MM_iduser'] == 'admin'){
	// $sql3 = "update medicamentos set precio_unitario='$precio_unitario', usuario_modificacion='".$_SESSION['MM_iduser']."', fecha_modificacion='$hora_actual' where codigo_interno = '$medicamento_id' "; 
	
	//  $res3 = mysql_query($sql3, $conn) or die(mysql_error());
	
	//  $hi = "insert into auditoria_med (medicamento_id, fecha, usuario, transaccion, precio) values ('".$medicamento_id."', '$hora_actual', '".$_SESSION['MM_iduser']."', 'UPDATEPRECIO1', '$precio_unitario')";
	
	//$hires = mysql_query($hi,$conn) or die(mysql_error());
	
	//	 } }
	
	//precio_unitario = '$precio_unitario',
	
	
	echo "Se actualiz&oacute; exit&oacute;samente el medicamento";
	echo "<p><a href=\"JavaScript:window.close()\">Volver</a>";
	
	layout::fin_content();
?>
</font>
</body>
</html>
<script type="text/javascript">
	{
		if(history.forward(1))
		location.replace(history.forward(1))
	}
	</script>	
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/buscar_facturas_aseg.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	layout::menu();
	layout::ini_content();
	
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	
	$CantidadMostrar = 100;
	$factura = 0;
	$fecha_inicio = 0;
	$fecha_fin = 0;
	
	if(isset($_POST['factura']) && $_POST['factura']!="")
	{
		$where[] = "a.factura = '".$_POST['factura']."'";
		$factura = $_POST['factura'];
	}
	if(isset($_POST['fecha_inicio']) && $_POST['fecha_inicio']!="")
	{
		$where[] = "a.fecha between '".$_POST['fecha_inicio']."' and '".$_POST['fecha_fin']."'";
		//$where2[] = "a.fecha_creacion between '".$_POST['fecha_inicio']."' and '".$_POST['fecha_fin']."'";
		$fecha_inicio = $_POST['fecha_inicio'];
		$fecha_fin = $_POST['fecha_fin'];
	}
	if(isset($_POST['aseguradora']) && $_POST['aseguradora']!="") {
		if ($_POST['aseguradora'] == '%'){
			$where[] = " a.publico = 'S' and a.descuento_total > 0 and a.codigo_aseguradora != 0";
			//$where2[] = " (a.publico != 'S' or b.codigo_cliente in (5,71))";
			$aseguradora = $_POST['aseguradora'];
			
			} else {
			$where[] = " a.publico = 'S' and a.descuento_total > 0 and a.codigo_aseguradora = ".$_POST['aseguradora']."";
			//$where2[] = " (a.publico != 'S' or b.codigo_cliente in (5,71))";
			$aseguradora = $_POST['aseguradora'];
		}
	}
	
	
	if(isset($_GET['aseguradora']) && $_GET['aseguradora']!="") {
		if ($_GET['aseguradora'] == '%'){
			$where[] = " a.publico = 'S' and a.descuento_total > 0 and a.codigo_aseguradora != 0";
			//$where2[] = " (a.publico != 'S' or b.codigo_cliente in (5,71))";
			$aseguradora = $_GET['aseguradora'];
			
			} else {
			$where[] = " a.publico = 'S' and a.descuento_total > 0 and a.codigo_aseguradora = ".$_GET['aseguradora']."";
			//$where2[] = " (a.publico != 'S' or b.codigo_cliente in (5,71))";
			$aseguradora = $_GET['aseguradora'];
		}
	}
	
	if(isset($_GET['factura']) && $_GET['factura']!="")
	{
		$where[] = "a.factura = '".$_GET['factura']."'";
		$factura = $_GET['factura'];
	}
	if(isset($_GET['fecha_inicio']) && $_GET['fecha_inicio']!="")
	{
		$where[] = "a.fecha between '".$_GET['fecha_inicio']."' and '".$_GET['fecha_fin']."'";
		//$where2[] = "a.fecha_creacion between '".$_GET['fecha_inicio']."' and '".$_GET['fecha_fin']."'";
		$fecha_inicio = $_GET['fecha_inicio'];
		$fecha_fin = $_GET['fecha_fin'];
	}
	
	$fecha_inicio_p = strtotime($fecha_inicio);
	
	$fecha_fin_p = strtotime($fecha_fin);
	
	$diff = $fecha_fin_p- $fecha_inicio_p;
	
	$dias = round($diff / 86400);
	
	
	$compag   =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
	
	
	
	$kires = buscarfa::select1($where);
	
	
	$TotalRegistro = count($kires);
	
	
	
	//echo "total registro:".$TotalRegistro;
		
	
	//echo "ko: ".$ko;
	
	$koires = buscarfa::select2($where2);
	foreach($koires as $koirow){
		$total_suma = $koirow->total;		
	}
	

	//echo "ko: ".$ko;
	
	$kores = buscarfa::select3($where,$compag,$CantidadMostrar);
	
	if ($factura == 0) {
		echo "<center><h3>Movimientos de Aseguradoras desde el ".$fecha_inicio." hasta el ".$fecha_fin."</h3></center>";
		} else {
		echo "<center><h3>Factura No. ".$factura."</h3></center>";
	}
	
	if($aseguradora == '%'){
		echo "<center><h3>Todos las Movimientos</h3></center>";
		} else {
		echo "<center><h3>Movimientos P&uacute;blico</h3></center>";
	}
	
	echo "<center><h3>N&uacute;mero de Movimientos: ".$TotalRegistro."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto: B/. ".$total_suma."</h3></center>";
	
	echo "<p><center><h3>Promedio de Movimientos: B/.".round(($total_suma/$dias),2)." al d&iacute;a</h3></center>";
	
	
	
	echo "<p><center><input type='button' name='reimprimir' value='Reporte de Ventas' onClick=\"window.open('imprimir_venta_aseg_xls.php?fecha1=".$fecha_inicio."&fecha2=".$fecha_fin."','mywindow','width=1250,height=750,toolbar=yes, scrollbars=yes');\"'></center><p>";
	
	
	echo "<center><table border='1' cellpadding='1'>
	<tr><th>No. Interno</th>
	<th>Nombre Cliente</th>
	<th>Fecha</th>
	<th>C&eacute;dula o RUC </th>
	<th>Total</th>
	<th>Total Descuento</th>
	<th>Equipo Fiscal</th>
	<th>Factura Fiscal</th>
	<th>Aseguradora</th></tr>";
	
	foreach($kores as $korow){
		
		if($korow->estado_factura == 'I'){
			$imp = 'IMPRESA';
			$color = 'green';} else{
			$imp = 'NO IMPRESA';
			$color= 'red';
		}
		
		echo "<tr><td>".$korow->factura."</td>
		<td>".$korow->nombre_cliente."</td>
		<td>".$korow->fecha."</td>
		<td>".$korow->id_paciente."</td>
		<td>".$korow->total."</td>
		<td>".$korow->descuento_total."</td>
		<td>".$korow->equipo_fiscal."</td>
		<td>".$korow->factura_fiscal."</td>
		<td>".$korow->descripcion."</td>
		<td><input type='button' name='reimprimir' value='Ver Detalle' onClick=\"window.open('ver_detalle_factura.php?no_factura=".$korow->factura."','mywindow','width=1250,height=750,toolbar=yes, scrollbars=yes'); \"'> </td></tr>";
    	
	}
	
	echo "</table></center><p><p>";
	
	
	/*Sector de Paginacion */
    
    //Operacion matematica para botón siguiente y atrás 
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
  	$DecrementNum =(($compag -1))<1?1:($compag -1);
	
	if($factura == 0){
		echo "<a href=\"?pag=".$DecrementNum."&fecha_inicio=".$fecha_inicio."&fecha_fin=".$fecha_fin."&aseguradora=".$aseguradora."\">?</a>&nbsp;";
		} else {
		echo "<a href=\"?pag=".$DecrementNum."&factura=".$factura."&aseguradora=".$aseguradora."\">?</a>&nbsp;"; 
	}
	
	if ($DecrementNum % 50 == 0 ) {
		echo "</br>";
	}
	
    //Se resta y suma con el numero de pag actual con el cantidad de 
    //números  a mostrar
	$Desde=$compag-(ceil($CantidadMostrar/2)-1);
	$Hasta=$compag+(ceil($CantidadMostrar/2)-1);
	
	//Se valida
	$Desde=($Desde<1)?1: $Desde;
	$Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
	
	
	
	//Se muestra los números de paginas
	for($i=$Desde; $i<=$Hasta;$i++){
     	//Se valida la paginacion total
     	//de registros
     	if($i<=($TotalRegistro/$CantidadMostrar)){
     		//Validamos la pag activo
			if($i==$compag){
				if($factura == 0){
					echo "<a href=\"?pag=".$i."&fecha_inicio=".$fecha_inicio."&fecha_fin=".$fecha_fin."&aseguradora=".$aseguradora."\">".$i."</a>&nbsp;";
					if ($i % 50 == 0 ) {
						echo "</br>";
					}
					} else {
					echo "<a href=\"?pag=".$i."&factura=".$factura."&aseguradora=".$aseguradora."\">".$i."</a>&nbsp;"; 
					if ($i % 50 == 0 ) {
						echo "</br>";
					}
				}
				}else {
				if($factura == 0){
					echo "<a href=\"?pag=".$i."&fecha_inicio=".$fecha_inicio."&fecha_fin=".$fecha_fin."&aseguradora=".$aseguradora."\">".$i."</a>&nbsp;";
					if ($i % 50 == 0 ) {
						echo "</br>";
					}
					} else {
					echo "<a href=\"?pag=".$i."&factura=".$factura."&aseguradora=".$aseguradora."\">".$i."</a>&nbsp;"; 
					if ($i % 50 == 0 ) {
						echo "</br>";
					}
				}
			}     		
		}
	}
	
	if($factura == 0){
		echo "<a href=\"?pag=".$IncrimentNum."&fecha_inicio=".$fecha_inicio."&fecha_fin=".$fecha_fin."&aseguradora=".$aseguradora."\">?</a>";
		if ($IncrimentNum % 50 == 0 ) {
			echo "</br>";
		}
		} else {
		echo "<a href=\"?pag=".$IncrimentNum."&factura=".$factura."&aseguradora=".$aseguradora."\">?</a>"; 
		if ($IncrimentNum % 50 == 0 ) {
			echo "</br>";
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
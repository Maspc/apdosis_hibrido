<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/buscar_compras.php');
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
		$where[] = "date(a.fecha_proceso) between '".$_POST['fecha_inicio']."' and '".$_POST['fecha_fin']."'";
		$fecha_inicio = $_POST['fecha_inicio'];
		$fecha_fin = $_POST['fecha_fin'];
	}
	
	
	if(isset($_GET['factura']) && $_GET['factura']!="")
	{
		$where[] = "a.factura = '".$_GET['factura']."'";
		$factura = $_GET['factura'];
	}
	if(isset($_GET['fecha_inicio']) && $_GET['fecha_inicio']!="")
	{
		$where[] = "date(a.fecha_proceso) between '".$_GET['fecha_inicio']."' and '".$_GET['fecha_fin']."'";
		$fecha_inicio = $_GET['fecha_inicio'];
		$fecha_fin = $_GET['fecha_fin'];
	}
	
	$fecha_inicio_p = strtotime($fecha_inicio);
	
	$fecha_fin_p = strtotime($fecha_fin);
	
	$diff = $fecha_fin_p- $fecha_inicio_p;
	
	$dias = round($diff / 86400);
	
	
	$compag   =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
	
	$kires = buscarc::select1($where);
	
	$TotalRegistro = count($kires);
	
		
	//echo "total registro:".$TotalRegistro;
	$koires = buscarc::select2($where);
	//echo "ko: ".$ko;
	
	foreach($koires as $koirow){
		$total_suma_fact = $koirow->total;		
	}
	
	
	
	$total_suma = $total_suma_fact;
	
	
	$koires = buscarc::select3($where);
	//echo "ko: ".$ko;
	
	foreach($koires as $koirow){
		$total_suma_us = $koirow->total;		
	}
	
	
	
	
	
	//sumo impuestos
	
	$koi4res = buscarc::select4($where);
	
	foreach($koi4res as $koi4row){
		$total_impuesto_fact = $koi4row->total;		
	}
	
	
	
	$total_impuesto = $total_impuesto_fact;
	
	
	/*	$ko = "select a.factura, a.fecha, a.nombre_cliente, a.id_paciente, round(a.total,2) as total, a.estado_factura, a.caja_id, a.equipo_fiscal, a.factura_fiscal from factura a where a.estado_factura in ('I') and ".implode(" and ", $where)." order by a.fecha desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;*/

	$kores = buscarc::select5($where,$compag,$CantidadMostrar);
	//echo "ko: ".$ko;
	
	
	if ($factura == 0) {
		echo "<center><h3>Movimientos de Compra desde el ".$fecha_inicio." hasta el ".$fecha_fin."</h3></center>";
		} else {
		echo "<center><h3>Factura No. ".$factura."</h3></center>";
	}
	
	
	echo "<center><h3>N&uacute;mero de Movimientos: ".$TotalRegistro."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto a Otros Proveedores: B/. ".$total_suma."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto a USPSG: B/. ".$total_suma_us."</h3></center></h3></center>";
	
	echo "<p><center><h3>Promedio de Movimientos: B/.".round(($total_suma/$dias),2)." al d&iacute;a</h3></center>";
	
	echo "<p><center><h3>Total de Impuestos: B/.".round($total_impuesto,2)."</h3></center>";
	
	
	echo "<p><center><input type='button' name='reimprimir' value='Reporte de Compras' onClick=\"window.open('imprimir_compra_comp_xls.php?fecha1=".$fecha_inicio."&fecha2=".$fecha_fin."','mywindow','width=1250,height=750,toolbar=yes, scrollbars=yes');\"'></center><p>";
	
	
	
	echo "<center><table border='1' cellpadding='1'>
	<tr><th>No. Interno</th>
	<th>Nombre Proveedor</th>
	<th>Nombre Producto</th>
	<th>Fecha</th>
	<th>Impuesto Total</th>
	<th>Costo Total</th>
	</tr>";
	
	foreach($kores as $korow){
		echo "<tr><td>".$korow->id_compra."</td>
		<td>".$korow->nombre."</td>
		<td>".$korow->nombre_producto."</td>
		<td>".$korow->fecha_proceso."</td>
		<td>".$korow->impuesto_total."</td>
		<td>".$korow->total."</td></tr>";    	
	}
	
	echo "</table></center><p><p>";
	
	
	/*Sector de Paginacion */
    
    //Operacion matematica para botón siguiente y atrás 
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
  	$DecrementNum =(($compag -1))<1?1:($compag -1);
	
	if($factura == 0){
		echo "<a href=\"?pag=".$DecrementNum."&fecha_inicio=".$fecha_inicio."&fecha_fin=".$fecha_fin."\">?</a>&nbsp;";
		} else {
		echo "<a href=\"?pag=".$DecrementNum."&factura=".$factura."\">?</a>&nbsp;"; 
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
					echo "<a href=\"?pag=".$i."&fecha_inicio=".$fecha_inicio."&fecha_fin=".$fecha_fin."\">".$i."</a>&nbsp;";
					if ($i % 50 == 0 ) {
						echo "</br>";
					}
					} else {
					echo "<a href=\"?pag=".$i."&factura=".$factura."\">".$i."</a>&nbsp;"; 
					if ($i % 50 == 0 ) {
						echo "</br>";
					}
				}
				}else {
				if($factura == 0){
					echo "<a href=\"?pag=".$i."&fecha_inicio=".$fecha_inicio."&fecha_fin=".$fecha_fin."\">".$i."</a>&nbsp;";
					if ($i % 50 == 0 ) {
						echo "</br>";
					}
					} else {
					echo "<a href=\"?pag=".$i."&factura=".$factura."\">".$i."</a>&nbsp;"; 
					if ($i % 50 == 0 ) {
						echo "</br>";
					}
				}
			}     		
		}
	}
	
	if($factura == 0){
		echo "<a href=\"?pag=".$IncrimentNum."&fecha_inicio=".$fecha_inicio."&fecha_fin=".$fecha_fin."\">?</a>";
		if ($IncrimentNum % 50 == 0 ) {
			echo "</br>";
		}
		} else {
		echo "<a href=\"?pag=".$IncrimentNum."&factura=".$factura."\">?</a>"; 
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
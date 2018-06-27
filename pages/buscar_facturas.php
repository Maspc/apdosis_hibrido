<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/buscar_facturas.php');
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
		$where[] = "date(a.fecha) between '".$_POST['fecha_inicio']."' and '".$_POST['fecha_fin']."'";
		$where2[] = "date(a.fecha_creacion) between '".$_POST['fecha_inicio']."' and '".$_POST['fecha_fin']."'";
		$fecha_inicio = $_POST['fecha_inicio'];
		$fecha_fin = $_POST['fecha_fin'];
	}
	if(isset($_POST['tipo']) && $_POST['tipo']!="") {
		if ($_POST['tipo'] == 2){
			$where[] = " (a.publico != 'S' or a.codigo_cliente in (5,71))";
			$where2[] = " (a.publico != 'S' or b.codigo_cliente in (5,71))";
			$tipo = $_POST['tipo'];
			
			} else if ($_POST['tipo'] == 3) {
			$where[] = "a.publico = 'S' and a.codigo_cliente not in (5,71)";
			$where2[] = "a.publico = 'S' and b.codigo_cliente not in (5,71)";
			$tipo = $_POST['tipo'];
			} else {
			$tipo = 1;
		}
	}
	
	
	
	
	
	if(isset($_GET['tipo']) && $_GET['tipo']!="") {
		if ($_GET['tipo'] == 2){
			$where[] = " (a.publico != 'S' or a.codigo_cliente in (5,71))";
			$where2[] = " (a.publico != 'S' or b.codigo_cliente in (5,71))";
			$tipo = $_GET['tipo'];
			
			} else if ($_GET['tipo'] == 3) {
			$where[] = "a.publico = 'S' and a.codigo_cliente not in (5,71)";
			$where2[] = "a.publico = 'S' and b.codigo_cliente not in (5,71)";
			$tipo = $_GET['tipo'];
			}  else {
			$tipo = 1;
		}
	}
	
	if(isset($_GET['factura']) && $_GET['factura']!="")
	{
		$where[] = "a.factura = '".$_GET['factura']."'";
		$factura = $_GET['factura'];
	}
	if(isset($_GET['fecha_inicio']) && $_GET['fecha_inicio']!="")
	{
		$where[] = "date(a.fecha) between '".$_GET['fecha_inicio']."' and '".$_GET['fecha_fin']."'";
		$where2[] = "date(a.fecha_creacion) between '".$_GET['fecha_inicio']."' and '".$_GET['fecha_fin']."'";
		$fecha_inicio = $_GET['fecha_inicio'];
		$fecha_fin = $_GET['fecha_fin'];
	}
	
	$fecha_inicio_p = strtotime($fecha_inicio);
	
	$fecha_fin_p = strtotime($fecha_fin);
	
	$diff = $fecha_fin_p- $fecha_inicio_p;
	
	$dias = round($diff / 86400);
	
	if($dias == 0){
		$dias = 1;
	}
	
	
	$compag   =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
	
	
	
	$kires = buscarf::select1($where);
	
	$kiires = buscarf::select2($where2);
	
	$TotalRegistroFact = count($kires);
	
	$TotalRegistroDev = count($kiires);
	
	$TotalRegistro = $TotalRegistroFact  + $TotalRegistroDev;
	
	//echo "total registro:".$TotalRegistro;
	
	
	$koi = "select round(sum(a.total),2) as total from factura a where a.estado_factura in ('I') and ".implode(" and ", $where);
	
	//echo "ko: ".$ko;
	
	$koires = buscarf::select3($where);
	
	foreach($koires as $koirow){
		$total_suma_fact = $koirow->total;		
	}
		
	//echo "ko: ".$ko;
	
	$koi2res = buscarf::select4($where2);
	
	foreach($koi2res as $koi2row){
		$total_suma_dev = $koi2row->total;		
	}
	
	$total_suma = $total_suma_fact - $total_suma_dev;
	
	
	//echo "ko: ".$ko;
		
	foreach($koires as $koirow){
		$total_suma_fact = $koirow->total;		
	}
	
	
	//sumo impuestos
	
	$koi4res = buscarf::select5($where);
	
	foreach($koi4res as $koi4row){
		$total_impuesto_fact = $koi4row->total;		
	}
	

	$koi5res = buscarf::select6($where2);
	
	foreach($koi5res as $koi5row){
		$total_impuesto_dev = $koi5row->total;		
	}
	
	$total_impuesto = $total_impuesto_fact - $total_impuesto_dev;
	
	
	/*	$ko = "select a.factura, a.fecha, a.nombre_cliente, a.id_paciente, round(a.total,2) as total, a.estado_factura, a.caja_id, a.equipo_fiscal, a.factura_fiscal from factura a where a.estado_factura in ('I') and ".implode(" and ", $where)." order by a.fecha desc LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;*/
			
	//echo "ko: ".$ko;
	
	$kores = buscarf::select7($where2,$compag,$CantidadMostrar);
	
	if ($factura == 0) {
		echo "<center><h3>Movimientos desde el ".$fecha_inicio." hasta el ".$fecha_fin."</h3></center>";
		} else {
		echo "<center><h3>Factura No. ".$factura."</h3></center>";
	}
	
	if($tipo == 1){
		echo "<center><h3>Todos las Movimientos</h3></center>";
		} else if ($tipo == 2){
		echo "<center><h3>Movimientos de Hospital</h3></center>";
		} else {
		echo "<center><h3>Movimientos P&uacute;blico</h3></center>";
	}
	
	echo "<center><h3>N&uacute;mero de Movimientos: ".$TotalRegistro."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto: B/. ".$total_suma."</h3></center>";
	
	echo "<p><center><h3>Promedio de Movimientos: B/.".round(($total_suma/$dias),2)." al d&iacute;a</h3></center>";
	
	echo "<p><center><h3>Total de Impuestos: B/.".round($total_impuesto,2)."</h3></center>";
	
	if($tipo == 2){
		
		echo "<p><center><input type='button' name='reimprimir' value='Reporte de Ventas' onClick=\"window.open('imprimir_venta_con_xls.php?fecha1=".$fecha_inicio."&fecha2=".$fecha_fin."','mywindow','width=1250,height=750,toolbar=yes, scrollbars=yes');\"'></center><p>";
		} else if($tipo == 3){
		
		echo "<p><center><input type='button' name='reimprimir' value='Reporte de Ventas' onClick=\"window.open('imprimir_venta_con_pub_xls.php?fecha1=".$fecha_inicio."&fecha2=".$fecha_fin."','mywindow','width=1250,height=750,toolbar=yes, scrollbars=yes');\"'></center><p>";
		} else if($tipo == 1){
		
		echo "<p><center><input type='button' name='reimprimir' value='Reporte de Ventas' onClick=\"window.open('imprimir_venta_con_comp_xls.php?fecha1=".$fecha_inicio."&fecha2=".$fecha_fin."','mywindow','width=1250,height=750,toolbar=yes, scrollbars=yes');\"'></center><p>";
	}
	
	
	echo "<center><table border='1' cellpadding='1'>
	<tr><th>No. Interno</th>
	<th>Nombre Cliente</th>
	<th>Fecha</th>
	<th>C&eacute;dula o RUC </th>
	<th>Impuesto</th>
	<th>Total</th>
	<th>Equipo Fiscal</th>
	<th>Factura Fiscal</th></tr>";
	
	foreach($kores as $korow){
	
		if($korow->estado_factura == 'I'){
			$imp = 'IMPRESA';
			$color = 'green';} else{
			$imp = 'NO IMPRESA';
			$color= 'red';
		}
		
		
		
		
		if($korow->tipo == 1){
			$f = "select sum(impuesto) as impuesto from factura_detalle where factura = '".$korow->factura."'";
			$fres = mysql_query($f, $conn) or die(mysql_error());
			while($frow = mysql_fetch_array($fres)){
				$impuesto = $frow->impuesto;
			}
			
			} else if ($korow->tipo == 2){
			$f = "select sum(impuesto) as impuesto from devolucion_detalle where devolucion = '".$korow->factura."'";
			$fres = mysql_query($f, $conn) or die(mysql_error());
			while($frow = mysql_fetch_array($fres)){
				$impuesto = $frow->impuesto;
			}	
			
		}
		
		echo "<tr><td>".$korow->factura."</td>
		<td>".$korow->nombre_cliente."</td>
		<td>".$korow->fecha."</td>
		<td>".$korow->id_paciente."</td>
		<td>".$impuesto."</td>
		<td>".$korow->total."</td>
		<td>".$korow->equipo_fiscal."</td>
		<td>".$korow->factura_fiscal."</td>
		<td><input type='button' name='reimprimir' value='Ver Detalle' onClick=\"window.open('ver_detalle_factura.php?no_factura=".$korow->factura."','mywindow','width=1250,height=750,toolbar=yes, scrollbars=yes');\"'> </td></tr>";
    	
	}
	
	echo "</table></center><p><p>";
	
	
	/*Sector de Paginacion */
    
    //Operacion matematica para botón siguiente y atrás 
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
  	$DecrementNum =(($compag -1))<1?1:($compag -1);
	
	if($factura == 0){
		echo "<a href=\"?pag=".$DecrementNum."&fecha_inicio=".$fecha_inicio."&fecha_fin=".$fecha_fin."&tipo=".$tipo."\">?</a>&nbsp;";
		} else {
		echo "<a href=\"?pag=".$DecrementNum."&factura=".$factura."&tipo=".$tipo."\">?</a>&nbsp;"; 
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
					echo "<a href=\"?pag=".$i."&fecha_inicio=".$fecha_inicio."&fecha_fin=".$fecha_fin."&tipo=".$tipo."\">".$i."</a>&nbsp;";
					if ($i % 50 == 0 ) {
						echo "</br>";
					}
					} else {
					echo "<a href=\"?pag=".$i."&factura=".$factura."&tipo=".$tipo."\">".$i."</a>&nbsp;"; 
					if ($i % 50 == 0 ) {
						echo "</br>";
					}
				}
				}else {
				if($factura == 0){
					echo "<a href=\"?pag=".$i."&fecha_inicio=".$fecha_inicio."&fecha_fin=".$fecha_fin."&tipo=".$tipo."\">".$i."</a>&nbsp;";
					if ($i % 50 == 0 ) {
						echo "</br>";
					}
					} else {
					echo "<a href=\"?pag=".$i."&factura=".$factura."&tipo=".$tipo."\">".$i."</a>&nbsp;"; 
					if ($i % 50 == 0 ) {
						echo "</br>";
					}
				}
			}     		
		}
	}
	
	if($factura == 0){
		echo "<a href=\"?pag=".$IncrimentNum."&fecha_inicio=".$fecha_inicio."&fecha_fin=".$fecha_fin."&tipo=".$tipo."\">?</a>";
		if ($IncrimentNum % 50 == 0 ) {
			echo "</br>";
		}
		} else {
		echo "<a href=\"?pag=".$IncrimentNum."&factura=".$factura."&tipo=".$tipo."\">?</a>"; 
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
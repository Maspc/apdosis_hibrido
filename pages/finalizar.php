<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$db_selected = mysql_select_db('farma', $conn);
error_reporting(E_ALL & ~E_NOTICE);
include('seguridad.php');
$factura = $_GET['factura'];

$lres =finalizar::select1($factura); 
foreach($lres  as $lrow)
{
$estado = $lrow->estado_factura;
$procesado =  $lrow->procesado_por;
}


if($estado == 'E' || $estado == 'R'){

/*
$f = "update factura set estado_factura = 'P' where historia = '" .$historia . "' and tratamiento = '".$tratamiento."' and cargo = '".$despacho."' and factura = '".$factura."'";
echo $f;

$ref = mysql_query($f, $conn) or die(mysql_query());*/

//buscar la bodega al cual pertenece
$gres = finalizar::select2($factura);
foreach($gres as $grow )
{
$bodega = $grow->bodega;
}

if ($bodega == ''){
$bodega = 1;
}

$resulta2 =finalizar::select3($factura);




$num = count($resulta2);



$total = 0;
foreach($resulta2 as $rows2 )
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
	
	$medicamento_insumo = $rows2->medicamento_insumo;
	
	$txt = ' (PREPARACION)';
	
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
$wres =finalizar::select4($factura); 

foreach($wres as $wrow)
{
$linea_siguiente = $wrow->linea_siguiente;
}

$rres = finalizar::select5($medicamento_insumo);


foreach($rres as $rrow)
{
$medicamento_id_ins = $rrow->codigo_interno;
$medicamento_ins = $rrow->medicamento.'/'.$nombre_med;
}



if(($grupo_medicamento == '7') || ($grupo_medicamento == '11')){
$cantidad_insumo = 1;
}

$fres = finalizar::insert1($medicamento_ins,$medicamento_id_ins, $linea_siguiente, $costo_adicional,$cantidad_insumo,$costo_adicional_c, $factura,$rows2->medicamento_id,$rows2->historia,$rows2->tratamiento,$rows2->cargo,$linea2 );



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

$res = finalizar::update1($rows2->cantidad,$precio_unitario,$precio_venta, $impuesto_u, $linea2, $costo_unitario,$factura,$rows2->medicamento_id); 


$ores =finalizar::update2($rows2->medicamento_id,$historia,$tratamiento,$despacho); 



if ($tipo_de_dosis != 'M') {

$resss =finalizar::update3($rows2->cantidad,$rows2->medicamento_id,$bodega);  

}else {
$resss = finalizar::update4(ceil($rows2->cantidad),$rows2->medicamento_id,$bodega); 

}

//esto lo añado cuando tenga llena la tabla de medicamentos x lote
//$c = "update medicamentos_x_lote set cantidad = cantidad - '".$rows2['cantidad']."' where medicamento_id = '".$rows2['medicamento_id']."' and fecha_vencimiento in (select fecha_vencimiento from medicamentos_x_lote where medicamento_id ='".$medicamento_id."'  order by fecha_vencimiento limit 1 ) ";
//$cres = mysql_query($c, $conn) or die(mysql_error());

//añado la actualizacion de lotes segun tabla de lotes por factura

$wres = finalizar::select6($factura,$rows2->medicamento_id); 


foreach($wres as $wres  )
{
	
	
	$cres =finalizar::update5($wrow->cantidad,$wrow->medicamento_id,$wrow->lote);
  

	
}


//fin de añado la actualizacion de lotes segun tabla de lotes por factura

$reca =finalizar::select7($rows2->medicamento_id,$bodega); 



//if (($rows2['cant_total'] - $rows2['cantidad']) <= 0) { 
//echo "<br>se detiene el medicamento porque: ".$cant_total[$c];
//echo"<br>3. la cantidad de dosis menos uno es: ".($cantidad_de_dosis[$c] - $cantidad[$c]);
//$o = "update registro_detalle set estado = 'F', cantidad_de_dosis = '0' where medicamento_id = '".$rows2['medicamento_id']."' and historia = '$historia' and tratamiento = '$tratamiento' and cargo = '$despacho'";
//echo "up ".$o;
//$ores = mysql_query($o, $conn) or die(mysql_error());
//}else{
//voy a cambiar la resta de la dosis a 1, porque con la cantidad luego del cambio fraccionado ya no funciona.
/*


$ui = "update registro_detalle set cantidad_de_dosis = cantidad_de_dosis - '".$rows2['average']."', vuelta = 'F' where cargo = '".$despacho."' and medicamento_id = '".$rows2['medicamento_id']."' and historia = '$historia' and tratamiento = '$tratamiento'";
//echo $s;
//echo "La cantidad de dosis que restaré a la original es: ".$cantidad[$c];
$resui = mysql_query($ui, $conn) or die(mysql_error());

*/
//}

}



/*
$r = "select sum(cantidad_de_dosis) as valido from registro_detalle where historia = '" .$historia . "' and tratamiento = '".$tratamiento."' and cargo = '".$despacho."'";
$rres = mysql_query($r, $conn) or die(mysql_error());
//echo $r;

while ($rrow = mysql_fetch_array($rres)){
$valido = $rrow['valido'];
}
//echo 'valido: '.$valido;


if ($valido == 0) {
$t = "update registro set estado = 'F' where historia = '" .$historia. "' and tratamiento = '".$tratamiento."' and cargo = '".$despacho."'";
$tres = mysql_query ($t, $conn) or die(mysql_error());

} else {
*/
$res =finalizar::update6($historia,$tratamiento,$despacho);


//}


/**añado sumatoria de  precio venta y totales 130518**/

$hores = finalizar::select8($factura);

foreach($hores as $horow)
{
$total_suma = $horow->total;
}

/**fin añado sumatario de precio venta y totales 130518**/



 $Hora = Time(); // Hora actual
 $hora_actual =  date('Y-m-d H:i',$Hora);   
//actualizo la factura y el estado lo pongo en P de que ya fue procesada
 

$res =finalizar::update7($hora_actual,$total_suma,$_SESSION['MM_iduser'],$factura);


 echo "<p>Total de la factura: ".$total."<p>";
  
 $rres =finalizar::delete1($factura);






$resulta9 =finalizar::select9($factura); 

foreach($resulta9  as $row9 )

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

}</style></head><body><h1>CARGO FINALIZADO</h1><p><input type="button" name="cerrar" value="Cerrar Ventana" onClick="window.close();" class="green"/></body></html>







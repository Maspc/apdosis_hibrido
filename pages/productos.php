<?php
if (isset($_GET['q'])){
	# conectare la base de datos
    $con=@mysqli_connect("localhost", "imssisc", "IIMS*2013*%", "productos");
	
$return_arr = array();
/* Si la conexión a la base de datos , ejecuta instrucción SQL. */
if ($con)
{
	$fetch = mysqli_query($con,"SELECT * FROM productos where codigo_producto like '%" . mysqli_real_escape_string($con,($_GET['q'])) . "%' LIMIT 0 ,50"); 
	
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_producto=$row['id_producto'];
		$precio=number_format($row['precio_venta'],2,".","");
		$row_array['value'] = $row['codigo_producto']." | ".$row['nombre_producto'];
		$row_array['id_producto']=$row['id_producto'];
		$row_array['codigo']=$row['codigo_producto'];
		$row_array['descripcion']=$row['nombre_producto'];
		$row_array['precio']=$precio;
		array_push($return_arr,$row_array);
    }
}

/* Cierra la conexión. */
mysqli_close($con);

/* Codifica el resultado del array en JSON. */
echo json_encode(array('suggestions' =>$return_arr));
//echo json_encode($return_arr);

}
?>
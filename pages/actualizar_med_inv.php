<html>
	<head>
		<script type="text/javascript">
			{
				if(history.forward(1))
				location.replace(history.forward(1))
			}
		</script>
	</head>
	
	<?php
		echo "<body onunload=\"opener.location=('editar_medicamentos_inv.php')\">";
		echo "<font face='Arial, Helvetica, sans-serif' size='+1'>";
		ob_start();
		include ('./clases/session.php');
		require_once('../modulos/actualizar_med_inv.php');
		
		if (isset($_POST['medicamento_id'])){
			$medicamento_id = $_POST['medicamento_id'];
		}
		if(isset($_POST['medicamento_id'])){
		$medicamento_id = $_POST['medicamento_id'];}
		
		if(isset($_POST['codigo_de_barra'])){
		$codigo_de_barra = $_POST['codigo_de_barra'];}
		
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
		
		if(isset($_POST['cantidad_inicial'])){
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
		
		
		if(isset($_POST['inventario_minimo_tienda'])){
			$inventario_minimo_tienda = $_POST['inventario_minimo_tienda'];
			}else{
			$inventario_minimo_tienda = 0;
		}
		
		if(isset($_POST['inventario_maximo_tienda'])){
			$inventario_maximo_tienda = $_POST['inventario_maximo_tienda'];
			}else{
			$inventario_maximo_tienda = 0;
		}
		
		if(isset($_POST['inventario_ideal_tienda'])){
			$inventario_ideal_tienda = $_POST['inventario_ideal_tienda'];
			}else{
			$inventario_ideal_tienda = 0;
		}
		
		if(isset($_POST['inventario_critico_tienda'])){
			$inventario_critico_tienda = $_POST['inventario_critico_tienda'];
			}else{
			$inventario_critico_tienda = 0;
		}
		
		if(isset($_POST['cantidad_inicial_tienda'])){
			$cantidad_inicial_tienda = $_POST['cantidad_inicial_tienda'];
			}else{
			$cantidad_inicial_tienda = 0;
		}
		
		if(isset($_POST['cantidad_factura_tienda'])){
			$cantidad_factura_tienda = $_POST['cantidad_factura_tienda'];
			}else{
			$cantidad_factura_tienda = 0;
		}
		
		if(isset($_POST['cantidad_devolucion_tienda'])){			  
			$cantidad_devolucion_tienda = $_POST['cantidad_devolucion_tienda'];
			}else{
			$cantidad_devolucion_tienda = 0;
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
		
		if(isset($_POST['porc_vario'])){			  
			$porc_vario = $_POST['porc_vario'];
			}else{
			$porc_vario = 'N';
		}
		
		$frow = amedinv::select1($_SESSION['MM_iduser']);
		foreach($frow as $frw){
			$tipo_usuario = $frw->codigo_tipo;
		}
		
		/*  echo '<p>antibiotico: '.$antibiotico;
			echo '<p>narcotico: '.$narcotico;
			echo '<p>preparacion: '.$preparacion;
			echo '<p>devolucion: '.$devolucion;
		echo '<p>medicamento id: '.$medicamento_id;*/
		
		$hora_actual = date("Y-m-d H:i",time());
		
		if($tipo_usuario == '1'){			
			
			amedinv::update1($inventario_minimo,$inventario_maximo,$inventario_ideal,$inventario_critico,$cantidad_inicial,$cantidad_factura,$cantidad_devolucion,$_SESSION['MM_iduser'],$hora_actual,$medicamento_id);
			
			amedinv::update2($inventario_minimo_tienda,$inventario_maximo_tienda,$inventario_ideal_tienda,$inventario_critico_tienda,$cantidad_inicial_tienda,$cantidad_factura_tienda,$cantidad_devolucion_tienda,$_SESSION['MM_iduser'],$hora_actual,$medicamento_id);
			
			$precio = ($costo_unitario * ($porcentaje_ganancia/100)) + $costo_unitario;
			
			$rrow = amedinv::select2($medicamento_id);
			foreach($rrow as $rrw){
				$precio_anterior = $rrw->precio_unitario;
			}
			
			if ($precio_anterior != $precio_unitario){
				$porcentaje_ganancia = (($precio_unitario - $costo_unitario)/$costo_unitario)*100;
			}
			
			amedinv::update3($costo_unitario,$precio_unitario,$porcentaje_ganancia,$_SESSION['MM_iduser'],$hora_actual,$codigo_de_barra,$porc_vario,$medicamento_id);
			amedinv::insert1($medicamento_id,$_SESSION['MM_iduser'],$costo_unitario,$precio_unitario);
			
			} else {
			echo "Estos datos solo pueden ser actualizados por un usuario administrador!";
		}
		
		echo "Se actualiz&oacute; exit&oacute;samente el medicamento";
		echo "<p><a href=\"JavaScript:window.close()\">Volver</a> "
		
	?>
</font>
</body>
</html>
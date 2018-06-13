<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/actualizar_med_estado.php');
?>
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
		echo "<body onunload=\"opener.location=('editar_medicamentos_estado.php')\">";
		echo "<font face='Arial, Helvetica, sans-serif' size='+1'>";
		
		if (isset($_POST['medicamento_id'])){
			$medicamento_id = $_POST['medicamento_id'];
		}
		if (isset($_POST['estado_med'])){
			$estado_med = $_POST['estado_med'];
		}
		
		
		/*  echo '<p>antibiotico: '.$antibiotico;
			echo '<p>narcotico: '.$narcotico;
			echo '<p>preparacion: '.$preparacion;
			echo '<p>devolucion: '.$devolucion;
		echo '<p>medicamento id: '.$medicamento_id;*/
		
		$hora_actual = date("Y-m-d H:i",time());
		
		
		
		amestado::update1($estado_med,$_SESSION['MM_iduser'],$hora_actual,$medicamento_id);
		
		if($estado_med == 'A'){
			$tran = 'ACTIVA';
			}else if ($estado_med == 'I') {
			$tran = 'INACTIVA';
		}
		
		amestado::insert1($medicamento_id,$hora_actual,$_SESSION['MM_iduser'],$tran);
		//precio_unitario = '$precio_unitario',
		
		echo "Se actualiz&oacute; exit&oacute;samente el medicamento";
		echo "<p><a href=\"JavaScript:window.close()\">Volver</a> ";		
	?>
</font>
</body>
</html>
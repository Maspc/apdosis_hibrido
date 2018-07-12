<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/principios_activos.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	$cont = 0;
?>
<style type="text/css">
	
	.red {
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
<center>   <h1>Principios Activos</h1> </center>
<div class="content_box_inner" style="font-size:16px" align="center">
    
	<form method="post" action="add_principio.php" name="formulario" onsubmit="return validate();">
		<table align="center">
			<tr><td>Principio Activo:</td><td><input type="text" name="descripcion" id="descripcion" required="required" ></td></tr>
			<tr><td></td><td><input type="submit" name="submit" value="Añadir"></td></tr>
		</table>
	</form>
	
	</br>
	</br>
	<table border="1" align="center">
		<tr><th>Descripci&oacute;n</th></tr>
		<?php
			$formas_query=prin_a::select1();
			foreach($formas_query as $formas_rows){
			?>
			<tr>
				<td><?php echo $formas_rows->descripcion ; ?></td>
				
				<!-- <td><a href="#" onclick="confirmation('delete_principio.php<?php echo '?id='.$formas_rows->principio_id; ?>')" >Borrar</a></td> -->
				<td><a href="edit_principio.php<?php echo '?id='.$formas_rows->principio_id; ?>">Editar</a></td>
			</tr>
		<?php }?>
	</table>
	
	
	
	
	
</div>
<?=layout::fin_content()?>
<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:1200px;dialogHeight:600px");
			} else {
			alert(url);
			window.open(url,'name','height=500,width=600,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} 
</script>

<script>
	function validate()
	{
		var forma = document.formulario.descripcion;
		
		
		if (forma.value == "")
		{
			window.alert("Por favor introduzca un valor en el Principio Activo");
			forma.focus();
			return false;
		}
		
	}
</script>


<script>
	<!--
	function confirmation(value) {
		var answer = confirm("¿Desea borrar este registro?")
		if (answer){
			//alert(value)
			window.location = value ;
		}
		else{
			alert("No borró el registro")
		}
	}
	//-->
</script>
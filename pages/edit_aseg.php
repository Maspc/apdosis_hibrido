<?php
	
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/edit_aseg.php');
	require_once('../modulos/layout.php');
	layout::encabezado();	
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
<center>   <h1>Aseguradoras</h1> </center>
<div class="content_box_inner" style="font-size:16px">
    
	<?php
		$id=$_GET['id'];
	?>
	
	<form method="post">
		<table align="center">
			<?php
				
				$formas_rows=edit_aseg::select1($id);
				
			?>
			<tr><td>Nombre Aseguradora:</td><td><input type="text" name="descripcion" value="<?php echo $formas_rows[0]->descripcion;  ?>"></td></tr>
			<tr><td>Descuento:</td><td><input type="text" name="descuento_maximo" value="<?php echo ($formas_rows[0]->descuento_maximo * 100);  ?>"> % </td></tr>
			<tr><td></td><td><input type="submit" name="submit" value="Guardar"></td></tr>
		</table>
	</form>
</body>
</html>
<?php 
	
	if (isset($_POST['submit'])){
		
		$descripcion=$_POST['descripcion'];
		$descuento_maximo=$_POST['descuento_maximo'] / 100;
		
		edit_aseg::update($descripcion,$descuento_maximo,$id);
		header('location:aseguradora.php');
		
	}
	
	
?>
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
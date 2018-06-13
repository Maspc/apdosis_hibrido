<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/proveedores.php');
	$cont = 0;
	require_once('../modulos/layout.php');
	layout::encabezado();
?>
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
<?php
	layout::menu();
	layout::ini_content();
?>
<center>   <h1>Proveedores</h1> </center>
<div class="content_box_inner" style="font-size:16px">
	
	<?php
		$id=$_GET['id'];
	?>
	
	<form method="post">
		<table align="center">
			<?php 
				$prove_rows = provee::edit_provee($id);
				
			?>
			<tr><td>Nombre:</td><td><input type="text" name="nombre" value="<?=$prove_rows[0]->nombre?>"></td></tr>
			<tr><td>Contacto:</td><td><input type="text" name="contacto" value="<?=$prove_rows[0]->contacto?>"></td></tr>
			<tr><td>Telefono:</td><td><input type="text" name="telefono" value="<?=$prove_rows[0]->telefono?>"></td></tr>
			<tr><td></td><td><input type="submit" name="submit" value="Guardar"></td></tr>
		</table>
	</form>
</body>
</html>
<?php 
	
	if (isset($_POST['submit'])){
		
		$nombre=$_POST['nombre'];
		$contacto=$_POST['contacto'];
		$telefono=$_POST['telefono'];
		
		provee::update_provee($nombre,$contacto,$telefono,$id);
		header('location:proveedores.php');
		
	}
?>

</div>
<?=layout::fin_content()?>
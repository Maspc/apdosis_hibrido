<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/posologias.php');
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

<center>   <h1>Concetraci&oacute;n</h1> </center>
<div class="content_box_inner" style="font-size:16px">
	
	<?php
		$id=$_GET['id'];
	?>
	
	<form method="post">
		<table align="center">
			<?php 
				$poso_rows = posologia::edit_poso($id);
			?>
			<tr><td>Unidad de Medida:</td><td><input type="text" name="descripcion" value="<?=$poso_rows[0]->descripcion?>"></td></tr>
			<tr><td></td><td><input type="submit" name="submit" value="Guardar"></td></tr>
		</table>
	</form>
</body>
</html>
<?php 
	
	if (isset($_POST['submit'])){
		
		$descripcion=$_POST['descripcion'];
		
		posologia::update_poso($descripcion,$id);
		header('location:posologias.php');
		
	}
?>

</div>
<?=layout::fin_content()?>
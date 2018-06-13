<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/tipo_clientes.php');
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
<center>   <h1>Tipo de Clientes</h1> </center>
<div class="content_box_inner" style="font-size:16px">
	
	<?php
		$codigo=$_GET['codigo'];
	?>
	
	<form method="post">
		<table align="center">
			<?php 
				$prove_rows = clientes::edita_clie($codigo);
			?>
			<tr><td>Descripción:</td><td><input type="text" name="descripcion" value="<?=$prove_rows[0]->descripcion?>"></td></tr>
			<tr><td>Descuento Máximo:</td><td><input type="text" name="descuento_maximo" value="<?=$prove_rows[0]->descuento_maximo * 100;  ?>"> % </td></tr>
			<tr><td></td><td><input type="submit" name="submit" value="Guardar"></td></tr>
		</table>
	</form>
</body>
</html>
<?php 
	
	if (isset($_POST['submit'])){
		
		$descripcion=$_POST['descripcion'];
		$descuento_maximo=$_POST['descuento_maximo'] / 100;
		
		clientes::update_clie($descripcion,$descuento_maximo,$codigo);
		header('location:tipo_clientes.php');
		
	}
?>

</div>
<?=layout::fin_content()?>
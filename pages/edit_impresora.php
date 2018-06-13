<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/impresoras_fiscales.php');
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
<center>   <h1>Impresoras Fiscales</h1> </center>
<div class="content_box_inner" style="font-size:16px">
	
	<?php
		$id=$_GET['id'];
	?>
	
	<form method="post">
		<table align="center">
			<?php 
				
				$formas_rows = ifiscales::select2($id);
			?>
			<tr><td>Tipo Impresion:</td><td><?  if ( $formas_rows[0]->tipo_impresion == 'FAC' ) { echo "FACTURAS RECURRENTES"; } else if  ( $formas_rows[0]->tipo_impresion == 'STA' ) { echo "STATS";  } 
			else if  ( $formas_rows[0]->tipo_impresion == 'DEV' ) { echo "DEVOLUCIONES";  } ?></td>
			</tr>
			<tr><td> <select name="impresora"> 
				<option value="in1" <?=(( $formas_rows[0]->nombre_carpeta  == 'in1')?'selected':'')?> >IMPRESORA 1</option>
				<option value="in2" <?=(( $formas_rows[0]->nombre_carpeta  == 'in2')?'selected':'')?> >IMPRESORA 2</option>
				<option value="in3" <?=(( $formas_rows[0]->nombre_carpeta  == 'in3')?'selected':'')?> >IMPRESORA 3</option>
			</select></td></tr>
			<tr><td></td><td><input type="submit" name="submit" value="Guardar"></td></tr>
		</table>
	</form>
</body>
</html>
<?php 
	
	if (isset($_POST['submit'])){
		
		$impresora=$_POST['impresora'];
		
		if($impresora == 'in1') {
			$impresora2 = 'out1';
			}else if($impresora == 'in2'){
			$impresora2 = 'out2';
			} else {
			$impresora2 = 'out3';
		}
		
		ifiscales::update1($impresora,$impresora2,$id);
		header('location:impresoras_fiscales.php');
		
	}
?>

</div>
<?=layout::fin_content()?>
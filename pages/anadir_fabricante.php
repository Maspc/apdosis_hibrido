<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/anadir_fabricante.php');
	require_once('../modulos/layout.php');
	layout::ini_indices();
?>


<h1>
	Añadir Fabricante 
</h1>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="agregar_fabri">
	<table width="351" border="0">
		<tr>
			<td>Nombre del Fabricante</td>
			<td><input name="fabricante" type="text" size="50" class="required" /></td>
		</tr>
		<tr>
			<td colspan="2"><div align="center">
				<input name="anadir" type="submit" value="A&ntilde;adir" />
			</div></td>
		</tr>
		<tr>
			<td colspan="2">
				<?
					if(isset($_POST['anadir'])){
						$fabric = $_POST['fabricante'];
						afabrica::insert1($fabric);								
						echo "Ha añadido con éxito el fabricante: ".$fabric;								
					}
					
				?>
			</td>
		</tr>
		
	</table>
	
	
</form>

<?=layout::fin_indices()?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
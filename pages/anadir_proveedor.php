<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/anadir_proveedor.php');
	require_once('../modulos/anadir_fabricante.php');
	require_once('../modulos/layout.php');
	layout::ini_indices();
?>		

<h1>
	Añadir Proveedor
</h1>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="agregar_prov">
	<table width="351" border="0">
		<tr>
			<td>Nombre del Proveedor</td>
			<td><input name="proveedor" type="text" size="50" class="required" /></td>
		</tr>
		<tr>
			<td>Contacto</td>
			<td><input name="contacto" type="text" size="50" class="required" /></td>
		</tr>
		<tr>
			<td>Teléfono</td>
			<td><input name="telefono" type="text" size="50" class="required" /></td>
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
						$proveedor = $_POST['proveedor'];
						$contacto = $_POST['contacto'];
						$telefono = $_POST['telefono'];
						
						aproveedor::insert1($proveedor,$contacto,$telefono);
						echo "Ha añadido con éxito el proveedor: ".$proveedor;	
						
					}
					
				?>
			</td>
		</tr>
		
	</table>
	
	
</form>
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
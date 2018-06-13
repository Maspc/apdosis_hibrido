<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/usuarios.php');
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
<center>   <h1>Edici&oacute;n de Usuarios</h1> </center>
<div class="content_box_inner" style="font-size:16px">
	
	<?php
		$id=$_GET['id'];
	?>
	
	<form method="post">
		<table class='dtable' align="center">
			<?php 
				$formas_rows = usuarios::usuarios_edit($id);
			?>
			<tr><td>Usuario</td><td><input type="text" name="user" value="<?=$formas_rows[0]->user?>" disabled="disabled"></td></tr>
			<tr><td>Nombre</td><td><input type="text" name="nombre" value="<?=$formas_rows[0]->nombre?>"></td></tr>
			<tr><td>Tipo</td><td><select name='tipo'>
				<?php
					$frow = usuarios::t_usuarios();
					foreach($frow as $fw){
						echo '<option value="'.$fw->codigo_tipo.'" '.(($formas_rows[0]->tipo==$fw->codigo_tipo)?'selected':'').'>'.$fw->descripcion.'</option>';
					}
					echo "</select>";
				?></td></tr>
				<tr><td>Estado</td><td><select name="estado"><option value="A" <?=(($formas_rows[0]->estado == 'A')?" selected":"")?> >Activo</option><option value="I" <?=(($formas_rows[0]->estado == 'I')?" selected":"")?> >Inactivo</option></select></td></tr>
				<tr><td></td><td><input type="submit" name="submit" value="Guardar"></td></tr>
			</table>
		</form>
	</div>
<?php 
	
	if (isset($_POST['submit'])){
		$nombre = $_POST['nombre'];
		$tipo = $_POST['tipo'];
		$estado = $_POST['estado'];
		
		usuarios::update_eusu($nombre,$tipo,$estado,$id);
		header('location:usuarios_editar.php');
		
	}
	
	layout::fin_content();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.01 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<?php
		ob_start();
		
		include ('./clases/session.php');
		require_once('../modulos/formas_fama.php');
		require_once('../modulos/layout.php');
		$cont = 0;
		
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
		} </script>
		
		<script>
			function validate()
			{
				var forma = document.formulario.descripcion;
				
				
				if (forma.value == "")
				{
					window.alert("Por favor introduzca un valor en la Forma Farmaceutica");
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
		<?php
			layout::menu();
			layout::ini_content();
		?>
		<center>   <h1>Formas Farmac&eacute;uticas</h1> </center>
		<div class="content_box_inner" style="font-size:16px" align="center">
			
			<form method="post" action="add_farma.php" name="formulario" onsubmit="return validate();">
				<table align="center">
					<tr><td>Forma Farmaceutica:</td><td><input type="text" name="descripcion" id="descripcion" class="required" ></td></tr>
					<tr><td></td><td><input type="submit" name="submit" value="Añadir"></td></tr>
				</table>
			</form>
			
			</br>
			</br>
			<table id="dtable" border="1" align="center">
				<tr><th>Descripci&oacute;n</th>
					<th></th>
					<th></th>
					</tr>
				<?php
					$ffarma = ffama::ffarma();
					
					foreach($ffarma as $fm){
						
					?>
					<tr>
						<td><?=$fm->descripcion?></td>
						
						<td style="width: 5px;"><a href="#"  title="Borrar" class="fa fa-remove" onclick="confirmation('delete_farma.php<?='?id='.$fm->codigo_forma?>')" ></a></td>
						<td style="width: 5px;"><a href="edit_farma.php<?='?id='.$fm->codigo_forma?>" class="fa fa-edit" title="Editar"></a></td>
					</tr>
				<?php }?>
			</table>
			
		</div>
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
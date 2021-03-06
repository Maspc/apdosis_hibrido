<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/presentacion.php');
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
	} </script>
	
	<script>
		function validate()
		{
			var presentacion = document.formulario.descripcion;
			
			
			if (presentacion.value == "")
			{
				window.alert("Por favor introduzca un valor en la Presentacion");
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
	<center>   <h1>Presentaciones</h1> </center>
	<div class="content_box_inner" style="font-size:16px" align="center">
		
		<form method="post" action="add_presentacion.php" name="formulario" onsubmit="return validate();">
			<table align="center">
				<tr><td>Presentación:</td><td><input type="text" name="descripcion" id="descripcion" class="required" ></td></tr>
				<tr><td></td><td><input type="submit" name="submit" value="Añadir"></td></tr>
			</table>
		</form>
		
		</br>
		</br>
		<table id="dtable" border="1" align="center">
			<tr><th>Descripci&oacute;n</th><th></th><th></th></tr>
			<?php
				$prese_rows = presenta::dat_prese();
				foreach($prese_rows as $pr){
				?>
				<tr>
					<td><?=$pr->descripcion?></td>
					
					<td style="width: 5px"><a href="#" class="fa fa-remove" onclick="confirmation('delete_presentacion.php<?='?id='.$pr->codigo_presentacion?>')" title="Borrar"></a></td>
					<td style="width: 5px"><a class="fa fa-edit" href="edit_presentacion.php<?='?id='.$pr->codigo_presentacion?>" title="Editar"></a></td>
				</tr>
			<?php }?>
		</table>
		
	</div>
	<?=layout::fin_content()?>
	<script language="javascript" type="text/javascript" src="../js/script.js"></script>
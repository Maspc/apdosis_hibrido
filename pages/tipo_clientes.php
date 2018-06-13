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
		} </script>
		
		<script>
			function validate()
			{
				var descripcion = document.formulario.descripcion;
				var descuento_maximo = document.formulario.descuento_maximo;
				
				if (nombre.value == "")
				{
					window.alert("Por favor introduzca un valor en la Descripcion");
					nombre.focus();
					return false;
				}
				
				if (descuento_maximo.value == "")
				{
					window.alert("Por favor introduzca un valor en el Descuento Maximo");
					nombre.focus();
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
		<center>   <h1>Tipos de Clientes</h1> </center>
		<div class="content_box_inner" style="font-size:16px" align="center">
			
			<form method="post" action="add_tipo_clientes.php" name="formulario" onsubmit="return validate();">
				<table align="center">
					<tr><td>Descripción:</td><td><input type="text" name="descripcion" class="required" id="descripcion" ></td></tr>
					<tr><td>Descuento Máximo:</td><td><input type="text" name="descuento_maximo" class="required" id="descuento_maximo" ></td></tr>
					
					<tr><td></td><td><input type="submit" name="submit" value="Añadir"></td></tr>
				</table>
			</form>
			
			</br>
			</br>
			<table id="dtable" border="1" align="center">
				<tr><th>Código</th><th>Descripción</th><th>Descuento Máximo</th><th></th></tr>
				<?php
					$prove_rows = clientes::dat_tcliente();
					foreach($prove_rows as $pr){
					?> 
					<tr>
						<td><?=$pr->codigo_tipo?></td>
						<td><?=$pr->descripcion?></td>
						<td><?=($pr->descuento_maximo * 100)?> % </td>
						<td style="width: 5px"><a href="edit_tipo_clientes.php<?='?codigo='.$pr->codigo_tipo?>" class="fa fa-edit" title="Editar"></a></td>
					</tr>
				<?php }?>
			</table>
			
		</div>
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
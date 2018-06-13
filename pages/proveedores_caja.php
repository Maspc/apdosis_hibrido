<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/proveedores_caja.php');
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
			var nombre = document.formulario.nombre;
			
			
			if (nombre.value == "")
			{
				window.alert("Por favor introduzca un valor en el Nombre");
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
	<center>   <h1>Proveedores de Caja</h1> </center>
	<div class="content_box_inner" style="font-size:16px" align="center">
		
		<form method="post" action="add_prove_caja.php" name="formulario" onsubmit="return validate();">
			<table align="center">
				<tr><td>Nombre:</td><td><input type="text" name="nombre" class="required" id="nombre" ></td></tr>
				<tr><td>RUC:</td><td><input type="text" name="ruc" class="required" id="ruc" ></td></tr>
				<tr><td>Contacto:</td><td><input type="text" name="contacto"  ></td></tr>
				<tr><td>Tel&eacute;fono:</td><td><input type="text" name="telefono" ></td></tr>
				<tr><td></td><td><input type="submit" name="submit" value="Añadir"></td></tr>
			</table>
		</form>
		
		</br>
		</br>
		<table id="dtable" border="1" align="center">
			<tr><th>Nombre</th><th>RUC</th><th>Contacto</th><th>Telefono</th><th></th><th></th></tr>
			<?php
				$prove_rows = provee::dat_provee();
				foreach($prove_rows as $pr){
				?>
				<tr>
					<td><?=$pr->nombre_proveedor?></td>
					<td><?=$pr->ruc?></td>
					<td><?=$pr->contacto?></td>
					<td><?=$pr->telefono?></td>
					<td style="width: 5px;"><a href="#" class="fa fa-remove" onclick="confirmation('delete_prove_caja.php<?='?id='.$pr->id_proveedor?>')" title="Borrar"></a></td>
					<td style="width: 5px;"><a class="fa fa-edit" href="edit_prove_caja.php<?='?id='.$pr->id_proveedor?>" title="Editar"></a></td>
				</tr>
			<?php }?>
		</table>
		
	</div>
	<?=layout::fin_content()?>
	<script language="javascript" type="text/javascript" src="../js/script.js"></script>	
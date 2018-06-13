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
		var answer = confirm("Â¿Desea borrar este registro?")
		if (answer){
			//alert(value)
			window.location = value ;
		}
		else{
			alert("No borrÃ³ el registro")
		}
	}
	//-->
</script>
<?php
	layout::menu();
	layout::ini_content();
?>
<center>   <h1>Edici&oacute;n de Usuarios</h1> </center>
<div class="content_box_inner" style="font-size:16px" align="center">
	
	
	<table class='dtable' border="1" align="center">
		<tr><th>Usuario</th><th>Nombre</th><th>Tipo</th><th>estado</th><th></th></tr>
		<?php
			$formas_rows = usuarios::usuarios_edi() ;	
			
			foreach($formas_rows as $fr){
			?>
			<tr>
				<td><?=$fr->user?></td>
				<td><?=$fr->nombre?></td>
				<td><?=$fr->descripcion?></td>
				<td><?=$fr->estado?></td>
				<td style="width: 5%"><a class="fa fa-edit" href="edit_usuarios.php<?='?id='.$fr->user?>" title="Editar"></a></td>
			</tr>
		<?php }?>
	</table>
	
</div>
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
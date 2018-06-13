<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/listado_clientes.php');
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
	<center>   <h1>Clientes</h1> </center>
	<div class="content_box_inner" style="font-size:16px" align="center">
		
		
		<table id="dtable" border="1" align="center">
			<tr><th>Id Cliente</th><th>Nombre</th><th>Tipo</th><th>Saldo Actual</th><th>Ver Movimientos</th></tr>
			<?php
				$formas_rows = clientes::lis_cliente();
				foreach($formas_rows as $fr){
				?>
				<tr>
					<td><?=$fr->id_cliente?></td>
					<td><?=$fr->nom_cliente?></td>
					<td><?=$fr->descripcion?></td>
					<td><?=$fr->saldo_actual?></td>
					<td align="center"><input type='button' value='...'   onClick="window.open('ver_facturas.php?codigo_cliente=<?=$fr->id_cliente?>','mywindow','width=450,height=600,toolbar=yes, scrollbars=yes');" /></td>
				</tr>
			<?php }?>
		</table>
		
	</div>
	<?=layout::fin_content()?>
	<script language="javascript" type="text/javascript" src="../js/script.js"></script>	
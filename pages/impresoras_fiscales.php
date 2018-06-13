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
	<center>   <h1>Impresoras Fiscales</h1> </center>
	<div class="content_box_inner" style="font-size:16px" align="center">
		
		
		
		</br>
		</br>
		<table class="dtable" border="1" align="center">
			<tr><th>Tipo de Impresion</th>
			<th>Impresora</th><th></th></tr>
			<?php
				$formas_rows = ifiscales::select1();
				foreach($formas_rows as $frs){
					
				?>
				<tr>
					<td><?php if ( $frs->tipo_impresion == 'FAC' ) { echo "FACTURAS RECURRENTES"; } else if  ( $frs->tipo_impresion == 'STA' ) { echo "STATS";  } 
					else if  ( $frs->tipo_impresion == 'DEV' ) { echo "DEVOLUCIONES";  } ?></td>
					
					<td><?php if ( $frs->nombre_carpeta == 'in1' ) { echo "IMPRESORA 1"; } else if  ( $frs->nombre_carpeta == 'in2' ) { echo "IMPRESORA 2";  } else if  ( $frs->nombre_carpeta == 'in3' ) { echo "IMPRESORA 3";  } 
					?></td>
					<td style="width: 5px"><a class="fa fa-edit" href="edit_impresora.php<?php echo '?id='.$frs->tipo_impresion; ?>" title="Editar"></a></td>
				</tr>
			<?php }?>
		</table>
		
	</div>
	<?=layout::fin_content()?>
	<script language="javascript" type="text/javascript" src="../js/script.js"></script>
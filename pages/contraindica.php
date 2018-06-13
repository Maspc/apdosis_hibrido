	<?php
		ob_start();
		include ('./clases/session.php');
		require_once('../modulos/contraindica.php');
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
				var contra = document.formulario.contra_farma;
				var contra_pac = document.formulario.contra_pac;
				
				
				if (contra.value == "")
				{
					window.alert("Por favor introduzca un valor en la Contraindicacion del Medicamento");
					contra.focus();
					return false;
				}
				
				if (contra_pac.value == "")
				{
					window.alert("Por favor introduzca un valor en la Contraindicacion del Paciente");
					contra_pac.focus();
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
		<center>   <h1>Contraindicaciones</h1> </center>
		<div class="content_box_inner" style="font-size:16px" align="center">
			
			<form method="post" action="add_contra.php" name="formulario" onsubmit="return validate();">
				<table align="center">
					<tr><td>Contraindicación Medicamento:</td><td><input type="text" name="contra_farma" id="contra_farma"  ></td></tr>
					<tr><td>Contraindicación Paciente:</td><td><input type="text" name="contra_pac" id = "contra_pac" ></td></tr>
					<tr><td></td><td><input type="submit" name="submit" value="Agregar"></td></tr>
				</table>
			</form>
			
			</br>
			</br>
			<table id="dtable" border="1" align="center">
				<tr><th>Contraindicación Medicamento</th><th>Contraindicación Paciente</th><th></th><th></th></tr>
				<?php
					$contra_rows = contra::dat_contra();
					foreach($contra_rows as $cr){
					?>
					<tr>
						<td><?=$cr->descripcion?></td>
						<td><?=$cr->descripcion_paciente?></td>
						<td style="width: 5px;"><a href="delete_contra.php<?='?id='.$cr->codigo_contraindicacion?>" class="fa fa-remove" title="Borrar"></a></td>
						<td style="width: 5px;"><a href="edit_contra.php<?='?id='.$cr->codigo_contraindicacion?>" class="fa fa-edit" title="Editar"></a></td>
					</tr>
				<?php }?>
			</table>
			
		</div>
		<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
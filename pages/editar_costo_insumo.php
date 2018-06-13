<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/editar_costo_insumo.php');
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
	
	
	function popupform(myform, windowname)
	{
		
		if (! window.focus)return true;
		
		window.open('', windowname, 'width=500,height=200, toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
		myform.target=windowname;
		return true;
	}
	
</script>
<SCRIPT TYPE="text/javascript">
	<!--
	// copyright 1999 Idocs, Inc. http://www.idocs.com
	// Distribute this script freely but keep this notice in place
	function numbersonly(myfield, e, dec)
	{
		var key;
		var keychar;
		
		if (window.event)
		key = window.event.keyCode;
		else if (e)
		key = e.which;
		else
		return true;
		keychar = String.fromCharCode(key);
		
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
		(key==9) || (key==13) || (key==27) )
		return true;
		
		// numbers
		else if ((("0123456789.").indexOf(keychar) > -1))
		return true;
		
		// decimal point jump
		else if (dec && (keychar == "."))
		{
			myfield.form.elements[dec].focus();
			return false;
		}
		else
		return false;
	}
	
	//-->
</SCRIPT>
<?php
	layout::menu();
	layout::ini_content();
?>
<center>
	<form name="consultar" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		
		<label><select name="tipo">
			<?php 
				$cols = edicosto::gmedica();
				foreach($cols as $cs){
					echo '<option value="'.$cs->codigo_grupo.'">'.$cs->descripcion.'</option>';
				}
			?> 
		</select></label>							
		<p>
			<input name="enviar" type="submit" value="Consultar" />
			
		</form>
		
		<?php
			if (isset($_POST['enviar'])) {
				
				$tipo = $_POST['tipo'];
				
				
				$nom_tipo = edicosto::g_dmedica($tipo);
				
				echo "<center><h2>".$nom_tipo."</h2></center>";
				
				$row_Recordset1 = edicosto::record1($tipo);
				$cont = 0;
				
				echo "
				<form name='editar_costo' id='editar_costo' action='enviar_editar_costoin.php' method='post' onSubmit=\"popupform(this, 'join')\"  >
				
				<table border='1px' align='center'>
				<tr>
				<th>Codigo</th>
				<th>Grupo</th>
				<th>Porcentaje Ganancia</th>
				<th>Descuento M&aacute;ximo Aceptado</th>
				
				</tr>";
				
				foreach($row_Recordset1 as $rw1){
					$cont = $cont + 1;	  
					
					echo "<tr>
					
					<td>" .$rw1->codigo_sub."<input type='hidden' name='codigo_grupo[]' id='codigo_grupo' value='".$tipo."' /><input type='hidden' name='codigo_sub[]' id='codigo_sub' value='".$rw1->codigo_sub."' /></td>
					<td>".$rw1->descripcion."</td>
					<td><input type='text' name='porcentaje_ganancia[]' id='porcentaje_ganancia' value='".$rw1->porcentaje_ganancia."' size='15' onKeyPress=\"return numbersonly(this, event)\" /></td>
					<td><input type='text' name='descuento_maximo[]' id='costo_adicional_2' value='".$rw1->descuento_maximo."' size='15' disabled='disabled' /></td> 
					</tr>";
				}
				
				echo "</table><p></p><input type='submit' value='Actualizar Valores' />";
				
			}
			echo "</form>";
		?>
	</center>
</p>
<?=layout::fin_content()?>				
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/apertura_cierre_anaquel.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
?>

<style type="text/css">
	
	.red {
	background-color: red;
	color: white;
	}
	.white {
	background-color: white;
	color: black;
	}
	.green {
	background-color: green;
	color: white;
	}
	
	.blue {
	background-color: blue;
	color: white;
	}
	.red, .white, .blue, .green {
	margin: 0.5em;
	padding: 5px;
	font-weight: bold;
	
	}	
</style>

<?php
	layout::menu();
	layout::ini_content();
?>

<div class="content_box_inner">
	<center><h1>Conteo de Anaqueles</h1></center>
	<p></p><p></p><p></p>
	<center>	<table border="1" cellpadding="1" cellspacing="1" align="center">
		<tr cellpadding="1" cellspacing="1">
			<?php
				
				$gres = apertca::select1();				
				$c = 0;
				foreach($gres as $grow){
					$anaquel = $grow->id_anaquel;	
					$id_conteo = $grow->id_conteo;
					$estado = $grow->estado;
				?>
				
				
			<td><p></p><center>Anaquel <?php echo $anaquel ?><p></p><input type="button" value="Iniciar Conteo"  <?php if ($estado =='A') { echo " disabled"; } ?> onClick="javascript:popUp('actualizar_conteo_anaquel.php?anaquel=<?php echo $anaquel; ?>&conteo=<?php echo $id_conteo; ?>&estado=A')"><p></p><input type="button" value="Finalizar Conteo" <?php if ($estado !='A') { echo " disabled"; } ?> onClick="javascript:popUp('actualizar_conteo_anaquel.php?anaquel=<?php echo $anaquel; ?>&conteo=<?php echo $id_conteo; ?>&estado=I')" ></p></p></center></td>
			
			
			
	<?php  } ?>
	</tr>
</table></center>

</div>
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript">
	function clearText(field)
	{
		if (field.defaultValue == field.value) field.value = '';
		else if (field.value == '') field.value = field.defaultValue;
	}
</script>
<script>
    function teclas(event) {
        tecla=(document.all) ? event.keyCode : event.which;
		
        if (tecla==13) {
			
            event.keyCode = 40; event.charCode = 40; event.which = 1199; break;
			
            return false;
		}
		
        return true;
	}
</script>

<script language="javascript">
	<!-- Begin
	function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=400');");
	}
	
	
	
	function popupform(myform, windowname)
	{
		
		if (! window.focus)return true;
		
		window.open('', windowname, 'width=500,height=200, toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
		myform.target=windowname;
		return true;
	}
	
	
	// End -->
</script>

<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:500px;dialogHeight:200px");
			} else {
			alert(url);
			window.open(url,'name','height=500,width=600,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} 
	</script>		
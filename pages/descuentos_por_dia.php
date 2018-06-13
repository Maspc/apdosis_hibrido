<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/descuentos_por_dia.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
?>		
<script language="javascript">
	<!-- Begin
	function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=600');");
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
<?php
	layout::menu();
	layout::ini_content();
?>

<center>    <h1>Descuentos Diarios por Grupo de Artículos</h1></center>
<p></p>
<p></p>
<div class="content_box_inner">
	<center>  <table class="dtable" align="center" border="1">
		
		<tr><th>D&iacute;a de la Semana</th>
		<th>Visualizar Grupo</th></tr>
		
		<?php
			$trow = dpordia::ddescuento();
			foreach($trow as $tw){
				
				echo "<tr><td>".$tw->nombre."</td><td>"; 
			?>								
			<input type="button" name="grupos_dias" value="Grupos con Descuento" id="grupos_dias" onClick="javascript:popUp('actualizar_desc_dia.php?dia=<?=$tw->dia_id?>&men=0')" />
			
			<?php
				echo "</td></tr>"; 
				
			}
			
			echo "</table>";
			
			
			
		?>
		
	</center>
	</div>
<?=layout::fin_content()?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
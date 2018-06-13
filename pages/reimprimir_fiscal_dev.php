<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/reimprimir_fiscal_dev.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
?>

<script type="text/javascript">
	function toggleDiv(divId) {
		$("#"+divId).toggle();
	}
</script>

<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:1200px;dialogHeight:600px");
			} else {
			alert(url);
			window.open(url,'name','height=500,width=600,toolbar=yes,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} 
</script>
<?php
	layout::menu();
	layout::ini_content();
?>
<center><h1>Reimpresi&oacute;n de Nota de Cr&eacute;dito Fiscal</h1></center>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="estado" id="estado">
	
	
	
	<table class='dtable' width="780" border="0" cellspacing="0" >
		
		<tr>
			<td>
				<table class='dtable' width="510" border="1" cellspacing="0" bordercolor="#000000" align="center">
					<tr>
						<td>Id Interno</td>
						<td><input name="devolucion" type="text" size="20" /></td>
					</tr>
					
				</table>
				
				
				<div align="center">
					<input name="buscar" type="submit" value="Buscar Nota de Cr&eacute;dito" />  
				</div></td>
		</tr>
	</table>
</form>
<?php     
	if(isset($_POST['buscar'])){
		
		$devolucion = $_POST['devolucion'];						
		
		echo "<p></p>";
		
		$hrow = rfiscal::select1($devolucion);
		if(count($hrow) > 0){
			
			foreach($hrow as $hw){							
				
				//$estado_factura = $hrow['estado_factura'];
				echo "<table class='dtable' align='center' border='1'><tr>";
				echo "<td>";
				echo "<p><b>No. Id:</b> " . $hw->devolucion ."<br>".
				"<p><b>Total:</b> " . $hw->total ."<br>".
				"<p><b>Fecha:</b> " . $hw->fecha ."<br>";
				
			?>
			<input type='button' value='Reimprimir Nota de Cr&eacute;dito'  class='green' onClick="window.open('reimprimir_devolucion_pub.php?devolucion=<?=$hw->devolucion?>,'mywindow','width=1250,height=750,toolbar=yes, scrollbars=yes'); this.disabled=true; this.value='Imprimiendo…'; " />
			
			<?php  echo "</td></tr></table>";
				
			}
			}else{
			echo "Esta devolucion existe en el sistema, verifique!!";	
			
		}	
		
	}
	
	
	layout::fin_content();
?>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
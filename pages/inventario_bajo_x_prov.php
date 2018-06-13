<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/inventario_bajo_x_prov.php');
	$cont = 0;
	require_once('../modulos/layout.php');
	layout::encabezado();

	layout::menu();
	layout::ini_content();
?>
<center>   <h1>Listado de Inventario Bajo por Proveedor</h1> </center>


<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="estado" id="estado"> <tr>
	<td>
		<table class="dtable" width="510" border="1" cellspacing="0" bordercolor="#000000" align="center">
			<tr>
				<td>Proveedor:</td>
				<td><select name="proveedor" >
					<?php 
						$colsx = inventb::provee();
						foreach($colsx as $cs){
							echo '<option value="'.$cs->id_proveedor.'">'.$cs->nombre.'</option>';
						}
					?> 
				</select></td>												
			</tr></td>
	</tr>
</table>
<p></p>

<div align="center">
	
	<input name="buscar" type="submit" value="Buscar" />  
</div></td>
</tr>
</table>
</form>
<p></p>




<?php  
	
	if (isset($_GET['men'])) {
		$men = $_GET['men'];
		}else{
		$men = 0;
	}
	
	if(isset($_POST['buscar'])){
		echo "<form action='orden_automatica.php' method='post' name='orden' id='frm1'>";
		
		$proveedor = $_POST['proveedor'];
		
		//se elimino la bodega para que todas las bodegas
		$row = inventb::each1();
		
		echo "<table class='dtable' border='1' style='font-size:10px;' align='center'><tr><th>Codigo de Barra</th><th>Nombre de Art&iacute;culo</th><th>Cantidad Actual</th><th>Cantidad M&iacute;nima</br> a Pedir</th><th>Cantidad Ideal</br> a Pedir</th><th>Proveedor</th><th>Escoger Todas <input type='checkbox' name='checkall' onclick='checkedAll(frm1);'></th></tr>";
		foreach($row as $rw1){
			echo "<tr><td align='center'>".$rw1->codigo_de_barra." <input type='hidden' name='cont[]' value='".$cont."' /> </td> <input type='hidden' name='medicamento_id[]' value='".$rw1->codigo_interno."' /> ";
			echo "<td align='center'>".$rw1->medicamento_nom."</td>";
			echo "<td align='center'> <input type='text' name='cantidad' value='".$rw1->cantidad_med."' size='5' readonly /></td>";
			echo "<td align='center'> <input type='text' name='cantidad_minima' value='".$rw1->cant_max_prov."' size='5' readonly /></td>";
			echo "<td align='center'> <input type='text' name='cantidad_med[]' value='".$rw1->inve_ide."' size='5' /></td>";
			$prov = 1;
			
			$yrow = inventb::medica_provee($rw1->codigo_interno);
			foreach($yrow as $yw){
				$prov = $yw->id_proveedor;
			}
			
			echo "<td align='center'><select name='proveedor[]' id='proveedor'>";
			
			$cols = inventb::provee2();
			foreach($cols as $cs){
				echo "<option value='". $cs->id_proveedor."' ".(($cs->id_proveedor == $proveedor)?"selected":"").">".$cs->nombre."</option>";
			}
			echo "</select></td>";
			echo "<td align='center'><input type='checkbox' name='escoger[]' value ='".$cont."' /></td></tr>";
			$cont = $cont + 1;
		}				
		
		echo "</table> <p>";
		
		echo "<center><input type='submit' name='escoger_orden' value = 'Realizar Orden de Compra' disabled></center>";
		echo "</form>";
	}
?>

<?=layout::fin_content()?>
<script type="text/javascript">
	checked=false;
	function checkedAll (frm1) {
		var aa= document.getElementById('frm1');
		if (checked == false)
		{
			checked = true
		}
		else
		{
			checked = false
		}
		for (var i =0; i < aa.elements.length; i++) 
		{
			aa.elements[i].checked = checked;
		}
	}
	
	
	
	
</script>

<script type='text/javascript'>//<![CDATA[ 
	$(document).ready(function(){
		var checkboxes = $("input[type='checkbox']"),
		submitButt = $("input[type='submit']");
		
		checkboxes.click(function() {
			//alert("entro aqui");
			submitButt.attr("disabled", !checkboxes.is(":checked"));
		});
	});//]]>  
	
</script>
<?php
	session_start();
	include ('./clases/session.php');
	require_once('../modulos/descuentos_por_dia.php');
	$dia= $_GET['dia'];
	$men= $_GET['men'];
	header('Content-Type: text/html; charset=ISO-8859-1'); 
	require_once('../modulos/layout.php');
	layout::ini_indices();
?>
<html>
	<head>
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
				else if ((("0123456789").indexOf(keychar) > -1))
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
		
		<form name="contra" action="<?php $_SERVER['PHP_SELF']; ?>"  method="post" >
			<input type="hidden" name="dia" value="<?php echo $dia ?>" />
			
			
			<?php
				
				if ($men == 1) {
					
					echo "<b>Ha actualizado correctamente los grupos</b><p>";
				}
				
				echo "<table><tr><th>Escoger</th><th>Grupo</th><th>Porcentaje</th></tr>";
				
				$cols3 = dpordia::gmedica();
				foreach($cols3 as $cl3){
					
					$wrow = dpordia::gpordia($dia, $cols3['codigo_grupo']);
					
					if (count($wnum) > 0){
						$checked = 'checked';
						foreach($wrow as $wr){
							$porcent = $wr->porcentaje;
						}
						} else {
						$checked = '';
						
					}
					
					
				?>
				<input type="hidden" name="descuento_maximo[]" id="descuento_maximo" value="<?=$cl3->descuento_maximo?>" >
				<input type="hidden" name="descripcion[]" id="descripcion" value="<?=$cl3->descripcion?>" >
				
				<tr><td>
				<label><input name="codigo_grupo[]" type="checkbox" value="<?=$cl3->codigo_grupo?>" <?=$checked?>></td><td> <?=$cl3->descripcion?> </td><td><input sformat type="text" name="porcentaje[]" size="10" align="right" value="<?=$porcent?>"  onKeyPress="return numbersonly(this, event)"> % </label></td></tr> 
				<?php 	
				} 
			?> 
			</table> <p>
			<input type="submit" value="Actualizar" name="Actualizar">
			
			<?php
				
				if (isset($_POST['Actualizar'])){
					
					$dia = $_POST['dia'];
					$codigo_grupo = $_POST['codigo_grupo'];
					$porcentaje = $_POST['porcentaje'];
					$descuento_maximo = $_POST['descuento_maximo'];
					$descripcion = $_POST['descripcion'];
					
					$h = 0;
					
					for($d = 0; $d < sizeof($codigo_grupo); $d++){
						
						$j = intval($codigo_grupo[$d]);
						
						$j = $j - 1;
						
						
						
						//echo "porcentaje: ".$porcentaje[$j]." descuento maximo: ".$descuento_maximo." </br>";
						if ($porcentaje[$j] > $descuento_maximo[$j]){
							echo "<p><b>El porcentaje de ".$porcentaje[$j]." es mayor al porcentaje de ".$descuento_maximo[$j]." del grupo ".$descripcion[$j]."</b>";
							$h = 1;
						}
						
					}
					
					if($h == 0){
						
						dpordia::borra_pdia($dia);
						
						for($c = 0; $c < sizeof($codigo_grupo); $c++){
							
							$i = intval($codigo_grupo[$c]);
							
							$i = $i - 1;
							
							dpordia::guarda_pdia($codigo_grupo[$c],$dia,$porcentaje[$i],$_SESSION['MM_iduser']);
							
						}
						
						echo "<script language='javascript'>window.location='actualizar_desc_dia.php?dia=".$dia."&men=1'</script>";
						
					} 
				}
				layout::fin_indices();
			?>				
<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/enviar_int_medicamento.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
	if (isset($_POST['userid'])){
	$userid = $_POST['userid'];}
	if (isset($_POST['session'])){
	$session = $_POST['session'];}
	include('sesion_activa.php');
	error_reporting(E_ALL & ~E_NOTICE);
	if (isset($_POST['medicamento'])) { 
	$medicamento = $_POST['medicamento'];}
	if (isset($_POST['medicamento_id'])) { 
	$medicamento_id = $_POST['medicamento_id'];}
	if (isset($_POST['forma'])) { 
	$forma = $_POST['forma'];}
	if (isset($_POST['dosis'])) { 
	$dosis = $_POST['dosis'];}
	if (isset($_POST['horas'])) { 
	$horas = $_POST['horas'];}
	if (isset($_POST['dias'])) { 
	$dias = $_POST['dias'];}
	if (isset($_POST['cantidad'])) { 
	$cantidad = $_POST['cantidad'];}
	if (isset($_POST['cant'])) { 
	$cantidad_de_dosis = $_POST['cant'];}
	if (isset($_POST['cargo'])) { 
	$cargo = $_POST['cargo'];}
	if (isset($_POST['ine'])) { 
	$ine = $_POST['ine'];}
	if (isset($_POST['tratamiento'])) { 
	$tratamiento = $_POST['tratamiento'];}
	if (isset($_POST['historia'])) { 
	$historia = $_POST['historia'];}
	if (isset($_POST['razon'])) { 
	$razon = $_POST['razon'];}
	//echo "sesion ".$estado_sesion;
	if ($estado_sesion == 'A') {
	?>
	<style>
		img {
		border:0;  
		}
		
		#page {
		width:800px;
		margin:0 auto;
		padding:15px;
		
		}
		
		#logo {
		float:left;
		margin:0;
		}
		
		#address {
		height:150px;
		margin-left:300px;
		font-size:14px;
		}
		
		table {
		width:100%;
		}
		
		td {
		padding:5px;
		}
		
		tr.odd {
		background:#e1ffe1;
		}
		
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
		background-color: #0066FF;
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
	
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td width="100%"><font color="#B8C0F0" face="Arial" size="2">
				
				<p style="display:none"><a href="http://css3menu.com/">My CSS Menu Css3Menu.com</a></p>
				<!-- End css3menu.com BODY section --><ul id="css3menu1" class="topmenu">
					<li class="topfirst"><a href="historia.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>&username=<?php echo urlencode($username) ?>" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Principal</a></li>
					<li class="topmenu"><a href="historia.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>&username=<?php echo urlencode($username) ?>" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Ordenes</span></a>
						
						<li class="topmenu"><a href="devolucion.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>"><img src="default.htm_files/css3menu1/register.png" alt=""/>Devoluciones</a></li>
						<li class="topmenu"><a href="http://192.168.3.2/CMP_CONTRAINDICACIONES/_contraindicaciones.aspx?UserId=<?php echo $userid ?>&IdSession=<?php echo $session ?>&userName=<?php echo $userName ?>"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contraindicaciones</a></li>
						<li class="topmenu"><a href="estado_cargos.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>
						<li class="topmenu"><a href="interrumpir_medicamento.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Interrumpir Medicamentos</a></li>
						<li class="topmenu"><a href="salida_paciente.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Salida de Paciente</a></li>
						<li class="topmenu"><a href="perfil_farmaceutico_h.php?userid=<?php echo $userid ?>&session=<?php echo $session ?>"><img src="default.htm_files/css3menu1/register.png" alt=""/>Perfil Farmaceutico</a></li>
						<li class="toplast"><a href="http://192.168.3.2/cmp_appdosis/"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Salir</a></li>
					</ul>
					<p style="display:none"><a href="http://css3menu.com/">My CSS Menu Css3Menu.com</a></p>
					<!-- End css3menu.com BODY section -->
					
					
				</font></td>
			</tr>
		</table>
		<?php
			
			if($ine == 0){
				echo "<p></p><h2>Debe escoger un medicamento para poder interrumpirlo</h2><p></p>";
				
				echo "<a href=\"javascript:history.back()\">Volver</a>";
				
				} else {
				
				
				
				for($c = 0; $c < sizeof($ine); $c++) {
					//echo "<p>el valor de c ".$c." el valor del check ".$ine[$c]." el valor del medicamento ".$medicamento[$c];
					
					//echo "valor de int ".$ine[$c]." para el medicamento ".$medicamento[$c]."<p>";
					
					
					//echo "voy a interrumpir el medicamento ".$medicamento[$c];
					$h = $ine[$c] - 1;
					
					echo "<h2>Se ha realizado la interrupción del medicamento: ".$medicamento[$h]."</h2><p>";
					
					$ress = enviar_inm::update1( $razon[$c],$userid, $cargo ,$tratamiento,$historia,$ine[$c]);
					
					
					$resf = enviar_inm::update2( $cargo,$tratamiento,$historia,$ine[$c]);
					
					
					
				}
				
				
				$rres =enviar_inm::select1($cargo,$tratamiento,$historia)
				foreach($rres as $rrow)
				{
					$valido = $rrow->valido;
				}
				
				if ($valido == 0) {
					$tres =  enviar_inm::update3($cargo,$tratamiento,$historia);
					
					$fres = enviar_inm::update4($cargo,$historia,$tratamiento);
					
					
				}
				
				
				
				$hres = enviar_inm::select2( $cargo,$historia,$tratamiento);
				
				foreach($hres as $hrow )
				
				{
					
					$bres = enviar_inm::update5($hrow->factura);
					
					
				}
				
				echo "<p><INPUT TYPE=\"button\" id='imprimirinte' name='imprimir' value='Imprimir Interrupcion'  class = 'blue' onClick=\"window.open('imprimir_interrupcion.php?cargo=".$cargo."&historia=".$historia."&tratamiento=".$tratamiento."','mywindow','width=800,height=600');\" >";
				
				
			}
			
			
			} else {  
			echo "<script language='javascript'>window.location='http://192.168.3.2/cmp_appdosis/'</script>"; 
		} 
		
		layout::fin_content();
	?>	
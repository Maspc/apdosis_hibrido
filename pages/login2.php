<?php
	
	require_once('../modulos/login.php');
	
	// *** Validate request to login to this site.
	if (isset($_GET['men'])){
		if($_GET['men'] == 'S'){
		$men = 'Login incorrecto';}
		else if($_GET['men'] == 'T'){
			$men = 'Su sesi&oacute;n ha expirado, ha pasado mucho tiempo sin actividad en el sistema';	
		}}
		else{
			$men = ' ';
		}
		
		
		if (!isset($_SESSION)) {
			session_start();
		}
		
		$loginFormAction = $_SERVER['PHP_SELF'];
		if (isset($_GET['accesscheck'])) {
			$_SESSION['PrevUrl'] = $_GET['accesscheck'];
		}
		
		if (isset($_POST['user'])) {
			$loginUsername=$_POST['user'];
			$password=$_POST['password'];
			$caja=$_POST['caja'];
			$MM_fldUserAuthorization = "";
			$MM_redirecttoReferrer = false;
			
			$MM_redirectLoginFailed = 'login.php?men=S';
			
			
			$LoginRS = login::validaLogin($loginUsername,$password,$caja);
			
			
			if (count($LoginRS)>0) {
				$loginStrGroup = "";
				//declare two session variables and assign them
				$_SESSION['MM_iduser'] = $LoginRS[0]->user;
				$_SESSION['MM_tipo'] = $LoginRS[0]->tipo;
				$_SESSION['MM_user'] = $_POST['user'];
				$_SESSION['autentificado'] = true;
				
				if (isset($_SESSION['PrevUrl']) && false) {
					$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
				}
				if ($_SESSION['MM_tipo'] == 2) {
					header("Location: ./facturacion.php");
					} else if ($_SESSION['MM_tipo'] == 3) {
					header("Location: ./ver_devoluciones.php");
					} else if ($_SESSION['MM_tipo'] == 4) {
					header("Location: ./pago_creditos.php");
					} else if ($_SESSION['MM_tipo'] == 5) {
					header("Location: ./facturacion.php");
					} else if ($_SESSION['MM_tipo'] == 6) {
					header("Location: ./facturacion.php");
					} else if ($_SESSION['MM_tipo'] == 7) {
				header("Location: ./compras_detalle.php"); }
				else if ($_SESSION['MM_tipo'] == 8) {
					header("Location: ./facturacion.php"); 
					}  else if ($_SESSION['MM_tipo'] == 1) {
					// header("Location: ./enviar_list_facturas_f_todo_detalle.php");
					header("Location: ./facturacion.php");
				} 
			}
			else {
				header("Location: ./". $MM_redirectLoginFailed );
			}
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Formulario de Dispensación de Medicamentos</title>
		<meta name="keywords" content="business theme, biz, blue, free css template, web design, 2-column" />
		<meta name="description" content="Business Theme is a free CSS template from templatemo.com" />
		<link href="../css/templatemo_style.css" rel="stylesheet" type="text/css" />
		<script language="javascript" type="text/javascript">
			function clearText(field)
			{
				if (field.defaultValue == field.value) field.value = '';
				else if (field.value == '') field.value = field.defaultValue;
			}
		</script>
		
		<script language="javascript" type="text/javascript">
			function revisarCaja()
			{
				if (document.form1.caja.value == 100){
					alert("Debe escoger una caja para continuar!");
				return false;}
			}
		</script>
	</head>
	<body>
		
		<div id="templatemo_wrapper">
			
			<div id="templatemo_sidebar">
				
				<div id="site_title">
					<h1><img src="../images/apdosis.png" alt="logo" /> 
					</h1>
				</div> <!-- end of site_title -->
				
				<div class="sidebar_box last"><div class="sidebar_content">
				<img src="../images/98196466.jpg" width="211" height="200" /></div>
				</div>
				
			</div>
			
			<div id="templatemo_content">
				
				<div id="templatemo_menu">
					
					<div class="cleaner"></div>
				</div> <!-- end of templatemo_menu -->
				
				<div class="content_box">
					
					<h2>Acceso</h2>
					<div class="content_box_inner"><form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>" >
						<div align="center">
							<table width="200" border="0" align="center">
								<tr>
									<td>Usuario:</td>
									<td><label>
										<input type="text" name="user" id="user" />
									</label></td>
								</tr>
								<tr>
									<td>Contraseña:</td>
									<td><label>
										<input type="password" name="password" id="password" />
									</label></td>
								</tr>
								
								<tr><td>Caja:</td>
									<td>
										<select name="caja" id="caja">
											<option value='100'>Seleccione...</option>
											<?php
												$cajas = login::cajas();
												foreach($cajas as $cj){
													echo '<option value="'.$cj->caja_id.'">'.$cj->nombre.'</option>';
												}
											?>
										</select>
									</td>
								</tr>
								
							</table>
							<p>&nbsp;</p>
						</div>
						<p align="center">
							<label>
								<center><input type="submit" name="button" id="button" value="Acceder" onClick="return revisarCaja();"/></center>
							</label>
							
							
						</p>
						
						<p>&nbsp;</p>
						
						<?php echo "<center>".$men."</center>";   ?>
					</form>
					
					
					<div class="btn_more image_fr"></div>
					
					<div class="cleaner">
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
					</div>
					</div>
					
				</div>
				
			</div>
			<div class="cleaner"></div>    
		</div>
		
		<div id="templatemo_footer_wrapper">
			<div id="templatemo_footer">MASPC</div> 
			<!-- end of templatemo_footer -->
		</div>
		
	</body>
</html>
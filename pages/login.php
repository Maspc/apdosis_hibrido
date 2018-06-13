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
			
			
			$LoginRS = login::validaLogin($loginUsername,$password);
			
			
			if (count($LoginRS)>0) {
				$loginStrGroup = "";
				//declare two session variables and assign them
				$_SESSION['MM_iduser'] = $LoginRS[0]->user;
				$_SESSION['MM_tipo'] = $LoginRS[0]->tipo;
				$_SESSION['MM_nombre'] = $LoginRS[0]->nombre;
				$_SESSION['MM_user'] = $_POST['user'];
				$_SESSION['autentificado'] = true;
				
				if (isset($_SESSION['PrevUrl']) && false) {
					$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
				}
				if (isset($_SESSION['PrevUrl']) && false) {
					$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
				}
				if ($_SESSION['MM_tipo'] == 2) {
					header("Location: cargos_pen.php");
					} else if ($_SESSION['MM_tipo'] == 3) {
					header("Location: ver_devoluciones.php");
					} else if ($_SESSION['MM_tipo'] == 4) {
					header("Location: facturas_paciente.php");
					} else if ($_SESSION['MM_tipo'] == 5) {
					header("Location: cargos_pen.php");
					} else if ($_SESSION['MM_tipo'] == 6) {
					header("Location: cierre_carro_hospital.php");
					} else if ($_SESSION['MM_tipo'] == 7) {
				header("Location: cargos_pen.php"); }
				else if ($_SESSION['MM_tipo'] == 8) {
					header("Location: cargos_pen.php"); 
					}  	 else if ($_SESSION['MM_tipo'] == 9) {
					header("Location: cargos_pen.php"); 
					}  	 else if ($_SESSION['MM_tipo'] == 10) {
					header("Location: cierre_carro_hospital.php");
					} 	 else if ($_SESSION['MM_tipo'] == 11) {
					header("Location: compras_detalle.php");
					} 	 else if ($_SESSION['MM_tipo'] == 12) {
					header("Location: consulta_medicamentos.php");
					} else if ($_SESSION['MM_tipo'] == 1) {
					// header("Location: enviar_list_facturas_f_todo_detalle.php");
					header("Location: cargos_pen.php");
				}
			}
			else {
				header("Location: ./". $MM_redirectLoginFailed );
			}
		}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Formulario de Dispensación de Medicamentos</title>
		
		<!-- Bootstrap -->
		<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
		<!-- Animate.css -->
		<link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
		
		<!-- Custom Theme Style -->
		<link href="../build/css/custom.min.css" rel="stylesheet">
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
	
	<body class="login">
		<div>
			<a class="hiddenanchor" id="signup"></a>
			<a class="hiddenanchor" id="signin"></a>
			
			<div class="login_wrapper">
				<div class="animate form login_form">
					<section class="login_content">
						<form id="form1" name="form1" method="POST" action="<?=$loginFormAction?>">
							<h1>Login Form</h1>
							<div>
								<input type="text" name="user" id="user" class="form-control" placeholder="Username" required="" />
							</div>
							<div>
								<input type="password" name="password" id="password" class="form-control" placeholder="Password" required="" />
							</div>
							<!--div>
								<select class="form-control" name="caja" id="caja">
								<option value='100'>Seleccione...</option>
								<?php
									$cajas = login::cajas();
									foreach($cajas as $cj){
										echo '<option value="'.$cj->caja_id.'">'.$cj->nombre.'</option>';
									}
								?>
								</select>
							</div-->
							<br>
							<div>
								<input type="submit" class="btn btn-default submit" name="button" id="button" value="Acceder" onClick="return revisarCaja();"/>
								<a class="reset_pass" href="#">Lost your password?</a>
							</div>
							
							<div class="clearfix"></div>
							
							<div class="separator">
								<br />
								
								<div>
								<h1></i><img style="width: 70%" src="../images/apdosis.png"> Farmacia</h1>
								<p><?=$men?></p>
							</div>
						</div>
					</form>
				</section>
			</div>				
			
		</div>
	</div>
</body>
</html>
<?php
	session_start();
	include ('../clases/session.php'); 
	
	class layout{
		
		public static function encabezado() {
			$reg ='<!DOCTYPE html>';
			$reg .='<html lang="en">';
			$reg .='<head>';
			$reg .='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
			$reg .='<meta charset="utf-8">';
			$reg .='<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			$reg .='<meta name="viewport" content="width=device-width, initial-scale=1">';
			
			$reg .='<title>Apdosis</title>';
			
			/* Bootstrap */
			$reg .='<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">';
			/* Font Awesome */
			$reg .='<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">';
			/* NProgress */
			$reg .='<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">';
			/* iCheck */
			$reg .='<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">';
			
			/* bootstrap-progressbar */
			$reg .='<link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">';
			/* JQVMap */
			$reg .='<link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>';
			/* bootstrap-daterangepicker */
			$reg .='<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">';
			
			/* Custom Theme Style */
			$reg .='<link href="../build/css/custom.min.css" rel="stylesheet">';
			
			/* Datatables */
			$reg .='<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">';
			$reg .='<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">';
			$reg .='<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">';
			$reg .='<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">';
			$reg .='<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">';
			
			/* Otros Componentes*/
			//$reg .='<script src="../vendors/jquery/dist/jquery.min.js"></script>';
			/*$reg .='<script language="javascript" type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>';
				$reg .='<script language="javascript" type="text/javascript" src="../js/jquery.validate.1.5.2.js"></script>';
				$reg .='<script type="text/javascript" src="../js/jquery.validate.min"></script>';
				$reg .='<script language="javascript" type="text/javascript" src="../js/script.js?r='.rand().'"></script>';
				$reg .='<script type="text/javascript" src="../lib/jquery.bgiframe.min.js"></script>';
				$reg .='<script type="text/javascript" src="../lib/jquery.ajaxQueue.js"></script>';
				$reg .='<script type="text/javascript" src="../lib/thickbox-compressed.js"></script>';
				$reg .='<script type="text/javascript" src="../js/jquery.autocomplete.js"></script>';
				$reg .='<script type="text/javascript" src="../js/localdata.js"></script>';
				$reg .='<link rel="stylesheet" type="text/css" href="../css/jquery.autocomplete.css" />';
			$reg .='<link rel="stylesheet" type="text/css" href="../lib/thickbox.css" />';*/
			
			$reg .='<script src="../src/js/jscal2.js"></script>';
			$reg .='<script src="../src/js/lang/es.js"></script>';
			$reg .='<link rel="stylesheet" type="text/css" href="../src/css/jscal2.css" />';
			$reg .='<link rel="stylesheet" type="text/css" href="../src/css/border-radius.css" />';
			$reg .='<link rel="stylesheet" type="text/css" href="../src/css/steel/steel.css" />';
			
			/*$reg .='<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">';
				$reg .='<link rel="stylesheet" href="/resources/demos/style.css">';
				$reg .='<script src="https://code.jquery.com/jquery-1.12.4.js"></script>';
			$reg .='<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';*/
			
			$reg .='</head>';
			
			$reg .='<body class="nav-md">';
			$reg .='<div class="container body">';
			$reg .='<div class="main_container">';
			$reg .='<div class="col-md-3 left_col">';
			$reg .='<div class="left_col scroll-view">';
			$reg .='<div class="navbar nav_title" style="border: 0;">';
			$reg .='<a href="#" onclick="window.location.reload()" class="site_title"><span><img style="width: 95%" src="../images/apdosis.png"></span></a>';
			$reg .='</div>';
			
			$reg .='<div class="clearfix"></div>';
			
			/* menu profile quick info */
			$reg .='<div class="profile clearfix">';
			$reg .='<div class="profile_pic">';
			$reg .='<img src="../images/user.png" alt="..." class="img-circle profile_img">';
			$reg .='</div>';
			$reg .='<div class="profile_info">';
			$reg .='<span>Bienvenido,</span>';
			$reg .='<h2>'.$_SESSION['MM_iduser'].'</h2>';
			$reg .='</div>';
			$reg .='</div>';
			/* /menu profile quick info */
			
			$reg .='<br />';
			
			
			echo $reg;
		}
		
		public static function menu() {
			/*if (isset($_SESSION['MM_user'])){
			$username = $_SESSION['MM_user'];}
			else {
				$username=' ';
			}
			
			if (isset($_SESSION['MM_iduser'])){
			$userid = $_SESSION['MM_iduser'];}
			
			if (isset($_GET['session'])){
			$session = $_GET['session'];}
			
			if (isset($_GET['usu_crea'])){
			$usu_crea = $_GET['usu_crea'];}
			
			if (isset($_GET['historia'])){
			$historia = $_GET['historia'];}*/			
			
			$reg ='<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">';
			$reg .='<div class="menu_section">';
			$reg .='<h3>General</h3>';
			
			
			$reg .='<ul class="nav side-menu">';
			
			$reg .='<li><a href="historia.php?userid='.$UserId.'&session='.$IdSession.'&username='.urlencode($userName).'"><i class="fa fa-home"></i>Principal</a></li>';
			$reg .='<li><a href="historia.php?userid='.$UserId.'&session='.$IdSession.'&username='.urlencode($userName).'"><span><i class="fa fa-cart-plus"></i>Ordenes</span></a></li>';
			$reg .='<li><a href="devolucion.php?userid='.$UserId.'&session='.$IdSession.'"><i class="fa fa-archive"></i>Devoluciones</a></li>';
			$reg .='<li><a href="http://192.168.3.2/CMP_CONTRAINDICACIONES/_contraindicaciones.aspx?UserId='.$UserId.'&IdSession='.$IdSession.'&userName='.$userName.'"><i class="fa fa-check"></i>Contraindicaciones</a></li>';
			$reg .='<li><a href="estado_cargos.php?userid='.$UserId.'&session='.$IdSession.'"><i class="fa fa-check"></i>Estado de Ordenes</a></li>';
			$reg .='<li><a href="interrumpir_medicamento.php?userid='.$UserId.'&session='.$IdSession.'"><i class="fa fa-check"></i>Interrumpir Medicamentos</a></li>';
			$reg .='<li><a href="salida_paciente.php?userid='.$UserId.'&session='.$IdSession.'"><i class="fa fa-check"></i>Salida de Paciente</a></li>';
			$reg .='<li><a href="perfil_farmaceutico_h.php?userid='.$UserId.'&session='.$IdSession.'"><i class="fa fa-archive"></i>Perfil Farmaceutico</a></li>';
			$reg .='<li><a href="sugerencias.php?userid='.$UserId.'&session='.$IdSession.'"><i class="fa fa-archive"></i>Sugerencias</a></li>';
			$reg .='<li><a href="imprimir_inv_hosp.php"><i class="fa fa-cart-plus"></i>Listado de Medicamentos</a></li>';
			
			$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
			
			$reg .='</ul>';
			
			$reg .='</div>';
			
			$reg .='</div>';													
			
			echo $reg;
		}
		
		public static function ini_content() {
			$reg .='</div>';
			$reg .='</div>';
			
			/* top navigation */
			$reg .='<div class="top_nav">';
			$reg .='<div class="nav_menu">';
			$reg .='<nav>';
			$reg .='<div class="nav toggle">';
			$reg .='<a id="menu_toggle"><i class="fa fa-bars"></i></a>';
			$reg .='</div>';
			
			$reg .='<ul class="nav navbar-nav navbar-right">';
			$reg .='<li class="">';
			$reg .='<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
			$reg .= $_SESSION['MM_nombre'];
			$reg .='<span class=" fa fa-angle-down"></span>';
			$reg .='</a>';
			$reg .='<ul class="dropdown-menu dropdown-usermenu pull-right">';
			$reg .='<li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>';
			$reg .='</ul>';
			$reg .='</li>';
			$reg .='</ul>';
			$reg .='</nav>';
			$reg .='</div>';
			$reg .='</div>';
			/* /top navigation */
			
			/* page content */
			$reg .='<div class="right_col" role="main">';
			echo $reg;
		}
		
		public static function fin_content() {
			$reg .='</div>';
			/* /page content */
			$reg .='<footer>';
			$reg .='<div class="pull-right">';
			
			$reg .='</div>';
			$reg .='<div class="clearfix"></div>';
			$reg .='</footer>';
			$reg .='</div>';
			$reg .='</div>';
			
			/* jQuery */
			$reg .='<script src="../vendors/jquery/dist/jquery.min.js"></script>';
			
			/* Bootstrap */
			$reg .='<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>';
			/* FastClick */
			$reg .='<script src="../vendors/fastclick/lib/fastclick.js"></script>';
			/* NProgress */
			$reg .='<script src="../vendors/nprogress/nprogress.js"></script>';
			/* Chart.js */
			$reg .='<script src="../vendors/Chart.js/dist/Chart.min.js"></script>';
			/* gauge.js */
			$reg .='<script src="../vendors/gauge.js/dist/gauge.min.js"></script>';
			/* bootstrap-progressbar */
			$reg .='<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>';
			/* iCheck */
			$reg .='<script src="../vendors/iCheck/icheck.min.js"></script>';
			/* Skycons */
			$reg .='<script src="../vendors/skycons/skycons.js"></script>';
			/* Flot */
			$reg .='<script src="../vendors/Flot/jquery.flot.js"></script>';
			$reg .='<script src="../vendors/Flot/jquery.flot.pie.js"></script>';
			$reg .='<script src="../vendors/Flot/jquery.flot.time.js"></script>';
			$reg .='<script src="../vendors/Flot/jquery.flot.stack.js"></script>';
			$reg .='<script src="../vendors/Flot/jquery.flot.resize.js"></script>';
			/* Flot plugins */
			$reg .='<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>';
			$reg .='<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>';
			$reg .='<script src="../vendors/flot.curvedlines/curvedLines.js"></script>';
			/* DateJS */
			$reg .='<script src="../vendors/DateJS/build/date.js"></script>';
			/* JQVMap */
			$reg .='<script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>';
			$reg .='<script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>';
			$reg .='<script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>';
			/* bootstrap-daterangepicker */
			$reg .='<script src="../vendors/moment/min/moment.min.js"></script>';
			$reg .='<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>';
			
			/* Custom Theme Scripts */
			$reg .='<script src="../build/js/custom.min.js"></script>';
			
			//Autocomplete
			$reg .='<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>';
			
			/*Datatbles*/
			$reg .='<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>';
			$reg .='<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>';
			$reg .='<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>';
			$reg .='<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>';
			$reg .='<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>';
			$reg .='<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>';
			$reg .='<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>';
			$reg .='<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>';
			$reg .='<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>';
			$reg .='<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>';
			$reg .='<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>';
			$reg .='<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>';
			$reg .='<script src="../vendors/jszip/dist/jszip.min.js"></script>';
			$reg .='<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>';
			$reg .='<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>';
			
			/*validator*/
			//$reg .='<script src="../vendors/validator/validator.js"></script>';
			
			/*Otros componentes*/
			$reg .='<script src="../js/funciones.js"></script>';
			
			
			$reg .='</body>';
			$reg .='</html>';
			echo $reg;
		}
		
		public static function ini_indices() {
			$reg ='<!DOCTYPE html>';
			$reg .='<html lang="en">';
			$reg .='<head>';
			$reg .='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
			$reg .='<meta charset="utf-8">';
			$reg .='<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			$reg .='<meta name="viewport" content="width=device-width, initial-scale=1">';
			
			$reg .='<title>Apdosis</title>';
			
			/* Bootstrap */
			$reg .='<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">';
			/* Font Awesome */
			$reg .='<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">';
			/* NProgress */
			$reg .='<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">';
			/* iCheck */
			$reg .='<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">';
			
			/* bootstrap-progressbar */
			$reg .='<link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">';
			/* JQVMap */
			$reg .='<link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>';
			/* bootstrap-daterangepicker */
			$reg .='<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">';
			
			/* Custom Theme Style */
			$reg .='<link href="../build/css/custom.min.css" rel="stylesheet">';
			
			/* Datatables */
			/*$reg .='<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">';
				$reg .='<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">';
				$reg .='<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">';
				$reg .='<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">';
				$reg .='<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">';
				
			/* Otros Componentes*/
			//$reg .='<script src="../vendors/jquery/dist/jquery.min.js"></script>';
			/*$reg .='<script language="javascript" type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>';
				$reg .='<script language="javascript" type="text/javascript" src="../js/jquery.validate.1.5.2.js"></script>';
				$reg .='<script type="text/javascript" src="../js/jquery.validate.min"></script>';
				$reg .='<script language="javascript" type="text/javascript" src="../js/script.js?r='.rand().'"></script>';
				$reg .='<script type="text/javascript" src="../lib/jquery.bgiframe.min.js"></script>';
				$reg .='<script type="text/javascript" src="../lib/jquery.ajaxQueue.js"></script>';
				$reg .='<script type="text/javascript" src="../lib/thickbox-compressed.js"></script>';
				$reg .='<script type="text/javascript" src="../js/jquery.autocomplete.js"></script>';
				$reg .='<script type="text/javascript" src="../js/localdata.js"></script>';
				$reg .='<link rel="stylesheet" type="text/css" href="../css/jquery.autocomplete.css" />';
			$reg .='<link rel="stylesheet" type="text/css" href="../lib/thickbox.css" />';*/
			
			$reg .='<script src="../src/js/jscal2.js"></script>';
			$reg .='<script src="../src/js/lang/es.js"></script>';
			$reg .='<link rel="stylesheet" type="text/css" href="../src/css/jscal2.css" />';
			$reg .='<link rel="stylesheet" type="text/css" href="../src/css/border-radius.css" />';
			$reg .='<link rel="stylesheet" type="text/css" href="../src/css/steel/steel.css" />';
			
			$reg .='<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">';
			$reg .='<link rel="stylesheet" href="/resources/demos/style.css">';
			$reg .='<script src="https://code.jquery.com/jquery-1.12.4.js"></script>';
			$reg .='<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';
			
			$reg .='</head>';
			
			$reg .='<body>';
			$reg .='<div class="container body">';
			$reg .='<div class="main_container">';
			$reg .='<div class="right_col">';
			
			echo $reg;		
			
		}
		
		public static function fin_indices() {
			
			$reg ='</div>';
			$reg .='</div>';
			$reg .='</div>';
			
			/* jQuery */
			$reg .='<script src="../vendors/jquery/dist/jquery.min.js"></script>';
			/* Bootstrap */
			$reg .='<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>';
			/* FastClick */
			$reg .='<script src="../vendors/fastclick/lib/fastclick.js"></script>';
			/* NProgress */
			$reg .='<script src="../vendors/nprogress/nprogress.js"></script>';
			/* Chart.js */
			$reg .='<script src="../vendors/Chart.js/dist/Chart.min.js"></script>';
			/* gauge.js */
			$reg .='<script src="../vendors/gauge.js/dist/gauge.min.js"></script>';
			/* bootstrap-progressbar */
			$reg .='<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>';
			/* iCheck */
			$reg .='<script src="../vendors/iCheck/icheck.min.js"></script>';
			/* Skycons */
			$reg .='<script src="../vendors/skycons/skycons.js"></script>';
			/* Flot */
			$reg .='<script src="../vendors/Flot/jquery.flot.js"></script>';
			$reg .='<script src="../vendors/Flot/jquery.flot.pie.js"></script>';
			$reg .='<script src="../vendors/Flot/jquery.flot.time.js"></script>';
			$reg .='<script src="../vendors/Flot/jquery.flot.stack.js"></script>';
			$reg .='<script src="../vendors/Flot/jquery.flot.resize.js"></script>';
			/* Flot plugins */
			$reg .='<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>';
			$reg .='<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>';
			$reg .='<script src="../vendors/flot.curvedlines/curvedLines.js"></script>';
			/* DateJS */
			$reg .='<script src="../vendors/DateJS/build/date.js"></script>';
			/* JQVMap */
			$reg .='<script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>';
			$reg .='<script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>';
			$reg .='<script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>';
			/* bootstrap-daterangepicker */
			$reg .='<script src="../vendors/moment/min/moment.min.js"></script>';
			$reg .='<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>';
			
			//Autocomplete
			$reg .='<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>';
			
			/* Custom Theme Scripts */
			$reg .='<script src="../build/js/custom.min.js"></script>';			
			
			/*Datatbles*/
			/*$reg .='<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>';
				$reg .='<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>';
				$reg .='<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>';
				$reg .='<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>';
				$reg .='<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>';
				$reg .='<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>';
				
			/*Otros componentes*/
			$reg .='<script src="../js/funciones.js"></script>';
			
			
			$reg .='</body>';
			$reg .='</html>';
			echo $reg;
		}
		
	}
	
?>		
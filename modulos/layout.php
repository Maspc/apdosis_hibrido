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
			
			require_once('../modulos/menu1.php');
			
			$res = menu::select1();
			foreach($res as $row){
				$estado = $row->estado;
			}
			
			$reg ='<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">';
			$reg .='<div class="menu_section">';
			$reg .='<h3>General</h3>';
			
			
			if ($_SESSION['MM_tipo'] == 2) {
				$reg .='<ul class="nav side-menu">';
				if($estado != 'S'){ 
					$reg .='<li><a 
					href="cierre_carro_hospital.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
					} else {	
					$reg .='<li><a href="cierre_carro_hospital_cierre.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
				} 
				$reg .='<li><a href="falta_FA.php"><span><i class="fa fa-check"></i>Reenvio a Hospital</span></a>';
				if($estado != 'S'){ 
					$reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
					} else {	
					$reg .='<li><a href="ver_devoluciones_cierre.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
				} 
				$reg .='<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>';
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Insumos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>';
				$reg .='<li><a href="editar_insumo_us.php">Editar Insumos</a></li>';
				$reg .='<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>';	
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Parametros</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
				$reg .='<li><a href="principios_activos.php">Principios Activos</a></li>';		
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Cargos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cargos_pen.php"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
				$reg .='<li><a href="prep_pen.php"><img src="default.htm_files/css3menu1/home.png" alt=""/> Preparaciones Pendientes</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_inac.php"><i class="fa fa-cart-plus"></i>Consulta Historias Inactivas</span></a></li>';
				$reg .='<li><a href="reimprimir_cargos.php"><i class="fa fa-check"></i>Reimprimir Cargos</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_fa.php"><i class="fa fa-check"></i>Búsqueda por FU</a></li>';
				$reg .='<li><a href="estado_cargosf.php"><i class="fa fa-check"></i>Estado de Ordenes</a></li>';
				$reg .='<li><a href="liberar_cargos.php"><i class="fa fa-check"></i>Liberar Cargo</a></li>';
				$reg .='<li><a href="reactivar_paciente.php"><i class="fa fa-check"></i>Reactivar Pacientes</a></li>';
				$reg .='<li><a href="facturacion_cargos.php"><i class="fa fa-check"></i>Cargos Manuales';
				$reg .='<li><a href="devolucion_pub_manual.php"><i class="fa fa-check"></i>N/C Manuales</a></li>';
				$reg .='</a></li>';	
				$reg .='</ul></li>';	
				
				
				$reg .='<li><a href="#"><span><i class="fa fa-cart-plus"></i>Naves</span></a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
				$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
				$reg .='<li><a href="reimprimir_banco.php">Reimprimir Banco</a></li>';
				$reg .='<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Medicamentos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
				$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
				$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
				$reg .='</ul></li>';
				
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Inventario</a>';
				$reg .='<ul class="nav child_menu"><li class="subfirst"><a href="editar_medicamentos_estado.php">Inactivar / Borrar Medicamentos</a></li>';
				$reg .='<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>';	
				$reg .='<li><a href="ajustes_inventario.php">Ajustes a Inventario</a></li>';
				$reg .='<li><a href="editar_medicamentos_lotes.php">Ajustes a Lotes</a></li>';		
				$reg .='</ul></li>';
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Contabilidad</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
				$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>'; 
				$reg .='<li class="subfirst"><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Reportes</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>';
				$reg .='<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li>';
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';		
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				$reg .='</ul>';
				} else if ($_SESSION['MM_tipo'] == 5) { 
				$reg .='<ul class="nav side-menu">';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Cargos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cargos_pen.php"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
				$reg .='<li><a href="reimprimir_cargos.php"><i class="fa fa-check"></i>Reimprimir Cargos</a></li>';
				$reg .='<li><a href="estado_cargosf.php"><i class="fa fa-check"></i>Estado de Ordenes</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_inac.php"><i class="fa fa-cart-plus"></i>Consulta Historias Inactivas</span></a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';			
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Medicamentos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
				$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
				$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
				$reg .='</ul></li>';		
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';	
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				$reg .='</ul>';
				} else  if ($_SESSION['MM_tipo'] == 3) { 
				$reg .='<ul class="nav child_menu">';
				if($estado != 'S'){ 
					$reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
					} else {	
					$reg .='<li><a href="ver_devoluciones_cierre.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
				} 
				$reg .='<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Cargos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cargos_pen.php"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
				$reg .='<li><a href="reimprimir_cargos.php"><i class="fa fa-check"></i>Reimprimir Cargos</a></li>';
				$reg .='<li><a href="estado_cargosf.php"><i class="fa fa-check"></i>Estado de Ordenes</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_inac.php"><i class="fa fa-cart-plus"></i>Consulta Historias Inactivas</span></a></li>';
				
				$reg .='</ul></li>';	
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Medicamentos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
				$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
				$reg .='</ul></li>';	
				$reg .='<li><a href="#"><span><i class="fa fa-cart-plus"></i>Naves</span></a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
				$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
				$reg .='<li><a href="reimprimir_banco.php">Reimprimir Bancos</a></li>';
				$reg .='<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>';
				$reg .='</ul></li>';				
				$reg .='<li><a href="#"><span><i class="fa fa-cart-plus"></i>Naves</span></a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
				$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Compras</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="orden_compras_detalle.php">Pedidos Manuales</a></li>';
				$reg .='<li><a href="inventario_bajo.php">Pedidos Automáticos</a></li>';
				$reg .='<li><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>';
				$reg .='<li><a href="procesar_compra_credito.php">Nota de Crédito Pendiente</a></li>';
				$reg .='<li><a href="anular_orden_compra.php">Anular Pedido</a></li>';
				$reg .='<li><a href="caja_menuda.php">Recibos de Caja</a></li>';
				$reg .='</ul>';
				$reg .='</li>';				
				/*	$reg .='<li class="toplast"><a href="#"><i class="fa fa-cart-plus"></i>Inventario</a>';
					$reg .='<ul class="nav child_menu">';
					$reg .='<li class="subfirst"><a href="imprimir_med.php">Listado de Medicamentos</a></li>';
					$reg .='<li><a href="inventario_x_bodega.php">Inventario por Bodega</a></li>';
					$reg .='<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>';
					$reg .='<li><a href="imprimir_inv.php">Inventario Total de Medicamentos</a></li>';
					$reg .='<li><a href="imprimir_pre.php">Precios de Medicamentos</a></li>';
					$reg .='</ul>'; 
				</li>'; */
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';	
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				$reg .='</ul>';
				
				} else  if ($_SESSION['MM_tipo'] == 4) {   
				$reg .='<ul class="nav side-menu">';
				$reg .='<li><a href="facturas_paciente.php"><img src="default.htm_files/css3menu1/home.png" alt=""/> Facturas por Paciente</a></li>';
				
				if($estado != 'S'){ 
					$reg .='<li><a href="cierre_carro_hospital.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
					} else {	
					$reg .='<li><a href="cierre_carro_hospital_cierre.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
				} 
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';	
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				
				$reg .='</ul>';
				} else  if ($_SESSION['MM_tipo'] == 1) {  
				$reg .='<ul class="nav side-menu">';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>P&uacute;blico</a>';
				$reg .='<ul class="nav child_menu">';
				
				$reg .='<li class="subfirst"><a href="facturacion.php"><span><i class="fa fa-cart-plus"></i>Facturaci&oacute;n</a></li>';
				$reg .='<li><a href="agregar_clientes.php"><span><i class="fa fa-cart-plus"></i>Agregar Clientes</a></li>';
				$reg .='<li><a href="facturacion_credito.php"><span><i class="fa fa-cart-plus"></i>Pagos a Cr&eacute;dito</a></li>';
				$reg .='<li><a href="cotizacion.php"><span><i class="fa fa-cart-plus"></i>Cotizaci&oacute;n</a></li>';
				$reg .='<li><a href="devolucion_pub.php"><span><i class="fa fa-cart-plus"></i>Devolucion</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				
				/*	reg .='<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>';
				reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li> */
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				
				$reg .='<li><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				
				
				$reg .='<li><a href="factura_diaria.php"><i class="fa fa-check"></i>Facturas Diarias</a></li>';
				$reg .='<li><a href="falta_FA.php"><span><i class="fa fa-check"></i>Reenvio a Hospital</span></a>';
				
				$reg .='<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>';
				if($estado != 'S'){ 
					$reg .='<li class="tomenu"><a href="cierre_carro_hospital.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
					} else {	
					$reg .='<li><a href="cierre_carro_hospital_cierre.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
				} 
				if($estado != 'S'){ 
					$reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
					} else {	
					$reg .='<li><a href="ver_devoluciones_cierre.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
				} 
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Cargos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cargos_pen.php"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
				$reg .='<li><a href="prep_pen.php"><img src="default.htm_files/css3menu1/home.png" alt=""/> Preparaciones Pendientes</a></li>';
				$reg .='<li><a href="reimprimir_cargos.php"><i class="fa fa-check"></i>Reimprimir Cargos</a></li>';
				$reg .='<li><a href="estado_cargosatc_f.php"><i class="fa fa-check"></i>Estado de Ordenes</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_fa.php"><i class="fa fa-check"></i>Búsqueda por FU</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_inac.php"><i class="fa fa-cart-plus"></i>Consulta Historias Inactivas</span></a></li>';
				$reg .='<li><a href="liberar_cargos.php"><i class="fa fa-check"></i>Liberar Cargo</a></li>';
				$reg .='<li><a href="liberar_historia.php"><i class="fa fa-check"></i>Liberar Historia</a></li>';
				$reg .='<li><a href="reactivar_paciente.php"><i class="fa fa-check"></i>Reactivar Pacientes</span></a></li>';
				$reg .='<li><a href="facturacion_cargos.php"><i class="fa fa-check"></i>Cargos Manuales</a></li>';
				$reg .='<li><a href="devolucion_pub_manual.php"><i class="fa fa-check"></i>N/C Manuales</a></li>';
				$reg .='</ul></li>';	
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Usuarios</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="usuarios.php"><i class="fa fa-check"></i>Creación de Usuarios</a></li>';
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';	
				$reg .='<li><a href="usuarios_editar.php"><span><i class="fa fa-check"></i>Editar Usuarios</span></a></li>';	
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Art&iacute;culos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
				$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
				$reg .='<li ><a href="agregar_insumos.php">Agregar Productos</a></li>';
				$reg .='<li><a href="editar_insumo_us.php">Editar Productos</a></li>';
				$reg .='<li><a href="editar_medicamentos_cb.php">Imprimir Label Producto</a></li>';
				$reg .='<li><a href="editar_medicamentos_cba.php">Imprimir Label Precio</a></li>';
				/* <li><a href="editar_costo_insumo.php">Costo por Grupo</a></li>'; */
				$reg .='</ul></li>';	
				
				$reg .='<li><a href="#"><span><i class="fa fa-cart-plus"></i>Naves</span></a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
				$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
				$reg .='<li><a href="reimprimir_banco.php">Reimprimir Bancos</a></li>';
				$reg .='<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>';
				
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Parametros</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="formas_farma.php">Formas Farmaceuticas</a></li>';
				$reg .='<li><a href="contraindica.php">Contraindicaciones</a></li>';
				/*	<li><a href="fabricantes.php">Fabricantes</a></li>'; */
				$reg .='<li><a href="posologias.php">Concentracion</a></li>';
				$reg .='<li><a href="principios_activos.php">Principios Activos</a></li>';
				$reg .='<li><a href="bancos.php">Bancos</a></li>';
				$reg .='<li><a href="proveedores.php">Proveedores</a></li>';
				$reg .='<li><a href="proveedores_caja.php">Proveedores de Caja</a></li>';
				$reg .='<li><a href="presentacion.php">Presentaciones</a></li>';
				$reg .='<li><a href="editar_costo_insumo_pub.php">Parametros por Grupo</a></li>';
				$reg .='<li><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
				$reg .='<li><a href="aseguradora.php">Aseguradoras</a></li>';
				/*	<li><a href="param_carros.php">Horas de Naves</a></li>'; !*/
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Insumos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>';
				$reg .='<li><a href="editar_insumo_us.php">Editar Insumos</a></li>';
				$reg .='<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>';	
				$reg .='<li><a href="editar_costo_insumo.php">Costo por Grupo</a></li>';
				$reg .='</ul>';
				$reg .='</li>';	
				
				
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Compras</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="orden_compras_detalle.php">Pedidos Manuales</a></li>';
				$reg .='<li><a href="inventario_bajo.php">Pedidos Automáticos</a></li>';
				$reg .='<li><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>';
				$reg .='<li><a href="procesar_compra_credito.php">Nota de Crédito Pendiente</a></li>';
				$reg .='<li><a href="anular_orden_compra.php">Anular Pedido</a></li>';
				$reg .='<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>';
				$reg .='<li><a href="reimprimir_compra_r.php">Reimprimir Compra (Ingreso de Mercancía)</a></li>';
				$reg .='<li><a href="imprimir_med_pend_compra.php">Listado de Medicamentos Pendiente en O/C</a></li>';
				$reg .='<li><a href="caja_menuda.php">Recibos de Caja</a></li>';
				$reg .='<li><a href="reporte_caja.php">Reporte de Caja</a></li>';
				$reg .='<li><a href="cierre_caja.php">Cierre de Caja</a></li>';
				$reg .='</ul>';
				$reg .='</li>';	
				
				
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Inventario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="editar_medicamentos_estado.php">Inactivar / Borrar Medicamentos</a></li>';
				$reg .='<li><a href="inventario_x_bodega.php">Inventario por Bodega</a></li>';
				$reg .='<li><a href="editar_inventario_bodega.php">Editar Inventario por Bodega</a></li>';
				$reg .='<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>';		
				$reg .='<li><a href="imprimir_inv.php" target="_blank">Inventario Total de Medicamentos</a></li>';
				/* <li><a href="imprimir_inv_costo.php" target="_blank">Inventario y Costo Total de Medicamentos</a></li>'; */
				$reg .='<li><a href="imprimir_inv_costo_xls.php" target="_blank">Inventario y Costo Total de Medicamentos XLS</a></li>';
				$reg .='<li><a href="editar_medicamentos_inv.php">Editar Precio</a></li>';
				/*	<li><a href="ajustes_inventario.php">Ajustes a Inventario</a></li>'; */
				$reg .='<li><a href="orden_compras_detalle_ext.php">Solicitar Mercanc&iacute;a Bodegas Externas</a></li>'; 
				$reg .='<li><a href="orden_pen.php">Ordenes a Procesar Externas</a></li>'; 
				$reg .='<li><a href="editar_medicamentos_lotes.php">Ajustes a Lotes</a></li>';
				$reg .='<li><a href="traslado_detalle.php">Traslado entre Bodegas</a></li>';
				$reg .='<li><a href="traslado_ins_med.php">Traslado de Insumos a Medicamentos</a></li>';
				$reg .='<li><a href="traslado_med_ins.php">Traslado de Medicamentos a Insumos</a></li>';
				$reg .='<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>';
				
				
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Conteo F&iacute;sico</a>';
				$reg .='<ul class="nav child_menu">';
				/*  $reg .='<li class="subfirst"><a href="apertura_cierre_anaquel.php">Conteo de Anaqueles</a></li>'; */
				$reg .='<li><a href="conteo_inventario.php">Conteo de Inventario</a></li>';
				$reg .='<li><a href="imprimir_conteo_xls.php">Reporte por Anaquel</a></li>';
				$reg .='<li><a href="imprimir_conteo_sum_xls.php">Reporte por Producto</a></li>';
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Contabilidad</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="estado_cargosatc_id.php">Movimientos por Fecha</a></li>';
				$reg .='<li><a href="devoluciones_diarias_con.php">Devoluciones Diarias (N/C)</a></li>';
				$reg .='<li><a href="ventas_impuesto.php">Impuesto por Ventas</a></li>';
				$reg .='<li><a href="compras_impuesto.php">Impuesto por Compras</a></li>';
				$reg .='<li><a href="reporte_z.php">Corte Z y X Hospitalario</a></li>';
				$reg .='<li><a href="reporte_z_caja.php">Corte Z y X Publico</a></li>';
				$reg .='<li><a href="ordenes_mercancia.php">Ordenes de Mercancia Procesadas</a></li>';
				$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
				$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>';
				$reg .='<li><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
				$reg .='<li><a href="reimprimir_fiscal_dev.php">Reimprimir Nota de Credito Fiscal</a></li>';
				$reg .='<li><a href="ventas_xero.php">Ventas a Xero</a></li>';
				$reg .='<li><a href="compras_xero.php">Compras a Xero</a></li>';
				
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Reportes</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>';
				$reg .='<li><a href="mas_vendidos.php">Productos Más Vendidos</a></li>';
				$reg .='<li><a href="vendidos_x_area.php">Productos Vendidos por Área</a></li>';
				$reg .='<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li>';
				$reg .='<li><a href="tiempo_respuesta.php">Tiempos de Respuesta</a></li>';
				$reg .='<li><a href="sugerencias_farma.php">Sugerencias de Hospital</a></li>';
				$reg .='<li><a href="imprimir_med_snposo.php">Medicamentos sin Posología</a></li>';
				$reg .='<li><a href="imprimir_med_sninve.php">Medicamentos sin Inv. Crítico/Mínimo</a></li>';
				$reg .='<li><a href="historico_movimientos.php">Historico de Movimientos por Producto</a></li>';
				$reg .='<li><a href="vencimiento.php">Medicamentos a Tres Meses o Menos de Vencimiento</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Reportes 2</a>';
				$reg .='<ul class="nav child_menu">';
				
				$reg .='<li class="subfirst"><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
				$reg .='<li><a href="imprimir_medicamento_xls.php">Listado Medicamentos XLS</a></li>';
				$reg .='<li><a href="imprimir_med_imp.php" target="_blank">Listado de Medicamentos de Importación</a></li>';
				$reg .='<li><a href="imprimir_medicamentogenerico_xls.php">Listado Medicamentos Generico XLS</a></li>';
				$reg .='<li><a href="imprimir_medicamentoprecio_xls.php">Listado Medicamentos con Precio y Cantidad XLS</a></li>';
				$reg .='<li><a href="imprimir_medicamentoprecious_xls.php">Listado Medicamentos para USPSG XLS</a></li>';
				$reg .='<li><a href="imprimir_ins.php" target="_blank">Inventario Total de Insumos</a></li>';
				$reg .='<li><a href="imprimir_pre.php" target="_blank">Precios de Medicamentos</a></li>';
				$reg .='<li><a href="reporte_cambio_costo.php">Cambio de Costo por Medicamento</a></li>';
				$reg .='<li><a href="reporte_ventas.php">Reporte de Ventas XLS</a></li>';
				$reg .='<li><a href="cambio_costo_fecha.php">Variación de Costos por Fecha</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				
				
				
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Clientes</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_clientes.php">Agregar Clientes</a></li>';
				$reg .='<li><a href="editar_clientes_us.php">Editar Clientes</a></li>';
				$reg .='<li><a href="tipo_clientes.php">Tipos de Clientes</a></li>';
				/*	<li><a href="pago_creditos.php">Pago a Créditos</a></li>'; */
				$reg .='<li><a href="listado_clientes.php">Listado de Clientes</a></li>';
				$reg .='<li><a href="estados_cuenta.php">Estados de Cuenta</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';		
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				
				$reg .='</ul>';
				} else  if ($_SESSION['MM_tipo'] == 6) {  
				$reg .='<ul class="nav side-menu">';
				if($estado != 'S'){ 
					$reg .='<li><a href="cierre_carro_hospital.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
					} else {	
					$reg .='<li><a href="cierre_carro_hospital_cierre.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
				} 
				if($estado != 'S'){ 
					$reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
					} else {	
					$reg .='<li><a href="ver_devoluciones_cierre.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
				} 
				$reg .='<li><a href="falta_FA.php"><span><i class="fa fa-check"></i>Reenvio a Hospital</span></a></li>';
				$reg .='<li><a href="facturacion_cargos.php"><span><i class="fa fa-check"></i>Cargos Manuales</span></a></li>';	
				$reg .='<li><a href="devolucion_pub_manual.php"><span><i class="fa fa-check"></i>N/C Manuales</span></a></li>';	
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Compras</a>';
				$reg .='<ul class="nav child_menu">';
				
				$reg .='<li><a href="caja_menuda.php">Recibos de Caja</a></li>';
				$reg .='<li><a href="reporte_caja.php">Reporte de Caja</a></li>';
				$reg .='<li><a href="cierre_caja.php">Cierre de Caja</a></li>';
				$reg .='</ul>';
				$reg .='</li>';	
				
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Contabilidad</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="estado_cargosatc_id.php">Movimientos por Fecha</a></li>';
				$reg .='<li class="subfirst"><a href="estado_cargosatc_jub.php">Descuentos a Jubilados</a></li>';
				$reg .='<li class="subfirst"><a href="estado_cargosatc_aseg.php">Descuentos por Aseguradoras</a></li>';
				$reg .='<li><a href="devoluciones_diarias_con.php">Devoluciones Diarias (N/C)</a></li>';
				$reg .='<li><a href="ventas_impuesto.php">Impuesto por Ventas</a></li>';
				$reg .='<li><a href="compras_impuesto.php">Impuesto por Compras</a></li>';
				$reg .='<li><a href="reporte_z.php">Corte Z y X</a></li>';
				$reg .='<li><a href="ordenes_mercancia.php">Ordenes de Mercancia Procesadas</a></li>';
				$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
				$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>';
				$reg .='<li><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
				$reg .='<li><a href="reimprimir_fiscal_dev.php">Reimprimir Nota de Credito Fiscal</a></li>';
				$reg .='</ul>';
				$reg .='<li><a href="estado_cargosatc_f.php"><span><i class="fa fa-cart-plus"></i>Estado de Cargos</span></a></li>';
				$reg .='<li><a href="estado_cargosatc_f_fa.php"><i class="fa fa-check"></i>Búsqueda por FU</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_inac.php"><span><i class="fa fa-cart-plus"></i>Consulta Historias Inactivas</span></a></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Parametros</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';
				$reg .='<li><a href="db_backup.php"><span><i class="fa fa-check"></i>Backup</span></a></li>';	
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				
				$reg .='</ul>';
				
				} else if ($_SESSION['MM_tipo'] == 7) { 
				$reg .='<ul class="nav side-menu">';
				if($estado != 'S'){ 
					$reg .='<li><a href="cierre_carro_hospital.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
					} else {	
					$reg .='<li><a href="cierre_carro_hospital_cierre.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
				} 
				$reg .='<li><a href="falta_FA.php"><span><i class="fa fa-check"></i>Reenvio a Hospital</span></a>';
				$reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
				$reg .='<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>';
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Insumos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>';
				$reg .='<li><a href="editar_insumo_us.php">Editar Insumos</a></li>';
				$reg .='<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>';	
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Parametros</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
				$reg .='<li><a href="principios_activos.php">Principios Activos</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Cargos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cargos_pen.php"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
				$reg .='<li><a href="prep_pen.php"><img src="default.htm_files/css3menu1/home.png" alt=""/> Preparaciones Pendientes</a></li>';
				$reg .='<li><a href="reimprimir_cargos.php"><i class="fa fa-check"></i>Reimprimir Cargos</a></li>';
				$reg .='<li><a href="estado_cargosf.php"><i class="fa fa-check"></i>Estado de Ordenes</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_fa.php"><i class="fa fa-check"></i>Búsqueda por FU</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_inac.php"><i class="fa fa-cart-plus"></i>Consulta Historias Inactivas</span></a></li>';
				$reg .='<li><a href="liberar_cargos.php"><i class="fa fa-check"></i>Liberar Cargo</a></li>';
				$reg .='</ul></li>';	
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='</li>';
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				
				$reg .='<li><a href="#"><span><i class="fa fa-cart-plus"></i>Naves</span></a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
				$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
				$reg .='<li><a href="reimprimir_banco.php">Reimprimir Bancos</a></li>';
				$reg .='<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Medicamentos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
				$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
				$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
				$reg .='</ul></li>';
				
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Compras</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="orden_compras_detalle.php">Pedidos Manuales</a></li>';
				$reg .='<li><a href="inventario_bajo.php">Pedidos Automáticos</a></li>';
				$reg .='<li><a href="anular_orden_compra.php">Anular Pedido</a></li>';
				$reg .='<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';	
				
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Inventario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst">';
				$reg .='<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>';		
				$reg .='</ul></li>';
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Contabilidad</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
				$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>';
				$reg .='<li class="subfirst"><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Reportes</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>';
				$reg .='<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li>';
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';		
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				$reg .='</ul>';
				} else if ($_SESSION['MM_tipo'] == 8) { 
				$reg .='<ul class="nav side-menu">';
				if($estado != 'S'){ 
					$reg .='<li><a href="cierre_carro_hospital.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
					} else {	
					$reg .='<li><a href="cierre_carro_hospital_cierre.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
				} 
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="falta_FA.php"><span><i class="fa fa-check"></i>Reenvio a Hospital</span></a>';
				if($estado != 'S'){ 
					$reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
					} else {	
					$reg .='<li><a href="ver_devoluciones_cierre.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
				} 
				$reg .='<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>';
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Insumos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>';
				$reg .='<li><a href="editar_insumo_us.php">Editar Insumos</a></li>';
				$reg .='<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>';	
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Parametros</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
				$reg .='<li><a href="principios_activos.php">Principios Activos</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Cargos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cargos_pen.php"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
				$reg .='<li><a href="prep_pen.php"><img src="default.htm_files/css3menu1/home.png" alt=""/> Preparaciones Pendientes</a></li>';
				$reg .='<li><a href="reimprimir_cargos.php"><i class="fa fa-check"></i>Reimprimir Cargos</a></li>';
				$reg .='<li><a href="estado_cargosf.php"><i class="fa fa-check"></i>Estado de Ordenes</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_fa.php"><i class="fa fa-check"></i>Búsqueda por FU</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_inac.php"><i class="fa fa-cart-plus"></i>Consulta Historias Inactivas</span></a></li>';
				$reg .='<li><a href="liberar_cargos.php"><i class="fa fa-check"></i>Liberar Cargo</a></li>';
				
				$reg .='</ul></li>';	
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='</li>';
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				
				$reg .='<li><a href="#"><span><i class="fa fa-cart-plus"></i>Naves</span></a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
				$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
				$reg .='<li><a href="reimprimir_banco.php">Reimprimir Bancos</a></li>';
				$reg .='<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Medicamentos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
				$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
				$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
				$reg .='</ul></li>';
				
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Compras</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>';
				$reg .='<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>';
				$reg .='<li><a href="reimprimir_compra_r.php">Reimprimir Compra (Ingreso de Mercancía)</a></li>';
				$reg .='<li><a href="imprimir_med_pend_compra.php">Listado de Medicamentos Pendiente en O/C</a></li>';
				$reg .='<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>';
				$reg .='</ul>';
				$reg .='</li>';	
				
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Inventario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst">';
				$reg .='<a href="compras_detalle.php">Ingreso de Mercancía</a></li>';	
				$reg .='<li><a href="traslado_ins_med.php">Traslado de Insumos a Medicamentos</a></li>';
				$reg .='<li><a href="traslado_med_ins.php">Traslado de Medicamentos a Insumos</a></li>';	
				$reg .='</ul></li>';
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Contabilidad</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
				$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>';
				$reg .='<li class="subfirst"><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
				
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Reportes</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>';
				$reg .='<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li>';
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';		
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				$reg .='</ul>';
				} else if ($_SESSION['MM_tipo'] == 9) { 
				$reg .='<ul class="nav side-menu">';
				if($estado != 'S'){ 
					$reg .='<li><a href="cierre_carro_hospital.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
					} else {	
					$reg .='<li><a href="cierre_carro_hospital_cierre.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
				} 
				$reg .='<li><a href="falta_FA.php"><span><i class="fa fa-check"></i>Reenvio a Hospital</span></a>';
				if($estado != 'S'){ 
					$reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
					} else {	
					$reg .='<li><a href="ver_devoluciones_cierre.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
				} 
				$reg .='<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>';
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Insumos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>';
				$reg .='<li><a href="editar_insumo_us.php">Editar Insumos</a></li>';
				$reg .='<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>';	
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Parametros</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
				$reg .='<li><a href="principios_activos.php">Principios Activos</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Cargos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cargos_pen.php"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_inac.php"><i class="fa fa-cart-plus"></i>Consulta Historias Inactivas</span></a></li>';
				$reg .='<li><a href="reimprimir_cargos.php"><i class="fa fa-check"></i>Reimprimir Cargos</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_fa.php"><i class="fa fa-check"></i>Búsqueda por FU</a></li>';
				$reg .='<li><a href="estado_cargosf.php"><i class="fa fa-check"></i>Estado de Ordenes</a></li>';
				$reg .='<li><a href="liberar_cargos.php"><i class="fa fa-check"></i>Liberar Cargo</a></li>';
				$reg .='</ul></li>';	
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='</li>';
				$reg .='<li><a href="#"><span><i class="fa fa-cart-plus"></i>Naves</span></a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
				$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
				$reg .='<li><a href="reimprimir_banco.php">Reimprimir Banco</a></li>';
				$reg .='<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Medicamentos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
				$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
				$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Inventario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst">';
				$reg .='<a href="inventario_x_bodega.php">Inventario por Bodega</a></li>';
				$reg .='<li><a href="editar_inventario_bodega.php">Editar Inventario por Bodega</a></li>';
				$reg .='<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>';		
				$reg .='<li><a href="traslado_detalle.php">Traslado entre Bodegas</a></li>';
				
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Contabilidad</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
				$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>'; 
				$reg .='<li class="subfirst"><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
				
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Reportes</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>';
				
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';		
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				$reg .='</ul>';
				}  else  if ($_SESSION['MM_tipo'] == 10) {  
				$reg .='<ul class="nav side-menu">';
				if($estado != 'S'){ 
					$reg .='<li><a href="cierre_carro_hospital.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
					} else {	
					$reg .='<li><a href="cierre_carro_hospital_cierre.php"><span><i class="fa fa-check"></i>Generación de Facturas</span></a></li>';
				} 
				if($estado != 'S'){ 
					$reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
					} else {	
					$reg .='<li><a href="ver_devoluciones_cierre.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>';
				} 
				$reg .='<li><a href="falta_FA.php"><span><i class="fa fa-check"></i>Reenvio a Hospital</span></a></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Compras</a>';
				$reg .='<ul class="nav child_menu">';
				
				$reg .='<li><a href="caja_menuda.php">Recibos de Caja</a></li>';
				$reg .='<li><a href="reporte_caja.php">Reporte de Caja</a></li>';
				$reg .='<li><a href="cierre_caja.php">Cierre de Caja</a></li>';
				$reg .='</ul>';
				$reg .='</li>';	
				
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Contabilidad</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="estado_cargosatc_id.php">Movimientos por Fecha</a></li>';
				$reg .='<li><a href="devoluciones_diarias_con.php">Devoluciones Diarias (N/C)</a></li>';
				$reg .='<li><a href="ventas_impuesto.php">Impuesto por Ventas</a></li>';
				$reg .='<li><a href="compras_impuesto.php">Impuesto por Compras</a></li>';
				$reg .='<li><a href="reporte_z.php">Corte Z y X</a></li>';
				$reg .='<li><a href="ordenes_mercancia.php">Ordenes de Mercancia Procesadas</a></li>';
				$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
				$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>';
				$reg .='<li><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
				$reg .='<li><a href="ventas_xero.php">Ventas a Xero</a></li>';
				$reg .='<li><a href="compras_xero.php">Compras a Xero</a></li>';
				$reg .='</ul>';
				$reg .='<li><a href="estado_cargosatc_f.php"><span><i class="fa fa-cart-plus"></i>Estado de Cargos</span></a></li>';
				$reg .='<li><a href="estado_cargosatc_f_fa.php"><i class="fa fa-check"></i>Búsqueda por FU</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_inac.php"><span><i class="fa fa-cart-plus"></i>Consulta Historias Inactivas</span></a></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Parametros</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='</li>';
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>P&uacute;blico</a>';
				$reg .='<ul class="nav child_menu">';
				
				$reg .='<li class="subfirst">';
				$reg .='<li><a href="pago_creditos.php" >Pagos a Cr&eacute;dito</a></li>';
				
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';
				
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				
				$reg .='</ul>';
				} else if ($_SESSION['MM_tipo'] == 11) { 
				
				
				$reg .='<ul class="nav side-menu">';
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Insumos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>';
				$reg .='<li><a href="editar_insumo_us.php">Editar Insumos</a></li>';
				$reg .='<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>';	
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Parametros</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
				$reg .='<li><a href="principios_activos.php">Principios Activos</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';	
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				
				$reg .='<li><a href="#"><i class="fa fa-check"></i>Medicamentos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
				$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
				$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
				$reg .='</ul></li>';
				
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Compras</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>';
				$reg .='<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>';
				$reg .='<li><a href="reimprimir_compra_r.php">Reimprimir Compra (Ingreso de Mercancía)</a></li>';
				$reg .='<li><a href="imprimir_med_pend_compra.php">Listado de Medicamentos Pendiente en O/C</a></li>';
				$reg .='<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>';
				$reg .='</ul>';
				$reg .='</li>';	
				
				$reg .='<li><a href="#"><i class="fa fa-cart-plus"></i>Inventario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst">';
				$reg .='<a href="compras_detalle.php">Ingreso de Mercancía</a></li>';	
				$reg .='<li><a href="traslado_ins_med.php">Traslado de Insumos a Medicamentos</a></li>';
				$reg .='<li><a href="traslado_med_ins.php">Traslado de Medicamentos a Insumos</a></li>';	
				$reg .='</ul></li>';
				
				
				
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';		
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				$reg .='</ul>';
				}  else if ($_SESSION['MM_tipo'] == 13) { 
				$reg .='<ul class="nav side-menu">';
				$reg .='<li><a href="facturacion.php"><img src="default.htm_files/css3menu1/home.png" alt=""/>Venta al Publico</a></li>';
				$reg .='<li><a href="devolucion_pub.php"><i class="fa fa-check"></i>N/C al Publico</a></li>';
				$reg .='<li><a href="cotizacion.php"><i class="fa fa-check"></i>Cotizaci&oacute;n</a></li>';
				$reg .='<li><a href="facturacion_credito.php"><i class="fa fa-check"></i>Pago de Cr&eacute;ditos</a></li>';
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				/*	reg .='<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>';
				reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li>'; */
				$reg .='<li><a href="reporte_z_caja.php"><i class="fa fa-check"></i>Reporte de Caja</a></li>';
				
				
				
				$reg .='<li>	<a href="falta_fiscal.php"><i class="fa fa-check"></i>Obtener Fiscal</a></li>';
				$reg .='<li><a href="factura_diaria.php"><i class="fa fa-check"></i>Facturas Diarias</a></li>';
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';	
				$reg .='<li class="toplast"><a href="logout_caja.php"><i class="fa fa-check"></i>Salir</a>';
				
				$reg .='</ul>';
			}
			
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
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
			
			$reg .='<body class="nav-md">';
			$reg .='<div class="container body">';
			$reg .='<div class="main_container">';
			$reg .='<div class="col-md-3 left_col">';
			$reg .='<div class="left_col scroll-view">';
			$reg .='<div class="navbar nav_title" style="border: 0;">';
			$reg .='<a href="index.html" class="site_title"><span><img style="width: 95%" src="../images/apdosis.png"></span></a>';
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
			
			$reg ='<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">';
			$reg .='<div class="menu_section">';
			$reg .='<h3>General</h3>';
			
			if ($_SESSION['MM_tipo'] == 1) { 
				$reg .='<ul class="nav side-menu">';
				$reg .='<li class="topfirst"><a href="facturacion.php"><i class="fa fa-home"></i>Venta al Publico</a></li>';
				$reg .='<li><a href="devolucion_pub.php"><i class="fa fa-check"></i>N/C al Publico</a></li>';
				$reg .='<li><a href="cotizacion.php"><i class="fa fa-check"></i>Cotizaci&oacute;n</a></li>';
				$reg .='<li><a href="facturacion_credito.php"><i class="fa fa-check"></i>Pago de Cr&eacute;ditos</a></li>';
				$reg .='<li><a><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				
				$reg .='<li><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				$reg .='<li><a><i class="fa fa-check"></i>Art&iacute;culos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
				$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
				$reg .='<li ><a href="agregar_insumos.php">Agregar Productos</a></li>';
				$reg .='<li><a href="editar_insumo_us.php">Editar Productos</a></li>';
				$reg .='<li><a href="editar_medicamentos_cb.php">Imprimir Label Producto</a></li>';
				$reg .='<li><a href="editar_medicamentos_cba.php">Imprimir Label Precio</a></li>';
				// <li><a href="editar_costo_insumo.php">Costo por Grupo</a></li>
				$reg .='</ul></li>';	
				
				$reg .='<li><a><i class="fa fa-check"></i>Parametros</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="formas_farma.php">Formas Farmaceuticas</a></li>';
				$reg .='<li><a href="contraindica.php">Contraindicaciones</a></li>';
				$reg .='<li><a href="fabricantes.php">Fabricantes</a></li>'; 
				$reg .='<li><a href="posologias.php">Concentracion</a></li>';
				
				$reg .='<li><a href="proveedores.php">Proveedores</a></li>';
				$reg .='<li><a href="proveedores_caja.php">Proveedores de Caja</a></li>';
				$reg .='<li><a href="presentacion.php">Presentaciones</a></li>';
				$reg .='<li><a href="editar_costo_insumo.php">Par&acute;metros de Grupos</a></li>';
				$reg .='<li><a href="descuentos_por_dia.php">Descuentos por día</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				
				
				$reg .='<li><a><i class="fa fa-cart-plus"></i>Clientes</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_clientes.php">Agregar Clientes</a></li>';
				$reg .='<li><a href="editar_clientes_us.php">Editar Clientes</a></li>';
				$reg .='<li><a href="tipo_clientes.php">Tipos de Clientes</a></li>';
				//	<li><a href="pago_creditos.php">Pago a Créditos</a></li>
				$reg .='<li><a href="listado_clientes.php">Listado de Clientes</a></li>';
				$reg .='<li><a href="estados_cuenta.php">Estados de Cuenta</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';	
				
				
				$reg .='<li><a><i class="fa fa-cart-plus"></i>Compras</a>';
				$reg .='<ul class="nav child_menu">';
				if($estado != 'S'){
					$reg .='<li class="subfirst"><a href="orden_compras_detalle.php">Pedidos Manuales</a></li>';
					$reg .='<li><a href="inventario_bajo.php">Listado de Inventario Bajo - Pedidos Automáticos</a></li>';
					$reg .='<li><a href="inventario_bajo_x_prov.php">Listado de Inventario Bajo por Proveedor - Pedidos Automáticos</a></li>';
					$reg .='<li><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>';
					$reg .='<li><a href="procesar_compra_credito.php">Nota de Crédito Pendiente</a></li>';
					$reg .='<li><a href="anular_orden_compra.php">Anular Pedido</a></li>';
					} else {	
					$reg .='<li class="subfirst"><a href="error_inventario.php">Pedidos Manuales</a></li>';
					$reg .='<li><a href="error_inventario.php">Listado de Inventario Bajo - Pedidos Automáticos</a></li>';
					$reg .='<li><a href="error_inventario.php">Listado de Inventario Bajo por Proveedor - Pedidos Automáticos</a></li>';
					$reg .='<li><a href="error_inventario.php">Procesar Pedidos</a></li>';
					$reg .='<li><a href="error_inventario.php">Nota de Crédito Pendiente</a></li>';
					$reg .='<li><a href="error_inventario.php">Anular Pedido</a></li>';		
				}
				$reg .='<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>';
				$reg .='<li><a href="reimprimir_compra_r.php">Reimprimir Compra (Ingreso de Mercancía)</a></li>';
				
				$reg .='<li><a href="imprimir_med_pend_compra.php">Listado de Art&iacute;culos Pendiente en O/C</a></li>';
				//	<li><a href="imprimir_med_pend_compra_adm.php">Listado de Art&iacute;culos Asignados a O/C Adm.</a></li>
				$reg .='<li><a href="caja_menuda.php">Recibos de Caja</a></li>';
				$reg .='<li><a href="reporte_caja.php">Reporte de Caja</a></li>';
				$reg .='<li><a href="cierre_caja.php">Cierre de Caja</a></li>';
				$reg .='</ul>';
				$reg .='</li>';	
				
				
				$reg .='<li><a><i class="fa fa-cart-plus"></i>Inventario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="editar_medicamentos_estado.php">Inactivar / Borrar Art&iacute;culos</a></li>';
				
				$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Artículos</a></li>';
				$reg .='<li><a href="imprimir_medicamento_xls.php">Listado Artículos XLS</a></li>';
				if($estado != 'S'){
					$reg .='<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>';		
					$reg .='<li><a href="traslado_detalle.php">Traslado entre Bodegas</a></li>';
					$reg .='<li><a href="orden_compras_detalle_ext.php">Solicitar Mercanc&iacute;a Bodegas Externas</a></li>'; 
					$reg .='<li><a href="orden_pen.php">Ordenes a Procesar Externas</a></li>'; 
					} else {	
					$reg .='<li><a href="error_inventario.php">Ingreso de Mercancía</a></li>';		
					$reg .='<li><a href="error_inventario.php">Traslado entre Bodegas</a></li>';
				}
				$reg .='<li><a href="imprimir_inv.php" target="_blank">Inventario Total de Artículos</a></li>';
				$reg .='<li><a href="imprimir_medicamentoprecio_xls.php">Listado Artículos con Precio y Cantidad XLS</a></li>';
				/* <li><a href="imprimir_ins.php" target="_blank">Inventario Total de Insumos</a></li> */
				$reg .='<li><a href="imprimir_pre.php" target="_blank">Precios de Artículos</a></li>';
				if($estado != 'S'){
					$reg .='<li><a href="editar_medicamentos_inv.php">Editar Inventario de Artículos</a></li>';		
					$reg .='<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>';
					} else {	
					$reg .='<li><a href="error_inventario.php">Editar Inventario de Artículos</a></li>';		
					$reg .='<li><a href="error_inventario.php">Devolucion a Proveedores</a></li>';
				}
				$reg .='<li><a href="reimprimir_dev_prov.php">Reimprimir Devolucion a Proveedores</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a><i class="fa fa-check"></i>Contabilidad</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="ventas_diarias_con.php">Ventas Diarias</a></li>';
				$reg .='<li><a href="devoluciones_diarias_con.php">Devoluciones Diarias (N/C)</a></li>';
				$reg .='<li><a href="reporte_ventas.php">Reporte de Ventas XLS</a></li>';
				$reg .='<li><a href="reporte_compras.php">Reporte de Entradas y Salidas de Merc XLS</a></li>';
				$reg .='<li><a href="ventas_impuesto.php">Impuesto por Ventas</a></li>';
				$reg .='<li><a href="compras_impuesto.php">Impuesto por Compras</a></li>';
				$reg .='<li><a href="reporte_ventasxls.php">Reporte de Ventas (Detalle) XLS</a></li>';
				$reg .='<li><a href="reporte_z.php">Corte Z y X</a></li>';
				$reg .='<li><a href="ordenes_mercancia.php">Ordenes de Mercancia Procesadas</a></li>';
				$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
				$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>';
				$reg .='<li><a href="ventas_xero.php">Generar Ventas Xero</a></li>';
				$reg .='<li><a href="compras_xero.php">Generar Compras Xero</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a><i class="fa fa-check"></i>Reportes</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>';
				$reg .='<li><a href="mas_vendidos.php">Productos Más Vendidos</a></li>';
				$reg .='<li><a href="historico_movimientos.php">Historico de Movimientos por Producto</a></li>';
				$reg .='<li><a href="vencimiento.php">Medicamentos a Tres Meses de Vencimiento</a></li>';
				
				/*	<li><a href="vendidos_x_area.php">Productos Vendidos por Área</a></li>';
				$reg .='<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li> */
				
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a><i class="fa fa-check"></i>Fiscal</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="falta_fiscal.php">Obtener Fiscal</a></li>';
				$reg .='<li><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
				$reg .='<li><a href="reimprimir_fiscal_dev.php">Reimprimir Nota de Credito Fiscal</a></li>';
				
				/*	<li><a href="vendidos_x_area.php">Productos Vendidos por Área</a></li>
				$reg .='<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li>*/
				
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a><i class="fa fa-check"></i>Usuarios</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="usuarios.php">Creación de Usuarios</a></li>';
				$reg .='<li><a href="datos_generales.php">Datos Usuario</a></li>';	
				$reg .='<li><a href="usuarios_editar.php">Editar Usuarios</span></a></li>';	
				
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				
				$reg .='</ul>';
				} else if ($_SESSION['MM_tipo'] == 6) {
				$reg .='<ul class="nav side-menu">';
				$reg .='<li class="topfirst"><a href="facturacion.php"><i class="fa fa-home"></i>Venta al Publico</a></li>';
				$reg .='<li><a href="devolucion_pub.php"><i class="fa fa-check"></i>N/C al Publico</a></li>';
				$reg .='<li><a href="cotizacion.php"><i class="fa fa-check"></i>Cotizaci&oacute;n</a></li>';
				$reg .='<li><a href="facturacion_credito.php"><i class="fa fa-check"></i>Pago de Cr&eacute;ditos</a></li>';
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				/*	<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>';
				$reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li> */
				
				$reg .='<li><a href="reporte_z.php"><i class="fa fa-check"></i>Reporte de Caja</a></li>';
				
				$reg .='<li>	<a href="falta_fiscal.php"><i class="fa fa-check"></i>Obtener Fiscal</a></li>';
				$reg .='<li><a href="factura_diaria.php"><i class="fa fa-check"></i>Facturas Diarias</a></li>';
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';	
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				
				$reg .='</ul>';
				} else if ($_SESSION['MM_tipo'] == 2) {
				$reg .='<ul class="nav side-menu">';
				$reg .='<li class="topfirst">';
				$reg .='<a href="devolucion_pub.php"><i class="fa fa-check"></i>N/C al Publico</a></li>';
				/*	<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>';
				$reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li> */
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				$reg .='<li><a><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_manual.php"><i class="fa fa-home"></i> Realizar Recetas</a></li>';
				$reg .='<li><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				
				$reg .='<li><a><i class="fa fa-check"></i>Parametros</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li><a><i class="fa fa-check"></i>Contabilidad</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="ventas_diarias_con.php">Ventas Diarias</a></li>';
				$reg .='<li><a href="devoluciones_diarias_con.php">Devoluciones Diarias (N/C)</a></li>';
				$reg .='<li><a href="reporte_z.php">Corte Z y X</a></li>';
				
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li>	<a href="falta_fiscal.php"><i class="fa fa-check"></i>Obtener Fiscal</a></li>';
				
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';	
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				
				$reg .='</ul>';
				} else if ($_SESSION['MM_tipo'] == 5) {
				$reg .='<ul class="nav side-menu">';
				$reg .='<li class="topfirst"> 	<li class="topfirst"><a href="facturacion.php"><i class="fa fa-home"></i>Venta al Publico</a></li>';
				$reg .='<li><a href="cotizacion.php"><i class="fa fa-check"></i>Cotizaci&oacute;n</a></li>';
				$reg .='<li><a href="facturacion_credito.php"><i class="fa fa-check"></i>Pago de Cr&eacute;ditos</a></li>';
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				$reg .='<li><a><i class="fa fa-check"></i>Parametros</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="formas_farma.php">Formas Farmaceuticas</a></li>';
				$reg .='<li><a href="contraindica.php">Contraindicaciones</a></li>';
				$reg .='<li><a href="fabricantes.php">Fabricantes</a></li>'; 
				$reg .='<li><a href="posologias.php">Concentracion</a></li>';
				
				$reg .='<li><a href="proveedores.php">Proveedores</a></li>';
				$reg .='<li><a href="proveedores_caja.php">Proveedores de Caja</a></li>';
				$reg .='<li><a href="presentacion.php">Presentaciones</a></li>';
				$reg .='<li><a href="editar_costo_insumo.php">Par&acute;metros de Grupos</a></li>';
				$reg .='<li><a href="descuentos_por_dia.php">Descuentos por día</a></li>';
				
				$reg .='</ul>';
				$reg .='</li><li>	<a href="devolucion_pub.php"><i class="fa fa-check"></i>N/C al Publico</a></li>';
				/*	<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>';
				$reg .='<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li> */
				$reg .='<li><a><i class="fa fa-check"></i>Recetario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				$reg .='<li><a href="reporte_z.php"><i class="fa fa-check"></i>Reporte de Caja</a></li>';
				$reg .='<li><a href="factura_diaria.php"><i class="fa fa-check"></i>Facturas Diarias</a></li>';
				
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';	
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				
				$reg .='</ul>';
				} else if ($_SESSION['MM_tipo'] == 7) {
				$reg .='<ul class="nav side-menu">';
				$reg .='<li class="topfirst"><a><i class="fa fa-home"></i>Venta al Publico</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="facturacion.php">Facturaci&oacute;n</a></li>';
				$reg .='<li><a href="cotizacion.php" >Cotizaci&oacute;n</a></li>';
				$reg .='<li><a href="facturacion_label.php" >Impresión de Labels</a></li>';
				$reg .='<li><a href="editar_medicamentos_cb.php">Imprimir Label Producto</a></li>';
				$reg .='<li><a href="editar_medicamentos_cba.php">Imprimir Label Precio</a></li>';
				
				
				$reg .='</ul></li>';
				$reg .='<li><a href="devolucion_pub.php"><i class="fa fa-check"></i>N/C al Publico</a></li>';
				$reg .='<li><a href="facturacion_credito.php"><i class="fa fa-check"></i>Pago de Cr&eacute;ditos</a></li>';
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				
				$reg .='<li><a><i class="fa fa-check"></i>Art&iacute;culos</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
				$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
				$reg .='<li ><a href="agregar_insumos.php">Agregar Productos</a></li>';
				$reg .='<li><a href="editar_insumo_us.php">Editar Productos</a></li>';
				// <li><a href="editar_costo_insumo.php">Costo por Grupo</a></li> */
				$reg .='</ul></li>';	
				
				$reg .='<li><a><i class="fa fa-check"></i>Parametros</a>';
				$reg .='<ul class="nav child_menu">';
				/* <li class="subfirst"><a href="formas_farma.php">Formas Farmaceuticas</a></li>
				$reg .='<li><a href="contraindica.php">Contraindicaciones</a></li> */
				$reg .='<li><a href="fabricantes.php">Fabricantes</a></li>'; 
				/*	<li><a href="posologias.php">Concentracion</a></li>
					
					$reg .='<li><a href="proveedores.php">Proveedores</a></li>
					$reg .='<li><a href="proveedores_caja.php">Proveedores de Caja</a></li>
					/*	<li><a href="presentacion.php">Presentaciones</a></li>
				$reg .='<li><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li> */
				$reg .='<li><a href="proveedores.php">Proveedores</a></li>';
				$reg .='</ul>';
				$reg .='</li>'; 
				
				$reg .='<li><a><i class="fa fa-cart-plus"></i>Compras</a>';
				$reg .='<ul class="nav child_menu">';
				if($estado != 'S'){
					$reg .='<li class="subfirst"><a href="orden_compras_detalle.php">Pedidos Manuales</a></li>';
					$reg .='<li><a href="inventario_bajo.php">Listado de Inventario Bajo - Pedidos Automáticos</a></li>';
					$reg .='<li><a href="inventario_bajo_x_prov.php">Listado de Inventario Bajo por Proveedor - Pedidos Automáticos</a></li>';
					$reg .='<li><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>';
					$reg .='<li><a href="procesar_compra_credito.php">Nota de Crédito Pendiente</a></li>';
					$reg .='<li><a href="anular_orden_compra.php">Anular Pedido</a></li>';
					} else {	
					$reg .='<li class="subfirst"><a href="error_inventario.php">Pedidos Manuales</a></li>';
					$reg .='<li><a href="error_inventario.php">Listado de Inventario Bajo - Pedidos Automáticos</a></li>';
					$reg .='<li><a href="error_inventario.php">Listado de Inventario Bajo por Proveedor - Pedidos Automáticos</a></li>';
					$reg .='<li><a href="error_inventario.php">Procesar Pedidos</a></li>';
					$reg .='<li><a href="error_inventario.php">Nota de Crédito Pendiente</a></li>';
					$reg .='<li><a href="error_inventario.php">Anular Pedido</a></li>';		
				}
				$reg .='<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>';
				$reg .='<li><a href="reimprimir_compra_r.php">Reimprimir Compra (Ingreso de Mercancía)</a></li>';
				
				$reg .='<li><a href="imprimir_med_pend_compra.php">Listado de Art&iacute;culos Pendiente en O/C</a></li>';
				/*	<li><a href="imprimir_med_pend_compra_adm.php">Listado de Art&iacute;culos Asignados a O/C Adm.</a></li>'; 
					$reg .='<li><a href="caja_menuda.php">Recibos de Caja</a></li>';
					$reg .='<li><a href="reporte_caja.php">Reporte de Caja</a></li>
				$reg .='<li><a href="cierre_caja.php">Cierre de Caja</a></li> */
				$reg .='</ul>';
				$reg .='</li>';	
				
				
				$reg .='<li><a><i class="fa fa-cart-plus"></i>Inventario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="imprimir_med.php" target="_blank">Listado de Artículos</a></li>';
				$reg .='<li><a href="imprimir_medicamento_xls.php">Listado Artículos XLS</a></li>';
				if($estado != 'S'){
					$reg .='<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>';		
					$reg .='<li><a href="traslado_detalle.php">Traslado entre Bodegas</a></li>';
					//	<li><a href="traslado_detalle_ext.php">Traslado entre Bodegas Externas</a></li> */
					} else {	
					$reg .='<li><a href="error_inventario.php">Ingreso de Mercancía</a></li>';		
					$reg .='<li><a href="error_inventario.php">Traslado entre Bodegas</a></li>';
				}
				$reg .='<li><a href="imprimir_inv.php" target="_blank">Inventario Total de Artículos</a></li>';
				$reg .='<li><a href="imprimir_medicamentoprecio_xls.php">Listado Artículos con Precio y Cantidad XLS</a></li>';
				$reg .='<li><a href="orden_compras_detalle_ext.php">Solicitar Mercanc&iacute;a Bodegas Externas</a></li>'; 
				$reg .='<li><a href="orden_pen.php">Ordenes a Procesar Externas</a></li>'; 
				
				/*	<li><a href="imprimir_medicamentoprecious_xls.php">Listado Medicamentos para USPSG XLS</a></li>'; 
					$reg .='<li><a href="imprimir_ins.php" target="_blank">Inventario Total de Insumos</a></li>';
					$reg .='<li><a href="imprimir_pre.php" target="_blank">Precios de Artículos</a></li>
				$reg .='<li><a href="editar_medicamentos_inv.php">Editar Inventario de Artículos</a></li> */
				
				if($estado != 'S'){
					$reg .='<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>';
					} else {	
					$reg .='<li><a href="error_inventario.php">Devolucion a Proveedores</a></li>';
				}
				$reg .='<li><a href="reimprimir_dev_prov.php">Reimprimir Devolucion a Proveedores</a></li>';
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li><a><i class="fa fa-check"></i>Reportes</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>';
				$reg .='<li><a href="mas_vendidos.php">Productos Más Vendidos</a></li>';
				$reg .='<li><a href="historico_movimientos.php">Historico de Movimientos por Producto</a></li>';
				$reg .='<li><a href="reporte_z.php">Corte Z y X</a></li>';
				
				/*	<li><a href="vendidos_x_area.php">Productos Vendidos por Área</a></li>
				$reg .='<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li> */
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li><a><i class="fa fa-check"></i>Fiscal</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="falta_fiscal.php">Obtener Fiscal</a></li>';
				$reg .='<li><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
				$reg .='<li><a href="reimprimir_fiscal_dev.php">Reimprimir Nota de Credito Fiscal</a></li>';
				
				/*	<li><a href="vendidos_x_area.php">Productos Vendidos por Área</a></li>
				$reg .='<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li> */
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';	
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				
				$reg .='</ul>';
				} else if ($_SESSION['MM_tipo'] == 4) {
				$reg .='<ul class="nav side-menu">';
				$reg .='<li class="topfirst"><a><i class="fa fa-cart-plus"></i>Clientes</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li><a href="pago_creditos.php">Pago a Créditos</a></li>';
				$reg .='<li><a href="listado_clientes.php">Listado de Clientes</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';	
				
				$reg .='<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>';
				$reg .='<li><a><i class="fa fa-cart-plus"></i>Compras</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="caja_menuda.php">Recibos de Caja</a></li>';
				$reg .='<li><a href="reporte_caja.php">Reporte de Caja</a></li>';
				$reg .='<li><a href="cierre_caja.php">Cierre de Caja</a></li>';
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li><a><i class="fa fa-cart-plus"></i>Inventario</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="imprimir_inv.php" target="_blank">Inventario Total de Artículos</a></li>';
				$reg .='<li><a href="imprimir_medicamentoprecio_xls.php">Listado Artículos con Precio y Cantidad XLS</a></li>';
				
				
				
				$reg .='<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>';
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li><a><i class="fa fa-check"></i>Contabilidad</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="ventas_diarias_con.php">Ventas Diarias</a></li>';
				$reg .='<li><a href="devoluciones_diarias_con.php">Devoluciones Diarias (N/C)</a></li>';
				$reg .='<li><a href="ventas_impuesto.php">Impuesto por Ventas</a></li>';
				$reg .='<li><a href="compras_impuesto.php">Impuesto por Compras</a></li>';
				$reg .='<li><a href="reporte_z.php">Corte Z y X</a></li>';
				$reg .='<li><a href="ordenes_mercancia.php">Ordenes de Mercancia Procesadas</a></li>';
				$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
				$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>';
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li><a><i class="fa fa-check"></i>Reportes</a>';
				$reg .='<ul class="nav child_menu">';
				$reg .='<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>';
				$reg .='<li><a href="mas_vendidos.php">Productos Más Vendidos</a></li>';
				/*	<li><a href="vendidos_x_area.php">Productos Vendidos por Área</a></li>';
				$reg .='<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li> */
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				
				$reg .='<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>';	
				$reg .='<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>';
				
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
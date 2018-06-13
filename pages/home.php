<?php
	session_start();
	include ('../clases/session.php'); 
	//$_SESSION['MM_tipo'] =1;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Farmacia</title>
		
		<!-- Bootstrap -->
		<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
		<!-- iCheck -->
		<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
		
		<!-- bootstrap-progressbar -->
		<link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
		<!-- JQVMap -->
		<link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
		<!-- bootstrap-daterangepicker -->
		<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		
		<!-- Custom Theme Style -->
		<link href="../build/css/custom.min.css" rel="stylesheet">
	</head>
	
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a href="index.html" class="site_title"><span><img style="width: 95%" src="../images/apdosis.png"></span></a>
						</div>
						
						<div class="clearfix"></div>
						
						<!-- menu profile quick info -->
						<div class="profile clearfix">
							<div class="profile_pic">
								<img src="../images/user.png" alt="..." class="img-circle profile_img">
							</div>
							<div class="profile_info">
								<span>Bienvenido,</span>
								<h2><?=$_SESSION['MM_iduser']?></h2>
							</div>
						</div>
						<!-- /menu profile quick info -->
						
						<br />
						
						<!-- sidebar menu -->
						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
							<div class="menu_section">
								<h3>General</h3>
								<?php
									if ($_SESSION['MM_tipo'] == 1) {  ?>
									<ul class="nav side-menu">
										<li class="topfirst"><a href="facturacion.php"><i class="fa fa-home"></i>Venta al Publico</a></li>
										<li><a href="devolucion_pub.php"><i class="fa fa-check"></i>N/C al Publico</a></li>
										<li><a href="cotizacion.php"><i class="fa fa-check"></i>Cotizaci&oacute;n</a></li>
										<li><a href="facturacion_credito.php"><i class="fa fa-check"></i>Pago de Cr&eacute;ditos</a></li>
										<!--	<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>
										<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li> -->
										<li><a><i class="fa fa-check"></i>Recetario</a>
											<ul class="nav child_menu">
												
												<li><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>
											</ul></li>
											<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>
											<li><a><i class="fa fa-check"></i>Art&iacute;culos</a>
												<ul class="nav child_menu">
													<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>
													<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>
													<li ><a href="agregar_insumos.php">Agregar Productos</a></li>
													<li><a href="editar_insumo_us.php">Editar Productos</a></li>
													<li><a href="editar_medicamentos_cb.php">Imprimir Label Producto</a></li>
													<li><a href="editar_medicamentos_cba.php">Imprimir Label Precio</a></li>
													<!-- <li><a href="editar_costo_insumo.php">Costo por Grupo</a></li> -->
												</ul></li>	
												
												<li><a><i class="fa fa-check"></i>Parametros</a>
													<ul class="nav child_menu">
														<li class="subfirst"><a href="formas_farma.php">Formas Farmaceuticas</a></li>
														<li><a href="contraindica.php">Contraindicaciones</a></li>
														<li><a href="fabricantes.php">Fabricantes</a></li> 
														<li><a href="posologias.php">Concentracion</a></li>
														
														<li><a href="proveedores.php">Proveedores</a></li>
														<li><a href="proveedores_caja.php">Proveedores de Caja</a></li>
														<li><a href="presentacion.php">Presentaciones</a></li>
														<li><a href="editar_costo_insumo.php">Par&acute;metros de Grupos</a></li>
														<li><a href="descuentos_por_dia.php">Descuentos por día</a></li>
														
													</ul>
												</li>
												
												
												<li><a><i class="fa fa-cart-plus"></i>Clientes</a>
													<ul class="nav child_menu">
														<li class="subfirst"><a href="agregar_clientes.php">Agregar Clientes</a></li>
														<li><a href="editar_clientes_us.php">Editar Clientes</a></li>
														<li><a href="tipo_clientes.php">Tipos de Clientes</a></li>
														<!--	<li><a href="pago_creditos.php">Pago a Créditos</a></li> -->
														<li><a href="listado_clientes.php">Listado de Clientes</a></li>
														<li><a href="estados_cuenta.php">Estados de Cuenta</a></li>
														
													</ul>
												</li>	
												
												
												<li><a><i class="fa fa-cart-plus"></i>Compras</a>
													<ul class="nav child_menu">
														<?php if($estado != 'S'){ ?>
															<li class="subfirst"><a href="orden_compras_detalle.php">Pedidos Manuales</a></li>
															<li><a href="inventario_bajo.php">Listado de Inventario Bajo - Pedidos Automáticos</a></li>
															<li><a href="inventario_bajo_x_prov.php">Listado de Inventario Bajo por Proveedor - Pedidos Automáticos</a></li>
															<li><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>
															<li><a href="procesar_compra_credito.php">Nota de Crédito Pendiente</a></li>
															<li><a href="anular_orden_compra.php">Anular Pedido</a></li>
															<?php } else {	?>
															<li class="subfirst"><a href="error_inventario.php">Pedidos Manuales</a></li>
															<li><a href="error_inventario.php">Listado de Inventario Bajo - Pedidos Automáticos</a></li>
															<li><a href="error_inventario.php">Listado de Inventario Bajo por Proveedor - Pedidos Automáticos</a></li>
															<li><a href="error_inventario.php">Procesar Pedidos</a></li>
															<li><a href="error_inventario.php">Nota de Crédito Pendiente</a></li>
															<li><a href="error_inventario.php">Anular Pedido</a></li>		
														<?php } ?>
														<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>
														<li><a href="reimprimir_compra_r.php">Reimprimir Compra (Ingreso de Mercancía)</a></li>
														
														<li><a href="imprimir_med_pend_compra.php">Listado de Art&iacute;culos Pendiente en O/C</a></li>
														<!--	<li><a href="imprimir_med_pend_compra_adm.php">Listado de Art&iacute;culos Asignados a O/C Adm.</a></li> -->
														<li><a href="caja_menuda.php">Recibos de Caja</a></li>
														<li><a href="reporte_caja.php">Reporte de Caja</a></li>
														<li><a href="cierre_caja.php">Cierre de Caja</a></li>
													</ul>
												</li>	
												
												
												<li><a><i class="fa fa-cart-plus"></i>Inventario</a>
													<ul class="nav child_menu">
														<li class="subfirst"><a href="editar_medicamentos_estado.php">Inactivar / Borrar Art&iacute;culos</a></li>
														
														<li><a href="imprimir_med.php" target="_blank">Listado de Artículos</a></li>
														<li><a href="imprimir_medicamento_xls.php">Listado Artículos XLS</a></li>
														<?php if($estado != 'S'){ ?>
															<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>		
															<li><a href="traslado_detalle.php">Traslado entre Bodegas</a></li>
															<li><a href="orden_compras_detalle_ext.php">Solicitar Mercanc&iacute;a Bodegas Externas</a></li> 
															<li><a href="orden_pen.php">Ordenes a Procesar Externas</a></li> 
															<?php } else {	?>
															<li><a href="error_inventario.php">Ingreso de Mercancía</a></li>		
															<li><a href="error_inventario.php">Traslado entre Bodegas</a></li>
														<?php } ?>
														<li><a href="imprimir_inv.php" target="_blank">Inventario Total de Artículos</a></li>
														<li><a href="imprimir_medicamentoprecio_xls.php">Listado Artículos con Precio y Cantidad XLS</a></li>
														<!-- <li><a href="imprimir_ins.php" target="_blank">Inventario Total de Insumos</a></li> -->
														<li><a href="imprimir_pre.php" target="_blank">Precios de Artículos</a></li>
														<?php if($estado != 'S'){ ?>
															<li><a href="editar_medicamentos_inv.php">Editar Inventario de Artículos</a></li>		
															<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>
															<?php } else {	?>
															<li><a href="error_inventario.php">Editar Inventario de Artículos</a></li>		
															<li><a href="error_inventario.php">Devolucion a Proveedores</a></li>
														<?php } ?>
														<li><a href="reimprimir_dev_prov.php">Reimprimir Devolucion a Proveedores</a></li>
														
													</ul>
												</li>
												<li><a><i class="fa fa-check"></i>Contabilidad</a>
													<ul class="nav child_menu">
														<li class="subfirst"><a href="ventas_diarias_con.php">Ventas Diarias</a></li>
														<li><a href="devoluciones_diarias_con.php">Devoluciones Diarias (N/C)</a></li>
														<li><a href="reporte_ventas.php">Reporte de Ventas XLS</a></li>
														<li><a href="reporte_compras.php">Reporte de Entradas y Salidas de Merc XLS</a></li>
														<li><a href="ventas_impuesto.php">Impuesto por Ventas</a></li>
														<li><a href="compras_impuesto.php">Impuesto por Compras</a></li>
														<li><a href="reporte_ventasxls.php">Reporte de Ventas (Detalle) XLS</a></li>
														<li><a href="reporte_z.php">Corte Z y X</a></li>
														<li><a href="ordenes_mercancia.php">Ordenes de Mercancia Procesadas</a></li>
														<li><a href="nota_debito.php">Notas de Debito</a></li>
														<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>
														<li><a href="ventas_xero.php">Generar Ventas Xero</a></li>
														<li><a href="compras_xero.php">Generar Compras Xero</a></li>
														
													</ul>
												</li>
												<li><a><i class="fa fa-check"></i>Reportes</a>
													<ul class="nav child_menu">
														<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>
														<li><a href="mas_vendidos.php">Productos Más Vendidos</a></li>
														<li><a href="historico_movimientos.php">Historico de Movimientos por Producto</a></li>
														<li><a href="vencimiento.php">Medicamentos a Tres Meses de Vencimiento</a></li>
														
														<!--	<li><a href="vendidos_x_area.php">Productos Vendidos por Área</a></li>
														<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li> -->
														
														
													</ul>
												</li>
												<li><a><i class="fa fa-check"></i>Fiscal</a>
													<ul class="nav child_menu">
														<li class="subfirst"><a href="falta_fiscal.php">Obtener Fiscal</a></li>
														<li><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>
														<li><a href="reimprimir_fiscal_dev.php">Reimprimir Nota de Credito Fiscal</a></li>
														
														<!--	<li><a href="vendidos_x_area.php">Productos Vendidos por Área</a></li>
														<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li> -->
														
														
													</ul>
												</li>
												<li><a><i class="fa fa-check"></i>Usuarios</a>
													<ul class="nav child_menu">
														<li class="subfirst"><a href="usuarios.php">Creación de Usuarios</a></li>
														<li><a href="datos_generales.php">Datos Usuario</a></li>	
													<li><a href="usuarios_editar.php">Editar Usuarios</span></a></li>	
													
												</ul>
									</li>
									
									<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>
										
									</ul>
									<?php } else if ($_SESSION['MM_tipo'] == 6) { ?>
									<ul class="nav side-menu">
										<li class="topfirst"><a href="facturacion.php"><i class="fa fa-home"></i>Venta al Publico</a></li>
										<li><a href="devolucion_pub.php"><i class="fa fa-check"></i>N/C al Publico</a></li>
										<li><a href="cotizacion.php"><i class="fa fa-check"></i>Cotizaci&oacute;n</a></li>
										<li><a href="facturacion_credito.php"><i class="fa fa-check"></i>Pago de Cr&eacute;ditos</a></li>
										<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>
										<!--	<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>
										<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li> -->
										
										<li><a href="reporte_z.php"><i class="fa fa-check"></i>Reporte de Caja</a></li>
										
										<li>	<a href="falta_fiscal.php"><i class="fa fa-check"></i>Obtener Fiscal</a></li>
										<li><a href="factura_diaria.php"><i class="fa fa-check"></i>Facturas Diarias</a></li>
										<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>	
										<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>
											
										</ul>
										<?php } else if ($_SESSION['MM_tipo'] == 2) { ?>
										<ul class="nav side-menu">
											<li class="topfirst">
											<a href="devolucion_pub.php"><i class="fa fa-check"></i>N/C al Publico</a></li>
											<!--	<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>
											<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li> -->
											<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>
											<li><a><i class="fa fa-check"></i>Recetario</a>
												<ul class="nav child_menu">
													<li class="subfirst"><a href="facturacion_manual.php"><i class="fa fa-home"></i> Realizar Recetas</a></li>
													<li><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>
												</ul></li>
												
												<li><a><i class="fa fa-check"></i>Parametros</a>
													<ul class="nav child_menu">
														<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>
														
													</ul>
												</li>
												
												<li><a><i class="fa fa-check"></i>Contabilidad</a>
													<ul class="nav child_menu">
														<li class="subfirst"><a href="ventas_diarias_con.php">Ventas Diarias</a></li>
														<li><a href="devoluciones_diarias_con.php">Devoluciones Diarias (N/C)</a></li>
														<li><a href="reporte_z.php">Corte Z y X</a></li>
														
														
													</ul>
												</li>
												<li>	<a href="falta_fiscal.php"><i class="fa fa-check"></i>Obtener Fiscal</a></li>
												
												<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>	
												<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>
													
												</ul>
												<?php } else if ($_SESSION['MM_tipo'] == 5) { ?>
												<ul class="nav side-menu">
													<li class="topfirst"> 	<li class="topfirst"><a href="facturacion.php"><i class="fa fa-home"></i>Venta al Publico</a></li>
														<li><a href="cotizacion.php"><i class="fa fa-check"></i>Cotizaci&oacute;n</a></li>
														<li><a href="facturacion_credito.php"><i class="fa fa-check"></i>Pago de Cr&eacute;ditos</a></li>
														<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>
														<li><a><i class="fa fa-check"></i>Parametros</a>
															<ul class="nav child_menu">
																<li class="subfirst"><a href="formas_farma.php">Formas Farmaceuticas</a></li>
																<li><a href="contraindica.php">Contraindicaciones</a></li>
																<li><a href="fabricantes.php">Fabricantes</a></li> 
																<li><a href="posologias.php">Concentracion</a></li>
																
																<li><a href="proveedores.php">Proveedores</a></li>
																<li><a href="proveedores_caja.php">Proveedores de Caja</a></li>
																<li><a href="presentacion.php">Presentaciones</a></li>
																<li><a href="editar_costo_insumo.php">Par&acute;metros de Grupos</a></li>
																<li><a href="descuentos_por_dia.php">Descuentos por día</a></li>
																
															</ul>
														</li><li>	<a href="devolucion_pub.php"><i class="fa fa-check"></i>N/C al Publico</a></li>
														<!--	<li><a href="perfil_farmaceutico.php"><span><i class="fa fa-cart-plus"></i>Perfil Farmaceutico</span></a></li>
														<li><a href="ver_devoluciones.php"><span><i class="fa fa-cart-plus"></i>Facturas STAT / Devoluciones</span></a></li> -->
														<li><a><i class="fa fa-check"></i>Recetario</a>
															<ul class="nav child_menu">
																<li class="subfirst"><a href="facturacion_label.php"><i class="fa fa-check"></i>Impresión de Labels</a></li>
															</ul></li>
															<li><a href="reporte_z.php"><i class="fa fa-check"></i>Reporte de Caja</a></li>
															<li><a href="factura_diaria.php"><i class="fa fa-check"></i>Facturas Diarias</a></li>
															
															<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>	
															<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>
																
															</ul>
															<?php } else if ($_SESSION['MM_tipo'] == 7) { ?>
															<ul class="nav side-menu">
																<li class="topfirst"> <a><img src="../default.htm_files/css3menu1/home.png" alt="Cargos"/>Venta al Publico</a>
																	<ul class="nav child_menu">
																		<li class="subfirst"><a href="facturacion.php">Facturaci&oacute;n</a></li>
																		<li><a href="cotizacion.php" >Cotizaci&oacute;n</a></li>
																		<li><a href="facturacion_label.php" >Impresión de Labels</a></li>
																		<li><a href="editar_medicamentos_cb.php">Imprimir Label Producto</a></li>
																		<li><a href="editar_medicamentos_cba.php">Imprimir Label Precio</a></li>
																		
																		
																	</ul></li>
																	<li><a href="devolucion_pub.php"><i class="fa fa-check"></i>N/C al Publico</a></li>
																	<li><a href="facturacion_credito.php"><i class="fa fa-check"></i>Pago de Cr&eacute;ditos</a></li>
																	<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>
																	
																	<li><a><i class="fa fa-check"></i>Art&iacute;culos</a>
																		<ul class="nav child_menu">
																			<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>
																			<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>
																			<li ><a href="agregar_insumos.php">Agregar Productos</a></li>
																			<li><a href="editar_insumo_us.php">Editar Productos</a></li>
																			<!-- <li><a href="editar_costo_insumo.php">Costo por Grupo</a></li> -->
																		</ul></li>	
																		
																		<li><a><i class="fa fa-check"></i>Parametros</a>
																			<ul class="nav child_menu">
																				<!-- <li class="subfirst"><a href="formas_farma.php">Formas Farmaceuticas</a></li>
																				<li><a href="contraindica.php">Contraindicaciones</a></li> -->
																				<li><a href="fabricantes.php">Fabricantes</a></li> 
																				<!--	<li><a href="posologias.php">Concentracion</a></li>
																					
																					<li><a href="proveedores.php">Proveedores</a></li>
																					<li><a href="proveedores_caja.php">Proveedores de Caja</a></li>
																					<!--	<li><a href="presentacion.php">Presentaciones</a></li>
																				<li><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li> -->
																				<li><a href="proveedores.php">Proveedores</a></li>
																			</ul>
																		</li> 
																		
																		<li><a><i class="fa fa-cart-plus"></i>Compras</a>
																			<ul class="nav child_menu">
																				<?php if($estado != 'S'){ ?>
																					<li class="subfirst"><a href="orden_compras_detalle.php">Pedidos Manuales</a></li>
																					<li><a href="inventario_bajo.php">Listado de Inventario Bajo - Pedidos Automáticos</a></li>
																					<li><a href="inventario_bajo_x_prov.php">Listado de Inventario Bajo por Proveedor - Pedidos Automáticos</a></li>
																					<li><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>
																					<li><a href="procesar_compra_credito.php">Nota de Crédito Pendiente</a></li>
																					<li><a href="anular_orden_compra.php">Anular Pedido</a></li>
																					<?php } else {	?>
																					<li class="subfirst"><a href="error_inventario.php">Pedidos Manuales</a></li>
																					<li><a href="error_inventario.php">Listado de Inventario Bajo - Pedidos Automáticos</a></li>
																					<li><a href="error_inventario.php">Listado de Inventario Bajo por Proveedor - Pedidos Automáticos</a></li>
																					<li><a href="error_inventario.php">Procesar Pedidos</a></li>
																					<li><a href="error_inventario.php">Nota de Crédito Pendiente</a></li>
																					<li><a href="error_inventario.php">Anular Pedido</a></li>		
																				<?php } ?>
																				<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>
																				<li><a href="reimprimir_compra_r.php">Reimprimir Compra (Ingreso de Mercancía)</a></li>
																				
																				<li><a href="imprimir_med_pend_compra.php">Listado de Art&iacute;culos Pendiente en O/C</a></li>
																				<!--	<li><a href="imprimir_med_pend_compra_adm.php">Listado de Art&iacute;culos Asignados a O/C Adm.</a></li> 
																					<li><a href="caja_menuda.php">Recibos de Caja</a></li>
																					<li><a href="reporte_caja.php">Reporte de Caja</a></li>
																				<li><a href="cierre_caja.php">Cierre de Caja</a></li> -->
																			</ul>
																		</li>	
																		
																		
																		<li><a><i class="fa fa-cart-plus"></i>Inventario</a>
																			<ul class="nav child_menu">
																				<li class="subfirst"><a href="imprimir_med.php" target="_blank">Listado de Artículos</a></li>
																				<li><a href="imprimir_medicamento_xls.php">Listado Artículos XLS</a></li>
																				<?php if($estado != 'S'){ ?>
																					<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>		
																					<li><a href="traslado_detalle.php">Traslado entre Bodegas</a></li>
																					<!--	<li><a href="traslado_detalle_ext.php">Traslado entre Bodegas Externas</a></li> -->
																					<?php } else {	?>
																					<li><a href="error_inventario.php">Ingreso de Mercancía</a></li>		
																					<li><a href="error_inventario.php">Traslado entre Bodegas</a></li>
																				<?php } ?>
																				<li><a href="imprimir_inv.php" target="_blank">Inventario Total de Artículos</a></li>
																				<li><a href="imprimir_medicamentoprecio_xls.php">Listado Artículos con Precio y Cantidad XLS</a></li>
																				<li><a href="orden_compras_detalle_ext.php">Solicitar Mercanc&iacute;a Bodegas Externas</a></li> 
																				<li><a href="orden_pen.php">Ordenes a Procesar Externas</a></li> 
																				
																				<!--	<li><a href="imprimir_medicamentoprecious_xls.php">Listado Medicamentos para USPSG XLS</a></li> 
																					<li><a href="imprimir_ins.php" target="_blank">Inventario Total de Insumos</a></li>
																					<li><a href="imprimir_pre.php" target="_blank">Precios de Artículos</a></li>
																				<li><a href="editar_medicamentos_inv.php">Editar Inventario de Artículos</a></li> -->
																				
																				<?php if($estado != 'S'){ ?>
																					<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>
																					<?php } else {	?>
																					<li><a href="error_inventario.php">Devolucion a Proveedores</a></li>
																				<?php } ?>
																				<li><a href="reimprimir_dev_prov.php">Reimprimir Devolucion a Proveedores</a></li>
																			</ul>
																		</li>
																		
																		<li><a><i class="fa fa-check"></i>Reportes</a>
																			<ul class="nav child_menu">
																				<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>
																				<li><a href="mas_vendidos.php">Productos Más Vendidos</a></li>
																				<li><a href="historico_movimientos.php">Historico de Movimientos por Producto</a></li>
																				<li><a href="reporte_z.php">Corte Z y X</a></li>
																				
																				<!--	<li><a href="vendidos_x_area.php">Productos Vendidos por Área</a></li>
																				<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li> -->
																				
																				
																			</ul>
																		</li>
																		
																		<li><a><i class="fa fa-check"></i>Fiscal</a>
																			<ul class="nav child_menu">
																				<li class="subfirst"><a href="falta_fiscal.php">Obtener Fiscal</a></li>
																				<li><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>
																				<li><a href="reimprimir_fiscal_dev.php">Reimprimir Nota de Credito Fiscal</a></li>
																				
																				<!--	<li><a href="vendidos_x_area.php">Productos Vendidos por Área</a></li>
																				<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li> -->
																				
																				
																			</ul>
																		</li>
																		
																		
																		<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>	
																		<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>
																			
																		</ul>
																		<?php } else if ($_SESSION['MM_tipo'] == 4) { ?>
																		<ul class="nav side-menu">
																			<li class="topfirst"><a><i class="fa fa-cart-plus"></i>Clientes</a>
																				<ul class="nav child_menu">
																					<li><a href="pago_creditos.php">Pago a Créditos</a></li>
																					<li><a href="listado_clientes.php">Listado de Clientes</a></li>
																					
																				</ul>
																			</li>	
																			
																			<li><a href="consulta_producto.php"><i class="fa fa-check"></i>Consulta Inventario</a></li>
																			<li><a><i class="fa fa-cart-plus"></i>Compras</a>
																				<ul class="nav child_menu">
																					<li class="subfirst"><a href="caja_menuda.php">Recibos de Caja</a></li>
																					<li><a href="reporte_caja.php">Reporte de Caja</a></li>
																					<li><a href="cierre_caja.php">Cierre de Caja</a></li>
																				</ul>
																			</li>
																			
																			<li><a><i class="fa fa-cart-plus"></i>Inventario</a>
																				<ul class="nav child_menu">
																					<li class="subfirst"><a href="imprimir_inv.php" target="_blank">Inventario Total de Artículos</a></li>
																					<li><a href="imprimir_medicamentoprecio_xls.php">Listado Artículos con Precio y Cantidad XLS</a></li>
																					
																					
																					
																					<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>
																					
																					
																				</ul>
																			</li>
																			
																			<li><a><i class="fa fa-check"></i>Contabilidad</a>
																				<ul class="nav child_menu">
																					<li class="subfirst"><a href="ventas_diarias_con.php">Ventas Diarias</a></li>
																					<li><a href="devoluciones_diarias_con.php">Devoluciones Diarias (N/C)</a></li>
																					<li><a href="ventas_impuesto.php">Impuesto por Ventas</a></li>
																					<li><a href="compras_impuesto.php">Impuesto por Compras</a></li>
																					<li><a href="reporte_z.php">Corte Z y X</a></li>
																					<li><a href="ordenes_mercancia.php">Ordenes de Mercancia Procesadas</a></li>
																					<li><a href="nota_debito.php">Notas de Debito</a></li>
																					<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>
																					
																				</ul>
																			</li>
																			<li><a><i class="fa fa-check"></i>Reportes</a>
																				<ul class="nav child_menu">
																					<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>
																					<li><a href="mas_vendidos.php">Productos Más Vendidos</a></li>
																					<!--	<li><a href="vendidos_x_area.php">Productos Vendidos por Área</a></li>
																					<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li> -->
																					
																					
																				</ul>
																			</li>
																			
																			
																			<li><a href="datos_generales.php"><span><i class="fa fa-check"></i>Datos Usuario</span></a></li>	
																			<li class="toplast"><a href="logout.php"><i class="fa fa-check"></i>Salir</a>
																				
																			</ul>
																		<?php } ?>
																		
															</div>
															
													</div>
													<!-- /sidebar menu -->
													
												</div>
										</div>
										
										<!-- top navigation -->
										<div class="top_nav">
											<div class="nav_menu">
												<nav>
													<div class="nav toggle">
														<a id="menu_toggle"><i class="fa fa-bars"></i></a>
													</div>
													
													<ul class="nav navbar-nav navbar-right">
														<li class="">
															<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
																<?=$_SESSION['MM_nombre']?>
																<span class=" fa fa-angle-down"></span>
															</a>
															<ul class="dropdown-menu dropdown-usermenu pull-right">
																<li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
															</ul>
														</li>
													</ul>
												</nav>
											</div>
										</div>
										<!-- /top navigation -->
										
										<!-- page content -->
										<div class="right_col" role="main">
											
										</div>
										<!-- /page content -->
										<footer>
											<div class="pull-right">
												
											</div>
											<div class="clearfix"></div>
										</footer>
									</div>
								</div>
								
								<!-- jQuery -->
								<script src="../vendors/jquery/dist/jquery.min.js"></script>
								<!-- Bootstrap -->
								<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
								<!-- FastClick -->
								<script src="../vendors/fastclick/lib/fastclick.js"></script>
								<!-- NProgress -->
								<script src="../vendors/nprogress/nprogress.js"></script>
								<!-- Chart.js -->
								<script src="../vendors/Chart.js/dist/Chart.min.js"></script>
								<!-- gauge.js -->
								<script src="../vendors/gauge.js/dist/gauge.min.js"></script>
								<!-- bootstrap-progressbar -->
								<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
								<!-- iCheck -->
								<script src="../vendors/iCheck/icheck.min.js"></script>
								<!-- Skycons -->
								<script src="../vendors/skycons/skycons.js"></script>
								<!-- Flot -->
								<script src="../vendors/Flot/jquery.flot.js"></script>
								<script src="../vendors/Flot/jquery.flot.pie.js"></script>
								<script src="../vendors/Flot/jquery.flot.time.js"></script>
								<script src="../vendors/Flot/jquery.flot.stack.js"></script>
								<script src="../vendors/Flot/jquery.flot.resize.js"></script>
								<!-- Flot plugins -->
								<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
								<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
								<script src="../vendors/flot.curvedlines/curvedLines.js"></script>
								<!-- DateJS -->
								<script src="../vendors/DateJS/build/date.js"></script>
								<!-- JQVMap -->
								<script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
								<script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
								<script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
								<!-- bootstrap-daterangepicker -->
								<script src="../vendors/moment/min/moment.min.js"></script>
								<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
								
								<!-- Custom Theme Scripts -->
								<script src="../build/js/custom.min.js"></script>
								
								</body>
							</html>																	
<?php
	
				if ($_SESSION['MM_tipo'] == 2) { 
				$reg .='<ul class="nav child_menu">';
				if($estado != 'S'){ 
					$reg .='<li class="topfirst"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
					} else {	
					$reg .='<li class="topfirst"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
				} 
				$reg .='<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a>';
				if($estado != 'S'){ 
					$reg .='<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
					} else {	
					$reg .='<li class="topmenu"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
				} 
				$reg .='<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>';
				$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Insumos</a>';
				$reg .='<ul>';
				$reg .='<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>';
				$reg .='<li><a href="editar_insumo_us.php">Editar Insumos</a></li>';
				$reg .='<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>';	
				
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
				$reg .='<ul>';
				$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
				$reg .='</ul></li>';
				
				$reg .='<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>';
				
				$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>';
				$reg .='<ul>';
				$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
				$reg .='<li><a href="principios_activos.php">Principios Activos</a></li>';		
				$reg .='</ul>';
				$reg .='</li>';
				$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>';
				$reg .='<ul>';
				$reg .='<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
				$reg .='<li><a href="prep_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Preparaciones Pendientes</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>';
				$reg .='<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>';
				$reg .='<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Búsqueda por FU</a></li>';
				$reg .='<li><a href="estado_cargosf.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>';
				$reg .='<li><a href="liberar_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Liberar Cargo</a></li>';
				$reg .='<li><a href="reactivar_paciente.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reactivar Pacientes</a></li>';
				$reg .='<li><a href="facturacion_cargos.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Cargos Manuales';
				$reg .='<li><a href="devolucion_pub_manual.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>N/C Manuales</a></li>';
				$reg .='</a></li>';	
				$reg .='</ul></li>';	
				
				
				$reg .='<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>';
				$reg .='<ul>';
				$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
				$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
				$reg .='<li><a href="reimprimir_banco.php">Reimprimir Banco</a></li>';
				$reg .='<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>';
				$reg .='</ul></li>';
				$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>';
				$reg .='<ul>';
				$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
				$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
				$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
				$reg .='</ul></li>';
				
				$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>';
				$reg .='<ul><li class="subfirst"><a href="editar_medicamentos_estado.php">Inactivar / Borrar Medicamentos</a></li>';
				$reg .='<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>';	
				$reg .='<li><a href="ajustes_inventario.php">Ajustes a Inventario</a></li>';
				$reg .='<li><a href="editar_medicamentos_lotes.php">Ajustes a Lotes</a></li>';		
				$reg .='</ul></li>';
				
				$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>';
				$reg .='<ul>';
				$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
				$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>'; 
				$reg .='<li class="subfirst"><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				
				$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reportes</a>';
				$reg .='<ul>';
				$reg .='<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>';
				$reg .='<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li>';
				
				
				$reg .='</ul>';
				$reg .='</li>';
				
				$reg .='<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>';		
				$reg .='<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>';
				$reg .='</ul>';
				} else if ($_SESSION['MM_tipo'] == 5) { 
		$reg .='<ul class="nav child_menu">';
		$reg .='<li class="topfirst"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
		$reg .='<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>';
		$reg .='<li><a href="estado_cargosf.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>';
		$reg .='<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';			
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
		$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
		$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
		$reg .='</ul></li>';		
		$reg .='<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>';	
		$reg .='<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>';
		$reg .='</ul>';
		} else  if ($_SESSION['MM_tipo'] == 3) { 
		$reg .='<ul class="nav child_menu">';
		if($estado != 'S'){ 
			$reg .='<li class="topfirst"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
			} else {	
			$reg .='<li class="topfirst"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
		} 
		$reg .='<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
		$reg .='<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>';
		$reg .='<li><a href="estado_cargosf.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>';
		$reg .='<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>';
		
		$reg .='</ul></li>';	
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
		$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
		$reg .='</ul></li>';	
		$reg .='<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
		$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
		$reg .='<li><a href="reimprimir_banco.php">Reimprimir Bancos</a></li>';
		$reg .='<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>';
		$reg .='</ul></li>';				
		$reg .='<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
		$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="orden_compras_detalle.php">Pedidos Manuales</a></li>';
		$reg .='<li><a href="inventario_bajo.php">Pedidos Automáticos</a></li>';
		$reg .='<li><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>';
		$reg .='<li><a href="procesar_compra_credito.php">Nota de Crédito Pendiente</a></li>';
		$reg .='<li><a href="anular_orden_compra.php">Anular Pedido</a></li>';
		$reg .='<li><a href="caja_menuda.php">Recibos de Caja</a></li>';
		$reg .='</ul>';
		$reg .='</li>';				
		/*	$reg .='<li class="toplast"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>';
			$reg .='<ul>';
			$reg .='<li class="subfirst"><a href="imprimir_med.php">Listado de Medicamentos</a></li>';
			$reg .='<li><a href="inventario_x_bodega.php">Inventario por Bodega</a></li>';
			$reg .='<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>';
			$reg .='<li><a href="imprimir_inv.php">Inventario Total de Medicamentos</a></li>';
			$reg .='<li><a href="imprimir_pre.php">Precios de Medicamentos</a></li>';
			$reg .='</ul>'; 
		</li>'; */
		$reg .='<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>';	
		$reg .='<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>';
		$reg .='</ul>';
		
		} else  if ($_SESSION['MM_tipo'] == 4) {   
		$reg .='<ul class="nav child_menu">';
		$reg .='<li class="topfirst"><a href="facturas_paciente.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Facturas por Paciente</a></li>';
		
		if($estado != 'S'){ 
			$reg .='<li class="topmenu"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
			} else {	
			$reg .='<li class="topmenu"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
		} 
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>';	
		$reg .='<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>';
				
		$reg .='</ul>';
		} else  if ($_SESSION['MM_tipo'] == 1) {  
		$reg .='<ul class="nav child_menu">';
		$reg .='<li class="topfirst"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>P&uacute;blico</a>';
		$reg .='<ul>';
		
		$reg .='<li class="subfirst"><a href="facturacion.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturaci&oacute;n</a></li>';
		$reg .='<li><a href="agregar_clientes.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Agregar Clientes</a></li>';
		$reg .='<li><a href="facturacion_credito.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Pagos a Cr&eacute;dito</a></li>';
		$reg .='<li><a href="cotizacion.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Cotizaci&oacute;n</a></li>';
		$reg .='<li><a href="devolucion_pub.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Devolucion</a></li>';
		
		$reg .='</ul>';
		$reg .='</li>';
		
		/*	reg .='<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>';
		reg .='<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li> */
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		
		$reg .='<li class="topfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>';
		
		
		$reg .='<li class="topmenu"><a href="factura_diaria.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Facturas Diarias</a></li>';
		$reg .='<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a>';
		
		$reg .='<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>';
		if($estado != 'S'){ 
			$reg .='<li class="tomenu"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
			} else {	
			$reg .='<li class="topmenu"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
		} 
		if($estado != 'S'){ 
			$reg .='<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
			} else {	
			$reg .='<li class="topmenu"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
		} 
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
		$reg .='<li><a href="prep_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Preparaciones Pendientes</a></li>';
		$reg .='<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>';
		$reg .='<li><a href="estado_cargosatc_f.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>';
		$reg .='<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Búsqueda por FU</a></li>';
		$reg .='<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>';
		$reg .='<li><a href="liberar_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Liberar Cargo</a></li>';
		$reg .='<li><a href="liberar_historia.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Liberar Historia</a></li>';
		$reg .='<li><a href="reactivar_paciente.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reactivar Pacientes</span></a></li>';
		$reg .='<li><a href="facturacion_cargos.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Cargos Manuales</a></li>';
		$reg .='<li><a href="devolucion_pub_manual.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>N/C Manuales</a></li>';
		$reg .='</ul></li>';	
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Usuarios</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="usuarios.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Creación de Usuarios</a></li>';
		$reg .='<li><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>';	
		$reg .='<li><a href="usuarios_editar.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Editar Usuarios</span></a></li>';	
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Artículos"/>Art&iacute;culos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
		$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
		$reg .='<li ><a href="agregar_insumos.php">Agregar Productos</a></li>';
		$reg .='<li><a href="editar_insumo_us.php">Editar Productos</a></li>';
		$reg .='<li><a href="editar_medicamentos_cb.php">Imprimir Label Producto</a></li>';
		$reg .='<li><a href="editar_medicamentos_cba.php">Imprimir Label Precio</a></li>';
		/* <li><a href="editar_costo_insumo.php">Costo por Grupo</a></li>'; */
		$reg .='</ul></li>';	
		
		$reg .='<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
		$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
		$reg .='<li><a href="reimprimir_banco.php">Reimprimir Bancos</a></li>';
		$reg .='<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>';
		
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>';
		$reg .='<ul>';
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
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Insumos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>';
		$reg .='<li><a href="editar_insumo_us.php">Editar Insumos</a></li>';
		$reg .='<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>';	
		$reg .='<li><a href="editar_costo_insumo.php">Costo por Grupo</a></li>';
		$reg .='</ul>';
		$reg .='</li>';	
		
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>';
		$reg .='<ul>';
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
		
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>';
		$reg .='<ul>';
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
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Conteo F&iacute;sico</a>';
		$reg .='<ul>';
		/*  $reg .='<li class="subfirst"><a href="apertura_cierre_anaquel.php">Conteo de Anaqueles</a></li>'; */
		$reg .='<li><a href="conteo_inventario.php">Conteo de Inventario</a></li>';
		$reg .='<li><a href="imprimir_conteo_xls.php">Reporte por Anaquel</a></li>';
		$reg .='<li><a href="imprimir_conteo_sum_xls.php">Reporte por Producto</a></li>';
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>';
		$reg .='<ul>';
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
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reportes</a>';
		$reg .='<ul>';
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
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reportes 2</a>';
		$reg .='<ul>';
		
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
		
		
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Clientes</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_clientes.php">Agregar Clientes</a></li>';
		$reg .='<li><a href="editar_clientes_us.php">Editar Clientes</a></li>';
		$reg .='<li><a href="tipo_clientes.php">Tipos de Clientes</a></li>';
		/*	<li><a href="pago_creditos.php">Pago a Créditos</a></li>'; */
		$reg .='<li><a href="listado_clientes.php">Listado de Clientes</a></li>';
		$reg .='<li><a href="estados_cuenta.php">Estados de Cuenta</a></li>';
		
		$reg .='</ul>';
		$reg .='</li>';		
		$reg .='<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>';
		
		$reg .='</ul>';
		} else  if ($_SESSION['MM_tipo'] == 6) {  
		$reg .='<ul class="nav child_menu">';
		if($estado != 'S'){ 
			$reg .='<li class="topfirst"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
			} else {	
			$reg .='<li class="topfirst"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
		} 
		if($estado != 'S'){ 
			$reg .='<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
			} else {	
			$reg .='<li class="topmenu"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
		} 
		$reg .='<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a></li>';
		$reg .='<li class="topmenu"><a href="facturacion_cargos.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Cargos Manuales</span></a></li>';	
		$reg .='<li class="topmenu"><a href="devolucion_pub_manual.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>N/C Manuales</span></a></li>';	
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>';
		$reg .='<ul>';
		
		$reg .='<li><a href="caja_menuda.php">Recibos de Caja</a></li>';
		$reg .='<li><a href="reporte_caja.php">Reporte de Caja</a></li>';
		$reg .='<li><a href="cierre_caja.php">Cierre de Caja</a></li>';
		$reg .='</ul>';
		$reg .='</li>';	
		
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>';
		$reg .='<ul>';
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
		$reg .='<li class="topmenu"><a href="estado_cargosatc_f.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Estado de Cargos</span></a></li>';
		$reg .='<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Búsqueda por FU</a></li>';
		$reg .='<li class="topmenu"><a href="estado_cargosatc_f_inac.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
		
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>';
		
		$reg .='<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>';
		$reg .='<li class="topmenu"><a href="db_backup.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Backup</span></a></li>';	
		$reg .='<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>';
		
		$reg .='</ul>';
		
		} else if ($_SESSION['MM_tipo'] == 7) { 
		$reg .='<ul class="nav child_menu">';
		if($estado != 'S'){ 
			$reg .='<li class="topfirst"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
			} else {	
			$reg .='<li class="topfirst"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
		} 
		$reg .='<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a>';
		$reg .='<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
		$reg .='<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Insumos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>';
		$reg .='<li><a href="editar_insumo_us.php">Editar Insumos</a></li>';
		$reg .='<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>';	
		
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
		$reg .='<li><a href="principios_activos.php">Principios Activos</a></li>';
		
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
		$reg .='<li><a href="prep_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Preparaciones Pendientes</a></li>';
		$reg .='<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>';
		$reg .='<li><a href="estado_cargosf.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>';
		$reg .='<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Búsqueda por FU</a></li>';
		$reg .='<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>';
		$reg .='<li><a href="liberar_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Liberar Cargo</a></li>';
		$reg .='</ul></li>';	
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>';
		
		$reg .='<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
		$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
		$reg .='<li><a href="reimprimir_banco.php">Reimprimir Bancos</a></li>';
		$reg .='<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
		$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
		$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
		$reg .='</ul></li>';
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="orden_compras_detalle.php">Pedidos Manuales</a></li>';
		$reg .='<li><a href="inventario_bajo.php">Pedidos Automáticos</a></li>';
		$reg .='<li><a href="anular_orden_compra.php">Anular Pedido</a></li>';
		$reg .='<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>';
		
		$reg .='</ul>';
		$reg .='</li>';	
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst">';
		$reg .='<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>';		
		$reg .='</ul></li>';
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>';
		$reg .='<ul>';
		$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
		$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>';
		$reg .='<li class="subfirst"><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
		
		$reg .='</ul>';
		$reg .='</li>';
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reportes</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>';
		$reg .='<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li>';
		
		
		$reg .='</ul>';
		$reg .='</li>';
		
		$reg .='<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>';		
		$reg .='<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>';
		$reg .='</ul>';
		} else if ($_SESSION['MM_tipo'] == 8) { 
		$reg .='<ul class="nav child_menu">';
		if($estado != 'S'){ 
			$reg .='<li class="topfirst"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
			} else {	
			$reg .='<li class="topfirst"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
		} 
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a>';
		if($estado != 'S'){ 
			$reg .='<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
			} else {	
			$reg .='<li class="topmenu"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
		} 
		$reg .='<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Insumos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>';
		$reg .='<li><a href="editar_insumo_us.php">Editar Insumos</a></li>';
		$reg .='<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>';	
		
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
		$reg .='<li><a href="principios_activos.php">Principios Activos</a></li>';
		
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
		$reg .='<li><a href="prep_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Preparaciones Pendientes</a></li>';
		$reg .='<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>';
		$reg .='<li><a href="estado_cargosf.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>';
		$reg .='<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Búsqueda por FU</a></li>';
		$reg .='<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>';
		$reg .='<li><a href="liberar_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Liberar Cargo</a></li>';
		
		$reg .='</ul></li>';	
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>';
		
		$reg .='<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
		$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
		$reg .='<li><a href="reimprimir_banco.php">Reimprimir Bancos</a></li>';
		$reg .='<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
		$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
		$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
		$reg .='</ul></li>';
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>';
		$reg .='<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>';
		$reg .='<li><a href="reimprimir_compra_r.php">Reimprimir Compra (Ingreso de Mercancía)</a></li>';
		$reg .='<li><a href="imprimir_med_pend_compra.php">Listado de Medicamentos Pendiente en O/C</a></li>';
		$reg .='<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>';
		$reg .='</ul>';
		$reg .='</li>';	
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst">';
		$reg .='<a href="compras_detalle.php">Ingreso de Mercancía</a></li>';	
		$reg .='<li><a href="traslado_ins_med.php">Traslado de Insumos a Medicamentos</a></li>';
		$reg .='<li><a href="traslado_med_ins.php">Traslado de Medicamentos a Insumos</a></li>';	
		$reg .='</ul></li>';
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>';
		$reg .='<ul>';
		$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
		$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>';
		$reg .='<li class="subfirst"><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
		
		
		
		$reg .='</ul>';
		$reg .='</li>';
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reportes</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>';
		$reg .='<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li>';
		
		
		$reg .='</ul>';
		$reg .='</li>';
		
		
		$reg .='<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>';		
		$reg .='<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>';
		$reg .='</ul>';
		} else if ($_SESSION['MM_tipo'] == 9) { 
		$reg .='<ul class="nav child_menu">';
		if($estado != 'S'){ 
			$reg .='<li class="topfirst"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
			} else {	
			$reg .='<li class="topfirst"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
		} 
		$reg .='<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a>';
		if($estado != 'S'){ 
			$reg .='<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
			} else {	
			$reg .='<li class="topmenu"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
		} 
		$reg .='<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Insumos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>';
		$reg .='<li><a href="editar_insumo_us.php">Editar Insumos</a></li>';
		$reg .='<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>';	
		
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
		$reg .='<li><a href="principios_activos.php">Principios Activos</a></li>';
		
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>';
		$reg .='<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>';
		$reg .='<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>';
		$reg .='<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Búsqueda por FU</a></li>';
		$reg .='<li><a href="estado_cargosf.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>';
		$reg .='<li><a href="liberar_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Liberar Cargo</a></li>';
		$reg .='</ul></li>';	
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>';
		$reg .='<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>';
		$reg .='<li><a href="reimprimir_banco.php">Reimprimir Banco</a></li>';
		$reg .='<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
		$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
		$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst">';
		$reg .='<a href="inventario_x_bodega.php">Inventario por Bodega</a></li>';
		$reg .='<li><a href="editar_inventario_bodega.php">Editar Inventario por Bodega</a></li>';
		$reg .='<li><a href="compras_detalle.php">Ingreso de Mercancía</a></li>';		
		$reg .='<li><a href="traslado_detalle.php">Traslado entre Bodegas</a></li>';
		
		
		
		$reg .='</ul>';
		$reg .='</li>';
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>';
		$reg .='<ul>';
		$reg .='<li><a href="nota_debito.php">Notas de Debito</a></li>';
		$reg .='<li><a href="nota_factura.php">Notas de Crédito Manual por Factura</a></li>'; 
		$reg .='<li class="subfirst"><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>';
		
		
		
		$reg .='</ul>';
		$reg .='</li>';
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reportes</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>';
		
		
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>';		
		$reg .='<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>';
		$reg .='</ul>';
		}  else  if ($_SESSION['MM_tipo'] == 10) {  
		$reg .='<ul class="nav child_menu">';
		if($estado != 'S'){ 
			$reg .='<li class="topfirst"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
			} else {	
			$reg .='<li class="topfirst"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generación de Facturas</span></a></li>';
		} 
		if($estado != 'S'){ 
			$reg .='<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
			} else {	
			$reg .='<li class="topmenu"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>';
		} 
		$reg .='<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>';
		$reg .='<ul>';
		
		$reg .='<li><a href="caja_menuda.php">Recibos de Caja</a></li>';
		$reg .='<li><a href="reporte_caja.php">Reporte de Caja</a></li>';
		$reg .='<li><a href="cierre_caja.php">Cierre de Caja</a></li>';
		$reg .='</ul>';
		$reg .='</li>';	
		
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>';
		$reg .='<ul>';
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
		$reg .='<li class="topmenu"><a href="estado_cargosatc_f.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Estado de Cargos</span></a></li>';
		$reg .='<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Búsqueda por FU</a></li>';
		$reg .='<li class="topmenu"><a href="estado_cargosatc_f_inac.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
		
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>P&uacute;blico</a>';
		$reg .='<ul>';
		
		$reg .='<li class="subfirst">';
		$reg .='<li><a href="pago_creditos.php" >Pagos a Cr&eacute;dito</a></li>';
		
		
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>';
		
		$reg .='<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>';
		
		$reg .='</ul>';
		} else if ($_SESSION['MM_tipo'] == 11) { 
		
		
		$reg .='<ul class="nav child_menu">';
		$reg .='<li class="topfirst"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Insumos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>';
		$reg .='<li><a href="editar_insumo_us.php">Editar Insumos</a></li>';
		$reg .='<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>';	
		
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>';
		$reg .='<li><a href="principios_activos.php">Principios Activos</a></li>';
		
		$reg .='</ul>';
		$reg .='</li>';
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresión de Labels</a></li>';
		$reg .='</ul></li>';	
		$reg .='<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>';
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>';
		$reg .='<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>';
		$reg .='<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>';
		$reg .='</ul></li>';
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst"><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>';
		$reg .='<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>';
		$reg .='<li><a href="reimprimir_compra_r.php">Reimprimir Compra (Ingreso de Mercancía)</a></li>';
		$reg .='<li><a href="imprimir_med_pend_compra.php">Listado de Medicamentos Pendiente en O/C</a></li>';
		$reg .='<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>';
		$reg .='</ul>';
		$reg .='</li>';	
		
		$reg .='<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>';
		$reg .='<ul>';
		$reg .='<li class="subfirst">';
		$reg .='<a href="compras_detalle.php">Ingreso de Mercancía</a></li>';	
		$reg .='<li><a href="traslado_ins_med.php">Traslado de Insumos a Medicamentos</a></li>';
		$reg .='<li><a href="traslado_med_ins.php">Traslado de Medicamentos a Insumos</a></li>';	
		$reg .='</ul></li>';
		
		
		
		$reg .='<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>';		
		$reg .='<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>';
		$reg .='</ul>';
		}  else if ($_SESSION['MM_tipo'] == 13) { 
		$reg .='<ul class="nav child_menu">';
		$reg .='<li class="topfirst"><a href="facturacion.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/>Venta al Publico</a></li>';
		$reg .='<li class="topmenu"><a href="devolucion_pub.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>N/C al Publico</a></li>';
		$reg .='<li class="topmenu"><a href="cotizacion.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Cotizaci&oacute;n</a></li>';
		$reg .='<li class="topmenu"><a href="facturacion_credito.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Pago de Cr&eacute;ditos</a></li>';
		$reg .='<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>';
		/*	reg .='<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>';
		reg .='<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>'; */
		$reg .='<li class="topmenu"><a href="reporte_z_caja.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reporte de Caja</a></li>';
		
		
		
		$reg .='<li>	<a href="falta_fiscal.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Obtener Fiscal</a></li>';
		$reg .='<li class="topmenu"><a href="factura_diaria.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Facturas Diarias</a></li>';
		$reg .='<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>';	
		$reg .='<li class="toplast"><a href="logout_caja.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>';
		
		$reg .='</ul>';
	}	
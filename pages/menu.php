<?php 
$r = "select estado from cierre_de_mes";
$res = mysql_query($r, $conn) or die(mysql_error());

while ($row = mysql_fetch_array($res)) {
$estado = $row['estado'];
}


if ($_SESSION['MM_tipo'] == 2) { ?>
<ul id="css3menu1" class="topmenu">
<?php if($estado != 'S'){ ?>
		<li class="topfirst"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } else {	?>
<li class="topfirst"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } ?>
	<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a>
	<?php if($estado != 'S'){ ?>
		<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } else {	?>
		<li class="topmenu"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } ?>
		<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>
				<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Insumos</a>
	<ul>
		<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>
		<li><a href="editar_insumo_us.php">Editar Insumos</a></li>
		<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>	
		
	</ul>
	</li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
			
		<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>
		
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>
	<ul>
		<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>
		<li><a href="principios_activos.php">Principios Activos</a></li>		
	</ul>
	</li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>
	<ul>
		<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>
		<li><a href="prep_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Preparaciones Pendientes</a></li>
		<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>
		<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>
		<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>B�squeda por FU</a></li>
		<li><a href="estado_cargosf.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>
		<li><a href="liberar_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Liberar Cargo</a></li>
		<li><a href="reactivar_paciente.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reactivar Pacientes</a></li>
		<li><a href="facturacion_cargos.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Cargos Manuales
		<li><a href="devolucion_pub_manual.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>N/C Manuales</a></li>
		</a></li>	
			</ul></li>	
			
					
	   		<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>
				<ul>
		<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>
		<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>
		<li><a href="reimprimir_banco.php">Reimprimir Banco</a></li>
		<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>
	</ul></li>
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>
			<ul>
		<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>
		<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>
		<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>
			</ul></li>
			
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>
		<ul><li class="subfirst"><a href="editar_medicamentos_estado.php">Inactivar / Borrar Medicamentos</a></li>
		<li><a href="compras_detalle.php">Ingreso de Mercanc�a</a></li>	
							<li><a href="ajustes_inventario.php">Ajustes a Inventario</a></li>
							<li><a href="editar_medicamentos_lotes.php">Ajustes a Lotes</a></li>		
			</ul></li>
 
 <li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>
	<ul>
		 <li><a href="nota_debito.php">Notas de Debito</a></li>
		<li><a href="nota_factura.php">Notas de Cr�dito Manual por Factura</a></li> 
		<li class="subfirst"><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>
	
	
	</ul>
	</li>
	
	
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reportes</a>
	<ul>
			<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>
			<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li>


	</ul>
	</li>
			
			<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>		
			<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>
</ul>
<?php } else if ($_SESSION['MM_tipo'] == 5) { ?>
<ul id="css3menu1" class="topmenu">
		<li class="topfirst"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>
	<ul>
		<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>
		<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>
		<li><a href="estado_cargosf.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>
		<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>
			</ul></li>
<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>			
	   	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>
			<ul>
		<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>
		<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>
		<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>
			</ul></li>		
			<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>	
			<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>
</ul>
<?php } else  if ($_SESSION['MM_tipo'] == 3) { ?>
<ul id="css3menu1" class="topmenu">
	<?php if($estado != 'S'){ ?>
		<li class="topfirst"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } else {	?>
		<li class="topfirst"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } ?>
	<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>
	<ul>
		<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>
			<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>
		<li><a href="estado_cargosf.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>
		<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>
		
			</ul></li>	
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
	
			
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>
			<ul>
		<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>
		<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>
	</ul></li>	
	<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>
				<ul>
		<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>
		<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>
		<li><a href="reimprimir_banco.php">Reimprimir Bancos</a></li>
		<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>
	</ul></li>				
				<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>
				<ul>
		<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>
		<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>
	</ul></li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>
	<ul>
			<li class="subfirst"><a href="orden_compras_detalle.php">Pedidos Manuales</a></li>
		<li><a href="inventario_bajo.php">Pedidos Autom�ticos</a></li>
		<li><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>
		<li><a href="procesar_compra_credito.php">Nota de Cr�dito Pendiente</a></li>
		<li><a href="anular_orden_compra.php">Anular Pedido</a></li>
		<li><a href="caja_menuda.php">Recibos de Caja</a></li>
	</ul>
	</li>				
<!--	<li class="toplast"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>
	<ul>
		<li class="subfirst"><a href="imprimir_med.php">Listado de Medicamentos</a></li>
		<li><a href="inventario_x_bodega.php">Inventario por Bodega</a></li>
		<li><a href="compras_detalle.php">Ingreso de Mercanc�a</a></li>
	    <li><a href="imprimir_inv.php">Inventario Total de Medicamentos</a></li>
		<li><a href="imprimir_pre.php">Precios de Medicamentos</a></li>
	</ul> 
	</li> -->
<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>	
	<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>
</ul>

  <?php   } else  if ($_SESSION['MM_tipo'] == 4) {   ?>
  <ul id="css3menu1" class="topmenu">
	<li class="topfirst"><a href="facturas_paciente.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Facturas por Paciente</a></li>
	
<?php if($estado != 'S'){ ?>
		<li class="topmenu"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } else {	?>
<li class="topmenu"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } ?>
<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
	<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>	
<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>
			
		
	
	
</ul> <?php } else  if ($_SESSION['MM_tipo'] == 1) {  ?>
  <ul id="css3menu1" class="topmenu">
  <li class="topfirst"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>P&uacute;blico</a>
	<ul>
	
	<li class="subfirst"><a href="facturacion.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturaci&oacute;n</a></li>
		<li><a href="agregar_clientes.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Agregar Clientes</a></li>
		<li><a href="facturacion_credito.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Pagos a Cr&eacute;dito</a></li>
		<li><a href="cotizacion.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Cotizaci&oacute;n</a></li>
		<li><a href="devolucion_pub.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Devolucion</a></li>
			
	</ul>
	</li>
  	
	<!--	<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>
			<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li> -->
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	
	<li class="topfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
			<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>
			
		
		<li class="topmenu"><a href="factura_diaria.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Facturas Diarias</a></li>
	<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a>
	
	<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>
	<?php if($estado != 'S'){ ?>
		<li class="tomenu"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } else {	?>
<li class="topmenu"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } ?>
		<?php if($estado != 'S'){ ?>
		<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } else {	?>
		<li class="topmenu"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } ?>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>
	<ul>
		<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>
		<li><a href="prep_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Preparaciones Pendientes</a></li>
		<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>
		<li><a href="estado_cargosatc_f.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>
		<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>B�squeda por FU</a></li>
			<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>
			<li><a href="liberar_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Liberar Cargo</a></li>
			<li><a href="liberar_historia.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Liberar Historia</a></li>
			<li><a href="reactivar_paciente.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reactivar Pacientes</span></a></li>
			<li><a href="facturacion_cargos.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Cargos Manuales</a></li>
			<li><a href="devolucion_pub_manual.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>N/C Manuales</a></li>
			</ul></li>	
			
				<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Usuarios</a>
				<ul>
		<li class="subfirst"><a href="usuarios.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Creaci�n de Usuarios</a></li>
		<li><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>	
		<li><a href="usuarios_editar.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Editar Usuarios</span></a></li>	
				</ul></li>
							<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Art�culos"/>Art&iacute;culos</a>
			<ul>
		<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>
		<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>
		<li ><a href="agregar_insumos.php">Agregar Productos</a></li>
		<li><a href="editar_insumo_us.php">Editar Productos</a></li>
		<li><a href="editar_medicamentos_cb.php">Imprimir Label Producto</a></li>
                <li><a href="editar_medicamentos_cba.php">Imprimir Label Precio</a></li>
		<!-- <li><a href="editar_costo_insumo.php">Costo por Grupo</a></li> -->
	</ul></li>	
	
			<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>
				<ul>
		<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>
		<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>
		<li><a href="reimprimir_banco.php">Reimprimir Bancos</a></li>
		<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>
		
	</ul></li>
		<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>
	<ul>
		<li class="subfirst"><a href="formas_farma.php">Formas Farmaceuticas</a></li>
		<li><a href="contraindica.php">Contraindicaciones</a></li>
	<!--	<li><a href="fabricantes.php">Fabricantes</a></li> -->
		<li><a href="posologias.php">Concentracion</a></li>
		<li><a href="principios_activos.php">Principios Activos</a></li>
		<li><a href="bancos.php">Bancos</a></li>
		<li><a href="proveedores.php">Proveedores</a></li>
		<li><a href="proveedores_caja.php">Proveedores de Caja</a></li>
		<li><a href="presentacion.php">Presentaciones</a></li>
		<li><a href="editar_costo_insumo_pub.php">Parametros por Grupo</a></li>
		<li><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>
		<li><a href="aseguradora.php">Aseguradoras</a></li>
	<!--	<li><a href="param_carros.php">Horas de Naves</a></li> !-->
	</ul>
	</li>
		<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Insumos</a>
	<ul>
		<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>
		<li><a href="editar_insumo_us.php">Editar Insumos</a></li>
		<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>	
		<li><a href="editar_costo_insumo.php">Costo por Grupo</a></li>
	</ul>
	</li>	
	
	
		<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>
	<ul>
		<li class="subfirst"><a href="orden_compras_detalle.php">Pedidos Manuales</a></li>
		<li><a href="inventario_bajo.php">Pedidos Autom�ticos</a></li>
		<li><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>
		<li><a href="procesar_compra_credito.php">Nota de Cr�dito Pendiente</a></li>
		<li><a href="anular_orden_compra.php">Anular Pedido</a></li>
		<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>
		<li><a href="reimprimir_compra_r.php">Reimprimir Compra (Ingreso de Mercanc�a)</a></li>
		<li><a href="imprimir_med_pend_compra.php">Listado de Medicamentos Pendiente en O/C</a></li>
		<li><a href="caja_menuda.php">Recibos de Caja</a></li>
		<li><a href="reporte_caja.php">Reporte de Caja</a></li>
		<li><a href="cierre_caja.php">Cierre de Caja</a></li>
	</ul>
	</li>	

				
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>
	<ul>
		<li class="subfirst"><a href="editar_medicamentos_estado.php">Inactivar / Borrar Medicamentos</a></li>
		<li><a href="inventario_x_bodega.php">Inventario por Bodega</a></li>
		<li><a href="editar_inventario_bodega.php">Editar Inventario por Bodega</a></li>
		<li><a href="compras_detalle.php">Ingreso de Mercanc�a</a></li>		
		<li><a href="imprimir_inv.php" target="_blank">Inventario Total de Medicamentos</a></li>
		<!-- <li><a href="imprimir_inv_costo.php" target="_blank">Inventario y Costo Total de Medicamentos</a></li> -->
		<li><a href="imprimir_inv_costo_xls.php" target="_blank">Inventario y Costo Total de Medicamentos XLS</a></li>
				<li><a href="editar_medicamentos_inv.php">Editar Precio</a></li>
						<!--	<li><a href="ajustes_inventario.php">Ajustes a Inventario</a></li> -->
							<li><a href="orden_compras_detalle_ext.php">Solicitar Mercanc&iacute;a Bodegas Externas</a></li> 
	  <li><a href="orden_pen.php">Ordenes a Procesar Externas</a></li> 
							<li><a href="editar_medicamentos_lotes.php">Ajustes a Lotes</a></li>
		<li><a href="traslado_detalle.php">Traslado entre Bodegas</a></li>
		<li><a href="traslado_ins_med.php">Traslado de Insumos a Medicamentos</a></li>
		<li><a href="traslado_med_ins.php">Traslado de Medicamentos a Insumos</a></li>
				<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>
			
		
		
	</ul>
	</li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Conteo F&iacute;sico</a>
	<ul>
			<!--  <li class="subfirst"><a href="apertura_cierre_anaquel.php">Conteo de Anaqueles</a></li> -->
				<li><a href="conteo_inventario.php">Conteo de Inventario</a></li>
				<li><a href="imprimir_conteo_xls.php">Reporte por Anaquel</a></li>
				<li><a href="imprimir_conteo_sum_xls.php">Reporte por Producto</a></li>
	</ul>
	</li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>
	<ul>
		<li class="subfirst"><a href="estado_cargosatc_id.php">Movimientos por Fecha</a></li>
		<li><a href="devoluciones_diarias_con.php">Devoluciones Diarias (N/C)</a></li>
		<li><a href="ventas_impuesto.php">Impuesto por Ventas</a></li>
		<li><a href="compras_impuesto.php">Impuesto por Compras</a></li>
		<li><a href="reporte_z.php">Corte Z y X Hospitalario</a></li>
		<li><a href="reporte_z_caja.php">Corte Z y X Publico</a></li>
		<li><a href="ordenes_mercancia.php">Ordenes de Mercancia Procesadas</a></li>
		<li><a href="nota_debito.php">Notas de Debito</a></li>
		<li><a href="nota_factura.php">Notas de Cr�dito Manual por Factura</a></li>
		<li><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>
		<li><a href="reimprimir_fiscal_dev.php">Reimprimir Nota de Credito Fiscal</a></li>
		<li><a href="ventas_xero.php">Ventas a Xero</a></li>
		<li><a href="compras_xero.php">Compras a Xero</a></li>
		
	
	</ul>
	</li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reportes</a>
	<ul>
			<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>
		<li><a href="mas_vendidos.php">Productos M�s Vendidos</a></li>
		<li><a href="vendidos_x_area.php">Productos Vendidos por �rea</a></li>
		<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li>
		<li><a href="tiempo_respuesta.php">Tiempos de Respuesta</a></li>
		<li><a href="sugerencias_farma.php">Sugerencias de Hospital</a></li>
			<li><a href="imprimir_med_snposo.php">Medicamentos sin Posolog�a</a></li>
				<li><a href="imprimir_med_sninve.php">Medicamentos sin Inv. Cr�tico/M�nimo</a></li>
				<li><a href="historico_movimientos.php">Historico de Movimientos por Producto</a></li>
				<li><a href="vencimiento.php">Medicamentos a Tres Meses o Menos de Vencimiento</a></li>

	</ul>
	</li>
	
		<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reportes 2</a>
	<ul>
	
	<li class="subfirst"><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>
		<li><a href="imprimir_medicamento_xls.php">Listado Medicamentos XLS</a></li>
		<li><a href="imprimir_med_imp.php" target="_blank">Listado de Medicamentos de Importaci�n</a></li>
		<li><a href="imprimir_medicamentogenerico_xls.php">Listado Medicamentos Generico XLS</a></li>
		<li><a href="imprimir_medicamentoprecio_xls.php">Listado Medicamentos con Precio y Cantidad XLS</a></li>
		<li><a href="imprimir_medicamentoprecious_xls.php">Listado Medicamentos para USPSG XLS</a></li>
		<li><a href="imprimir_ins.php" target="_blank">Inventario Total de Insumos</a></li>
		<li><a href="imprimir_pre.php" target="_blank">Precios de Medicamentos</a></li>
		<li><a href="reporte_cambio_costo.php">Cambio de Costo por Medicamento</a></li>
		<li><a href="reporte_ventas.php">Reporte de Ventas XLS</a></li>
		<li><a href="cambio_costo_fecha.php">Variaci�n de Costos por Fecha</a></li>
	
	</ul>
	</li>
	
		
	
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Clientes</a>
	<ul>
		<li class="subfirst"><a href="agregar_clientes.php">Agregar Clientes</a></li>
		<li><a href="editar_clientes_us.php">Editar Clientes</a></li>
		<li><a href="tipo_clientes.php">Tipos de Clientes</a></li>
	<!--	<li><a href="pago_creditos.php">Pago a Cr�ditos</a></li> -->
			<li><a href="listado_clientes.php">Listado de Clientes</a></li>
			<li><a href="estados_cuenta.php">Estados de Cuenta</a></li>
	
	</ul>
	</li>		
	<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>
	
</ul>
 <?php } else  if ($_SESSION['MM_tipo'] == 6) {  ?>
   <ul id="css3menu1" class="topmenu">
<?php if($estado != 'S'){ ?>
		<li class="topfirst"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } else {	?>
<li class="topfirst"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } ?>
			<?php if($estado != 'S'){ ?>
		<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } else {	?>
		<li class="topmenu"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } ?>
		<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a></li>
		<li class="topmenu"><a href="facturacion_cargos.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Cargos Manuales</span></a></li>	
		<li class="topmenu"><a href="devolucion_pub_manual.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>N/C Manuales</span></a></li>	
		<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>
	<ul>
		
		<li><a href="caja_menuda.php">Recibos de Caja</a></li>
		<li><a href="reporte_caja.php">Reporte de Caja</a></li>
		<li><a href="cierre_caja.php">Cierre de Caja</a></li>
	</ul>
	</li>	

		
		<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>
	<ul>
		<li class="subfirst"><a href="estado_cargosatc_id.php">Movimientos por Fecha</a></li>
		<li class="subfirst"><a href="estado_cargosatc_jub.php">Descuentos a Jubilados</a></li>
		<li class="subfirst"><a href="estado_cargosatc_aseg.php">Descuentos por Aseguradoras</a></li>
		<li><a href="devoluciones_diarias_con.php">Devoluciones Diarias (N/C)</a></li>
		<li><a href="ventas_impuesto.php">Impuesto por Ventas</a></li>
		<li><a href="compras_impuesto.php">Impuesto por Compras</a></li>
		<li><a href="reporte_z.php">Corte Z y X</a></li>
		<li><a href="ordenes_mercancia.php">Ordenes de Mercancia Procesadas</a></li>
		<li><a href="nota_debito.php">Notas de Debito</a></li>
		<li><a href="nota_factura.php">Notas de Cr�dito Manual por Factura</a></li>
		<li><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>
		<li><a href="reimprimir_fiscal_dev.php">Reimprimir Nota de Credito Fiscal</a></li>
		</ul>
		<li class="topmenu"><a href="estado_cargosatc_f.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Estado de Cargos</span></a></li>
		<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>B�squeda por FU</a></li>
		<li class="topmenu"><a href="estado_cargosatc_f_inac.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>
				<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>
	<ul>
		<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>
				
	</ul>
	</li>
	<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>
	
			<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>
					<li class="topmenu"><a href="db_backup.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Backup</span></a></li>	
		<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>
	
</ul>

<?php } else if ($_SESSION['MM_tipo'] == 7) { ?>
<ul id="css3menu1" class="topmenu">
		<?php if($estado != 'S'){ ?>
		<li class="topfirst"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } else {	?>
<li class="topfirst"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } ?>
			<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a>
		<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>
				<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Insumos</a>
	<ul>
		<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>
		<li><a href="editar_insumo_us.php">Editar Insumos</a></li>
		<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>	
		
	</ul>
	</li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>
	<ul>
		<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>
		<li><a href="principios_activos.php">Principios Activos</a></li>
		
	</ul>
	</li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>
	<ul>
		<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>
		<li><a href="prep_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Preparaciones Pendientes</a></li>
		<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>
		<li><a href="estado_cargosf.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>
		<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>B�squeda por FU</a></li>
		<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>
		<li><a href="liberar_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Liberar Cargo</a></li>
				</ul></li>	
			
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
	</li>
	<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>
					
	   		<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>
				<ul>
		<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>
		<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>
		<li><a href="reimprimir_banco.php">Reimprimir Bancos</a></li>
		<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>
	</ul></li>
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>
			<ul>
		<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>
		<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>
		<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>
			</ul></li>
			
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>
	<ul>
		<li class="subfirst"><a href="orden_compras_detalle.php">Pedidos Manuales</a></li>
		<li><a href="inventario_bajo.php">Pedidos Autom�ticos</a></li>
		<li><a href="anular_orden_compra.php">Anular Pedido</a></li>
		<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>

	</ul>
	</li>	
			
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>
	<ul>
		<li class="subfirst">
		<li><a href="compras_detalle.php">Ingreso de Mercanc�a</a></li>		
			</ul></li>
			
			 <li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>
	<ul>
		 <li><a href="nota_debito.php">Notas de Debito</a></li>
		<li><a href="nota_factura.php">Notas de Cr�dito Manual por Factura</a></li>
		<li class="subfirst"><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>
	
		
	
	</ul>
	</li>
	
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reportes</a>
	<ul>
			<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>
			<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li>


	</ul>
	</li>
			
			<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>		
			<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>
</ul>
<?php } else if ($_SESSION['MM_tipo'] == 8) { ?>
<ul id="css3menu1" class="topmenu">
		<?php if($estado != 'S'){ ?>
		<li class="topfirst"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } else {	?>
<li class="topfirst"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } ?>
<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
			<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a>
			<?php if($estado != 'S'){ ?>
		<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } else {	?>
		<li class="topmenu"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } ?>
		<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>
				<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Insumos</a>
	<ul>
		<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>
		<li><a href="editar_insumo_us.php">Editar Insumos</a></li>
		<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>	
		
	</ul>
	</li>
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>
	<ul>
		<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>
		<li><a href="principios_activos.php">Principios Activos</a></li>
		
	</ul>
	</li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>
	<ul>
		<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>
		<li><a href="prep_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Preparaciones Pendientes</a></li>
		<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>
		<li><a href="estado_cargosf.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>
		<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>B�squeda por FU</a></li>
		<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>
		<li><a href="liberar_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Liberar Cargo</a></li>
		
				</ul></li>	
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
	</li>
	<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>
					
	   		<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>
				<ul>
		<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>
		<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>
		<li><a href="reimprimir_banco.php">Reimprimir Bancos</a></li>
		<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>
	</ul></li>
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>
			<ul>
		<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>
		<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>
		<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>
			</ul></li>
	
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>
	<ul>
		<li class="subfirst"><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>
		<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>
		<li><a href="reimprimir_compra_r.php">Reimprimir Compra (Ingreso de Mercanc�a)</a></li>
		<li><a href="imprimir_med_pend_compra.php">Listado de Medicamentos Pendiente en O/C</a></li>
		<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>
			</ul>
	</li>	
	
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>
	<ul>
		<li class="subfirst">
		<a href="compras_detalle.php">Ingreso de Mercanc�a</a></li>	
			<li><a href="traslado_ins_med.php">Traslado de Insumos a Medicamentos</a></li>
		<li><a href="traslado_med_ins.php">Traslado de Medicamentos a Insumos</a></li>	
			</ul></li>
			
			 <li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>
	<ul>
		 <li><a href="nota_debito.php">Notas de Debito</a></li>
		<li><a href="nota_factura.php">Notas de Cr�dito Manual por Factura</a></li>
		<li class="subfirst"><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>
	
		
	
	</ul>
	</li>
	
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reportes</a>
	<ul>
			<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>
			<li><a href="vendidos_x_bodega.php">Productos Vendidos por Banco</a></li>


	</ul>
	</li>
			
			
			<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>		
			<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>
</ul>
<?php } else if ($_SESSION['MM_tipo'] == 9) { ?>
<ul id="css3menu1" class="topmenu">
			<?php if($estado != 'S'){ ?>
		<li class="topfirst"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } else {	?>
<li class="topfirst"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } ?>
			<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a>
		<?php if($estado != 'S'){ ?>
		<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } else {	?>
		<li class="topmenu"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } ?>
		<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>
				<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Insumos</a>
	<ul>
		<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>
		<li><a href="editar_insumo_us.php">Editar Insumos</a></li>
		<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>	
		
	</ul>
	</li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>
	<ul>
		<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>
		<li><a href="principios_activos.php">Principios Activos</a></li>
		
	</ul>
	</li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Cargos</a>
	<ul>
		<li class="subfirst"><a href="cargos_pen.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/> Cargos Pendientes</a></li>
		<li><a href="estado_cargosatc_f_inac.php"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>
		<li><a href="reimprimir_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reimprimir Cargos</a></li>
		<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>B�squeda por FU</a></li>
		<li><a href="estado_cargosf.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Estado de Ordenes</a></li>
		<li><a href="liberar_cargos.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Liberar Cargo</a></li>
			</ul></li>	
			
					<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
	</li>
	   		<li class="topmenu"><a href="#" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Naves</span></a>
				<ul>
		<li class="subfirst"><a href="cierre_carro.php">Cerrar Naves</a></li>
		<li><a href="reimprimir_mar.php">Reimprimir Naves</a></li>
		<li><a href="reimprimir_banco.php">Reimprimir Banco</a></li>
		<li><a href="conciliar_bancos.php">Conciliar Bancos</a></li>
	</ul></li>
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>
			<ul>
		<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>
		<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>
		<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>
			</ul></li>
		<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>
	<ul>
		<li class="subfirst">
		<a href="inventario_x_bodega.php">Inventario por Bodega</a></li>
		<li><a href="editar_inventario_bodega.php">Editar Inventario por Bodega</a></li>
		<li><a href="compras_detalle.php">Ingreso de Mercanc�a</a></li>		
		<li><a href="traslado_detalle.php">Traslado entre Bodegas</a></li>
	
			
		
	</ul>
	</li>
	
	 <li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>
	<ul>
		 <li><a href="nota_debito.php">Notas de Debito</a></li>
		<li><a href="nota_factura.php">Notas de Cr�dito Manual por Factura</a></li> 
		<li class="subfirst"><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>
	
		
	
	</ul>
	</li>
	
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reportes</a>
	<ul>
			<li class="subfirst"><a href="ventas_narcoticos.php">Narcoticos</a></li>


	</ul>
	</li>
			<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>		
			<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>
</ul>
<?php }  else  if ($_SESSION['MM_tipo'] == 10) {  ?>
   <ul id="css3menu1" class="topmenu">
<?php if($estado != 'S'){ ?>
		<li class="topfirst"><a href="cierre_carro_hospital.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } else {	?>
<li class="topfirst"><a href="cierre_carro_hospital_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Generaci�n de Facturas</span></a></li>
<?php } ?>
			<?php if($estado != 'S'){ ?>
		<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } else {	?>
		<li class="topmenu"><a href="ver_devoluciones_cierre.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li>
		<?php } ?>
		<li class="topmenu"><a href="falta_FA.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reenvio a Hospital</span></a></li>
		<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>
	<ul>
		
		<li><a href="caja_menuda.php">Recibos de Caja</a></li>
		<li><a href="reporte_caja.php">Reporte de Caja</a></li>
		<li><a href="cierre_caja.php">Cierre de Caja</a></li>
	</ul>
	</li>	

		
		<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Contabilidad</a>
	<ul>
			<li class="subfirst"><a href="estado_cargosatc_id.php">Movimientos por Fecha</a></li>
		<li><a href="devoluciones_diarias_con.php">Devoluciones Diarias (N/C)</a></li>
		<li><a href="ventas_impuesto.php">Impuesto por Ventas</a></li>
		<li><a href="compras_impuesto.php">Impuesto por Compras</a></li>
		<li><a href="reporte_z.php">Corte Z y X</a></li>
		<li><a href="ordenes_mercancia.php">Ordenes de Mercancia Procesadas</a></li>
		<li><a href="nota_debito.php">Notas de Debito</a></li>
		<li><a href="nota_factura.php">Notas de Cr�dito Manual por Factura</a></li>
		<li><a href="reimprimir_fiscal.php">Reimprimir Factura Fiscal</a></li>
		<li><a href="ventas_xero.php">Ventas a Xero</a></li>
		<li><a href="compras_xero.php">Compras a Xero</a></li>
		</ul>
		<li class="topmenu"><a href="estado_cargosatc_f.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Estado de Cargos</span></a></li>
		<li><a href="estado_cargosatc_f_fa.php"><img src="default.htm_files/css3menu1/favour.png" alt=""/>B�squeda por FU</a></li>
		<li class="topmenu"><a href="estado_cargosatc_f_inac.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Consulta Historias Inactivas</span></a></li>
				<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>
	<ul>
		<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>
				
	</ul>
	</li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>
	</li>
	<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>
	<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>P&uacute;blico</a>
	<ul>
	
	<li class="subfirst">
				<li><a href="pago_creditos.php" >Pagos a Cr&eacute;dito</a></li>
		
			
	</ul>
	</li>
			<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>
				
		<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>
	
</ul>
<?php } else if ($_SESSION['MM_tipo'] == 11) { ?>

			
		<ul id="css3menu1" class="topmenu">
				<li class="topfirst"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Insumos</a>
	<ul>
		<li class="subfirst"><a href="agregar_insumos.php">Agregar Insumos</a></li>
		<li><a href="editar_insumo_us.php">Editar Insumos</a></li>
		<li><a href="traslado_insumos.php">Traslado a Cuarto Esteril</a></li>	
		
	</ul>
	</li>
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Parametros</a>
	<ul>
		<li class="subfirst"><a href="impresoras_fiscales.php">Impresoras Fiscales</a></li>
		<li><a href="principios_activos.php">Principios Activos</a></li>
		
	</ul>
	</li>
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Cargos"/>Recetario</a>
	<ul>
	<li class="subfirst"><a href="facturacion_label.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Impresi�n de Labels</a></li>
			</ul></li>	
			<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>
	   		
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Medicamentos</a>
			<ul>
		<li class="subfirst"><a href="agregar_medicamentos_us.php">Agregar Medicamentos</a></li>
		<li><a href="editar_medicamentos_us.php">Editar Medicamentos</a></li>
		<li><a href="imprimir_med.php" target="_blank">Listado de Medicamentos</a></li>
			</ul></li>
	
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Compras</a>
	<ul>
		<li class="subfirst"><a href="procesar_orden_compra.php">Procesar Pedidos</a></li>
		<li><a href="reimprimir_compra.php">Reimprimir Orden de Compra</a></li>
		<li><a href="reimprimir_compra_r.php">Reimprimir Compra (Ingreso de Mercanc�a)</a></li>
		<li><a href="imprimir_med_pend_compra.php">Listado de Medicamentos Pendiente en O/C</a></li>
		<li><a href="devolucion_vencimiento.php">Devolucion a Proveedores</a></li>
			</ul>
	</li>	
	
			<li class="topmenu"><a href="#"><img src="default.htm_files/css3menu1/buy.png" alt=""/>Inventario</a>
	<ul>
		<li class="subfirst">
		<a href="compras_detalle.php">Ingreso de Mercanc�a</a></li>	
			<li><a href="traslado_ins_med.php">Traslado de Insumos a Medicamentos</a></li>
		<li><a href="traslado_med_ins.php">Traslado de Medicamentos a Insumos</a></li>	
			</ul></li>
			
	
			
			<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>		
			<li class="toplast"><a href="logout.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>
</ul>
<?php }  else if ($_SESSION['MM_tipo'] == 13) { ?>
  <ul id="css3menu1" class="topmenu">
  	<li class="topfirst"><a href="facturacion.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/home.png" alt=""/>Venta al Publico</a></li>
		<li class="topmenu"><a href="devolucion_pub.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>N/C al Publico</a></li>
		<li class="topmenu"><a href="cotizacion.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Cotizaci&oacute;n</a></li>
		<li class="topmenu"><a href="facturacion_credito.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Pago de Cr&eacute;ditos</a></li>
			<li class="topmenu"><a href="consulta_producto.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Consulta Inventario</a></li>
	<!--	<li class="topmenu"><a href="perfil_farmaceutico.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Perfil Farmaceutico</span></a></li>
			<li class="topmenu"><a href="ver_devoluciones.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/buy.png" alt=""/>Facturas STAT / Devoluciones</span></a></li> -->
	<li class="topmenu"><a href="reporte_z_caja.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Reporte de Caja</a></li>
	
	

	<li>	<a href="falta_fiscal.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Obtener Fiscal</a></li>
		<li class="topmenu"><a href="factura_diaria.php" style="height:32px;line-height:32px;"><img src="default.htm_files/css3menu1/favour.png" alt=""/>Facturas Diarias</a></li>
	<li class="topmenu"><a href="datos_generales.php" style="height:32px;line-height:32px;"><span><img src="default.htm_files/css3menu1/favour.png" alt=""/>Datos Usuario</span></a></li>	
	<li class="toplast"><a href="logout_caja.php"><img src="default.htm_files/css3menu1/favour.png" alt="Medicamentos"/>Salir</a>
	
</ul>
 <?php } ?>
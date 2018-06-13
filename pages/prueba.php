<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/cotizacion.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	
?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript">
$(function() {
            $("#codigo").autocomplete({
                source: "productos.php",
                //minLength: 2,
                select: function(event, ui) {
					event.preventDefault();
                    $('#codigo').val(ui.item.codigo);
					$('#descripcion').val(ui.item.descripcion);
					$('#precio').val(ui.item.precio);
					$('#id_producto').val(ui.item.id_producto);
			     }
            });
		});
</script>
<?php
		layout::menu();
		layout::ini_content();
	?>
<div class="ui-widget">
  Codigo:  <input id="codigo">
  Producto: <input id="descripcion" readonly>
  Precio: <input id="precio" readonly>
  <input type="hidden" id="id_producto">
  <p>Ingresa 00</p>
</div>
<?=layout::fin_content()?>
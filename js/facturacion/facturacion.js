
function button(){
	alert('funcion q deshabilita boton');
	
}



function fn_check_maxdesc(){
	var descuento_maximo = facturacion.descuento_maximo.value * 100;
	var porcentaje_desc = facturacion.porcentaje_desc.value;
	
	if (porcentaje_desc > descuento_maximo) {
		alert('El descuento es mayor al máximo para el tipo de cliente!');
		facturacion.porcentaje_desc.value = descuento_maximo;
		return false;
		} else {
		
		return true;
	}
	
}



function fn_check_maxdesc_prod(){
	var descuento_maximo = facturacion.descuento_producto_max.value;
	var porcentaje_desc = facturacion.descuento_producto.value;
	//alert("Descuento maximo: " + descuento_maximo);
	//alert("Porcentaje desc: " + porcentaje_desc);
	if (porcentaje_desc > descuento_maximo) {
		alert('El descuento es mayor al máximo para el tipo de producto!');
		facturacion.descuento_producto.value = descuento_maximo;
		return false;
		} else {
		
		return true;
	}
	
}



function fn_activa_descjub(){
	if (facturacion.jubilado.checked == true){
		facturacion.porcentaje_desc.value = 20;
		} else {
		facturacion.porcentaje_desc.value = 0;
	}
	
	return true;
	
}



function verifica_espacio(valor){
	if(valor.value == "0.00"){
		valor.value = " ";
	}
	
	return true;
	
}

function verifica_cero(valor){
	if(valor.value == " "){
		valor.value=="0.00";
	}						
	return true;
	
}








function fn_carga_descuento(){
	if(facturacion.tipo_cliente.value != 5){
		facturacion.porcentaje_desc.value = facturacion.descuento_maximo.value * 100;
		} else {
		//alert('Es tipo contado');
		facturacion.porcentaje_desc.value = 0;
	} 
	
	return true;
	
}


function limpiar_campos()
{
	
	document.getElementById('codigo_de_barra').value='';
	document.getElementById('id_articulo').value='';
	document.getElementById('articulo').value='';
	document.getElementById('precio').value='';
	document.getElementById('cantidad').value='1';
	document.getElementById('tipo_impuesto').value='';
	document.getElementById('descuento_prod').checked=false;
	document.getElementById('descuento_producto').value='';
	document.getElementById('descuento_producto_max').value='';
	
	
}




function AddComma(text) {
	
	switch (text.value.length) {
		case 1:
		//document.getElementById("txtNumber").value = "0.0" + text.value;
		text.value = "0.0" + text.value
		break;
		default:
		var data = text.value.replace(".", "");
		var first = data.substring(0, (data.length - 2));
		var second = data.substring(data.length - 2);
		var temp = Math.abs(first) + "." + second;
		//document.getElementById("txtNumber").value = temp;
		text.value=temp;
	}
}



function fn_check_credito(){
	var saldo_actual = facturacion.saldo_actual.value;
	var limite_credito  = facturacion.limite_credito.value;
	var credito  = facturacion.credito.value;
	var saldo_disponible = limite_credito - saldo_actual;
	
	if (credito > saldo_disponible) {
		alert('El crédito no puede ser mayor al disponible actual para el cliente!');
		facturacion.credito.value = 0;
		return false;
		} else {
		
		return true;
	}
	
}





$(document).ready(function() {
	
	//$("#formulario").validate();
	
	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	
	
	$('#articulo').autocomplete({
		serviceUrl : 'get_articulo.php',
		paramName : 'q',
		onSelect: function (data) {
			$("#id_articulo").val(data.codigo_interno);
			$("#codigo_de_barra").val(data.codigo_de_barra);
			$("#precio").val(data.precio_unitario);
			$("#tipo_impuesto").val(data.tipo_impuesto);
			$("#descuento_producto_max").val(data.descuento_maximo);
			$("#jubilado_desc").val(data.jubilado);
			$("#descuento_diario").val(data.porcentaje);
			$("#descuento_total_u").val(data.descuento_total);
		}
	});
	
	
	$("#articulo").keyup(function(event){
		if(event.keyCode == 13){
			$("#agregar").click();
		}});
		
		$("#efectivo").keyup(function(event){
			if(event.keyCode == 120){
				$("#efectivo").change();
				$("#imprimir").focus();
				$("#imprimir").click();
			}});
			
			$("#tarjeta_credito").keyup(function(event){
				if(event.keyCode == 120){
					// alert("length tdc: " + $("#ref_tdc").val().length);
					$("#tarjeta_credito").change();
					if($("#ref_tdc").val().length != 0){
					$("#imprimir").click(); }
				}});
				
				$("#ref_tdc").keyup(function(event){
					if(event.keyCode == 120){
						if($("#tarjeta_credito").val().length != 0){
						$("#imprimir").click(); }
					}});
					
					$("#clave").keyup(function(event){
						if(event.keyCode == 120){
							$("#clave").change();
							if($("#ref_tdb").val().length != 0){
							$("#imprimir").click(); }
						}});
						
						$("#ref_tdb").keyup(function(event){
							if(event.keyCode == 120){
								if($("#clave").val().length != 0){
								$("#imprimir").click(); }
							}});
							
							$("#cheque").keyup(function(event){
								if(event.keyCode == 120){
									$("#cheque").change();
									if($("#no_cheque").val().length != 0){
										if($("#nombre_banco").val().length != 0){
										$("#imprimir").click();}}
								}});
								
								$("#no_cheque").keyup(function(event){
									if(event.keyCode == 120){
										if($("#cheque").val().length != 0){
											if($("#nombre_banco").val().length != 0){
											$("#imprimir").click();}}
									}});
									
									$("#nombre_banco").keyup(function(event){
										if(event.keyCode == 120){
											if($("#cheque").val().length != 0){
												if($("#no_cheque").val().length != 0){
												$("#imprimir").click();}}
										}});
										
										
										
										
										
										$("#credito").keyup(function(event){
											if(event.keyCode == 120){
												$("#credito").change();
												$("#imprimir").click();
											}});
											
											/*
												$("#codigo_de_barra").autocomplete("get_articulo_barra.php", {
												width: 500,
												matchContains: true,
												mustMatch: false,
												selectFirst: true
												});
												
												
												$('#codigo_de_barra').bind('keypress', function(e) {
												var code = (e.keyCode ? e.keyCode : e.which);
												console.log('Entro a bind keypress');
												valorinput=$('#codigo_de_barra').val();
												if(code == $.ui.keyCode.ENTER) {
												console.log('Le dio enter a keybode');
												$(this).autocomplete("close");
												alert($('#codigo_de_barra').val());
												}
											});*/
											
											
											
											$("#codigo_de_barra").autocomplete({
												serviceUrl : 'get_articulo_barra.php',
												paramName : 'q',
												onSelect: function (data) {
													$("#id_articulo").val(data.codigo_interno);
													$("#articulo").val(data.nombre);
													$("#precio").val(data.precio_unitario);
													$("#tipo_impuesto").val(data.tipo_impuesto);
													$("#descuento_producto_max").val(data.descuento_maximo);
													$("#jubilado_desc").val(data.jubilado);
													$("#descuento_diario").val(data.porcentaje);
													$("#descuento_total_u").val(data.descuento_total);
												}
											});
											
											
											/*
												$("#codigo_de_barra").live('paste', function(event) {
												var _this = this;
												// Short pause to wait for paste to complete
												setTimeout( function() {
												var text = $(_this).val();
												$.getJSON("get_articulo_barra.php", { q: text, json: text}, function(data){
												
												
												console.log(data);
												$("#id_articulo").val(data.mid);
												$("#articulo").val(data.mdesc);
												$("#precio").val(data.mprecio);
												$("#tipo_impuesto").val(data.mtipoimp);
												$("#descuento_producto_max").val(data.mdescmax);
												$("#jubilado_desc").val(data.mjubilado);
												$("#descuento_diario").val(data.mdescdia);
												$("#descuento_total_u").val(data.mdesctotal);
												
												});
												
												}, 100);
											});*/
											
											
											/*function getInput(e){
												alert(inputText);
												$(e.target).unbind('keyup');
												$.get("get_articulo_barra.php", { q: pastedData, c: true}, function(data){
												$("#id_articulo").val(data.mid);
												$("#articulo").val(data.mdesc);
												$("#precio").val(data.mprecio);
												$("#tipo_impuesto").val(data.mtipoimp);
												$("#descuento_producto_max").val(data.mdescmax);
												$("#jubilado_desc").val(data.mjubilado);
												$("#descuento_diario").val(data.mdescdia);
												$("#descuento_total_u").val(data.mdesctotal);
												});
											}*/
											
											$("#codigo_de_barra").keyup(function(event){
												if(event.keyCode == 13){
													//alert($("#codigo_de_barra").val());
													$.get("get_articulo_barra.php", { q: $("#codigo_de_barra").val(), c: true}, function(data, formatted){
														//alert("data: " + data);
														str = data.split("|");			
														/*$("#id_articulo").val(data.mid);
															$("#articulo").val(data.mdesc);
															$("#precio").val(data.mprecio);
															$("#tipo_impuesto").val(data.mtipoimp);
															$("#descuento_producto_max").val(data.mdescmax);
															$("#jubilado_desc").val(data.mjubilado);
															$("#descuento_diario").val(data.mdescdia);
														$("#descuento_total_u").val(data.mdesctotal);*/
														$("#id_articulo").val(str[1]);
														$("#articulo").val(str[2]);
														$("#precio").val(str[3]);
														$("#tipo_impuesto").val(str[4]);
														$("#descuento_producto_max").val(str[5]);
														$("#jubilado_desc").val(str[6]);
														$("#descuento_diario").val(str[7]);
														$("#descuento_total_u").val(str[8]);
														$("#agregar").click();
													});
													
													} else if(event.keyCode == 119){
													$("#efectivo").focus();
												}
											});
											
											
											$("#codigo_cliente").autocomplete({
												serviceUrl : 'get_personas.php',
												paramName : 'q',
												onSelect: function (data) {
													$("#nombre_cliente").val(data.nombre_completo);
													$("#cedula").val(data.identificacion);
													$("#telefono").val(data.telefono);
													$("#saldo_actual").val(data.saldo_actual);
													$("#descuento_maximo").val(data.descuento_maximo);
													$("#tipo_cliente").val(data.tipo_cliente);
													$("#limite_credito").val(data.limite_credito);
													
													/*$("#alergias").val(data[2]);
														$("#peso").val(data[3]);
														$("#otros").val(data[4]);
														$("#compania_de_seguro").val(data[5]);
														$("#diabetes").val(data[6]);
														$("#hipertension").val(data[7]);
													$("#contraindicaciones").val(data[8]);*/
													
													
													if(document.getElementById('tipo_cliente').value != 5){
														document.getElementById('porcentaje_desc').value = document.getElementById('descuento_maximo').value*100;
														} else {
														document.getElementById('porcentaje_desc').value = 0;
													}
												}
											});
											
											$("#nombre_cliente").autocomplete({
												serviceUrl : 'get_personas_n.php',
												paramName : 'q',
												onSelect: function (data) {
													$("#codigo_cliente").val(data.id_cliente);
													$("#cedula").val(data.identificacion);
													$("#telefono").val(data.telefono);
													$("#saldo_actual").val(data.saldo_actual);
													$("#descuento_maximo").val(data.descuento_maximo);
													$("#tipo_cliente").val(data.tipo_cliente);
													$("#limite_credito").val(data.limite_credito);
													
													/*$("#alergias").val(data[2]);
														$("#peso").val(data[3]);
														$("#otros").val(data[4]);
														$("#compania_de_seguro").val(data[5]);
														$("#diabetes").val(data[6]);
														$("#hipertension").val(data[7]);
													$("#contraindicaciones").val(data[8]);*/
													if(document.getElementById('tipo_cliente').value != 5){
														document.getElementById('porcentaje_desc').value = document.getElementById('descuento_maximo').value*100;
														} else {
														document.getElementById('porcentaje_desc').value = 0;
													}
													
												}
											});
											
											
											$("#nombre_aseguradora").autocomplete({
												serviceUrl : 'get_aseguradoras.php',
												paramName : 'q',
												onSelect: function (data) {
													$("#codigo_aseguradora").val(data.codigo_aseg);
													$("#porcentaje_desc").val(data.descuento_maximo);
												}
											});
											
											$("#clear").click(function() {
												$(":input").unautocomplete();
											});
											
											
});

function modalWin(url) {
	if (window.showModalDialog) {
		window.showModalDialog(url,"name","dialogWidth:1500px;dialogHeight:600px");
		} else {
		alert(url);
		window.open(url,'name','height=600,width=1500,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
	}
} 


<!--
// copyright 1999 Idocs, Inc. http://www.idocs.com
// Distribute this script freely but keep this notice in place
function numbersonly(myfield, e, dec)
{
	var key;
	var keychar;
	
	if (window.event)
	key = window.event.keyCode;
	else if (e)
	key = e.which;
	else
	return true;
	keychar = String.fromCharCode(key);
	
	// control keys
	if ((key==null) || (key==0) || (key==8) || 
    (key==9) || (key==13) || (key==27) )
	return true;
	
	// numbers
	else if ((("0123456789.").indexOf(keychar) > -1))
	return true;
	
	// decimal point jump
	else if (dec && (keychar == "."))
	{
		myfield.form.elements[dec].focus();
		return false;
	}
	else
	return false;
}


function popupform(myform, windowname)
{
	
	if (! window.focus)return true;
	
	window.open('', windowname, 'width=800,height=500, toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
	myform.target=windowname;
	return true;
}

function FocusOnInput()
{
	document.getElementById("codigo_de_barra").focus();
}

function anular(e) {
	tecla = (document.all) ? e.keyCode : e.which;
	return (tecla != 13);
}


function valideopenerform(){
	
	if(facturacion.descuento.checked == true){
		if(facturacion.nombre_cliente.value != ''){
			var popy= window.open('popup_autoriza.php','popup_form','location=no,menubar=no,status=no,top=50%,left=50%,height=150,width=200');
			} else {
			alert("No puede habilitar un descuento si no ha cargado al cliente!");
			facturacion.descuento.checked = false;
		}
		} else {
		facturacion.porcentaje_desc.value = 0;
		facturacion.porcentaje_desc.disabled = true;
		
	}
}


function valideopenerform1(){
	
	if(facturacion.descuento_prod.checked == true){
		if(facturacion.articulo.value != ''){
			
			var popy= window.open('popup_autoriza_prod.php','popup_form','location=no,menubar=no,status=no,top=50%,left=50%,height=150,width=200');
			} else {
			alert("No puede habilitar un descuento si no ha cargado el producto!");
			facturacion.descuento_prod.checked = false;
		}
		} else {
		facturacion.descuento_producto.value = 0;
		facturacion.descuento_producto.disabled = true;
	}
	
	
}


// Prevent the backspace key from navigating back.
$(document).unbind('keydown').bind('keydown', function (event) {
    var doPrevent = false;
    if (event.keyCode === 8) {
        var d = event.srcElement || event.target;
        if ((d.tagName.toUpperCase() === 'INPUT' && (d.type.toUpperCase() === 'TEXT' || d.type.toUpperCase() === 'PASSWORD')) 
		|| d.tagName.toUpperCase() === 'TEXTAREA') {
            doPrevent = d.readOnly || d.disabled;
		}
        else {
            doPrevent = true;
		}
	}
	
    if (doPrevent) {
        event.preventDefault();
	}
});
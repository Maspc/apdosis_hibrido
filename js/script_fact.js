// JavaScript Document

            $(document).ready(function(){
                fn_dar_eliminar();
				fn_cantidad();
                $("#frm_usu").validate();
            });
			
			function fn_cantidad(){
				cantidad = $("#grilla tbody").find("tr").length;
				$("#span_cantidad").html(cantidad);
			};
            
		
		
		
		
			
			var cont=0;
			
			//facturacion.sub_total.value = "0";
			
            function fn_agregar(){
				
			//	alert ('Llamo a la funcion');
				
					if ($("#codigo_de_barra").val().length == 0) {
  alert('El codigo de barra no puede ser nulo');
  return false;
}
		if ($("#articulo").val().length == 0) {
  alert('El nombre del artículo no puede ser nulo');
  return false;
}

	if ($("#cantidad").val().length == 0) {
  alert('La cantidad no puede ser nula');
  return false;
}


	if ($("#cantidad").val() == 0) {
  alert('La cantidad no puede ser cero');
  return false;
}
	
		if ($("#precio").val().length == 0) {
  alert('El precio no puede ser nulo');
  return false;
}

	if ($("#precio").val() == 0) {
  alert('El precio no puede ser cero');
  return false;
}
	
		
	/*
		
if (cont > 0) {		

for (var i=2;i<document.getElementById('grilla').rows.length;i++) {
	var str = document.getElementById('grilla').rows[i].cells[0].innerHTML;
	var n = str.replace("</TD>","");

if ($("#medicamento").val() == n) {
 alert('No puede repetir un artículo, modifique el anterior');
  return false;
}
}
}

*/	


var valor_itbms = "0";
//alert('marca de itbms '+facturacion.itbms.checked );

if(facturacion.tipo_impuesto.value  == 2){
//	alert('ES true itbms');
	valor_itbms  = "0.07";
	//alert('valor itbms2 '+valor_itbms );
}else if (facturacion.tipo_impuesto.value  == 3){
	valor_itbms  = "0.10";
}else if(facturacion.tipo_impuesto.value  == 4)
{
	valor_itbms  = "0.15";
}else{
	valor_itbms  = "0";
}
	//alert('valor itbms '+valor_itbms );
	
	var descuento = 0;
	//alert("TAmaño: " + $("#descuento_producto").val().length);
	var desc_diario = 0;
	var desc_prod = 0;
	var desc_general = 0;
	var descuento_producto_max = parseFloat($("#descuento_producto_max").val());
	
	
 if (($("#descuento_diario").val().length != 0) && (parseFloat($("#descuento_diario").val()) != 0)){
		desc_diario = parseFloat($("#descuento_diario").val());
	}

	if ($("#descuento_producto").val().length != 0 && parseFloat($("#descuento_producto").val()) != 0){
		desc_prod = parseFloat($("#descuento_producto").val());
	} 
	
	if ($("#porcentaje_desc").val().length != 0 && parseFloat($("#porcentaje_desc").val()) != 0){
		desc_general = parseFloat($("#porcentaje_desc").val());
	}

if(desc_diario > desc_prod){
	if(desc_diario > desc_general){
		descuento = desc_diario;
	} else {
		descuento =  desc_general;
	}
} else {
	if(desc_prod > desc_general){
		descuento = desc_prod;
	} else {
		descuento = desc_general;
	}
}
	
	
	//alert("jub: " + $("#jubilado_check").val());
	
	//alert("desc_diario: " + desc_diario);
	//alert("desc_general: " + desc_general);
	//alert("desc_prod: " + desc_prod);
	
	if($("#jubilado_check").val() == 'S'){
		if($("#jubilado_desc").val() == 'S' || $("#descuento_total_u").val() == 'S' ){
			if(desc_diario > desc_prod){
	if(desc_diario > desc_general){
		descuento = desc_diario;
		//alert("1");
	} else {
		descuento =  desc_general;
		//alert("2");
	}
} else {
	if(desc_prod > desc_general){
		descuento = desc_prod;
		//alert("3");
	} else {
		descuento = desc_general;
		//alert("4");
	}
}
			

	}  else {
		if(desc_diario > desc_prod){
			descuento = desc_diario;
			//alert("5");
		} else {
			descuento = desc_prod;
			//alert("6");
		}
		
	}
		
	} else {
		
		if(desc_diario > desc_prod){
	if(desc_diario > desc_general){
		descuento = desc_diario;
		//alert("7");
	} else {
		descuento =  desc_general;
		//alert("8");
	}
} else {
	if(desc_prod > desc_general){
		descuento = desc_prod;
		//alert("9");
	} else {
		descuento = desc_general;
		//alert("10");
	}
}
		
		
	}
	//alert ("Descuento diario: " + $("#descuento_diario").val());
	/*
	if ($("#descuento_diario").val().length != 0 && parseFloat($("#descuento_diario").val()) != 0){
		if(parseFloat($("#porcentaje_desc").val() > parseFloat($("#descuento_diario").val()){
		descuento = parseFloat($("#porcentaje_desc").val());
		}else{
		descuento = parseFloat($("#descuento_diario").val());	
	} } else {
	if ($("#descuento_producto").val().length != 0 && parseFloat($("#descuento_producto").val()) != 0){
		descuento = parseFloat($("#descuento_producto").val());
		//alert ("Descuento producto: " + $("#descuento_producto").val());
		}else{
		descuento = parseFloat($("#porcentaje_desc").val());
		//alert ("Descuento general: "+$("#porcentaje_desc").val());
		}
	} 
		*/
	
//descuento_unit = (parseFloat($("#precio").val()) * parseFloat($("#cantidad").val()))*(parseFloat(descuento/100));
//itbms_unit = ((parseFloat($("#precio").val()) * parseFloat($("#cantidad").val()))*parseFloat(valor_itbms));

if(descuento > descuento_producto_max && $("#jubilado_check").val() != 'S' && $("#jubilado_desc").val() != 'S' ){
	descuento = descuento_producto_max;
} else if (descuento > descuento_producto_max && $("#jubilado_check").val() == 'S' && $("#jubilado_desc").val() == 'S'){
	descuento = desc_general;
}


descuento_unit = ((parseFloat($("#precio").val()))*(parseFloat(descuento/100))).toFixed(2);
itbms_unit = (((parseFloat($("#precio").val()) - parseFloat(descuento_unit))* parseFloat(valor_itbms)));
	
	//alert('itbms unit '+itbms_unit );
	//alert('descuento unit '+descuento_unit );

	
		cont++;
var indiceFila=1;
myNewRow = document.getElementById('grilla').insertRow(-1);
myNewRow.id=indiceFila;
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td>'+ cont +'</td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td>'+ $("#codigo_de_barra").val()+'</td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td>'+ $("#articulo").val()+'<input type="hidden"  name="id_articulo_'+cont+'" value="'+ $("#id_articulo").val() +'" /><input type="hidden"  name="articulo_'+cont+'" value="'+ $("#articulo").val() +'" />' +'</td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text"  name="cantidad_'+cont+'" id="cantidad_'+cont+'" value="'+ $("#cantidad").val() +'" size="10"  readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text"  name="precio_unitario_'+cont+'" value="'+ $("#precio").val() +'" id="precio_unitario_'+cont+'" size="10"  readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text"  name="descuento_unitario_'+cont+'" value="'+ (descuento_unit) +'" id="descuento_unitario_'+cont+'" size="10"  readonly /></td>';
myNewCell=myNewRow.insertCell(-1);  
myNewCell.innerHTML='<td><input type="text"  name="itbms_unitario_'+cont+'" value="'+ (itbms_unit)  +'" id="itbms_unitario_'+cont+'" size="10"  readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text"  name="precio_venta_'+cont+'" value="'+ ((parseFloat($("#precio").val()) * parseFloat($("#cantidad").val())) + (parseFloat(itbms_unit) * parseFloat($("#cantidad").val()) ) - (parseFloat(descuento_unit) * parseFloat($("#cantidad").val()) )  )  +'" id="precio_venta_'+cont+'" size="10"  readonly /><input type="hidden" size= "20" name="var_cont" value="'+ cont +'"></td>'; 
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><a class="elimina"><img src="../delete.png" /></a></td>';
indiceFila++;
		

	
	//alert('Emtre a la funcion');
		facturacion.articulo.value = "";
			facturacion.cantidad.value = "";
			facturacion.codigo_de_barra.value = "";
			facturacion.precio.value = "";
			facturacion.descuento_producto.value = "";
			facturacion.descuento_producto.disabled = true;
			facturacion.descuento_prod.checked = false;
			facturacion.cantidad.value = "1";
			facturacion.codigo_de_barra.focus();
	
			
			var precio_c = 'precio_venta_'+cont;
			var precio_u = 'precio_unitario_'+cont;
			var cant_u = 'cantidad_'+cont;
			
		//	alert ('precio c: '+ document.getElementById(precio_c).value);
			//alert ('sub_total: '+ facturacion.sub_total.value);
			
			//alert ('cantidad: '+ parseFloat(document.getElementById(cant_u).value));
			
			var sub_total_c = parseFloat(facturacion.sub_total.value);
			var precio_c_c = parseFloat(document.getElementById(precio_c).value);
			var precio_u_u = parseFloat(document.getElementById(precio_u).value);
			var cant_u_u = parseFloat(document.getElementById(cant_u).value);
			
			//alert("cant u u " + cant_u_u);
			//alert("descuento unit " + descuento_unit);
			//alert("facturacion.descuento_total.value " + facturacion.descuento_total.value);
			
			facturacion.sub_total.value = (parseFloat(facturacion.sub_total.value) + (parseFloat(precio_u_u) * parseFloat(cant_u_u))).toFixed(2);
			facturacion.descuento_total.value  = (parseFloat(facturacion.descuento_total.value) + (parseFloat(descuento_unit) * parseFloat(cant_u_u))).toFixed(2);
			facturacion.itbms_completo.value = (parseFloat(facturacion.itbms_completo.value) + (parseFloat(itbms_unit)* parseFloat(cant_u_u)));
			facturacion.itbms_total.value = (parseFloat(facturacion.itbms_completo.value)).toFixed(2); 
			//facturacion.total.value = (parseFloat(facturacion.total.value) + parseFloat(precio_c_c));
			//facturacion.total_completo.value = (parseFloat(facturacion.total_completo.value) + parseFloat(precio_c_c));
			//facturacion.total.value = (parseFloat(facturacion.total_completo.value)).toFixed(3);
			facturacion.total.value = parseFloat(facturacion.sub_total.value) - parseFloat(facturacion.descuento_total.value) + parseFloat(facturacion.itbms_total.value);
			facturacion.total.value = (parseFloat(facturacion.total.value)).toFixed(2);

		//	 alert("Artículo agregado");
			
			fn_dar_eliminar();
				fn_cantidad();
               
					facturacion.efectivo.value = (0).toFixed(2);
				facturacion.tarjeta_credito.value = (0).toFixed(2);
				facturacion.clave.value = (0).toFixed(2);
				facturacion.credito.value = (0).toFixed(2);
				facturacion.cheque.value = (0).toFixed(2);
				facturacion.saldo.value = (0).toFixed(2);
				facturacion.vuelto.value = (0).toFixed(2);
				
			
		
			
			
			
var inputs = $("#frm_usu").getElementsByTagName("input");
for(var i=0;i<inputs.length;i++){
inputs[i].value = "";}
				
             /*  cadena = "<tr>";
                cadena = cadena + "<td>" + $("#medicamento").val() + "</td>";
                cadena = cadena + "<td>" + $("#forma_farma").val() + "</td>";
                cadena = cadena + "<td>" + $("#dosis").val() + $("#dosis_tipo").val() + "</td>";
                cadena = cadena + "<td>" + $("#horas").val() + "</td>";
				cadena = cadena + "<td>" + $("#dias").val() + "</td>";
                cadena = cadena + "<td><a class='elimina'><img src='delete.png' /></a></td>";
                $("#grilla tbody").append(cadena);
                /*
                    aqui puedes enviar un conunto de tados ajax para agregar al usuairo
                    $.post("agregar.php", {ide_usu: $("#valor_ide").val(), nom_usu: $("#valor_uno").val()});
                
			var str = $("#frm_usu").serialize();
		$.ajax({
			url: 'process.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "")
					alert(data);
				fn_cerrar();
				fn_buscar();
			}
		});*/
		
		
			
		
		
		
				
            }
			
			
			function fn_resta_saldo() {
				
				//alert ('Entre a la funcion de resta');
				
				var efectivo = (parseFloat(facturacion.efectivo.value))||0;
				var tarjeta_credito = (parseFloat(facturacion.tarjeta_credito.value))||0;
				var clave = (parseFloat(facturacion.clave.value))||0;
				var credito = (parseFloat(facturacion.credito.value))||0;
				var cheque = (parseFloat(facturacion.cheque.value))||0;
				var total = (parseFloat(facturacion.total.value))||0;
				var sumatoria = parseFloat(efectivo + tarjeta_credito + clave + credito + cheque).toFixed(2);
				var estado;
				
										
				
				facturacion.efectivo.value = (parseFloat(facturacion.efectivo.value).toFixed(2))||0;
				facturacion.tarjeta_credito.value = (parseFloat(facturacion.tarjeta_credito.value).toFixed(2))||0;
				facturacion.clave.value = (parseFloat(facturacion.clave.value).toFixed(2))||0;
				facturacion.credito.value = (parseFloat(facturacion.credito.value).toFixed(2))||0;
				facturacion.cheque.value = (parseFloat(facturacion.cheque.value).toFixed(2))||0;
				
				
				
				if (isNaN(facturacion.efectivo.value)){
				facturacion.efectivo.value = (0).toFixed(2);
				}
				
				
				if (isNaN(facturacion.tarjeta_credito.value)){
				facturacion.tarjeta_credito.value = (0).toFixed(2);
				}
				
				if (isNaN(facturacion.clave.value)){
				facturacion.clave.value = (0).toFixed(2);
				}
				
				if (isNaN(facturacion.credito.value)){
				facturacion.credito.value = (0).toFixed(2);
				}
				
				if (isNaN(facturacion.cheque.value)){
				facturacion.cheque.value = (0).toFixed(2);
				}
				
				
				
				
				if(efectivo > total){
				facturacion.vuelto.value = (efectivo - total).toFixed(2);
				facturacion.saldo.value = (0).toFixed(2);
				} else {
				
									
				facturacion.saldo.value = (total - (efectivo + tarjeta_credito + clave + credito + cheque)).toFixed(2);
				facturacion.vuelto.value = (0).toFixed(2);
				}
				
				
				
				if(parseFloat(efectivo + tarjeta_credito + clave + credito + cheque).toFixed(2) - total >= 0 ){
					
					if(parseFloat(tarjeta_credito + clave + credito + cheque ).toFixed(2) > total)  {
				alert("El total de tarjetas, crédito y cheques no puede ser mayor al total de la factura, verifique!!!");
				facturacion.imprimir.disabled = true;
				facturacion.tarjeta_credito.value = (0).toFixed(2);
				facturacion.efectivo.value = (0).toFixed(2);
				facturacion.clave.value = (0).toFixed(2);
				facturacion.credito.value = (0).toFixed(2);
				facturacion.cheque.value = (0).toFixed(2);
				facturacion.saldo.value = (0).toFixed(2);
				} else if(efectivo > total && parseFloat(tarjeta_credito + clave + credito + cheque ).toFixed(2) > 0 ) {
					alert("El total de tarjetas, crédito y cheques no puede ser mayor al total de la factura, verifique!!!");
				facturacion.imprimir.disabled = true;
				facturacion.tarjeta_credito.value = (0).toFixed(2);
				facturacion.efectivo.value = (0).toFixed(2);
				facturacion.clave.value = (0).toFixed(2);
				facturacion.credito.value = (0).toFixed(2);
				facturacion.cheque.value = (0).toFixed(2);
				facturacion.saldo.value = (0).toFixed(2);
				}else if(efectivo < total && parseFloat(efectivo + tarjeta_credito + clave + credito + cheque ).toFixed(2) > total ) {
					alert("El total de tarjetas, crédito y cheques no puede ser mayor al total de la factura, verifique!!!");
				facturacion.imprimir.disabled = true;
				facturacion.tarjeta_credito.value = (0).toFixed(2);
				facturacion.efectivo.value = (0).toFixed(2);
				facturacion.clave.value = (0).toFixed(2);
				facturacion.credito.value = (0).toFixed(2);
				facturacion.cheque.value = (0).toFixed(2);
				facturacion.saldo.value = (0).toFixed(2);
										} 				
										
										else {
					//alert ('Se igualo el saldo');
					facturacion.imprimir.disabled = false;
					//estado = document.getElementById(imprimir).disabled;
					//alert ('Estado boton: '+estado);
				} } else {
				facturacion.imprimir.disabled = true;
				} 
				
				
				 return false;
				
			}
			
			
			     function fn_dar_eliminar(){
                $("a.elimina").unbind('click').click(function(){
											  
                    id = $(this).closest("tr").find("td").eq(0).html();
				alert('Eliminando la linea '+id);
                 //   respuesta = confirm("Desea eliminar el artículo?");
                  //  if (respuesta){
					//	alert ("entre");
				alert ("Recalculando Totales");
			var precio_c = 'precio_venta_'+id;
			var precio_u = 'precio_unitario_'+id;
			var cant_u = 'cantidad_'+id;
			var itbms_u = 'itbms_unitario_'+id;
			var descuento_u = 'descuento_unitario_'+id;
			
			
			
			//alert ('precio c: '+ document.getElementById(precio_c).value);
			//alert ('sub_total: '+ facturacion.sub_total.value);
			
			//alert ('cantidad: '+ parseFloat(document.getElementById(cant_u).value));
			
			var sub_total_c = parseFloat(facturacion.sub_total.value);
			var precio_c_c = parseFloat(document.getElementById(precio_c).value);
			var precio_u_u = parseFloat(document.getElementById(precio_u).value);
			var cant_u_u = parseFloat(document.getElementById(cant_u).value);
			var itbms_u_u = parseFloat(document.getElementById(itbms_u).value);
			var descuento_u_u = parseFloat(document.getElementById(descuento_u).value);
			
			//alert("cant u u" + cant_u_u);
			
			facturacion.sub_total.value = (parseFloat(facturacion.sub_total.value) - (parseFloat(precio_u_u) * parseFloat(cant_u_u))).toFixed(2);
			facturacion.descuento_total.value  = (parseFloat(facturacion.descuento_total.value) - (parseFloat(descuento_u_u)* parseFloat(cant_u_u))   ).toFixed(2);
			facturacion.itbms_completo.value = (parseFloat(facturacion.itbms_completo.value) - (parseFloat(itbms_u_u)* parseFloat(cant_u_u)));
			//facturacion.itbms_total.value = (parseFloat(facturacion.itbms_total.value) - (parseFloat(itbms_u_u)* parseFloat(cant_u_u)));
			facturacion.itbms_total.value = parseFloat(facturacion.itbms_completo.value).toFixed(2);
			//facturacion.total_completo.value = (parseFloat(facturacion.total_completo.value) - parseFloat(precio_c_c));
			facturacion.total.value = (parseFloat(facturacion.sub_total.value) - parseFloat(facturacion.descuento_total.value) + parseFloat(facturacion.itbms_total.value)).toFixed(2);
			//facturacion.total.value = (parseFloat(facturacion.total.value)).toFixed(2);
				
				//alert("vuelto: "+facturacion.efectivo.value);
					
				facturacion.efectivo.value = (0).toFixed(2);
				facturacion.tarjeta_credito.value = (0).toFixed(2);
				facturacion.clave.value = (0).toFixed(2);
				facturacion.credito.value = (0).toFixed(2);
				facturacion.cheque.value = (0).toFixed(2);
			//	facturacion.total.value = (0).toFixed(2);
				facturacion.saldo.value = (0).toFixed(2);
				facturacion.vuelto.value = (0).toFixed(2);
				facturacion.imprimir.disabled = true;
				
				if(facturacion.itbms_total.value < 0) {
					facturacion.itbms_total.value = 0;
				}
				
					if(facturacion.total_completo.value < 0) {
					facturacion.total_completo.value = 0;
				}
				
                        $(this).closest("tr").fadeOut("normal", function(){
                            $(this).remove();
							
			
							
							
                        //    alert("Artículo eliminado")
                            /*
                                aqui puedes enviar un conjunto de datos por ajax
                                $.post("eliminar.php", {ide_usu: id})
                            */
                        })
                   // }
			
				   
                });
            }
			
			
			function fn_activa_desc(){
				if	(facturacion.descuento.checked  == true){
					//alert('activo el descuento');
				facturacion.porcentaje_desc.disabled = false;
				}else{
				facturacion.porcentaje_desc.disabled = true;	
				}
			}
			
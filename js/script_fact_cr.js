// JavaScript Document			
			function fn_cantidad(){
				cantidad = $("#grilla tbody").find("tr").length;
				$("#span_cantidad").html(cantidad);
			};
  
  var cont = 0;
  
  function fn_agregar(con){
				//	alert ('Entro a la funcion');
					
			 var articulo = "articuloi_"+con;
			 var cantidad = 1;
			 var articulo_id = "articulo_idi_"+con;
			 var id_tratamiento = "id_tratamientoi_"+con;
			 var id_cliente = "id_clientei_"+con;
			 var monto_pendiente = "monto_pendientei_"+con;
			 var precio = "precioi_"+con;
			 var cantidad_de_pagos = 1;
			 var descuento_diario = 0;
			 var descuento_producto = 0;
			 var descuento_producto_max = 0;
			 var porcentaje_desc = 0;
			 var jubilado_check = 'N';
			 var jubilado_desc = 0;
			 
				
				
				
		
		if (document.getElementById(articulo).length == 0) {
  alert('El nombre del artículo no puede ser nulo');
  return false;
}


	if (cantidad.length == 0) {
  alert('La cantidad no puede ser nula');
  return false;
}


	if (cantidad == 0) {
  alert('La cantidad no puede ser cero');
  return false;
}

		if (document.getElementById(precio).length == 0) {
  alert('El precio no puede ser nulo');
  return false;
}

	if (document.getElementById(precio).value == 0) {
  alert('El precio no puede ser cero');
  return false;
}


	
		
	



descuento_unit = 0;
itbms_unit = 0;

	
	//alert('itbms unit '+itbms_unit );
	//alert('descuento unit '+descuento_unit );

 
	
		cont++;
var indiceFila=1;
myNewRow = document.getElementById('grilla').insertRow(-1);
myNewRow.id=indiceFila;
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td>'+ cont +'</td>';
myNewCell=myNewRow.insertCell(-1);
//alert('1');
myNewCell.innerHTML='<td>'+ document.getElementById(articulo).value +'<input type="hidden"  name="id_articulo_'+cont+'" value="'+ document.getElementById(articulo_id).value +'" /><input type="hidden"  name="articulo_'+cont+'" value="'+ document.getElementById(articulo).value +'" />' +'</td>';
myNewCell=myNewRow.insertCell(-1);
//alert('3');
myNewCell.innerHTML='<td><input type="text"  name="cantidad_'+cont+'" id="cantidad_'+cont+'" value="'+ parseFloat(cantidad) +'" size="10"  readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
//alert('4');
myNewCell.innerHTML='<td><input type="text"  name="precio_unitario_'+cont+'" value="'+ document.getElementById(precio).value +'" id="precio_unitario_'+cont+'" size="10"  readonly /><input type="hidden"  name="descuento_unitario_'+cont+'" value="'+ parseFloat(0) +'" id="descuento_unitario_'+cont+'" size="10"  readonly /><input type="hidden"  name="itbms_unitario_'+cont+'" value="'+ (itbms_unit)  +'" id="itbms_unitario_'+cont+'" size="10"  readonly /><input type="hidden"  name="id_tratamiento_'+cont+'" value="'+ document.getElementById(id_tratamiento).value +'" id="id_tratamiento_'+cont+'" size="10"  readonly /><input type="hidden"  name="id_cliente_'+cont+'" value="'+ document.getElementById(id_cliente).value +'" id="id_cliente_'+cont+'" size="10"  readonly /><input type="hidden"  name="monto_pendiente_'+cont+'" value="'+ document.getElementById(monto_pendiente).value +'" id="monto_pendiente_'+cont+'" size="10"  readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
//alert('7');
myNewCell.innerHTML='<td><input type="text"  name="precio_venta_'+cont+'" value="'+ (( document.getElementById(precio).value * 1) + (parseFloat(itbms_unit) * 1 ) - (parseFloat(descuento_unit) * 1 )  )  +'" id="precio_venta_'+cont+'" size="10"  readonly /><input type="hidden" size= "20" name="var_cont" value="'+ cont +'"></td>'; 
myNewCell=myNewRow.insertCell(-1);
//alert('8');
myNewCell.innerHTML='<td><a class="elimina"><img src="../delete.png" /></a></td>';
indiceFila++;
//alert('9');

		
		
	
	//alert('Emtre a la funcion');

	
	
			
			var precio_c = 'precio_venta_'+cont;
			var precio_u = 'precio_unitario_'+cont;
			var cant_u = 'cantidad_'+cont;
			var cantidad_de_pagos_u = 'cantidad_de_pagos_'+cont;
			
		//	alert ('precio c: '+ document.getElementById(precio_c).value);
			//alert ('sub_total: '+ facturacion.sub_total.value);
			
			//alert ('cantidad: '+ parseFloat(document.getElementById(cant_u).value));
		
			
					
			
			var sub_total_c = parseFloat(facturacion.sub_total.value);
			var precio_c_c = parseFloat(document.getElementById(precio_c).value);
			var precio_u_u = parseFloat(document.getElementById(precio_u).value);
			var cant_u_u = parseFloat(document.getElementById(cant_u).value);
			
			//alert("cant u u" + cant_u_u);
			
			facturacion.sub_total.value = (parseFloat(facturacion.sub_total.value) + (parseFloat(precio_u_u) * parseFloat(cant_u_u))).toFixed(2);
			facturacion.descuento_total.value  = (parseFloat(facturacion.descuento_total.value) + (parseFloat(descuento_unit) * parseFloat(cant_u_u))).toFixed(2);
			facturacion.itbms_total.value = (parseFloat(facturacion.itbms_total.value) + (parseFloat(itbms_unit)* parseFloat(cant_u_u)));
			facturacion.total.value = (parseFloat(facturacion.total.value) + parseFloat(precio_c_c)).toFixed(2);

			// alert("Artículo agregado");
			
			
			
			
		
			
			
			fn_dar_eliminar();
				fn_cantidad();
               
					facturacion.efectivo.value = (0).toFixed(2);
				facturacion.tarjeta_credito.value = (0).toFixed(2);
				facturacion.clave.value = (0).toFixed(2);
				//facturacion.credito.value = (0).toFixed(2);
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
				var sumatoria = efectivo + tarjeta_credito + clave + credito + cheque;
				var estado;
							
				//alert('Sumatoria: '+sumatoria);
				//alert('Total: '+total);
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
				
				
				
				if((efectivo + tarjeta_credito + clave + credito + cheque) - total >= 0 ){
					
					if((tarjeta_credito + clave + credito + cheque ) > total)  {
				alert("El total de tarjetas, crédito y cheques no puede ser mayor al total de la factura, verifique!!!");
				facturacion.imprimir.disabled = true;
				facturacion.tarjeta_credito.value = (0).toFixed(2);
				facturacion.efectivo.value = (0).toFixed(2);
				facturacion.clave.value = (0).toFixed(2);
				facturacion.credito.value = (0).toFixed(2);
				facturacion.cheque.value = (0).toFixed(2);
				facturacion.saldo.value = (0).toFixed(2);
				} else if(efectivo > total && (tarjeta_credito + clave + credito + cheque ) > 0 ) {
					alert("El total de tarjetas, crédito y cheques no puede ser mayor al total de la factura, verifique!!!");
				facturacion.imprimir.disabled = true;
				facturacion.tarjeta_credito.value = (0).toFixed(2);
				facturacion.efectivo.value = (0).toFixed(2);
				facturacion.clave.value = (0).toFixed(2);
				facturacion.credito.value = (0).toFixed(2);
				facturacion.cheque.value = (0).toFixed(2);
				facturacion.saldo.value = (0).toFixed(2);
				}else if(efectivo < total && (efectivo + tarjeta_credito + clave + credito + cheque ) > total ) {
					alert("El total de tarjetas, crédito y cheques no puede ser mayor al total de la factura, verifique!!!");
				facturacion.imprimir.disabled = true;
				facturacion.tarjeta_credito.value = (0).toFixed(2);
				facturacion.efectivo.value = (0).toFixed(2);
				facturacion.clave.value = (0).toFixed(2);
				//facturacion.credito.value = (0).toFixed(2);
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
			var cant_u_u = parseFloat(document.getElementById(cant_u).value);
			var itbms_u_u = parseFloat(document.getElementById(itbms_u).value);
			var descuento_u_u = parseFloat(document.getElementById(descuento_u).value);
			
			//alert("cant u u" + cant_u_u);
			
			facturacion.sub_total.value = (parseFloat(facturacion.sub_total.value) - (parseFloat(precio_u_u) * parseFloat(cant_u_u))).toFixed(2);
			facturacion.descuento_total.value  = (parseFloat(facturacion.descuento_total.value) - (parseFloat(descuento_u_u)* parseFloat(cant_u_u))   ).toFixed(2);
			facturacion.itbms_total.value = (parseFloat(facturacion.itbms_total.value) - (parseFloat(itbms_u_u)* parseFloat(cant_u_u)));
			facturacion.total.value = (parseFloat(facturacion.total.value) - parseFloat(precio_c_c)).toFixed(2);
				
				
			
				//alert("credito: " + facturacion.credito.value);
				//alert("precio: "+ $("#precio").val());
				//alert("cantidad: "+$("#cantidad").val());
				//alert("itbms_unit: " + itbms_unit);
				//alert("cantidad: "+$("#cantidad").val());
				//alert("descuento_unit: "+descuento_unit);
							
				
			
			
			
			//alert("el valor de credito es "+facturacion.credito.value );
			
				
				//alert("vuelto: "+facturacion.efectivo.value);
					
				facturacion.efectivo.value = (0).toFixed(2);
				facturacion.tarjeta_credito.value = (0).toFixed(2);
				facturacion.clave.value = (0).toFixed(2);
				facturacion.credito.value = (0).toFixed(2);
				facturacion.cheque.value = (0).toFixed(2);
				facturacion.total.value = (0).toFixed(2);
				facturacion.saldo.value = (0).toFixed(2);
				facturacion.vuelto.value = (0).toFixed(2);
				facturacion.imprimir.disabled = true;
				
				
				
                        $(this).closest("tr").fadeOut("normal", function(){
                            $(this).remove();
							
			
							
							
                        //    alert("Artículo eliminado") --
                            /*
                                aqui puedes enviar un conjunto de datos por ajax
                                $.post("eliminar.php", {ide_usu: id})
                            */
                        })
                   // }
			
				   
                });
            }
			
			
			
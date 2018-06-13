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
			
            function fn_agregar(){
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
		
		
			
		
		
			if ($("#medicamento").val().length == 0) {
  alert('Nombre de medicamento no puede ser nulo');
  return false;
}

if ($("#cantidad").val().length == 0) {
  alert('Cantidad no puede ser nula');
  return false;
}


if ($("#lote").val().length == 0) {
  alert('Lote no puede ser nulo');
  return false;
}


if ($("#calendar").val().length == 0) {
  alert('Fecha de vencimiento no puede ser nula');
  return false;
}

if ($("#costo").val().length == 0) {
  alert('Costo no puede ser nulo');
  return false;
}
			
	
		
if (cont > 0) {		
for (var i=2;i<document.getElementById('grilla').rows.length;i++) {
if ($("#medicamento").val() == document.getElementById('grilla').rows[i].cells[0].innerHTML) {
 alert('No puede repetir un medicamento, modifique el anterior');
  return false;
}
}
}

		
		
		cont++;
var indiceFila=1;
myNewRow = document.getElementById('grilla').insertRow(-1);
myNewRow.id=indiceFila;
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td>'+ cont +'</td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td>'+ $("#medicamento").val() +'</td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text" size="10" name="cantidad_'+cont+'" id="cantidad_'+cont+'" value="'+ $("#cantidad").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text" size="10" name="lote_'+cont+'" value="'+ $("#lote").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text" size="10" name="calendar_'+cont+'" value="'+ $("#calendar").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text" size="10" name="costo_'+cont+'" id="costo_'+cont+'" value="'+ $("#costo").val() +'" readonly /><input type="hidden" size="10" name="tipo_impuesto_'+cont+'" id="tipo_impuesto_'+cont+'" value="'+ $("#tipo_impuesto").val() +'" readonly /><input type="hidden" size= "10" name="var_cont" value="'+ cont +'"><input type="hidden" size="20" name="medicamento_id_'+cont+'" value="'+ $("#medicamento_id").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);


				
				
			formulario.medicamento.value = "";
			formulario.cantidad.value = "";
			formulario.lote.value = 0;
			formulario.calendar.value = 0;
			formulario.costo.value = "";
			
			var costo = 'costo_'+cont;
			var cantidad = 'cantidad_'+cont;
			var tipo_impuesto = 'tipo_impuesto_'+cont;
			var impuesto = 0;
				
				
			if (document.getElementById(tipo_impuesto).value == 1){
				impuesto = 0;
			} else if (document.getElementById(tipo_impuesto).value == 2) {
				impuesto = 0.07;
			} else if (document.getElementById(tipo_impuesto).value == 3) {
				impuesto = 0.10;
			} else if (document.getElementById(tipo_impuesto).value == 4) {
				impuesto = 0.15;
			}
			
			var costo_c = ((parseFloat(document.getElementById(costo).value)) * parseFloat(document.getElementById(cantidad).value)) + ((parseFloat(document.getElementById(costo).value) * parseFloat(document.getElementById(cantidad).value))*impuesto);
			
			var impuesto_v = ((parseFloat(document.getElementById(costo).value) * parseFloat(document.getElementById(cantidad).value))*impuesto);
			
			formulario.impuesto_c.value = (parseFloat(formulario.impuesto_c.value) + parseFloat(impuesto_v)).toFixed(2);
					
			formulario.total_c.value = (parseFloat(formulario.total_c.value) + parseFloat(costo_c)).toFixed(2);
			
			myNewCell.innerHTML='<td><input type="text" size="10" name="impuesto_ind_'+cont+'" id="impuesto_ind_'+cont+'" value="'+ impuesto_v +'" style="text-align:center;" readonly /></td>';
			myNewCell=myNewRow.insertCell(-1);
			myNewCell.innerHTML='<td><input type="text" size="10" name="costo_total_'+cont+'" id="costo_total_'+cont+'" value="'+ costo_c +'" style="text-align:center;" readonly /></td>';
			
			
           
				
	myNewCell=myNewRow.insertCell(-1);			
	myNewCell.innerHTML='<td><a class="elimina"><img src="../delete.png" /></a></td>';		
	indiceFila++;

	
	fn_dar_eliminar();
			fn_cantidad();	
			
				
var inputs = $("#frm_usu").getElementsByTagName("input");
for(var i=0;i<inputs.length;i++){
inputs[i].value = "";}
				
            };
			
			
			
           
            function fn_dar_eliminar(){
                 $("a.elimina").unbind('click').click(function(){
											  
                    id = $(this).closest("tr").find("td").eq(0).html();
                   // respuesta = confirm("Desea eliminar el medicamento");
                   // if (respuesta){
						alert("Se esta eliminando la fila: " + id);
						var costo = 'costo_'+id;
						var cantidad = 'cantidad_'+id;
						var tipo_impuesto = 'tipo_impuesto_'+id;
						
			var impuesto = 0;
			
			if (document.getElementById(tipo_impuesto).value == 1){
				impuesto = 0;
			} else if (document.getElementById(tipo_impuesto).value == 2) {
				impuesto = 0.07;
			} else if (document.getElementById(tipo_impuesto).value == 3) {
				impuesto = 0.10;
			} else if (document.getElementById(tipo_impuesto).value == 4) {
				impuesto = 0.15;
			}
						//alert("pase 1 " + costo + " . " + cantidad);
					var costo_c = (parseFloat(document.getElementById(costo).value)) * parseFloat(document.getElementById(cantidad).value) + ((parseFloat(document.getElementById(costo).value) * parseFloat(document.getElementById(cantidad).value))*impuesto) ;
								//	alert("pase 2 costo_C: " + costo_c);
						formulario.total_c.value = (parseFloat(formulario.total_c.value) - parseFloat(costo_c)).toFixed(2);
						var impuesto_v = ((parseFloat(document.getElementById(costo).value) * parseFloat(document.getElementById(cantidad).value))*impuesto);
						
						formulario.impuesto_c.value = (parseFloat(formulario.impuesto_c.value) - parseFloat(impuesto_v)).toFixed(2);
						
						
						
                        $(this).closest("tr").fadeOut("normal", function(){
                            $(this).remove();
						})
                   // }
                });
            };
			
			
	/*				function asigna()
{
valor=document.form.var_cont.value=cont;
alert("El valor de cont es " + valor);
}*/
	
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
		if ($("#dosis").val().length == 0) {
  alert('La dosis no puede ser nula');
  return false;
}

	if ($("#cantidad_x_dosis").val().length == 0) {
  alert('La dosis no puede ser nula');
  return false;
}

			if ($("#cantidad_x_dosis").val() == 0) {
  alert('La dosis no puede ser cero');
  return false;
}
	
		
	
		
if (cont > 0) {		

for (var i=2;i<document.getElementById('grilla').rows.length;i++) {
	var str = document.getElementById('grilla').rows[i].cells[0].innerHTML;
	var n = str.replace("</TD>","");


}
}

		
		
		cont++;
var indiceFila=1;
myNewRow = document.getElementById('grilla').insertRow(-1);
myNewRow.id=indiceFila;
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td>'+ $("#medicamento").val() +'</td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden"  name="forma_'+cont+'" value="'+ $("#forma_farma").val() +'" /><input type="text"  name="formatxt_'+cont+'" value="'+ $("#descri_forma").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text" size="10" name="precio_'+cont+'" value="'+ $("#precio_unitario").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text" size="20"  name="dosis_'+cont+'" value="'+ $("#dosis").val() + $("#dosis_tipo option:selected").text() + '" readonly /><input type="hidden"  name="dosis_num_'+cont+'" value="'+ $("#dosis").val() +'" /><input type="hidden"  name="dosis_tipo_'+cont+'" value="'+ $("#dosis_tipo").val() +'" /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text" size="20" name="horas_'+cont+'" value="'+ $("#horas").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text" size="20" name="dias_'+cont+'" value="'+ $("#dias").val() +'" readonly /><input type="hidden" name="cantidad_'+cont+'" value="'+ 24/parseFloat($("#horas").val())*parseFloat($("#dias").val())+'" /></td>';
//myNewCell=myNewRow.insertCell(-1);
//myNewCell.innerHTML='<td><input type="text" size="20" name="cantidad_x_dosis_'+cont+'" value="'+ Math.ceil(parseFloat($("#dosis").val())/parseFloat($("#posologia").val()))+'" readonly/></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text" size= "50" name="obsermed_'+cont+'" value="'+ $("#obsermed").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden" size= "20" name="var_cont" value="'+ cont +'"> <input type="hidden" name="codigo_barras_'+cont+'" value="'+ $("#codigo_barras").val() +'" readonly /><input type="hidden" name="medicamento_id_'+cont+'" value="'+ $("#medicamento_id").val() +'" /></td><input type="hidden" name="precio_unitario_'+cont+'" value="'+ $("#precio_unitario").val() +'" /><input type="text" name="tipo_grupos_'+cont+'" value="'+ $("#tipo_grupos").val() +'" /><input type="hidden" name="tipo_dosis_o_'+cont+'" value="'+ $("#tipo_dosis_o").val() +'" /><input type="hidden" name="posologia_'+cont+'" value="'+ $("#posologia").val() +'" /><input type="hidden" name="descri_dosis_'+cont+'" value="'+ $("#dosis_tipo option:selected").text() +'" /><input type="hidden" name="cantidad_x_dosis_'+cont+'" value="'+ $("#cantidad_x_dosis").val() +'" /><input type="hidden" name="volumen_'+cont+'" value="'+ $("#volumen").val() +'" /><input type="hidden" size="20"  name="vol_comp_'+cont+'" value="'+ $("#volumen").val() + $("#tipo_volumen option:selected").text() + '" readonly /><input type="hidden" name="tipo_final_'+cont+'" value="'+ $("#tipo_final").val() +'" /><input type="hidden" name="cant_comp_'+cont+'" value="'+ $("#cantidad_x_dosis").val() + $("#valor_poso").val()  +  '" /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden" name="medicamento_'+cont+'" value="'+ $("#medicamento").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><a class="elimina"><img src="../delete.png" /></a></td>';
indiceFila++;
		

				fn_dar_eliminar();
				fn_cantidad();
                alert("Medicamento agregado");
				
				
			formulario.medicamento.value = "";
			formulario.dosis.value = "";
			formulario.precio_unitario.value = "";
			formulario.cantidad_x_dosis.value = "";
			formulario.volumen.value = "";
			formulario.obsermed.value = "";
			formulario.horas.options[0].selected=true;
			formulario.dias.options[0].selected=true;
			
			
			
			
var inputs = $("#frm_usu").getElementsByTagName("input");
for(var i=0;i<inputs.length;i++){
inputs[i].value = "";}
				
            };
			
			
			            function fn_agregar_s(){
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
		if ($("#dosis").val().length == 0) {
  alert('La dosis no puede ser nula');
  return false;
}

	if ($("#cantidad_x_dosis").val().length == 0) {
  alert('La dosis no puede ser nula');
  return false;
}
		
			if ($("#cantidad_x_dosis").val() == 0) {
  alert('La dosis no puede ser cero');
  return false;
}
	
		
if (cont > 0) {		

for (var i=2;i<document.getElementById('grilla').rows.length;i++) {
	var str = document.getElementById('grilla').rows[i].cells[0].innerHTML;
	var n = str.replace("</TD>","");

if ($("#medicamento").val() == n) {
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
myNewCell.innerHTML='<td>'+ $("#medicamento").val() +'</td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden"  name="forma_'+cont+'" value="'+ $("#forma_farma").val() +'" /><input type="hidden"  name="formatxt_'+cont+'" value="'+ $("#forma_farma option:selected").text() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden" size="10" name="precio_'+cont+'" value="'+ $("#precio_unitario").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden" size="10" name="descunit_'+cont+'" value="'+ parseFloat(parseFloat($("#precio_unitario").val()) * parseFloat($("#porc_descuento").val())).toFixed(2) +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden" size="20"  name="dosis_'+cont+'" value="'+ $("#dosis").val() + $("#dosis_tipo option:selected").text() + '" readonly /><input type="hidden"  name="dosis_num_'+cont+'" value="'+ $("#dosis").val() +'" /><input type="hidden"  name="dosis_tipo_'+cont+'" value="'+ $("#dosis_tipo").val() +'" /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden" size="20" name="horas_'+cont+'" value="'+ $("#horas").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden" size="20" name="dias_'+cont+'" value="'+ $("#dias").val() +'" readonly /><input type="hidden" name="cantidad_'+cont+'" value="'+ 24/parseFloat($("#horas").val())*parseFloat($("#dias").val())+'" /></td>';
//myNewCell=myNewRow.insertCell(-1);
//myNewCell.innerHTML='<td><input type="text" size="20" name="cantidad_x_dosis_'+cont+'" value="'+ Math.ceil(parseFloat($("#dosis").val())/parseFloat($("#posologia").val()))+'" readonly/></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text" size= "50" name="obsermed_'+cont+'" value="'+ $("#obsermed").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden" size= "20" name="var_cont" value="'+ cont +'"> <input type="hidden" name="codigo_barras_'+cont+'" value="'+ $("#codigo_barras").val() +'" readonly /><input type="hidden" name="medicamento_id_'+cont+'" value="'+ $("#medicamento_id").val() +'" /></td><input type="hidden" name="precio_unitario_'+cont+'" value="'+ $("#precio_unitario").val() +'" /><input type="text" name="tipo_grupos_'+cont+'" value="'+ $("#tipo_grupos").val() +'" /><input type="hidden" name="tipo_dosis_o_'+cont+'" value="'+ $("#tipo_dosis_o").val() +'" /><input type="hidden" name="posologia_'+cont+'" value="'+ $("#posologia").val() +'" /><input type="hidden" name="descri_dosis_'+cont+'" value="'+ $("#dosis_tipo option:selected").text() +'" /><input type="hidden" name="cantidad_x_dosis_'+cont+'" value="'+ $("#cantidad_x_dosis").val() +'" /><input type="hidden" name="volumen_'+cont+'" value="'+ $("#volumen").val() +'" /><input type="hidden" size="20"  name="vol_comp_'+cont+'" value="'+ $("#volumen").val() + $("#tipo_volumen option:selected").text() + '" readonly /><input type="hidden" name="tipo_final_'+cont+'" value="'+ $("#tipo_final").val() +'" /><input type="hidden" name="cant_comp_'+cont+'" value="'+ $("#cantidad_x_dosis").val() + $("#valor_poso").val() + '" /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden" name="medicamento_'+cont+'" value="'+ $("#medicamento").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><a class="elimina"><img src="delete.png" /></a></td>';
indiceFila++;
		

				fn_dar_eliminar();
				fn_cantidad();
                /*alert("Medicamento agregado");*/
				
				
			formulario.medicamento.value = "";
			formulario.dosis.value = "";
			formulario.cantidad_x_dosis.value = "";
			formulario.precio_unitario.value = "";
			formulario.volumen.value = "";
			formulario.obsermed.value = "";
			formulario.horas.options[47].selected=true;
			formulario.dias.options[0].selected=true;
			
			
			
			
var inputs = $("#frm_usu").getElementsByTagName("input");
for(var i=0;i<inputs.length;i++){
inputs[i].value = "";}
				
            };
			
			
           function fn_dar_eliminar(){
                $("a.elimina").click(function(){
                    id = $(this).parents("tr").find("td").eq(0).html();
                    respuesta = confirm("Desea eliminar el medicamento");
                    if (respuesta){
                        $(this).parents("tr").fadeOut("normal", function(){
                            $(this).remove();
                          //  alert("Medicamento eliminado")
                            /*
                                aqui puedes enviar un conjunto de datos por ajax
                                $.post("eliminar.php", {ide_usu: id})
                            */
                        })
                    }
                });
            };
			
			
	/*				function asigna()
{
valor=document.form.var_cont.value=cont;
alert("El valor de cont es " + valor);
}*/
	
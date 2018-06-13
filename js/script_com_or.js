// JavaScript Document

            $(document).ready(function(){
                fn_dar_eliminar();
				fn_cantidad();
               // $("#frm_usu").validate();
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

if ($("#cantidad").val() <  $("#cant_max_prov").val() ) {
  alert('La cantidad es menor el minimo marcado para el proveedor principal');
}



if ($("#cantidad").val() <= 0) {
  alert('Cantidad no puede ser cero ni menor a cero');
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
myNewCell.innerHTML='<td>'+ $("#medicamento").val() +'</td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="text" size="20" name="cantidad_'+cont+'" value="'+ $("#cantidad").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden" size= "20" name="var_cont" value="'+ cont +'"></td><td><input type="hidden" size="20" name="medicamento_id_'+cont+'" value="'+ $("#medicamento_id").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><a class="elimina"><img src="../delete.png" /></a></td>';
indiceFila++;
		

				fn_dar_eliminar();
				fn_cantidad();
               // alert("Medicamento agregado");
				
				
			formulario.medicamento.value = "";
			formulario.cantidad.value = "";
			formulario.codigo_de_barra.value = "";
			formulario.cant_max_prov.value = "";
			formulario.codigo_barras.value = "";
			
				
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
                            alert("Medicamento eliminado")
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
	
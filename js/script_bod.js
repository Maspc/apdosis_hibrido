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
	

if (parseFloat($("#cantidad").val()) > parseFloat($("#cantidad_origen").val()) ) {
  alert('La cantidad no puede ser mayor a la existente en el origen! origen' + $("#cantidad_origen").val() + 'cantidad ' + $("#cantidad").val() );
  
  return false;
}	

/*alert('cantidad: ' + $("#cantidad_destino").val());*/
/* lo desahibilito porque solo hay dos bodegas y no toman en cuenta el inventario ideal
if(isNaN($("#cantidad_destino").val()) == false){

if (parseFloat($("#cantidad").val()) > parseFloat($("#inventario_ideal").val()) ) {
  alert('La cantidad no puede ser mayor al inventario ideal!');
  return false;
}	
}	*/ 
		
if (cont > 0) {		
for (var i=2;i<document.getElementById('grilla').rows.length;i++) {
if ($("#medicamento").val() == document.getElementById('grilla').rows[i].cells[0].innerHTML) {
 alert('No puede repetir un articulo, modifique el anterior');
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
myNewCell.innerHTML='<td><input type="text" size="20" name="cantidad_'+cont+'" id="cantidad_'+cont+'"  value="'+ $("#cantidad").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><input type="hidden" size= "20" name="var_cont" value="'+ cont +'"></td><td><input type="hidden" size="20" name="medicamento_id_'+cont+'" value="'+ $("#medicamento_id").val() +'" readonly /></td><td><input type="hidden" size="20" name="codigo_de_barra_'+cont+'" value="'+ $("#codigo_de_barra").val() +'" readonly /></td>';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<td><a class="elimina"><img src="../delete.png" /></a></td>';
indiceFila++;
		

				fn_dar_eliminar();
				fn_cantidad();
                alert("Producto agregado");
				
				
			formulario.medicamento.value = "";
			formulario.cantidad.value = "";
			formulario.cantidad_origen.value = "";
			formulario.cantidad_destino.value = "";
			formulario.inventario_ideal.value = "";
		   formulario.codigo_de_barra.value = "";
			
			
					
			
			
for(var i=0;i<inputs.length;i++){
inputs[i].value = "";}
				
            };
			
			
			
           function fn_dar_eliminar(){
		
                $("a.elimina").unbind('click').click(function(){
			
                    id = $(this).parents("tr").find("td").eq(0).html();
                    respuesta = confirm("Desea eliminar el producto?");
                    if (respuesta){
			

					//alert ("Recalculando Totales");	
					
						
						
                        $(this).parents("tr").fadeOut("normal", function(){
                            $(this).remove();
                            alert("Producto eliminado")
                           
                        })
                    }
               });
            };
			
			
	/*				function asigna()
{
valor=document.form.var_cont.value=cont;
alert("El valor de cont es " + valor);
}*/
	
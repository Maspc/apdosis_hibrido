<?php
ob_start();
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
include ('seguridad.php');  
mysql_query("SET NAMES 'utf8'");
$db_selected = mysql_select_db('apdosis_pub', $conn);
/*
echo "antes de entrar";
if(isset($_POST['enviar'])){
echo "entre";
echo "var cont ".$_POST["var_cont"];
for ($i=1;$i<=$_POST["var_cont"];$i++)
 {
echo "Numero de Fila: " ; echo $i;
echo "Medicamento: ";  echo $_POST["medicamento_$i"];
echo "Forma farmaceutica: "; echo $_POST["forma_$i"];
echo "Dosis: "; echo $_POST["dosis_$i"];echo "<br>";
echo "Horas: "; echo $_POST["horas_$i"];echo "<br>";
echo "Dias: "; echo $_POST["dias_$i"];echo "<br>";

 }

}
*/


?>


 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Formulario de Dispensación de Medicamentos</title>
        <script language="javascript" type="text/javascript" src="jquery-1.3.2.min.js"></script>
        <script language="javascript" type="text/javascript" src="jquery.validate.1.5.2.js"></script>
        	<script type="text/javascript" src="js/jquery.validate.min"></script>
        <script language="javascript" type="text/javascript" src="script.js"></script>
        <link href="estilo.css" rel="stylesheet" type="text/css" />
      	<script type='text/javascript' src='lib/jquery.bgiframe.min.js'></script>
		<script type='text/javascript' src='lib/jquery.ajaxQueue.js'></script>
		<script type='text/javascript' src='lib/thickbox-compressed.js'></script>
		<script type='text/javascript' src='jquery.autocomplete.js'></script>
		<script type='text/javascript' src='localdata.js'></script>
		<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
		<link rel="stylesheet" type="text/css" href="lib/thickbox.css" />
   <script type="text/javascript">
$().ready(function() {

  $("#formulario").validate();

	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	

	$("#medicamento").autocomplete("get_medicamento.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		selectFirst: true
	});

	$("#medicamento").result(function(event, data, formatted) {
		$("#medicamento_id").val(data[1]);
	});


	
	$("#clear").click(function() {
		$(":input").unautocomplete();
	});
	
	
	});


	
</script>


<script type="text/javascript">
function limpiar_campos()
{

document.getElementById('medicamento').value='';
document.getElementById('dosis').value='';
}
</script>

   
    </head>
    
    <body>
        <div id="contenedor">
    
            <h1>Formulario de Dispensación de Medicamentos</h1>
          <p align="center"><img src="images/apdosis.png" alt="apdosis" width="268" height="85" /></p>
          <p>&nbsp;</p>
			
			  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="devolucion" id="devolucion">
            
                        <table width="780" border="0" cellspacing="0" >

  <tr>
  <td>
   <label>No. Cargo  <input name="cargo" type="text" size="20" /></label>
   <input name="buscar" type="submit" value="Buscar Cargo" />
  </td>
  </tr>

        </table>
      </form>
 <?php     
      if(isset($_POST['buscar'])){
$cargo = $_POST['cargo'];
$n = "SELECT medicamento, forma_farma, dosis, horas, dias, linea, cargo FROM registro_detalle where cargo = '$cargo'";

$resulta = mysql_query($n, $conn) or die(mysql_error());
echo "<table border='1'>
<tr>

<th>Medicamento</th>
<th>Forma Farmaceutica</th>
<th>Dosis</th>
<th>Cada Horas</th>
<th>Por Días</th>
</tr>";

while($rows = mysql_fetch_array($resulta))
  {
  echo "<tr>";
  echo "<td>" . $rows['medicamento'] . "</td>";
  echo "<td>" . $rows['forma_farma'] . "</td>";
  echo "<td>" . $rows['dosis'] . "</td>";
  echo "<td>" . $rows['horas'] . "</td>";
    echo "<td>" . $rows['dias'] . "</td>";
  
  echo "</tr>";
  }
  echo "</table> <p>";
  


echo "  <hr /><p>";

echo "<h1>Devolución de Cargos </h1> <p>";

echo "<table border='1'>
<tr>

<th>Medicamento</th>
<th>Forma Farmaceutica</th>
<th>Dosis</th>
<th>Cada Horas</th>
<th>Por Días</th><th>Devolución</th>
</tr>";


$cargo2 = $_POST['cargo'];
$h = "SELECT medicamento, forma_farma, dosis, horas, dias, linea, cargo FROM registro_detalle where cargo = '$cargo2'";

$resulta2 = mysql_query($h, $conn) or die(mysql_error());

while($rows = mysql_fetch_array($resulta2))
  {
  echo "<tr>";
  echo "<td> <input type='text' name='medicamento' value='" . $rows['medicamento'] ."' readonly /></td>";
  echo "<td> <input type='text' name='forma' value='" . $rows['forma_farma'] ."' readonly /></td>";
  echo "<td> <input type='text' name='dosis' value='" . $rows['dosis'] ."' readonly /></td>";
  echo "<td> <input type='text' name='horas' value='" . $rows['horas'] ."' readonly /></td>";
    echo "<td> <input type='text' name='dias' value='" . $rows['dias'] ."' readonly /></td>";
   echo "<td> <input type='text' name='devol' /></td>";
  
  echo "</tr>";
  }
  echo "</table> <p>";





}
?>
    </div>
	
</body>
</html>

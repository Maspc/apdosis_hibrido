<?php
ob_start();
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'nipin18*';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = 'apdosis_pub';
include ('seguridad.php');  
mysql_query("SET NAMES 'utf8'");
mysql_select_db($dbname);
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
	
	
		$("#identificacion").autocomplete("get_personas.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		selectFirst: true
	});

	$("#identificacion").result(function(event, data, formatted) {
		$("#nombre_paciente").val(data[1]);
		$("#alergias").val(data[2]);
		$("#peso").val(data[3]);
		$("#otros").val(data[4]);
		$("#compania_de_seguro").val(data[5]);
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

 <script language="javascript">
<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=400');");
}
// End -->
</script>

   
    </head>
    
    <body>
        <div id="contenedor">
    
    
            <h1>
              
            </h1>
          <h1>Formulario de Dispensación de Medicamentos</h1>
          <p align="center"><img src="images/apdosis.png" alt="apdosis" width="268" height="85" /></p>
          <p>&nbsp;</p>
			
			  <form action="enviar.php" method="post" name="formulario" id="formulario">
            <table width="780" border="0" cellspacing="0" >
			
          
             

  <tr>

  <td colspan="8" align="right"><label>Cargo # <input name="cargo" type="text" size="10" class="required" /></label> 
  <label>Factura # <input name="factura" type="text" size="10" readonly="true" /></label></td>
  </tr>
      <tr>
        <td>STAT</td>
        <td colspan="7"><label>
          <input type="checkbox" name="stat" id="stat" value="S" />
               </label></td>
      </tr>
      <td width="86">Identificación</td>
    <td colspan="7">
      <label></label>        <input type="text" name="identificacion" id="identificacion" class="required"/> <label>
      <input type="button" name="crear_paciente" value="Crear Nuevo Paciente" id="crear_paciente" onclick="javascript:popUp('anadir_persona.php')" />
      </label></td>
  </tr>
  <tr>
    <td>Nombre del Paciente</td>
    <td colspan="7"><label>
      <input type="text" name="nombre_paciente" id="nombre_paciente" size="50" class="required" readonly />
    </label></td>
  </tr>
  <tr>
    <td>No. Cama</td>
    <td width="128"><label>
      <input type="text" name="numero_cama" id="numero_cama" class="required" />
    </label></td>
    <td width="75">Médico</td>
    <td width="119"><select name="medico" id="medico"><?php $n = "select codigo_medico, nombre from medicos";
	          $resul = mysql_query($n, $conn) or die(mysql_error());
			  while($cols = mysql_fetch_array($resul)){	  
			  ?>
			  <option value="<? echo $cols["codigo_medico"] ?>"><? echo $cols["nombre"] ?></option>
			    <?php } ?> </select></td>
    <td width="47">Alergias</td>
    <td colspan="3"><label>
      <input type="text" name="alergias" id="alergias"  />
    </label></td>
  </tr>
  <tr>
    <td>Diabetes</td>
    <td><label>
      <input type="checkbox" name="diabetes" id="diabetes" value="S" />
    </label></td>
    <td>Hipertensión</td>
    <td><label>
      <input type="checkbox" name="hipertension" id="hipertension" value="S" />
    </label></td>
    <td>Peso</td>
    <td width="148"><label>
      <input type="text" name="peso" id="peso" size="10"/> lb
    </label></td>
    <td width="29">Otros</td>
    <td width="132"><label>
      <input type="text" name="otros" id="otros" />
    </label></td>
  </tr>
  <tr>
    <td>Compañía de Seguros</td>
    <td colspan="7"><label>
      <input type="text" name="compania_de_seguro" id="compania_de_seguro" size="60" />
    </label></td>
  </tr>
</table>
           
            

                <table class="formulario"><br />
                    <thead>
                        <tr>
                            <th colspan="2"><img src="add.png" />Agregar Orden</th>
                        </tr>
                    </thead> 
<tbody>
                        <tr>
                            <td>Medicamento</td>
                            <td><input name="medicamento" type="text" id="medicamento" size="50"/>
                            <input name="medicamento_id" type="hidden" id="medicamento_id" size="50" /></td>
                        </tr>
                        <tr>
                            <td>Forma Farmaceutica</td>
                            <td><select name="forma_farma" id="forma_farma"><?php $n = "select codigo_forma, descripcion from formas_farmaceuticas";
	          $resul = mysql_query($n, $conn) or die(mysql_error());
			  while($cols = mysql_fetch_array($resul)){	  
			  ?>
			  <option value="<? echo $cols["codigo_forma"] ?>"><? echo $cols["descripcion"] ?></option>
			    <?php } ?> </select></td>
                        </tr>
                        <tr>
                            <td>Dosis</td>
                            <td><input name="dosis" type="text" id="dosis" size="10" /><select name="tipo_posologia" id="dosis_tipo">
		<?php $g = "select codigo_posologia, descripcion from tipos_posologias";
	          $resul1 = mysql_query($g, $conn) or die(mysql_error());
			  while($cols1 = mysql_fetch_array($resul1)){	  
			  ?>
			  <option value="<? echo $cols1["codigo_posologia"] ?>"><? echo $cols1["descripcion"] ?></option>
			    <?php } ?> </select></td>
                        </tr>
                        <tr>
                            <td>Frecuencia horas</td>
                            <td>cada 
                              <select name="horas" id="horas" class="required">
                            <option>0.5</option>
                            <option>1.0</option>
                            <option>1.5</option>
                            <option>2.0</option>
                            <option>2.5</option>
                            <option>3.0</option>
                            <option>3.5</option>
                            <option>4.0</option>
                            <option>4.5</option>
                            <option>5.0</option>
                            <option>5.5</option>
                            <option>6.0</option>
                            <option>6.5</option>
                            <option>7.0</option>
                            <option>7.5</option>
                            <option>8.0</option>
                            <option>8.5</option>
                            <option>9.0</option>
                            <option>9.5</option>
                            <option>10.0</option>
                            <option>10.5</option>
                            <option>11.0</option>
                            <option>11.5</option>
                            <option>12.0</option>
                            <option>12.5</option>
                            <option>13.0</option>
                            <option>13.5</option>
                            <option>14.0</option>
                            <option>14.5</option>
                            <option>15.0</option>
                            <option>15.5</option>
                            <option>16.0</option>
                            <option>16.5</option>
                            <option>17.0</option>
                            <option>17.5</option>
                            <option>18.0</option>
                            <option>18.5</option>
                            <option>19.0</option>
                            <option>19.5</option>
                            <option>20.0</option>
                            <option>20.5</option>
                            <option>21.0</option>
                            <option>21.5</option>
                            <option>22.0</option>
                            <option>22.5</option>
                            <option>23.0</option>
                            <option>23.5</option>
                            <option>24.0</option>                                                  </select> 
                              horas</td>
                        </tr>
                         <tr>
                            <td>Frecuencia días</td>
                            <td>por 
                              <select name="dias"  id="dias">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                            <option>21</option>
                            <option>22</option>
                            <option>23</option>
                            <option>24</option>
                            <option>25</option>
                            <option>26</option>
                            <option>27</option>
                            <option>28</option>
                            <option>29</option>
                            <option>30</option>
                            <option>31</option>
                            <option>32</option>
                            <option>33</option>
                            <option>34</option>
                            <option>35</option>
                            <option>36</option>
                            <option>37</option>
                            <option>38</option>
                            <option>39</option>
                            <option>40</option>
                            <option>41</option>
                            <option>42</option>
                            <option>43</option>
                            <option>44</option>
                            <option>45</option>
                            <option>46</option>
                            <option>47</option>
                            <option>48</option>
                            <option>49</option>
                            <option>50</option>
                            <option>51</option>
                            <option>52</option>
                            <option>53</option>
                            <option>54</option>
                            <option>55</option>
                            <option>56</option>
                            <option>57</option>
                            <option>58</option>
                            <option>59</option>
                            <option>60</option>
                            <option>61</option>
                            <option>62</option>
                            <option>63</option>
                            <option>64</option>
                            <option>65</option>
                            <option>66</option>
                            <option>67</option>
                            <option>68</option>
                            <option>69</option>
                            <option>70</option>
                            <option>71</option>
                            <option>72</option>
                            <option>73</option>
                            <option>74</option>
                            <option>75</option>
                            <option>76</option>
                            <option>77</option>
                            <option>78</option>
                            <option>79</option>
                            <option>80</option>
                            <option>81</option>
                            <option>82</option>
                            <option>83</option>
                            <option>84</option>
                            <option>85</option>
                            <option>86</option>
                            <option>87</option>
                            <option>88</option>
                            <option>89</option>
                            <option>90</option>
                            <option>91</option>
                            <option>92</option>
                            <option>93</option>
                            <option>94</option>
                            <option>95</option>
                            <option>96</option>
                            <option>97</option>
                            <option>98</option>
                            <option>99</option>
                            </select> 
                              días</td>
</tr>
                  </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><input name="agregar" type="button" id="agregar" value="Agregar" onclick="fn_agregar();"/>
                              <label>
                              <input type="button" name="limpiar" id="limpiar" value="Limpiar" onclick="limpiar_campos();"/>
                            </label></td>
                        </tr>
                    </tfoot>
                </table>
      
            <table id="grilla" class="lista">
              <thead>
                    <tr>
                        <th>Medicamento</th>
                        <th>Forma Farmaceutica</th>
                        <th>Dosis</th>
                        <th>Frecuencia Horas</th>
                        <th>Frecuencia Días</th>
                    </tr>
              </thead>
                <tbody>
                </tbody>
                <tfoot>
                	<tr>
                    	<td colspan="5"><strong>Cantidad:</strong> <span id="span_cantidad">0</span> medicamentos.</td>
                    </tr>
                    <tr><td colspan="5"> <div id="results"></div></td></tr>
                </tfoot>
				
            </table>
          
           
            <p align="center">  
  <input type="submit" name="enviar" id="enviar" value="Enviar Cargo" />
  </p>
            <hr />
          
        
      </form>
    </div>
	
</body>
</html>

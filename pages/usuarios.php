<?php
	ob_start();
	include('./clases/session.php');
	require_once('../modulos/usuarios.php');
	$cont = 0;
	require_once('../modulos/layout.php');
	layout::encabezado();
?>

<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:1200px;dialogHeight:600px");
			} else {
			alert(url);
			window.open(url,'name','height=500,width=600,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} </script>
	
	<script type="text/javascript">
		function validate(){
			
			var pass1 = document.usuario.password.value;
			var pass2 = document.usuario.password1.value;
			var nombre = document.usuario.nombre;
			var apellido = document.usuario.apellido;
			var usuario = document.usuario.usuario;
			
			if (nombre == ""){
				alert("Debe introducir un nombre");
				nombre.focus;
				return false;
			}
			
			if (apellido == ""){
				alert("Debe introducir un apellido");
				apellido.focus;
				return false;
			}
			
			if (usuario == ""){
				alert("Debe introducir un usuario");
				usuario.focus;
				return false;
			}
			
			if (pass1 == ""){
				alert("Debe introducir una contraseña");
				pass1.focus;
				return false;
			}
			
			if (pass1 != pass2) {
				alert("Verifique que ambas contraseñas sean iguales");
				pass2.focus;
				return false;
			}
			
			
		}
		
	</script>
	<?php
		layout::menu();
		layout::ini_content();
	?>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="usuario" onSubmit="return validate();">
		<center><h1>Creación de Usuarios</h1></center>
		<table class='dtable' border="1" align="center">
			<!-- <table border="1"> -->
			<tr><td>Nombre de Usuario: </td>
			<td><input name="usuario" type="text" size="50" id="usuario" required /></td></tr>
			<tr><td>Nombre:</td>
			<td><input name="nombre" type="text" size="50" id="nombre" required /></td></tr>
			<tr><td>Apellido:</td>
			<td><input name="apellido" type="text" size="50" id="apellido" required /></td></tr>
			<tr><td>Contraseña:</td>
			<td><input name="contra" type="password" size="50" id="password" required /></td></tr>
			<tr><td>Repetir Contraseña:</td>
			<td><input name="contra1" type="password" size="50" id="password1" required /></td></tr>
			<tr><td>Tipo de Usuario:</td>
				<td><select name="tipo_usuario"><option value="1">Administrador</option>
					<option value="2">Venta Crédito Farmacia</option> 
					<option value="4">Contabilidad</option>
					<option value="6">Caja</option>
					<option value="7">Compras - Inventario</option>
				</select></td></tr>
				<tr><td><input name="enviar" type="submit" value="Guardar" class="green" /></td></tr>
		</table>
		
	</form>
	
	
	<?php
		if (isset($_POST['enviar'])){
			
			$usuario = $_POST['usuario'];
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$contra = $_POST['contra'];
			$tipo_usuario = $_POST['tipo_usuario'];
			
			usuarios::insert1($usuario,$nombre,$apellido,$contra,$tipo_usuario);
			
			echo "<p>Usuario ".$usuario." creado con éxito";
			
		}
		
		layout::fin_content();
	?>	
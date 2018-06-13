<?php
	session_start();
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
			
			var pass = document.usuario.password.value;
			var pass1 = document.usuario.password1.value;
			var pass2 = document.usuario.password2.value;
			var pass3 = document.usuario.password3.value;
			var nombre = document.usuario.nombre;
			
			
			
			if (nombre == ""){
				alert("Debe introducir un nombre");
				nombre.focus;
				return false;
			}
			
			
			
			
			if (document.usuario.cambio.checked==true) {
				
				
				
				if (pass1 == ""){
					alert("Debe introducir la contraseña anterior");
					pass1.focus;
					return false;
				}
				
				if (pass1 != pass) {
					alert("Error en contraseña anterior");
					pass.focus;
					return false;
				}
				
				if (pass2 == ""){
					alert("Debe introducir la contraseña nueva");
					pass2.focus;
					return false;
				}
				
				if (pass2 != pass3) {
					alert("Error al repetir la contraseña");
					pass3.focus;
					return false;
				}
				
			}
		}
		
	</script>
	<?php
		layout::menu();
		layout::ini_content();
	?>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="usuario" onSubmit="return validate();">
		<?php
			$frow = usuarios::usuarios_edit($_SESSION['MM_iduser']);
			foreach($frow as $fw){
			?>
			<center><h1>Datos de Usuario<?=$_SESSION['MM_iduser']?></h1></center>
			<table class='dtable' border="1" align="center">
				<!-- <table border="1"> -->
				<tr><td>Nombre de Usuario: </td>
				<td><input name="usuario" type="text" size="50" id="usuario" value="<?=$fw->user?>" readonly /></td></tr>
				<tr><td>Nombre:</td>
				<td><input name="nombre" type="text" size="50" id="nombre" value="<?=$fw->nombre?>" required /></td></tr>
				<tr><td>Cambio de Contraseña:</td>
				<td> <input type="checkbox" name="cambio" id="cambio" value="S" /></td></tr>
				<tr><td>Contraseña Anterior:</td>
					<td><input type="hidden" name="contrant" type="text" size="50" id="password" value="<?=$fw->password?>"  />
					<input name="contra1" type="password" size="50" id="password1"  /></td></tr>
					<tr><td>Nueva Contraseña:</td>
					<td><input name="contra2" type="password" size="50" id="password2" /></td></tr>
					<tr><td>Repetir Contraseña Nueva:</td>
					<td><input name="contra3" type="password" size="50" id="password3"  /></td></tr>
					
					<tr><td><input name="enviar" type="submit" value="Guardar" class="green" /></td></tr>
			</table>
			
		</form>
		
		
		<?php
			
		}
		
		if (isset($_POST['enviar'])){
			
			$usuario = $_POST['usuario'];
			$nombre = $_POST['nombre'];
			$contra = $_POST['contra2'];
			if(isset($_POST['cambio'])){ 
				$cambio = $_POST['cambio'];
				}else{
				$cambio='N';
			}
			
			//echo "cambio ".$cambio;							
			
			usuarios::upadte1($nombre,$usuario);
			if ($cambio == 'S'){ 
				usuarios::update2($contra,$usuario);
			}
			
			echo "<p>Usuario ".$usuario." actualizado con éxito";
			
		}
		layout::fin_content();
	?>	
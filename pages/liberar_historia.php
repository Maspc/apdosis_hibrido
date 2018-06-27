<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/liberar_historia.php');
	require_once('../modulos/layout.php');
	layout::encabezado();	
?>

<style type="text/css">
	
	.red {
	background-color: red;
	color: white;
	}
	.white {
	background-color: white;
	color: black;
	}
	.green {
	background-color: green;
	color: white;
	}
	
	.blue {
	background-color: #0066FF;
	color: white;
	}
	.red, .white, .blue, .green {
	margin: 0.5em;
	padding: 5px;
	font-weight: bold;
	
	}	
</style>
<?php
	layout::menu();
	layout::ini_content();
?>
<center>   <h1>Liberar Historias</h1> </center>
<div class="content_box_inner" style="font-size:16px" align="center">
    
	<form method="post" action="<?php $_SERVER['PHP_SELF']; ?> ?>" name="formulario" >
		<table align="center">
			<tr><td>Introduzca el n&uacute;mero de Historia a liberar:</td><td><input type="text" name="historia" id="historia" required="required" ></td></tr>
			<tr><td></td><td><input type="submit" name="submit" value="Liberar"></td></tr>
		</table>
	</form>
	
	<?php
		if (isset ($_POST['submit'])){
			$historia = $_POST['historia'];
			
			lib_h::delete1($historia)
			
			echo "<p>La historia ".$historia."fue liberado exitosamente.";
			
			
		}
		
		layout::fin_content();
	?>
	
</div>
<script type="text/javascript">
	function modalWin(url) {
		if (window.showModalDialog) {
			window.showModalDialog(url,"name","dialogWidth:1200px;dialogHeight:600px");
			} else {
			alert(url);
			window.open(url,'name','height=500,width=600,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	} 
</script>
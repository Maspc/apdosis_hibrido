<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/contraindica.php');
	require_once('../modulos/layout.php');
	layout::encabezado();
	$cont = 0;
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
<center>   <h1>Contraindicaciones</h1> </center>
<div class="content_box_inner" style="font-size:smaller">
	
	<?php
		if (isset($_POST['submit'])){
			
			$descripcion=$_POST['contra_farma'];
			$descripcion_paciente=$_POST['contra_pac'];			
			
			contra::add_contra($descripcion,$descripcion_paciente);
			header('location:contraindica.php');
		}
	?>	
	
</div>
<?=layout::fin_content()?>
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
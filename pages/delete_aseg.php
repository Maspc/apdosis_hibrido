<?php
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/delete_aseg.php');
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
<center>   <h1>Aseguradoras</h1> </center>
<div class="content_box_inner" style="font-size:smaller">
    
	<?php
		$id=$_GET['id'];
		
		
		del_aseg::delete1($id);
		
		header('location:aseguradora.php');
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
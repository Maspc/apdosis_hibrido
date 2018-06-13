<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.01 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<?php
		ob_start();
		include ('./clases/session.php');
		require_once('../modulos/proveedores_caja.php');
		$cont = 0;
	?>
	
	<head>
		<title>Apdosis</title>
		
		
		<!-- Start css3menu.com HEAD section -->
		<!-- <link href="http://themes.static.deseloper.org/themes/examples/base.css" type="text/css" rel="stylesheet" /> -->
		<link rel="stylesheet" href="default.htm_files/css3menu1/style.css" type="text/css" />
		<!-- <link href="styles/modal-window.css" type="text/css" rel="stylesheet" /> !-->
		<!-- End css3menu.com HEAD section -->
		
		<script type="text/javascript">
			function modalWin(url) {
				if (window.showModalDialog) {
					window.showModalDialog(url,"name","dialogWidth:1200px;dialogHeight:600px");
					} else {
					alert(url);
					window.open(url,'name','height=500,width=600,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
				}
			} </script>
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
			
	</head>
	
	
	
	<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginheight="0" marginwidth="0" bgcolor="#FFFFFF">
		
		
		<table width="100%" height="85" border="0" cellpadding="0" cellspacing="0" background="../img/topbkg.jpg">
			<tr>
				<td width="50%" height="85"><img src="../img/apdosis_farm.png" alt="apdosis" width="386" height="85" longdesc="apdosis"></td>
				<td width="50%">
					<p align="right"><img src="../img/topright.jpg" alt="img" longdesc="img"></td>
				</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0" background="../img/blackline.gif">
				<tr>
					<td width="100%"><font color="#B8C0F0" face="Arial" size="2">
						
						<!-- Start css3menu.com BODY section id=1 -->
						<?php
							//include('menu.php');  
						?>  
						<p style="display:none"><a href="http://css3menu.com/">My CSS Menu Css3Menu.com</a></p>
						<!-- End css3menu.com BODY section -->
						
					</font></td>
				</tr>
			</table>
			<p style="margin-left: 20"><b><font color="#B8C0F0" face="Arial" size="1">&nbsp;</font></b>
				
				<font face="Arial" size="-1" color="#000000">
					
					<center>   <h1>Proveedores</h1> </center>
					<div class="content_box_inner" style="font-size:smaller">
						
						<?php
							$id=$_GET['id'];
							
							provee::delete_provee($id);
							header('location:proveedores_caja.php');
						?>
						
					</div>
				</font>
				
				
				<div class="cleaner"></div>
			</div>
            
		</div>
		<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
		<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
		<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp; </font></p>
		<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
		<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
		<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
		<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
		<p style="margin-left: 20"><font face="Arial" size="2" color="#000000">&nbsp;</font></p>
		<p style="margin-left: 20" align="center"><font face="Arial" color="#000000" size="1">MASPC</font></p>
		<table border="0" width="100%" cellspacing="0" cellpadding="0" background="../img/botline.gif">
			<tr>
				<td width="100%"><img border="0" src="../img/botline.gif" width="41" height="12"></td>
			</tr>
		</table>
		<div style="text-align:center;font-family:Arial,Helvetica,Sans-Serif;font-size:11px;color:#777;"></div>
		
	</body>
	
</html>

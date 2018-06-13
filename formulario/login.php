<?php require_once('Connections/conexion.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['user'])) {
  $loginUsername=$_POST['user'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_prueba, $prueba);
  
   
  $LoginRS = mysql_query("SELECT `user` FROM usuarios WHERE `user`='$loginUsername' AND password='$password'", $prueba) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
       //declare two session variables and assign them
    $_SESSION['MM_iduser'] = mysql_result($LoginRS, 0);	
	$_SESSION['MM_user'] = $_POST['user'];      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: index.php");
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Formulario de Dispensación de Medicamentos</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="main">
    <div id="middle">
            
            <div id="content" align="center">
              <div class="post">
                  <h3>Sistema de Acceso</h3>
              </div>
                <div class="post"><p class="Estilo1"><center>
                  <img src="images/apdosis.png" alt="apdosis" width="268" height="85" />
                </center></p>
				<form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
				  <div align="center">
				    <table width="200" border="0" align="center">
				      <tr>
				        <td>Usuario:</td>
        <td><label>
          <input type="text" name="user" id="user" />
          </label></td>
      </tr>
				      <tr>
				        <td>Contraseña:</td>
        <td><label>
          <input type="password" name="password" id="password" />
          </label></td>
      </tr>
                    </table>
			        <p>&nbsp;</p>
				  </div>
				  <p align="center">
    <label>
    <center><input type="submit" name="button" id="button" value="Acceder" /></center>
    </label>
  </p>
                </form></div>
            </div>
            
        <div id="footer">
            <p>&nbsp;</p>
      </div>
    </div>
</body>
</html>
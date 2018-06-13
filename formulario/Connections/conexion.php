<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexion	 = "localhost";
$database_prueba = "apdosis_pub";
$username_prueba = "root";
$password_prueba = "nipin18*";
$prueba = mysql_pconnect($hostname_conexion, $username_prueba, $password_prueba) or trigger_error(mysql_error(),E_USER_ERROR); 
?>

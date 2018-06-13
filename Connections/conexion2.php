<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexion2 = "localhost";
$database_conexion2 = "cuc";
$username_conexion2 = "root";
$password_conexion2 = "nipin18*";
$conexion2 = mysql_pconnect($hostname_conexion2, $username_conexion2, $password_conexion2) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
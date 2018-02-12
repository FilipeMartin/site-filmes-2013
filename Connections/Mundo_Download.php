<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Mundo_Download = "localhost";
$database_Mundo_Download = "mundo_download";
$username_Mundo_Download = "root";
$password_Mundo_Download = "";
$Mundo_Download = mysql_pconnect($hostname_Mundo_Download, $username_Mundo_Download, $password_Mundo_Download) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
<?php 
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}?>
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_IPC = "localhost";
$database_IPC = "IPC01";
$username_IPC = "juangon";
$password_IPC = "z4J6m7uB";
$IPC = mysql_pconnect($hostname_IPC, $username_IPC, $password_IPC) or trigger_error(mysql_error(),E_USER_ERROR);
@mysql_query("SET NAMES 'utf-8'");
?>
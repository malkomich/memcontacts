<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

function ObtenerNombreUsuario($identificador)
{
	global $database_IPC, $IPC;
	mysql_select_db($database_IPC, $IPC);
	$query_ConsultaUsuario = "SELECT nombre FROM tabla_usuarios WHERE idUsuario = $identificador";
	$ConsultaUsuario = mysql_query($query_ConsultaUsuario, $IPC) or die(mysql_error());
	$row_ConsultaUsuario = mysql_fetch_assoc($ConsultaUsuario);
	$totalRows_ConsultaUsuario = mysql_num_rows($ConsultaUsuario);
return $row_ConsultaUsuario['nombre'];
}

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

function ObtenerNombreContacto($identificador)
{
	global $database_IPC, $IPC;
	mysql_select_db($database_IPC, $IPC);
	$query_ConsultaContacto = "SELECT nombre FROM tabla_contactos WHERE idContacto = $identificador";
	$ConsultaContacto = mysql_query($query_ConsultaContacto, $IPC) or die(mysql_error());
	$row_ConsultaContacto = mysql_fetch_assoc($ConsultaContacto);
	$totalRows_ConsultaContacto = mysql_num_rows($ConsultaContacto);
return $row_ConsultaContacto['nombre'];
}
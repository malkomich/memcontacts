<?php require_once('Connections/IPC.php'); ?>
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

$maxRows_ConsultaContactos = 10;
$pageNum_ConsultaContactos = 0;
if (isset($_GET['pageNum_ConsultaContactos'])) {
  $pageNum_ConsultaContactos = $_GET['pageNum_ConsultaContactos'];
}
$startRow_ConsultaContactos = $pageNum_ConsultaContactos * $maxRows_ConsultaContactos;

mysql_select_db($database_IPC, $IPC);
$query_ConsultaContactos = "SELECT * FROM tabla_contactos ORDER BY tabla_contactos.nombre";
$query_limit_ConsultaContactos = sprintf("%s LIMIT %d, %d", $query_ConsultaContactos, $startRow_ConsultaContactos, $maxRows_ConsultaContactos);
$ConsultaContactos = mysql_query($query_limit_ConsultaContactos, $IPC) or die(mysql_error());
$row_ConsultaContactos = mysql_fetch_assoc($ConsultaContactos);

if (isset($_GET['totalRows_ConsultaContactos'])) {
  $totalRows_ConsultaContactos = $_GET['totalRows_ConsultaContactos'];
} else {
  $all_ConsultaContactos = mysql_query($query_ConsultaContactos);
  $totalRows_ConsultaContactos = mysql_num_rows($all_ConsultaContactos);
}
$totalPages_ConsultaContactos = ceil($totalRows_ConsultaContactos/$maxRows_ConsultaContactos)-1;
?>
<?php require_once('Connections/IPC.php');
	if (!isset($_SESSION['MM_IdUsuario']))
		header("Location: acceso.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla_principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<?php
header('Content-Type: text/html; charset=UTF-8'); 
?>
<meta name="description" content="Página oficial de MemContacts, una aplicación Web de contactos que permitirá a los usuarios ejercitar la memoria, además de proporcionar una agenda interactiva."
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="includes/jquery.js"></script><!-- Implementacion de JQuery !-->
<!-- InstanceBeginEditable name="doctitle" -->
<title>MemContacts</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="scripts" -->
<!-- InstanceEndEditable -->
<link href="style/principal.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container">
<a href="logout.php">
<div id="salida"><img src="imagenes/design/logout_verde.png" width="80" height="80" title="Salir" /></div></a>
  <div class="sidebar1">
    <?php include("includes/menu.php"); ?>
    <!-- end .sidebar1 --></div>
  <div class="content"><!-- InstanceBeginEditable name="Contenido" -->
<h1 align="center">Agenda</h1>
<table class="tabla">
  <?php do { ?>
    <tr>
      <td class="tabla"><?php echo $row_ConsultaContactos['nombre']; ?></td>
      <td class="tabla"><?php echo $row_ConsultaContactos['telefono']; ?></td>
      <?php if  ($row_ConsultaContactos['foto'] != NULL){?>
      <td class="tabla"><img src="imagenes/contacts/<?php echo $row_ConsultaContactos['foto']; ?>" width="150px" height="100px"/></td>
      <?php } else {?>
      <td class="tabla"><a href="imagen_actualizar.php"><img src="imagenes/contacts/<?php echo $row_ConsultaContactos['foto']; ?>" width="150px" height="100px"/></a></td>
      <?php }?>
    </tr>
    <?php } while ($row_ConsultaContactos = mysql_fetch_assoc($ConsultaContactos)); ?>
</table>

  <!-- InstanceEndEditable -->
    <!-- end .content --></div>
<footer>
<br>
<div class="footer1">
&copy;2013.Todos los derechos reservados.
<address>
	<div align="right"><FORM METHOD=POST ACTION="mailto:malkomich@gmail.com"><input type="submit" value="Contacta con nosotros" class="contacto"></FORM></div>
</address>
</div> 
<div class="footer2"><a href="condiciones.php">Condiciones de Uso</a></div>
	<!-- end .footer --></footer>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($ConsultaContactos);
?>
<?php require_once('Connections/IPC.php');
	if (!isset($_SESSION['MM_IdUsuario']))
		header("Location: acceso.php");
?>
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

$varReceptor_Consulta_Preguntas = "0";
if (isset($_SESSION['MM_IdUsuario'])) {
  $varReceptor_Consulta_Preguntas = $_SESSION['MM_IdUsuario'];
}
mysql_select_db($database_IPC, $IPC);
$query_Consulta_Preguntas = sprintf("SELECT * FROM tabla_preguntas WHERE tabla_preguntas.idReceptor = %s AND tabla_preguntas.estado=0", GetSQLValueString($varReceptor_Consulta_Preguntas, "int"));
$Consulta_Preguntas = mysql_query($query_Consulta_Preguntas, $IPC) or die(mysql_error());
$row_Consulta_Preguntas = mysql_fetch_assoc($Consulta_Preguntas);
$totalRows_Consulta_Preguntas = mysql_num_rows($Consulta_Preguntas);
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
<h1 align="center">Pregunta del d&iacute;a</h1>
<?php if ($totalRows_Consulta_Preguntas!=0){?>
 	<a href="pregunta_list.php">
    <div class="bloque" id="bloque_normal">
	    <div class="foto">
	        <img src="imagenes/design/responder_pregunta.gif" width="100%" height="200" /></div>
    	<div class="descripcion">
		  <h2 class="titulo">Tienes <?php echo $totalRows_Consulta_Preguntas ?> preguntas por resolver</h2>
        </div>
    </div></a>
<?php } else {?>
    <div class="bloque">
		<h2 class="titulo">No tienes ninguna pregunta pendiente de respuesta</h2>
    </div>
<?php }?>
	<a href="pregunta_send.php">
    <div class="bloque" id="bloque_normal">
    	<div class="foto">
	        <img src="imagenes/design/enviar_pregunta.gif" width="128" height="128" /></div>
        <div class="descripcion">
        	<h2 class="titulo">Env&iacute;a una pregunta</h2>
        </div>
    </div></a>
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
mysql_free_result($Consulta_Preguntas);
?>
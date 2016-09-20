<?php require_once('Connections/IPC.php');
	if (!isset($_SESSION['MM_IdUsuario']))
		header("Location: acceso.php");

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tabla_preguntas (pregunta, idEmisor, idReceptor) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['pregunta'], "text"),
                       GetSQLValueString($_SESSION['MM_IdUsuario'], "text"),
                       GetSQLValueString($_POST['contacto'], "int"));

  mysql_select_db($database_IPC, $IPC);
  $Result1 = mysql_query($insertSQL, $IPC) or die(mysql_error());
}

//Consulta contactos para lista desplegable.
mysql_select_db($database_IPC, $IPC);
$query_ConsultaContactos = "SELECT * FROM tabla_contactos ORDER BY tabla_contactos.nombre";
$ConsultaContactos = mysql_query($query_ConsultaContactos, $IPC) or die(mysql_error());
$row_ConsultaContactos = mysql_fetch_assoc($ConsultaContactos);
$totalRows_ConsultaContactos = mysql_num_rows($ConsultaContactos);
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
<h1 align="center">Envia una pregunta al contacto que desee:</h1>
<div class="bloque" id="bloque_normal">
<form action="" method="post" name="form1" id="form1">
<table width="90%" border="0">
  <tr>
    <td><h2>Pregunta:</h2></td>
    <td><input type="text" name="pregunta" id="pregunta" /></td>
  </tr>
  <tr>
    <td><h2>Contacto</h2></td>
      <td>
    <select name="contacto" id="contacto">
      <option value="0" selected="selected">Selecciona un contacto</option>
      <?php
do {  
?>
      <option value="<?php echo $row_ConsultaContactos['idContacto']?>"><?php echo $row_ConsultaContactos['nombre']?></option>
      <?php
} while ($row_ConsultaContactos = mysql_fetch_assoc($ConsultaContactos));
  $rows = mysql_num_rows($ConsultaContactos);
  if($rows > 0) {
      mysql_data_seek($ConsultaContactos, 0);
	  $row_ConsultaContactos = mysql_fetch_assoc($ConsultaContactos);
  }
?>
    </select>
      </td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" value="Enviar" class="entrar"/></td>
    </tr>
</table>
      <input type="hidden" name="MM_insert" value="form1" />
</form>
</div>
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
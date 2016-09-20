<?php require_once('Connections/IPC.php'); 
	include("includes/funciones.php"); 
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

$varUsuario_Consulta_Preguntas = "0";
if (isset($_SESSION['MM_IdUsuario'])) {
  $varUsuario_Consulta_Preguntas = $_SESSION['MM_IdUsuario'];
}
mysql_select_db($database_IPC, $IPC);
$query_Consulta_Preguntas = sprintf("SELECT * FROM tabla_preguntas WHERE tabla_preguntas.idReceptor = %s AND tabla_preguntas.estado = 0", GetSQLValueString($varUsuario_Consulta_Preguntas, "int"));
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

<script language="javascript" type="text/javascript">
function responder(id){
	self.name = 'opener';
	remote = open("pregunta_answer.php?recordID="+id, 'remote', 'width=400, height=150, location=no, scrollbars=yes, menubar=no, resizable=yes, fullscreen=no, status=yes');
	remote.focus();
}

function cambiar(){
	document.getElementById('preg').innerHTML = "ADIOS";
}
</script>
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
<h1 align="center">Elige una pregunta para responder:</h1>
<?php if ($totalRows_Consulta_Preguntas > 0) { // Show if recordset not empty ?>

<?php do{ ?>
<a href="javascript:responder(<?php echo $row_Consulta_Preguntas['idPregunta']; ?>)">
	<div class="bloque_mitad" id="circulo" >
    	<span class="preg"><?php echo $row_Consulta_Preguntas['pregunta'];?></span>
		<span class="emisor"><?php echo ObtenerNombreContacto($row_Consulta_Preguntas['idEmisor'])?></span>
	</div></a>
<?php }while($row_Consulta_Preguntas = mysql_fetch_assoc($Consulta_Preguntas)); ?>

<?php } // Show if recordset not empty ?>
<?php if ($totalRows_Consulta_Preguntas == 0) { // Show if recordset empty ?>
Todos los contactos se encuentran actualizados.
<?php } // Show if recordset empty ?>
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
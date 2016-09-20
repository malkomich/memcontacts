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

mysql_select_db($database_IPC, $IPC);
$query_ConsultaContactos = "SELECT * FROM tabla_contactos";
$ConsultaContactos = mysql_query($query_ConsultaContactos, $IPC) or die(mysql_error());
$row_ConsultaContactos = mysql_fetch_assoc($ConsultaContactos);
$totalRows_ConsultaContactos = mysql_num_rows($ConsultaContactos);

$query_ConsultaContactosConFoto = "SELECT * FROM tabla_contactos WHERE tabla_contactos.foto is NULL";
$ConsultaContactosConFoto = mysql_query($query_ConsultaContactosConFoto, $IPC) or die(mysql_error());
$totalRows_ConsultaContactosConFoto = mysql_num_rows($ConsultaContactosConFoto);
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
<script type="text/javascript">
function subirImagen(){
	self.name = 'opener';
	remote = open('imagen_insertar.php','remote',"width=400,height=150,top=40,left=50,titlebar=NO,resizable=NO") 
	remote.focus();
}
</script>
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
<div class="tabla">
<div class="bloque" id="bloque_normal">
	<div class="foto">
		<img src="imagenes/design/perfil.jpg" width="168" height="168"/>
	</div>
    <div class="descripcion">
    	<h1>
<?php if (isset($_SESSION['MM_IdUsuario'])) {
	echo "Bienvenido, ";
?></h1><br /><h3><?php
	echo ObtenerNombreUsuario($_SESSION['MM_IdUsuario']);}?>
    	</h3>
    </div>
</div>

<div class="bloque_mitad" id="info">
	<p>Tienes <?php echo $totalRows_ConsultaContactos?> contactos.</p>
    <a href="imagen_actualizar.php"><div class="bloque_error">
		<?php echo $totalRows_ConsultaContactosConFoto?> contactos a&uacute;n no tienen foto.
    </div></a>
</div>

<div class="bloque_mitad" id="grafico">
	
  <img src="imagenes/graphics/stats.png" width="100%" height="300px" /></div>
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
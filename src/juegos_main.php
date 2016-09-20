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
<h1 align="center">Juegos</h1>
	<a href="juego1.php">
    <div class="bloque" id="bloque_normal">
    	<div class="foto">
        	<img src="imagenes/design/juego1.jpg" width="200px" height="100px" /></div>
    	<div class="descripcion">
			<h2 class="titulo">¿De Quién Hablas?</h2>
    	    <p>Aparecerá una foto en la pantalla y 4 opciones con nombres de tu agenda. Sólo uno de ellos será el correcto.</p>
		</div>
    </div></a>
	<a href="juego2.php">
    <div class="bloque" id="bloque_normal">
    	<div class="foto">
        	<img src="imagenes/design/juego2.jpg" width="200px" height="200px" /></div>
    	<div class="descripcion">
			<h2 class="titulo">NumberMaster</h2>
    	    <p>Aparecerá un contacto con foto y nombre, deberás introducir el número de teléfono. Se comprobarán las cifras correctas en posición y las cifras correctas totales, y tendrás 10 oportunidades para acertar.</p>
		</div>
    </div></a>
	<a href="juego3.php">
    <div class="bloque" id="bloque_normal">
    	<div class="foto">
        	<img src="imagenes/design/juego3.jpg" width="200px" height="150px" /></div>
    	<div class="descripcion">
			<h2>MahjongContacts</h2>
	        <p>Se mostrarán unas fotografías, así como una serie de nombres. Tú objetivo será emparejar cada nombre con su fotografía de contacto. Date prisa, el tiempo corre.</p>
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

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


<script type="text/javascript">
	var form;
	var fich;
	function validar()
	{
		var ok = true;
		var msg = "Debes escribir algo en los campos:\n";
		form = document.forms["formulario"];
		
		if(form.user.value == "")
		{
			msg += "- Nombre\n";
			ok = false;
		}

		if(form.pass1.value == "")
		{
			msg += "- Contraseña\n";
			ok = false;
		}

		if(form.num.value == "")
		{
			msg += "- Número de teléfono\n";
			ok = false;
		}
		
		if(ok == false)
			alert(msg);
		else
			if (!comprobar())
				ok = false;
			else
				alert("El usuario será registrado");
		return ok;
	}
	
	function comprobar()
	{
		if(form["pass1"].value != form["pass2"].value)
		{
			alert("Las contraseñas deben coincidir. Prueba con otra contraseña más fácil de recordar.")
			return false;
		}
		else
			if ((form["num"].value < 600000000) || (form["num"].value >= 700000000))
			{
				alert("El número de teléfono introducido no es correcto.");
				return false;
			}
			else
				return true;		
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
	<form action=""	method="post" id="formulario">
	<table border="10" align="center">
	<tr>
		<td>Nombre:</td>
		<td><input type="text" name="user" /></td>
	</tr>
	<tr>
		<td>Género:</td>
		<td>
			Hombre<input type="radio" name="genero" value="M" />
			Mujer<input type="radio" name="genero" value="F" />
		</td>
	</tr>
	<tr>
		<td>Contraseña:</td>
		<td><input type="password" name="pass1" /></td>
	</tr>
	<tr>
		<td>Repite la contraseña:</td>
		<td><input type="password" name="pass2"/></td>
	</tr>
	<tr>
		<td>Introduce tu foto de perfil:</td>
		<td><input type="image" name="photo"/></td>
	</tr>
	<tr>
		<td>Número de teléfono:</td>
		<td><input name="num" /></td>
	</tr>
	<tr>
		<td>Breve descripción</td>
		<td><textarea rows="4" cols="35"></textarea></td>
	</tr>
	<tr>
		<td><button onclick="return validar()">Enviar</button>
		<input type="reset" /></td>
	</tr>
	</table>
	</form>
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

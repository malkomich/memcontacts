<?php require_once('Connections/IPC.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Subir imagen</title>
</head>

<body>
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
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if (isset($_GET['recordID']))
	$varContacto = $_GET['recordID'];

if ((isset($_POST["enviado"])) && ($_POST["enviado"] == "form1")) {
	$nombre_archivo = $_FILES['userfile']['name'];
	move_uploaded_file($_FILES['userfile']['tmp_name'], "imagenes/contacts/".$nombre_archivo);

$updateSQL = sprintf("UPDATE tabla_contactos SET foto=%s WHERE idContacto=%s",
						   GetSQLValueString($nombre_archivo, "text"), 
						   GetSQLValueString($varContacto, "int"));
mysql_select_db($database_IPC, $IPC);
$Result1 = mysql_query($updateSQL, $IPC) or die(mysql_error());
?>
    <script>
		window.opener.location.reload();
		self.close();
    </script>
<?php
}
else
{?>

<form action="imagen_insertar.php?recordID=<?php echo $varContacto?>" method="post" enctype="multipart/form-data" id="form1">
  <p>
  <input name="userfile" type="file" />
  </p>
  <p>
    <input name="button" type="submit" id="button" value="Subir imagen" />
  </p>
  <input name="enviado" type="hidden" id="enviado" value="form1" />
</form>
<?php }?>
</body>
</html>
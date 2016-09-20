<?php require_once('Connections/IPC.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Responder a la pregunta</title>
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
	$varPregunta = $_GET['recordID'];

if ((isset($_POST["enviado"])) && ($_POST["enviado"] == "form1")) {
	$updateSQL = sprintf("UPDATE tabla_preguntas SET estado=1, respuesta=%s WHERE idPregunta=%s", 
						   GetSQLValueString($_POST['respuesta'], "text"),
						   GetSQLValueString($varPregunta, "int"));
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
<form action="pregunta_answer.php?recordID=<?php echo $varPregunta?>" method="post" enctype="multipart/form-data" id="form1">
  <p>
  <input name="respuesta" type="text" />
  </p>
  <p>
    <input name="button" type="submit" id="button" value="Responder" />
  </p>
  <input name="enviado" type="hidden" id="enviado" value="form1" />
</form>
<?php }?>
</body>
</html>
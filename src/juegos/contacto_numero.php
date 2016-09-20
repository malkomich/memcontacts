<?php
header('Content-Type: text/html; charset=UTF-8'); 
?>
<?php require_once('../Connections/IPC.php');

mysql_select_db($database_IPC, $IPC);
//Realizo la consulta ordenada aleatoriamente, cogiendo 4 registro solamente.
$query_ConsultaContacto = "SELECT tabla_contactos.foto, tabla_contactos.nombre, tabla_contactos.telefono FROM tabla_contactos ORDER BY RAND()";
$ConsultaContacto = mysql_query($query_ConsultaContacto, $IPC) or die(mysql_error());
$row_ConsultaContacto = mysql_fetch_assoc($ConsultaContacto);
$totalRows_ConsultaContacto = mysql_num_rows($ConsultaContacto);

//Guardar el nombre correcto en una variable:
$correcto=$row_ConsultaContacto['telefono'];
?>
<?php if ($row_ConsultaContacto['foto']!=NULL){ ?>
	<div align="center"><img src="imagenes/contacts/<?php echo $row_ConsultaContacto['foto']; ?>" width="250" height="300" /></div>
<?php } else{?>
<a href="imagen_actualizar.php">
<div class="bloque_error">No hay foto</div>
</a>
<?php }?>
<div class="texto_juego">
  <p align="center"><b>&iquest;Cu&aacute;l es el n&uacute;mero de tel&eacute;fono de <?php echo $row_ConsultaContacto['nombre']; ?>?
    </b></p>
  <form id="form1" name="form1" method="post" action="">
    <input type="text" name="respuesta" id="respuesta"/>
    <input name="validar" id="validar" type="submit" value="" class="aceptar2"/>
    </form>
  <p>&nbsp;</p>
</div>
<?php
mysql_free_result($ConsultaContacto);
?>
<script type="text/javascript">
var correcto = "<?php echo $correcto;?>";
//Funcion para obtener el valor option seleccionado en el formulario.
	function result(opt){
		return opt.find("input[name='respuesta']").val()
	}
	
	$("#validar").on('click',function(){
	var resultado = result($("#form1"));
	if ($.trim(resultado) != ''){
		if (resultado == correcto)
			alert("Correcto!!");
		else
			alert("Has fallado, el número es: "+correcto);
		$("#juego2").load('juegos/contacto_numero.php');

	}else{alert('Escribe un número'); return 1;}
});
</script>
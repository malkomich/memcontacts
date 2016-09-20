<?php
header('Content-Type: text/html; charset=UTF-8'); 
?>
<?php require_once('../Connections/IPC.php');

mysql_select_db($database_IPC, $IPC);
//Realizo la consulta ordenada aleatoriamente, cogiendo 4 registro solamente.
$query_ConsultaFotos = "SELECT tabla_contactos.foto, tabla_contactos.nombre FROM tabla_contactos WHERE tabla_contactos.foto is not NULL ORDER BY RAND() LIMIT 4";
$ConsultaFotos = mysql_query($query_ConsultaFotos, $IPC) or die(mysql_error());
$row_ConsultaFotos = mysql_fetch_assoc($ConsultaFotos);
$totalRows_ConsultaFotos = mysql_num_rows($ConsultaFotos);

//Guardar el nombre correcto en una variable:
$correcto = $row_ConsultaFotos['nombre'];
?>

<div align="center" id="foto"><img src="imagenes/contacts/<?php echo $row_ConsultaFotos['foto']; ?>" width="250" height="300" /></div>
<?php //Genero un array con los registros y los reordeno aleatoriamente:
$opciones=array();
$i=0;
do{
	$opciones[$i] = $row_ConsultaFotos['nombre'];
	$i++;
} while(($row_ConsultaFotos = mysql_fetch_assoc($ConsultaFotos)) && ($i<4));
shuffle($opciones);?>

	<div class="texto_juego">
	  <p align="center"><b>&iquest;Cu&aacute;l es el nombre de este contacto?</b>
	    </p>
	  <form id="form1" name="form1" method="post" action="">
      <table width="90%" border="0">
<?php for ($i=0;$i<sizeof($opciones);$i++){ ?>
		<tr>
            <td><input type="radio" name="option" id="option" value="<?php echo $opciones[$i]; ?>" />
            <label for="radio"><?php echo $opciones[$i]; ?></label></td>
	    </tr>
<?php } ?>
      <tr>
        <td align="center"><input name="aceptar" id="aceptar" value="" class="aceptar1"/>
            </form></td>
        </tr>
    </table>
	</div>
<?php
mysql_free_result($ConsultaFotos);
?>
<script type="text/javascript">
var correcto = "<?php echo $correcto;?>";
//Funcion para obtener el valor option seleccionado en el formulario.
	function result(opt){
		return opt.find("input[name='option']:checked").val()
	}
	
	$("#aceptar").on('click',function(){

	var resultado = result($("#form1"));
	if ($.trim(resultado) != ''){
		//if(window.name <5){
			//window.name++;
			if (resultado == correcto)
				alert("Correcto!!");
			else
				alert("Has fallado :(");
			$("#juego1").load('juegos/foto_cara.php');

	}else{alert('Selecciona una opción'); return 1;}
});
</script>
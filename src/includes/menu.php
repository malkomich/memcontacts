<?php
header('Content-Type: text/html; charset=UTF-8'); ?>
<ul id="menu" class="menu">
      <li class="menu"><a href="index.php"><div class="inicio"></div></a></li>
      <br />
      <li class="menu"><a href="agenda.php"><div class="agenda"></div></a><ul>
        <a href="imagen_actualizar.php"><li class="menu">Actualizar Fotos</li></a>
        <a href="construccion.php"><li class="menu">Importar</li></a>
        </ul></li>
        <br />
      <li class="menu"><a href="pregunta_main.php"><div class="pregunta"></div></a><ul>
      	<a href="pregunta_send.php"><li class="menu">Enviar pregunta</li></a>
        <a href="pregunta_list.php"><li class="menu">Responder pregunta</li></a>
      </ul></li>
      <br />
      <li class="menu"><a href="juegos_main.php"><div class="juegos"></div></a><ul>
       	<a href="juego1.php"><li class="menu">¿De Quién Hablas?</li></a>
        <a href="juego2.php"><li class="menu">NumberMaster</li></a>
        <a href="juego3.php"><li class="menu">MahjongContacts</li></a>
        </ul></li>
	<li class="logo"><img width="100%" height="100%" src="./imagenes/logo.png" /></li>
</ul>
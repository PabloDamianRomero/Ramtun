<!--
Autor: Romero Pablo Damian
Fecha: 28/08/2015
Hora: 8:47 a.m.
---------------------------
Actualización:
Fecha: 30/11/2020
Hora: 00.48 p.m.
-->

<?php
session_start();
if ($_SESSION['tiempo']) {
 if ((time() - $_SESSION['tiempo']) > 900) {
  session_destroy();
  header("Location: index.html");
 } else {
  $_SESSION['tiempo'] = time();
 }
} else {
 header("Location: index.html");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="autor" content="Romero Pablo" />
	<meta name="generator" content="Bluefish 2.2.6" />
	<meta http-equiv="content-language" content="ES"/>
	<meta name="copyright" content="derechos(Romero Pablo ; 6°1°)" />
	<meta name="robots" content="index, follow" />
	<meta name="keywords" content="html, php, consultas, respuestas, ramtun" />
	<meta name="description" content="Consultas y Respuestas Ramtun" />

	<link rel="stylesheet" type="text/css" href="style/style.css" />
	<link type="image/gif" href="style/bullet.gif" rel="shortcut icon" />

	<title>Consultas y Respuestas Ramtun</title>
</head>

<body>


<?php
include 'conexion.php';
?>


<div id="contenedor">

	<div id="encabezado">
		<h1><a href="ppal.php">RAMTUN</a></h1>
	</div> <!-- end encabezado -->


	<div id="cuerpo">
		<div class="return"><a href="ppal.php">volver</a></div>

		<div class="close"><form action="cerrar_session.php" method="POST">
		<input type="submit" value="Cerrar sesión" />
		</form></div>

		<h1>Consultas</h1>

		<h4>Hola <?php echo ($_SESSION['ape'] . ", " . $_SESSION['nom'] . "."); ?></h4>


<?php

$cant = count($_POST);
if ($cant != 0) {
 $idmateria             = $_POST['Materias'];
 $_SESSION['idmateria'] = $idmateria;
} else {
 $idmateria = $_SESSION['idmateria'];
}
$sql       = "SELECT titulo,idconsulta,fecha FROM consultas WHERE idmateria=" . $idmateria . " ORDER BY idmateria DESC";
$resultado = mysqli_query($conexion, $sql) or die("Error");

$numRegistros = mysqli_num_rows($resultado);

class Encrypter
{
 private static $__key = '6772617373686f70706572';
 public static function encrypt($consulta)
 {
  // $salida = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$key), $consulta, MCRYPT_MODE_CBC, md5(md5(Encrypter::$key))));
  // mccrypt desactualizado
  $encryptionKey = base64_decode(Encrypter::$__key);
  $iv            = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
  $encrypted     = openssl_encrypt($consulta, 'aes-256-cbc', $encryptionKey, 0, $iv);
  return base64_encode($encrypted . '::' . $iv);
 }
}

if ($numRegistros != 0) {

 echo "<ul>";

 while ($fila = mysqli_fetch_array($resultado)) {

  $consulta = $fila['idconsulta'];

  $txt_crypt = Encrypter::encrypt($consulta);

  echo '<li><a href="respuestas.php?idconsulta=' . $txt_crypt . '">' . $fila['titulo'] . ' - ' . $fila['fecha'] . '</a></li>';

 }

 echo "</ul>";
} else {

 echo 'No hay consultas para esta materia';
}

if ($_SESSION['tabla'] == 'alumnos') {

 echo '<form action="consultasINS.php" method="POST">

		<h5>Realiza una nueva consulta colocando un titulo de no más de 20 caracteres.</h5>

		<p>Título <input type="text" name="Titulo" required="required"></p>


		<p>Contenido <textarea rows="4" cols="50" name="Contenido" resize="none" required="required"></textarea>

		<input type="submit" value="Crear" /></p>

		<input type="hidden" name="IdMateria" value="' . $idmateria . '"/>

		<input type="hidden" name="iduser" value="' . $_SESSION['iduser'] . '"/>


		</form>';

}
?>

<div class="top"><a href="#"><img src="img_mini/top.png" alt="Subir" /></a></div>

</div><!-- end cuerpo -->



<div id="pie">
<ul>
<li><img src="img_mini/date.png" alt="última actualización" /> Última actualización: 30/11/20</li>
<li><img src="img_mini/vscode_s.png" alt="vscode" /><a href="https://code.visualstudio.com"> Made with Visual Studio Code.</a>&nbsp;
Autor: Romero Pablo Damian</li>
</ul>
</div> <!-- end pie -->



</div> <!-- end contenedor -->
</body>
</html>

<!--
Autor: Romero Pablo Damian
Fecha: 07/09/2015
Hora: 8:43 a.m.
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
	<meta name="autor" content="Romero Pablo-Ortiz Franco" />
	<meta name="generator" content="Bluefish 2.2.6" />
	<meta http-equiv="content-language" content="ES"/>
	<meta name="copyright" content="derechos(Romero Pablo-Ortiz Franco ; 6°1°)" />
	<meta name="robots" content="index, follow" />
	<meta name="keywords" content="html, php, login, registro, ramtun" />
	<meta name="description" content="Respuestas Ramtun" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="style/style.css" />
	<link type="image/gif" href="style/bullet.gif" rel="shortcut icon" />

	<title>Respuestas Ramtun</title>
</head>


<body>

<div id="contenedor">

	<div id="encabezado">
		<h1><a href="ppal.php">Respuestas RAMTUN</a></h1>
	</div> <!-- end encabezado -->


		<div id="cuerpo">
		<div class="return"><a href="consultasrespuestas.php">volver</a></div>

		<div class="close"><form action="cerrar_session.php" method="POST">
		<input type="submit" value="Cerrar sesión" />
		</form></div>

		<h3>Página de Respuestas</h3>

<?php

include "conexion.php";

$CADENA = $_GET['idconsulta'];

class Encrypter
{
    private static $__key = '6772617373686f70706572';
    public static function decrypt($CADENA)
    {
        //$salida = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$key), base64_decode($CADENA), MCRYPT_MODE_CBC, md5(md5(Encrypter::$key))), "\0");
        $encryptionKey             = base64_decode(Encrypter::$__key);
        list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($CADENA), 2), 2, null);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryptionKey, 0, $iv);
    }

}

$CADENA = str_replace(" ", "+", $CADENA);

$CADENA = Encrypter::decrypt($CADENA);

$sql       = "SELECT titulo,contenido FROM consultas WHERE idconsulta=" . $CADENA . "";
$resultado = mysqli_query($conexion, $sql) or die("Error");

echo "<table border = '1'> \n";
echo "<tr><th>Título de la consulta</th><th>Contenido</th></tr> \n";

while ($row = mysqli_fetch_row($resultado)) {

    echo "<tr><td>$row[0]</td><td>$row[1]</td></tr> \n";
}

echo "</table> \n";

$sql2       = "SELECT idalumno,iddocente,contenido,fecha,nombre,apellido FROM respuestas WHERE idconsulta=" . $CADENA . " ORDER BY idrespuesta ASC";
$resultado2 = mysqli_query($conexion, $sql2) or die("Error");

$numRegistros = mysqli_num_rows($resultado2);

if ($numRegistros != 0) {

    echo "<div id='respuestas'><ul>";

    while ($fila = mysqli_fetch_array($resultado2)) {

        echo '<li> ' . $fila['apellido'] . ' ' . $fila['nombre'] . ' dice: ' . $fila['contenido'] . '  ' . $fila['fecha'] . '</li>';

    }

    echo "</ul></div>";
} else {

    echo 'No existen respuestas.';
}

//------------------------------------------------------------------------------------------------------------------------

if ($_SESSION['tabla'] == 'alumnos') {
    echo '<form action="respuestasINS.php" method="POST">



		<p>Responder <textarea rows="4" cols="50" name="Contenido" resize="none" required="required"></textarea>

		<input type="submit" value="Realizar" /></p>

		<input type="hidden" name="idconsulta" value="' . $CADENA . '"/>

		<input type="hidden" name="idalumno" value="' . $_SESSION['iduser'] . '"/>


		</form>';
} else {
    echo '<form action="respuestasINS.php" method="POST">



		<p>Responder<textarea rows="4" cols="50" name="Contenido" resize="none" required="required"></textarea>

		<input type="submit" value="Realizar" /></p>

		<input type="hidden" name="idconsulta" value="' . $CADENA . '"/>

		<input type="hidden" name="iddocente" value="' . $_SESSION['iduser'] . '"/>


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
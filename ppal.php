<!--
Autor: Romero Pablo Damian
Fecha: 07/09/2015
Hora: 8:43 a.m.
---------------------------
Actualización:
Fecha: 27/11/2020
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
	<meta name="autor" content="Romero Pablo-Ortiz Franco" />
	<meta name="generator" content="Bluefish 2.2.6" />
	<meta http-equiv="content-language" content="ES"/>
	<meta name="copyright" content="derechos(Romero Pablo-Ortiz Franco ; 6°1°)" />
	<meta name="robots" content="index, follow" />
	<meta name="keywords" content="html, php, principal, ramtun" />
	<meta name="description" content="Página principal Ramtun" />

	<link rel="stylesheet" type="text/css" href="style/style.css" />
	<link type="image/gif" href="style/bullet.gif" rel="shortcut icon" />

	<title>Página principal Ramtun</title>
</head>

<body>

<?php
$cant = count($_POST);
?>

<div id="contenedor">

	<div id="encabezado">
		<h1><a href="ppal.php">RAMTUN</a></h1>
	</div> <!-- end encabezado -->



	<div id="cuerpo">

		<div class="close"><form action="cerrar_session.php" method="POST">
		<input type="submit" value="Cerrar sesión" />
		</form></div>

		<h1>Página principal</h1>


		<h4>¡Bienvenido! <?php echo ($_SESSION['ape'] . ", " . $_SESSION['nom']); ?></h4>


		<div class="frmpal"><form action="ppal.php" method="POST">
		<h5>Seleccione el año y luego la materia del mismo para consultar o responder.</h5>
		<p>Año<select name="Anio">


<?php

include 'conexion.php';

$sql       = "SELECT * FROM anios";
$resultado = mysqli_query($conexion, $sql) or die("Error");
while ($fila = mysqli_fetch_array($resultado)) {
 echo ("<option value=" . $fila['idanio'] . ">" . $fila['numero'] . "</option>");
}

?>

		</select>
		<input type="submit" value="Ver materias"></p>
		</form></div>


		<div class="frmpal"><form action="consultasrespuestas.php" method="POST">
		<p>Materia<select name="Materias">

<?php

if ($cant != 0) {

 if ($_SESSION['tabla'] == 'docentes') {
  $idanio    = $_POST['Anio'];
  $sql       = "SELECT * FROM materias INNER JOIN materiasdocentes ON materias.idmateria=materiasdocentes.idmateria WHERE materias.idanio='" . $idanio . "' AND materiasdocentes.iddocente='" . $_SESSION['iduser'] . "'";
  $resultado = mysqli_query($conexion, $sql) or die("Error");

  while ($fila = mysqli_fetch_array($resultado)) {
   echo ("<option value=" . $fila['idmateria'] . ">" . $fila['nombre'] . "</option>");
  }
  echo '</select>';
  echo '<input type="submit" value="Consultar/Responder"></p>';
  echo '</form></div>';

 } else {
  $idanio    = $_POST['Anio'];
  $sql       = "SELECT * FROM materias WHERE idanio='" . $idanio . "'";
  $resultado = mysqli_query($conexion, $sql) or die("Error");

  while ($fila = mysqli_fetch_array($resultado)) {
   echo ("<option value=" . $fila['idmateria'] . ">" . $fila['nombre'] . "</option>");
  }
  echo '</select>';
  echo '<input type="submit" value="Consultar/Responder"></p>';
  echo '</form></div>';
 }

} else {
 echo '</select>';
 echo '<input type="submit" disabled value="Consultar/Responder"></p>';
 echo '</form></div>';
}

?>


	</div> <!-- end cuerpo -->



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
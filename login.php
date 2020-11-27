<!--
Autor: Romero Pablo Damian
Fecha: 28/08/2015
Hora: 8:47 a.m.
---------------------------
Actualización:
Fecha: 27/11/2020
Hora: 00.48 p.m.
-->
<?php

include 'conexion.php';

if (($_POST['dni']) and ($_POST['clave'])) {
 //Recepcion de datos y asignacion a variables locales
 $tabla = $_POST['tipo'];
 $dni   = $_POST['dni'];
 $clave = $_POST['clave'];

 //Eliminacion de comillas p/EVITAR sql iNJECTION
 $clave = str_replace("'", "", $clave);

 $clave = md5($clave);

 $sql       = "SELECT * FROM " . $tabla . " WHERE dni='" . $dni . "' AND clave='" . $clave . "'";
 $resultado = mysqli_query($conexion, $sql) or die("Error");

 $numRegistros = mysqli_num_rows($resultado);

 if (!is_numeric($dni)) {
  echo "Error, ingrese un dni con formato numerico";
  header('refresh:3; URL=login.html');
 } elseif ($numRegistros == 0) {

  echo "Error, no existen registros que coincidan con tu D.N.I. y clave";
  header('refresh:3; URL=login.html');

 } else {

  session_start();
  $fila = mysqli_fetch_array($resultado);
  if ($tabla == 'alumnos') {
   $_SESSION['iduser'] = $fila['idalumno'];
  } else {
   $_SESSION['iduser'] = $fila['iddocente'];
  }

  $_SESSION['nom']    = $fila['nombre'];
  $_SESSION['ape']    = $fila['apellido'];
  $_SESSION['tabla']  = $tabla;
  $_SESSION['tiempo'] = time();

  echo "Login exitoso";
  header('refresh:3; URL=ppal.php');

 }

}
?>

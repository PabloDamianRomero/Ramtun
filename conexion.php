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

$conexion = mysqli_connect("localhost", "root", "phpmyadmin40068425", "ramtun");
// $conexion = mysqli_connect("192.168.20.11", "root", "Epet20");
//mysqli_select_db($conexion,"ramtun");
mysqli_set_charset($conexion, "utf8");
mysqli_select_db($conexion, "ramtun") or die('No existe la base de datos');

?>

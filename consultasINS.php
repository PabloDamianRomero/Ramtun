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
include ("conexion.php");
$titulo = $_POST['Titulo'];
$idusuario = $_POST['iduser'];
$contenido = $_POST['Contenido'];
$idmateria = $_POST['IdMateria'];

$sql = "INSERT INTO consultas (titulo,contenido,idmateria,idalumno) VALUES ('".$titulo."','".$contenido."',".$idmateria.",".$idusuario.")";

$resultado = mysqli_query($conexion, $sql) or die ('Error');

mysqli_close($conexion);


				

?>

<?php

	header('refresh:3; URL=consultasrespuestas.php');
	echo ('Por favor, aguarde un momento...');

?>
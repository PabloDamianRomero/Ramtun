<!--
Autor: Romero Pablo Damian
Fecha: 28/08/2015
Hora: 8:41 a.m.
-->

<?php
	session_start();

	session_destroy();
	
	header("Location: index.html"); 
	

?>
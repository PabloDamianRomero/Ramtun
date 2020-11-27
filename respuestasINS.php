<!--
Autor: Romero Pablo Damian
Fecha: 07/09/2015
Hora: 8:43 a.m.
-->

<?php

class Encrypter
{
 private static $__key = '6772617373686f70706572';
 public static function encrypt($consulta)
 {
  $encryptionKey = base64_decode(Encrypter::$__key);
  $iv            = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
  $encrypted     = openssl_encrypt($consulta, 'aes-256-cbc', $encryptionKey, 0, $iv);
  return base64_encode($encrypted . '::' . $iv);
 }
}

include "conexion.php";
session_start();
$contenido = $_POST['Contenido'];
$consulta  = $_POST['idconsulta'];

if ($_SESSION['tabla'] == 'alumnos') {

 $idalumno = $_POST['idalumno'];

 $sql = "INSERT INTO respuestas (contenido,idconsulta,idalumno,nombre,apellido) VALUES ('" . $contenido . "','" . $consulta . "','" . $idalumno . "','" . $_SESSION['nom'] . "','" . $_SESSION['ape'] . "')";

 $resultado = mysqli_query($conexion, $sql) or die('Error');
 mysqli_close($conexion);
} else {
 $iddocente = $_POST['iddocente'];
 $sql       = "INSERT INTO respuestas (contenido,idconsulta,iddocente,nombre,apellido) VALUES ('" . $contenido . "','" . $consulta . "','" . $iddocente . "','" . $_SESSION['nom'] . "','" . $_SESSION['ape'] . "')";
 $resultado = mysqli_query($conexion, $sql) or die('Error');
 mysqli_close($conexion);
}

?>

<?php

echo ('Por favor, aguarde un momento...');

$txt_crypt = Encrypter::encrypt($consulta);
?>



<form name="myForm" id="myForm" action="respuestas.php" method="GET">
<input type="hidden" name="idconsulta" value ="<?php echo $txt_crypt; ?>" </input>
</form>

</body>




<script>// Auto envío de formulario a pag.respuestas para no perder el idusuario
function EnviarForm(){
	setInterval(document.myForm.submit(),3000);
}
EnviarForm();
</script>

</html>
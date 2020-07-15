<?php
function foo($cadena)
{
	$key='COPROCENVA';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
	$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    return $decrypted;
}
?>
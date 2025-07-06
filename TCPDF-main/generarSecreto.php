<?php
require_once 'phpqrcode/qrlib.php'; // ruta a tu librería
include("clases/mysql.inc.php");
$db= new mod_db();
require 'vendor/autoload.php'; //Librería Composer

use Sonata\GoogleAuthenticator\GoogleAuthenticator;
use Sonata\GoogleAuthenticator\GoogleQrUrl;

// Simulamos el ID de usuario
$usuario_id = 1; // deberías obtenerlo de la sesión o login

// 1. Generar el secreto
$g = new GoogleAuthenticator();
$secret = $g->generateSecret();
echo $secret;
echo "<br>";

// 2. Guardar el secreto en la base de datos
//guardarSecretEnBaseDeDatos($usuario_id, $secret); // Función que tú defines

$usuario_id = 1;

    $string = "Usuario='$usuario_id',
			secret_2fa='$secret'";
			

$update_str = "id=1";
$db->update("usuarios", $string,$update_str);

// 3. Crear la URL del QR (nombre del sistema + usuario)

// Paso 2: Crear la URL para el código QR
// Paso 2: Crear la URL en formato TOTP
$nombre_usuario = 'fulanodetal@gmail.com';
$nombre_aplicacion = 'MiSistema';
$url = GoogleQrUrl::generate($nombre_usuario, $secret, $nombre_aplicacion);


$qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' .($url);

echo '<img src="' . $qr_url . '" alt="Escanea este QR con Google Authenticator">';
//echo $$qr_url."<br>";
//Paso 3: Generar la imagen QR
//QRcode::png($url);

?>
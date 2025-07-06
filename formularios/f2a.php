<?php
  include_once '../clases/mysql.inc.php';
  
  require '../vendor/autoload.php';
  use Sonata\GoogleAuthenticator\GoogleAuthenticator;
  use Sonata\GoogleAuthenticator\GoogleQrUrl;
  $g = new GoogleAuthenticator();
  $secret = $g->generateSecret();
  //guardarSecretEnBaseDeDatos($usuario_id, $secret); // Implementa esta función
  $correo = 'usuario@ejemplo.com';
  $app = 'MiSistema';
  $url = GoogleQrUrl::generate($correo, $secret, $app);
  $qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . $url;
  echo '<img src="' . $qr_url . '" alt="Escanea este QR con Google Authenticator">';
  echo '<p>Secreto: ' . $secret . '</p>';


  // function guardarSecretEnBaseDeDatos($usuario_id, $secret) {
  //     // Implementa la lógica para guardar el secreto en la base de datos
  //     // Por ejemplo, puedes usar una consulta SQL para insertar el secreto asociado al usuario
  //     mod_db $bd = new mod_db();
  //     $bd->getConexion();
  //     $bd->update("usuarios", "secret_2fa = '$secret'", "id = $usuario_id");
  //     // Ejecuta la consulta aquí
  // }

?>
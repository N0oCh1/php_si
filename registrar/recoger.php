<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<style>
  .boton-verde {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .boton-verde:hover {
            background-color: #218838;
        }
        .volver {
            margin: 50px 100px;
        }
</style>

<body>
  <header>
    

    <div class="volver">
        <a class="boton-verde" href="../login">⬅ Regresar al login</a>
    </div>
  </header>
  <main style="display: flex; flex-direction: column; justify-content: center; align-items: center ; gap: 12px;">
    <?php
    include("../clases/c_Conexion.php");
    include("../clases/c_RegistrarUsuario.php");
    require "../vendor/autoload.php";

    use Sonata\GoogleAuthenticator\GoogleAuthenticator;
    use Sonata\GoogleAuthenticator\GoogleQrUrl;

    // ini_set('display_errors', 1);
    // ini_set('log_errors', 1);
    // ini_set('error_log', 'D:\wamp64\www\login\php_error.log');
    $pdo = new mod_db();
    $url;
    try {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Usuario = new RegistrarUsuarios($_POST, $pdo);
        $data =  $Usuario->getData();
        $correo = $Usuario->getCorreo();
        $user = $Usuario->getUsuario();
        
        if(!$correo && !$user){
          $Usuario->GuardarUsuario();
          $data = $Usuario->getData();
          $g = new GoogleAuthenticator();
          $secret = $g->generateSecret();
          echo "<p>".$secret."</p>";
          if ($secret) {
            $Usuario->GuardarSecret($secret);
            $url = GoogleQrUrl::generate($data['Correo'], $secret, "test");
            $qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . ($url);
            echo '<img class = "imag"src="' . $qr_url . '" alt="Escanea este QR con Google Authenticator">';
          }
        }
        else{
          echo '<h1 style="color: white;">Correo o Usuario ya existente, intenta logiarte</h1>';
        }
      }
    } catch (Exception $e) {
      echo "hubo un error" . $e->getMessage();
    }
    ?>
  </main>
</body>
<style>
  p{
    background-color: white;
  }
  body{
    background-color: #1f1f1f;
  }
  .imag{
    background-color: white;
    padding: 12px;
    border-radius: 12px;
  }
</style>
</html>
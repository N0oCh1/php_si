<?php
require '../vendor/autoload.php'; //Librería Composer
use Sonata\GoogleAuthenticator\GoogleAuthenticator;
use Sonata\GoogleAuthenticator\GoogleQrUrl;
include("../clases/c_Conexion.php");
    $mensaje ="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $user = $_SESSION['Usuario'];
    $db = new mod_db();
    $datas = $db->ObtenerUsuario1($user);
    $codigo = $_POST['codigo'];

    $g = new GoogleAuthenticator();

    if ($g->checkCode($datas['secret_2fa'], $codigo)) {
        header("Location: PanelControl.php");
        $_SESSION['autenticado']= "SI";

    }
    else{
        $mensaje = "<p>Codigo invalido</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2FA</title>
</head>
<body>
    <main style="display: flex; justify-content: center; height: 100vh; align-items: center; ">
        <form method="POST" style="max-width: 400px; display: flex; flex-direction: column; justify-content: center; gap:12px;">
            <div style="display: flex; flex-direction: column; gap: 8px;">
                <label for="codigo">Código de Google Authenticator:</label>
                <input type="text" name="codigo" required />
            </div>
            <button type="submit">Verificar</button>
            <?= $mensaje ?>
        </form>
    </main>
</body>
</html>
<style>
    input[type="text"]{
        padding: 4px 8px;
        font-size: 24px;
        text-align: center;
        font-weight: bold;
        border-radius: 8px;

    }
    body{
        padding: 0;
        margin: 0;
        background-color: #1f1f1f;
    }
    form{
        padding: 12px;
        border-radius: 12px;
        background-color: white;
    }
    label{
        font-size: 24px;
        font-weight: bold;
    }
    button{
        box-sizing: border-box;
        border: 1px solid transparent;
        padding: 4px 8px;
        font-size: 24px;
        background-color: #4facfe;
        border-radius: 8px;
        color: white;
    }
    button:hover{
        background-color:  white;
        color: #4facfe;
        border: 1px solid #4facfe
    }
</style>
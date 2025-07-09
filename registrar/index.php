<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form</title>
  <link rel="stylesheet" href="style.css">
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
            position: absolute;
            top: 100px;
            left: 200px;
        }
</style>
<body style="background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; width:100%;  margin: 0;">
<main style="width: 100%;  margin: auto;">

<div class="volver">
        <a class="boton-verde" href="../login.php">⬅ Volver</a>
    </div>

    <form style="display: flex; flex-direction: column; margin: auto; gap: 12px; width:100%; max-width: 400px; padding: 2rem; background-color: #f9f9f9; border-radius: 1rem;" 
          action="recoger.php" 
          method="POST"
    >
      <label for="name">
        Nombre
      </label>
      <input type="text" name="name" required placeholder="Nombre" pattern="[a-zA-Z]*"/>
      <label for="lastName">
        Apellido
      </label> 
      <input type="text" name="lastName" required placeholder="Apellido" pattern="[a-zA-Z]*"/>

      <label for="email">Correo Electronico</label>
      <input type="email" required name="email" placeholder="Example@example.com"/>

      <label for="user">Usuario</label>
      <input type="text" required name="user" placeholder="User"/>

      <label for="hash">Contraseña</label>
<input type="password" required name="hash" placeholder="Ej. TuContraseñaSegura123" minlength="8" />


      <input type="submit" value="Registrar Usuario" style="margin-top: 12px;"/>
    </form>
  </main>
</body>
</html>
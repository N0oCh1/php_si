<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body style="background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);">
  <main>
    <form style="display: flex; flex-direction: column; margin: auto; gap: 12px; max-width: 400px; padding: 2rem; background-color: #f9f9f9; border-radius: 1rem;" 
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
      <input type="password" required name="hash" placeholder="#jawd3" />

      <label for="sex">Sexo</label>
      <select name="sex">
        <option value="">Selecciona un sexo</option>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
      </select>
      <input type="submit" value="Registrar Usuario" style="margin-top: 12px;"/>
    </form>
  </main>
</body>
</html>
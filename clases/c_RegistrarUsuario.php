<?php
include("SanitizarEntrada.php");



class RegistrarUsuarios {
  private $id;
  private string $name;
  private string $lastName;
  private string $email;
  private string $user;

  private string $secret_2fa;
  private String $password;
  private string $hash;

  private  $pdo;
  private string $table;
  private string $fechaSistema;


  public function __construct($datos, $pdo)
  {
    $sanitizar = new SanitizarEntrada();
    
    $this->pdo = $pdo;
    $this->table = 'usuarios';
    $this->fechaSistema = date('Y-m-d H:i:s');

    $this->name = $sanitizar::limpiarCadena($datos['name'] ?? '');
    $this->lastName = $sanitizar::limpiarCadena($datos['lastName'] ?? '');
    $this->email = $sanitizar::limpiarCadena($datos['email'] ?? '');
    $this->user = $sanitizar::limpiarCadena($datos['user'] ?? '');
    $this->password = $sanitizar::limpiarCadena($datos['hash'] ?? '');

  }

  public function GuardarUsuario(){
    $this->encriptarData();

    $data = array(
      "Nombre" => $this->name,
      "Apellido" => $this->lastName,
      "Usuario" => $this->user,
      "Correo" => $this->email,
      "HashMagic" => $this->hash,
      "FechaSistema" => $this->fechaSistema
    );
    try{
      $this->pdo->insertSeguro($this->table, $data);
    } catch(Exception $e)
    {
      return true;
    }
  }

  public function encriptarData() {
    
    $this->hash = password_hash($this->password, PASSWORD_DEFAULT);
  }

  public function GuardarSecret($secret) {
    $datosSecretos = array(
      "secret_2fa" => $secret
    );
    $condicion = array("id"=>$this->id);

    if($this->pdo->updateSeguro($this->table, $datosSecretos, $condicion)){
      return true;
    } else {
      return false;
    }
  }
  // obtener data de la base de datos
  public function getData () {
    $arr = $this->pdo->ObtenerUsuario($this->email);
    $arr ? $this->id = $arr['id'] : null;
    return $arr;
  }
  public function getCorreo () {
    $arr = $this->pdo ->ObtenerUsuario($this->email);
    return $arr;
  }
   public function getUsuario () {
    $arr = $this->pdo ->ObtenerUsuario1($this->user);
    return $arr;
  }


  public function actualizarUsuario($id, $data) {
    $sanitizar = new SanitizarEntrada();

    $datos = [
        "Nombre"   => $sanitizar::limpiarCadena($data['name'] ?? ''),
        "Apellido" => $sanitizar::limpiarCadena($data['lastName'] ?? ''),
        "Correo"   => $sanitizar::limpiarCadena($data['email'] ?? ''),
        "Usuario"  => $sanitizar::limpiarCadena($data['user'] ?? ''),

    ];

    $sql = "UPDATE {$this->table} SET Nombre = ?, Apellido = ?, Correo = ?, Usuario = ?  WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        $datos['Nombre'],
        $datos['Apellido'],
        $datos['Correo'],
        $datos['Usuario'],

        $id
    ]);
}


public function actualizarPassword($id, $nuevaClave) {
  $hash = password_hash($nuevaClave, PASSWORD_DEFAULT);
  
  $sql = "UPDATE {$this->table} SET HashMagic = :hash WHERE id = :id";
  $stmt = $this->pdo->prepare($sql);
  $stmt->bindValue(':hash', $hash);
  $stmt->bindValue(':id', $id);
  
  return $stmt->execute();
}

public function desactivarUsuario($id) {
  $sql = "UPDATE {$this->table} SET activo = 0 WHERE id = ?";
  $stmt = $this->pdo->prepare($sql);
  return $stmt->execute([$id]);
}

public function activarUsuario($id) {
  $sql = "UPDATE {$this->table} SET activo = 1 WHERE id = ?";
  $stmt = $this->pdo->prepare($sql);
  return $stmt->execute([$id]);
}



public function obtenerPorId($id) {
  $sql = "SELECT * FROM $this->table WHERE id = ?";
  $stmt = $this->pdo->prepare($sql);
  $stmt->execute([$id]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}


}
?>
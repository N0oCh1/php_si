<?php
include("../clases/SanitizarEntrada.php");



class RegistrarUsuarios {
  private $id;
  private string $name;
  private string $lastName;
  private string $email;
  private string $user;
  private string $sex;

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
    $this->sex = $sanitizar::limpiarCadena($datos['sex'] ?? '');
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
}
?>
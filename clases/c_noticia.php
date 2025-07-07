<?php
  include("../clases/c_Conexion.php");
  class Noticia{
    private $titulo;
    private $contenido;
    private $tipo;
    private $imagen;
    private $autor;
    private $tipoImagen;
    private $db;

    public function __construct()
    {
      $this->db = new mod_db();
    }
    public function obtenerNoticias() {
      header("Content-type:application/json; charset=utf-8");
      try{
        $noticias = $this->db->obtenerNoticias();
        http_response_code(200);
        echo json_encode($noticias);
      }
      catch(Error $e){
        http_response_code($e->getCode());
        echo json_encode([
          "error" => $e->getMessage(),
          "code" => $e->getCode()
        ]);
      }
    }
  }

  if($_SERVER["REQUEST_METHOD"] === "GET"){
    $controller = new Noticia();
    $controller->obtenerNoticias();
  }
?>
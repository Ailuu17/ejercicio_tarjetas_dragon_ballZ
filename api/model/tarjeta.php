<?php
class Tarjeta {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function obtenerTarjetasUsuario($usuario_id) {
        $query = "SELECT t.* FROM tarjetas t INNER JOIN usuarios u ON t.usuario_id = u.id WHERE u.id = :usuario_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}










require_once __DIR__ . '/../config/conexion.php';

class Tarjeta {
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  
  public function obtenerTodos () {
    $stmt = $this->pdo->prepare("SELECT * FROM tarjetas");
    $stmt->execute();
    $tarjetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return [
      "success" => true,
      "tarjetas" => $tarjetas,
      "total" => count($tarjetas)
    ];
  }

  public function obtenerMisTarjetas ($usuarioId) {
    // ut: usuario_tarjetas
    // t: tarjetas
    // u: usuario
    $query = "
      SELECT t.*, ut.fecha_obtencion
      FROM tarjetas t
      INNER JOIN usuario_tarjetas ut ON t.id = ut.tarjeta_id
      WHERE ut.usuario_id = :usuario_id
      ORDER BY ut.fecha_obtencion DESC
    ";
    
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(['usuario_id' => $usuarioId]);
    
    $tarjetas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $tarjetas;
  }
}
?>
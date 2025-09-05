<?php

class usuario {
    private $db;

    public function __construct() {
         $this->conn = connection();
    }

  public function login($username, $password) {
        $sql = "SELECT id, nombre, email, password FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $username['password'])) {
                return $username; // Return user data without password
            }
        }
        return false;
    }}










    require_once __DIR__ . '/../config/conexion.php';

class Usuario {
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  
  public function login ($user) {
    $stmt = $this->pdo->prepare("SELECT id, password, nombre_completo FROM usuarios WHERE username = :user");

    if (!isset($user)) {
      return "Falta especificar el usuario";
    }
    
    $stmt->execute([
      "user" => $user
    ]);

    $tarjetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $tarjetas;
  }

  public function logout () {
    require_once __DIR__ . '/../config/sesion.php';
    if (isset($_SESSION['usuario_id']) && isset($_SESSION['username'])) {
      session_destroy();
      echo json_encode(["success" => true]);
    } else {
      echo json_encode([
        "success" => false,
        "message" => "No hay sesión activa"
      ]);
    }
  }

  public function verificarSesion () {
    require_once __DIR__ . '/../config/sesion.php';
    if (isset($_SESSION['usuario_id']) && isset($_SESSION['username'])) {
      echo json_encode([
        "success" => true,
        "id" => $_SESSION['usuario_id'],
        "username" => $_SESSION['username']
      ]);
    } else {
      echo json_encode([
        "success" => false,
        "message" => "No hay sesión activa"
      ]);
    }
  }
}
}
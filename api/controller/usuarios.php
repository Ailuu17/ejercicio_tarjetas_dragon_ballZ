<?php 
require_once '../model/Usuario.php';
class usuarios{

private $userModel;

 public function __construct() {
        $this->userModel = new usuario();
    }
    
   public function login($username, $password) {
        // Validate input
        if (empty($username) || empty($password)) {
            return json_encode(['success' => false, 'message' => 'Email y contraseña son requeridos']);
        }
        
        // Attempt to login
        $username = $this->usuario->login($username, $password);

        if ($username) {
            // Return success with user data (without password)
            return json_encode(['success' => true, 'message' => 'Login exitoso', 'user' => $user]);
        } else {
            return json_encode(['success' => false, 'message' => 'Credenciales inválidas']);
        }
    }  
}








require_once __DIR__ . "/../model/Usuario.php";

$userModel = new Usuario($pdo);

function login ($username, $password) {
  global $userModel;

  $usuario = $userModel->login($username);
  
  if ($usuario && $usuario[0] && password_verify($password, $usuario[0]['password'])) {
    require_once __DIR__ . "/../config/sesion.php";
    
    $_SESSION['usuario_id'] = $usuario[0]['id'];
    $_SESSION['username'] = $usuario[0]['nombre_completo'];
    
    echo json_encode(["success" => true, "message" => "🚀 ¡Bienvenido al Torneo!"]);
  } else if (isset($usuario[0]['id'])) {
    echo json_encode(["success" => false, "error" => "Contraseña incorrecta"]);
  } else {
    echo json_encode(["success" => false, "error" => "No existe el usuario"]);
  }
}

function logout () {
  global $userModel;
  $userModel->logout();
}

function verificarSesion () {
  global $userModel;
  $userModel->verificarSesion();
}

?>


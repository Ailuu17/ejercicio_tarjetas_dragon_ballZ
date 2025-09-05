<?php 

require_once __DIR__ . '../model/Usuario.php';

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

?>


<?php

require_once __DIR__ . '../conexion.php';

class usuario {
    private $pdo;

    public function __construct(pdo) {
         $this->pdo = connection();
    }

  public function login($username, $password) {
        $sql = "SELECT id, nombre, email, password FROM usuarios WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
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

 
}
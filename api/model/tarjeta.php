<?php

require_once __DIR__ . '../conexion.php';

class Tarjeta {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerTarjetasUsuario($usuario_id) {
        $query = "SELECT t.* FROM tarjetas t INNER JOIN usuarios u ON t.usuario_id = u.id WHERE u.id = :usuario_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>
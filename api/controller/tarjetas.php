<?php
session_start();
require_once __DIR__ . '../model/Tarjeta.php';

function obtenerMisTarjetas() {
    if (!isset($_SESSION['usuario_id'])) {
        http_response_code(401);
        echo json_encode(['message' => 'Unauthorized']);
        return;
    }

    $usuario_id = $_SESSION['usuario_id'];
    $tarjetaModel = new Tarjeta();
    $tarjetas = $tarjetaModel->obtenerTarjetasUsuario($usuario_id);

    echo json_encode($tarjetas);
}

?>
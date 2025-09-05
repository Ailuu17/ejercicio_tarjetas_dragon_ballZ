// filepath: c:\xampp\htdocs\ejercicio_tarjetas_dragon_ballZ\api\controller\tarjetas.php

<?php
session_start();
require_once '../model/Tarjeta.php';

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








require_once __DIR__ . '/../config/sesion.php';
require_once __DIR__ . '/../model/Tarjeta.php';

$tarjetaModel = new Tarjeta($pdo);

function obtenerTodasTarjetas () {
  global $tarjetaModel;
  echo json_encode($tarjetaModel->obtenerTodos());
}

function obtenerMisTarjetas() {
  global $tarjetaModel;

  if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['username'])) {
    echo json_encode([
      "success" => false,
      "hasSession" => false,
      "message" => "🔒 Debes iniciar sesión para ver tus tarjetas"
    ]);
    return;
  }

  $usuario_id = $_SESSION['usuario_id'];
  $tarjetas = $tarjetaModel->obtenerMisTarjetas($usuario_id);

  echo json_encode([
    "success" => true,
    "hasSession" => true,
    "tarjetas" => $tarjetas,
    "usuario" => $_SESSION['username'],
    // "session" => $_SESSION
  ]);
}
?>
<?php
// 🐉 DRAGON BALL Z - Archivo de conexión sencillo a MySQL 🐉
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'dragonballz';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}



try {
  // Creamos una instancia de PDO para la conexión a MySQL
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    
  // Configuramos PDO para que lance excepciones en caso de error
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Si la conexión es exitosa, el código continúa sin problemas
} catch (PDOException $e) {
  // En caso de error, se captura la excepción y se muestra un mensaje
  die("Error en la conexión: " . $e->getMessage()); // Finaliza la ejecución del script mostrando el error
}


?>

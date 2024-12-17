<?php
header('Content-Type: application/json');
require_once "../config/db_connect.php";
require_once "../dao/UbicacionDAO.php";

try {
    // Obtener datos del JSON enviado
    $data = json_decode(file_get_contents("php://input"), true);

    // Validar el campo requerido
    if (!isset($data['nombre'])) {
        echo json_encode(["error" => "El nombre de la ubicación es obligatorio."]);
        exit;
    }

    // Instanciar el DAO y llamar a createUbicacion
    $ubicacionDAO = new UbicacionDAO($pdo);
    $resultado = $ubicacionDAO->createUbicacion($data['nombre']);

    echo json_encode($resultado); // Mensaje de éxito
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}
?>
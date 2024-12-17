<?php
header('Content-Type: application/json');
require_once "../config/db_connect.php";
require_once "../dao/UbicacionDAO.php";

try {
    // Obtener datos del JSON enviado
    $data = json_decode(file_get_contents("php://input"), true);

    // Validar los campos requeridos
    if (!isset($data['id'], $data['nombre'])) {
        echo json_encode(["error" => "El ID y el nombre de la ubicación son obligatorios."]);
        exit;
    }

    // Instanciar el DAO y llamar a updateUbicacion
    $ubicacionDAO = new UbicacionDAO($pdo);
    $resultado = $ubicacionDAO->updateUbicacion($data['id'], $data['nombre']);

    echo json_encode($resultado); // Mensaje de éxito
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}
?>
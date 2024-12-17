<?php
header('Content-Type: application/json');
require_once "../config/db_connect.php";
require_once "../dao/UbicacionDAO.php";

try {
    // Obtener datos del JSON enviado
    $data = json_decode(file_get_contents("php://input"), true);

    // Validar el ID requerido
    if (!isset($data['id'])) {
        echo json_encode(["error" => "El ID de la ubicación es obligatorio."]);
        exit;
    }

    // Instanciar el DAO y llamar a deleteUbicacion
    $ubicacionDAO = new UbicacionDAO($pdo);
    $resultado = $ubicacionDAO->deleteUbicacion($data['id']);

    echo json_encode($resultado); // Mensaje de éxito
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}
?>
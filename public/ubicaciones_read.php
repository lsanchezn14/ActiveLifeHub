<?php
header('Content-Type: application/json');
require_once "../config/db_connect.php";

try {
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($id) {
        // Obtener una ubicación por ID
        $stmt = $pdo->prepare("SELECT ID_Ubicacion, Nombre_Ubicacion FROM Ubicaciones WHERE ID_Ubicacion = ?");
        $stmt->execute([$id]);
        $ubicacion = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($ubicacion) {
            echo json_encode($ubicacion);
        } else {
            echo json_encode(["error" => "Ubicación no encontrada."]);
        }
    } else {
        // Obtener todas las ubicaciones
        $stmt = $pdo->query("SELECT ID_Ubicacion, Nombre_Ubicacion FROM Ubicaciones");
        $ubicaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($ubicaciones);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Error al obtener ubicaciones: " . $e->getMessage()]);
    exit;
}
?>
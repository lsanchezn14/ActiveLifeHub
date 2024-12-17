<?php
header('Content-Type: application/json');
require_once "../config/db_connect.php";

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "DELETE FROM Actividades WHERE ID_Actividad = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        $stmt->execute();

        echo json_encode(["message" => "Actividad eliminada con éxito"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error al eliminar actividad: " . $e->getMessage()]);
    }
}
?>
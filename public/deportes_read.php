<?php
header('Content-Type: application/json');
require_once "../config/db_connect.php";

try {
    // Obtener todos los deportes desde la base de datos
    $sql = "SELECT ID_Deporte, Nombre_Deporte FROM Deportes";
    $stmt = $pdo->query($sql);

    $deportes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los deportes como JSON
    echo json_encode($deportes);
} catch (PDOException $e) {
    echo json_encode(["error" => "Error al cargar deportes: " . $e->getMessage()]);
}
?>
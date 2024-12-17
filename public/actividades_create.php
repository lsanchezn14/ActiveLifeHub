<?php
header('Content-Type: application/json');
require_once "../config/db_connect.php";

try {
    // Obtener y decodificar el JSON enviado desde el fetch
    $data = json_decode(file_get_contents("php://input"), true);

    // Validar que todos los campos estén presentes y no estén vacíos
    if (empty($data['nombre']) || empty($data['deporte']) || empty($data['fecha']) || 
        empty($data['ubicacion']) || empty($data['participantes']) || empty($data['estado'])) {
        echo json_encode(["error" => "Todos los campos son obligatorios y no deben estar vacíos."]);
        exit;
    }

    // Preparar la consulta SQL para insertar la actividad
    $sql = "INSERT INTO Actividades (Nombre_Actividad, Tipo_Deporte, Fecha, Ubicacion, Numero_Participantes, Estado) 
            VALUES (:nombre, :deporte, :fecha, :ubicacion, :participantes, :estado)";
    $stmt = $pdo->prepare($sql);

    // Asignar parámetros
    $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
    $stmt->bindParam(':deporte', $data['deporte'], PDO::PARAM_INT);
    $stmt->bindParam(':fecha', $data['fecha'], PDO::PARAM_STR);
    $stmt->bindParam(':ubicacion', $data['ubicacion'], PDO::PARAM_INT);
    $stmt->bindParam(':participantes', $data['participantes'], PDO::PARAM_INT);
    $stmt->bindParam(':estado', $data['estado'], PDO::PARAM_STR);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(["message" => "Actividad agregada correctamente"]);
    } else {
        echo json_encode(["error" => "Error al agregar la actividad."]);
    }

} catch (PDOException $e) {
    // Captura errores de la base de datos
    echo json_encode(["error" => "Error de base de datos: " . $e->getMessage()]);
} catch (Exception $e) {
    // Captura errores generales
    echo json_encode(["error" => "Error general: " . $e->getMessage()]);
}
?>
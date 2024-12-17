<?php
header('Content-Type: application/json');
require_once "../config/db_connect.php";

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validar que los datos necesarios estén presentes
        if (
            !isset($data['id'], $data['nombre'], $data['deporte'], $data['fecha'], $data['ubicacion'], $data['participantes'], $data['estado'])
        ) {
            echo json_encode(["error" => "Datos incompletos. Todos los campos son requeridos."]);
            exit;
        }

        // Validar que los datos no estén vacíos
        if (
            empty($data['id']) || 
            empty($data['nombre']) || 
            empty($data['deporte']) || 
            empty($data['fecha']) || 
            empty($data['ubicacion']) || 
            empty($data['participantes']) || 
            empty($data['estado'])
        ) {
            echo json_encode(["error" => "Ningún campo puede estar vacío."]);
            exit;
        }

        // Validar formato de fecha
        $fechaValida = DateTime::createFromFormat('Y-m-d', $data['fecha']);
        if (!$fechaValida) {
            echo json_encode(["error" => "Formato de fecha inválido. Use YYYY-MM-DD."]);
            exit; 
        }

        // Validar tipos de datos
        if (!is_numeric($data['id']) || !is_numeric($data['deporte']) || !is_numeric($data['participantes'])) {
            echo json_encode(["error" => "El ID, Deporte y Participantes deben ser valores numéricos."]);
            exit;
        }

        // Query para actualizar la actividad
        $sql = "UPDATE Actividades SET 
                    Nombre_Actividad = :nombre, 
                    Tipo_Deporte = :deporte, 
                    Fecha = :fecha, 
                    Ubicacion = :ubicacion, 
                    Numero_Participantes = :participantes, 
                    Estado = :estado
                WHERE ID_Actividad = :id";

        $stmt = $pdo->prepare($sql);

        // Asignar parámetros con tipos explícitos
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':deporte', $data['deporte'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $data['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(':ubicacion', $data['ubicacion'], PDO::PARAM_STR);
        $stmt->bindParam(':participantes', $data['participantes'], PDO::PARAM_INT);
        $stmt->bindParam(':estado', $data['estado'], PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();

        // Comprobar si se actualizó alguna fila
        if ($stmt->rowCount() > 0) {
            echo json_encode(["message" => "Actividad actualizada con éxito"]);
        } else {
            echo json_encode(["message" => "No se realizó ninguna actualización. El ID no existe o los datos son iguales."]);
        }

    } catch (PDOException $e) {
        echo json_encode(["error" => "Error al actualizar actividad: " . $e->getMessage()]);
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Método no permitido. Use POST."]);
}
?>
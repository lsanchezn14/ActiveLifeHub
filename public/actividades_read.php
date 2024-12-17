<?php
require_once "../config/db_connect.php";

header("Content-Type: application/json");

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

try {
    // Verificar si la conexión a la base de datos existe
    if (!$pdo) {
        throw new Exception("No se pudo conectar a la base de datos.");
    }

    if ($id) {
        // Devuelve una actividad por ID con la relación de ubicación y deporte
        $stmt = $pdo->prepare("
            SELECT A.ID_Actividad, A.Nombre_Actividad, D.Nombre_Deporte AS Tipo_Deporte, 
                   U.Nombre_Ubicacion AS Ubicacion, A.Fecha, A.Numero_Participantes, A.Estado
            FROM Actividades A
            LEFT JOIN Ubicaciones U ON A.Ubicacion = U.ID_Ubicacion
            LEFT JOIN Deportes D ON A.Tipo_Deporte = D.ID_Deporte
            WHERE A.ID_Actividad = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $actividad = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$actividad) {
            // Si no existe la actividad, devolver un mensaje
            echo json_encode(["error" => "No se encontró la actividad con ID $id."]);
            exit;
        }

        // Devuelve un único objeto (actividad)
        echo json_encode($actividad);
    } else {
        // Devuelve todas las actividades con la relación de ubicación y deporte
        $stmt = $pdo->query("
            SELECT A.ID_Actividad, A.Nombre_Actividad, D.Nombre_Deporte AS Tipo_Deporte, 
                   U.Nombre_Ubicacion AS Ubicacion, A.Fecha, A.Numero_Participantes, A.Estado
            FROM Actividades A
            LEFT JOIN Ubicaciones U ON A.Ubicacion = U.ID_Ubicacion
            LEFT JOIN Deportes D ON A.Tipo_Deporte = D.ID_Deporte
        ");

        $actividades = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($actividades)) {
            // Si no hay actividades, devuelve un mensaje
            echo json_encode(["message" => "No se encontraron actividades."]);
        } else {
            // Devuelve un arreglo con todas las actividades
            echo json_encode($actividades);
        }
    }
} catch (PDOException $e) {
    // Captura errores de la base de datos
    echo json_encode(["error" => "Error de base de datos: " . $e->getMessage()]);
} catch (Exception $e) {
    // Captura errores generales
    echo json_encode(["error" => $e->getMessage()]);
}
?>
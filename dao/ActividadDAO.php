<?php
class ActividadDAO {
    private $pdo;

    // Constructor con conexión a la base de datos
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // 1. Listar todas las actividades (Read)
    public function readActividades() {
        try {
            $sql = "SELECT * FROM Actividades";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener actividades: " . $e->getMessage());
        }
    }

    // 2. Insertar una nueva actividad (Create)
    public function createActividad($nombre, $tipoDeporte, $ubicacion, $fecha, $dificultad, $participantes, $creador, $estado) {
        try {
            if ($this->validarParametrosCreate($nombre, $tipoDeporte, $ubicacion, $fecha, $dificultad, $participantes, $creador, $estado)) {
                $sql = "INSERT INTO Actividades 
                        (Nombre_Actividad, Tipo_Deporte, Ubicacion, Fecha, Nivel_Dificultad, Numero_Participantes, Creador, Estado) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$nombre, $tipoDeporte, $ubicacion, $fecha, $dificultad, $participantes, $creador, $estado]);
                return ["message" => "Actividad agregada correctamente"];
            }
        } catch (PDOException $e) {
            throw new Exception("Error al insertar actividad: " . $e->getMessage());
        }
    }

    // 3. Actualizar una actividad existente (Update)
    public function updateActividad($id, $nombre, $tipoDeporte, $ubicacion, $fecha, $dificultad, $participantes, $estado) {
        try {
            if ($this->validarParametrosUpdate($id, $nombre, $tipoDeporte, $ubicacion, $fecha, $dificultad, $participantes, $estado)) {
                $sql = "UPDATE Actividades SET 
                        Nombre_Actividad = ?, Tipo_Deporte = ?, Ubicacion = ?, Fecha = ?, 
                        Nivel_Dificultad = ?, Numero_Participantes = ?, Estado = ? 
                        WHERE ID_Actividad = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$nombre, $tipoDeporte, $ubicacion, $fecha, $dificultad, $participantes, $estado, $id]);
                return ["message" => "Actividad actualizada correctamente"];
            }
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar actividad: " . $e->getMessage());
        }
    }

    // 4. Eliminar una actividad (Delete)
    public function deleteActividad($id) {
        try {
            if (empty($id)) {
                throw new Exception("El ID de la actividad es obligatorio.");
            }

            $sql = "DELETE FROM Actividades WHERE ID_Actividad = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return ["message" => "Actividad eliminada correctamente"];
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar actividad: " . $e->getMessage());
        }
    }

    // Validación de parámetros para CREATE
    private function validarParametrosCreate($nombre, $tipoDeporte, $ubicacion, $fecha, $dificultad, $participantes, $creador, $estado) {
        if (empty($nombre) || empty($tipoDeporte) || empty($ubicacion) || empty($fecha) || 
            empty($dificultad) || empty($participantes) || empty($creador) || empty($estado)) {
            throw new Exception("Todos los campos son obligatorios para crear la actividad.");
        }
        return true;
    }

    // Validación de parámetros para UPDATE
    private function validarParametrosUpdate($id, $nombre, $tipoDeporte, $ubicacion, $fecha, $dificultad, $participantes, $estado) {
        if (empty($id) || empty($nombre) || empty($tipoDeporte) || empty($ubicacion) || 
            empty($fecha) || empty($dificultad) || empty($participantes) || empty($estado)) {
            throw new Exception("Todos los campos son obligatorios para actualizar la actividad.");
        }
        return true;
    }
}
?>
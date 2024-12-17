<?php
class UbicacionDAO {
    private $pdo;

    // Constructor con conexión a la base de datos
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // 1. Listar todas las ubicaciones (Read)
    public function readUbicaciones() {
        try {
            $sql = "SELECT * FROM Ubicaciones";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener las ubicaciones: " . $e->getMessage());
        }
    }

    // 2. Insertar una nueva ubicación (Create)
    public function createUbicacion($nombreUbicacion) {
        try {
            if ($this->validarParametroCreate($nombreUbicacion)) {
                $sql = "INSERT INTO Ubicaciones (Nombre_Ubicacion) VALUES (?)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$nombreUbicacion]);
                return ["message" => "Ubicación agregada correctamente"];
            }
        } catch (PDOException $e) {
            throw new Exception("Error al insertar la ubicación: " . $e->getMessage());
        }
    }

    // 3. Actualizar una ubicación existente (Update)
    public function updateUbicacion($id, $nombreUbicacion) {
        try {
            if ($this->validarParametroUpdate($id, $nombreUbicacion)) {
                $sql = "UPDATE Ubicaciones SET Nombre_Ubicacion = ? WHERE ID_Ubicacion = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$nombreUbicacion, $id]);
                return ["message" => "Ubicación actualizada correctamente"];
            }
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar la ubicación: " . $e->getMessage());
        }
    }

    // 4. Eliminar una ubicación (Delete)
    public function deleteUbicacion($id) {
        try {
            if (empty($id)) {
                throw new Exception("El ID de la ubicación es obligatorio.");
            }

            $sql = "DELETE FROM Ubicaciones WHERE ID_Ubicacion = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return ["message" => "Ubicación eliminada correctamente"];
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar la ubicación: " . $e->getMessage());
        }
    }

    // Validación de parámetros para CREATE
    private function validarParametroCreate($nombreUbicacion) {
        if (empty($nombreUbicacion)) {
            throw new Exception("El nombre de la ubicación es obligatorio.");
        }
        return true;
    }

    // Validación de parámetros para UPDATE
    private function validarParametroUpdate($id, $nombreUbicacion) {
        if (empty($id) || empty($nombreUbicacion)) {
            throw new Exception("El ID y el nombre de la ubicación son obligatorios.");
        }
        return true;
    }
}
?>
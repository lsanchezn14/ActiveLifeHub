<?php
require_once 'UsuarioDAO.php';
require_once '../entities/Usuario.php';

class UsuarioDAOImpl implements UsuarioDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->prepare("CALL GetAllUsers()");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $usuarios = [];
        foreach ($result as $row) {
            $usuarios[] = new Usuario(
                $row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['phone']
            );
        }

        return $usuarios;
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("CALL GetUserById(:id)");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Usuario(
                $row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['phone']
            );
        }

        return null;
    }

    public function crearUsuario($nombre, $apellido, $email, $telefono, $password) {
        $stmt = $this->pdo->prepare("CALL InsertUser(:nombre, :apellido, :email, :telefono, :password)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':password', $password); 
        return $stmt->execute();
    }

    public function actualizarUsuario($id, $nombre, $apellido, $email, $telefono) {
        $stmt = $this->pdo->prepare("CALL UpdateUser(:id, :nombre, :apellido, :email, :telefono)");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        return $stmt->execute();
    }

    public function eliminarUsuario($id) {
        $stmt = $this->pdo->prepare("CALL DeleteUser(:id)");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}


?>
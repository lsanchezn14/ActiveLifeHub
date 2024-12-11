<?php
//nO USAR//nO USAR
require_once "../config/db_connect.php";
require_once 'UsuarioDAOImpl.php';

$usuarioDao = new UsuarioDAOImpl($pdo);

// Crear un nuevo usuario
$hashedPassword = password_hash('mypassword', PASSWORD_BCRYPT);
$usuarioDao->crearUsuario('John', 'Doe', 'john.doe@example.com', '1234567890', $hashedPassword);

// Obtener todos los usuarios
$usuarios = $usuarioDao->obtenerTodos();
foreach ($usuarios as $usuario) {
    echo $usuario->id . ": " . $usuario->nombre . " " . $usuario->apellido . " - " . $usuario->email . "<br>";
}

// Obtener un usuario por ID
$usuario = $usuarioDao->obtenerPorId(1);
if ($usuario) {
    echo "Usuario encontrado: " . $usuario->nombre . " " . $usuario->apellido . "<br>";
} else {
    echo "Usuario no encontrado.<br>";
}

// Actualizar un usuario
$usuarioDao->actualizarUsuario(1, 'Jane', 'Smith', 'jane.smith@example.com', '0987654321');

// Eliminar un usuario
$usuarioDao->eliminarUsuario(1);
?>


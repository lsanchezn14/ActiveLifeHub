<?php
require_once '../config/db_connect.php';
require_once '../dao/UsuarioDAOImpl.php';

// Inicializar el DAO
$usuarioDao = new UsuarioDAOImpl($pdo);


// Obtener la lista de usuarios para mostrar en la tabla
$usuarios = $usuarioDao->obtenerTodos();

include '../templates/header.php';
?>

<h1>Administración de Usuarios</h1>

<!-- Formulario para agregar un nuevo usuario -->
<h2>Crear Nuevo Usuario</h2>
<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <label>Apellido:</label>
    <input type="text" name="apellido" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Teléfono:</label>
    <input type="text" name="telefono" required>
    <button type="submit" name="create">Agregar Usuario</button>
</form>

<!-- Tabla de usuarios existentes -->
<h2>Lista de Usuarios</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= $usuario->id ?></td>
            <td><?= $usuario->nombre ?></td>
            <td><?= $usuario->apellido ?></td>
            <td><?= $usuario->email ?></td>
            <td><?= $usuario->telefono ?></td>
            <td>
                <!-- Formulario para editar un usuario -->
                <form method="POST" style="display: inline-block;">
                    <input type="hidden" name="id" value="<?= $usuario->id ?>">
                    <input type="text" name="nombre" value="<?= $usuario->nombre ?>" required>
                    <input type="text" name="apellido" value="<?= $usuario->apellido ?>" required>
                    <input type="email" name="email" value="<?= $usuario->email ?>" required>
                    <input type="text" name="telefono" value="<?= $usuario->telefono ?>" required>
                    <button type="submit" name="update">Actualizar</button>
                </form>

                <!-- Formulario para eliminar un usuario -->
                <form method="POST" style="display: inline-block;">
                    <input type="hidden" name="id" value="<?= $usuario->id ?>">
                    <button type="submit" name="delete" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include '../templates/footer.php'; ?>

<?php
// Conexión a la base de datos
include('conexion.php');

// Agregar nuevo historial
if (isset($_POST['agregar_historial'])) {
    $id_actividad = $_POST['id_actividad'];
    $id_usuario = $_POST['id_usuario'];
    $estado_participacion = $_POST['estado_participacion'];

    $query_insert = "INSERT INTO Historial_Actividades (ID_Actividad, ID_Usuario, Estado_Participacion) 
                     VALUES ('$id_actividad', '$id_usuario', '$estado_participacion')";
    mysqli_query($conexion, $query_insert);
}

// Editar historial existente
if (isset($_POST['editar_historial'])) {
    $id_historial = $_POST['id_historial'];
    $id_actividad = $_POST['id_actividad'];
    $id_usuario = $_POST['id_usuario'];
    $estado_participacion = $_POST['estado_participacion'];

    $query_update = "UPDATE Historial_Actividades 
                     SET ID_Actividad = '$id_actividad', ID_Usuario = '$id_usuario', Estado_Participacion = '$estado_participacion' 
                     WHERE ID_Historial = '$id_historial'";
    mysqli_query($conexion, $query_update);
}

// Eliminar historial
if (isset($_GET['eliminar'])) {
    $id_historial = $_GET['eliminar'];
    $query_delete = "DELETE FROM Historial_Actividades WHERE ID_Historial = '$id_historial'";
    mysqli_query($conexion, $query_delete);
}

// Obtener todos los historiales
$query = "SELECT * FROM Historial_Actividades 
          JOIN Categorias_Actividades ON Historial_Actividades.ID_Actividad = Categorias_Actividades.ID_Categoria
          JOIN Usuarios ON Historial_Actividades.ID_Usuario = Usuarios.ID_Usuario";
$result = mysqli_query($conexion, $query);
?>

<?php mysqli_close($conexion); ?>
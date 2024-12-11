<?php
include('conexion.php');

// Agregar categoría
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_categoria'])) {
    $nombre_categoria = $_POST['nombre_categoria'];
    $descripcion = $_POST['descripcion'];
    $query = "INSERT INTO Categorias_Actividades (Nombre_Categoria, Descripcion) VALUES ('$nombre_categoria', '$descripcion')";
    if (mysqli_query($conexion, $query)) {
        echo "<script>alert('Categoría agregada exitosamente');</script>";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}

// Editar categoría
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_categoria'])) {
    $id_categoria = $_POST['id_categoria'];
    $nombre_categoria = $_POST['nombre_categoria'];
    $descripcion = $_POST['descripcion'];
    $query = "UPDATE Categorias_Actividades SET Nombre_Categoria='$nombre_categoria', Descripcion='$descripcion' WHERE ID_Categoria='$id_categoria'";
    if (mysqli_query($conexion, $query)) {
        echo "<script>alert('Categoría actualizada exitosamente');</script>";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}

// Eliminar categoría
if (isset($_GET['eliminar'])) {
    $id_categoria = $_GET['eliminar'];
    $query = "DELETE FROM Categorias_Actividades WHERE ID_Categoria='$id_categoria'";
    if (mysqli_query($conexion, $query)) {
        echo "<script>alert('Categoría eliminada exitosamente');</script>";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}

// Obtener las categorías existentes
$query = "SELECT * FROM Categorias_Actividades";
$result = mysqli_query($conexion, $query);
?>

<?php mysqli_close($conexion); ?>
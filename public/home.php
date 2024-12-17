<?php
session_start();

$isLoggedIn = isset($_SESSION['email']);
$isAdmin = $isLoggedIn && $_SESSION['role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary w-100">
        <div class="container-fluid">
            <img src="../assets/images/logo.png" alt="Welcome Image" class="logo-image">
            <a class="navbar-brand" href="home.php">Active Life Hub</a>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end topnav">
                <a class="nav-link" href="lista_actividades.html">
                    <button type="button" class="btn btn-info" href="#">Actividades</button>
                </a>
                <a class="nav-link" href="lista_ubicaciones.html">
                    <button type="button" class="btn btn-info" href="#">Ubicaciones</button>
                </a>
                <a class="nav-link" href="categoria.html">
                    <button type="button" class="btn btn-info" href="#">Categorias</button>
                </a>
                <a class="nav-link" href="historial_actividades.html">
                    <button type="button" class="btn btn-info" href="#">Historial</button>
                </a>
                <a class="nav-link" href="insertUser.html">
                    <button type="button" class="btn btn-info" href="#">Usuario</button>
                </a>
                <input type="text" placeholder="Buscar...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if ($isAdmin): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Administrativo
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <?php if ($isLoggedIn): ?>
                    <li class="nav-item">
                        <button type="button" class="btn btn-danger">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </button>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <button type="button" class="btn btn-success">
                            <a class="nav-link" href="login.html">Login</a>
                        </button>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="intro-container">
            <h1>¡Bienvenid@ a nuestra plataforma de deportes en grupo!</h1>
            <p>En un mundo donde la actividad física es fundamental para una vida saludable, entendemos que compartir estas experiencias con otros puede hacer la diferencia.</p>
            <p>Nuestra misión es facilitar la conexión entre personas que buscan unirse a actividades deportivas en su comunidad, promoviendo no solo el bienestar físico, sino también el fortalecimiento de lazos sociales.</p>
            <p>Aquí podrás encontrar, unirte y organizar eventos deportivos de manera rápida y sencilla, creando un espacio donde la motivación y la diversión se unen. ¡Únete a nosotros y descubre cómo el deporte puede transformar tu vida y tu comunidad!</p>
        </div>
        <img src="../assets/images/index.jpg" alt="Welcome Image" class="intro-image">
    </main>
    <?php include '../includes/footer.html'; ?>
</body>

</html>
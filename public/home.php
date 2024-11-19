<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h1>
    <a href="logout.php">Logout</a>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary w-100">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Active Life Hub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Actividades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Buscar">Buscar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Salir">Salir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</body>
</html>

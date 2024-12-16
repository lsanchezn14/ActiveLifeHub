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
</head>

<body>
    <h1>Welcome</h1>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Active Life Hub</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Actividades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Buscar">Buscar</a>
                    </li>
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
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">Login</a>
                    </li>
                <?php endif; ?>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <p>Your gateway to seamless and secure access. Manage your account, explore features, and much more!</p>
        <img src="../assets/images/intro.jpg" alt="Welcome Image" class="intro-image">
    </main>
    <?php include '../includes/footer.html'; ?>
</body>

</html>
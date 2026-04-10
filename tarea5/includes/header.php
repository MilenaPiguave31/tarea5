<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/pwtarea5/assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/pwtarea5/index.php">Biblioteca Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><span class="nav-link text-white">Hola, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                    <li class="nav-item"><a class="btn btn-light btn-sm" href="/pwtarea5/auth/logout.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="btn btn-light btn-sm" href="/pwtarea5/auth/login.php">Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container py-4">

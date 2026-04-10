<?php include('includes/header.php'); ?>
<div class="hero mb-4 shadow-sm">
    <h1 class="display-5 fw-bold">Sistema de Biblioteca Online</h1>
    <p class="lead mb-3">Proyecto desarrollado con HTML, Bootstrap 5, CSS, JavaScript, PHP y MySQL.</p>
    <a href="auth/login.php" class="btn btn-light btn-lg">Ingresar al sistema</a>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-sm h-100"><div class="card-body"><h4>Administrador</h4><p>Gestiona usuarios, roles y visualiza todas las transacciones.</p></div></div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100"><div class="card-body"><h4>Bibliotecario</h4><p>Administra libros del catálogo y procesa préstamos y devoluciones.</p></div></div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100"><div class="card-body"><h4>Lector</h4><p>Explora libros, solicita préstamos y devuelve ejemplares prestados.</p></div></div>
    </div>
</div>
<?php include('includes/footer.php'); ?>

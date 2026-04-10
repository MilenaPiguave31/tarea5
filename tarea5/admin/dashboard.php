<?php
include('../includes/auth.php');
requireRole('Administrador');
include('../config/db.php');
include('../includes/header.php');

$totalUsers = $conn->query('SELECT COUNT(*) AS total FROM users')->fetch_assoc()['total'];
$totalBooks = $conn->query('SELECT COUNT(*) AS total FROM books')->fetch_assoc()['total'];
$totalTransactions = $conn->query('SELECT COUNT(*) AS total FROM transactions')->fetch_assoc()['total'];
?>
<h2 class="mb-4">Panel de Administrador</h2>
<div class="row g-4 mb-4">
    <div class="col-md-4"><div class="card shadow-sm"><div class="card-body"><h5>Usuarios</h5><p class="display-6"><?php echo $totalUsers; ?></p></div></div></div>
    <div class="col-md-4"><div class="card shadow-sm"><div class="card-body"><h5>Libros</h5><p class="display-6"><?php echo $totalBooks; ?></p></div></div></div>
    <div class="col-md-4"><div class="card shadow-sm"><div class="card-body"><h5>Transacciones</h5><p class="display-6"><?php echo $totalTransactions; ?></p></div></div></div>
</div>
<div class="d-flex gap-2 mb-4">
    <a href="users.php" class="btn btn-primary">Gestionar usuarios</a>
    <a href="transactions.php" class="btn btn-outline-primary">Ver transacciones</a>
</div>
<?php include('../includes/footer.php'); ?>

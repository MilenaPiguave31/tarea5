<?php
include('../includes/auth.php');
requireRole('Bibliotecario');
include('../config/db.php');
include('../includes/header.php');
$totalBooks = $conn->query('SELECT COUNT(*) AS total FROM books')->fetch_assoc()['total'];
$borrowed = $conn->query("SELECT COUNT(*) AS total FROM transactions WHERE status='Prestado'")->fetch_assoc()['total'];
?>
<h2 class="mb-4">Panel de Bibliotecario</h2>
<div class="row g-4 mb-4">
    <div class="col-md-6"><div class="card shadow-sm"><div class="card-body"><h5>Libros registrados</h5><p class="display-6"><?php echo $totalBooks; ?></p></div></div></div>
    <div class="col-md-6"><div class="card shadow-sm"><div class="card-body"><h5>Préstamos activos</h5><p class="display-6"><?php echo $borrowed; ?></p></div></div></div>
</div>
<div class="d-flex gap-2 mb-4">
    <a href="books.php" class="btn btn-primary">Gestionar libros</a>
    <a href="transactions.php" class="btn btn-outline-primary">Gestionar préstamos</a>
</div>
<?php include('../includes/footer.php'); ?>

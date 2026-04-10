<?php
include('../includes/auth.php');
requireRole('Lector');
include('../config/db.php');
include('../includes/header.php');
$user_id = $_SESSION['user_id'];
$myLoans = $conn->query("SELECT COUNT(*) AS total FROM transactions WHERE user_id = $user_id AND status='Prestado'")->fetch_assoc()['total'];
$totalBooks = $conn->query('SELECT COUNT(*) AS total FROM books')->fetch_assoc()['total'];
?>
<h2 class="mb-4">Panel de Lector</h2>
<div class="row g-4 mb-4">
    <div class="col-md-6"><div class="card shadow-sm"><div class="card-body"><h5>Libros disponibles en catálogo</h5><p class="display-6"><?php echo $totalBooks; ?></p></div></div></div>
    <div class="col-md-6"><div class="card shadow-sm"><div class="card-body"><h5>Mis préstamos activos</h5><p class="display-6"><?php echo $myLoans; ?></p></div></div></div>
</div>
<div class="d-flex gap-2 mb-4">
    <a href="catalog.php" class="btn btn-primary">Ver catálogo</a>
    <a href="my_books.php" class="btn btn-outline-primary">Mis libros</a>
</div>
<?php include('../includes/footer.php'); ?>

<?php
include('../includes/auth.php');
requireRole('Administrador');
include('../config/db.php');
$transactions = $conn->query("SELECT transactions.*, users.username, books.title FROM transactions INNER JOIN users ON transactions.user_id = users.id INNER JOIN books ON transactions.book_id = books.id ORDER BY transactions.id DESC");
include('../includes/header.php');
?>
<h2 class="mb-4">Transacciones del sistema</h2>
<div class="card shadow-sm"><div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead><tr><th>ID</th><th>Usuario</th><th>Libro</th><th>Fecha préstamo</th><th>Fecha devolución</th><th>Estado</th></tr></thead>
            <tbody>
            <?php while($row = $transactions->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo $row['date_of_issue']; ?></td>
                    <td><?php echo $row['date_of_return'] ?: 'Pendiente'; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div></div>
<?php include('../includes/footer.php'); ?>

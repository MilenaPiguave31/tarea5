<?php
include('../includes/auth.php');
requireRole('Bibliotecario');
include('../config/db.php');

if (isset($_GET['return'])) {
    $transaction_id = (int)$_GET['return'];
    $stmt = $conn->prepare('SELECT book_id FROM transactions WHERE id = ? AND status = "Prestado"');
    $stmt->bind_param('i', $transaction_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $book_id = $row['book_id'];
        $date = date('Y-m-d');
        $stmt1 = $conn->prepare('UPDATE transactions SET date_of_return = ?, status = "Devuelto" WHERE id = ?');
        $stmt1->bind_param('si', $date, $transaction_id);
        $stmt1->execute();
        $stmt2 = $conn->prepare('UPDATE books SET quantity = quantity + 1 WHERE id = ?');
        $stmt2->bind_param('i', $book_id);
        $stmt2->execute();
    }
    header('Location: transactions.php');
    exit();
}

$transactions = $conn->query("SELECT transactions.*, users.username, books.title FROM transactions INNER JOIN users ON transactions.user_id = users.id INNER JOIN books ON transactions.book_id = books.id ORDER BY transactions.id DESC");
include('../includes/header.php');
?>
<h2 class="mb-4">Gestión de Préstamos y Devoluciones</h2>
<div class="card shadow-sm"><div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead><tr><th>ID</th><th>Usuario</th><th>Libro</th><th>Préstamo</th><th>Devolución</th><th>Estado</th><th>Acción</th></tr></thead>
            <tbody>
            <?php while($row = $transactions->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo $row['date_of_issue']; ?></td>
                    <td><?php echo $row['date_of_return'] ?: 'Pendiente'; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <?php if ($row['status'] === 'Prestado'): ?>
                            <a href="?return=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Registrar devolución</a>
                        <?php else: ?>
                            <span class="text-muted">Completado</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div></div>
<?php include('../includes/footer.php'); ?>

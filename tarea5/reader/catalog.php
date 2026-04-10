<?php
include('../includes/auth.php');
requireRole('Lector');
include('../config/db.php');
$user_id = $_SESSION['user_id'];

if (isset($_GET['borrow'])) {
    $book_id = (int)$_GET['borrow'];
    $stmt = $conn->prepare('SELECT quantity FROM books WHERE id = ?');
    $stmt->bind_param('i', $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($book = $result->fetch_assoc()) {
        if ($book['quantity'] > 0) {
            $date = date('Y-m-d');
            $stmt1 = $conn->prepare('INSERT INTO transactions (user_id, book_id, date_of_issue, status) VALUES (?, ?, ?, "Prestado")');
            $stmt1->bind_param('iis', $user_id, $book_id, $date);
            $stmt1->execute();
            $stmt2 = $conn->prepare('UPDATE books SET quantity = quantity - 1 WHERE id = ?');
            $stmt2->bind_param('i', $book_id);
            $stmt2->execute();
        }
    }
    header('Location: catalog.php');
    exit();
}

$books = $conn->query('SELECT * FROM books ORDER BY id DESC');
include('../includes/header.php');
?>
<h2 class="mb-4">Catálogo de libros</h2>
<div class="card shadow-sm"><div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead><tr><th>ID</th><th>Título</th><th>Autor</th><th>Año</th><th>Género</th><th>Disponibles</th><th>Acción</th></tr></thead>
            <tbody>
            <?php while($book = $books->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $book['id']; ?></td>
                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                    <td><?php echo htmlspecialchars($book['author']); ?></td>
                    <td><?php echo $book['year']; ?></td>
                    <td><?php echo htmlspecialchars($book['genre']); ?></td>
                    <td><?php echo $book['quantity']; ?></td>
                    <td>
                        <?php if ($book['quantity'] > 0): ?>
                            <a href="?borrow=<?php echo $book['id']; ?>" class="btn btn-primary btn-sm">Solicitar</a>
                        <?php else: ?>
                            <span class="text-danger">No disponible</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div></div>
<?php include('../includes/footer.php'); ?>

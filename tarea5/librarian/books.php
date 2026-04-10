<?php
include('../includes/auth.php');
requireRole('Bibliotecario');
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $year = (int)$_POST['year'];
    $genre = trim($_POST['genre']);
    $quantity = (int)$_POST['quantity'];
    $stmt = $conn->prepare('INSERT INTO books (title, author, year, genre, quantity) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('ssisi', $title, $author, $year, $genre, $quantity);
    $stmt->execute();
    header('Location: books.php');
    exit();
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare('DELETE FROM books WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    header('Location: books.php');
    exit();
}

$books = $conn->query('SELECT * FROM books ORDER BY id DESC');
include('../includes/header.php');
?>
<h2 class="mb-4">Gestión de Libros</h2>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-sm"><div class="card-body">
            <h4 class="mb-3">Nuevo libro</h4>
            <form method="POST" onsubmit="return validarCantidad();">
                <div class="mb-3"><label class="form-label">Título</label><input type="text" name="title" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Autor</label><input type="text" name="author" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Año</label><input type="number" name="year" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Género</label><input type="text" name="genre" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Cantidad</label><input type="number" id="quantity" name="quantity" class="form-control" required></div>
                <button type="submit" class="btn btn-primary w-100">Guardar libro</button>
            </form>
        </div></div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm"><div class="card-body">
            <h4 class="mb-3">Catálogo</h4>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead><tr><th>ID</th><th>Título</th><th>Autor</th><th>Año</th><th>Género</th><th>Cantidad</th><th>Acción</th></tr></thead>
                    <tbody>
                    <?php while($book = $books->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $book['id']; ?></td>
                            <td><?php echo htmlspecialchars($book['title']); ?></td>
                            <td><?php echo htmlspecialchars($book['author']); ?></td>
                            <td><?php echo $book['year']; ?></td>
                            <td><?php echo htmlspecialchars($book['genre']); ?></td>
                            <td><?php echo $book['quantity']; ?></td>
                            <td><a href="?delete=<?php echo $book['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar libro?')">Eliminar</a></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div></div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>

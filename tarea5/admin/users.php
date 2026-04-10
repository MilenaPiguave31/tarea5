<?php
include('../includes/auth.php');
requireRole('Administrador');
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = (int)$_POST['role_id'];
    $stmt = $conn->prepare('INSERT INTO users (username, email, password, role_id) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('sssi', $username, $email, $password, $role_id);
    $stmt->execute();
    header('Location: users.php');
    exit();
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare('DELETE FROM users WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    header('Location: users.php');
    exit();
}

$roles = $conn->query('SELECT * FROM roles');
$users = $conn->query('SELECT users.id, users.username, users.email, roles.name AS role_name FROM users INNER JOIN roles ON users.role_id = roles.id ORDER BY users.id DESC');
include('../includes/header.php');
?>
<h2 class="mb-4">Gestión de Usuarios</h2>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-sm"><div class="card-body">
            <h4 class="mb-3">Nuevo usuario</h4>
            <form method="POST">
                <div class="mb-3"><label class="form-label">Nombre</label><input type="text" name="username" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Correo</label><input type="email" name="email" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Contraseña</label><input type="password" name="password" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Rol</label><select name="role_id" class="form-select" required><?php while($role = $roles->fetch_assoc()): ?><option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option><?php endwhile; ?></select></div>
                <button type="submit" class="btn btn-primary w-100">Guardar usuario</button>
            </form>
        </div></div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm"><div class="card-body">
            <h4 class="mb-3">Listado de usuarios</h4>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Rol</th><th>Acción</th></tr></thead>
                    <tbody>
                    <?php while($user = $users->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><span class="badge bg-primary badge-role"><?php echo $user['role_name']; ?></span></td>
                            <td><a href="?delete=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar usuario?')">Eliminar</a></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div></div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>

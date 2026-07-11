<?php
/**
 * Admin — Manage Learning Modules (CRUD).
 */
$pageTitle = 'Manage Modules';
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();

$db = getDB();
$message = '';
$error = '';

// Handle delete
if (isset($_GET['delete'])) {
    $id = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
    if ($id) {
        $stmt = $db->prepare('DELETE FROM modules WHERE module_id = ?');
        $stmt->execute([$id]);
        $message = 'Module deleted successfully.';
    }
}

// Handle add/edit form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'module_id', FILTER_VALIDATE_INT);
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $example = trim($_POST['example_text'] ?? '');
    $takeaway = trim($_POST['key_takeaway'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $icon = trim($_POST['icon'] ?? 'shield');

    if (empty($title) || empty($content) || empty($category)) {
        $error = 'Title, content, and category are required.';
    } else {
        if ($id) {
            $stmt = $db->prepare(
                'UPDATE modules SET title=?, content=?, example_text=?, key_takeaway=?, category=?, icon=? WHERE module_id=?'
            );
            $stmt->execute([$title, $content, $example, $takeaway, $category, $icon, $id]);
            $message = 'Module updated successfully.';
        } else {
            $stmt = $db->prepare(
                'INSERT INTO modules (title, content, example_text, key_takeaway, category, icon) VALUES (?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([$title, $content, $example, $takeaway, $category, $icon]);
            $message = 'Module created successfully.';
        }
    }
}

// Fetch module for editing
$editModule = null;
if (isset($_GET['edit'])) {
    $editId = filter_input(INPUT_GET, 'edit', FILTER_VALIDATE_INT);
    if ($editId) {
        $stmt = $db->prepare('SELECT * FROM modules WHERE module_id = ?');
        $stmt->execute([$editId]);
        $editModule = $stmt->fetch();
    }
}

$modules = $db->query('SELECT module_id, title, category FROM modules ORDER BY module_id')->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container"><h1>Manage Modules</h1></div>
</div>

<section class="section">
    <div class="container">
        <div class="admin-layout">
            <?php include __DIR__ . '/sidebar.php'; ?>
            <div class="admin-content">
                <?php if ($message): ?><div class="alert alert-success"><?= e($message) ?></div><?php endif; ?>
                <?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>

                <div class="card mb-3">
                    <h3><?= $editModule ? 'Edit Module' : 'Add New Module' ?></h3>
                    <form method="POST">
                        <?php if ($editModule): ?>
                            <input type="hidden" name="module_id" value="<?= $editModule['module_id'] ?>">
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" required value="<?= e($editModule['title'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" id="category" name="category" required value="<?= e($editModule['category'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon Key (shield, lock, envelope, bug, wifi, globe, mobile, users)</label>
                            <input type="text" id="icon" name="icon" value="<?= e($editModule['icon'] ?? 'shield') ?>">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea id="content" name="content" required rows="8"><?= e($editModule['content'] ?? '') ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="example_text">Real-World Example</label>
                            <textarea id="example_text" name="example_text" rows="3"><?= e($editModule['example_text'] ?? '') ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="key_takeaway">Key Takeaway</label>
                            <textarea id="key_takeaway" name="key_takeaway" rows="2"><?= e($editModule['key_takeaway'] ?? '') ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><?= $editModule ? 'Update' : 'Create' ?> Module</button>
                        <?php if ($editModule): ?>
                            <a href="<?= baseUrl('admin/modules.php') ?>" class="btn btn-outline">Cancel</a>
                        <?php endif; ?>
                    </form>
                </div>

                <table class="admin-table">
                    <thead><tr><th>ID</th><th>Title</th><th>Category</th><th>Actions</th></tr></thead>
                    <tbody>
                        <?php foreach ($modules as $m): ?>
                        <tr>
                            <td><?= $m['module_id'] ?></td>
                            <td><?= e($m['title']) ?></td>
                            <td><?= e($m['category']) ?></td>
                            <td class="admin-actions">
                                <a href="?edit=<?= $m['module_id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                                <a href="?delete=<?= $m['module_id'] ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Delete this module?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

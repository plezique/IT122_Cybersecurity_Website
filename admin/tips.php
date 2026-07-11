<?php
/**
 * Admin — Manage Tips (CRUD).
 */
$pageTitle = 'Manage Tips';
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();

$db = getDB();
$message = '';
$error = '';

if (isset($_GET['delete'])) {
    $id = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
    if ($id) {
        $stmt = $db->prepare('DELETE FROM tips WHERE tip_id = ?');
        $stmt->execute([$id]);
        $message = 'Tip deleted successfully.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'tip_id', FILTER_VALIDATE_INT);
    $tipText = trim($_POST['tip_text'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $isFeatured = isset($_POST['is_featured']) ? 1 : 0;

    if (empty($tipText) || empty($category)) {
        $error = 'Tip text and category are required.';
    } else {
        if ($id) {
            $stmt = $db->prepare('UPDATE tips SET tip_text=?, category=?, is_featured=? WHERE tip_id=?');
            $stmt->execute([$tipText, $category, $isFeatured, $id]);
            $message = 'Tip updated successfully.';
        } else {
            $stmt = $db->prepare('INSERT INTO tips (tip_text, category, is_featured) VALUES (?, ?, ?)');
            $stmt->execute([$tipText, $category, $isFeatured]);
            $message = 'Tip created successfully.';
        }
    }
}

$editTip = null;
if (isset($_GET['edit'])) {
    $editId = filter_input(INPUT_GET, 'edit', FILTER_VALIDATE_INT);
    if ($editId) {
        $stmt = $db->prepare('SELECT * FROM tips WHERE tip_id = ?');
        $stmt->execute([$editId]);
        $editTip = $stmt->fetch();
    }
}

$tips = $db->query('SELECT * FROM tips ORDER BY category, tip_id')->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container"><h1>Manage Tips</h1></div>
</div>

<section class="section">
    <div class="container">
        <div class="admin-layout">
            <?php include __DIR__ . '/sidebar.php'; ?>
            <div class="admin-content">
                <?php if ($message): ?><div class="alert alert-success"><?= e($message) ?></div><?php endif; ?>
                <?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>

                <div class="card mb-3">
                    <h3><?= $editTip ? 'Edit Tip' : 'Add New Tip' ?></h3>
                    <form method="POST">
                        <?php if ($editTip): ?>
                            <input type="hidden" name="tip_id" value="<?= $editTip['tip_id'] ?>">
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="tip_text">Tip Text</label>
                            <textarea id="tip_text" name="tip_text" required rows="3"><?= e($editTip['tip_text'] ?? '') ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" id="category" name="category" required value="<?= e($editTip['category'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_featured" value="1"
                                    <?= ($editTip['is_featured'] ?? 0) ? 'checked' : '' ?>>
                                Featured (eligible for Tip of the Day)
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary"><?= $editTip ? 'Update' : 'Create' ?> Tip</button>
                        <?php if ($editTip): ?>
                            <a href="<?= baseUrl('admin/tips.php') ?>" class="btn btn-outline">Cancel</a>
                        <?php endif; ?>
                    </form>
                </div>

                <table class="admin-table">
                    <thead><tr><th>ID</th><th>Tip</th><th>Category</th><th>Featured</th><th>Actions</th></tr></thead>
                    <tbody>
                        <?php foreach ($tips as $t): ?>
                        <tr>
                            <td><?= $t['tip_id'] ?></td>
                            <td><?= e(mb_strimwidth($t['tip_text'], 0, 80, '...')) ?></td>
                            <td><?= e($t['category']) ?></td>
                            <td><?= $t['is_featured'] ? '<span class="data-tag">Yes</span>' : '—' ?></td>
                            <td class="admin-actions">
                                <a href="?edit=<?= $t['tip_id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                                <a href="?delete=<?= $t['tip_id'] ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Delete this tip?')">Delete</a>
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

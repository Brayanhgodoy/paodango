<?php
require_once '../db.php';
$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare('DELETE FROM produtos WHERE id = ?');
    $stmt->execute([$id]);
}
header('Location: read.php');
exit;

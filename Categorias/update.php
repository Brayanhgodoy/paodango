<?php
require_once '../db.php';
$id = $_GET['id'] ?? null;
if (!$id) { header('Location: read.php'); exit; }
$stmt = $pdo->prepare('SELECT * FROM categorias WHERE id = ?');
$stmt->execute([$id]);
$categoria = $stmt->fetch();
if (!$categoria) { header('Location: read.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $stmt = $pdo->prepare('UPDATE categorias SET nome=?, descricao=? WHERE id=?');
    $stmt->execute([$nome, $descricao, $id]);
    header('Location: read.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoria</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Editar Categoria</h1>
    <form method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required><br>
        <label>Descrição:</label><br>
        <textarea name="descricao"><?= htmlspecialchars($categoria['descricao']) ?></textarea><br>
        <input type="submit" value="Salvar">
    </form>
    <a href="read.php">Voltar</a>
</div>
</body>
</html>

<?php
require_once '../db.php';
$id = $_GET['id'] ?? null;
if (!$id) { header('Location: read.php'); exit; }

// Busca produto
$stmt = $pdo->prepare('SELECT * FROM produtos WHERE id = ?');
$stmt->execute([$id]);
$produto = $stmt->fetch();
if (!$produto) { header('Location: read.php'); exit; }

// Busca categorias
$categorias = $pdo->query('SELECT id, nome FROM categorias')->fetchAll();

// Atualiza produto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $categoria_id = $_POST['categoria_id'] ?? null;
    $preco = $_POST['preco'] ?? 0;
    $estoque = $_POST['estoque'] ?? 0;
    $descricao = $_POST['descricao'] ?? '';
    $stmt = $pdo->prepare('UPDATE produtos SET nome=?, categoria_id=?, preco=?, estoque=?, descricao=? WHERE id=?');
    $stmt->execute([$nome, $categoria_id, $preco, $estoque, $descricao, $id]);
    header('Location: read.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Editar Produto</h1>
    <form method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required><br>
        <label>Categoria:</label><br>
        <select name="categoria_id" required>
            <option value="">Selecione</option>
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $cat['id']==$produto['categoria_id']?'selected':'' ?>><?= htmlspecialchars($cat['nome']) ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required><br>
        <label>Estoque:</label><br>
        <input type="number" name="estoque" value="<?= $produto['estoque'] ?>" required><br>
        <label>Descrição:</label><br>
        <textarea name="descricao"><?= htmlspecialchars($produto['descricao']) ?></textarea><br>
        <input type="submit" value="Salvar">
    </form>
    <a href="read.php">Voltar</a>
</div>
</body>
</html>
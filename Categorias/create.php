<?php
require_once '../db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $stmt = $pdo->prepare('INSERT INTO categorias (nome, descricao) VALUES (?, ?)');
    $stmt->execute([$nome, $descricao]);
    header('Location: read.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Categoria</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1>Cadastrar Categoria</h1>
    <form method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br>
        <label>Descrição:</label><br>
        <textarea name="descricao"></textarea><br>
        <input type="submit" value="Cadastrar">
    </form>
    <a href="read.php">Voltar</a>
</div>
</body>
</html>
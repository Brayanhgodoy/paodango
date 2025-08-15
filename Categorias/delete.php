<?php
require_once '../db.php';
include '../produtos/create.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $stmt = $pdo->prepare('DELETE categorias WHERE (nome, descricao) VALUES ($nome, $descricao)');
    $stmt->execute([$nome, $descricao]);
    header('Location: read.php');
    exit;
}
<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $aluno = $_POST['aluno'];
    $status = $_POST['status'];
    
    try {
        $sql = "INSERT INTO livros (titulo, autor, aluno, status) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $autor, $aluno, $status]);
        
        header("Location: index.php?msg=success");
        exit();
    } catch(PDOException $e) {
        header("Location: index.php?msg=error");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>